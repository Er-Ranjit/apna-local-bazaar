<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Vendor Dashboard - Apna Local Bazaar
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>


<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">


    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}
    <aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">

        <div class="flex h-full flex-col">


            {{-- BRAND --}}
            <div class="flex h-20 items-center border-b border-slate-100 px-6">

                <a
                    href="{{ route('vendor.dashboard') }}"
                    class="flex items-center gap-3"
                >

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Apna Local Bazaar"
                        class="h-11 w-auto"
                    >


                    <div>

                        <p class="text-sm font-black text-slate-950">
                            Apna Local Bazaar
                        </p>

                        <p class="text-xs text-slate-400">
                            Vendor Panel
                        </p>

                    </div>

                </a>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">


                <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">
                    Store Management
                </p>


                {{-- DASHBOARD --}}
                <a
                    href="{{ route('vendor.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        📊
                    </span>

                    Dashboard

                </a>


                {{-- ADD PRODUCT --}}
                <a
                    href="{{ route('vendor.products.create') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        ➕
                    </span>

                    Add Product

                </a>


                {{-- ORDERS --}}
                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🛒
                    </span>

                    Orders

                    @if($pendingOrders > 0)

                        <span class="ml-auto rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-600">
                            {{ $pendingOrders }}
                        </span>

                    @endif

                </a>

                {{-- SHOP LOCATION --}}
<a
    href="{{ route('vendor.location') }}"
    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
>

    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
        📍
    </span>

    Shop Location

