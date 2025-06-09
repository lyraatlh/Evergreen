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
                    <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                    <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
                @endif
            @else
                <a href="{{ route('catalogs.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
                <a href="{{ route('shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition-all duration-300 font-medium">Login</a>
                <a href="{{ route('register') }}" class="border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 font-medium">Register</a>
            @endauth
        </nav>
    </div>
</header>

<!-- Modern Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-emerald-900/90 to-teal-900/90"></div>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://img.freepik.com/free-photo/tropical-green-leaves-background_53876-88891.jpg?t=st=1734387787~exp=1734391387~hmac=f3f269feeb25fa59a53660dfcabed0ec364c2d94ba92096a1a697ad52b577f74&w=900');"></div>
    
    <div class="relative z-10 container mx-auto px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-6xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Buy One, <br> 
                <span class="bg-gradient-to-r from-emerald-800 to-teal-500 bg-clip-text text-transparent">Plant One</span>
            </h1>
            <p class="text-xl text-gray-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                We are more than just a houseplant store – we are your partner in creating a greener world. By purchasing from us, you contribute directly to global reforestation efforts and environmental sustainability.
            </p>
            @auth
                <a href="{{ route('user.shop') }}" class="inline-block bg-gradient-to-r from-teal-500 to-emerald-800 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-emerald-600 hover:to-teal-600 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Order Now!
                </a>
            @else
                <a href="{{ route('shop') }}" class="inline-block bg-gradient-to-r from-emerald-800 to-teal-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-emerald-600 hover:to-teal-600 transform hover:scale-105 transition-all duration-300 shadow-xl">
                    Order Now!
                </a>
            @endauth
        </div>
    </div>
    
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#plants" class="text-white text-2xl">↓</a>
    </div>
</section>

<!-- Modern Content Section -->
<section id="plants" class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
            <div class="lg:col-span-1">
                <h3 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">Plants for the People</h3>
                <p class="text-gray-600 text-lg">We want our visitors to be inspired to get their hands dirty.</p>
            </div>

            <div class="lg:col-span-1">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                    <iframe 
                        class="w-full h-80"
                        src="https://www.youtube.com/embed/xbBdIG--b58" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-8 rounded-2xl">
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Each plant is cared <span class="text-emerald-600 font-bold text-2xl">🌿</span> for by our horticultural experts, so they are as happy and healthy as they get.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modern FAQ Section -->
<section class="py-40 bg-gradient-to-br from-gray-50 to-emerald-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Quality Plants & Sustainable Goods</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto leading-relaxed">
                We provide a thoughtfully curated selection of indoor and outdoor plants, along with eco-friendly handcrafted products that promote sustainability.
            </p>
        </div>

        <div class="max-w-4xl mx-auto space-y-4">
            <details class="group bg-white rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Ordering for Delivery?</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">We offer convenient delivery services for all your plant needs. Our expert packaging ensures your plants arrive safely and healthy.</p>
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Potting Services</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">
                        We offer potting services for your plants, whether purchased in-store or brought from home. Let us help you care for your greenery while promoting sustainable practices.
                    </p>
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
                    <span class="text-gray-900 font-semibold text-lg">Do we ship plants?</span>
                    <span class="text-emerald-600 group-open:rotate-180 transition-transform duration-300">↓</span>
                </summary>
                <div class="px-6 pb-6">
                    <p class="text-gray-600">Yes! We ship plants nationwide with special care packaging to ensure they arrive in perfect condition.</p>
                </div>
            </details>

            <details class="group bg-white rounded-2xl shadow-lg overflow-hidden">
                <summary class="flex justify-between items-center p-6 cursor-pointer hover:bg-gray-50 transition-colors duration-300">
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

<!-- Modern Contact Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <div class="relative bg-gradient-to-br from-emerald-900 to-teal-600 rounded-3xl shadow-2xl overflow-hidden p-16">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-cover bg-center opacity-30" style="background-image: url('https://img.freepik.com/free-photo/green-tropical-leaves-background_23-2148245263.jpg?t=st=1734400929~exp=1734404529~hmac=0e85f17dc4b5ce8d7650e2fa10f1f7a756daa1fdc8e38c947bf8dacb6fe0b1a0&w=900');"></div>
            <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-emerald-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="#000000" viewBox="0 0 256 256">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><line x1="128" y1="232" x2="128" y2="176" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M48,56h0a80,80,0,0,1,80,80v40a0,0,0,0,1,0,0h0A80,80,0,0,1,48,96V56A0,0,0,0,1,48,56Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M208,56h0a0,0,0,0,1,0,0V96a80,80,0,0,1-80,80h0a0,0,0,0,1,0,0V136a80,80,0,0,1,80-80Z" transform="translate(336 232) rotate(180)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="80 208 128 232 176 208" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M86.77,66C100,38,128,24,128,24s28,14,41.23,42" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>
                        </span>
                    </div>
                <h2 class="text-5xl font-bold text-white mb-6">Join the Green Movement!</h2>
                <p class="text-emerald-100 text-lg max-w-3xl mx-auto mb-8 leading-relaxed">
                    Subscribe to stay informed about sustainable living tips, environmental updates, tree-planting initiatives, and special offers.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4 mt-12">
                    <a href="https://www.instagram.com/lyraatlh__/profilecard/?igsh=MXBtbnd2N3RmeXV0NQ==" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-full px-6 py-3 text-white hover:bg-white/30 transition-all duration-300 font-medium">Instagram</a>
                    <a href="https://github.com/lyraatlh" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-full px-6 py-3 text-white hover:bg-white/30 transition-all duration-300 font-medium">GitHub</a>
                    <a href="https://pin.it/7nj0R4wp5" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-full px-6 py-3 text-white hover:bg-white/30 transition-all duration-300 font-medium">Pinterest</a>
                    <a href="#" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-full px-6 py-3 text-white hover:bg-white/30 transition-all duration-300 font-medium">Twitter</a>
                    <a href="#" class="bg-white/20 backdrop-blur-sm border border-white/30 rounded-full px-6 py-3 text-white hover:bg-white/30 transition-all duration-300 font-medium">Telegram</a>
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