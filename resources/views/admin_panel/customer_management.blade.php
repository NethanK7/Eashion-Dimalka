@extends('layouts.admin')

@section('content')
<main class="flex-1 overflow-y-auto h-screen">
            <!-- Header -->
            <header class="sticky top-0 z-10 bg-white/70 backdrop-blur-lg border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Customer Management</h1>
                    <p class="text-xs text-slate-500">Overview of your registered customers</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative hidden sm:block">
                        <input type="text" placeholder="Search customers..." class="pl-10 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <svg class="w-4 h-4 absolute left-3 top-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </header>

            <div class="p-8">
                <!-- Stats Bar -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                        <h3 class="text-slate-500 text-sm font-medium mt-4">Total Customers</h3>
                        <p class="text-2xl font-bold text-slate-800">{{ $customers->count() }}</p>
                    </div>
                </div>

                <!-- Customer Table -->
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden flex flex-col min-h-[500px]">
                    <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/30">
                        <h2 class="text-lg font-bold text-slate-800">Customers List</h2>
                        <div class="flex items-center text-sm text-slate-500">
                             {{ $customers->count() }} active users
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Customer Details</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Email Address</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest">Joined Date</th>
                                    <th class="px-8 py-4 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($customers as $customer)
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-50 to-violet-50 flex items-center justify-center text-indigo-600 font-bold border border-indigo-100 text-sm">
                                                    {{ strtoupper(substr($customer->name, 0, 1)) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-bold text-slate-800">{{ $customer->name }}</div>
                                                    <div class="text-[10px] text-slate-400 uppercase tracking-tighter">Verified Account</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="text-sm text-slate-600">{{ $customer->email }}</div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <div class="text-sm text-slate-600 font-medium">{{ $customer->created_at->format('M d, Y') }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $customer->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-8 py-5 text-right">
                                            <button class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-20 text-center text-slate-500">No customers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
@endsection