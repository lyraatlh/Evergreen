<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tambahkan link ke CSS atau JS di sini -->
</head>
<body>
    <div class="container">
        @yield('content')  <!-- Konten dari view lain akan dimasukkan di sini -->
    </div>
</body>
</html>
