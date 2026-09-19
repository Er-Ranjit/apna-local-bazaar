<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Apna Local Bazaar</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    <aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">
        <div class="flex h-full flex-col">

            {{-- BRAND --}}
            <div class="flex h-20 items-center border-b border-slate-100 px-6">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Apna Local Bazaar" class="h-11 w-auto">
                    <div>
                        <p class="text-sm font-black text-slate-950">Apna Local Bazaar</p>
                        <p class="text-xs text-slate-400">Admin Panel</p>
                    </div>
                </a>

            </div>


            {{-- NAV --}}
            <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">
                <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">Management</p>

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">
                 <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">📊</span>
                    Dashboard
                </a>


                {{-- Users --}}
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">👥</span>
                    Users
                </a>


                {{-- Vendors --}}
                <a
                    href="{{ route('admin.vendors.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🏪
                    </span>

                    Vendors

                </a>


                {{-- Products --}}
                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📦
                    </span>

                    Products

                </a>


                {{-- Orders --}}
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🛒
                    </span>

                    Orders

                </a>


                {{-- Delivery --}}
                <a
                    href="{{ route('admin.delivery-assignments.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🚚
                    </span>

                    Delivery Assignments

                </a>

            </nav>


            {{-- STORE --}}
            <div class="border-t border-slate-100 p-4">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-slate-50"
                >

                    <span>
                        ←
                    </span>

                    Back to Store

                </a>

            </div>

        </div>

    </aside>



    {{-- =========================================================
        MAIN
    ========================================================== --}}

    <div class="lg:pl-72">


        {{-- HEADER --}}
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">
            <div class="flex min-h-[72px] flex-col gap-3 px-4 py-3 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                <div>
                     <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">Admin Panel</p>
                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">Dashboard</h1>
                </div>

                <div class="flex min-w-0 flex-1 items-center gap-2 lg:justify-end">
                    {{-- DASHBOARD SEARCH --}}
                    <div class="relative min-w-0 flex-1 lg:max-w-xl">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400">🔎</div>
                        <input
                            id="adminDashboardSearch"
                            type="search"
                            autocomplete="off"
                            placeholder="Search orders, products, customers..."
                            class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-11 text-sm font-medium text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        >
                        <button
                            type="button"
                            id="adminDashboardSearchClear"
                            class="absolute inset-y-0 right-2 my-2 hidden h-7 w-7 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-200 hover:text-slate-700"
                            aria-label="Clear search"
                        >×</button>

                        <div
                            id="adminSearchMenu"
                            class="absolute left-0 right-0 top-12 z-50 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-xl"
                        >
                            <p class="px-3 pb-2 pt-1 text-[10px] font-black uppercase tracking-[0.16em] text-slate-400">Quick Search</p>
                            <div class="grid gap-1 sm:grid-cols-2">
                                <a href="{{ route('admin.users.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700">👥 Users</a>
                                <a href="{{ route('admin.vendors.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700">🏪 Vendors</a>
                                <a href="{{ route('admin.products.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700">📦 Products</a>
                                <a href="{{ route('admin.orders.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700">🛒 Orders</a>
                                <a href="{{ route('admin.delivery-assignments.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 sm:col-span-2">🚚 Delivery Assignments</a>
                            </div>
                        </div>
                    </div>

                    {{-- STORE --}}
                    <a href="{{ route('home') }}" class="hidden rounded-xl border border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 xl:inline-flex">View Store</a>

                    {{-- ADMIN --}}
                    <div class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2">

                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-sm font-black text-white">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

                        </div>


                        <div class="hidden sm:block">

                            <p class="text-xs font-bold text-slate-900">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="text-[10px] text-slate-400">
                                Administrator
                            </p>

                        </div>

                    </div>


                    {{-- LOGOUT --}}
                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl border border-red-100 bg-red-50 px-3 py-2.5 text-xs font-bold text-red-600 hover:bg-red-100 sm:px-4"
                        >
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </header>



        {{-- =========================================================
            CONTENT
        ========================================================== --}}

        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

            <div
                id="adminSearchStatus"
                class="mb-4 hidden items-center justify-between gap-3 rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-3 text-xs font-semibold text-emerald-800"
            >
                <span id="adminSearchStatusText"></span>
                <button
                    type="button"
                    id="adminSearchStatusClear"
                    class="rounded-lg bg-white px-3 py-1.5 font-bold text-emerald-700 shadow-sm transition hover:bg-emerald-100"
                >
                    Clear
                </button>
            </div>



            {{-- WELCOME --}}
            <section class="mb-6 overflow-hidden rounded-3xl bg-slate-950 p-6 text-white sm:p-8">

                <div class="flex items-center justify-between gap-6">

                    <div>

                        <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300">
                            Control Center
                        </span>

                        <h2 class="mt-4 text-2xl font-black sm:text-3xl lg:text-4xl">
                            Welcome back,
                            {{ auth()->user()->name }} 👋
                        </h2>

                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                            Monitor your marketplace, orders, sellers and delivery operations.
                        </p>

                    </div>


                    <div class="hidden h-28 w-28 items-center justify-center rounded-3xl bg-white/10 text-6xl lg:flex">
                        📊
                    </div>

                </div>

            </section>



            {{-- =====================================================
                MAIN STATS
            ====================================================== --}}

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- USERS --}}
                <a
                    href="{{ route('admin.users.index') }}"
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Users
                            </p>

                            <p class="mt-2 text-3xl font-black">
                                {{ $usersCount }}
                            </p>

                            <p class="mt-2 text-xs font-bold text-blue-600">
                                Manage users →
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-2xl">
                            👥
                        </div>

                    </div>

                </a>


                {{-- VENDORS --}}
                <a
                    href="{{ route('admin.vendors.index') }}"
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Vendors
                            </p>

                            <p class="mt-2 text-3xl font-black">
                                {{ $vendorsCount }}
                            </p>

                            <p class="mt-2 text-xs font-bold text-purple-600">
                                Manage vendors →
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-2xl">
                            🏪
                        </div>

                    </div>

                </a>


                {{-- PRODUCTS --}}
                <a
                    href="{{ route('admin.products.index') }}"
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Products
                            </p>

                            <p class="mt-2 text-3xl font-black">
                                {{ $productsCount }}
                            </p>

                            <p class="mt-2 text-xs font-bold text-orange-600">
                                Manage products →
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-2xl">
                            📦
                        </div>

                    </div>

                </a>


                {{-- ORDERS --}}
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                >

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500">
                                Total Orders
                            </p>

                            <p class="mt-2 text-3xl font-black">
                                {{ $ordersCount }}
                            </p>

                            <p class="mt-2 text-xs font-bold text-emerald-600">
                                View orders →
                            </p>

                        </div>


                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">
                            🛒
                        </div>

                    </div>

                </a>

            </section>



            {{-- =====================================================
                ORDER STATUS
            ====================================================== --}}

            <section class="mt-6">

                <div class="mb-4">

                    <p class="text-xs font-bold uppercase tracking-[0.14em] text-emerald-600">
                        Live Operations
                    </p>

                    <h2 class="mt-1 text-xl font-black text-slate-950">
                        Order Status
                    </h2>

                </div>


                <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">


                    {{-- PENDING --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl border border-amber-200 bg-amber-50 p-5 transition hover:-translate-y-1"
                    >

                        <p class="text-sm font-bold text-amber-700">
                            Pending
                        </p>

                        <p class="mt-2 text-3xl font-black text-amber-900">
                            {{ $pendingOrders }}
                        </p>

                        <p class="mt-1 text-xs text-amber-700">
                            Awaiting confirmation
                        </p>

                    </a>


                    {{-- CONFIRMED --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl border border-blue-200 bg-blue-50 p-5 transition hover:-translate-y-1"
                    >

                        <p class="text-sm font-bold text-blue-700">
                            Confirmed
                        </p>

                        <p class="mt-2 text-3xl font-black text-blue-900">
                            {{ $confirmedOrders }}
                        </p>

                        <p class="mt-1 text-xs text-blue-700">
                            Accepted orders
                        </p>

                    </a>


                    {{-- PREPARING --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl border border-purple-200 bg-purple-50 p-5 transition hover:-translate-y-1"
                    >

                        <p class="text-sm font-bold text-purple-700">
                            Preparing
                        </p>

                        <p class="mt-2 text-3xl font-black text-purple-900">
                            {{ $preparingOrders }}
                        </p>

                        <p class="mt-1 text-xs text-purple-700">
                            Being prepared
                        </p>

                    </a>


                    {{-- OUT FOR DELIVERY --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl border border-orange-200 bg-orange-50 p-5 transition hover:-translate-y-1"
                    >

                        <p class="text-sm font-bold text-orange-700">
                            Out for Delivery
                        </p>

                        <p class="mt-2 text-3xl font-black text-orange-900">
                            {{ $outForDeliveryOrders }}
                        </p>

                        <p class="mt-1 text-xs text-orange-700">
                            On the way
                        </p>

                    </a>


                    {{-- DELIVERED --}}
                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 transition hover:-translate-y-1"
                    >

                        <p class="text-sm font-bold text-emerald-700">
                            Delivered
                        </p>

                        <p class="mt-2 text-3xl font-black text-emerald-900">
                            {{ $deliveredOrders }}
                        </p>

                        <p class="mt-1 text-xs text-emerald-700">
                            Completed orders
                        </p>

                    </a>

                </div>

            </section>



            {{-- =====================================================
                RECENT ORDERS + LOW STOCK
            ====================================================== --}}

            <section class="mt-6 grid gap-6 xl:grid-cols-[minmax(0,1fr)_380px]">


                {{-- RECENT ORDERS --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="flex items-center justify-between border-b border-slate-100 p-5 sm:p-6">

                        <div>

                            <p class="text-xs font-bold uppercase tracking-[0.14em] text-emerald-600">
                                Latest Activity
                            </p>

                            <h2 class="mt-1 text-xl font-black text-slate-950">
                                Recent Orders
                            </h2>

                        </div>


                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700"
                        >
                            View All
                        </a>

                    </div>


                    @if($recentOrders->count())

                        <div class="divide-y divide-slate-100">

                            @foreach($recentOrders as $order)

                                @php
                                    $orderStatusClass = match($order->status) {
                                        'pending' => 'bg-amber-50 text-amber-700',
                                        'confirmed' => 'bg-blue-50 text-blue-700',
                                        'preparing' => 'bg-purple-50 text-purple-700',
                                        'out_for_delivery' => 'bg-orange-50 text-orange-700',
                                        'delivered' => 'bg-emerald-50 text-emerald-700',
                                        default => 'bg-slate-100 text-slate-600',
                                    };
                                @endphp


                                <div class="admin-searchable flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6" data-search="{{ strtolower(($order->order_number ?? '') . ' ' . ($order->user->name ?? '') . ' ' . ($order->status ?? '')) }}">

                                    <div class="flex min-w-0 items-center gap-3">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-xl">
                                            🛒
                                        </div>


                                        <div class="min-w-0">

                                            <p class="truncate font-bold text-slate-900">
                                                #{{ $order->order_number }}
                                            </p>

                                            <p class="mt-1 truncate text-xs text-slate-500">
                                                {{ $order->user->name ?? 'Unknown Customer' }}
                                            </p>

                                        </div>

                                    </div>


                                    <div class="flex items-center justify-between gap-4 sm:justify-end">

                                        <span class="rounded-full px-3 py-1.5 text-xs font-bold {{ $orderStatusClass }}">
                                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                        </span>

                                        <span class="font-black text-slate-900">
                                            ₹{{ number_format($order->total_amount, 2) }}
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="p-8 text-center text-sm text-slate-500">
                            No recent orders.
                        </div>

                    @endif

                </div>



                {{-- LOW STOCK --}}
                <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="border-b border-slate-100 p-5 sm:p-6">

                        <p class="text-xs font-bold uppercase tracking-[0.14em] text-red-600">
                            Inventory Alert
                        </p>

                        <h2 class="mt-1 text-xl font-black text-slate-950">
                            Low Stock
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Products with 5 or fewer items.
                        </p>

                    </div>


                    @if($lowStockProducts->count())

                        <div class="divide-y divide-slate-100">

                            @foreach($lowStockProducts as $product)

                                <div class="admin-searchable flex items-center justify-between gap-3 p-4" data-search="{{ strtolower(($product->name ?? '') . ' ' . ($product->vendor->shop_name ?? '')) }}">

                                    <div class="min-w-0">

                                        <p class="truncate text-sm font-bold text-slate-900">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 truncate text-xs text-slate-400">
                                            {{ $product->vendor->shop_name ?? 'No Vendor' }}
                                        </p>

                                    </div>


                                    <div class="shrink-0 text-right">

                                        <p class="text-sm font-black {{ $product->stock <= 0 ? 'text-red-600' : 'text-amber-600' }}">
                                            {{ $product->stock }}
                                        </p>

                                        <p class="text-[10px] font-semibold uppercase text-slate-400">
                                            Stock
                                        </p>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="p-8 text-center">

                            <div class="text-3xl">
                                ✅
                            </div>

                            <p class="mt-3 text-sm font-bold text-emerald-700">
                                Stock looks healthy
                            </p>

                            <p class="mt-1 text-xs text-slate-500">
                                No low-stock products right now.
                            </p>

                        </div>

                    @endif

                </div>

            </section>



            {{-- =====================================================
                QUICK ACTIONS
            ====================================================== --}}

            <section class="mt-6 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <p class="text-xs font-bold uppercase tracking-[0.14em] text-emerald-600">
                    Quick Access
                </p>

                <h2 class="mt-1 text-xl font-black text-slate-950">
                    Management
                </h2>


                <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="rounded-2xl bg-slate-50 p-4 transition hover:bg-blue-50"
                    >
                        <div class="text-2xl">
                            👥
                        </div>

                        <p class="mt-2 text-sm font-bold">
                            Users
                        </p>

                    </a>


                    <a
                        href="{{ route('admin.vendors.index') }}"
                        class="rounded-2xl bg-slate-50 p-4 transition hover:bg-purple-50"
                    >
                        <div class="text-2xl">
                            🏪
                        </div>

                        <p class="mt-2 text-sm font-bold">
                            Vendors
                        </p>

                    </a>


                    <a
                        href="{{ route('admin.products.index') }}"
                        class="rounded-2xl bg-slate-50 p-4 transition hover:bg-orange-50"
                    >
                        <div class="text-2xl">
                            📦
                        </div>

                        <p class="mt-2 text-sm font-bold">
                            Products
                        </p>

                    </a>


                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-2xl bg-slate-50 p-4 transition hover:bg-emerald-50"
                    >
                        <div class="text-2xl">
                            🛒
                        </div>

                        <p class="mt-2 text-sm font-bold">
                            Orders
                        </p>

                    </a>


                    <a
                        href="{{ route('admin.delivery-assignments.index') }}"
                        class="rounded-2xl bg-slate-50 p-4 transition hover:bg-indigo-50"
                    >
                        <div class="text-2xl">
                            🚚
                        </div>

                        <p class="mt-2 text-sm font-bold">
                            Delivery
                        </p>

                    </a>

                </div>

            </section>



            {{-- FOOTER --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">

                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">
                    <p>© {{ date('Y') }} Apna Local Bazaar</p>
                    <p>Admin Control Center</p>
                </div>

            </footer>

        </main>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('adminDashboardSearch');
            const clearButton = document.getElementById('adminDashboardSearchClear');
            const menu = document.getElementById('adminSearchMenu');
            const status = document.getElementById('adminSearchStatus');
            const statusText = document.getElementById('adminSearchStatusText');
            const statusClear = document.getElementById('adminSearchStatusClear');
            const rows = Array.from(document.querySelectorAll('.admin-searchable'));

            if (!input) return;

            const setMenu = (show) => menu?.classList.toggle('hidden', !show);

            const applySearch = () => {
                const query = input.value.trim().toLowerCase();
                let visible = 0;

                rows.forEach((row) => {
                    const haystack = (row.dataset.search || '').toLowerCase();
                    const match = !query || haystack.includes(query);
                    row.classList.toggle('hidden', !match);
                    if (match) visible++;
                });

                clearButton?.classList.toggle('hidden', !query);
                clearButton?.classList.toggle('inline-flex', !!query);

                status?.classList.toggle('hidden', !query);
                status?.classList.toggle('flex', !!query);

                if (statusText && query) {
                    statusText.textContent =
                        `${visible} matching activity item${visible === 1 ? '' : 's'} found for "${input.value.trim()}"`;
                }

                setMenu(!query);
            };

            const clearSearch = () => {
                input.value = '';
                rows.forEach(row => row.classList.remove('hidden'));
                clearButton?.classList.add('hidden');
                clearButton?.classList.remove('inline-flex');
                status?.classList.add('hidden');
                status?.classList.remove('flex');
                setMenu(true);
                input.focus();
            };

            input.addEventListener('focus', () => {
                if (!input.value.trim()) setMenu(true);
            });

            input.addEventListener('input', applySearch);

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    clearSearch();
                    setMenu(false);
                }
            });

            clearButton?.addEventListener('click', clearSearch);
            statusClear?.addEventListener('click', clearSearch);

            document.addEventListener('click', (event) => {
                if (!event.target.closest('#adminDashboardSearch') &&
                    !event.target.closest('#adminSearchMenu')) {
                    setMenu(false);
                }
            });
        });
    </script>

</body>
</html>