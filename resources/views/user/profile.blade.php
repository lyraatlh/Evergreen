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
                    <a href="{{ route('admin.profile.index') }}" class="text-emerald-600 font-semibold">Profile</a>
                @else
                    <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
                    <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                    <a href="{{ route('user.profile.index') }}" class="text-emerald-600 font-semibold">Profile</a>
                @endif
                <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600 transition-colors duration-300 font-medium">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="bg-emerald-600 text-white px-6 py-2 rounded-full hover:bg-emerald-700 transition-all duration-300 font-medium">Login</a>
                <a href="{{ route('register') }}" class="border-2 border-emerald-600 text-emerald-600 px-6 py-2 rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300 font-medium">Register</a>
            @endauth
        </nav>
    </div>
</header>

<!-- Modern Profile Section -->
<section class="py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
            <div class="text-center mb-12">
                <div class="w-32 h-32 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">Profile</h1>
                <p class="text-gray-600">Manage your account information</p>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-6">
                    <h2 class="text-2xl font-bold text-white">Account Information</h2>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4 text-gray-900 font-medium">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4 text-gray-900 font-medium">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div class="group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4">
                            <span class="inline-block bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-full text-sm font-semibold capitalize">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-semibold">
                                Edit Profile
                            </button>
                            <button class="flex-1 bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-6 py-3 rounded-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 font-semibold">
                                Change Password
                            </button>
                        </div>
                        
                        <form action="{{ route('auth.logout') }}" method="POST" class="mt-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white px-6 py-3 rounded-xl hover:from-red-600 hover:to-pink-600 transition-all duration-300 font-semibold">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Additional Profile Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🌱</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">12</h3>
                    <p class="text-gray-600">Plants Purchased</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📦</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">8</h3>
                    <p class="text-gray-600">Orders Completed</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⭐</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">4.8</h3>
                    <p class="text-gray-600">Average Rating</p>
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