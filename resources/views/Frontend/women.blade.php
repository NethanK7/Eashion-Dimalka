@extends('layouts.app1')

@section('title', 'Women\'s Collection | EASHION')

@section('content')
    <!-- Hero Section -->
    <div class="relative py-24 overflow-hidden bg-rose-50/50 md:py-32">
        <!-- Background Decorative Elements -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 rounded-full w-96 h-96 bg-rose-200/20 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 rounded-full w-72 h-72 bg-pink-100/30 blur-3xl"></div>
        
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 z-10 bg-gradient-to-r from-rose-50 via-rose-50/80 to-transparent"></div>
            <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?q=80&w=2070&auto=format&fit=crop" 
                 alt="Women's Collection" 
                 class="object-cover w-full h-full opacity-60 scale-105 transition-transform duration-[20s] hover:scale-100">
        </div>
        <div class="relative z-20 px-6 mx-auto max-w-7xl">
            <div class="max-w-3xl">
                <nav class="flex mb-8 text-[10px] tracking-[0.4em] uppercase font-bold" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4 text-rose-900/40">
                        <li><a href="/" class="transition-colors hover:text-rose-600">Home</a></li>
                        <li><span class="w-1 h-1 rounded-full bg-rose-200"></span></li>
                        <li class="font-black text-rose-950">Women</li>
                    </ol>
                </nav>
                <h1 class="mb-8 font-serif text-6xl italic leading-none tracking-tighter text-rose-950 md:text-8xl">
                    Essence of <br/><span class="block mt-2 not-italic font-black text-rose-600">Elegance</span>
                </h1>
                <p class="max-w-xl text-lg font-medium leading-relaxed text-rose-900/70 md:text-xl">
                    Discover our curated collection of sophisticated pieces designed for the modern woman who values grace, style, and timeless quality.
                </p>
                <div class="flex flex-wrap gap-3 mt-12">
                    @foreach(['Dresses', 'Handbags', 'Occasion', 'New In'] as $tag)
                        <button class="px-8 py-3 text-[10px] font-bold tracking-[0.2em] text-rose-900 uppercase border border-rose-200 rounded-full hover:bg-rose-600 hover:text-white hover:border-rose-600 transition-all duration-500 backdrop-blur-md bg-white/40">
                            {{ $tag }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="bg-white">
        <div class="px-6 py-20 mx-auto max-w-7xl">
            <!-- Header with Count & Sort -->
            <div class="flex flex-col justify-between gap-8 pb-10 mb-16 border-b md:flex-row md:items-end border-rose-50">
                <div>
                    <h2 class="text-4xl font-black tracking-tight text-rose-950">The Collection</h2>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <select class="appearance-none px-8 py-4 pr-12 text-[10px] font-bold tracking-[0.2em] uppercase bg-rose-50/50 hover:bg-rose-50 rounded-2xl border-none cursor-pointer focus:ring-2 focus:ring-rose-200 text-rose-900 transition-all duration-300">
                            <option>Sort by: Newest Arrivals</option>
                            <option>Sort by: Price (Low to High)</option>
                            <option>Sort by: Price (High to Low)</option>
                        </select>
                        <div class="absolute -translate-y-1/2 pointer-events-none right-4 top-1/2 text-rose-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if($products->isEmpty())
                <!-- Elegant Empty State -->
                <div class="py-32 text-center">
                    <div class="relative inline-flex mb-8">
                        <div class="absolute inset-0 rounded-full bg-rose-200 blur-2xl opacity-20 animate-pulse"></div>
                        <div class="relative flex items-center justify-center w-24 h-24 rounded-full bg-rose-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.5" stroke="currentColor" class="w-12 h-12 text-rose-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-3xl font-black text-rose-950">Curating New Arrivals</h3>
                    <p class="max-w-md mx-auto mt-4 font-medium leading-relaxed text-rose-900/40">
                        Our tastemakers are currently selecting the finest pieces for this collection. Please check back shortly for our latest arrivals.
                    </p>
                    <a href="/index" class="inline-block mt-10 px-10 py-4 text-[10px] font-bold tracking-[0.3em] uppercase bg-rose-950 text-white rounded-full hover:bg-rose-600 transition-all duration-500 shadow-xl shadow-rose-950/20">
                        Explore Home
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $product)
                        <div class="relative flex flex-col transition-all duration-500 group hover:-translate-y-1">
                            <!-- Image Canvas -->
                            <div class="relative aspect-[3/4] overflow-hidden bg-gray-50 rounded-2xl group shadow-sm transition-all duration-500 hover:shadow-xl hover:shadow-rose-100/20">
                                <a href="{{ route('product.show', $product->id) }}" class="block w-full h-full">
                                    <img src="{{ $product->image_path }}" 
                                         alt="{{ $product->name }}" 
                                         class="object-cover w-full h-full transition-all duration-[1.5s] ease-out group-hover:scale-110">
                                    
                                    <!-- Subtle Gradient Overlay -->
                                    <div class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-gradient-to-t from-black/20 via-transparent to-transparent group-hover:opacity-100"></div>
                                </a>
                                
                                <!-- Floating Badges -->
                                <div class="absolute flex flex-col gap-2 top-4 left-4">
                                    @if($product->discount > 0)
                                        <span class="px-3 py-1.5 text-[10px] font-black tracking-wider text-white uppercase bg-rose-600 rounded-full shadow-lg">
                                            -{{ $product->discount }}%
                                        </span>
                                    @endif
                                </div>

                                <!-- Wishlist Button -->
                                <button class="absolute top-4 right-4 p-3 transition-all duration-500 bg-white/80 backdrop-blur-md shadow-sm hover:bg-rose-600 hover:text-white text-rose-600 rounded-full opacity-0 group-hover:opacity-100 hover:scale-110 translate-y-[-10px] group-hover:translate-y-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>

                                <!-- Quick Action Bar -->
                                <div class="absolute transition-all duration-500 translate-y-4 opacity-0 bottom-4 inset-x-4 group-hover:translate-y-0 group-hover:opacity-100">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                        @csrf
                                        <button class="w-full py-4 text-xs font-black tracking-[0.2em] text-rose-950 uppercase transition-all duration-500 bg-white hover:bg-rose-950 hover:text-white rounded-xl shadow-2xl backdrop-blur-md">
                                            Quick Add to Bag
                                        </button>
                                    </form>
                                </div>  
                            </div>

                            <!-- Details -->
                            <div class="px-2 mt-8 space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold tracking-[0.3em] text-rose-400 uppercase">{{ $product->fit_type ?? 'Eashion Select' }}</span>
                                </div>
                                
                                <h3 class="text-base font-semibold tracking-tight transition-colors duration-300 text-rose-950 group-hover:text-rose-600">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                
                                <div class="flex items-center gap-3 pt-2">
                                    <span class="text-lg font-black text-rose-950 tabular-nums">
                                        LKR {{ number_format($product->price * (1 - ($product->discount / 100)), 2) }}
                                    </span>
                                    @if($product->discount > 0)
                                        <span class="text-sm font-medium line-through text-rose-200 tabular-nums">
                                            LKR {{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <!-- Premium Pagination -->
            <div class="flex flex-col items-center justify-center gap-10 pt-20 mt-20 border-t border-slate-100">
                <div class="flex items-center gap-3 sm:gap-6">
                    {{-- Previous Page --}}
                    @if ($products->onFirstPage())
                        <span class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-200 uppercase cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            Prev
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-900 uppercase hover:text-rose-600 transition-all duration-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transition-transform group-hover:-translate-x-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            Prev
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    <div class="hidden items-center gap-2 sm:flex">
                        @foreach ($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                            @if ($page == $products->currentPage())
                                <span class="relative flex items-center justify-center w-12 h-12 text-xs font-black text-white bg-rose-600 rounded-2xl shadow-lg shadow-rose-200">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="flex items-center justify-center w-12 h-12 text-xs font-bold transition-all duration-300 rounded-2xl text-slate-400 hover:text-slate-900 hover:bg-slate-50">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    </div>

                    {{-- Next Page --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-900 uppercase hover:text-rose-600 transition-all duration-300 group">
                            Next
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 transition-transform group-hover:translate-x-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    @else
                        <span class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-200 uppercase cursor-not-allowed">
                            Next
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>

    <!-- Collection Story Section -->
    <div class="relative py-24 mb-10 overflow-hidden bg-rose-50/20">
        <div class="relative z-10 px-6 mx-auto max-w-7xl">
            <div class="grid items-center gap-16 lg:grid-cols-2">
                <div class="space-y-8">
                    <h2 class="font-serif text-5xl italic leading-tight text-rose-950">Crafted for the <br/><span class="text-6xl not-italic font-black text-rose-600">Extraordinary</span></h2>
                    <p class="text-lg font-medium leading-relaxed text-rose-900/60">
                        Every piece in our women's collection tells a story of meticulous craftsmanship and timeless design. We believe that true fashion transcends seasons.
                    </p>
                    <div class="grid grid-cols-2 gap-8 pt-6">
                        <div>
                            <p class="text-3xl font-black text-rose-950">100%</p>
                            <p class="text-[10px] font-bold tracking-widest uppercase text-rose-300 mt-2">Sustainable Silk</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-rose-950">Handmade</p>
                            <p class="text-[10px] font-bold tracking-widest uppercase text-rose-300 mt-2">Artisan Jewelry</p>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute inset-0 bg-rose-200 rounded-[3rem] rotate-3 transition-transform duration-700 group-hover:rotate-0 translate-x-4"></div>
                    <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=2074&auto=format&fit=crop" 
                         alt="About the collection" 
                         class="relative z-10 rounded-[3rem] object-cover aspect-video shadow-2xl transition-transform duration-700 group-hover:-translate-x-4">
                </div>
            </div>
        </div>
    </div>
@endsection
