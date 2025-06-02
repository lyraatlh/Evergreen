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
            <button class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-8 py-3 rounded-full hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 font-medium shadow-lg">Outdoor Plant</button>
            <button class="bg-white text-gray-700 px-8 py-3 rounded-full hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300 font-medium shadow-lg border border-gray-200">Indoor Plant</button>
            <button class="bg-white text-gray-700 px-8 py-3 rounded-full hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300 font-medium shadow-lg border border-gray-200">Flower Pot</button>
            <button class="bg-white text-gray-700 px-8 py-3 rounded-full hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300 font-medium shadow-lg border border-gray-200">Potted Plant</button>
            <button class="bg-white text-gray-700 px-8 py-3 rounded-full hover:bg-emerald-50 hover:text-emerald-600 transition-all duration-300 font-medium shadow-lg border border-gray-200">See All</button>
        </div>

        <!-- Modern Plant Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-20">
            <div class="group relative bg-gradient-to-br from-emerald-600 to-emerald-800 text-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="p-8">
                    <h3 class="text-3xl font-bold mb-4">Pet Friendly Plants</h3>
                    <p class="text-emerald-100 mb-6 leading-relaxed">
                        There are many houseplants options for your home that are non-toxic. These plants will add life to your home while keeping your kids and pets safe.
                    </p>
                    <span class="inline-block bg-emerald-900/50 px-4 py-2 rounded-full text-sm font-medium">Piperaceae</span>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-gray-700 to-gray-900 text-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="p-8">
                    <h3 class="text-3xl font-bold mb-4">Orchids</h3>
                    <p class="text-gray-200 mb-6 leading-relaxed">
                        Orchids are easily everyone's favorite flowering plant. Find new orchids, and orchid success items in this collection.
                    </p>
                    <span class="inline-block bg-gray-800/50 px-4 py-2 rounded-full text-sm font-medium">Araceae</span>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>

            <div class="group relative bg-gradient-to-br from-slate-800 to-slate-900 text-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="p-8">
                    <h3 class="text-3xl font-bold mb-4">Succulents</h3>
                    <p class="text-gray-200 mb-6 leading-relaxed">
                        All succulents are cacti, but not all cacti are succulents. Both make low-maintenance houseplants.
                    </p>
                    <span class="inline-block bg-slate-700/50 px-4 py-2 rounded-full text-sm font-medium">Moraceae</span>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern Indoor Collection -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Indoor Collection</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Check out our video content including informative webinars where you can learn more about your indoor plants.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                <img src="https://img.freepik.com/free-photo/monstera-deliciosa-plant-leaves-garden_53876-145000.jpg?t=st=1734394402~exp=1734398002~hmac=d20a19994b9f11fbe8fe3965717bbbbfd04a31c9883bde23c9fa4d1f3628c6c8&w=900" alt="Philodendron" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-3xl font-bold text-white mb-3">Philodendron</h3>
                    <p class="text-gray-200 leading-relaxed">
                        Philodendron comes in a variety of leaf shapes and colors, making it a great plant to compliment your home decor.
                    </p>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>

            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                <img src="https://img.freepik.com/free-photo/tropical-flora-plants_23-2148817616.jpg?t=st=1734394512~exp=1734398112~hmac=ec6b5e5cf9144e785ad405f96d2122d85068c682daa4b03f3b1efed4a1dc8cae&w=900" alt="Calathea" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-3xl font-bold text-white mb-3">Calathea</h3>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>

            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                <img src="https://img.freepik.com/free-photo/close-up-pink-green-caladium-plants_209303-22.jpg?t=st=1734394548~exp=1734398148~hmac=c7fc04479812b43e237cad538f70f92a028378cb47c8162c01b139f1104e42c9&w=900" alt="Air Purifying Plants" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-3xl font-bold text-white mb-3">Air Purifying</h3>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
                </div>
            </div>
            
            <div class="group relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-105 transition-all duration-500">
                <img src="https://img.freepik.com/free-photo/close-up-green-tropical-leaves_23-2148245248.jpg?t=st=1734394685~exp=1734398285~hmac=33901b44f634d185e7fbd6a5c495d8f5368548cee760b4fa9a9c3de56c40e626&w=900" alt="Low Light Tolerant" class="w-full h-80 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-8">
                    <h3 class="text-3xl font-bold text-white mb-3">Low Light Tolerant</h3>
                </div>
                <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center group-hover:bg-white/30 transition-all duration-300">
                    <span class="text-white text-xl">→</span>
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