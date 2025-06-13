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
                    <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
                    <a href="{{ route('user.shop') }}" class="text-emerald-600 font-semibold">Shop</a>
                    <a href="{{ route('user.favorites') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Favorites</a>
                    <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
                @endif
                @if(Auth::user()->role === 'user')
                    <a href="{{ route('user.cart') }}" class="relative text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">
                        Cart
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-emerald-600 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endif
            @else
                <a href="{{ route('catalogs.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
                <a href="{{ route('shop') }}" class="text-emerald-600 font-semibold">Shop</a>
                <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition-all duration-300 font-medium">Login</a>
                <a href="{{ route('register') }}" class="border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 font-medium">Register</a>
            @endauth
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

<!-- Hero Section -->
<section class="py-16 bg-gradient-to-r from-[#729679] to-[#9ab29a] text-white">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-5xl font-bold mb-6">Bring Nature Into Your Home</h1>
                <p class="text-lg text-white-100 mb-8 leading-relaxed">
                    Discover our curated collection of beautiful plants that will transform your space into a green sanctuary. Each plant is carefully selected for its beauty and ease of care.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="#latest" class="bg-white text-[#5d8765] border border-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] transition-all duration-300 font-medium">
                        Latest Arrivals
                    </a>
                    <a href="#all-plants" class="bg-[#d7e1d9] text-[#5d8765] border border-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] transition-all duration-300 font-medium">
                        Browse All Plants
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="relative">
                    <div class="w-64 h-64 bg-[#d7e1d9] rounded-full absolute -top-6 -right-6 opacity-20"></div>
                    <div class="w-64 h-64 bg-[#d7e1d9] rounded-full absolute -bottom-6 -left-6 opacity-20"></div>
                    <div class="p-4 rounded-3xl relative z-10">
                        <img src="/img/pngwing.com.png" alt="Plant Collection" class="rounded-2xl">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Plants Section -->
<section id="latest" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Latest Arrivals</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                Check out our newest plant additions that have just arrived at our nursery.
            </p>
        </div>

        <!-- Latest Plants Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestPlants as $plant)
                <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500 bg-white">
                    <a href="{{ route('user.shop.show', $plant->Plant_ID) }}" class="block">
                        <div class="relative overflow-hidden h-64">
                            @if($plant->image->count() > 0)
                                <img src="{{ $plant->image->first()->image_url }}" alt="{{ $plant->Plant_Name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                    <span class="text-6xl">🌱</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Stock Badge -->
                            @if($plant->Stock > 0)
                                <div class="absolute top-4 right-4 bg-blue-400 text-white px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $plant->Stock }} in stock
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
                                {{ $plant->type->Type_Name ?? 'Unknown Type' }}
                            </span>
                        </div>
                        <a href="{{ route('user.shop.show', $plant->Plant_ID) }}" class="block">
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $plant->Plant_Name }}</h3>
                            <p class="text-gray-600 mb-4">Perfect for indoor and outdoor decoration</p>
                        </a>
                        
                        <div class="flex justify-between items-center">
                            <div class="text-2xl font-bold text-[#5d8765]">
                                ${{ number_format($plant->Price, 0) }}
                            </div>
                            <div class="flex space-x-2">
                                @auth
                                    <a href="{{ route('user.favorites.add', $plant->Plant_ID) }}" class="bg-white border border-[#729679] text-[#729679] p-2 rounded-full hover:bg-[#c2d2c5] transition-all duration-300">
                                        @if(isset($favorites) && in_array($plant->Plant_ID, $favorites))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z"></path></svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                                        @endif
                                    </a>
                                @endauth
                                @if($plant->Stock > 0)
                                    <form action="{{ route('user.cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="plant_id" value="{{ $plant->Plant_ID }}">
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
    </div>
</section>

