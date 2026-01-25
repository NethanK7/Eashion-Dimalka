@extends('layouts.admin')

@section('content')
        

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto custom-scrollbar h-screen">
            <!-- Header -->
            <header class="sticky top-0 z-10 bg-white/70 backdrop-blur-lg border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Product Management</h1>
                    <p class="text-xs text-slate-500">Overview of your store inventory</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search products..." class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <svg class="w-4 h-4 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <a href="{{ route('create') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition-all shadow-lg shadow-indigo-200 active:scale-95">
                        <span class="mr-1 inline-block">+</span> New Product
                    </a>
                </div>
            </header>

            <div class="p-8">
                <!-- Status Bar -->
                @if (session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl flex items-center shadow-sm animate-bounce-short">
                        <div class="bg-emerald-100 p-2 rounded-lg mr-4 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span class="text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg">Active</span>
                        </div>
                        <h3 class="text-slate-500 text-sm font-medium mt-4">Total Products</h3>
                        <p class="text-2xl font-bold text-slate-800">{{ $products->count() }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-slate-500 text-sm font-medium mt-4">In Stock Items</h3>
                        <p class="text-2xl font-bold text-slate-800">{{ $products->where('stock_qty', '>', 0)->count() }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-rose-50 text-rose-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-slate-500 text-sm font-medium mt-4">Low Stock</h3>
                        <p class="text-2xl font-bold text-rose-600">{{ $products->where('stock_qty', '<=', 5)->count() }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h.01M11 11h.01M11 15h.01M15 7h.01M15 11h.01M15 15h.01"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-slate-500 text-sm font-medium mt-4">Categories</h3>
                        <p class="text-2xl font-bold text-slate-800">{{ $products->pluck('category_id')->unique()->count() }}</p>
                    </div>
                </div>

                <!-- Product Table Table -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col h-[600px]">
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-slate-800">Products List</h2>
                        <div class="flex items-center text-sm text-slate-500">
                             Showing {{ $products->count() }} results
                        </div>
                    </div>

                    <!-- Scrollable Content -->
                    <div class="flex-1 overflow-y-auto custom-scrollbar">
                        <table class="w-full text-left border-collapse">
                            <thead class="sticky top-0 bg-white/95 backdrop-blur-sm z-10">
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Product Details</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Price</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Stock</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Category</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center">
                                                <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 p-1 group-hover:scale-105 transition-transform duration-300">
                                                    <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-xl">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-slate-800">{{ $product->name }}</div>
                                                    <div class="text-xs text-slate-400 max-w-[200px] truncate">{{ $product->description }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="text-sm font-bold text-slate-900 leading-none">LKR {{ number_format($product->price, 2) }}</div>
                                            <div class="text-[10px] text-slate-400 mt-1 uppercase tracking-tighter">Current Price</div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex justify-center">
                                                @if ($product->stock_qty > 0)
                                                    <div class="flex flex-col items-center">
                                                        <span class="px-3 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 rounded-full">
                                                            {{ $product->stock_qty }} IN STOCK
                                                        </span>
                                                        <div class="w-20 h-1 bg-slate-100 rounded-full mt-2 overflow-hidden">
                                                            <div class="h-full bg-emerald-500" style="width:{{ min(100, $product->stock_qty * 10) }}%"></div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="px-3 py-1 text-[10px] font-bold text-rose-600 bg-rose-50 rounded-full uppercase tracking-wider">
                                                        Out of stock
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 text-xs font-medium text-indigo-600 bg-indigo-50 rounded-lg">
                                                {{ $product->category->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <div class="flex items-center justify-end space-x-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <a href="{{ route('products.edit', $product->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-colors" title="Edit Product">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-colors" title="Delete Product">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="p-4 bg-slate-50 rounded-full mb-4 text-slate-300">
                                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                </div>
                                                <span class="text-slate-500 font-medium">No products available in the database.</span>
                                                <a href="{{ route('create') }}" class="mt-4 text-indigo-600 hover:text-indigo-700 font-semibold text-sm underline underline-offset-4">Add your first product</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
@endsection

