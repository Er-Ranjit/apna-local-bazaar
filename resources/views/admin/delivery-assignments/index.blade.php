<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delivery Assignments - Apna Local Bazaar</title>

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


                {{-- ORDERS --}}
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🛒
                    </span>

                    Orders
                </a>


                {{-- DELIVERY ASSIGNMENTS --}}
                <a
                    href="{{ route('admin.delivery-assignments.index') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
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
                    <span>←</span>

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

            <div class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                        Admin Panel
                    </p>

                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                        Delivery Assignments
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

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 shadow-sm">

                    <div class="flex items-center gap-3">

                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
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

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 shadow-sm">

                    <div class="flex items-center gap-3">

                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">
                            !
                        </span>

                        <p class="text-sm font-bold text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                INTRO
            ====================================================== --}}
            <section class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700">
                            Delivery Operations
                        </span>

                        <h2 class="mt-3 text-2xl font-black text-slate-950 sm:text-3xl">
                            All Assignments
                        </h2>

                        <p class="mt-2 max-w-2xl text-sm text-slate-500">
                            Monitor which delivery boy is handling each order and track live delivery progress.
                        </p>

                    </div>


                    {{-- RESULT COUNT --}}
                    <div class="flex items-center gap-4 rounded-2xl bg-slate-50 px-5 py-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-2xl">
                            🚚
                        </div>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Results
                            </p>

                            <p class="mt-1 text-2xl font-black text-slate-950">
                                {{ $assignments->count() }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    DELIVERY SUMMARY CARDS
                ================================================== --}}
                <div class="mt-6 grid grid-cols-2 gap-4 xl:grid-cols-4">


                    {{-- TOTAL --}}
                    <div class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                                    Total Assignments
                                </p>

                                <p class="mt-2 text-3xl font-black text-slate-950">
                                    {{ $totalAssignments }}
                                </p>

                                <p class="mt-1 text-xs font-medium text-slate-400">
                                    All delivery records
                                </p>

                            </div>


                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 text-2xl">
                                🚚
                            </div>

                        </div>

                    </div>


                    {{-- ASSIGNED --}}
                    <div class="group rounded-2xl border border-blue-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wide text-blue-500">
                                    Assigned
                                </p>

                                <p class="mt-2 text-3xl font-black text-slate-950">
                                    {{ $assignedAssignments }}
                                </p>

                                <p class="mt-1 text-xs font-medium text-slate-400">
                                    Waiting for pickup
                                </p>

                            </div>


                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-2xl">
                                📋
                            </div>

                        </div>

                    </div>


                    {{-- ON THE WAY --}}
                    <div class="group rounded-2xl border border-violet-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wide text-violet-500">
                                    On The Way
                                </p>

                                <p class="mt-2 text-3xl font-black text-slate-950">
                                    {{ $outForDeliveryAssignments }}
                                </p>

                                <p class="mt-1 text-xs font-medium text-slate-400">
                                    Out for delivery
                                </p>

                            </div>


                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-2xl">
                                🛵
                            </div>

                        </div>

                    </div>


                    {{-- DELIVERED --}}
                    <div class="group rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <p class="text-xs font-bold uppercase tracking-wide text-emerald-500">
                                    Delivered
                                </p>

                                <p class="mt-2 text-3xl font-black text-slate-950">
                                    {{ $deliveredAssignments }}
                                </p>

                                <p class="mt-1 text-xs font-medium text-slate-400">
                                    Successfully delivered
                                </p>

                            </div>


                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">
                                ✅
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SEARCH + FILTER
                ================================================== --}}
                <form
                    method="GET"
                    action="{{ route('admin.delivery-assignments.index') }}"
                    class="mt-6"
                >

                    <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_230px_auto]">


                        {{-- SEARCH --}}
                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                🔍
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search order, customer or delivery boy..."
                                class="h-12 w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 text-sm font-medium text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            >

                        </div>


                        {{-- STATUS --}}
                        <select
                            name="status"
                            class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                        >

                            <option value="">
                                All Delivery Status
                            </option>

                            <option
                                value="assigned"
                                {{ request('status') === 'assigned' ? 'selected' : '' }}
                            >
                                Assigned
                            </option>

                            <option
                                value="picked_up"
                                {{ request('status') === 'picked_up' ? 'selected' : '' }}
                            >
                                Picked Up
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


                        {{-- SEARCH BUTTON --}}
                        <button
                            type="submit"
                            class="h-12 rounded-xl bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                        >
                            Search Assignments
                        </button>

                    </div>


                    {{-- FILTER CHIPS --}}
                    @if(request()->filled('search') || request()->filled('status'))

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

                                <span class="rounded-full bg-violet-50 px-3 py-1.5 text-xs font-bold text-violet-700">
                                    Status:
                                    {{ ucwords(str_replace('_', ' ', request('status'))) }}
                                </span>

                            @endif


                            <a
                                href="{{ route('admin.delivery-assignments.index') }}"
                                class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-100"
                            >
                                Clear Filters ✕
                            </a>

                        </div>

                    @endif

                </form>

            </section>


            {{-- =====================================================
                ASSIGNMENTS
            ====================================================== --}}
            @if($assignments->count() > 0)


                {{-- =================================================
                    DESKTOP TABLE
                ================================================== --}}
                <div class="hidden overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:block">

                    <div class="border-b border-slate-100 px-6 py-5">

                        <h3 class="text-lg font-black text-slate-950">
                            Delivery Assignment Records
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $assignments->count() }} matching assignments found.
                        </p>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[1200px]">

                            <thead class="bg-slate-50">

                                <tr class="border-b border-slate-200 text-left">

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Assignment
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Order
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Customer
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Delivery Boy
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Delivery Status
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Assigned
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach($assignments as $assignment)

                                    @php

                                        $deliveryStatus = $assignment->status ?? 'assigned';

                                        $statusClass = match($deliveryStatus) {

                                            'assigned' =>
                                                'bg-blue-50 text-blue-700 ring-blue-200',

                                            'picked_up' =>
                                                'bg-orange-50 text-orange-700 ring-orange-200',

                                            'out_for_delivery' =>
                                                'bg-violet-50 text-violet-700 ring-violet-200',

                                            'delivered' =>
                                                'bg-emerald-50 text-emerald-700 ring-emerald-200',

                                            default =>
                                                'bg-slate-100 text-slate-700 ring-slate-200',

                                        };

                                    @endphp


                                    <tr class="transition hover:bg-slate-50">


                                        {{-- ASSIGNMENT --}}
                                        <td class="px-6 py-5">

                                            <p class="font-mono text-sm font-black text-slate-700">
                                                #{{ $assignment->id }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                Delivery Assignment
                                            </p>

                                        </td>


                                        {{-- ORDER --}}
                                        <td class="px-6 py-5">

                                            @if($assignment->order)

                                                <p class="font-black text-slate-900">
                                                    #{{ $assignment->order->order_number }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    ₹{{ number_format($assignment->order->total_amount, 2) }}
                                                </p>

                                            @else

                                                <span class="text-sm text-slate-400">
                                                    Order unavailable
                                                </span>

                                            @endif

                                        </td>


                                        {{-- CUSTOMER --}}
                                        <td class="px-6 py-5">

                                            @if($assignment->order?->user)

                                                <p class="text-sm font-bold text-slate-800">
                                                    {{ $assignment->order->user->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $assignment->order->user->email }}
                                                </p>

                                            @else

                                                <span class="text-sm text-slate-400">
                                                    N/A
                                                </span>

                                            @endif

                                        </td>


                                        {{-- DELIVERY BOY --}}
                                        <td class="px-6 py-5">

                                            @if($assignment->deliveryBoy?->user)

                                                <div class="flex items-center gap-3">

                                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-violet-100 text-sm font-black text-violet-700">
                                                        {{ strtoupper(substr($assignment->deliveryBoy->user->name, 0, 1)) }}
                                                    </div>

                                                    <div>

                                                        <p class="text-sm font-bold text-slate-800">
                                                            {{ $assignment->deliveryBoy->user->name }}
                                                        </p>

                                                        <p class="mt-1 text-xs text-slate-400">
                                                            Delivery Boy
                                                        </p>

                                                    </div>

                                                </div>

                                            @else

                                                <span class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600">
                                                    Not Available
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-5">

                                            <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $statusClass }}">
                                                {{ ucwords(str_replace('_', ' ', $deliveryStatus)) }}
                                            </span>

                                        </td>


                                        {{-- ASSIGNED DATE --}}
                                        <td class="px-6 py-5">

                                            @if($assignment->created_at)

                                                <p class="text-sm font-semibold text-slate-700">
                                                    {{ $assignment->created_at->format('d M Y') }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $assignment->created_at->format('h:i A') }}
                                                </p>

                                            @else

                                                <span class="text-sm text-slate-400">
                                                    N/A
                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-6 py-5">

                                            @if($assignment->order)

                                                <a
                                                    href="{{ route('admin.orders.show', $assignment->order) }}"
                                                    class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700"
                                                >
                                                    View Order
                                                </a>

                                            @else

                                                <span class="text-xs font-semibold text-slate-400">
                                                    Unavailable
                                                </span>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- =================================================
                    MOBILE CARDS
                ================================================== --}}
                <div class="space-y-4 md:hidden">

                    @foreach($assignments as $assignment)

                        @php

                            $deliveryStatus = $assignment->status ?? 'assigned';

                            $statusClass = match($deliveryStatus) {

                                'assigned' =>
                                    'bg-blue-50 text-blue-700',

                                'picked_up' =>
                                    'bg-orange-50 text-orange-700',

                                'out_for_delivery' =>
                                    'bg-violet-50 text-violet-700',

                                'delivered' =>
                                    'bg-emerald-50 text-emerald-700',

                                default =>
                                    'bg-slate-100 text-slate-700',

                            };

                        @endphp


                        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                            {{-- TOP --}}
                            <div class="p-5">

                                <div class="flex items-start justify-between gap-3">

                                    <div>

                                        <p class="font-mono text-sm font-black text-slate-900">
                                            Assignment #{{ $assignment->id }}
                                        </p>

                                        @if($assignment->created_at)

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $assignment->created_at->format('d M Y, h:i A') }}
                                            </p>

                                        @endif

                                    </div>


                                    <span class="rounded-full px-3 py-1 text-[10px] font-bold {{ $statusClass }}">
                                        {{ ucwords(str_replace('_', ' ', $deliveryStatus)) }}
                                    </span>

                                </div>


                                {{-- ORDER --}}
                                <div class="mt-5 rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Order
                                    </p>

                                    @if($assignment->order)

                                        <p class="mt-1 font-black text-slate-900">
                                            #{{ $assignment->order->order_number }}
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-emerald-700">
                                            ₹{{ number_format($assignment->order->total_amount, 2) }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm text-slate-400">
                                            Order unavailable
                                        </p>

                                    @endif

                                </div>


                                {{-- CUSTOMER --}}
                                <div class="mt-3 rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Customer
                                    </p>

                                    @if($assignment->order?->user)

                                        <p class="mt-1 font-bold text-slate-800">
                                            {{ $assignment->order->user->name }}
                                        </p>

                                        <p class="mt-1 break-all text-xs text-slate-500">
                                            {{ $assignment->order->user->email }}
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm text-slate-400">
                                            N/A
                                        </p>

                                    @endif

                                </div>


                                {{-- DELIVERY BOY --}}
                                <div class="mt-3 rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Delivery Boy
                                    </p>

                                    @if($assignment->deliveryBoy?->user)

                                        <div class="mt-2 flex items-center gap-3">

                                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-100 font-black text-violet-700">
                                                {{ strtoupper(substr($assignment->deliveryBoy->user->name, 0, 1)) }}
                                            </div>

                                            <div>

                                                <p class="font-bold text-slate-800">
                                                    {{ $assignment->deliveryBoy->user->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Delivery Boy
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <p class="mt-1 text-sm font-bold text-red-600">
                                            Not Available
                                        </p>

                                    @endif

                                </div>


                                {{-- ACTION --}}
                                @if($assignment->order)

                                    <a
                                        href="{{ route('admin.orders.show', $assignment->order) }}"
                                        class="mt-4 flex w-full items-center justify-center rounded-xl bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                                    >
                                        View Order →
                                    </a>

                                @endif

                            </div>

                        </article>

                    @endforeach

                </div>


            @else


                {{-- EMPTY --}}
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-violet-50 text-4xl">
                        🚚
                    </div>

                    <h2 class="mt-6 text-2xl font-black text-slate-950">
                        No Delivery Assignments Found
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        No delivery assignment matched your current search or status filter.
                    </p>

                    <a
                        href="{{ route('admin.delivery-assignments.index') }}"
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
                        Delivery Assignments
                    </p>

                </div>

            </footer>

        </main>

    </div>

</body>
</html>