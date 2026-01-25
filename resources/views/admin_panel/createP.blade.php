<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Eashion Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="p-4 md:p-8 bg-slate-50 font-['Outfit']">
    <div class="max-w-[1600px] mx-auto">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Product Management</h1>
                <p class="text-slate-500 mt-1">Add new arrivals and manage your inventory catalog.</p>
            </div>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-5 py-2.5 text-sm font-semibold text-slate-700 bg-white border border-slate-200 rounded-2xl shadow-sm hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 text-slate-400 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Dashboard
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
            <!-- Left Side: Form (4 cols) -->
            <div class="xl:col-span-4">
                <div class="bg-white/95 backdrop-blur-md border border-slate-200/80 rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 sticky top-8">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800">Add New Product</h2>
                    </div>

                    @if ($errors->any())
                        <div class="p-4 mb-6 text-sm text-rose-700 bg-rose-50 border border-rose-100 rounded-2xl">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Classic Linen Shirt" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Category</label>
                                <select name="category_id" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none bg-white" required>
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Price (LKR)</label>
                                <input type="number" name="price" value="{{ old('price') }}" step="0.01" placeholder="0.00" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Discount (LKR)</label>
                                <input type="number" name="discount" value="{{ old('discount') }}" step="0.01" placeholder="0.00" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Stock Qty</label>
                                <input type="number" name="stock_qty" value="{{ old('stock_qty') }}" placeholder="0" class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Color</label>
                                <input type="text" name="color" value="{{ old('color') }}" placeholder="Blue, Red..." class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Size</label>
                                <input type="text" name="size" value="{{ old('size') }}" placeholder="Small, Large..." class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Fit Type</label>
                            <input type="text" name="fit_type" value="{{ old('fit_type') }}" placeholder="Slim Fit, Regular..." class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Product Description</label>
                            <textarea name="description" rows="3" placeholder="Describe the item..." class="w-full px-4 py-3 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-50 focus:border-indigo-500 transition-all outline-none resize-none">{{ old('description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Product Media</label>
                            <div class="relative group">
                                <input type="file" name="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                <div class="w-full px-4 py-6 border-2 border-dashed border-slate-200 rounded-2xl text-center group-hover:border-indigo-400 transition-colors">
                                    <svg class="w-8 h-8 text-slate-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm font-medium text-slate-600">Click to upload or drag & drop</p>
                                    <p class="text-xs text-slate-400 mt-1">PNG, JPG up to 2MB</p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 bg-slate-900 text-white rounded-2xl font-bold text-lg hover:bg-slate-800 hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-slate-200">
                            Push to Inventory
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Table (8 cols) -->
            <div class="xl:col-span-8">
                <div class="bg-white/95 backdrop-blur-md border border-slate-200/80 rounded-[2.5rem] shadow-xl shadow-slate-200/50 overflow-hidden flex flex-col h-[850px]">
                    <!-- Table Header -->
                    <div class="flex items-center justify-between px-8 py-8 border-b border-slate-100">
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Current Collection</h2>
                            <p class="text-xs text-slate-400 mt-1">Found {{ $products->count() }} total products</p>
                        </div>
                        <div class="flex gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-2"></span>
                                Live Sync
                            </span>
                        </div>
                    </div>

                    <!-- Scrollable Content -->
                    <div class="flex-1 overflow-y-auto">
                        <table class="w-full text-left border-collapse">
                            <thead class="sticky top-0 z-10 bg-white/95 backdrop-blur-sm">
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-[10px] font-bold tracking-widest uppercase text-slate-500 border-b border-slate-100">Overview</th>
                                    <th class="px-8 py-4 text-[10px] font-bold tracking-widest uppercase text-slate-500 border-b border-slate-100">Pricing</th>
                                    <th class="px-8 py-4 text-[10px] font-bold tracking-widest text-center uppercase text-slate-500 border-b border-slate-100">Inventory Status</th>
                                    <th class="px-8 py-4 text-[10px] font-bold tracking-widest uppercase text-slate-500 border-b border-slate-100">Categorization</th>
                                    <th class="px-8 py-4 text-[10px] font-bold tracking-widest text-right uppercase text-slate-500 border-b border-slate-100">Control</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse ($products as $product)
                                    <tr class="transition-colors hover:bg-slate-50/80 group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center">
                                                <div class="p-1 overflow-hidden transition-all duration-300 border w-16 h-16 rounded-2xl bg-white border-slate-200 group-hover:scale-110 shadow-sm">
                                                    <img src="{{ $product->image_path }}" alt="{{ $product->name }}" class="object-cover w-full h-full rounded-xl">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">{{ $product->name }}</div>
                                                    <div class="text-[11px] text-slate-400 max-w-[180px] truncate mt-0.5">{{ $product->description }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="text-sm font-bold text-slate-900">LKR {{ number_format($product->price, 2) }}</div>
                                            @if($product->discount > 0)
                                                <div class="text-[10px] text-rose-500 font-semibold mt-0.5">- LKR {{ number_format($product->discount, 2) }} Off</div>
                                            @else
                                                <div class="text-[10px] text-slate-400 mt-0.5 italic">No Discount</div>
                                            @endif
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col items-center">
                                                @if ($product->stock_qty > 0)
                                                    <span class="px-3 py-1 text-[10px] font-bold text-emerald-600 bg-emerald-50 rounded-full border border-emerald-100">
                                                        {{ $product->stock_qty }} UNITS
                                                    </span>
                                                    <div class="w-16 h-1 mt-2.5 overflow-hidden rounded-full bg-slate-100">
                                                        <div class="h-full bg-emerald-500 transition-all duration-700" style="width:{{ min(100, $product->stock_qty * 5) }}%"></div>
                                                    </div>
                                                @else
                                                    <span class="px-3 py-1 text-[10px] font-bold text-rose-600 bg-rose-50 rounded-full border border-rose-100 uppercase">
                                                        Sold Out
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 text-[11px] font-semibold text-indigo-600 rounded-lg bg-indigo-50 border border-indigo-100">
                                                {{ $product->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <div class="flex items-center justify-end space-x-2 opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                                <a href="{{ route('products.edit', $product->id) }}" class="p-2.5 text-slate-600 transition-all hover:bg-white hover:text-indigo-600 hover:shadow-sm rounded-xl border border-transparent hover:border-slate-100" title="Edit Product">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Archive this product?')" class="p-2.5 transition-all text-slate-600 hover:bg-white hover:text-rose-600 hover:shadow-sm rounded-xl border border-transparent hover:border-slate-100" title="Delete Product">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-32 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="p-6 mb-4 rounded-[2rem] bg-slate-50 text-slate-200">
                                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                </div>
                                                <span class="text-lg font-semibold text-slate-400 tracking-tight">Your warehouse is empty</span>
                                                <p class="text-slate-400 text-sm mt-1">Start by adding your first masterpiece.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-100 flex items-center text-[11px] text-slate-400 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Hover over a row to reveal advanced management controls.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
