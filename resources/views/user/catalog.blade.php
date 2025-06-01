@extends('layouts.app')

@section('content')
<body class="bg-green-950 text-white">

<!-- Header Section -->
<header class="container mx-auto py-3 flex justify-between items-center px-4">
    <a href="{{ route('home') }}" class="text-white text-lg font-bold">Ever<span>green</span></a>
    <nav class="flex space-x-6"> 
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('catalogs.index') }}" class="hover:underline">Catalog</a>
                <a href="{{ route('plants.index') }}" class="hover:underline">Shop</a> 
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @else
                <a href="{{ route('catalogs.index') }}" class="hover:underline">Catalog</a>
                <a href="{{ route('plants.index') }}" class="hover:underline">Shop</a>
            @endif
            <a href="{{ route('profile') }}" class="hover:underline">Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        @else
            <a href="{{ route('catalogs.index') }}" class="hover:underline">Catalog</a>
            <a href="{{ route('plants.index') }}" class="hover:underline">Shop</a>
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        @endauth
    </nav>
</header>

<!-- Rest of the content remains the same -->
<!-- Each Plant Section -->
<section id="catalog" class="bg-gray-50 py-16 px-6">
    <div class="container mx-auto">
        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <button class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-600 transition">Outdoor Plant</button>
            <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">Indoor Plant</button>
            <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">Flower Pot</button>
            <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">Potted Plant</button>
            <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-full hover:bg-gray-300 transition">See All</button>
        </div>

        <!-- Plant Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Pet Friendly Plants -->
            <div class="relative bg-green-800 text-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Pet Friendly Plants</h3>
                    <p class="text-gray-200 text-sm mb-4">
                    There are many houseplants options for your home that are non-toxic. These plants will add life to your home while keeping your kids and pets safe.
                </p>
                    <span class="absolute bottom-4 left-6 bg-gray-800 px-4 py-1 rounded-full text-xs">Piperaceae</span>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-800">
                    →
                </div>
            </div>

            <!-- Card 2: Orchids -->
            <div class="relative bg-gray-800 text-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Orchids</h3>
                    <p class="text-gray-300 text-sm mb-4">
                    Orchids are easily everyone's favorite flowering plant. Find new orchids, and orchid success items in this collection.
                    </p>
                    <span class="absolute bottom-4 left-6 bg-gray-700 px-4 py-1 rounded-full text-xs">Araceae</span>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-800">
                    →
                </div>
            </div>

            <!-- Card 3: Succulents -->
            <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-2">Succulents</h3>
                    <p class="text-gray-300 text-sm mb-4">
                    All succulents are cacti, but not all cacti are succulents. Both make low-maintenance houseplants.
                    </p>
                    <span class="absolute bottom-4 left-6 bg-gray-700 px-4 py-1 rounded-full text-xs">Moraceae</span>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-800">
                    →
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Indoor Collection -->
<section class="bg-gray-100 py-16 px-6">
    <div class="container mx-auto">
        <!-- Judul Section -->
        <div class="text-center mb-8">
            <h2 class="text-5xl font-bold text-gray-900">Indoor Collection</h2>
            <p class="text-gray-600 mt-2">
            Check out our video content including informative webinars where you can learn more about your indoor plants.
        </p>
        </div>

        <!-- Grid Kartu Tanaman -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <!-- Card 1: Philodendron -->
            <div class="relative rounded-lg overflow-hidden shadow-lg">
                <img src="https://img.freepik.com/free-photo/monstera-deliciosa-plant-leaves-garden_53876-145000.jpg?t=st=1734394402~exp=1734398002~hmac=d20a19994b9f11fbe8fe3965717bbbbfd04a31c9883bde23c9fa4d1f3628c6c8&w=900" alt="Philodendron" class="w-full h-52 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 to-transparent p-6">
                    <h3 class="text-2xl font-bold text-white">Philodendron</h3>
                    <p class="text-gray-300 text-sm mt-2">
                    Philodendron comes in a variety of leaf shapes and colors, making it a great plant to compliment your home decor while also being low maintenance.
                    </p>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-900">
                    →
                </div>
            </div>

            <!-- Card 2: Calathea -->
            <div class="relative rounded-lg overflow-hidden shadow-lg">
                <img src="https://img.freepik.com/free-photo/tropical-flora-plants_23-2148817616.jpg?t=st=1734394512~exp=1734398112~hmac=ec6b5e5cf9144e785ad405f96d2122d85068c682daa4b03f3b1efed4a1dc8cae&w=900" alt="Calathea" class="w-full h-52 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 to-transparent p-6">
                    <h3 class="text-2xl font-bold text-white">Calathea</h3>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-900">
                    →
                </div>
            </div>

            <!-- Card 3: Air Purifying -->
            <div class="relative rounded-lg overflow-hidden shadow-lg">
                <img src="https://img.freepik.com/free-photo/close-up-pink-green-caladium-plants_209303-22.jpg?t=st=1734394548~exp=1734398148~hmac=c7fc04479812b43e237cad538f70f92a028378cb47c8162c01b139f1104e42c9&w=900" alt="Air Purifying Plants" class="w-full h-52 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 to-transparent p-6">
                    <h3 class="text-2xl font-bold text-white">Air Purifying</h3>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-900">
                    →
                </div>
            </div>
            
            <!-- Card 4: Low Light Tolerant -->
            <div class="relative rounded-lg overflow-hidden shadow-lg">
                <img src="https://img.freepik.com/free-photo/close-up-green-tropical-leaves_23-2148245248.jpg?t=st=1734394685~exp=1734398285~hmac=33901b44f634d185e7fbd6a5c495d8f5368548cee760b4fa9a9c3de56c40e626&w=900" alt="Low Light Tolerant" class="w-full h-52 object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-gray-900 to-transparent p-6">
                    <h3 class="text-2xl font-bold text-white">Low Light Tolerant</h3>
                </div>
                <div class="absolute top-4 right-4 flex items-center justify-center w-10 h-10 rounded-full bg-white text-gray-900">
                    →
                </div>
            </div>
        </div>
    </div>
