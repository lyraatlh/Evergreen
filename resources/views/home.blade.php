@extends('layouts.app') <!-- Menggunakan layout app.blade.php -->

@section('content')
<body class="bg-green-950 text-white">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evergreen Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-950 text-white">

<!-- Header Section -->
<header class="container mx-auto py-3 flex justify-between items-center px-4">
    <a href="{{ url('/') }}" class="text-white text-lg font-bold">Ever<span>green</span></a>
    <nav class="flex space-x-6"> 
        <a href="{{ route('home') }}" class="hover:underline">Home</a>
        @auth
            @if(Auth::user()->isAdmin())
                <a href="{{ route('catalogs.index') }}" class="hover:underline">Catalog</a>
                <a href="{{ route('plants.index') }}" class="hover:underline">Shop</a> 
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            @endif
            <a href="{{ route('profile') }}" class="hover:underline">Profile</a>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Register</a>
        @endauth
    </nav>
</header>

<!-- Hero Section -->
<section id="home" class="relative bg-cover bg-center h-[100vh]" style="background-image: url('https://img.freepik.com/free-photo/tropical-green-leaves-background_53876-88891.jpg?t=st=1734387787~exp=1734391387~hmac=f3f269feeb25fa59a53660dfcabed0ec364c2d94ba92096a1a697ad52b577f74&w=900');">
    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
    <div class="relative container mx-auto px-6 flex items-center h-full">
        <div class="text-left">
            <h1 class="text-6xl font-bold text-white mb-4">Buy One, <br> <span class="text-green-800">Plant One</span></h1>
            <p class="text-gray-300 text-lg mb-6 w-2/3">
                We are more than just a houseplant store – we are your partner in creating a greener world. By purchasing from us, you contribute directly to global reforestation efforts and environmental sustainability. Every product you buy plants a tree, reducing carbon footprints, restoring ecosystems, and inspiring positive change for future generations.
            </p>
            <a href="{{ url('/shop') }}" class="bg-white text-green-900 hover:bg-gray-300 px-6 py-3 rounded-lg text-lg">
            Order Now!
            </a>
            <div class="absolute bottom-10 text-center w-full">
                <a href="#plants" class="inline-block animate-bounce text-gray-300">↓</a>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section id="plants" class="bg-gray-100 py-16 px-6">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
        <!-- Teks Kiri -->
        <div class="col-span-1">
            <h3 class="text-3xl font-bold text-gray-900 mb-4">Plants for the People</h3>
            <p class="text-gray-600">We want our visitors to be inspired to get their hands dirty.</p>
        </div>

    <div class="relative md:w-4/3 group">
        <!-- Video -->
        <video
            src="video.mp4"
            poster="bg.jpg"
            controls 
            class="w-full h-100 object-cover rounded-lg shadow-lg">
            Your browser does not support the video tag.
        </video>

        <div class="absolute inset-0 flex items-center justify-center opacity-100 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
            <div class="group-hover:opacity-100 group-focus-within:opacity-100 opacity-100 transition duration-300 pointer-events-auto">
            </div>
        </div>
    </div>
    
    <!-- Teks Kanan -->
    <div class="col-span-1">
        <p class="text-gray-700 text-lg">
            Each plant is cared <span class="text-green-600 font-bold">🌿</span> for by our horticultural experts, so they are as happy as healthy as they get.
        </p>
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

<!-- JavaScript to handle button click -->
<script>
    document.getElementById("orderNowBtn").addEventListener("click", function() {
        window.location.href = "{{ url('/shop') }}";
    });
</script>

</body>
</html>