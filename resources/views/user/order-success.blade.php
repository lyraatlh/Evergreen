@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#d7e1d9]">

<!-- Modern Header Section -->
<header class="backdrop-blur-md bg-white/90 shadow-lg sticky top-0 z-50">
    <div class="container mx-auto py-4 flex justify-between items-center px-6">
        <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-teal-500 to-emerald-900 bg-clip-text text-transparent">
            Evergreen
        </a>
        <nav class="flex space-x-8"> 
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Home</a>
            <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
            <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
            <a href="{{ route('user.profile.index') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Profile</a>
            <a href="{{ route('user.cart') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Cart</a>
        </nav>
    </div>
</header>

<!-- Order Success Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="bg-[#729679] p-8 text-center">
                <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-5xl text-[#729679]">✓</span>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Order Successful!</h1>
                <p class="text-emerald-100 text-lg">Thank you for your purchase.</p>
            </div>
            
            <div class="p-8 text-center">
                <p class="text-gray-600 text-lg mb-8">
                    Your order has been placed successfully. We'll process it right away and send you a confirmation email with tracking details.
                </p>
                
                @if($showDonation)
                    <div class="bg-gradient-to-br from-emerald-900 to-teal-900 text-white rounded-2xl p-8 mb-8">
                        <div class="flex items-center justify-center mb-4">
                            <span class="text-5xl mr-4"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="#FAFAFA" viewBox="0 0 256 256"><path d="M198.1,62.59a76,76,0,0,0-140.2,0A71.71,71.71,0,0,0,16,127.8C15.9,166,48,199,86.14,200A72.09,72.09,0,0,0,120,192.47V232a8,8,0,0,0,16,0V192.47A72.17,72.17,0,0,0,168,200l1.82,0C208,199,240.11,166,240,127.8A71.71,71.71,0,0,0,198.1,62.59ZM169.45,184a56.08,56.08,0,0,1-33.45-10v-41l43.58-21.78a8,8,0,1,0-7.16-14.32L136,115.06V88a8,8,0,0,0-16,0v51.06L83.58,120.84a8,8,0,1,0-7.16,14.32L120,156.94v17a56,56,0,0,1-33.45,10C56.9,183.23,31.92,157.52,32,127.84A55.77,55.77,0,0,1,67.11,76a8,8,0,0,0,4.53-4.67,60,60,0,0,1,112.72,0A8,8,0,0,0,188.89,76,55.79,55.79,0,0,1,224,127.84C224.08,157.52,199.1,183.23,169.45,184Z"></path></svg></span>
                            <h2 class="text-2xl font-bold">You've Made a Difference!</h2>
                        </div>
                        <p class="text-white-100 mb-4">
                            Because you purchased 3 or more plants, Evergreen has donated a tree seedling to our local reforestation project.
                        </p>
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6">
                            <p class="text-sm text-white-100">
                                Your contribution helps combat climate change and supports biodiversity. Together, we're making the world a greener place!
                            </p>
                        </div>
                    </div>
                @endif
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('user.catalog') }}" class="bg-[#729679] text-white px-8 py-3 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-medium">
                        Continue Shopping
                    </a>
                    <a href="{{ route('user.profile.index') }}" class="border-2 border-[#729679] text-[#729679] px-8 py-3 rounded-full hover:bg-[#c2d2c5] hover:text-white transition-all duration-300 font-medium">
                        View Profile
                    </a>
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