</section>

<section id="faq" class="bg-gray-50 py-16 px-6">
    <div class="container mx-auto">
        <!-- Judul Section -->
        <div class="text-center mb-8">
            <h2 class="text-5xl font-bold text-gray-900">Quality Plants & Sustainable Goods</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto">
            We provide a thoughtfully curated selection of indoor and outdoor plants, along with eco-friendly handcrafted products that promote sustainability. Every purchase supports reforestation efforts, reduces carbon footprints, and inspires a greener lifestyle. From living art like terrariums and arrangements to practical green solutions, our offerings are designed to nurture both your space and the planet.
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-4">
            <!-- Item 1 -->
            <div class="border border-gray-300 rounded-lg p-4">
                <button class="w-full flex justify-between items-center text-left text-gray-900 font-bold text-lg">
                Ordering for Delivery?
                <span class="text-gray-600">→</span>
                </button>
            </div>

            <!-- Item 2 -->
            <div class="border border-gray-300 rounded-lg p-4">
                <button class="w-full flex justify-between items-center text-left text-gray-900 font-bold text-lg">
                Potting Services
                <span class="text-gray-600">→</span>
                </button>
                <p class="text-gray-600 mt-4 text-sm">
                We offer potting services for your plants, whether purchased in-store or brought from home. Let us help you <br>
                care for your greenery while promoting sustainable practices. Fees apply based on materials used, ensuring <br>
                eco-friendly options. Visit us or contact us for more details and join our mission for a greener planet.
                </p>
            </div>

            <!-- Item 3 -->
            <div class="border border-gray-300 rounded-lg p-4">
                <button class="w-full flex justify-between items-center text-left text-gray-900 font-bold text-lg">
                Do we ship plants?
                <span class="text-gray-600">→</span>
                </button>
            </div>

            <!-- Item 4 -->
            <div class="border border-gray-300 rounded-lg p-4">
                <button class="w-full flex justify-between items-center text-left text-gray-900 font-bold text-lg">
                Ordering for Pick up?
                <span class="text-gray-600">→</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section id="contact" class="bg-gray-50 py-10 px-6">
    <div class="container mx-auto text-center">
        <!-- Section Background and Content -->
        <div class="relative bg-cover bg-center rounded-lg shadow-lg overflow-hidden p-12" style="background-image: url('https://img.freepik.com/free-photo/green-tropical-leaves-background_23-2148245263.jpg?t=st=1734400929~exp=1734404529~hmac=0e85f17dc4b5ce8d7650e2fa10f1f7a756daa1fdc8e38c947bf8dacb6fe0b1a0&w=900');">
            <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-30"></div>

        <!-- Content -->
        <div class="relative z-10">
            <div class="flex justify-center mb-4">
                <!-- Icon -->
                <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-lg">
                <img src="{{ asset('logo1.png') }}">
                </div>
            </div>
            <h2 class="text-4xl font-bold text-white mb-4">Join the Green Movement!</h2>
            <p class="text-gray-200 max-w-2xl mx-auto">
                Subscribe to stay informed about sustainable living tips, environmental updates, tree-planting initiatives, and special offers. Together, let's create a greener future and inspire positive change for our planet.
            </p>
            </div>
        </div>

        <!-- Social Media Buttons -->
        <div class="mt-8 flex flex-wrap justify-center gap-4">
            <button class="border border-gray-300 rounded-full px-6 py-2 text-gray-700 hover:bg-gray-300 transition"> <a href="https://www.instagram.com/lyraatlh__/profilecard/?igsh=MXBtbnd2N3RmeXV0NQ==">Instagram</a> </button>
            <button class="border border-gray-300 rounded-full px-6 py-2 text-gray-700 hover:bg-gray-300 transition"> <a href="https://github.com/lyraatlh">GitHub</a> </button>
            <button class="border border-gray-300 rounded-full px-6 py-2 text-gray-700 hover:bg-gray-300 transition"> <a href="https://pin.it/grwUWgSCA">Pinterest</a> </button>
            <button class="border border-gray-300 rounded-full px-6 py-2 text-gray-700 hover:bg-gray-300 transition">Twitter</button>
            <button class="border border-gray-300 rounded-full px-6 py-2 text-gray-700 hover:bg-gray-300 transition">Telegram</button>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-green-950 text-gray-200 py-6 text-center">
    <p>&copy; 2024 Evergreen Life. All rights reserved.</p>
</footer>

<style>
    /* Modal Visibility */
    input#modal1:checked ~ #modal {
        opacity: 1;
        pointer-events: auto;
    }

    /* FAQ Summary */
    details summary {
        outline: none;
    }
</style>

</body>
@endsection