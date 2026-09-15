<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Vendor Orders - Apna Local Bazaar</title>

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
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
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


                {{-- ACTIVE ORDERS --}}
                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        🛒
                    </span>

                    Orders

                    @if($orders->where('status', 'pending')->count() > 0)

                        <span class="ml-auto rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-black text-red-600">
                            {{ $orders->where('status', 'pending')->count() }}
                        </span>

                    @endif

                </a>

            </nav>


            {{-- BOTTOM --}}
            <div class="border-t border-slate-100 p-4">


                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    ← Back to Store

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

                        ↪ Logout

                    </button>

                </form>

            </div>

        </div>

    </aside>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <div class="lg:pl-72">


        {{-- HEADER --}}
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">


            <div class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">


                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                        Vendor Panel
                    </p>


                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                        Orders
                    </h1>

                </div>


                <div class="flex items-center gap-3">


                    <div class="hidden text-right sm:block">

                        <p class="text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="text-xs text-slate-400">
                            {{ auth()->user()->vendor->shop_name ?? 'My Store' }}
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


            {{-- FLASH --}}
            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                            ✓
                        </div>

                        <div>

                            <p class="font-black text-emerald-800">
                                Success
                            </p>

                            <p class="mt-1 text-sm text-emerald-700">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-black text-red-800">
                                Error
                            </p>

                            <p class="mt-1 text-sm text-red-700">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                INTRO
            ====================================================== --}}
            <section class="mb-6 overflow-hidden rounded-3xl bg-slate-900 shadow-sm">

                <div class="relative p-6 sm:p-8">


                    <div class="relative z-10">


                        <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300">
                            Order Management
                        </span>


                        <h2 class="mt-4 text-2xl font-black text-white sm:text-3xl">
                            Manage Your Orders
                        </h2>


                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                            Review customer orders, update preparation status and assign delivery partners.
                        </p>

                    </div>


                    <div class="pointer-events-none absolute -right-16 -top-24 hidden h-80 w-80 rounded-full border border-emerald-400/10 sm:block"></div>

                </div>

            </section>


            {{-- =====================================================
                STATS
            ====================================================== --}}
            <section class="mb-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- TOTAL --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl">
                            🛒
                        </div>

                        <span class="text-xs font-bold text-slate-400">
                            All
                        </span>

                    </div>


                    <p class="mt-4 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Total Orders
                    </p>


                    <p class="mt-1 text-3xl font-black text-slate-950">
                        {{ $orders->count() }}
                    </p>

                </div>


                {{-- PENDING --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-xl">
                            ⏳
                        </div>

                        <span class="text-xs font-bold text-amber-600">
                            Action
                        </span>

                    </div>


                    <p class="mt-4 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Pending
                    </p>


                    <p class="mt-1 text-3xl font-black text-amber-600">
                        {{ $orders->where('status', 'pending')->count() }}
                    </p>

                </div>


                {{-- CONFIRMED --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl">
                            ✓
                        </div>

                        <span class="text-xs font-bold text-blue-600">
                            Confirmed
                        </span>

                    </div>


                    <p class="mt-4 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Confirmed
                    </p>


                    <p class="mt-1 text-3xl font-black text-blue-600">
                        {{ $orders->where('status', 'confirmed')->count() }}
                    </p>

                </div>


                {{-- PREPARING --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                    <div class="flex items-center justify-between">

                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-xl">
                            🍳
                        </div>

                        <span class="text-xs font-bold text-purple-600">
                            Kitchen
                        </span>

                    </div>


                    <p class="mt-4 text-xs font-bold uppercase tracking-wide text-slate-400">
                        Preparing
                    </p>


                    <p class="mt-1 text-3xl font-black text-purple-600">
                        {{ $orders->where('status', 'preparing')->count() }}
                    </p>

                </div>

            </section>


            {{-- =====================================================
                ORDERS
            ====================================================== --}}
            @if($orders->count() > 0)


                <div class="space-y-6">


                    @foreach($orders as $order)


                        @php

                            $vendorItems = $order->items->filter(function ($item) use ($vendorId) {
                                return $item->product && $item->product->vendor_id == $vendorId;
                            });


                            $vendorSubtotal = $vendorItems->sum(function ($item) {
                                return (float) $item->price * (int) $item->quantity;
                            });


                            $statusLabel = $statusLabels[$order->status]
                                ?? ucfirst(str_replace('_', ' ', $order->status));


                            $statusClass = $statusClasses[$order->status]
                                ?? 'bg-slate-100 text-slate-700 ring-slate-200';


                            $deliveryStatus = optional($order->deliveryAssignment)->status;


                            $deliveryClass = match($deliveryStatus) {

                                'assigned'
                                    => 'bg-blue-50 text-blue-700 ring-blue-200',

                                'picked_up'
                                    => 'bg-purple-50 text-purple-700 ring-purple-200',

                                'out_for_delivery'
                                    => 'bg-orange-50 text-orange-700 ring-orange-200',

                                'delivered'
                                    => 'bg-emerald-50 text-emerald-700 ring-emerald-200',

                                default
                                    => 'bg-slate-50 text-slate-500 ring-slate-200',
                            };


                            $customerPhone =
                                $order->address?->phone
                                ?? $order->user?->phone
                                ?? 'N/A';

                        @endphp


                        <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:shadow-md">


                            {{-- =================================================
                                ORDER HEADER
                            ================================================== --}}
                            <div class="border-b border-slate-100 bg-slate-50/70 px-5 py-5 sm:px-7">


                                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">


                                    <div class="min-w-0">


                                        <div class="flex flex-wrap items-center gap-3">


                                            <h2 class="break-all text-lg font-black text-slate-900 sm:text-xl">
                                                #{{ $order->order_number }}
                                            </h2>


                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>


                                        </div>


                                        <p class="mt-2 text-xs text-slate-400 sm:text-sm">
                                            Placed on
                                            {{ $order->created_at?->format('d M Y, h:i A') }}
                                        </p>


                                    </div>


                                    {{-- PAYMENT --}}
                                    <div class="flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-3">


                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                            ₹
                                        </div>


                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                                Payment
                                            </p>

                                            <p class="text-sm font-black text-slate-800">
                                                {{ strtoupper($order->payment_method ?? 'N/A') }}
                                            </p>

                                            <p class="text-[10px] font-semibold text-slate-400">
                                                {{ ucfirst($order->payment_status ?? 'pending') }}
                                            </p>

                                        </div>

                                    </div>


                                </div>

                            </div>


                            {{-- =================================================
                                ORDER BODY
                            ================================================== --}}
                            <div class="grid gap-5 p-5 sm:p-7 lg:grid-cols-3">


                                {{-- CUSTOMER --}}
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">


                                    <div class="flex items-center gap-3">

                                        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-100 text-blue-700">
                                            👤
                                        </div>


                                        <div>

                                            <h3 class="font-black text-slate-900">
                                                Customer
                                            </h3>

                                            <p class="text-xs text-slate-400">
                                                Customer details
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-5 space-y-4">


                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                                Name
                                            </p>

                                            <p class="mt-1 font-bold text-slate-800">
                                                {{ $order->user?->name ?? 'N/A' }}
                                            </p>

                                        </div>


                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                                Phone
                                            </p>

                                            <p class="mt-1 break-all font-bold text-slate-800">
                                                {{ $customerPhone }}
                                            </p>

                                        </div>


                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                                Email
                                            </p>

                                            <p class="mt-1 break-all text-sm font-semibold text-slate-600">
                                                {{ $order->user?->email ?? 'N/A' }}
                                            </p>

                                        </div>


                                    </div>

                                </div>


                                {{-- PRODUCTS --}}
                                <div class="overflow-hidden rounded-2xl border border-slate-200 lg:col-span-2">


                                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">


                                        <div>

                                            <h3 class="font-black text-slate-900">
                                                Your Products
                                            </h3>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Products from your store in this order
                                            </p>

                                        </div>


                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                            {{ $vendorItems->count() }}
                                            {{ $vendorItems->count() === 1 ? 'item' : 'items' }}
                                        </span>

                                    </div>


                                    <div class="divide-y divide-slate-100">


                                        @forelse($vendorItems as $item)


                                            <div class="flex items-center gap-4 px-5 py-4">


                                                {{-- PRODUCT IMAGE --}}
                                                <div class="h-14 w-14 shrink-0 overflow-hidden rounded-xl bg-slate-100">


                                                    @if($item->product?->image)

                                                        <img
                                                            src="{{ asset('storage/' . ltrim($item->product->image, '/')) }}"
                                                            alt="{{ $item->product->name }}"
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

                                                    <p class="truncate font-bold text-slate-800">
                                                        {{ $item->product?->name ?? 'Product unavailable' }}
                                                    </p>

                                                    <p class="mt-1 text-sm text-slate-500">
                                                        ₹{{ number_format((float) $item->price, 2) }}
                                                        ×
                                                        {{ $item->quantity }}
                                                    </p>

                                                </div>


                                                <p class="shrink-0 font-black text-slate-900">
                                                    ₹{{ number_format((float) $item->price * (int) $item->quantity, 2) }}
                                                </p>

                                            </div>


                                        @empty


                                            <div class="px-5 py-8 text-center text-sm text-slate-400">
                                                No products from your store found in this order.
                                            </div>


                                        @endforelse


                                    </div>


                                    {{-- VENDOR SUBTOTAL --}}
                                    <div class="flex items-center justify-between border-t border-slate-100 bg-emerald-50/50 px-5 py-4">


                                        <span class="text-sm font-bold text-slate-700">
                                            Your Store Subtotal
                                        </span>


                                        <span class="text-lg font-black text-emerald-700">
                                            ₹{{ number_format($vendorSubtotal, 2) }}
                                        </span>

                                    </div>


                                </div>

                            </div>


                            {{-- =================================================
                                DELIVERY / ADDRESS
                            ================================================== --}}
                            <div class="grid gap-5 border-t border-slate-100 bg-white px-5 py-5 sm:px-7 lg:grid-cols-2">


                                {{-- ADDRESS --}}
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">


                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-100 text-orange-700">
                                            📍
                                        </div>


                                        <div>

                                            <h3 class="font-black text-slate-900">
                                                Delivery Address
                                            </h3>

                                            <p class="text-xs text-slate-400">
                                                Customer location
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-4 text-sm leading-6 text-slate-700">


                                        @if($order->address)


                                            @php

                                                $addressLine =
                                                    $order->address->address_line
                                                    ?? $order->address->address
                                                    ?? $order->address->full_address;

                                                $city = $order->address->city;

                                                $state = $order->address->state;

                                                $pincode =
                                                    $order->address->pincode
                                                    ?? $order->address->postal_code
                                                    ?? $order->address->zip_code;

                                            @endphp


                                            @if($addressLine)
                                                <p>{{ $addressLine }}</p>
                                            @endif


                                            @if($city)
                                                <p>{{ $city }}</p>
                                            @endif


                                            @if($state)
                                                <p>{{ $state }}</p>
                                            @endif


                                            @if($pincode)
                                                <p class="font-bold">{{ $pincode }}</p>
                                            @endif


                                        @else


                                            <p class="font-semibold text-slate-400">
                                                Address unavailable
                                            </p>


                                        @endif

                                    </div>

                                </div>


                                {{-- DELIVERY --}}
                                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5">


                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                            🚚
                                        </div>


                                        <div>

                                            <h3 class="font-black text-slate-900">
                                                Delivery
                                            </h3>

                                            <p class="text-xs text-slate-400">
                                                Delivery assignment
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-4 space-y-3">


                                        <div class="flex items-center justify-between gap-3">


                                            <span class="text-sm text-slate-500">
                                                Status
                                            </span>


                                            @if($deliveryStatus)

                                                <span class="rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $deliveryClass }}">
                                                    {{ ucfirst(str_replace('_', ' ', $deliveryStatus)) }}
                                                </span>

                                            @else

                                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                                                    Not Assigned
                                                </span>

                                            @endif


                                        </div>


                                        <div class="flex items-center justify-between gap-3">

                                            <span class="text-sm text-slate-500">
                                                Delivery Boy
                                            </span>


                                            <span class="text-right text-sm font-bold text-slate-700">

                                                {{
                                                    $order->deliveryAssignment?->deliveryBoy?->user?->name
                                                    ?? 'Not Assigned'
                                                }}

                                            </span>

                                        </div>


                                    </div>

                                </div>

                            </div>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <div class="border-t border-slate-100 bg-slate-50/70 px-5 py-5 sm:px-7">


                                <div class="flex flex-col gap-5 xl:flex-row xl:items-end xl:justify-between">


                                    {{-- STATUS --}}
                                    <form
                                        action="{{ route('vendor.orders.update-status', $order->id) }}"
                                        method="POST"
                                        class="w-full xl:max-w-xl"
                                    >

                                        @csrf

                                        @method('PUT')


                                        <label
                                            for="status-{{ $order->id }}"
                                            class="mb-2 block text-sm font-black text-slate-700"
                                        >
                                            Update Order Status
                                        </label>


                                        <div class="flex flex-col gap-3 sm:flex-row">


                                            <select
                                                id="status-{{ $order->id }}"
                                                name="status"
                                                class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 sm:flex-1"
                                            >


                                                <option
                                                    value="pending"
                                                    {{ $order->status === 'pending' ? 'selected' : '' }}
                                                >
                                                    Pending
                                                </option>


                                                <option
                                                    value="confirmed"
                                                    {{ $order->status === 'confirmed' ? 'selected' : '' }}
                                                >
                                                    Confirmed
                                                </option>


                                                <option
                                                    value="preparing"
                                                    {{ $order->status === 'preparing' ? 'selected' : '' }}
                                                >
                                                    Preparing
                                                </option>


                                            </select>


                                            <button
                                                type="submit"
                                                class="inline-flex h-12 items-center justify-center rounded-xl bg-emerald-600 px-5 text-sm font-black text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                                            >
                                                Update Status
                                            </button>


                                        </div>


                                    </form>


                                    {{-- RIGHT ACTIONS --}}
                                    <div class="flex flex-col gap-3 sm:flex-row">


                                        <div class="rounded-xl border border-slate-200 bg-white px-5 py-3 sm:min-w-[150px]">

                                            <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                                Order Total
                                            </p>

                                            <p class="text-xl font-black text-slate-900">
                                                ₹{{ number_format((float) $order->total_amount, 2) }}
                                            </p>

                                        </div>


                                        @if(!$order->deliveryAssignment || $deliveryStatus !== 'delivered')

                                            <a
                                                href="{{ route('vendor.orders.assign', $order->id) }}"
                                                class="inline-flex h-12 items-center justify-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-5 text-sm font-black text-emerald-700 transition hover:bg-emerald-100"
                                            >
                                                🚚
                                                {{ $order->deliveryAssignment ? 'Reassign Delivery' : 'Assign Delivery' }}
                                            </a>

                                        @else

                                            <div class="inline-flex h-12 items-center justify-center rounded-xl bg-emerald-100 px-5 text-sm font-black text-emerald-700">
                                                ✓ Delivered

                                            </div>

                                        @endif


                                    </div>

                                </div>

                            </div>


                        </article>


                    @endforeach


                </div>


            @else


                {{-- EMPTY STATE --}}
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">


                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-4xl">
                        🛒
                    </div>


                    <h2 class="mt-6 text-2xl font-black text-slate-950">
                        No Orders Yet
                    </h2>


                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        You don't have any customer orders yet.
                        Orders placed for your products will appear here.
                    </p>


                    <a
                        href="{{ route('vendor.dashboard') }}"
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-black text-white transition hover:bg-emerald-700"
                    >
                        ← Back to Dashboard
                    </a>

                </div>

            @endif


            {{-- FOOTER --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">


                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Vendor Order Management
                    </p>

                </div>

            </footer>


        </main>

    </div>


</body>
</html>