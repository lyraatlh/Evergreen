@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-100">

<!-- Modern Header Section -->
<header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto py-4 flex justify-between items-center px-6">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-teal-500 to-emerald-900 bg-clip-text text-transparent">
            Evergreen
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
                    <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
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

<!-- Modern Shop Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-6xl font-bold text-gray-900 mb-6">New Plants</h1>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                Bring nature inside and shop our big selections of fresh indoor plants, including Instagram-worthy houseplants, pet-friendly plants, orchids, and one-of-a-kind rare plants.
            </p>
        </div>

        <!-- Modern Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Product Card 1 -->
            <div class="group bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="relative overflow-hidden">
                    <img src="https://img.freepik.com/free-photo/close-up-green-tropical-leaves_23-2148245248.jpg" alt="Peperomia Plants" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Peperomia Plants</h3>
                    <p class="text-gray-600 mb-4">Moist but well-drained</p>
                    <div class="flex justify-between items-center">
                        <p class="text-3xl font-bold text-emerald-600">$122</p>
                        <a href="#modal1" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="group bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="relative overflow-hidden">
                    <img src="https://img.freepik.com/free-photo/tropical-flora-plants_23-2148817616.jpg?t=st=1734394512~exp=1734398112~hmac=ec6b5e5cf9144e785ad405f96d2122d85068c682daa4b03f3b1efed4a1dc8cae&w=900" alt="Fiddle-Leaf Fig" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Fiddle-Leaf Fig</h3>
                    <p class="text-gray-600 mb-4">Medium moisture, well-draining</p>
                    <div class="flex justify-between items-center">
                        <p class="text-3xl font-bold text-emerald-600">$160</p>
                        <a href="#modal1" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">View Details</a>
                    </div>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="group bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
                <div class="relative overflow-hidden">
                    <img src="https://img.freepik.com/free-photo/front-view-tropical-plant-leaves_23-2148245149.jpg?t=st=1734396628~exp=1734400228~hmac=82ffcb72dbdd54fdc9128686bd3047a1f0138f023580d417829d2e3438e850db&w=900" alt="Calathea Orbifolia" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Calathea Orbifolia</h3>
                    <p class="text-gray-600 mb-4">Moist but well-drained</p>
                    <div class="flex justify-between items-center">
                        <p class="text-3xl font-bold text-emerald-600">$152</p>
                        <a href="#modal1" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">View Details</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Pagination -->
        <div class="flex justify-center space-x-3">
            <div class="w-4 h-4 bg-emerald-600 rounded-full"></div>
            <div class="w-4 h-4 bg-gray-300 rounded-full hover:bg-emerald-400 transition-colors duration-300 cursor-pointer"></div>
            <div class="w-4 h-4 bg-gray-300 rounded-full hover:bg-emerald-400 transition-colors duration-300 cursor-pointer"></div>
        </div>
    </div>
</section>

<!-- CSS-only Modal -->
<div id="modal1" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center opacity-0 invisible transition-all duration-300 z-50 target:opacity-100 target:visible">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 transform scale-95 target:scale-100 transition-transform duration-300">
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-3xl font-bold text-gray-900">Peperomia Plants</h3>
            <a href="#" class="text-gray-400 hover:text-gray-600 text-2xl">&times;</a>
        </div>
        <p class="text-gray-600 mb-6 leading-relaxed">Beautiful indoor plants perfect for your home or office. These plants are known for their easy care and stunning foliage.</p>
        <div class="flex justify-between items-center">
            <p class="text-3xl font-bold text-emerald-600">$122</p>
            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-8 py-3 rounded-full hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-medium">Add to Cart</button>
        </div>
    </div>
</div>

<!-- Modern Quality Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Quality Plants & Sustainable Goods</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                We provide a thoughtfully curated selection of indoor and outdoor plants, along with eco-friendly handcrafted products that promote sustainability.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <details class="group bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-100/50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Ordering for Delivery?</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">We offer convenient delivery services for all your plant needs. Our expert packaging ensures your plants arrive safely and healthy.</p>
                </div>
            </details>

            <details class="group bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-100/50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Potting Services</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">
                        We offer potting services for your plants, whether purchased in-store or brought from home. Let us help you care for your greenery while promoting sustainable practices.
                    </p>
                </div>
            </details>

            <details class="group bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-100/50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Do we ship plants?</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">Yes! We ship plants nationwide with special care packaging to ensure they arrive in perfect condition.</p>
                </div>
            </details>

            <details class="group bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-100/50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Ordering for Pick up?</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">You can place orders online and pick them up at our store. We'll have everything ready for you.</p>
                </div>
            </details>
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