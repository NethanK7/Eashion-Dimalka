@extends('layouts.app1')

@section('title', $product->name . ' | EASHION')

@section('content')
<div class="bg-white">
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ url('/') }}" class="hover:text-black">Home</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ url('#') }}" class="hover:text-black">Products</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="font-medium text-black" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 gap-12 md:grid-cols-2 lg:gap-16">
            <!-- Product Information (Mobile: Image First) -->
            
            <!-- Image Section -->
            <div class="flex flex-col space-y-4">
                <div class="aspect-[3/4] w-full overflow-hidden rounded-lg bg-gray-100 relative group">
                    {{-- {{ asset('storage/' . $product->image_path) }} --}}
                    <img src="{{ $product->image_path }}" 
                         alt="{{ $product->name }}" 
                         class="object-cover object-center w-full h-full transition-transform duration-500 group-hover:scale-105">
                </div>
            </div>

            <!-- Details Section -->
            <div class="flex flex-col">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 uppercase md:text-4xl">
                    {{ $product->name }}
                </h1>
                
                <div class="flex items-center gap-3 mt-2">
                    <span class="text-xl font-black text-slate-900">
                        LKR {{ number_format($product->price * (1 - ($product->discount / 100)), 2) }}
                    </span>
                        @if($product->discount > 0)
                            <span class="text-sm font-medium line-through text-slate-400">
                                 LKR {{ number_format($product->price, 2) }}
                            </span>
                        @endif
                </div>

                <!-- Reviews / Rating Placeholder -->
                <div class="flex items-center mt-2 space-x-2">
                    <div class="flex text-sm text-yellow-400">
                        ★★★★★
                    </div>
                    <span class="text-sm text-gray-500">(4.8 Stars)</span>
                </div>

                <div class="mt-8 prose-sm prose text-gray-600">
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Attributes -->
                <div class="mt-8 space-y-6">
                    <!-- Size Selector -->
                    @if($product->size)
                    <div>
                        <h3 class="mb-3 text-sm font-medium tracking-wide text-gray-900 uppercase">Size</h3>
                        <div class="flex space-x-3">
                            <button class="flex items-center justify-center w-12 h-12 text-sm font-medium uppercase transition-all border border-gray-300 rounded-md hover:border-black hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-black">
                                {{ $product->size }}
                            </button>
                            <!-- Fake Sizes for visual demo if static, or loop if you had multiple -->
                        </div>
                    </div>
                    @endif

                    <!-- Color -->
                    @if($product->color)
                    <div>
                        <h3 class="mb-3 text-sm font-medium tracking-wide text-gray-900 uppercase">Color</h3>
                        <div class="flex items-center space-x-3">
                            <span class="inline-block px-4 py-2 text-sm text-gray-700 capitalize border border-gray-300 rounded bg-gray-50">
                                {{ $product->color }}
                            </span>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Additional Info -->
                <div class="pt-8 mt-8 border-t border-gray-200">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                        @if(optional($product->category)->name)
                        <div class="pb-2 border-b border-gray-100">
                            <dt class="text-xs text-gray-500 uppercase">Category</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900">{{ $product->category->name }}</dd>
                        </div>
                        @endif
                        
                        @if($product->fit_type)
                        <div class="pb-2 border-b border-gray-100">
                            <dt class="text-xs text-gray-500 uppercase">Fit Type</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-900">{{ $product->fit_type }}</dd>
                        </div>
                        @endif

                        <div class="pb-2 border-b border-gray-100">
                            <dt class="text-xs text-gray-500 uppercase">Availability</dt>
                            <dd class="mt-1 text-sm font-medium text-green-600">
                                {{ $product->stock_qty > 0 ? 'In Stock' : 'Out of Stock' }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <!-- Actions -->
                <div class="flex mt-10 space-x-4">
                    @auth
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button
                                type="submit"
                                class="w-full px-8 py-4 text-lg font-bold tracking-widest text-white uppercase transition-colors bg-black hover:bg-gray-800 focus:ring-4 focus:ring-gray-300"
                            >
                                Add to Cart
                            </button>
                        </form>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="flex-1 px-8 py-4 text-lg font-bold tracking-widest text-center text-white uppercase bg-black hover:bg-gray-800"
                        >
                            Add to Cart
                        </a>
                    @endauth
                    
                    <!-- Wishlist Placeholder -->
                    <button class="flex items-center justify-center text-gray-500 transition-colors border border-gray-300 w-14 hover:text-red-500 hover:border-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-6 text-xs tracking-wider text-center text-gray-500 uppercase">
                    Free shipping on orders over LKR 10,000
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
