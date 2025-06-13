@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-white-100 to-white-100">

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

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative container mx-auto mt-6" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative container mx-auto mt-6" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
@endif

<!-- Cart Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">Your Shopping Cart</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Review your items and proceed to checkout when you're ready.
            </p>
        </div>

        @if(count($cart) > 0)
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-[#729679] text-white">
                            <tr>
                                <th class="py-4 px-6 text-left">Product</th>
                                <th class="py-4 px-6 text-center">Price</th>
                                <th class="py-4 px-6 text-center">Quantity</th>
                                <th class="py-4 px-6 text-center">Total</th>
                                <th class="py-4 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $plantId => $item)
                                <tr class="border-b border-gray-200">
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            @if($item['image'])
                                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-lg flex items-center justify-center mr-4">
                                                    <span class="text-2xl">🌱</span>
                                                </div>
                                            @endif
                                            <span class="font-medium">{{ $item['name'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-center">${{ number_format($item['price'], 0) }}</td>
                                    <td class="py-4 px-6">
                                        <form action="{{ route('user.cart.update') }}" method="POST" class="flex items-center justify-center">
                                            @csrf
                                            <input type="hidden" name="plant_id" value="{{ $plantId }}">
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button type="button" onclick="decrementQuantity('{{ $plantId }}')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-l-lg">-</button>
                                                <input type="number" name="quantity" id="quantity-{{ $plantId }}" value="{{ $item['quantity'] }}" min="1" class="w-12 text-center py-1 border-none focus:outline-none focus:ring-0">
                                                <button type="button" onclick="incrementQuantity('{{ $plantId }}')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-r-lg">+</button>
                                            </div>
                                            <button type="submit" class="ml-2 text-[#729679] hover:text-[#c2d2c5]">
                                                Update
                                            </button>
                                        </form>
                                    </td>
                                    <td class="py-4 px-6 text-center font-bold">${{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <a href="{{ route('user.cart.remove', $plantId) }}" class="text-red-500 hover:text-red-700">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <!-- Order Summary -->
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8 w-full md:w-1/3">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4">
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
                    
                    <div class="mt-8">
                        <a href="{{ route('user.checkout') }}" class="block w-full bg-[#729679] text-white px-6 py-3 rounded-xl hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-semibold text-center">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('user.catalog') }}" class="block w-full text-center mt-4 text-[#729679] hover:text-[#c2d2c5]">
                            Continue Shopping
                        </a>
                    </div>
                </div>
                
                <!-- Donation Info -->
                @if($showDonation)
                <div class="bg-gradient-to-br from-emerald-900 to-teal-900 text-white rounded-3xl shadow-2xl overflow-hidden p-8 w-full md:w-2/3">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-6">
                            <span class="text-3xl"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#000000" viewBox="0 0 256 256"><path d="M230.32,187.09l-46-59.09H208a8,8,0,0,0,6.34-12.88l-80-104a8,8,0,0,0-12.68,0l-80,104A8,8,0,0,0,48,128H71.64l-46,59.09A8,8,0,0,0,32,200h88v40a8,8,0,0,0,16,0V200h88a8,8,0,0,0,6.32-12.91ZM48.36,184l46-59.09A8,8,0,0,0,88,112H64.25L128,29.12,191.75,112H168a8,8,0,0,0-6.31,12.91L207.64,184Z"></path></svg></span>
                        </div>
                        <h2 class="text-2xl font-bold">Thank You for Supporting Reforestation!</h2>
                    </div>
                    
                    <p class="text-white-100 mb-6 leading-relaxed">
                        Because you're purchasing 3 or more plants, Evergreen will donate a tree seedling to our local reforestation project. Together, we're making the world a greener place!
                    </p>
                    
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6">
                        <h3 class="font-bold mb-2">Your Impact</h3>
                        <p class="text-sm text-white-100">
                            One tree can absorb up to 48 pounds of carbon dioxide per year and provide enough oxygen for two people. Your contribution helps combat climate change and supports biodiversity.
                        </p>
                    </div>
                </div>
                @endif
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-[#729679] rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-6xl text-gray-400"><svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#292929" viewBox="0 0 256 256"><path d="M104,216a16,16,0,1,1-16-16A16,16,0,0,1,104,216Zm88-16a16,16,0,1,0,16,16A16,16,0,0,0,192,200ZM239.71,74.14l-25.64,92.28A24.06,24.06,0,0,1,191,184H92.16A24.06,24.06,0,0,1,69,166.42L33.92,40H16a8,8,0,0,1,0-16H40a8,8,0,0,1,7.71,5.86L57.19,64H232a8,8,0,0,1,7.71,10.14ZM221.47,80H61.64l22.81,82.14A8,8,0,0,0,92.16,168H191a8,8,0,0,0,7.71-5.86Z"></path></svg></span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Your Cart is Empty</h3>
                <p class="text-gray-600 mb-8">Looks like you haven't added any plants to your cart yet.</p>
                <a href="{{ route('user.catalog') }}" class="bg-[#729679] text-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-medium">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Modern Footer -->
<footer class="bg-gradient-to-r from-emerald-900 to-teal-900 text-emerald-100 py-12">
    <div class="container mx-auto px-6 text-center">
        <p class="text-lg">&copy; 2024 Evergreen Life. All rights reserved.</p>
    </div>
</footer>

</div>

<script>
    function incrementQuantity(plantId) {
        const input = document.getElementById('quantity-' + plantId);
        input.value = parseInt(input.value) + 1;
    }
    
    function decrementQuantity(plantId) {
        const input = document.getElementById('quantity-' + plantId);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
@endsection