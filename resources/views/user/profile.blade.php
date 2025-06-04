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
                    <a href="{{ route('admin.profile.index') }}" class="text-emerald-600 font-semibold">Profile</a>
                @else
                    <a href="{{ route('user.catalog') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Catalog</a>
                    <a href="{{ route('user.shop') }}" class="text-gray-700 hover:text-emerald-600 transition-colors duration-300 font-medium">Shop</a>
                    <a href="{{ route('user.profile.index') }}" class="text-emerald-600 font-semibold">Profile</a>
                @endif
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
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
            <!-- Profile Header -->
            <div class="text-center mb-12">
                <div class="w-32 h-32 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-2">My Profile</h1>
                <p class="text-gray-600">Manage your account information</p>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl mb-8 shadow-lg">
                    <div class="flex items-center">
                        <span class="text-emerald-500 mr-3">✓</span>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Profile Information Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 p-6">
                    <h2 class="text-2xl font-bold text-white">Account Information</h2>
                </div>
                
                <div class="p-8 space-y-6">
                    <!-- Display Mode -->
                    <div id="display-mode">
                        <div class="group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4 text-gray-900 font-medium">
                                {{ $user->name }}
                            </div>
                        </div>

                        <div class="group mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                            <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl px-4 py-4 text-gray-600 font-medium">
                                {{ $user->email }}
                                <span class="text-xs text-gray-500 block mt-1">Email cannot be changed</span>
                            </div>
                        </div>

                        <div class="group mt-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4">
                                <span class="inline-block bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-full text-sm font-semibold capitalize">
                                    {{ $user->role }}
                                </span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-gray-200">
                            <button onclick="toggleEditMode()" class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-semibold">
                                Edit Profile
                            </button>
                        </div>
                    </div>

                    <!-- Edit Mode -->
                    <div id="edit-mode" class="hidden">
                        <form action="{{ route('user.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    class="w-full bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 rounded-xl px-4 py-4 text-gray-900 font-medium focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300"
                                    required
                                >
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="group mt-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <div class="bg-gradient-to-r from-gray-50 to-gray-100 border border-gray-200 rounded-xl px-4 py-4 text-gray-600 font-medium">
                                    {{ $user->email }}
                                    <span class="text-xs text-gray-500 block mt-1">Email cannot be changed</span>
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-200">
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <button type="submit" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 font-semibold">
                                        Save Changes
                                    </button>
                                    <button type="button" onclick="toggleEditMode()" class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-300 font-semibold">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Actions -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-blue-500 p-6">
                    <h2 class="text-2xl font-bold text-white">Account Actions</h2>
                </div>
                
                <div class="p-8">
                    <form action="{{ route('auth.logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-red-500 text-white px-6 py-3 rounded-xl hover:from-red-600 hover:to-red-600 transition-all duration-300 font-semibold">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Profile Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                            <path d="M247.63,47.89a8,8,0,0,0-7.52-7.52c-51.76-3-93.32,12.74-111.18,42.22-11.8,19.49-11.78,43.16-.16,65.74a71.34,71.34,0,0,0-14.17,27L98.33,159c7.82-16.33,7.52-33.35-1-47.49-13.2-21.79-43.67-33.47-81.5-31.25a8,8,0,0,0-7.52,7.52c-2.23,37.83,9.46,68.3,31.25,81.5A45.82,45.82,0,0,0,63.44,176,54.58,54.58,0,0,0,87,170.33l25,25V224a8,8,0,0,0,16,0V194.51a55.61,55.61,0,0,1,12.27-35,73.91,73.91,0,0,0,33.31,8.4,60.9,60.9,0,0,0,31.83-8.86C234.89,141.21,250.67,99.65,247.63,47.89ZM47.81,155.6C32.47,146.31,23.79,124.32,24,96c28.32-.24,50.31,8.47,59.6,23.81,4.85,8,5.64,17.33,2.46,26.94L61.65,122.34a8,8,0,0,0-11.31,11.31l24.41,24.41C65.14,161.24,55.82,160.45,47.81,155.6Zm149.31-10.22c-13.4,8.11-29.15,8.73-45.15,2l53.69-53.7a8,8,0,0,0-11.31-11.31L140.65,136c-6.76-16-6.15-31.76,2-45.15,13.94-23,47-35.82,89.33-34.83C232.94,98.34,220.14,131.44,197.12,145.38Z"></path></svg>
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">12</h3>
                    <p class="text-gray-600">Plants Purchased</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                            <path d="M223.68,66.15,135.68,18a15.88,15.88,0,0,0-15.36,0l-88,48.17a16,16,0,0,0-8.32,14v95.64a16,16,0,0,0,8.32,14l88,48.17a15.88,15.88,0,0,0,15.36,0l88-48.17a16,16,0,0,0,8.32-14V80.18A16,16,0,0,0,223.68,66.15ZM128,32l80.34,44-29.77,16.3-80.35-44ZM128,120,47.66,76l33.9-18.56,80.34,44ZM40,90l80,43.78v85.79L40,175.82Zm176,85.78h0l-80,43.79V133.82l32-17.51V152a8,8,0,0,0,16,0V107.55L216,90v85.77Z"></path></svg>
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">8</h3>
                    <p class="text-gray-600">Orders Completed</p>
                </div>

                <div class="bg-white rounded-2xl shadow-lg p-6 text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                            <path d="M239.18,97.26A16.38,16.38,0,0,0,224.92,86l-59-4.76L143.14,26.15a16.36,16.36,0,0,0-30.27,0L90.11,81.23,31.08,86a16.46,16.46,0,0,0-9.37,28.86l45,38.83L53,211.75a16.38,16.38,0,0,0,24.5,17.82L128,198.49l50.53,31.08A16.4,16.4,0,0,0,203,211.75l-13.76-58.07,45-38.83A16.43,16.43,0,0,0,239.18,97.26Zm-15.34,5.47-48.7,42a8,8,0,0,0-2.56,7.91l14.88,62.8a.37.37,0,0,1-.17.48c-.18.14-.23.11-.38,0l-54.72-33.65a8,8,0,0,0-8.38,0L69.09,215.94c-.15.09-.19.12-.38,0a.37.37,0,0,1-.17-.48l14.88-62.8a8,8,0,0,0-2.56-7.91l-48.7-42c-.12-.1-.23-.19-.13-.5s.18-.27.33-.29l63.92-5.16A8,8,0,0,0,103,91.86l24.62-59.61c.08-.17.11-.25.35-.25s.27.08.35.25L153,91.86a8,8,0,0,0,6.75,4.92l63.92,5.16c.15,0,.24,0,.33.29S224,102.63,223.84,102.73Z"></path></svg>
                        </span>
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

<script>
function toggleEditMode() {
    const displayMode = document.getElementById('display-mode');
    const editMode = document.getElementById('edit-mode');
    
    if (displayMode.classList.contains('hidden')) {
        displayMode.classList.remove('hidden');
        editMode.classList.add('hidden');
    } else {
        displayMode.classList.add('hidden');
        editMode.classList.remove('hidden');
    }
}
</script>
@endsection