<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Orders;
use App\Models\User;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalOrders = Orders::where('Customer_ID', $user->id)->count();
        $totalPlant = Orders::where('Customer_ID', $user->id)->sum('Quantity');

        return view('user.profile', compact('user', 'totalOrders', 'totalPlant'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->save();

        return redirect()->route('user.profile.index')
            ->with('success', 'Profile updated successfully!');
    }
}