<!-- All Plants Section -->
<section id="all-plants" class="py-20 bg-[#d7e1d9]">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">All Plants Collection</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                Browse our complete collection of plants organized by category.
            </p>
        </div>

        <!-- Plants by Category -->
        @foreach($catalogs as $catalog)
            @if($catalog->plants->count() > 0)
                <div class="mb-20">
                    <div class="flex justify-between items-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-900">{{ $catalog->Type_Name }}</h3>
                        <a href="{{ route('user.catalog.show', $catalog->Type_ID) }}" class="text-[#729679] hover:text-emerald-800 font-medium flex items-center">
                            View All
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="ml-1"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($catalog->plants->take(4) as $plant)
                            <div class="group bg-white rounded-2xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                                <a href="{{ route('user.shop.show', $plant->Plant_ID) }}" class="block">
                                    <div class="relative overflow-hidden h-48">
                                        @if($plant->image->count() > 0)
                                            <img src="{{ $plant->image->first()->image_url }}" alt="{{ $plant->Plant_Name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-48 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                                <span class="text-4xl">🌱</span>
                                            </div>
                                        @endif
                                        
                                        <!-- Stock Badge -->
                                        @if($plant->Stock > 0)
                                            <div class="absolute top-3 right-3 bg-blue-400 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                {{ $plant->Stock }} in stock
                                            </div>
                                        @else
                                            <div class="absolute top-3 right-3 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                                Out of stock
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                
                                <div class="p-4">
                                    <a href="{{ route('user.shop.show', $plant->Plant_ID) }}" class="block">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $plant->Plant_Name }}</h4>
                                    </a>
                                    
                                    <div class="flex justify-between items-center mt-3">
                                        <div class="text-lg font-bold text-[#5d8765]">
                                            ${{ number_format($plant->Price, 0) }}
                                        </div>
                                        <div class="flex space-x-1">
                                            @auth
                                                <a href="{{ route('user.favorites.add', $plant->Plant_ID) }}" class="bg-white border border-[#729679] text-[#729679] p-2 rounded-full hover:bg-[#c2d2c5] transition-all duration-300">
                                                    @if(isset($favorites) && in_array($plant->Plant_ID, $favorites))
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z"></path></svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 256 256"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                                                    @endif
                                                </a>
                                            @endauth
                                            @if($plant->Stock > 0)
                                                <form action="{{ route('user.cart.add') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="plant_id" value="{{ $plant->Plant_ID }}">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="bg-[#729679] text-white px-3 py-1.5 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 text-sm font-medium">
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="bg-gray-400 text-white px-3 py-1.5 rounded-full cursor-not-allowed text-sm font-medium">
                                                    Out of Stock
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>

<!-- Sustainability Section -->
<section class="py-20 bg-[#729679] text-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold mb-6">Our Commitment to Sustainability</h2>
            <p class="text-lg max-w-4xl mx-auto leading-relaxed text-white-100">
                For every purchase of 3 or more plants, we donate a tree seedling to local reforestation projects. 
                Join us in making the world greener, one plant at a time.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 text-center">
                <div class="w-20 h-20 bg-[#5d8765] rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#292929" viewBox="0 0 256 256"><path d="M247.63,47.89a8,8,0,0,0-7.52-7.52c-51.76-3-93.32,12.74-111.18,42.22-11.8,19.49-11.78,43.16-.16,65.74a71.34,71.34,0,0,0-14.17,27L98.33,159c7.82-16.33,7.52-33.35-1-47.49-13.2-21.79-43.67-33.47-81.5-31.25a8,8,0,0,0-7.52,7.52c-2.23,37.83,9.46,68.3,31.25,81.5A45.82,45.82,0,0,0,63.44,176,54.58,54.58,0,0,0,87,170.33l25,25V224a8,8,0,0,0,16,0V194.51a55.61,55.61,0,0,1,12.27-35,73.91,73.91,0,0,0,33.31,8.4,60.9,60.9,0,0,0,31.83-8.86C234.89,141.21,250.67,99.65,247.63,47.89ZM47.81,155.6C32.47,146.31,23.79,124.32,24,96c28.32-.24,50.31,8.47,59.6,23.81,4.85,8,5.64,17.33,2.46,26.94L61.65,122.34a8,8,0,0,0-11.31,11.31l24.41,24.41C65.14,161.24,55.82,160.45,47.81,155.6Zm149.31-10.22c-13.4,8.11-29.15,8.73-45.15,2l53.69-53.7a8,8,0,0,0-11.31-11.31L140.65,136c-6.76-16-6.15-31.76,2-45.15,13.94-23,47-35.82,89.33-34.83C232.94,98.34,220.14,131.44,197.12,145.38Z"></path></svg></span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Plant a Tree</h3>
                <p class="text-white-100">
                    We've planted over 10,000 trees in partnership with local environmental organizations.
                </p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 text-center">
                <div class="w-20 h-20 bg-[#5d8765] rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#292929" viewBox="0 0 256 256"><path d="M96,208a8,8,0,0,1-8,8H40a24,24,0,0,1-20.77-36l34.29-59.25L39.47,124.5A8,8,0,1,1,35.33,109l32.77-8.77a8,8,0,0,1,9.8,5.66l8.79,32.77A8,8,0,0,1,81,148.5a8.37,8.37,0,0,1-2.08.27,8,8,0,0,1-7.72-5.93l-3.8-14.15L33.11,188A8,8,0,0,0,40,200H88A8,8,0,0,1,96,208Zm140.73-28-23.14-40a8,8,0,0,0-13.84,8l23.14,40A8,8,0,0,1,216,200H147.31l10.34-10.34a8,8,0,0,0-11.31-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.31-11.32L147.31,216H216a24,24,0,0,0,20.77-36ZM128,32a7.85,7.85,0,0,1,6.92,4l34.29,59.25-14.08-3.78A8,8,0,0,0,151,106.92l32.78,8.79a8.23,8.23,0,0,0,2.07.27,8,8,0,0,0,7.72-5.93l8.79-32.79a8,8,0,1,0-15.45-4.14l-3.8,14.17L148.77,28a24,24,0,0,0-41.54,0L84.07,68a8,8,0,0,0,13.85,8l23.16-40A7.85,7.85,0,0,1,128,32Z"></path></svg></span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Eco-Friendly Packaging</h3>
                <p class="text-white-100">
                    All our packaging is made from recycled materials and is 100% biodegradable.
                </p>
            </div>
            
            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-8 text-center">
                <div class="w-20 h-20 bg-[#5d8765] rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#292929" viewBox="0 0 256 256"><path d="M174,47.75a254.19,254.19,0,0,0-41.45-38.3,8,8,0,0,0-9.18,0A254.19,254.19,0,0,0,82,47.75C54.51,79.32,40,112.6,40,144a88,88,0,0,0,176,0C216,112.6,201.49,79.32,174,47.75ZM128,216a72.08,72.08,0,0,1-72-72c0-57.23,55.47-105,72-118,16.53,13,72,60.75,72,118A72.08,72.08,0,0,1,128,216Zm55.89-62.66a57.6,57.6,0,0,1-46.56,46.55A8.75,8.75,0,0,1,136,200a8,8,0,0,1-1.32-15.89c16.57-2.79,30.63-16.85,33.44-33.45a8,8,0,0,1,15.78,2.68Z"></path></svg></span>
                </div>
                <h3 class="text-2xl font-bold mb-4">Water Conservation</h3>
                <p class="text-white-100">
                    Our nursery uses advanced irrigation systems to minimize water usage.
                </p>
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