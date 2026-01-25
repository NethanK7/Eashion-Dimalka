@extends('layouts.app1')
@section('title', 'EASHION | Home')
@section('content')
    <!-- Hero Section -->
    <div class="relative w-full h-[600px] bg-gray-100 overflow-hidden">
        <img src="{{ asset('images/mainimage.jpg') }}" alt="New Collection" class="object-cover w-full h-full">
        <div class="absolute inset-0 flex items-center justify-center bg-black/10">
            <div class="px-4 text-center text-white">
                <h1 class="mb-4 text-5xl font-bold tracking-tight uppercase md:text-7xl drop-shadow-lg">
                    New Arrivals
                </h1>
                <p class="mb-8 text-lg font-medium tracking-wide md:text-xl drop-shadow-md">
                    Explore the latest trends in fashion.
                </p>
                <a href="{{ url('#') }}" class="inline-block px-10 py-4 font-bold tracking-wider text-black uppercase transition duration-300 transform bg-white hover:bg-black hover:text-white hover:scale-105">
                    Shop Now
                </a>
            </div>
        </div>
    </div>

    <!-- Collection Section -->
    <section class="px-4 py-20 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col items-center justify-between gap-6 mb-16 md:flex-row md:items-end">
            <div class="text-center md:text-left">
                <span class="text-[10px] font-bold tracking-[0.4em] text-gray-400 uppercase block mb-2">Editor's Choice</span>
                <h2 class="text-4xl font-black tracking-tight text-gray-900 uppercase">New Collection</h2>
                <div class="w-12 h-1 mx-auto mt-4 bg-black md:hidden"></div>
            </div>
            <a href="{{ url('/products') }}" class="group relative py-2 text-xs font-bold tracking-[0.2em] text-black uppercase">
                Explore All
                <span class="absolute bottom-0 left-0 w-full h-0.5 bg-black transition-transform origin-right scale-x-0 group-hover:scale-x-100 group-hover:origin-left duration-300"></span>
            </a>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
            <a href="{{ route('product.show', $product->id) }}">
                <div class="relative flex flex-col group">
                    <!-- Product Image Container -->
                    <div class="aspect-[3/4] w-full overflow-hidden bg-gray-50 relative rounded-sm">
                        <!-- Discount Badge -->
                        @if($product->discount > 0)
                            <div class="absolute top-4 left-4 z-10 bg-black text-white px-2.5 py-1 text-[9px] font-black tracking-widest uppercase">
                                -{{ $product->discount }}%
                            </div>
                        @endif

                        <!-- Wishlist Button (Icon) -->
                        <button class="absolute top-4 right-4 z-10 p-2 bg-white/80 backdrop-blur-md rounded-full text-black opacity-0 transform translate-y-[-10px] group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:bg-black hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>

                        <img src="{{ $product->image_path }}" 
                             alt="{{ $product->name }}" 
                             class="object-cover object-center w-full h-full transition-transform duration-700 group-hover:scale-110">
                        
                        <!-- Quick Add Button -->
                        <div class="absolute inset-x-0 bottom-0 z-20 p-4 transition-transform duration-500 ease-out transform translate-y-full group-hover:translate-y-0">
                             <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                @csrf
                            <button class="w-full py-4 text-[11px] font-bold tracking-[0.2em] text-white uppercase bg-black hover:bg-gray-800 shadow-2xl transition-colors">
                                Quick Add To Cart
                            </button>
                             </form>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col gap-2 mt-6">
                        <h3 class="text-[13px] font-bold tracking-widest text-gray-900 uppercase">
                           
                                <span aria-hidden="true" class="absolute inset-0 z-0"></span>
                                {{ $product->name }}
                            
                        </h3>
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-black text-black">
                                LKR {{ number_format($product->price * (1 - ($product->discount / 100)), 2) }}
                            </span>
                            @if($product->discount > 0)
                                <span class="text-xs text-gray-400 line-through">
                                    LKR {{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>
@endsection

