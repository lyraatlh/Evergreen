@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#d7e1d9]">

<!-- Modern Header Section -->
<header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto py-4 flex justify-between items-center px-6">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-teal-500 to-emerald-900 bg-clip-text text-transparent">
            Evergreen
        </a>
        <nav class="flex space-x-8"> 
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Home</a>
            <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
            <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
            <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
            <a href="{{ route('user.cart') }}" class="text-emerald-600 font-semibold">Cart</a>
        </nav>
    </div>
</header>

<!-- Checkout Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">Checkout</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Complete your order by providing your shipping and payment details.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Checkout Form -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Shipping Information</h2>
                    
                    <form action="{{ route('user.checkout.process') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Shipping Address</label>
                                <textarea id="address" name="address" rows="3" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#729679] focus:border-transparent"></textarea>
                                @error('address')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="text" id="phone" name="phone" required class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#729679] focus:border-transparent">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Payment Method</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center">
                                        <input type="radio" id="credit_card" name="payment_method" value="credit_card" checked class="h-5 w-5 text-emerald-600 focus:ring-emerald-500">
                                        <label for="credit_card" class="ml-3 text-gray-700">Credit Card</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" class="h-5 w-5 text-emerald-600 focus:ring-emerald-500">
                                        <label for="bank_transfer" class="ml-3 text-gray-700">Bank Transfer</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" class="h-5 w-5 text-emerald-600 focus:ring-emerald-500">
                                        <label for="cash_on_delivery" class="ml-3 text-gray-700">Cash on Delivery</label>
                                    </div>
                                </div>
                                @error('payment_method')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="pt-6 border-t border-gray-200">
                                <button type="submit" class="w-full bg-[#729679] text-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-semibold">
                                    Place Order
                                </button>
                                <a href="{{ route('user.cart') }}" class="block w-full text-center mt-4 text-[#729679] hover:text-[#c2d2c5]">
                                    Back to Cart
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 sticky top-24">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 mb-6">
                        @foreach($cart as $item)
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <span class="bg-[#c2d2c5] text-[#729679] w-6 h-6 rounded-full flex items-center justify-center mr-2">
                                        {{ $item['quantity'] }}
                                    </span>
                                    <span class="text-gray-700">{{ $item['name'] }}</span>
                                </div>
                                <span class="font-medium">${{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t border-gray-200 pt-4 space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">${{ number_format($total, 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Shipping</span>
                            <span class="font-medium">Free</span>
                        </div>
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between">
                                <span class="text-lg font-bold">Total</span>
                                <span class="text-lg font-bold text-[#729679]">${{ number_format($total, 0) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Donation Notice -->
                    @if($showDonation)
                        <div class="mt-6 bg-[#c2d2c5] rounded-xl p-4">
                            <div class="flex items-center">
                                <span class="text-2xl mr-2">🌳</span>
                                <p class="text-sm text-black-800">
                                    <strong>Thank you!</strong> A tree seedling will be donated to our reforestation project.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Footer -->
<footer class="bg-gradient-to-r from-emerald-900 to-teal-900 text-emerald-100 py-12">
    <div class="container mx-auto px-6 text-center">
        <p class="text-lg">&copy; 2024 Evergreen Life. All rights reserved.</p>
    </div>
</footer>

</div>
@endsection