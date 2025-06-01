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

<!-- New Plants -->
<section id="shop" class="bg-gray-50 py-16 px-6">
    <div class="container mx-auto">
        <!-- Judul Section -->
        <div class="text-center mb-9">
            <h2 class="text-6xl font-bold text-gray-900">New Plants</h2>
            <p class="text-gray-600 mt-2">
            Bring nature inside and shop our big selections of fresh indoor plants, including Instagram-worthy houseplants, pet-friendly plants, orchids, and one-of-a-kind rare plants.
            </p>
        </div>

        <!-- Grid Kartu Tanaman -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Peperomia Plants -->
            <div class="relative bg-white rounded-lg shadow-lg border overflow-hidden">
                <label for="modal1" class="cursor-pointer">
                    <img src="https://img.freepik.com/free-photo/close-up-green-tropical-leaves_23-2148245248.jpg" alt="Plant" class="w-full h-52 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800">Peperomia Plants</h3>
                        <p class="text-gray-600 text-sm">Moist but well-drained</p>
                        <p class="text-gray-900 font-bold mt-2">$122,056</p>
                    </div>
                </label>
            </div>

            <!-- Card 2: Fiddle-Leaf Fig -->
            <div class="relative bg-white rounded-lg shadow-lg border overflow-hidden">
                <label for="modal1" class="cursor-pointer">
                    <img src="https://img.freepik.com/free-photo/tropical-flora-plants_23-2148817616.jpg?t=st=1734394512~exp=1734398112~hmac=ec6b5e5cf9144e785ad405f96d2122d85068c682daa4b03f3b1efed4a1dc8cae&w=900" alt="Fiddle-Leaf Fig" class="w-full h-52 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800">Fiddle-Leaf Fig</h3>
                        <p class="text-gray-600 text-sm">Medium moisture, well-draining</p>
                        <p class="text-gray-900 font-bold mt-2">$160,265</p>
                    </div>
                </label>
            </div>

            <!-- Card 3: Calathea Orbifolia -->
            <div class="relative bg-white rounded-lg shadow-lg border overflow-hidden">
                <label for="modal1" class="cursor-pointer">
                    <img src="https://img.freepik.com/free-photo/front-view-tropical-plant-leaves_23-2148245149.jpg?t=st=1734396628~exp=1734400228~hmac=82ffcb72dbdd54fdc9128686bd3047a1f0138f023580d417829d2e3438e850db&w=900" alt="Calathea Orbifolia" class="w-full h-52 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800">Calathea Orbifolia</h3>
                        <p class="text-gray-600 text-sm">Moist but well-drained</p>
                        <p class="text-gray-900 font-bold mt-2">$152,056</p>
                    </div>
                </label>
            </div>
        </div>

        <!-- Navigasi Bawah -->
        <div class="flex justify-center mt-6 space-x-3">
            <span class="w-3 h-3 bg-gray-900 rounded-full"></span>
            <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
            <span class="w-3 h-3 bg-gray-300 rounded-full"></span>
        </div>

        <!-- Modal Popup -->
        <input type="checkbox" id="modal1" class="hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-300 z-50" id="modal">
            <div class="bg-white rounded-lg p-6 max-w-md w-full relative">
                <label for="modal1" class="absolute top-2 right-2 text-gray-600 cursor-pointer text-xl">&times;</label>
                <h3 class="text-2xl font-bold mb-4">Peperomia Plants</h3>
                <p class="text-gray-700">Beautiful indoor plants perfect for your home or office.</p>
                <p class="text-gray-900 font-bold mt-4">$122,056</p>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("editPlantId").value = this.dataset.id;
                document.getElementById("editPlantName").value = this.dataset.name;
                document.getElementById("editPlantDescription").value = this.dataset.description;
                document.getElementById("editPlantPrice").value = this.dataset.price;
                document.getElementById("editPlantImage").src = this.dataset.image;
                document.getElementById("editPlantForm").action = `/plants/${this.dataset.id}`;
            });
        });
    });
</script>

</body>
@endsection