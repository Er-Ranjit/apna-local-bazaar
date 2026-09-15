<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders Management - Apna Local Bazaar</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

{{-- =========================================================
    SIDEBAR
========================================================= --}}
<aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">

    <div class="flex h-full flex-col">

        {{-- BRAND --}}
        <div class="flex h-20 items-center border-b border-slate-100 px-6">

            <a
                href="{{ route('admin.dashboard') }}"
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
                        Admin Panel
                    </p>
                </div>
            </a>

        </div>


        {{-- NAVIGATION --}}
        <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

            <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">
                Management
            </p>


            {{-- DASHBOARD --}}
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                    📊
                </span>

                Dashboard
            </a>


            {{-- USERS --}}
            <a
                href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                    👥
                </span>

                Users
            </a>


            {{-- VENDORS --}}
            <a
                href="{{ route('admin.vendors.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                    🏪
                </span>

                Vendors
            </a>


            {{-- PRODUCTS --}}
            <a
                href="{{ route('admin.products.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                    📦
                </span>

                Products
            </a>


            {{-- ACTIVE ORDERS --}}
            <a
                href="{{ route('admin.orders.index') }}"
                class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                    🛒
                </span>

                Orders
            </a>


            {{-- DELIVERY --}}
            <a
                href="{{ route('admin.delivery-assignments.index') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                    🚚
                </span>

                Delivery Assignments
            </a>

        </nav>


        {{-- BOTTOM --}}
        <div class="border-t border-slate-100 p-4">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
            >
                ←
                Back to Store
            </a>

        </div>

    </div>

</aside>


