<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Maison d\'hôtes') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700|playfair-display:400,400i,600,600i,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-dark-900 antialiased bg-white selection:bg-brand-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:flex-row">
            
            <!-- Left Panel: Hospitality Image Focus -->
            <div class="hidden sm:flex sm:w-1/2 lg:w-3/5 bg-dark-900 relative overflow-hidden items-end border-r border-gray-100">
                <!-- High quality luxury home image (Placeholder from Unsplash) -->
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');"></div>
                <!-- Dark gradient overlay for text readability -->
                <div class="absolute inset-0 bg-gradient-to-t from-dark-900/90 via-dark-900/40 to-dark-900/20"></div>

                <div class="relative z-10 p-12 lg:p-20 text-white w-full">
                    <a href="/" class="inline-flex items-center gap-2 mb-12 opacity-90 hover:opacity-100 transition-opacity">
                        <div class="w-3 h-3 rounded-full bg-brand-400"></div>
                        <span class="text-xl font-serif tracking-wide">Maison d'hôtes</span>
                    </a>
                    
                    <p class="text-brand-400 text-sm font-semibold tracking-widest uppercase mb-4 animate-fade-in-up" style="animation-delay: 100ms;">
                        Destinations en Tunisie
                    </p>
                    <h1 class="text-5xl lg:text-6xl font-serif text-white tracking-tight leading-tight mb-6 animate-fade-in-up" style="animation-delay: 200ms;">
                        Vivez l'authenticité<br />
                        <span class="italic text-brand-300 font-light">tunisienne</span>
                    </h1>
                    <p class="text-lg text-gray-300 max-w-md animate-fade-in-up" style="animation-delay: 300ms;">
                        Des maisons d'hôtes soigneusement sélectionnées pour une expérience inoubliable.
                    </p>
                </div>
            </div>

            <!-- Right Panel: Form area -->
            <div class="w-full sm:w-1/2 lg:w-2/5 flex flex-col justify-center items-center p-6 lg:p-12 bg-white shrink-0 shadow-[-20px_0_40px_-5px_rgba(0,0,0,0.05)] sm:shadow-none z-10 relative">
                
                <!-- Mobile Header -->
                <div class="sm:hidden mb-10 text-center animate-fade-in-up w-full">
                    <a href="/" class="inline-flex items-center justify-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-brand-500"></div>
                        <span class="text-2xl font-serif text-dark-900 tracking-wide">Maison d'hôtes</span>
                    </a>
                </div>

                <!-- Form Container -->
                <div class="w-full max-w-md animate-fade-in">
                    {{ $slot }}
                </div>
                
                <!-- Footer area -->
                <div class="mt-16 text-sm text-gray-400 animate-fade-in text-center w-full max-w-md">
                    &copy; {{ date('Y') }} Maison d'hôtes. Tous droits réservés.
                </div>
            </div>
        </div>
    </body>
</html>
