<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Assign Delivery - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

<div class="min-h-screen flex">

    {{-- SIDEBAR --}}
    <aside class="hidden lg:flex lg:w-64 bg-white border-r border-slate-200 fixed inset-y-0 left-0 z-30 flex-col">

        {{-- LOGO --}}
        <div class="h-20 px-5 flex items-center border-b border-slate-100">

            <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-3">

                <img
                    src="{{ asset('images/logo.png') }}"
                    alt="Apna Local Bazaar"
                    class="h-11 w-auto object-contain"
                >

                <div>
                    <div class="font-bold text-sm text-slate-900">
                        Apna Local
                    </div>

                    <div class="font-bold text-sm text-slate-900">
                        Bazaar
                    </div>

                    <div class="text-[10px] text-slate-400">
                        Vendor Panel
                    </div>
                </div>

            </a>

        </div>


        {{-- MENU --}}
        <div class="px-4 py-5">

            <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400 px-3 mb-3">
                Store Management
            </p>

            <nav class="space-y-1">

                <a
                    href="{{ route('vendor.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                >
                    <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                        🏠
                    </span>

                    Dashboard
                </a>


                <a
                    href="{{ route('vendor.products.create') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                >
                    <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                        ➕
                    </span>

                    Add Product
                </a>


                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium bg-emerald-50 text-emerald-700"
                >
                    <span class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center">
                        📦
                    </span>

                    Orders
                </a>

            </nav>

        </div>


        {{-- BOTTOM --}}
        <div class="mt-auto p-4 border-t border-slate-100 space-y-2">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-3 px-3 py-2.5 text-sm text-slate-500 hover:text-slate-900 transition"
            >
                ← Back to Store
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition"
                >
                    ↪ Logout
                </button>
            </form>

        </div>

    </aside>


    {{-- MAIN --}}
    <main class="flex-1 lg:ml-64">

        {{-- HEADER --}}
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-5 sm:px-8">

            <div>

                <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-emerald-600">
                    Vendor Panel
                </p>

                <h1 class="text-lg sm:text-xl font-bold text-slate-900">
                    Delivery Assignment
                </h1>

            </div>


            <div class="flex items-center gap-3">

                <div class="hidden sm:block text-right">

                    <p class="text-sm font-semibold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-[11px] text-slate-400">
                        Vendor
                    </p>

                </div>

                <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </header>


        {{-- CONTENT --}}
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">


            {{-- TOP ACTION --}}
            <div class="mb-5">

                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-emerald-600 transition"
                >
                    ← Back to Orders
                </a>

            </div>


            {{-- HERO --}}
            <div class="relative overflow-hidden rounded-3xl bg-slate-950 text-white p-6 sm:p-8 mb-6">

                <div class="absolute -right-16 -top-16 w-60 h-60 rounded-full border border-emerald-400/20"></div>

                <div class="absolute right-10 -bottom-20 w-44 h-44 rounded-full border border-emerald-400/10"></div>

                <div class="relative">

                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-300 text-[10px] font-bold uppercase tracking-wider mb-3">
                        Delivery Management
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">
                        Assign Delivery Partner
                    </h2>

                    <p class="mt-2 text-sm text-slate-300 max-w-2xl">
                        Choose a delivery partner and assign this order for delivery.
                    </p>

                </div>

            </div>


            {{-- ALERTS --}}
            @if(session('success'))

                <div class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">

                    <div class="flex gap-3 items-start">

                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                            ✓
                        </div>

                        <div>

                            <p class="font-semibold text-emerald-800">
                                Success
                            </p>

                            <p class="text-sm text-emerald-700 mt-1">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            @if(session('error'))

                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                    <div class="flex gap-3 items-start">

                        <div class="w-9 h-9 rounded-xl bg-red-100 text-red-700 flex items-center justify-center shrink-0">
                            !
                        </div>

                        <div>

                            <p class="font-semibold text-red-800">
                                Something went wrong
                            </p>

                            <p class="text-sm text-red-700 mt-1">
                                {{ session('error') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            @if($errors->any())

                <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                    <p class="font-semibold text-red-800">
                        Please fix the following:
                    </p>

                    <ul class="mt-2 space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- TWO COLUMN LAYOUT --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">


                {{-- ORDER DETAILS --}}
                <div class="xl:col-span-2 space-y-6">


                    {{-- ORDER HEADER --}}
                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="p-5 sm:p-6 border-b border-slate-100">

                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                                <div>

                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                        Order Number
                                    </p>

                                    <h3 class="mt-1 text-xl font-bold text-slate-900">
                                        #{{ $order->order_number }}
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Placed {{ $order->created_at->format('d M Y, h:i A') }}
                                    </p>

                                </div>


                                {{-- STATUS --}}
                                @php
                                    $statusClasses = match($order->status) {
                                        'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                        'confirmed' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'preparing' => 'bg-orange-50 text-orange-700 border-orange-200',
                                        'out_for_delivery' => 'bg-violet-50 text-violet-700 border-violet-200',
                                        'delivered' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        default => 'bg-slate-50 text-slate-700 border-slate-200',
                                    };
                                @endphp

                                <span class="inline-flex items-center w-fit rounded-full border px-3 py-1 text-xs font-bold {{ $statusClasses }}">
                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                </span>

                            </div>

                        </div>


                        {{-- CUSTOMER --}}
                        <div class="p-5 sm:p-6 border-b border-slate-100">

                            <div class="flex items-center gap-3 mb-5">

                                <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    👤
                                </div>

                                <div>

                                    <h4 class="font-bold text-slate-900">
                                        Customer Details
                                    </h4>

                                    <p class="text-xs text-slate-400">
                                        Customer and delivery information
                                    </p>

                                </div>

                            </div>


                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                {{-- NAME --}}
                                <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Customer Name
                                    </p>

                                    <p class="mt-2 text-sm font-semibold text-slate-900">
                                        {{ $order->user->name ?? 'N/A' }}
                                    </p>

                                </div>


                                {{-- PHONE --}}
                                <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Phone
                                    </p>

                                    <p class="mt-2 text-sm font-semibold text-slate-900">
                                        {{ $order->address->phone ?? $order->user->phone ?? 'N/A' }}
                                    </p>

                                </div>

                            </div>


                            {{-- ADDRESS --}}
                            @if($order->address)

                                <div class="mt-4 rounded-2xl bg-slate-50 border border-slate-100 p-4">

                                    <div class="flex items-start gap-3">

                                        <div class="h-9 w-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
                                            📍
                                        </div>

                                        <div>

                                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                                Delivery Address
                                            </p>

                                            <p class="mt-1 text-sm leading-6 text-slate-800">

                                                @if($order->address->address)
                                                    {{ $order->address->address }}
                                                @endif

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


                        {{-- PRODUCTS --}}
                        <div class="p-5 sm:p-6">

                            <div class="flex items-center justify-between mb-5">

                                <div class="flex items-center gap-3">

                                    <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                        🛍️
                                    </div>

                                    <div>

                                        <h4 class="font-bold text-slate-900">
                                            Order Products
                                        </h4>

                                        <p class="text-xs text-slate-400">
                                            {{ $order->items->sum('quantity') }} total items
                                        </p>

                                    </div>

                                </div>

                                <div class="text-right">

                                    <p class="text-[10px] uppercase tracking-wider text-slate-400 font-bold">
                                        Total
                                    </p>

                                    <p class="text-lg font-bold text-slate-900">
                                        ₹{{ number_format($order->total_amount, 2) }}
                                    </p>

                                </div>

                            </div>


                            <div class="divide-y divide-slate-100">

                                @foreach($order->items as $item)

                                    <div class="flex items-center justify-between gap-4 py-4">

                                        <div class="min-w-0">

                                            <p class="font-semibold text-sm text-slate-900">
                                                {{ $item->product->name ?? 'Product' }}
                                            </p>

                                            <p class="text-xs text-slate-400 mt-1">
                                                ₹{{ number_format($item->price, 2) }}
                                                ×
                                                {{ $item->quantity }}
                                            </p>

                                        </div>

                                        <p class="shrink-0 font-bold text-sm text-slate-900">
                                            ₹{{ number_format($item->price * $item->quantity, 2) }}
                                        </p>

                                    </div>

                                @endforeach

                            </div>


                            {{-- TOTAL --}}
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">

                                <span class="text-sm font-semibold text-slate-500">
                                    Order Total
                                </span>

                                <span class="text-xl font-bold text-emerald-600">
                                    ₹{{ number_format($order->total_amount, 2) }}
                                </span>

                            </div>

                        </div>

                    </section>

                </div>


                {{-- ASSIGNMENT --}}
                <div>

                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden sticky top-6">

                        {{-- HEADER --}}
                        <div class="p-5 sm:p-6 border-b border-slate-100">

                            <div class="flex items-center gap-3">

                                <div class="h-11 w-11 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                                    🚚
                                </div>

                                <div>

                                    <h3 class="font-bold text-slate-900">
                                        Delivery Partner
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Assign or reassign this order
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="p-5 sm:p-6">


                            {{-- CURRENT ASSIGNMENT --}}
                            @if($order->deliveryAssignment && $order->deliveryAssignment->deliveryBoy)

                                <div class="mb-6 rounded-2xl border border-blue-200 bg-blue-50 p-4">

                                    <div class="flex items-center gap-2">

                                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                        <p class="text-[10px] font-bold uppercase tracking-wider text-blue-600">
                                            Currently Assigned
                                        </p>

                                    </div>


                                    <div class="mt-4">

                                        <p class="font-bold text-slate-900">
                                            {{ $order->deliveryAssignment->deliveryBoy->user->name ?? 'Delivery Boy' }}
                                        </p>

                                        @if($order->deliveryAssignment->deliveryBoy->user->email)

                                            <p class="text-xs text-slate-500 mt-1">
                                                {{ $order->deliveryAssignment->deliveryBoy->user->email }}
                                            </p>

                                        @endif


                                        @php
                                            $deliveryStatusClasses = match($order->deliveryAssignment->status) {
                                                'assigned' => 'bg-blue-100 text-blue-700',
                                                'picked_up' => 'bg-amber-100 text-amber-700',
                                                'out_for_delivery' => 'bg-violet-100 text-violet-700',
                                                'delivered' => 'bg-emerald-100 text-emerald-700',
                                                default => 'bg-slate-100 text-slate-700',
                                            };
                                        @endphp

                                        <span class="inline-flex mt-3 rounded-full px-2.5 py-1 text-[10px] font-bold {{ $deliveryStatusClasses }}">
                                            {{ ucwords(str_replace('_', ' ', $order->deliveryAssignment->status)) }}
                                        </span>

                                    </div>

                                </div>

                            @endif


                            {{-- FORM --}}
                            <form
                                action="{{ route('vendor.orders.assign.store', $order->id) }}"
                                method="POST"
                            >

                                @csrf


                                <label
                                    for="delivery_boy_id"
                                    class="block text-sm font-semibold text-slate-700 mb-2"
                                >
                                    Select Delivery Boy
                                </label>


                                <select
                                    name="delivery_boy_id"
                                    id="delivery_boy_id"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                >

                                    <option value="">
                                        Choose delivery partner
                                    </option>

                                    @foreach($deliveryBoys as $boy)

                                        <option
                                            value="{{ $boy->id }}"
                                            @if(
                                                $order->deliveryAssignment &&
                                                $order->deliveryAssignment->delivery_boy_id == $boy->id
                                            )
                                                selected
                                            @endif
                                        >
                                            {{ $boy->user->name ?? 'Delivery Boy' }}

                                            @if($boy->user?->email)
                                                — {{ $boy->user->email }}
                                            @endif
                                        </option>

                                    @endforeach

                                </select>


                                @error('delivery_boy_id')

                                    <p class="mt-2 text-xs font-medium text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror


                                {{-- INFO --}}
                                <div class="mt-4 rounded-xl bg-slate-50 border border-slate-100 p-3">

                                    <p class="text-xs leading-5 text-slate-500">
                                        The selected delivery partner will receive this order assignment.
                                    </p>

                                </div>


                                {{-- BUTTON --}}
                                <button
                                    type="submit"
                                    class="mt-5 w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 hover:bg-emerald-700 transition"
                                >
                                    🚚 Assign Delivery Boy
                                </button>

                            </form>


                            {{-- CANCEL --}}
                            <a
                                href="{{ route('vendor.orders.index') }}"
                                class="mt-3 block w-full rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                            >
                                Cancel
                            </a>

                        </div>

                    </section>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>