{{-- =========================================================
    MAIN
========================================================= --}}
<div class="lg:pl-72">


    {{-- HEADER --}}
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">

        <div class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

            <div>

                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                    Admin Panel
                </p>

                <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                    Orders Management
                </h1>

            </div>


            <div class="flex items-center gap-2">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:inline-flex"
                >
                    ← Dashboard
                </a>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="rounded-xl border border-red-100 bg-red-50 px-3 py-2.5 text-xs font-bold text-red-600 transition hover:bg-red-100 sm:px-4"
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


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3">

                <div class="flex items-center gap-3">

                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                        ✓
                    </span>

                    <p class="text-sm font-bold text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- ERROR --}}
        @if(session('error'))

            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3">

                <div class="flex items-center gap-3">

                    <span class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100 text-red-700">
                        !
                    </span>

                    <p class="text-sm font-bold text-red-700">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- =====================================================
            PAGE INTRO
        ====================================================== --}}
        <section class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700">
                        Order Directory
                    </span>

                    <h2 class="mt-3 text-2xl font-black text-slate-950 sm:text-3xl">
                        All Orders
                    </h2>

                    <p class="mt-2 max-w-2xl text-sm text-slate-500">
                        Monitor customers, payment status, order progress and delivery assignments.
                    </p>

                </div>


                {{-- RESULT COUNT --}}
                <div class="flex items-center gap-4 rounded-2xl bg-slate-50 px-5 py-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-2xl">
                        🛒
                    </div>

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                            Results
                        </p>

                        <p class="mt-1 text-2xl font-black text-slate-950">
                            {{ $orders->count() }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                SEARCH + FILTERS
            ================================================== --}}
            <form
                method="GET"
                action="{{ route('admin.orders.index') }}"
                class="mt-6"
            >

                <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_210px_210px_auto]">

                    {{-- SEARCH --}}
                    <div class="relative">

                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                            🔍
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search order number, customer or email..."
                            class="h-12 w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 text-sm font-medium text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- ORDER STATUS --}}
                    <select
                        name="status"
                        class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                    >

                        <option value="">
                            All Order Status
                        </option>

                        <option
                            value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}
                        >
                            Pending
                        </option>

                        <option
                            value="confirmed"
                            {{ request('status') === 'confirmed' ? 'selected' : '' }}
                        >
                            Confirmed
                        </option>

                        <option
                            value="preparing"
                            {{ request('status') === 'preparing' ? 'selected' : '' }}
                        >
                            Preparing
                        </option>

                        <option
                            value="out_for_delivery"
                            {{ request('status') === 'out_for_delivery' ? 'selected' : '' }}
                        >
                            Out for Delivery
                        </option>

                        <option
                            value="delivered"
                            {{ request('status') === 'delivered' ? 'selected' : '' }}
                        >
                            Delivered
                        </option>

                    </select>


                    {{-- PAYMENT --}}
                    <select
                        name="payment"
                        class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                    >

                        <option value="">
                            All Payments
                        </option>

                        <option
                            value="pending"
                            {{ request('payment') === 'pending' ? 'selected' : '' }}
                        >
                            Payment Pending
                        </option>

                        <option
                            value="paid"
                            {{ request('payment') === 'paid' ? 'selected' : '' }}
                        >
                            Paid
                        </option>

                        <option
                            value="failed"
                            {{ request('payment') === 'failed' ? 'selected' : '' }}
                        >
                            Failed
                        </option>

                    </select>


                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="h-12 rounded-xl bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                    >
                        Search Orders
                    </button>

                </div>


                {{-- ACTIVE FILTERS --}}
                @if(
                    request()->filled('search') ||
                    request()->filled('status') ||
                    request()->filled('payment')
                )

                    <div class="mt-4 flex flex-wrap items-center gap-2">

                        <span class="text-xs font-semibold text-slate-400">
                            Active filters:
                        </span>


                        @if(request()->filled('search'))

                            <span class="rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                Search: {{ request('search') }}
                            </span>

                        @endif


                        @if(request()->filled('status'))

                            <span class="rounded-full bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">
                                Status:
                                {{ ucwords(str_replace('_', ' ', request('status'))) }}
                            </span>

                        @endif


                        @if(request()->filled('payment'))

                            <span class="rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">
                                Payment:
                                {{ ucfirst(request('payment')) }}
                            </span>

                        @endif


                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-100"
                        >
                            Clear Filters ✕
                        </a>

                    </div>

                @endif

            </form>

        </section>


        {{-- =====================================================
            ORDERS
        ====================================================== --}}
        @if($orders->count() > 0)


            {{-- DESKTOP TABLE --}}
            <div class="hidden overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:block">

                <div class="border-b border-slate-100 px-6 py-5">

                    <h3 class="text-lg font-black text-slate-950">
                        Registered Orders
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $orders->count() }} matching orders found.
                    </p>

                </div>


                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1350px]">

                        <thead class="bg-slate-50">

                            <tr class="border-b border-slate-200 text-left">

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Order
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Customer
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Vendor
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Amount
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Order Status
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Payment
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Delivery
                                </th>

                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach($orders as $order)

                                @php

                                    $statusClass = match($order->status) {

                                        'pending' =>
                                            'bg-amber-50 text-amber-700 ring-amber-200',

                                        'confirmed' =>
                                            'bg-blue-50 text-blue-700 ring-blue-200',

                                        'preparing' =>
                                            'bg-orange-50 text-orange-700 ring-orange-200',

                                        'out_for_delivery' =>
                                            'bg-violet-50 text-violet-700 ring-violet-200',

                                        'delivered' =>
                                            'bg-emerald-50 text-emerald-700 ring-emerald-200',

                                        default =>
                                            'bg-slate-100 text-slate-700 ring-slate-200',

                                    };


                                    $paymentClass = match($order->payment_status) {

                                        'paid' =>
                                            'bg-emerald-50 text-emerald-700 ring-emerald-200',

                                        'failed' =>
                                            'bg-red-50 text-red-700 ring-red-200',

                                        default =>
                                            'bg-amber-50 text-amber-700 ring-amber-200',

                                    };


                                    $vendorNames = $order->items
                                        ->map(fn($item) => $item->product?->vendor?->shop_name)
                                        ->filter()
                                        ->unique()
                                        ->values();

                                @endphp


                                <tr class="transition hover:bg-slate-50">


                                    {{-- ORDER --}}
                                    <td class="px-6 py-5">

                                        <p class="font-black text-slate-900">
                                            #{{ $order->order_number }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $order->created_at?->format('d M Y, h:i A') }}
                                        </p>

                                    </td>


                                    {{-- CUSTOMER --}}
                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="text-sm font-bold text-slate-800">
                                                {{ $order->user->name ?? 'N/A' }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $order->user->email ?? 'N/A' }}
                                            </p>

                                        </div>

                                    </td>


                                    {{-- VENDOR --}}
                                    <td class="px-6 py-5">

                                        @forelse($vendorNames as $vendorName)

                                            <span class="mb-1 mr-1 inline-flex rounded-full bg-purple-50 px-3 py-1 text-xs font-bold text-purple-700">
                                                {{ $vendorName }}
                                            </span>

                                        @empty

                                            <span class="text-sm text-slate-400">
                                                N/A
                                            </span>

                                        @endforelse

                                    </td>


                                    {{-- AMOUNT --}}
                                    <td class="px-6 py-5">

                                        <p class="text-base font-black text-slate-900">
                                            ₹{{ number_format($order->total_amount, 2) }}
                                        </p>

                                        <p class="mt-1 text-[11px] font-semibold uppercase text-slate-400">
                                            {{ strtoupper($order->payment_method ?? 'N/A') }}
                                        </p>

                                    </td>


                                    {{-- ORDER STATUS --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $statusClass }}">
                                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                        </span>

                                    </td>


                                    {{-- PAYMENT --}}
                                    <td class="px-6 py-5">

                                        <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $paymentClass }}">
                                            {{ ucfirst($order->payment_status ?? 'pending') }}
                                        </span>

                                    </td>


                                    {{-- DELIVERY --}}
                                    <td class="px-6 py-5">

                                        @if($order->deliveryAssignment?->deliveryBoy?->user)

                                            <p class="text-sm font-bold text-slate-700">
                                                {{ $order->deliveryAssignment->deliveryBoy->user->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ ucwords(str_replace('_', ' ', $order->deliveryAssignment->status ?? 'assigned')) }}
                                            </p>

                                        @else

                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">
                                                Not Assigned
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTION --}}
                                    <td class="px-6 py-5">

                                        <a
                                            href="{{ route('admin.orders.show', $order) }}"
                                            class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700"
                                        >
                                            View Order
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- MOBILE CARDS --}}
            <div class="space-y-4 md:hidden">

                @foreach($orders as $order)

                    @php

                        $statusClass = match($order->status) {

                            'pending' =>
                                'bg-amber-50 text-amber-700',

                            'confirmed' =>
                                'bg-blue-50 text-blue-700',

                            'preparing' =>
                                'bg-orange-50 text-orange-700',

                            'out_for_delivery' =>
                                'bg-violet-50 text-violet-700',

                            'delivered' =>
                                'bg-emerald-50 text-emerald-700',

                            default =>
                                'bg-slate-100 text-slate-700',

                        };


                        $paymentClass = match($order->payment_status) {

                            'paid' =>
                                'bg-emerald-50 text-emerald-700',

                            'failed' =>
                                'bg-red-50 text-red-700',

                            default =>
                                'bg-amber-50 text-amber-700',

                        };


                        $vendorNames = $order->items
                            ->map(fn($item) => $item->product?->vendor?->shop_name)
                            ->filter()
                            ->unique()
                            ->values();

                    @endphp


                    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                        {{-- TOP --}}
                        <div class="p-5">

                            <div class="flex items-start justify-between gap-3">

                                <div>

                                    <p class="font-black text-slate-900">
                                        #{{ $order->order_number }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at?->format('d M Y, h:i A') }}
                                    </p>

                                </div>


                                <span class="rounded-full px-3 py-1 text-[10px] font-bold {{ $statusClass }}">
                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                </span>

                            </div>


                            {{-- CUSTOMER --}}
                            <div class="mt-5 rounded-xl bg-slate-50 p-3">

                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                    Customer
                                </p>

                                <p class="mt-1 font-bold text-slate-800">
                                    {{ $order->user->name ?? 'N/A' }}
                                </p>

                                <p class="mt-1 break-all text-xs text-slate-500">
                                    {{ $order->user->email ?? 'N/A' }}
                                </p>

                            </div>


                            {{-- VENDOR --}}
                            <div class="mt-3 rounded-xl bg-slate-50 p-3">

                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                    Vendor
                                </p>

                                <div class="mt-2 flex flex-wrap gap-1">

                                    @forelse($vendorNames as $vendorName)

                                        <span class="rounded-full bg-purple-50 px-2.5 py-1 text-[10px] font-bold text-purple-700">
                                            {{ $vendorName }}
                                        </span>

                                    @empty

                                        <span class="text-sm text-slate-400">
                                            N/A
                                        </span>

                                    @endforelse

                                </div>

                            </div>


                            {{-- DETAILS --}}
                            <div class="mt-3 grid grid-cols-2 gap-3">


                                {{-- AMOUNT --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Amount
                                    </p>

                                    <p class="mt-1 text-lg font-black text-emerald-700">
                                        ₹{{ number_format($order->total_amount, 2) }}
                                    </p>

                                </div>


                                {{-- PAYMENT --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Payment
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-slate-700">
                                        {{ strtoupper($order->payment_method ?? 'N/A') }}
                                    </p>

                                    <span class="mt-1 inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold {{ $paymentClass }}">
                                        {{ ucfirst($order->payment_status ?? 'pending') }}
                                    </span>

                                </div>


                                {{-- DELIVERY --}}
                                <div class="col-span-2 rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Delivery
                                    </p>

                                    @if($order->deliveryAssignment?->deliveryBoy?->user)

                                        <p class="mt-1 text-sm font-bold text-slate-700">
                                            {{ $order->deliveryAssignment->deliveryBoy->user->name }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500">
                                            {{ ucwords(str_replace('_', ' ', $order->deliveryAssignment->status ?? 'assigned')) }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm font-semibold text-slate-400">
                                            Not Assigned
                                        </p>

                                    @endif

                                </div>

                            </div>


                            {{-- ACTION --}}
                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="mt-4 flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                            >
                                View Order →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- EMPTY --}}
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">

                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-emerald-50 text-4xl">
                    🛒
                </div>

                <h2 class="mt-6 text-2xl font-black text-slate-950">
                    No Orders Found
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    No order matched your current search or filters.
                </p>

                <a
                    href="{{ route('admin.orders.index') }}"
                    class="mt-6 inline-flex rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-700"
                >
                    Clear Filters
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
                    Orders Management
                </p>

            </div>

        </footer>

    </main>

</div>

</body>
</html>