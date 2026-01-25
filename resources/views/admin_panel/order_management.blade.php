@extends('layouts.admin')


@section('content')
 <main class="flex-1 overflow-y-auto h-screen">
            <!-- Header -->
            <header class="sticky top-0 z-10 bg-white/70 backdrop-blur-lg border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Order Management</h1>
                    <p class="text-xs text-slate-500">Manage and track your customer orders</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search orders..." class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <svg class="w-4 h-4 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Order Content -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col min-h-[600px]">
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Recent Orders</h2>
                        <div class="flex items-center text-sm text-slate-500">
                             Total Transactions: {{ $orders->count() }}
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Order Details</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Customer</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Date</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-center">Amount</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-slate-800 uppercase">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                                    <div class="text-[10px] text-slate-400">Order ID</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="flex flex-col text-sm font-medium text-slate-700">
                                                <span>{{ $order->first_name }} {{ $order->last_name }}</span>
                                                <span class="text-[11px] text-slate-400 font-normal lowercase">{{ $order->phone }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="text-sm text-slate-600">
                                                <div class="font-semibold">{{ $order->created_at->format('M d, Y') }}</div>
                                                <div class="text-[10px] text-slate-400">{{ $order->created_at->format('h:i A') }}</div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5 text-center">
                                            <div class="text-sm font-black text-slate-900">LKR {{ number_format($order->total, 2) }}</div>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'processing' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                    'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                    'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                                                ];
                                                $colorClass = $statusColors[strtolower($order->status)] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                            @endphp
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $colorClass }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-20 text-center">
                                            <div class="flex flex-col items-center">
                                                <div class="p-4 bg-slate-50 rounded-full mb-4 text-slate-300">
                                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </div>
                                                <span class="text-slate-500 font-medium">No orders found.</span>
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
