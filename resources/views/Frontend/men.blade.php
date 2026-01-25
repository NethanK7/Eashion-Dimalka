@extends('layouts.app1')

@section('title', 'Men\'s Collection | EASHION')

@section('content')
    <div class="relative overflow-hidden shadow-2xl py-28 bg-slate-900">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 z-10 bg-gradient-to-b from-slate-900/20 via-slate-900/60 to-slate-900"></div>
            <img src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?q=80&w=2071&auto=format&fit=crop" 
                 alt="Men's Fashion" 
                 class="object-cover w-full h-full opacity-60 scale-105 transition-transform duration-[10s] hover:scale-100">
        </div>
        
        <div class="relative z-20 px-6 mx-auto max-w-7xl">
            <div class="flex flex-col items-center text-center">
                <nav class="flex mb-6 text-[10px] tracking-[0.3em] uppercase" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-4 text-slate-400">
                        <li><a href="/" class="transition-colors hover:text-white">Home</a></li>
                        <li><span class="w-1 h-1 rounded-full bg-slate-600"></span></li>
                        <li class="font-black text-white">Men</li>
                    </ol>
                </nav>
                <h1 class="mb-6 text-5xl italic font-black tracking-tighter text-white uppercase md:text-8xl">
                    The <span class="not-italic text-indigo-500">Modern</span> Man
                </h1>
                <p class="max-w-2xl text-lg font-medium leading-relaxed md:text-xl text-slate-300 opacity-90">
                    A curated selection of contemporary essentials designed for the ambitious. Elevate your presence with EASHION's signature craftsmanship.
                </p>
                <div class="flex flex-wrap justify-center gap-3 mt-10">
                    @foreach(['New Arrivals', 'Essential Tees', 'Premium Denim', 'Footwear'] as $tag)
                        <button class="px-6 py-2.5 text-[10px] font-bold tracking-widest text-white uppercase border border-white/20 rounded-full hover:bg-white hover:text-slate-900 transition-all duration-500 backdrop-blur-md">
                            {{ $tag }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="px-6 py-16 mx-auto max-w-7xl">
            <!-- Header Section with count and Sort -->
            <div class="flex flex-col justify-between gap-4 pb-6 mb-12 border-b md:flex-row md:items-center border-slate-100">
                <div class="flex items-center gap-4">
                    <select class="px-4 py-2 text-xs font-bold tracking-widest uppercase bg-transparent border-none cursor-pointer focus:ring-0 text-slate-600">
                        <option>Newest First</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            @if($products->isEmpty())
                <div class="py-24 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 mb-6 rounded-full bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-10 h-10 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900">No products found</h3>
                    <p class="mt-2 text-slate-500">We couldn't find any products in this category at the moment.</p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-x-8 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($products as $product)
                        <div class="relative flex flex-col group">
                            <div class="relative aspect-[3/4] overflow-hidden bg-slate-100 rounded-2xl group">
                                <a href="{{ route('product.show', $product->id) }}" class="block w-full h-full">
                                    <img src="{{ $product->image_path }}" 
                                         alt="{{ $product->name }}" 
                                         class="object-cover w-full h-full transition-all duration-700 ease-out group-hover:scale-110 group-hover:brightness-95">
                                </a>
                                <!-- Floating Badges -->
                                <div class="absolute flex flex-col gap-2 top-4 left-4">
                                    @if($product->discount > 0)
                                        <span class="px-3 py-1 text-[10px] font-black tracking-widest text-white uppercase bg-indigo-600 rounded-full shadow-lg">
                                            -{{ $product->discount }}%
                                        </span>
                                    @endif
                                </div>

                                <!-- Wishlist Button -->
                                <button class="absolute p-2 transition-all duration-300 rounded-full shadow-md opacity-0 top-4 right-4 bg-white/80 backdrop-blur-md text-slate-400 hover:text-red-500 hover:scale-110 group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                </button>

                                <!-- Quick Action Overlay -->
                                <div class="absolute transition-all duration-500 translate-y-4 opacity-0 inset-x-4 bottom-4 group-hover:translate-y-0 group-hover:opacity-100">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                                        @csrf
                                        <button class="w-full py-4 text-xs font-black tracking-[0.2em] text-slate-900 uppercase transition-all duration-300 bg-white hover:bg-slate-900 hover:text-white rounded-xl shadow-xl">
                                            Add to Bag
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Product Info -->
                            <div class="mt-6">
                                <div class="flex items-start justify-between mb-2">
                                    <p class="text-[10px] font-bold tracking-[0.3em] text-slate-400 uppercase">{{ $product->fit_type ?? 'Regular Fit' }}</p>
                                    <div class="flex items-center gap-0.5 text-amber-400">
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-base font-black text-slate-900">
                                        LKR {{ number_format($product->price * (1 - ($product->discount / 100)), 2) }}
                                    </span>
                                    @if($product->discount > 0)
                                        <span class="text-sm font-medium line-through text-slate-400">
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
                        <a href="{{ $products->previousPageUrl() }}" class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-900 uppercase hover:text-indigo-600 transition-all duration-300 group">
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
                                <span class="relative flex items-center justify-center w-12 h-12 text-xs font-black text-white bg-indigo-600 rounded-2xl shadow-lg shadow-indigo-200">
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
                        <a href="{{ $products->nextPageUrl() }}" class="flex items-center gap-2 px-4 py-2 text-[10px] font-black tracking-[0.3em] text-slate-900 uppercase hover:text-indigo-600 transition-all duration-300 group">
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

                <p class="text-[10px] font-bold tracking-[0.2em] text-slate-400 uppercase">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                </p>
            </div>
@endsection
