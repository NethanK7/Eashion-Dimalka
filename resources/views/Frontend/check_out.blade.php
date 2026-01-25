@extends('layouts.app1')

@section('title', 'Checkout | EASHION')

@section('content')
<div class="min-h-screen bg-white">
    <div class="px-6 py-20 mx-auto max-w-7xl">
        <!-- Header -->
        <header class="mb-16 text-center">
            <h1 class="text-4xl font-extralight tracking-[0.4em] uppercase mb-4">Checkout</h1>
            <div class="flex items-center justify-center space-x-6 text-xs uppercase tracking-[0.2em] text-gray-400">
                <span class="pb-1 font-bold text-black border-b border-black">Shipping</span>
                <span class="w-12 h-px bg-gray-200"></span>
                <span>Payment</span>
                <span class="w-12 h-px bg-gray-200"></span>
                <span>Confirmation</span>
            </div>
        </header>

        <div class="grid gap-20 lg:grid-cols-12">
            <!-- Left: Form -->
            <div class="lg:col-span-7">
                <section>
                    <h2 class="text-sm font-bold uppercase tracking-[0.3em] mb-10 pb-4 border-b border-gray-100 italic">Billing Information</h2>

                    <form action="{{ route('checkout.place') }}" method="POST" class="space-y-10">
                        @csrf

                        <div class="grid grid-cols-2 gap-10">
                            <div class="relative group">
                                <label class="block mb-2 text-xs font-bold tracking-widest text-gray-400 uppercase transition-colors group-focus-within:text-black">First Name</label>
                                <input name="first_name" required class="w-full px-1 py-4 text-base tracking-wide text-gray-900 transition-all duration-300 bg-transparent border-b-2 border-gray-100 focus:outline-none focus:border-black focus:pl-4 placeholder:text-gray-200 placeholder:text-xs placeholder:uppercase" placeholder="E.g. John">
                            </div>
                            <div class="relative group">
                                <label class="block mb-2 text-xs font-bold tracking-widest text-gray-400 uppercase transition-colors group-focus-within:text-black">Last Name</label>
                                <input name="last_name" required class="w-full px-1 py-4 text-base tracking-wide text-gray-900 transition-all duration-300 bg-transparent border-b-2 border-gray-100 focus:outline-none focus:border-black focus:pl-4 placeholder:text-gray-200 placeholder:text-xs placeholder:uppercase" placeholder="E.g. Doe">
                            </div>
                        </div>

                        <div class="relative group">
                            <label class="block mb-2 text-xs font-bold tracking-widest text-gray-400 uppercase transition-colors group-focus-within:text-black">Delivery Address</label>
                            <input name="street_address" required class="w-full px-1 py-4 text-base tracking-wide text-gray-900 transition-all duration-300 bg-transparent border-b-2 border-gray-100 focus:outline-none focus:border-black focus:pl-4 placeholder:text-gray-200 placeholder:text-xs placeholder:uppercase" placeholder="Street address, apartment, suite, etc.">
                        </div>

                        <livewire:location-selector />

                        <div class="relative group">
                            <label class="block mb-2 text-xs font-bold tracking-widest text-gray-400 uppercase transition-colors group-focus-within:text-black">Phone Number</label>
                            <input name="phone" type="tel" required class="w-full px-1 py-4 text-base tracking-wide text-gray-900 transition-all duration-300 bg-transparent border-b-2 border-gray-100 focus:outline-none focus:border-black focus:pl-4 placeholder:text-gray-200 placeholder:text-xs placeholder:uppercase" placeholder="+94 77 123 4567">
                        </div>
                        
                        <div class="pt-10">
                            <button class="group relative w-full overflow-hidden bg-black text-white py-6 tracking-[0.4em] uppercase text-sm font-bold transition-all duration-500 hover:bg-gray-900 active:scale-[0.99] shadow-xl shadow-black/5">
                                <span class="relative z-10">Continue to Payment</span>
                                <div class="absolute inset-0 transition-transform duration-700 translate-y-full bg-white/10 group-hover:translate-y-0"></div>
                            </button>
                        </div>
                    </form>
                </section>
            </div>

            <!-- Right: Summary -->
            <div class="lg:col-span-5">
                <div class="sticky top-12">
                    <div class="p-10 border border-gray-100 rounded-sm bg-gray-50/50 backdrop-blur-sm">
                        <h3 class="text-sm font-bold uppercase tracking-[0.3em] mb-10 pb-4 border-b border-gray-200/50 italic">Your Order</h3>

                        <div class="space-y-8 mb-10 max-h-[500px] overflow-y-auto pr-4 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                            @foreach($cartItems as $item)
                                <div class="flex items-center space-x-6 group">
                                    <div class="flex-shrink-0 w-20 h-24 overflow-hidden transition-transform duration-500 bg-white border border-gray-100 group-hover:shadow-lg">
                                        @if($item->product->image_path)
                                            <img src="{{$item->product->image_path}}" class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110">
                                        @else
                                            <div class="flex items-center justify-center w-full h-full text-xs italic text-gray-300 bg-gray-50">No Img</div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="mb-2 text-sm font-bold leading-relaxed tracking-widest text-gray-800 uppercase">{{ $item->product->name }}</h4>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs italic tracking-widest text-gray-400 uppercase">Qty: {{ $item->quantity }}</span>
                                            <span class="text-sm font-semibold tracking-wider text-gray-900">
                                                LKR {{ number_format(($item->product->price * (1 - ($item->product->discount / 100))) * $item->quantity, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-8 space-y-5 border-t border-gray-200/50">
                            <div class="flex justify-between text-sm tracking-widest text-gray-500 uppercase">
                                <span>Subtotal</span>
                                <span class="font-bold tracking-wider text-gray-900">LKR {{ number_format($subtotal, 2) }}</span>
                            </div>

                            <div class="flex justify-between text-sm tracking-widest text-gray-500 uppercase">
                                <span>Shipping</span>
                                <span class="italic font-bold tracking-wider text-gray-900">LKR 250.00</span>
                            </div>

                            <div class="flex justify-between pt-8 mt-8 border-t border-black/10">
                                <span class="text-sm font-bold uppercase tracking-[0.3em]">Grand Total</span>
                                <span class="text-3xl tracking-tighter text-black font-extralight">LKR {{ number_format($subtotal + 250, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-12">
                            <div class="flex items-center justify-center space-x-6 transition-all duration-500 opacity-30">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-4">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" class="h-5">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
