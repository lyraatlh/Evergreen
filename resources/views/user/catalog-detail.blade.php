@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-100">

<!-- Modern Header Section -->
<header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto py-4 flex justify-between items-center px-6">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
            Ever<span class="text-emerald-800">green</span>
        </a>
        <nav class="flex space-x-8"> 
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Home</a>
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Dashboard</a>
                    <a href="{{ route('admin.plants.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Manage Plants</a>
                    <a href="{{ route('admin.catalogs.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Manage Catalog</a>
                    <a href="{{ route('admin.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
                @else
                    <a href="{{ route('user.catalog') }}" class="text-emerald-600 font-semibold">Catalog</a>
                    <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                    <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
                @endif
            @else
                <a href="{{ route('catalogs.index') }}" class="text-emerald-600 font-semibold">Catalog</a>
                <a href="{{ route('shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition-all duration-300 font-medium">Login</a>
                <a href="{{ route('register') }}" class="border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 font-medium">Register</a>
            @endauth
        </nav>
    </div>
</header>

<!-- Breadcrumb -->
<section class="py-8 bg-white/50">
    <div class="container mx-auto px-6">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">→</span>
            <a href="{{ route('user.catalog') }}" class="text-gray-500 hover:text-emerald-600">Catalog</a>
            <span class="text-gray-400">→</span>
            <span class="text-emerald-600 font-medium">{{ $catalog->Type_Name }}</span>
        </nav>
    </div>
</section>

<!-- Catalog Detail Header -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">{{ $catalog->Type_Name }}</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Explore our beautiful collection of {{ strtolower($catalog->Type_Name) }} perfect for your space.
            </p>
            <div class="mt-8">
                <span class="inline-block bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-full font-bold text-lg">
                    {{ $plants->count() }} Plants Available
                </span>
            </div>
        </div>

        <!-- Plants Grid -->
        @if($plants->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($plants as $plant)
                    <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500 bg-white">
                        <div class="relative overflow-hidden h-64">
                            @if($plant->image->count() > 0)
                                <img src="{{ $plant->image->first()->image_url }}" alt="{{ $plant->Plant_Name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                    <span class="text-6xl">🌱</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Price Badge -->
                            <div class="absolute top-4 left-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-full font-bold">
                                ${{ number_format($plant->Price, 0) }}
                            </div>
                            
                            <!-- Stock Badge -->
                            @if($plant->Stock > 0)
                                <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $plant->Stock }} in stock
                                </div>
                            @else
                                <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    Out of stock
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $plant->Plant_Name }}</h3>
                            <p class="text-gray-600 mb-4">Perfect for indoor and outdoor decoration</p>
                            
                            <div class="flex justify-between items-center">
                                <div class="text-2xl font-bold text-emerald-600">
                                    ${{ number_format($plant->Price, 0) }}
                                </div>
                                @if($plant->Stock > 0)
                                    <button class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">
                                        Add to Cart
                                    </button>
                                @else
                                    <button disabled class="bg-gray-400 text-white px-6 py-2 rounded-full cursor-not-allowed font-medium">
                                        Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-6xl text-gray-400">🌿</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Plants Available</h3>
                <p class="text-gray-600 mb-8">No plants available in this category at the moment.</p>
                <a href="{{ route('user.catalog') }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">
                    Back to Catalog
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