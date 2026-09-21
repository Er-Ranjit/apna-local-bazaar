<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

<div class="min-h-screen">

    {{-- HEADER --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

        <div class="mx-auto flex min-h-[72px] max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

            {{-- LOGO --}}
            <a
                href="{{ route('home') }}"
                class="flex min-w-0 items-center gap-3"
            >

                @if(file_exists(public_path('images/logo.png')))

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Apna Local Bazaar"
                        class="h-9 w-auto shrink-0 sm:h-11"
                    >

                    <div class="hidden min-w-0 sm:block">

                        <p class="truncate text-sm font-bold text-slate-900">
                            Apna Local Bazaar
                        </p>

                        <p class="truncate text-xs text-slate-400">
                            Your Local Marketplace
                        </p>

                    </div>

                @else

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-lg font-bold text-white">
                        A
                    </div>

                    <span class="hidden text-lg font-bold text-slate-900 sm:block">
                        Apna Local Bazaar
                    </span>

                @endif

            </a>


            {{-- HOME --}}
            <a
                href="{{ route('home') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
            >
                <span>←</span>
                Home
            </a>

        </div>

    </header>


    {{-- MAIN --}}
    <main class="mx-auto max-w-7xl px-4 py-6 pb-12 sm:px-6 sm:py-8 lg:px-8">

        {{-- PAGE INTRO --}}
        <div class="mb-7">

            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">

                <span>
                    Account
                </span>

                <span class="h-1 w-1 rounded-full bg-emerald-400"></span>

                <span>
                    Order History
                </span>

            </div>


            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                My Orders
            </h1>


            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
                View your previous orders and track their delivery status.
            </p>

        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700">
                    ✓
                </div>

                <div>

                    <p class="text-sm font-bold text-emerald-800">
                        Success
                    </p>

                    <p class="mt-0.5 text-sm text-emerald-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- ERROR --}}
        @if(session('error'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-700">
                    !
                </div>

                <div>

                    <p class="text-sm font-bold text-red-800">
                        Error
                    </p>

                    <p class="mt-0.5 text-sm text-red-700">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        {{-- ORDERS --}}
        @if($orders->count())

            <div class="space-y-5">

                @foreach($orders as $order)

                    @php

                        $statusClasses = match($order->status) {

                            'pending' =>
                                'border-amber-200 bg-amber-50 text-amber-700',

                            'confirmed' =>
                                'border-blue-200 bg-blue-50 text-blue-700',

                            'preparing' =>
                                'border-orange-200 bg-orange-50 text-orange-700',

                            'out_for_delivery' =>
                                'border-violet-200 bg-violet-50 text-violet-700',

                            'delivered' =>
                                'border-emerald-200 bg-emerald-50 text-emerald-700',

                            default =>
                                'border-slate-200 bg-slate-50 text-slate-700',

                        };


                        $statusIcon = match($order->status) {

                            'pending' =>
                                '📝',

                            'confirmed' =>
                                '✓',

                            'preparing' =>
                                '👨‍🍳',

                            'out_for_delivery' =>
                                '🚴',

                            'delivered' =>
                                '📦',

                            default =>
                                '📦',

                        };

                    @endphp


                    {{-- ORDER CARD --}}
                    <article class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:border-emerald-100 hover:shadow-md">


                        {{-- ORDER HEADER --}}
                        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">

                                        <h2 class="text-lg font-black text-slate-900 sm:text-xl">
                                            #{{ $order->order_number }}
                                        </h2>


                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-bold {{ $statusClasses }}"
                                        >

                                            <span>
                                                {{ $statusIcon }}
                                            </span>

                                            <span>
                                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                            </span>

                                        </span>

                                    </div>


                                    <p class="mt-2 text-xs text-slate-400 sm:text-sm">

                                        Placed on
                                        {{ $order->created_at->format('d M Y') }}

                                        at

                                        {{ $order->created_at->format('h:i A') }}

                                    </p>

                                </div>


                                {{-- TOTAL --}}
                                <div class="sm:text-right">

                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Order Total
                                    </p>

                                    <p class="mt-1 text-xl font-black text-slate-900 sm:text-2xl">
                                        ₹{{ number_format($order->total_amount, 2) }}
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- ORDER CONTENT --}}
                        <div class="px-5 py-5 sm:px-6">


                            {{-- PRODUCTS --}}
                            <div class="space-y-4">

                                @forelse($order->items->take(3) as $item)

                                    <div class="flex items-center gap-4">


                                        {{-- PRODUCT IMAGE --}}
                                        <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 sm:h-20 sm:w-20">

                                            @if($item->product && $item->product->image)

                                                <img
                                                    src="{{ asset('images/' . ltrim($item->product->image, '/')) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="h-full w-full object-contain p-1.5"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                                >

                                            @else

                                                <img
                                                    src="{{ asset('images/products/product-placeholder.png') }}"
                                                    alt="Product"
                                                    class="h-full w-full object-contain p-1.5"
                                                >

                                            @endif

                                        </div>


                                        {{-- PRODUCT DETAILS --}}
                                        <div class="min-w-0 flex-1">

                                            <h3 class="truncate text-sm font-bold text-slate-900 sm:text-base">
                                                {{ $item->product->name ?? 'Product' }}
                                            </h3>


                                            @if($item->product && $item->product->category)

                                                <p class="mt-1 text-xs font-medium text-slate-500">
                                                    {{ $item->product->category->name }}
                                                </p>

                                            @endif


                                            <p class="mt-1 text-xs text-slate-400 sm:text-sm">
                                                Quantity: {{ $item->quantity }}
                                            </p>

                                        </div>


                                        {{-- ITEM PRICE --}}
                                        <div class="shrink-0 text-right">

                                            <p class="text-sm font-bold text-slate-900 sm:text-base">
                                                ₹{{ number_format($item->price * $item->quantity, 2) }}
                                            </p>

                                        </div>

                                    </div>

                                @empty

                                    <div class="rounded-2xl bg-slate-50 p-4">

                                        <p class="text-sm text-slate-500">
                                            No products found for this order.
                                        </p>

                                    </div>

                                @endforelse


                                {{-- MORE ITEMS --}}
                                @if($order->items->count() > 3)

                                    <p class="pt-1 text-xs font-semibold text-slate-500 sm:text-sm">

                                        + {{ $order->items->count() - 3 }}
                                        more item(s)

                                    </p>

                                @endif

                            </div>


                            {{-- DIVIDER --}}
                            <div class="my-5 border-t border-slate-100"></div>


                            {{-- BOTTOM --}}
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">


                                {{-- PAYMENT --}}
                                <div class="flex flex-wrap gap-x-6 gap-y-2 text-xs sm:text-sm">


                                    <div>

                                        <span class="text-slate-400">
                                            Payment:
                                        </span>

                                        <span class="ml-1 font-bold uppercase text-slate-700">
                                            {{ $order->payment_method }}
                                        </span>

                                    </div>


                                    <div>

                                        <span class="text-slate-400">
                                            Payment Status:
                                        </span>

                                        <span
                                            class="ml-1 font-semibold
                                            {{ $order->payment_status === 'paid'
                                                ? 'text-emerald-600'
                                                : ($order->payment_status === 'failed'
                                                    ? 'text-red-600'
                                                    : 'text-amber-600') }}"
                                        >
                                            {{ ucfirst($order->payment_status) }}
                                        </span>

                                    </div>

                                </div>


                                {{-- TRACK --}}
                                <a
                                    href="{{ route('orders.show', $order->id) }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700"
                                >
                                    Track Order
                                    <span>→</span>
                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- EMPTY ORDERS --}}
            <section class="rounded-3xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm sm:px-10 sm:py-20">

                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-emerald-50 text-4xl">
                    📦
                </div>


                <h2 class="mt-6 text-2xl font-black text-slate-950 sm:text-3xl">
                    No Orders Yet
                </h2>


                <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500 sm:text-base">
                    You haven't placed any orders yet. Start shopping from local stores and your orders will appear here.
                </p>


                <a
                    href="{{ route('home') }}"
                    class="mt-7 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700"
                >
                    Start Shopping →
                </a>

            </section>

        @endif

    </main>


    {{-- FOOTER --}}
    <footer class="border-t border-slate-200 bg-slate-950 text-white">

        <div class="mx-auto max-w-7xl px-4 py-7 text-center sm:px-6 lg:px-8">

            <p class="text-xs text-slate-500 sm:text-sm">
                © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
            </p>

        </div>

    </footer>

</div>

</body>
</html>