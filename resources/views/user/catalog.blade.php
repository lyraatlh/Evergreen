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

<!-- Modern Catalog Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">Plant Catalog</h1>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">Discover our curated collection of beautiful plants for every space and lifestyle.</p>
        </div>

        <!-- Modern Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <a href="{{ route('user.catalog', ['type' => 'all']) }}" 
               class="px-8 py-3 rounded-full transition-all duration-300 font-medium shadow-lg {{ $selectedType === 'all' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-white text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 border border-gray-200' }}">
                See All
            </a>
            @foreach($catalogs as $catalog)
                <a href="{{ route('user.catalog', ['type' => $catalog->Type_ID]) }}" 
                   class="px-8 py-3 rounded-full transition-all duration-300 font-medium shadow-lg {{ $selectedType == $catalog->Type_ID ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white' : 'bg-white text-gray-700 hover:bg-emerald-50 hover:text-emerald-600 border border-gray-200' }}">
                    {{ $catalog->Type_Name }}
                </a>
            @endforeach
        </div>

        <!-- Featured Catalog Cards -->
        @if($selectedType === 'all')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            @foreach($featuredCatalogs as $index => $catalog)
                @php
                    $gradients = [
                        'bg-gradient-to-br from-emerald-600 to-emerald-800',
                        'bg-gradient-to-br from-gray-700 to-gray-900',
                        'bg-gradient-to-br from-slate-800 to-slate-900'
                    ];
                    $bgColors = [
                        'bg-emerald-900/50',
                        'bg-gray-800/50',
                        'bg-slate-700/50'
                    ];
                @endphp
                <div class="group relative {{ $gradients[$index] }} text-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                    <div class="p-8">
                        <h3 class="text-3xl font-bold mb-4">{{ $catalog->Type_Name }}</h3>
                        <p class="text-gray-200 mb-6 leading-relaxed">
                            Discover our amazing collection of {{ strtolower($catalog->Type_Name) }}. Perfect for your home and garden.
                        </p>
                        <span class="inline-block {{ $bgColors[$index] }} px-4 py-2 rounded-full text-sm font-medium">
                            {{ $catalog->plants->count() }} Plants Available
                        </span>
                    </div>
                    <a href="{{ route('user.catalog.show', $catalog->Type_ID) }}" class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                        <span class="text-white text-xl">→</span>
                    </a>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Plants Collection -->
@if($plants->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">
                @if($selectedType === 'all')
                    All Plants Collection
                @else
                    {{ $catalogs->where('Type_ID', $selectedType)->first()->Type_Name ?? 'Plants' }} Collection
                @endif
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Browse through our beautiful selection of plants perfect for your space.
            </p>
        </div>

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
                        <div class="mb-2">
                            <span class="inline-block bg-gradient-to-r from-emerald-100 to-teal-100 text-emerald-700 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $plant->type->Type_Name ?? 'Unknown Type' }}
                            </span>
                        </div>
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
        
        @if($plants->count() === 0)
            <div class="text-center py-16">
                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-6xl text-gray-400">🌿</span>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Plants Found</h3>
                <p class="text-gray-600 mb-8">No plants available in this category at the moment.</p>
                <a href="{{ route('user.catalog', ['type' => 'all']) }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">
                    View All Plants
                </a>
            </div>
        @endif
    </div>
</section>
@endif

<!-- Modern Footer -->
<footer class="bg-gradient-to-r from-emerald-900 to-teal-900 text-emerald-100 py-12">
    <div class="container mx-auto px-6 text-center">
        <p class="text-lg">&copy; 2024 Evergreen Life. All rights reserved.</p>
    </div>
</footer>

</div>
@endsection