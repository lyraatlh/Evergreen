<?php

namespace App\Http\Controllers;

use App\Models\DimPlant;
use App\Models\Orders;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Catalog;
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
            
        // Get all catalogs with their plants
        $catalogs = Catalog::with(['plants.image'])->get();
        
        // Get cart count if user is logged in
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = $this->getCartCount();
            
            // Get user favorites
            $favorites = Favorite::where('Customer_ID', Auth::id())
                ->pluck('Plant_ID')
                ->toArray();
        } else {
            $favorites = [];
        }
        
        return view('user.shop', compact('featuredPlants', 'latestPlants', 'catalogs', 'cartCount', 'favorites'));
    }
    
    public function show($id)
    {
        $plant = DimPlant::with(['type', 'image'])->findOrFail($id);
        
        // Get related plants (same type)
        $relatedPlants = DimPlant::with(['type', 'image'])
            ->where('Type_ID', $plant->Type_ID)
            ->where('Plant_ID', '!=', $plant->Plant_ID)
            ->take(3)
            ->get();
            
        // Check if plant is in favorites
        $isFavorite = false;
        if (Auth::check()) {
            $isFavorite = Favorite::where('Customer_ID', Auth::id())
                ->where('Plant_ID', $id)
                ->exists();
        }
        
        // Get cart count if user is logged in
        $cartCount = 0;
        if (Auth::check()) {
            $cartCount = $this->getCartCount();
        }
        
        return view('user.shop-detail', compact('plant', 'relatedPlants', 'isFavorite', 'cartCount'));
    }
    
    public function addToFavorites($plantId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add favorites.');
        }
        
        $userId = Auth::id();
        
        // Check if already in favorites
        $favorite = Favorite::where('Customer_ID', $userId)
            ->where('Plant_ID', $plantId)
            ->first();
            
        if ($favorite) {
            // Already in favorites, remove it
            $favorite->delete();
            return redirect()->back()->with('success', 'Plant removed from favorites.');
        } else {
            // Add to favorites
            Favorite::create([
                'Customer_ID' => $userId,
                'Plant_ID' => $plantId
            ]);
            return redirect()->back()->with('success', 'Plant added to favorites.');
        }
    }
    
    public function viewFavorites()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view favorites.');
        }
        
        $favorites = Favorite::where('Customer_ID', Auth::id())
            ->with('plant.type', 'plant.image')
            ->get();
            
        // Get cart count
        $cartCount = $this->getCartCount();
        
        return view('user.favorites', compact('favorites', 'cartCount'));
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