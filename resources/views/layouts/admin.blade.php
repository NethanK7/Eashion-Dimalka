<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | EASHION Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="flex min-h-screen font-sans bg-slate-50">

    <!-- Sidebar -->
    <aside class="flex-col hidden w-64 bg-white border-r border-slate-200 md:flex">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-transparent bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text">Eashion Admin</h2>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-xl {{ request()->routeIs('dashboard') ? 'text-indigo-700 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>

                {{-- Add Product --}}
                <a href="{{ route('create') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-xl {{ request()->routeIs('create') ? 'text-indigo-700 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Product
                </a>

                {{-- Orders --}}
                <a href="{{ route('order-management') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-xl {{ request()->routeIs('order-management') ? 'text-indigo-700 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    Orders
                </a>

                {{-- Customers --}}
                <a href="{{ route('customer-management') }}" class="flex items-center px-4 py-3 text-sm font-medium transition-all duration-200 rounded-xl {{ request()->routeIs('customer-management') ? 'text-indigo-700 bg-indigo-50' : 'text-slate-600 hover:text-indigo-600 hover:bg-slate-50' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Customers
                </a>
            </nav>
            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center p-2 rounded-xl bg-slate-50">
                    <div class="flex items-center justify-center w-10 h-10 font-bold text-indigo-700 bg-indigo-100 rounded-full">
                        A
                    </div>
                    <div class="ml-3">
                        <p class="text-xs font-semibold text-slate-900">Admin User</p>
                        <p class="text-[10px] text-slate-500">admin@eashion.com</p>
                    </div>
                </div>
            </div>
        </aside>


    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        @yield('content')
    </main>

</body>
</html>
