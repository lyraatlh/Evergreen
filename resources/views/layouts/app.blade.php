<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Evergreen') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN (untuk memastikan CSS muncul) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    <!-- Custom CSS untuk memastikan style bekerja -->
    <style>
        /* Base Styles */
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Gradient Text */
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(to right, #059669, #0d9488);
        }
        
        /* Backdrop Blur */
        .backdrop-blur {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
        /* Gradient Backgrounds */
        .bg-gradient-emerald {
            background-image: linear-gradient(to bottom right, #ecfdf5, #ccfbf1);
        }
        
        .bg-gradient-emerald-dark {
            background-image: linear-gradient(to right, #065f46, #115e59);
        }
        
        .bg-gradient-emerald-button {
            background-image: linear-gradient(to right, #10b981, #14b8a6);
        }
        
        .bg-gradient-emerald-button:hover {
            background-image: linear-gradient(to right, #059669, #0d9488);
        }
        
        /* Transitions */
        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
        
        /* Transforms */
        .hover-scale:hover {
            transform: scale(1.05);
        }
        
        /* Shadows */
        .shadow-custom {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        
        /* CSS-only Modal */
        #modal1:target {
            opacity: 1;
            visibility: visible;
        }
        
        #modal1:target .modal-content {
            transform: scale(1);
        }
        
        /* Details/Summary Accordion */
        details summary {
            cursor: pointer;
            list-style: none;
        }
        
        details summary::-webkit-details-marker {
            display: none;
        }
        
        details[open] .rotate-arrow {
            transform: rotate(180deg);
        }
    </style>
    
    @yield('styles')
</head>
<body>
    @yield('content')
    
    @yield('scripts')
</body>
</html>