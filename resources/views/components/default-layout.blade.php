@props(['title', 'section_title' => 'Menu'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/fill/style.css">
    <title>{{ $title }}</title>

    <style>
        /* General Layout & Styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f8ff; /* Light blue background */
            color: #333; /* Dark text */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #e0f7fa; /* Soft blue background */
            border-bottom: 2px solid #b2ebf2; /* Light border for definition */
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #00796b; /* Dark teal for the logo */
        }

        nav {
            font-size: 16px;
        }

        nav ul {
            list-style: none;
            padding-left: 0;
            display: flex;
            gap: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #00796b;
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #b2dfdb; /* Hover effect on links */
        }

        /* Mobile Menu */
        .sm:hidden {
            display: block;
        }

        .sm:flex {
            display: none;
        }

        .sm:hidden ul {
            position: absolute;
            top: 60px;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 250px;
            padding: 10px;
        }

        .sm:hidden ul li {
            padding: 8px;
        }

        .sm:hidden ul li a {
            text-decoration: none;
            color: #00796b;
        }

        .sm:hidden ul li a:hover {
            background-color: #b2dfdb;
        }

        /* Main Content Section */
        section {
            padding: 30px 40px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            margin-top: 30px;
        }

        .text-3xl {
            font-size: 2rem;
            font-weight: 700;
            color: #00796b;
        }

        /* Button Styling */
        .btn {
            background-color: #00796b;
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #004d40;
        }

        /* For table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            text-align: left;
        }

        table th {
            background-color: #e0f7fa;
            color: #00796b;
            font-weight: bold;
        }

        table td {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background-color: #f1f8ff;
        }
    </style>

</head>

<body>
    <main>
        <header x-data="{ open: false }"
            class="flex items-center justify-between sm:justify-start gap-8 bg-white border-b
            border-zinc-300 sticky top-0 px-3 sm:px-8 py-4">
        <h2 class="text-lg sm:text-xl font-bold">Ever<span>green</span></h2>
        <!-- desktop navigation -->
            <nav>
                <ul class="hidden sm:flex">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('dashboard') ? 'text-black' : 'text-zinc-500' }} block px-2 py-1 rounded font-semibold hover:text-black text-sm">
                        Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.plants.index') }}" class="{{ request()->is('plants') ? 'text-black' : 'text-zinc-500' }} block px-2 py-1 rounded font-semibold hover:text-black text-sm">
                        Plants
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.catalogs.index') }}" class="{{ request()->is('majors') ? 'text-black' : 'text-zinc-500' }} block px-2 py-1 rounded font-semibold hover:text-black text-sm">
                        Catalogs
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile.index') }}" class="{{ request()->is('profile') ? 'text-black' : 'text-zinc-500' }} block px-2 py-1 rounded font-semibold hover:text-black text-sm">
                        Profile
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- hamburger menu -->
            <button x-on:click="open = !open" class="block sm:hidden bg-slate-50 border border-slate-400 p-2">
                <i class="ph ph-list block text-slate-400"></i>
            </button>

            <!-- mobile navigation -->
            <div x-show="open" class="bg-white border border-zinc-300 shadow-lg sm:hidden absolute top-12 right-3">
                <ul class="flex flex-col gap-2 py-2 px-4">
                    <li x-on:click="open = !open">
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-zinc-600 text-sm hover:bg-gray-100">
                        Dashboard
                        </a>
                    </li>
                    <li x-on:click="open = !open">
                        <a href="{{ route('admin.plants.index') }}" class="block px-4 py-2 text-zinc-600 text-sm hover:bg-gray-100">
                        Plants
                        </a>
                    </li>
                    <li x-on:click="open = !open">
                        <a href="{{ route('admin.catalogs.index') }}" class="block px-4 py-2 text-zinc-600 text-sm hover:bg-gray-100">
                        Catalogs
                        </a>
                    </li>
                    <li x-on:click="open = !open">
                        <a href="{{ route('admin.profile.index') }}" class="block px-4 py-2 text-zinc-600 text-sm hover:bg-gray-100">
                        Profile
                        </a>
                    </li>
                </ul>
            </div>
        </header>
        <section class="px-3 sm:px-8 py-4 flex flex-col gap-6">
            <h1 class="text-3xl font-bold">{{ $section_title }}</h1>
            {{ $slot }}
        </section>
    </main>
</body>
</html>