@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#d7e1d9]">

<!-- Modern Header Section -->
<header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto py-4 flex justify-between items-center px-6">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
            Ever<span class="text-emerald-800">green</span>
        </a>
        <nav class="flex space-x-8"> 
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Home</a>
            <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
            <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
            <a href="{{ route('user.favorites') }}" class="text-emerald-600 font-semibold">Favorites</a>
            <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
            <a href="{{ route('user.cart') }}" class="relative text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">
                Cart
                @if(isset($cartCount) && $cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-emerald-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
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

<!-- Favorites Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">Your Favorite Plants</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Here are the plants you've saved to your favorites. Add them to your cart when you're ready to purchase.
            </p>
        </div>

        @if($favorites->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($favorites as $favorite)
                    <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500 bg-white">
                        <a href="{{ route('user.shop.show', $favorite->plant->Plant_ID) }}" class="block">
                            <div class="relative overflow-hidden h-64">
                                @if($favorite->plant->image->count() > 0)
                                    <img src="{{ $favorite->plant->image->first()->image_url }}" alt="{{ $favorite->plant->Plant_Name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                        <span class="text-6xl">🌱</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                
                                <!-- Stock Badge -->
                                @if($favorite->plant->Stock > 0)
                                    <div class="absolute top-4 right-4 bg-blue-400 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        {{ $favorite->plant->Stock }} in stock
                                    </div>
                                @else
                                    <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                        Out of stock
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="inline-block bg-[#c2d2c5] text-black-700 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $favorite->plant->type->Type_Name ?? 'Unknown Type' }}
                                </span>
                            </div>
                            <a href="{{ route('user.shop.show', $favorite->plant->Plant_ID) }}" class="block">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $favorite->plant->Plant_Name }}</h3>
                                <p class="text-gray-600 mb-4">Perfect for indoor and outdoor decoration</p>
                            </a>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-2xl font-bold text-[#729679]">
                                    ${{ number_format($favorite->plant->Price, 0) }}
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('user.favorites.add', $favorite->plant->Plant_ID) }}" class="bg-white border border-red-500 text-red-500 p-2 rounded-full hover:bg-red-50 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z"></path></svg>
                                    </a>
                                    @if($favorite->plant->Stock > 0)
                                        <form action="{{ route('user.cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="plant_id" value="{{ $favorite->plant->Plant_ID }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="bg-[#729679] text-white px-4 py-2 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-medium">
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="bg-gray-400 text-white px-6 py-2 rounded-full cursor-not-allowed font-medium">
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-[#729679] rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#a0aec0" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Favorites Yet</h3>
                <p class="text-gray-600 mb-8">You haven't added any plants to your favorites yet.</p>
                <a href="{{ route('user.shop') }}" class="bg-[#729679] text-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-medium">
                    Browse Plants
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
@endsection