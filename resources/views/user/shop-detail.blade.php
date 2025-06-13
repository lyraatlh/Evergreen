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

<!-- Breadcrumb -->
<section class="py-8 bg-white/50">
    <div class="container mx-auto px-6">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600">Home</a>
            <span class="text-gray-400">→</span>
            <a href="{{ route('user.shop') }}" class="text-gray-500 hover:text-emerald-600">Shop</a>
            <span class="text-gray-400">→</span>
            <span class="text-emerald-600 font-medium">{{ $plant->Plant_Name }}</span>
        </nav>
    </div>
</section>

<!-- Product Detail Section -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Product Images -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                    @if($plant->image->count() > 0)
                        <img src="{{ $plant->image->first()->image_url }}" alt="{{ $plant->Plant_Name }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                            <span class="text-8xl">🌱</span>
                        </div>
                    @endif
                </div>
                
                @if($plant->image->count() > 1)
                    <div class="grid grid-cols-4 gap-4 mt-4">
                        @foreach($plant->image as $image)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                                <img src="{{ $image->image_url }}" alt="{{ $plant->Plant_Name }}" class="w-full h-24 object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            
            <!-- Product Info -->
            <div class="lg:w-1/2">
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden p-8">
                    <div class="mb-6">
                        <span class="inline-block bg-[#c2d2c5] text-black-700 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $plant->type->Type_Name ?? 'Unknown Type' }}
                        </span>
                    </div>
                    
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $plant->Plant_Name }}</h1>
                    
                    <div class="flex items-center mb-6">
                        <div class="text-3xl font-bold text-[#5d8765] mr-4">${{ number_format($plant->Price, 0) }}</div>
                        @if($plant->Stock > 0)
                            <span class="bg-[#729679] text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $plant->Stock }} in stock
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Out of stock
                            </span>
                        @endif
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Description</h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            The {{ $plant->Plant_Name }} is a beautiful {{ strtolower($plant->type->Type_Name ?? 'plant') }} that will add a touch of nature to your space. 
                            It's perfect for both beginners and experienced plant enthusiasts, requiring moderate care and attention.
                        </p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-[#c2d2c5] rounded-xl p-4">
                                <h3 class="font-bold text-gray-900 mb-2">Light</h3>
                                <p class="text-gray-600">Bright, indirect light</p>
                            </div>
                            <div class="bg-[#c2d2c5] rounded-xl p-4">
                                <h3 class="font-bold text-gray-900 mb-2">Water</h3>
                                <p class="text-gray-600">Once a week, allow to dry between waterings</p>
                            </div>
                            <div class="bg-[#c2d2c5] rounded-xl p-4">
                                <h3 class="font-bold text-gray-900 mb-2">Temperature</h3>
                                <p class="text-gray-600">65-80°F (18-27°C)</p>
                            </div>
                            <div class="bg-[#c2d2c5] rounded-xl p-4">
                                <h3 class="font-bold text-gray-900 mb-2">Humidity</h3>
                                <p class="text-gray-600">Medium to high</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($plant->Stock > 0)
                        <form action="{{ route('user.cart.add') }}" method="POST" class="mb-6">
                            @csrf
                            <input type="hidden" name="plant_id" value="{{ $plant->Plant_ID }}">
                            <div class="flex items-center mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mr-4">Quantity:</label>
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $plant->Stock }}" class="w-16 text-center py-2 px-3 border-none focus:outline-none focus:ring-0">
                                </div>
                            </div>
                            
                            <div class="flex flex-col sm:flex-row gap-4">
                                <button type="submit" class="flex-1 bg-[#729679] text-white px-6 py-3 rounded-xl hover:bg-[#c2d2c5] hover:to-teal-600 transition-all duration-300 font-semibold">
                                    Add to Cart
                                </button>
                                
                                <a href="{{ route('user.favorites.add', $plant->Plant_ID) }}" class="flex-1 border-2 border-[#729679] text-[#729679] px-6 py-3 rounded-xl hover:bg-[#c2d2c5] transition-all duration-300 font-semibold text-center flex items-center justify-center">
                                    @if($isFavorite)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="mr-2"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z"></path></svg>
                                        Remove from Favorites
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="mr-2"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                                        Add to Favorites
                                    @endif
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="mb-6">
                            <button disabled class="w-full bg-gray-400 text-white px-6 py-3 rounded-xl cursor-not-allowed font-semibold">
                                Out of Stock
                            </button>
                            
                            <a href="{{ route('user.favorites.add', $plant->Plant_ID) }}" class="block w-full border-2 border-emerald-500 text-emerald-500 px-6 py-3 rounded-xl hover:bg-emerald-50 transition-all duration-300 font-semibold text-center mt-4 flex items-center justify-center">
                                @if($isFavorite)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="mr-2"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z"></path></svg>
                                    Remove from Favorites
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 256 256" class="mr-2"><path d="M128,216S28,160,28,92A52,52,0,0,1,128,72h0A52,52,0,0,1,228,92C228,160,128,216,128,216Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"></path></svg>
                                    Add to Favorites
                                @endif
                            </a>
                        </div>
                    @endif
                    
                    <div class="bg-[#c2d2c5] rounded-xl p-6">
                        <div class="flex items-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#729679" viewBox="0 0 256 256" class="mr-3"><path d="M224,128a96,96,0,1,1-96-96A96,96,0,0,1,224,128Z"></path></svg>
                            <h3 class="font-bold text-gray-900">Evergreen Promise</h3>
                        </div>
                        <p class="text-gray-600 text-sm">
                            All our plants come with a 30-day guarantee. If your plant arrives damaged or dies within 30 days, we'll replace it free of charge.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Care Instructions Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">Plant Care Instructions</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                Follow these simple care instructions to keep your {{ $plant->Plant_Name }} healthy and thriving.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="h-48 bg-[#5d8765] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ffffff" viewBox="0 0 256 256"><path d="M184,184a32.06,32.06,0,0,1-32,32c-29.36,0-46.27-21.15-45.95-21.58a8,8,0,0,1,13.9,8c.45.79,10.05,13.58,32.05,13.58a16,16,0,0,0,0-32ZM248,88a8,8,0,0,0-8-8H229.9l-3.58-25.12A16,16,0,0,0,210.46,40H45.54A16,16,0,0,0,29.68,54.88L8.57,200.57A16,16,0,0,0,24.43,220H59.07a8,8,0,0,0,0-16H24.43L45.54,56H210.46l16.51,115.59A32,32,0,0,0,184,136a8,8,0,0,0,0,16,16,16,0,0,1,0,32H152a8,8,0,0,0,0,16h32a32.06,32.06,0,0,0,27.94-16.36l.16.36A16,16,0,0,0,227.57,204H96a8,8,0,0,0,0,16H227.57a32,32,0,0,0,31.72-36.92L248.38,99.2A8,8,0,0,0,248,88Z"></path></svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Watering</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Water your {{ $plant->Plant_Name }} once a week, allowing the soil to dry out between waterings. 
                        Reduce watering in winter. Overwatering can lead to root rot, so ensure proper drainage.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="h-48 bg-[#5d8765] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ffffff" viewBox="0 0 256 256"><path d="M120,56V24a8,8,0,0,1,16,0V56a8,8,0,0,1-16,0Zm72,72a8,8,0,0,0,8-8,48,48,0,0,0-48-48,8,8,0,0,0,0,16,32,32,0,0,1,32,32A8,8,0,0,0,192,128Zm24-8a8,8,0,0,1-8,8,8,8,0,0,1-8-8,64,64,0,0,0-64-64,8,8,0,0,1,0-16A80.09,80.09,0,0,1,216,120ZM176,184a32,32,0,0,1-32,32H112a32,32,0,0,1-32-32,32,32,0,0,1,8.34-21.55,32,32,0,0,1,24.09-52.32A32,32,0,0,1,160.66,99a32,32,0,0,1,15.19,63.36A32,32,0,0,1,176,184Z"></path></svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Light & Temperature</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Place in bright, indirect light. Avoid direct sunlight as it can scorch the leaves. 
                        Keep in temperatures between 65-80°F (18-27°C) and away from cold drafts.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="h-48 bg-[#5d8765] flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#ffffff" viewBox="0 0 256 256"><path d="M208,72H180.28c7.2-7.27,11.72-17.28,11.72-28a36,36,0,0,0-36-36c-14.25,0-26.37,8.36-32,20.41C118.37,16.36,106.25,8,92,8A36,36,0,0,0,56,44c0,10.72,4.52,20.73,11.72,28H48a16,16,0,0,0-16,16v32a16,16,0,0,0,16,16H64V224a16,16,0,0,0,16,16H176a16,16,0,0,0,16-16V136h16a16,16,0,0,0,16-16V88A16,16,0,0,0,208,72ZM156,44a20,20,0,0,1,0,40H124V64A20,20,0,0,1,156,44ZM92,28a20,20,0,0,1,20,20V84H80a20,20,0,0,1,0-40A20.06,20.06,0,0,1,92,28ZM48,120V88H80v32Zm128,104H80V88h96Zm32-104H176V88h32Z"></path></svg>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Soil & Fertilizer</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Use well-draining potting soil. Fertilize monthly during the growing season (spring and summer) 
                        with a balanced, water-soluble fertilizer diluted to half strength.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products Section -->
