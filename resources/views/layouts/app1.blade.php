<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Eashion')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @livewireStyles
</head>
<body class="font-sans text-gray-900 bg-gray-50">
    <div class="bg-black py-2.5 px-4 text-center">
        <p class="text-[11px] font-bold tracking-[0.2em] text-white uppercase">
            Free shipping on orders over Rs.15000 • Limited time offer
        </p>
    </div>

    <nav class="sticky top-0 z-50 border-b border-gray-100 bg-white/80 backdrop-blur-xl transition-all duration-300" id="main-nav">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="items-center hidden gap-10 lg:flex">
                    <x-navbar />
                </div>

                <div class="absolute left-1/2 -translate-x-1/2">
                    <a href="{{ url('/') }}" class="group flex flex-col items-center">
                        <span class="text-3xl font-black tracking-[0.15em] text-black">EASHION</span>
                        <div class="h-0.5 w-0 bg-black transition-all duration-300 group-hover:w-full"></div>
                    </a>
                </div>

                <!-- Right Side: Icons & Actions -->
                <div class="flex items-center gap-2 sm:gap-6">
                    <!-- Search -->
                    <button class="p-2 text-gray-900 transition-all duration-300 rounded-full hover:bg-gray-100 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>

                    <!-- Cart -->
                    <a href="{{ url('/cart') }}" class="relative p-2 text-gray-900 transition-all duration-300 rounded-full hover:bg-gray-100 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 transition-transform group-hover:scale-110">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute top-1 right-1 bg-black text-white text-[9px] font-bold w-4 h-4 rounded-full flex items-center justify-center animate-pulse border-2 border-white">{{ $cartCount }}</span>
                        @endif
                    </a>

                    <!-- Profile -->
                    <div class="pl-2 ml-2 border-l border-gray-200">
                        <livewire:profile-dropdown />
                    </div>

                    <!-- Mobile Menu Button (Hamburger) -->
                    <button class="p-2 -mr-2 text-gray-900 lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="w-full">
        @yield('content')
    </main>
    <x-footer />
    @livewireScripts
</body>
</html>
