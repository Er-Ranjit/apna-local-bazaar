<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Order #{{ $order->order_number }} - Admin
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


                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📊
                    </span>
                    Dashboard
                </a>


                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        👥
                    </span>
                    Users
                </a>


                <a
                    href="{{ route('admin.vendors.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🏪
                    </span>
                    Vendors
                </a>


                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📦
                    </span>
                    Products
                </a>


                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        🛒
                    </span>
                    Orders
                </a>


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


            <div class="border-t border-slate-100 p-4">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600"
                >
                    ← Back to Store
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

                    <h1 class="mt-1 break-all text-lg font-black text-slate-950 sm:text-2xl">
                        #{{ $order->order_number }}
                    </h1>

                </div>


                <div class="flex items-center gap-2">

                    <a
                        href="{{ route('admin.orders.index') }}"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-bold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:px-4 sm:text-sm"
                    >
                        ← Back to Orders
                    </a>


                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl border border-red-100 bg-red-50 px-3 py-2.5 text-xs font-bold text-red-600 hover:bg-red-100"
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


            @php

                $status = $order->status ?? 'pending';

                $statusClass = match($status) {

                    'pending'
                        => 'bg-amber-50 text-amber-700 ring-amber-200',

                    'confirmed'
                        => 'bg-blue-50 text-blue-700 ring-blue-200',

                    'preparing'
                        => 'bg-purple-50 text-purple-700 ring-purple-200',

                    'out_for_delivery'
                        => 'bg-orange-50 text-orange-700 ring-orange-200',

                    'delivered'
                        => 'bg-emerald-50 text-emerald-700 ring-emerald-200',

                    default
                        => 'bg-slate-50 text-slate-600 ring-slate-200',
                };


                $paymentStatus = $order->payment_status ?? 'pending';

                $paymentClass = match($paymentStatus) {

                    'paid'
                        => 'bg-emerald-50 text-emerald-700 ring-emerald-200',

                    'failed'
                        => 'bg-red-50 text-red-700 ring-red-200',

                    default
                        => 'bg-amber-50 text-amber-700 ring-amber-200',
                };


                $deliveryStatus = $order->deliveryAssignment?->status;

            @endphp


            {{-- =====================================================
                SUMMARY
            ====================================================== --}}
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- STATUS --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                        Order Status
                    </p>

                    <span class="mt-3 inline-flex rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $statusClass }}">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>

                </div>


                {{-- PAYMENT --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                        Payment
                    </p>

                    <span class="mt-3 inline-flex rounded-full px-3 py-1.5 text-xs font-bold ring-1 {{ $paymentClass }}">
                        {{ ucfirst($paymentStatus) }}
                    </span>

                </div>


                {{-- TOTAL --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                        Total Amount
                    </p>

                    <p class="mt-2 text-2xl font-black text-slate-950">
                        ₹{{ number_format((float) $order->total_amount, 2) }}
                    </p>

                </div>


                {{-- DATE --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">

                    <p class="text-xs font-bold uppercase tracking-wide text-slate-400">
                        Ordered On
                    </p>

                    <p class="mt-2 text-sm font-bold text-slate-800">
                        {{ $order->created_at?->format('d M Y') }}
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        {{ $order->created_at?->format('h:i A') }}
                    </p>

                </div>

            </div>


            {{-- =====================================================
                MAIN GRID
            ====================================================== --}}
            <div class="mt-6 grid gap-6 xl:grid-cols-[1.6fr_1fr]">


                {{-- =================================================
                    LEFT
                ================================================== --}}
                <div class="space-y-6">


                    {{-- ORDER ITEMS --}}
                    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">


                        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                            <h2 class="text-lg font-black text-slate-950">
                                Order Items
                            </h2>

                            <p class="mt-1 text-sm text-slate-500">
                                {{ $order->items->sum('quantity') }} total items
                            </p>

                        </div>


                        <div class="divide-y divide-slate-100">


                            @forelse($order->items as $item)


                                @php

                                    $image = $item->product?->image
                                        ? asset('storage/' . ltrim($item->product->image, '/'))
                                        : asset('images/products/product-placeholder.png');

                                @endphp


                                <div class="flex gap-4 p-5 sm:p-6">


                                    {{-- IMAGE --}}
                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-2xl bg-slate-100">

                                        <img
                                            src="{{ $image }}"
                                            alt="{{ $item->product?->name ?? 'Product' }}"
                                            class="h-full w-full object-cover"
                                            onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                        >

                                    </div>


                                    {{-- INFO --}}
                                    <div class="min-w-0 flex-1">


                                        <div class="flex flex-col justify-between gap-3 sm:flex-row">


                                            <div class="min-w-0">

                                                <h3 class="font-black text-slate-900">
                                                    {{ $item->product?->name ?? 'Product unavailable' }}
                                                </h3>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    Vendor:
                                                    {{ $item->product?->vendor?->shop_name ?? 'N/A' }}
                                                </p>

                                            </div>


                                            <p class="shrink-0 text-lg font-black text-slate-900">
                                                ₹{{ number_format((float) $item->price * (int) $item->quantity, 2) }}
                                            </p>

                                        </div>


                                        <div class="mt-4 flex flex-wrap gap-2">

                                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">
                                                Qty: {{ $item->quantity }}
                                            </span>

                                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700">
                                                ₹{{ number_format((float) $item->price, 2) }} each
                                            </span>

                                        </div>

                                    </div>

                                </div>


                            @empty


                                <div class="p-8 text-center">

                                    <p class="text-sm font-semibold text-slate-400">
                                        No order items found.
                                    </p>

                                </div>


                            @endforelse

                        </div>


                        {{-- TOTAL BOX --}}
                        <div class="border-t border-slate-200 bg-slate-50 p-5 sm:p-6">


                            <div class="ml-auto max-w-sm space-y-3">


                                <div class="flex justify-between text-sm">

                                    <span class="text-slate-500">
                                        Subtotal
                                    </span>

                                    <span class="font-bold text-slate-700">
                                        ₹{{ number_format((float) $order->subtotal, 2) }}
                                    </span>

                                </div>


                                <div class="flex justify-between text-sm">

                                    <span class="text-slate-500">
                                        Delivery Charge
                                    </span>

                                    <span class="font-bold text-slate-700">
                                        ₹{{ number_format((float) ($order->delivery_charge ?? 0), 2) }}
                                    </span>

                                </div>


                                <div class="flex justify-between text-sm">

                                    <span class="text-slate-500">
                                        Discount
                                    </span>

                                    <span class="font-bold text-slate-700">
                                        - ₹{{ number_format((float) ($order->discount ?? 0), 2) }}
                                    </span>

                                </div>


                                <div class="flex justify-between border-t border-slate-200 pt-3">

                                    <span class="font-black text-slate-900">
                                        Total
                                    </span>

                                    <span class="text-xl font-black text-emerald-700">
                                        ₹{{ number_format((float) $order->total_amount, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </section>


                    {{-- CUSTOMER --}}
                    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                        <h2 class="text-lg font-black text-slate-950">
                            Customer Information
                        </h2>


                        <div class="mt-5 grid gap-4 sm:grid-cols-2">


                            <div class="rounded-2xl bg-slate-50 p-4">

                                <p class="text-[10px] font-black uppercase tracking-wide text-slate-400">
                                    Name
                                </p>

                                <p class="mt-1 font-bold text-slate-800">
                                    {{ $order->user?->name ?? 'N/A' }}
                                </p>

                            </div>


                            <div class="rounded-2xl bg-slate-50 p-4">

                                <p class="text-[10px] font-black uppercase tracking-wide text-slate-400">
                                    Email
                                </p>

                                <p class="mt-1 break-all font-bold text-slate-800">
                                    {{ $order->user?->email ?? 'N/A' }}
                                </p>

                            </div>

                        </div>

                    </section>

                </div>


                {{-- =================================================
                    RIGHT
                ================================================== --}}
                <div class="space-y-6">


                    {{-- PAYMENT --}}
                    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                        <h2 class="text-lg font-black text-slate-950">
                            Payment Information
                        </h2>


                        <div class="mt-5 space-y-3">


                            <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-4">

                                <span class="text-sm text-slate-500">
                                    Method
                                </span>

                                <span class="text-sm font-black text-slate-800">
                                    {{ strtoupper(str_replace('_', ' ', $order->payment_method ?? 'N/A')) }}
                                </span>

                            </div>


                            <div class="flex items-center justify-between rounded-2xl bg-slate-50 p-4">

                                <span class="text-sm text-slate-500">
                                    Status
                                </span>

                                <span class="rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $paymentClass }}">
                                    {{ ucfirst($paymentStatus) }}
                                </span>

                            </div>

                        </div>

                    </section>


                    {{-- DELIVERY --}}
                    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                        <h2 class="text-lg font-black text-slate-950">
                            Delivery Information
                        </h2>


                        <div class="mt-5 space-y-4">


                            {{-- DELIVERY STATUS --}}
                            <div class="rounded-2xl bg-slate-50 p-4">

                                <p class="text-[10px] font-black uppercase tracking-wide text-slate-400">
                                    Delivery Status
                                </p>


                                @if($deliveryStatus)

                                    <p class="mt-2 font-bold text-slate-800">
                                        {{ ucfirst(str_replace('_', ' ', $deliveryStatus)) }}
                                    </p>

                                @else

                                    <p class="mt-2 font-bold text-slate-400">
                                        Not Assigned
                                    </p>

                                @endif

                            </div>


                            {{-- DELIVERY BOY --}}
                            <div class="rounded-2xl bg-slate-50 p-4">

                                <p class="text-[10px] font-black uppercase tracking-wide text-slate-400">
                                    Delivery Boy
                                </p>


                                @if($order->deliveryAssignment?->deliveryBoy?->user)

                                    <p class="mt-2 font-bold text-slate-800">

                                        {{
                                            $order->deliveryAssignment->deliveryBoy->user->name
                                        }}

                                    </p>

                                @else

                                    <p class="mt-2 font-bold text-slate-400">
                                        Not Assigned
                                    </p>

                                @endif

                            </div>


                            {{-- ASSIGNMENT ID --}}
                            <div class="rounded-2xl bg-slate-50 p-4">

                                <p class="text-[10px] font-black uppercase tracking-wide text-slate-400">
                                    Assignment ID
                                </p>

                                <p class="mt-2 font-bold text-slate-800">
                                    {{ $order->deliveryAssignment?->id ?? 'N/A' }}
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- ADDRESS --}}
                    <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                        <h2 class="text-lg font-black text-slate-950">
                            Delivery Address
                        </h2>


                        @if($order->address)

                            @php

                                $addressLine = data_get($order->address, 'address_line')
                                    ?? data_get($order->address, 'address')
                                    ?? data_get($order->address, 'full_address');


                                $city = data_get($order->address, 'city');

                                $state = data_get($order->address, 'state');

                                $pincode = data_get($order->address, 'pincode')
                                    ?? data_get($order->address, 'postal_code')
                                    ?? data_get($order->address, 'zip_code');

                            @endphp


                            <div class="mt-5 rounded-2xl bg-slate-50 p-4 text-sm text-slate-700">

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
                                    <p class="font-bold">
                                        {{ $pincode }}
                                    </p>
                                @endif

                            </div>

                        @else

                            <p class="mt-5 rounded-2xl bg-slate-50 p-4 text-sm font-semibold text-slate-400">
                                Address unavailable
                            </p>

                        @endif

                    </section>


                    {{-- QUICK LINKS --}}
                    <section class="rounded-3xl bg-slate-900 p-5 text-white shadow-sm sm:p-6">


                        <p class="text-xs font-bold uppercase tracking-[0.15em] text-emerald-400">
                            Quick Navigation
                        </p>


                        <h2 class="mt-2 text-xl font-black">
                            Manage Order
                        </h2>


                        <div class="mt-5 space-y-3">


                            <a
                                href="{{ route('admin.orders.index') }}"
                                class="flex items-center justify-center rounded-xl bg-white px-4 py-3 text-sm font-bold text-slate-900 transition hover:bg-emerald-50"
                            >
                                All Orders
                            </a>


                            <a
                                href="{{ route('admin.delivery-assignments.index') }}"
                                class="flex items-center justify-center rounded-xl border border-slate-700 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800"
                            >
                                Delivery Assignments
                            </a>

                        </div>

                    </section>

                </div>

            </div>


            {{-- FOOTER --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">

                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Admin Order Details
                    </p>

                </div>

            </footer>


        </main>

    </div>

</body>

</html>