@if($relatedPlants->count() > 0)
<section class="py-16 bg-[#d7e1d9]">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">You May Also Like</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                Check out these similar plants that complement your {{ $plant->Plant_Name }}.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedPlants as $relatedPlant)
                <div class="group bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                    <a href="{{ route('user.shop.show', $relatedPlant->Plant_ID) }}" class="block">
                        <div class="relative overflow-hidden">
                            @if($relatedPlant->image->count() > 0)
                                <img src="{{ $relatedPlant->image->first()->image_url }}" alt="{{ $relatedPlant->Plant_Name }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-emerald-100 to-teal-100 flex items-center justify-center">
                                    <span class="text-6xl">🌱</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    </a>
                    <div class="p-6">
                        <a href="{{ route('user.shop.show', $relatedPlant->Plant_ID) }}" class="block">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $relatedPlant->Plant_Name }}</h3>
                        </a>
                        <div class="flex justify-between items-center mt-4">
                            <div class="text-xl font-bold text-[#5d8765]">${{ number_format($relatedPlant->Price, 0) }}</div>
                            @if($relatedPlant->Stock > 0)
                                <form action="{{ route('user.cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="plant_id" value="{{ $relatedPlant->Plant_ID }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="bg-[#729679] text-white px-4 py-2 rounded-full hover:[#c2d2c5] hover:[#c2d2c5] transition-all duration-300 font-medium">
                                        Add to Cart
                                    </button>
                                </form>
                            @else
                                <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-full cursor-not-allowed font-medium">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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