</a>


                {{-- DELIVERY --}}
                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🚚
                    </span>

                    Delivery

                </a>


            </nav>


            {{-- STORE --}}
            <div class="border-t border-slate-100 p-4">


                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span>
                        ←
                    </span>

                    Back to Store

                </a>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-2"
                >

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                    >

                        <span>
                            ↪
                        </span>

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </aside>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <div class="lg:pl-72">


        {{-- =========================================================
            HEADER
        ========================================================== --}}
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">


            <div class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">


                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                        Vendor Panel
                    </p>


                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                        Dashboard
                    </h1>

                </div>


                <div class="flex items-center gap-3">


                    <div class="hidden text-right sm:block">

                        <p class="text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ $vendor->shop_name }}
                        </p>

                    </div>


                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-lg font-black text-emerald-700">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </div>

        </header>


        {{-- =========================================================
            CONTENT
        ========================================================== --}}
        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">


            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>

            @endif


            {{-- ERROR --}}
            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm font-semibold text-red-700">
                    {{ session('error') }}
                </div>

            @endif


            {{-- =====================================================
                WELCOME
            ====================================================== --}}
            <section class="overflow-hidden rounded-3xl bg-slate-900 shadow-sm">


                <div class="relative p-6 sm:p-8">


                    <div class="relative z-10 max-w-2xl">


                        <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300">
                            {{ $vendor->shop_name }}
                        </span>


                        <h2 class="mt-4 text-3xl font-black tracking-tight text-white sm:text-4xl">
                            Welcome back, {{ auth()->user()->name }} 👋
                        </h2>


                        <p class="mt-3 max-w-xl text-sm leading-6 text-slate-300">
                            Manage your products, monitor orders and keep your store running smoothly.
                        </p>


                        <div class="mt-6 flex flex-wrap gap-3">


                            <a
                                href="{{ route('vendor.products.create') }}"
                                class="rounded-xl bg-emerald-500 px-5 py-3 text-sm font-black text-white transition hover:bg-emerald-400"
                            >
                                + Add Product
                            </a>


                            <a
                                href="{{ route('vendor.orders.index') }}"
                                class="rounded-xl border border-slate-700 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800"
                            >
                                Manage Orders →
                            </a>

                        </div>

                    </div>


                    {{-- DECORATION --}}
                    <div class="pointer-events-none absolute -right-10 -top-20 hidden h-80 w-80 rounded-full border border-emerald-400/10 sm:block"></div>

                    <div class="pointer-events-none absolute -bottom-32 right-20 hidden h-72 w-72 rounded-full border border-white/5 sm:block"></div>

                </div>

            </section>


            {{-- =====================================================
                STATS
            ====================================================== --}}
            <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- PRODUCTS --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-2xl">
                            📦
                        </div>


                        <span class="text-xs font-bold text-slate-400">
                            Catalog
                        </span>

                    </div>


                    <p class="mt-5 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Total Products
                    </p>


                    <p class="mt-1 text-3xl font-black text-slate-950">
                        {{ $productsCount }}
                    </p>


                    <p class="mt-2 text-xs text-slate-500">
                        {{ $activeProducts }} active · {{ $inactiveProducts }} inactive
                    </p>

                </div>


                {{-- ORDERS --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-2xl">
                            🛒
                        </div>


                        <span class="text-xs font-bold text-slate-400">
                            Orders
                        </span>

                    </div>


                    <p class="mt-5 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Total Orders
                    </p>


                    <p class="mt-1 text-3xl font-black text-slate-950">
                        {{ $ordersCount }}
                    </p>


                    <p class="mt-2 text-xs text-slate-500">
                        {{ $pendingOrders }} pending
                    </p>

                </div>


                {{-- REVENUE --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">
                            ₹
                        </div>


                        <span class="text-xs font-bold text-slate-400">
                            Delivered
                        </span>

                    </div>


                    <p class="mt-5 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Revenue
                    </p>


                    <p class="mt-1 text-3xl font-black text-slate-950">
                        ₹{{ number_format((float) $revenue, 2) }}
                    </p>


                    <p class="mt-2 text-xs text-slate-500">
                        From {{ $deliveredOrders }} delivered orders
                    </p>

                </div>


                {{-- LOW STOCK --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-50 text-2xl">
                            ⚠️
                        </div>


                        <span class="text-xs font-bold text-slate-400">
                            Inventory
                        </span>

                    </div>


                    <p class="mt-5 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Stock Alerts
                    </p>


                    <p class="mt-1 text-3xl font-black text-slate-950">
                        {{ $lowStockProducts->count() + $outOfStockProducts }}
                    </p>


                    <p class="mt-2 text-xs text-slate-500">
                        {{ $lowStockProducts->count() }} low · {{ $outOfStockProducts }} out
                    </p>

                </div>

            </section>


            {{-- =====================================================
                ORDER STATUS SUMMARY
            ====================================================== --}}
            <section class="mt-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

                    <div>

                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                            Order Pipeline
                        </p>

                        <h2 class="mt-1 text-xl font-black text-slate-950">
                            Order Overview
                        </h2>

                    </div>


                    <a
                        href="{{ route('vendor.orders.index') }}"
                        class="text-sm font-bold text-emerald-700 hover:text-emerald-800"
                    >
                        View all orders →
                    </a>

                </div>


                <div class="mt-5 grid gap-3 sm:grid-cols-2 lg:grid-cols-5">


                    {{-- PENDING --}}
                    <div class="rounded-2xl bg-amber-50 p-4">

                        <p class="text-xs font-bold text-amber-600">
                            Pending
                        </p>

                        <p class="mt-2 text-2xl font-black text-amber-800">
                            {{ $pendingOrders }}
                        </p>

                    </div>


                    {{-- CONFIRMED --}}
                    <div class="rounded-2xl bg-blue-50 p-4">

                        <p class="text-xs font-bold text-blue-600">
                            Confirmed
                        </p>

                        <p class="mt-2 text-2xl font-black text-blue-800">
                            {{ $confirmedOrders }}
                        </p>

                    </div>


                    {{-- PREPARING --}}
                    <div class="rounded-2xl bg-purple-50 p-4">

                        <p class="text-xs font-bold text-purple-600">
                            Preparing
                        </p>

                        <p class="mt-2 text-2xl font-black text-purple-800">
                            {{ $preparingOrders }}
                        </p>

                    </div>


                    {{-- OUT FOR DELIVERY --}}
                    <div class="rounded-2xl bg-orange-50 p-4">

                        <p class="text-xs font-bold text-orange-600">
                            Out for Delivery
                        </p>

                        <p class="mt-2 text-2xl font-black text-orange-800">
                            {{ $outForDeliveryOrders }}
                        </p>

                    </div>


                    {{-- DELIVERED --}}
                    <div class="rounded-2xl bg-emerald-50 p-4">

                        <p class="text-xs font-bold text-emerald-600">
                            Delivered
                        </p>

                        <p class="mt-2 text-2xl font-black text-emerald-800">
                            {{ $deliveredOrders }}
                        </p>

                    </div>

                </div>

            </section>


            {{-- =====================================================
                TWO COLUMN
            ====================================================== --}}
            <div class="mt-6 grid gap-6 xl:grid-cols-[1.5fr_1fr]">


                {{-- =================================================
                    RECENT ORDERS
                ================================================== --}}
                <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5 sm:px-6">


                        <div>

                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                                Recent Activity
                            </p>

                            <h2 class="mt-1 text-lg font-black text-slate-950">
                                Recent Orders
                            </h2>

                        </div>


                        <a
                            href="{{ route('vendor.orders.index') }}"
                            class="text-xs font-bold text-emerald-700 hover:text-emerald-800"
                        >
                            View All
                        </a>

                    </div>


                    @if($recentOrders->count() > 0)


                        <div class="divide-y divide-slate-100">


                            @foreach($recentOrders as $order)


                                @php

                                    $orderStatusClass = match($order->status) {

                                        'pending'
                                            => 'bg-amber-50 text-amber-700',

                                        'confirmed'
                                            => 'bg-blue-50 text-blue-700',

                                        'preparing'
                                            => 'bg-purple-50 text-purple-700',

                                        'out_for_delivery'
                                            => 'bg-orange-50 text-orange-700',

                                        'delivered'
                                            => 'bg-emerald-50 text-emerald-700',

                                        default
                                            => 'bg-slate-100 text-slate-600',
                                    };

                                @endphp


                                <div class="p-5 sm:px-6">


                                    <div class="flex items-start gap-4">


                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-lg">
                                            🛒
                                        </div>


                                        <div class="min-w-0 flex-1">


                                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">


                                                <div>

                                                    <p class="break-all text-sm font-black text-slate-900">
                                                        #{{ $order->order_number }}
                                                    </p>

                                                    <p class="mt-1 text-xs text-slate-400">
                                                        {{ $order->user?->name ?? 'Customer' }}
                                                    </p>

                                                </div>


                                                <span class="w-fit rounded-full px-3 py-1 text-[10px] font-bold {{ $orderStatusClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                                </span>

                                            </div>


                                            <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-slate-500">


                                                <span>
                                                    {{ $order->items->count() }} product{{ $order->items->count() === 1 ? '' : 's' }}
                                                </span>


                                                <span>
                                                    ₹{{ number_format((float) $order->total_amount, 2) }}
                                                </span>


                                                <span>
                                                    {{ $order->created_at?->format('d M Y, h:i A') }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach


                        </div>


                    @else


                        <div class="px-6 py-14 text-center">


                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                                🛒
                            </div>


                            <p class="mt-4 font-bold text-slate-700">
                                No orders yet
                            </p>


                            <p class="mt-1 text-sm text-slate-400">
                                New orders will appear here.
                            </p>

                        </div>

                    @endif

                </section>


                {{-- =================================================
                    LOW STOCK
                ================================================== --}}
                <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                    <div class="border-b border-slate-100 px-5 py-5 sm:px-6">


                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-orange-600">
                            Inventory
                        </p>


                        <h2 class="mt-1 text-lg font-black text-slate-950">
                            Stock Alerts
                        </h2>

                    </div>


                    @if($lowStockProducts->count() > 0 || $outOfStockProducts > 0)


                        <div class="divide-y divide-slate-100">


                            {{-- OUT OF STOCK --}}
                            @foreach($products->where('stock', '<=', 0)->take(3) as $product)


                                <div class="flex items-center gap-3 p-5">


                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">


                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                            >

                                        @else

                                            <img
                                                src="{{ asset('images/products/product-placeholder.png') }}"
                                                alt="Product"
                                                class="h-full w-full object-cover"
                                            >

                                        @endif

                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <p class="truncate text-sm font-bold text-slate-800">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-red-600">
                                            Out of stock
                                        </p>

                                    </div>


                                    <a
                                        href="{{ route('vendor.products.edit', $product->id) }}"
                                        class="rounded-lg bg-slate-100 px-3 py-2 text-[10px] font-bold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
                                    >
                                        Edit
                                    </a>

                                </div>

                            @endforeach


                            {{-- LOW STOCK --}}
                            @foreach($lowStockProducts->take(4) as $product)


                                <div class="flex items-center gap-3 p-5">


                                    <div class="flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-slate-100">


                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                            >

                                        @else

                                            <img
                                                src="{{ asset('images/products/product-placeholder.png') }}"
                                                alt="Product"
                                                class="h-full w-full object-cover"
                                            >

                                        @endif

                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <p class="truncate text-sm font-bold text-slate-800">
                                            {{ $product->name }}
                                        </p>

                                        <p class="mt-1 text-xs font-semibold text-orange-600">
                                            Only {{ $product->stock }} left
                                        </p>

                                    </div>


                                    <a
                                        href="{{ route('vendor.products.edit', $product->id) }}"
                                        class="rounded-lg bg-slate-100 px-3 py-2 text-[10px] font-bold text-slate-700 transition hover:bg-emerald-50 hover:text-emerald-700"
                                    >
                                        Edit
                                    </a>

                                </div>

                            @endforeach


                        </div>


                    @else


                        <div class="px-6 py-14 text-center">


                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 text-3xl">
                                ✅
                            </div>


                            <p class="mt-4 font-bold text-slate-700">
                                Inventory looks good
                            </p>


                            <p class="mt-1 text-sm text-slate-400">
                                No low-stock products right now.
                            </p>

                        </div>

                    @endif

                </section>

            </div>


            {{-- =====================================================
                MY PRODUCTS
            ====================================================== --}}
            <section class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                <div class="flex flex-col gap-4 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">


                    <div>

                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                            Store Catalog
                        </p>

                        <h2 class="mt-1 text-lg font-black text-slate-950">
                            My Products
                        </h2>

                    </div>


                    <a
                        href="{{ route('vendor.products.create') }}"
                        class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-700"
                    >
                        + Add New Product
                    </a>

                </div>


                @if($products->count() > 0)


                    {{-- DESKTOP --}}
                    <div class="hidden overflow-x-auto md:block">


                        <table class="w-full min-w-[950px]">


                            <thead class="bg-slate-50">

                                <tr class="border-b border-slate-200 text-left">


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Product
                                    </th>


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Price
                                    </th>


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Category
                                    </th>


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Stock
                                    </th>


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Status
                                    </th>


                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">


                                @foreach($products as $product)


                                    @php

                                        $productActive =
                                            $product->is_active &&
                                            $product->is_available;

                                    @endphp


                                    <tr class="transition hover:bg-slate-50">


                                        {{-- PRODUCT --}}
                                        <td class="px-6 py-5">


                                            <div class="flex items-center gap-3">


                                                <div class="h-12 w-12 shrink-0 overflow-hidden rounded-xl bg-slate-100">


                                                    @if($product->image)

                                                        <img
                                                            src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                                            alt="{{ $product->name }}"
                                                            class="h-full w-full object-cover"
                                                            onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                                        >

                                                    @else

                                                        <img
                                                            src="{{ asset('images/products/product-placeholder.png') }}"
                                                            alt="Product"
                                                            class="h-full w-full object-cover"
                                                        >

                                                    @endif

                                                </div>


                                                <div class="min-w-0">

                                                    <p class="font-bold text-slate-800">
                                                        {{ $product->name }}
                                                    </p>

                                                    <p class="mt-1 text-xs text-slate-400">
                                                        #{{ $product->id }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- PRICE --}}
                                        <td class="px-6 py-5">


                                            <p class="font-bold text-slate-900">
                                                ₹{{ number_format((float) $product->price, 2) }}
                                            </p>


                                            @if($product->discount_price !== null)

                                                <p class="mt-1 text-xs font-semibold text-emerald-600">
                                                    ₹{{ number_format((float) $product->discount_price, 2) }}
                                                </p>

                                            @endif

                                        </td>


                                        {{-- CATEGORY --}}
                                        <td class="px-6 py-5">


                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                                {{ $product->category->name ?? 'N/A' }}
                                            </span>

                                        </td>


                                        {{-- STOCK --}}
                                        <td class="px-6 py-5">


                                            @if($product->stock <= 0)

                                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                                                    Out of Stock
                                                </span>

                                            @elseif($product->stock <= 5)

                                                <span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">
                                                    Low: {{ $product->stock }}
                                                </span>

                                            @else

                                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                                    {{ $product->stock }}
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-5">


                                            @if($productActive)

                                                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                                    Active
                                                </span>

                                            @else

                                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-bold text-red-700">
                                                    Inactive
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-6 py-5">


                                            <div class="flex items-center gap-2">


                                                <a
                                                    href="{{ route('vendor.products.edit', $product->id) }}"
                                                    class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-bold text-white transition hover:bg-emerald-700"
                                                >
                                                    Edit
                                                </a>


                                                <form
                                                    action="{{ route('vendor.products.destroy', $product->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this product?');"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="rounded-xl bg-red-50 px-4 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>


                                @endforeach


                            </tbody>

                        </table>

                    </div>


                    {{-- MOBILE --}}
                    <div class="space-y-4 p-4 md:hidden">


                        @foreach($products as $product)


                            @php

                                $productActive =
                                    $product->is_active &&
                                    $product->is_available;

                            @endphp


                            <article class="rounded-2xl border border-slate-200 p-4">


                                <div class="flex gap-4">


                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-2xl bg-slate-100">


                                        @if($product->image)

                                            <img
                                                src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover"
                                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                            >

                                        @else

                                            <img
                                                src="{{ asset('images/products/product-placeholder.png') }}"
                                                alt="Product"
                                                class="h-full w-full object-cover"
                                            >

                                        @endif

                                    </div>


                                    <div class="min-w-0 flex-1">


                                        <div class="flex items-start justify-between gap-2">


                                            <h3 class="truncate font-black text-slate-900">
                                                {{ $product->name }}
                                            </h3>


                                            @if($productActive)

                                                <span class="shrink-0 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-700">
                                                    Active
                                                </span>

                                            @else

                                                <span class="shrink-0 rounded-full bg-red-50 px-2 py-1 text-[10px] font-bold text-red-700">
                                                    Inactive
                                                </span>

                                            @endif

                                        </div>


                                        <p class="mt-2 text-lg font-black text-emerald-700">
                                            ₹{{ number_format((float) ($product->discount_price ?? $product->price), 2) }}
                                        </p>


                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $product->category->name ?? 'N/A' }}
                                        </p>

                                    </div>

                                </div>


                                <div class="mt-4 grid grid-cols-2 gap-3">


                                    <div class="rounded-xl bg-slate-50 p-3">

                                        <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                            Stock
                                        </p>


                                        @if($product->stock <= 0)

                                            <p class="mt-1 text-sm font-bold text-red-600">
                                                Out of Stock
                                            </p>

                                        @elseif($product->stock <= 5)

                                            <p class="mt-1 text-sm font-bold text-amber-600">
                                                Low: {{ $product->stock }}
                                            </p>

                                        @else

                                            <p class="mt-1 text-sm font-bold text-emerald-700">
                                                {{ $product->stock }}
                                            </p>

                                        @endif

                                    </div>


                                    <div class="rounded-xl bg-slate-50 p-3">

                                        <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                            Product ID
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-700">
                                            #{{ $product->id }}
                                        </p>

                                    </div>


                                </div>


                                <div class="mt-4 grid grid-cols-2 gap-3">


                                    <a
                                        href="{{ route('vendor.products.edit', $product->id) }}"
                                        class="flex items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-700"
                                    >
                                        Edit Product
                                    </a>


                                    <form
                                        action="{{ route('vendor.products.destroy', $product->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex w-full items-center justify-center rounded-xl bg-red-50 px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-100"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </article>

                        @endforeach


                    </div>


                @else


                    {{-- EMPTY --}}
                    <div class="px-6 py-16 text-center">


                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-4xl">
                            📦
                        </div>


                        <h3 class="mt-5 text-xl font-black text-slate-950">
                            No Products Yet
                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            Add your first product to start selling on Apna Local Bazaar.
                        </p>


                        <a
                            href="{{ route('vendor.products.create') }}"
                            class="mt-6 inline-flex rounded-xl bg-emerald-600 px-5 py-3 text-sm font-black text-white transition hover:bg-emerald-700"
                        >
                            + Add Your First Product
                        </a>

                    </div>

                @endif

            </section>


            {{-- =====================================================
                FOOTER
            ====================================================== --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">


                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Vendor Dashboard
                    </p>

                </div>

            </footer>


        </main>

    </div>


</body>
</html>