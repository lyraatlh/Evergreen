<?php

namespace App\Http\Controllers;

use App\Models\DimPlant;
use App\Models\Orders;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserShopController extends Controller
{
    public function index()
    {
        // Get featured plants (you can customize this logic)
        $featuredPlants = DimPlant::with(['type', 'image'])
            ->where('Stock', '>', 0)
            ->take(3)
            ->get();
            
        // Get latest plants
        $latestPlants = DimPlant::with(['type', 'image'])
            ->where('Stock', '>', 0)
            ->latest()
            ->take(6)
            ->get();
            
        // Get cart count if user is logged in
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = $this->getCartCount();
        }
        
        return view('user.shop', compact('featuredPlants', 'latestPlants', 'cartCount'));
    }
    
    public function addToCart(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:dim_plant,Plant_ID',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $userId = Auth::id();
        $plantId = $request->plant_id;
        $quantity = $request->quantity;
        
        // Check if plant exists and has enough stock
        $plant = DimPlant::findOrFail($plantId);
        if ($plant->Stock < $quantity) {
            return redirect()->back()->with('error', 'Not enough stock available.');
        }
        
        // Check if cart exists in session
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
        
        $cart = Session::get('cart');
        
        // Check if item already exists in cart
        if (isset($cart[$plantId])) {
            $cart[$plantId]['quantity'] += $quantity;
        } else {
            $cart[$plantId] = [
                'plant_id' => $plantId,
                'name' => $plant->Plant_Name,
                'price' => $plant->Price,
                'quantity' => $quantity,
                'image' => $plant->image->count() > 0 ? $plant->image->first()->image_url : null,
            ];
        }
        
        Session::put('cart', $cart);
        
        return redirect()->back()->with('success', 'Plant added to cart successfully.');
    }
    
    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        $showDonation = count($cart) >= 3;
        
        return view('user.cart', compact('cart', 'total', 'showDonation'));
    }
    
    public function updateCart(Request $request)
    {
        $request->validate([
            'plant_id' => 'required|exists:dim_plant,Plant_ID',
            'quantity' => 'required|integer|min:0',
        ]);
        
        $plantId = $request->plant_id;
        $quantity = $request->quantity;
        
        $cart = Session::get('cart', []);
        
        if ($quantity <= 0) {
            unset($cart[$plantId]);
        } else {
            // Check if plant has enough stock
            $plant = DimPlant::findOrFail($plantId);
            if ($plant->Stock < $quantity) {
                return redirect()->back()->with('error', 'Not enough stock available.');
            }
            
            $cart[$plantId]['quantity'] = $quantity;
        }
        
        Session::put('cart', $cart);
        
        return redirect()->route('user.cart')->with('success', 'Cart updated successfully.');
    }
    
    public function removeFromCart($plantId)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$plantId])) {
            unset($cart[$plantId]);
            Session::put('cart', $cart);
        }
        
        return redirect()->route('user.cart')->with('success', 'Item removed from cart.');
    }
    
    public function checkout()
    {
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('user.shop')->with('error', 'Your cart is empty.');
        }
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        $showDonation = count($cart) >= 3;
        
        return view('user.checkout', compact('cart', 'total', 'showDonation'));
    }
    
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:credit_card,bank_transfer,cash_on_delivery',
        ]);
        
        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('user.shop')->with('error', 'Your cart is empty.');
        }
        
        $userId = Auth::id();
        
        // Process each item in the cart
        foreach ($cart as $item) {
            // Create order
            $order = new Orders();
            $order->Customer_ID = $userId;
            $order->Plant_ID = $item['plant_id'];
            $order->Quantity = $item['quantity'];
            $order->total_price = $item['price'] * $item['quantity'];
            $order->save();
            
            // Update stock
            $plant = DimPlant::findOrFail($item['plant_id']);
            $plant->Stock -= $item['quantity'];
            $plant->save();
        }
        
        // Clear cart
        Session::forget('cart');
        
        // Check if donation applies
        $showDonation = count($cart) >= 3;
        
        return redirect()->route('user.order.success')->with([
            'success' => 'Order placed successfully!',
            'showDonation' => $showDonation
        ]);
    }
    
    public function orderSuccess()
    {
        $showDonation = session('showDonation', false);
        return view('user.order-success', compact('showDonation'));
    }
    
    private function getCartCount()
    {
        $cart = Session::get('cart', []);
        return count($cart);
    }
}