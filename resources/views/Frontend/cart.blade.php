@extends('layouts.app1')

@section('title', 'Shopping Bag | EASHION')

@section('content')
<div class="min-h-screen bg-[#fafafa]">
    <!-- Compact Progress -->
    <div class="bg-white border-b border-gray-100">
        <div class="flex items-center justify-between px-4 mx-auto max-w-7xl h-14">
            <a href="{{ url('/') }}" class="group flex items-center gap-2 text-[10px] font-bold tracking-widest uppercase text-gray-500 hover:text-black">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Continue Shopping
            </a>
            <nav class="hidden sm:flex items-center gap-6 text-[9px] font-bold tracking-[0.2em] uppercase">
                <span class="text-black">01 Bag</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-300">02 Checkout</span>
                <span class="text-gray-300">/</span>
                <span class="text-gray-300">03 Order</span>
            </nav>
            <div class="text-[10px] font-bold tracking-widest uppercase text-gray-400">
                Help
            </div>
        </div>
    </div>

    <div class="px-4 py-12 mx-auto max-w-7xl">
        @livewire('cart-summary')
    </div>
</div>
@endsection
