<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delivery Boy Dashboard - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

<div class="min-h-screen">

    {{-- TOP NAV --}}
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">

            <div class="flex items-center gap-3">

                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Apna Local Bazaar"
                        class="h-10 w-auto object-contain"
                    >

                    <div class="hidden sm:block">
                        <p class="text-sm font-bold text-slate-900">
                            Apna Local Bazaar
                        </p>

                        <p class="text-[10px] font-semibold uppercase tracking-wider text-emerald-600">
                            Delivery Panel
                        </p>
                    </div>
                </a>

            </div>


            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">
                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-[11px] text-slate-400">
                        Delivery Partner
                    </p>
                </div>

                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="hidden sm:inline-flex rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-red-500 transition hover:bg-red-50"
                    >
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </header>


    {{-- MAIN --}}
    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">


        {{-- HERO --}}
        <section class="relative mb-6 overflow-hidden rounded-3xl bg-slate-950 px-6 py-7 text-white sm:px-8 sm:py-9">

            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full border border-emerald-400/20"></div>
            <div class="absolute -bottom-24 right-16 h-44 w-44 rounded-full border border-emerald-400/10"></div>

            <div class="relative">

                <span class="inline-flex items-center rounded-full bg-emerald-500/15 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-emerald-300">
                    Delivery Dashboard
                </span>

                <h1 class="mt-4 text-2xl font-bold tracking-tight sm:text-3xl">
                    Welcome, {{ auth()->user()->name }}
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                    Manage your assigned orders and keep delivery status updated in real time.
                </p>

            </div>

        </section>


        {{-- ALERTS --}}
        @if(session('success'))

            <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 font-bold text-emerald-700">
                        ✓
                    </div>

                    <div>
                        <p class="font-semibold text-emerald-800">
                            Success
                        </p>

                        <p class="mt-1 text-sm text-emerald-700">
                            {{ session('success') }}
                        </p>
                    </div>

                </div>

            </div>

        @endif


        @if($errors->any())

            <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 font-bold text-red-700">
                        !
                    </div>

                    <div>

                        <p class="font-semibold text-red-800">
                            Please fix the following
                        </p>

                        <ul class="mt-2 space-y-1 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- STATS --}}
        @php
            $totalAssignments = $assignments->count();
            $assignedCount = $assignments->where('status', 'assigned')->count();
            $pickedUpCount = $assignments->where('status', 'picked_up')->count();
            $outForDeliveryCount = $assignments->where('status', 'out_for_delivery')->count();
            $deliveredCount = $assignments->where('status', 'delivered')->count();
        @endphp


        <section class="mb-6 grid grid-cols-2 gap-4 lg:grid-cols-5">

            {{-- TOTAL --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                    Total
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $totalAssignments }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Assigned orders
                </p>

            </div>


            {{-- ASSIGNED --}}
            <div class="rounded-2xl border border-blue-100 bg-white p-4 shadow-sm">

                <p class="text-[10px] font-bold uppercase tracking-wider text-blue-500">
                    Assigned
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $assignedCount }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    New deliveries
                </p>

            </div>


            {{-- PICKED UP --}}
            <div class="rounded-2xl border border-amber-100 bg-white p-4 shadow-sm">

                <p class="text-[10px] font-bold uppercase tracking-wider text-amber-500">
                    Picked Up
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $pickedUpCount }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Orders collected
                </p>

            </div>


            {{-- OUT FOR DELIVERY --}}
            <div class="rounded-2xl border border-violet-100 bg-white p-4 shadow-sm">

                <p class="text-[10px] font-bold uppercase tracking-wider text-violet-500">
                    On The Way
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $outForDeliveryCount }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    In delivery
                </p>

            </div>


            {{-- DELIVERED --}}
            <div class="col-span-2 rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm lg:col-span-1">

                <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-500">
                    Delivered
                </p>

                <p class="mt-2 text-2xl font-bold text-slate-900">
                    {{ $deliveredCount }}
                </p>

                <p class="mt-1 text-xs text-slate-400">
                    Completed
                </p>

            </div>

        </section>


        {{-- SECTION HEADER --}}
        <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-emerald-600">
                    Delivery Management
                </p>

                <h2 class="mt-1 text-xl font-bold text-slate-900 sm:text-2xl">
                    My Assigned Orders
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Update each order as you complete the delivery journey.
                </p>

            </div>

            <a
                href="{{ route('home') }}"
                class="inline-flex w-fit items-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900"
            >
                ← Back to Store
            </a>

        </div>


        {{-- ORDERS --}}
        @if($assignments->count() > 0)

            <div class="space-y-5">

                @foreach($assignments as $assignment)

                    @php
                        $order = $assignment->order;

                        $statusClasses = match($assignment->status) {
                            'assigned' => 'border-blue-200 bg-blue-50 text-blue-700',
                            'picked_up' => 'border-amber-200 bg-amber-50 text-amber-700',
                            'out_for_delivery' => 'border-violet-200 bg-violet-50 text-violet-700',
                            'delivered' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
                            default => 'border-slate-200 bg-slate-50 text-slate-700',
                        };

                        $orderStatusClasses = match($order->status) {
                            'pending' => 'bg-amber-50 text-amber-700',
                            'confirmed' => 'bg-blue-50 text-blue-700',
                            'preparing' => 'bg-orange-50 text-orange-700',
                            'out_for_delivery' => 'bg-violet-50 text-violet-700',
                            'delivered' => 'bg-emerald-50 text-emerald-700',
                            default => 'bg-slate-50 text-slate-700',
                        };
                    @endphp


                    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                        {{-- ORDER HEADER --}}
                        <div class="border-b border-slate-100 p-5 sm:p-6">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div>

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Order Number
                                    </p>

                                    <h3 class="mt-1 text-xl font-bold text-slate-900">
                                        #{{ $order->order_number }}
                                    </h3>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Placed {{ $order->created_at->format('d M Y, h:i A') }}
                                    </p>

                                </div>


                                <div class="flex flex-wrap gap-2">

                                    <span class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-bold {{ $orderStatusClasses }}">
                                        Order: {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                    </span>

                                    <span class="inline-flex items-center rounded-full border px-3 py-1.5 text-xs font-bold {{ $statusClasses }}">
                                        Delivery: {{ ucwords(str_replace('_', ' ', $assignment->status)) }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- ORDER BODY --}}
                        <div class="grid grid-cols-1 divide-y divide-slate-100 lg:grid-cols-3 lg:divide-x lg:divide-y-0">


                            {{-- CUSTOMER --}}
                            <div class="p-5 sm:p-6">

                                <div class="mb-4 flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                        👤
                                    </div>

                                    <div>

                                        <h4 class="font-bold text-slate-900">
                                            Customer
                                        </h4>

                                        <p class="text-xs text-slate-400">
                                            Delivery contact
                                        </p>

                                    </div>

                                </div>


                                <div class="space-y-3">

                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                            Name
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-slate-900">
                                            {{ $order->user->name ?? 'N/A' }}
                                        </p>
                                    </div>


                                    <div>
                                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                            Phone
                                        </p>

                                        <p class="mt-1 text-sm font-semibold text-slate-900">
                                            {{ $order->address->phone ?? $order->user->phone ?? 'N/A' }}
                                        </p>
                                    </div>


                                    @if($order->address)

                                        <div class="rounded-2xl bg-slate-50 p-4">

                                            <div class="flex items-start gap-3">

                                                <span class="mt-0.5 text-rose-500">
                                                    📍
                                                </span>

                                                <div>

                                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                        Delivery Address
                                                    </p>

                                                    <p class="mt-1 text-sm leading-6 text-slate-700">
                                                        {{ $order->address->address ?? '' }}

                                                        @if($order->address->city)
                                                            , {{ $order->address->city }}
                                                        @endif

                                                        @if($order->address->state)
                                                            , {{ $order->address->state }}
                                                        @endif

                                                        @if($order->address->pincode)
                                                            - {{ $order->address->pincode }}
                                                        @endif
                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- PRODUCTS --}}
                            <div class="p-5 sm:p-6">

                                <div class="mb-4 flex items-center justify-between">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                            🛍️
                                        </div>

                                        <div>

                                            <h4 class="font-bold text-slate-900">
                                                Products
                                            </h4>

                                            <p class="text-xs text-slate-400">
                                                {{ $order->items->sum('quantity') }} items
                                            </p>

                                        </div>

                                    </div>

                                </div>


                                <div class="space-y-3">

                                    @foreach($order->items as $item)

                                        <div class="flex items-center justify-between gap-3 rounded-2xl bg-slate-50 px-4 py-3">

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-semibold text-slate-900">
                                                    {{ $item->product->name ?? 'Product' }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Quantity: {{ $item->quantity }}
                                                </p>

                                            </div>

                                            <p class="shrink-0 text-sm font-bold text-slate-900">
                                                ₹{{ number_format($item->price * $item->quantity, 2) }}
                                            </p>

                                        </div>

                                    @endforeach

                                </div>


                                <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">

                                    <span class="text-sm font-semibold text-slate-500">
                                        Order Total
                                    </span>

                                    <span class="text-lg font-bold text-emerald-600">
                                        ₹{{ number_format($order->total_amount, 2) }}
                                    </span>

                                </div>

                            </div>


                            {{-- STATUS ACTION --}}
                            <div class="p-5 sm:p-6">

                                <div class="mb-4 flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                                        🚚
                                    </div>

                                    <div>

                                        <h4 class="font-bold text-slate-900">
                                            Delivery Status
                                        </h4>

                                        <p class="text-xs text-slate-400">
                                            Update order progress
                                        </p>

                                    </div>

                                </div>


                                {{-- CURRENT STATUS --}}
                                <div class="mb-4 rounded-2xl border {{ $statusClasses }} p-4">

                                    <p class="text-[10px] font-bold uppercase tracking-wider opacity-70">
                                        Current Status
                                    </p>

                                    <p class="mt-2 text-base font-bold">
                                        {{ ucwords(str_replace('_', ' ', $assignment->status)) }}
                                    </p>

                                </div>


                                {{-- FORM --}}
                                <form
                                    action="{{ route('delivery-boy.orders.update-status', $assignment->id) }}"
                                    method="POST"
                                    class="space-y-3"
                                >

                                    @csrf
                                    @method('PUT')


                                    <div>

                                        <label
                                            for="status-{{ $assignment->id }}"
                                            class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-500"
                                        >
                                            Update Status
                                        </label>

                                        <select
                                            name="status"
                                            id="status-{{ $assignment->id }}"
                                            required
                                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-800 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10"
                                        >

                                            <option
                                                value="assigned"
                                                {{ $assignment->status == 'assigned' ? 'selected' : '' }}
                                            >
                                                Assigned
                                            </option>

                                            <option
                                                value="picked_up"
                                                {{ $assignment->status == 'picked_up' ? 'selected' : '' }}
                                            >
                                                Picked Up
                                            </option>

                                            <option
                                                value="out_for_delivery"
                                                {{ $assignment->status == 'out_for_delivery' ? 'selected' : '' }}
                                            >
                                                Out for Delivery
                                            </option>

                                            <option
                                                value="delivered"
                                                {{ $assignment->status == 'delivered' ? 'selected' : '' }}
                                            >
                                                Delivered
                                            </option>

                                        </select>

                                    </div>


                                    <button
                                        type="submit"
                                        class="w-full rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700"
                                    >
                                        ✓ Update Delivery Status
                                    </button>

                                </form>

                            </div>

                        </div>


                        {{-- FOOTER --}}
                        <div class="border-t border-slate-100 bg-slate-50/70 px-5 py-4 sm:px-6">

                            <div class="flex flex-col gap-2 text-xs text-slate-500 sm:flex-row sm:items-center sm:justify-between">

                                <span>
                                    Order #{{ $order->order_number }}
                                </span>

                                <span>
                                    Delivery status:
                                    <strong class="text-slate-700">
                                        {{ ucwords(str_replace('_', ' ', $assignment->status)) }}
                                    </strong>
                                </span>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>

        @else

            {{-- EMPTY STATE --}}
            <section class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center shadow-sm">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                    🚚
                </div>

                <h3 class="mt-5 text-xl font-bold text-slate-900">
                    No Orders Assigned
                </h3>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                    You don't have any delivery orders assigned right now. New assignments will appear here.
                </p>

                <a
                    href="{{ route('home') }}"
                    class="mt-6 inline-flex items-center rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-600"
                >
                    ← Back to Home
                </a>

            </section>

        @endif

    </main>


    {{-- MOBILE BOTTOM BAR --}}
    <div class="fixed bottom-0 left-0 right-0 z-30 border-t border-slate-200 bg-white/95 px-4 py-3 backdrop-blur sm:hidden">

        <div class="flex items-center justify-between gap-3">

            <a
                href="{{ route('home') }}"
                class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-center text-sm font-semibold text-slate-700"
            >
                Home
            </a>

            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl bg-red-500 px-4 py-3 text-sm font-bold text-white"
                >
                    Logout
                </button>
            </form>

        </div>

    </div>


    <div class="h-20 sm:hidden"></div>

</div>

</body>
</html>