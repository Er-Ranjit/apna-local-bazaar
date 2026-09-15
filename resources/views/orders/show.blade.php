<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Order #{{ $order->order_number }} - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

@php
    $statuses = [
        'pending' => [
            'label' => 'Order Placed',
            'description' => 'Your order has been successfully placed.',
            'icon' => '📝',
        ],
        'confirmed' => [
            'label' => 'Order Confirmed',
            'description' => 'The vendor has confirmed your order.',
            'icon' => '✓',
        ],
        'preparing' => [
            'label' => 'Preparing',
            'description' => 'Your order is being prepared.',
            'icon' => '👨‍🍳',
        ],
        'out_for_delivery' => [
            'label' => 'Out for Delivery',
            'description' => 'Your order is on the way.',
            'icon' => '🚴',
        ],
        'delivered' => [
            'label' => 'Delivered',
            'description' => 'Your order has been delivered successfully.',
            'icon' => '📦',
        ],
    ];

    $statusKeys = array_keys($statuses);

    $currentIndex = array_search($order->status, $statusKeys);

    if ($currentIndex === false) {
        $currentIndex = 0;
    }

    $progressPercent = count($statusKeys) > 1
        ? round(($currentIndex / (count($statusKeys) - 1)) * 100)
        : 0;

    $statusClasses = match($order->status) {
        'pending' => 'border-amber-200 bg-amber-50 text-amber-700',
        'confirmed' => 'border-blue-200 bg-blue-50 text-blue-700',
        'preparing' => 'border-orange-200 bg-orange-50 text-orange-700',
        'out_for_delivery' => 'border-violet-200 bg-violet-50 text-violet-700',
        'delivered' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        default => 'border-slate-200 bg-slate-50 text-slate-700',
    };
@endphp


{{-- HEADER --}}
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

    <div class="mx-auto flex min-h-[72px] max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:min-h-[80px] lg:px-8">

        <a
            href="{{ route('home') }}"
            class="flex min-w-0 items-center gap-3"
        >

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

        </a>


        <div class="flex items-center gap-2 sm:gap-3">

            <a
                href="{{ route('orders.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700"
            >
                <span>←</span>

                <span class="hidden sm:inline">
                    My Orders
                </span>

                <span class="sm:hidden">
                    Orders
                </span>

            </a>


            <div class="hidden h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700 sm:flex">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

        </div>

    </div>

</header>


{{-- MAIN --}}
<main class="mx-auto max-w-7xl px-4 py-6 pb-12 sm:px-6 sm:py-8 lg:px-8">


    {{-- BACK --}}
    <a
        href="{{ route('orders.index') }}"
        class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-emerald-600"
    >
        ← Back to My Orders
    </a>


    {{-- ORDER HERO --}}
    <section class="mb-6 overflow-hidden rounded-3xl bg-slate-950 p-6 text-white shadow-sm sm:p-8">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-emerald-300">
                    Order Confirmation
                </span>

                <h1 class="mt-3 text-2xl font-black tracking-tight sm:text-3xl">
                    #{{ $order->order_number }}
                </h1>

                <p class="mt-2 text-sm text-slate-300">
                    Thank you for your order!
                </p>

                @if($order->created_at)
                    <p class="mt-2 text-xs text-slate-400">
                        Placed {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                @endif

            </div>


            <div>

                <span class="inline-flex items-center rounded-full border px-4 py-2 text-sm font-bold {{ $statusClasses }}">
                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                </span>

            </div>

        </div>

    </section>


    {{-- TRACKING --}}
    <section class="mb-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    🚚
                </div>

                <div>

                    <h2 class="font-bold text-slate-900 sm:text-lg">
                        Track Your Order
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-400">
                        Follow your order from placement to delivery.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-5 sm:p-6">

            {{-- DELIVERY PROGRESS --}}
            <div class="mb-7 rounded-2xl border border-slate-100 bg-slate-50 p-4 sm:p-5">

                <div class="flex items-center justify-between gap-3">

                    <div>
                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-400">
                            Delivery Progress
                        </p>

                        <p class="mt-1 text-sm font-bold text-slate-800">
                            {{ $progressPercent }}% complete
                        </p>
                    </div>

                    @if($order->status === 'delivered')
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-[10px] font-bold uppercase text-emerald-700">
                            Delivered
                        </span>
                    @else
                        <span class="rounded-full bg-white px-3 py-1 text-[10px] font-bold uppercase text-slate-500">
                            Live Tracking
                        </span>
                    @endif

                </div>

                <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-200">
                    <div
                        class="h-full rounded-full bg-emerald-500 transition-all duration-700"
                        style="width: {{ $progressPercent }}%;"
                    ></div>
                </div>

                <div class="mt-3 flex items-center justify-between text-[9px] font-semibold text-slate-400 sm:text-[10px]">
                    <span>Placed</span>
                    <span>Confirmed</span>
                    <span>Preparing</span>
                    <span>On the way</span>
                    <span>Delivered</span>
                </div>

            </div>

            <div class="relative">

                @foreach($statuses as $key => $status)

                    @php
                        $index = array_search($key, $statusKeys);
                        $completed = $index <= $currentIndex;
                        $current = $key === $order->status;

                        $circleClass = $completed
                            ? 'bg-emerald-100 text-emerald-600'
                            : 'bg-slate-100 text-slate-400';

                        $lineClass = $index < $currentIndex
                            ? 'bg-emerald-500'
                            : 'bg-slate-200';

                        $titleClass = $completed
                            ? 'text-slate-900'
                            : 'text-slate-400';

                        $descriptionClass = $completed
                            ? 'text-slate-500'
                            : 'text-slate-400';
                    @endphp


                    <div class="relative flex gap-4">

                        @if(!$loop->last)

                            <div
                                class="absolute left-5 top-11 h-12 w-0.5 {{ $lineClass }}"
                            ></div>

                        @endif


                        {{-- ICON --}}
                        <div
                            class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-full {{ $circleClass }}"
                        >
                            <span class="text-lg">
                                {{ $status['icon'] }}
                            </span>
                        </div>


                        {{-- DETAILS --}}
                        <div class="pb-8">

                            <div class="flex flex-wrap items-center gap-2">

                                <h3 class="font-semibold {{ $titleClass }}">
                                    {{ $status['label'] }}
                                </h3>


                                @if($current)

                                    <span class="rounded-full bg-emerald-100 px-2.5 py-1 text-[10px] font-bold text-emerald-700">
                                        Current
                                    </span>

                                @elseif($completed)

                                    <span class="text-xs font-semibold text-emerald-600">
                                        ✓ Completed
                                    </span>

                                @endif

                            </div>


                            <p class="mt-1 text-sm {{ $descriptionClass }}">
                                {{ $status['description'] }}
                            </p>

                            @if($current)
                                <p class="mt-2 text-[11px] font-semibold text-emerald-600">
                                    Current order status
                                </p>
                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>


    {{-- CONTENT GRID --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">


        {{-- ORDER ITEMS --}}
        <section class="lg:col-span-2">

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex items-center justify-between gap-3">

                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                🛍️
                            </div>

                            <div>

                                <h2 class="font-bold text-slate-900 sm:text-lg">
                                    Order Items
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    {{ $order->items->sum('quantity') }} total items
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="divide-y divide-slate-100 px-5 sm:px-6">

                    @foreach($order->items as $item)

                        @php
                            $itemTotal = (float) $item->price * (int) $item->quantity;
                        @endphp


                        <div class="flex gap-4 py-5 first:pt-5 sm:gap-5">

                            {{-- PRODUCT IMAGE --}}
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 sm:h-24 sm:w-24">

                                @if($item->product && $item->product->image)

                                    <img
                                        src="{{ asset('storage/' . ltrim($item->product->image, '/')) }}"
                                        alt="{{ $item->product->name }}"
                                        class="h-full w-full object-contain p-2"
                                        onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                    >

                                @else

                                    <img
                                        src="{{ asset('images/products/product-placeholder.png') }}"
                                        alt="Product"
                                        class="h-full w-full object-contain p-2"
                                    >

                                @endif

                            </div>


                            {{-- PRODUCT INFO --}}
                            <div class="min-w-0 flex-1">

                                <h3 class="text-sm font-bold text-slate-900 sm:text-base">
                                    {{ $item->product->name ?? 'Product' }}
                                </h3>


                                @if($item->product && $item->product->category)

                                    <p class="mt-1 text-xs font-medium text-slate-500">
                                        {{ $item->product->category->name }}
                                    </p>

                                @endif


                                <p class="mt-2 text-xs text-slate-500 sm:text-sm">
                                    Quantity: {{ $item->quantity }}
                                </p>


                                <p class="mt-1 text-xs text-slate-400">
                                    ₹{{ number_format($item->price, 2) }} each
                                </p>

                            </div>


                            {{-- PRICE --}}
                            <div class="shrink-0 text-right">

                                <p class="text-sm font-black text-slate-900 sm:text-base">
                                    ₹{{ number_format($itemTotal, 2) }}
                                </p>

                                <p class="mt-1 text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                    Item Total
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- RIGHT SIDE --}}
        <aside class="space-y-6">


            {{-- DELIVERY ADDRESS --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                        📍
                    </div>

                    <div>

                        <h2 class="font-bold text-slate-900">
                            Delivery Address
                        </h2>

                        <p class="text-xs text-slate-400">
                            Your selected address
                        </p>

                    </div>

                </div>


                @if($order->address)

                    <div class="space-y-1.5 text-sm text-slate-600">

                        <p class="font-bold text-slate-900">
                            {{ $order->address->name }}
                        </p>

                        <p>
                            {{ $order->address->phone }}
                        </p>

                        <p class="pt-2 leading-6">

                            {{ $order->address->address }}

                            @if($order->address->landmark)
                                , {{ $order->address->landmark }}
                            @endif

                            @if($order->address->village)
                                , {{ $order->address->village }}
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

                @else

                    <p class="text-sm text-slate-500">
                        Address information unavailable.
                    </p>

                @endif

            </section>


            {{-- PAYMENT --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        💳
                    </div>

                    <div>

                        <h2 class="font-bold text-slate-900">
                            Payment
                        </h2>

                        <p class="text-xs text-slate-400">
                            Payment details
                        </p>

                    </div>

                </div>


                <div class="space-y-4">

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-slate-500">
                            Method
                        </span>

                        <span class="font-semibold uppercase text-slate-900">
                            {{ $order->payment_method }}
                        </span>

                    </div>


                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm text-slate-500">
                            Status
                        </span>

                        @php
                            $paymentStatusClasses = match($order->payment_status) {
                                'paid' => 'bg-emerald-100 text-emerald-700',
                                'failed' => 'bg-red-100 text-red-700',
                                default => 'bg-amber-100 text-amber-700',
                            };
                        @endphp

                        <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase {{ $paymentStatusClasses }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>

                    </div>

                </div>

            </section>


            {{-- ORDER SUMMARY --}}
            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 bg-slate-950 p-5 text-white sm:p-6">

                    <p class="text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300">
                        Order Total
                    </p>

                    <h2 class="mt-1 text-xl font-black">
                        Summary
                    </h2>

                </div>


                <div class="p-5 sm:p-6">

                    <div class="space-y-4 text-sm">

                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                Subtotal
                            </span>

                            <span class="font-semibold text-slate-900">
                                ₹{{ number_format($order->subtotal, 2) }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between">

                            <span class="text-slate-500">
                                Delivery
                            </span>

                            <span class="font-semibold text-emerald-600">

                                @if($order->delivery_charge > 0)
                                    ₹{{ number_format($order->delivery_charge, 2) }}
                                @else
                                    FREE
                                @endif

                            </span>

                        </div>


                        @if($order->discount > 0)

                            <div class="flex items-center justify-between">

                                <span class="text-slate-500">
                                    Discount
                                </span>

                                <span class="font-semibold text-emerald-600">
                                    -₹{{ number_format($order->discount, 2) }}
                                </span>

                            </div>

                        @endif

                    </div>


                    <div class="mt-5 border-t border-slate-200 pt-5">

                        <div class="flex items-center justify-between gap-4">

                            <span class="font-bold text-slate-900">
                                Total
                            </span>

                            <span class="text-2xl font-black text-emerald-600">
                                ₹{{ number_format($order->total_amount, 2) }}
                            </span>

                        </div>

                    </div>

                </div>

            </section>

        </aside>

    </div>


    @if($order->status !== 'delivered')
        <div class="mt-6 rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-3">
            <div class="flex items-center gap-3">
                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white text-sm">
                    🔄
                </span>

                <p class="text-xs font-semibold leading-5 text-emerald-800 sm:text-sm">
                    Order status updates automatically while your order is in progress.
                </p>
            </div>
        </div>
    @endif


    {{-- BOTTOM ACTIONS --}}
    <div class="mt-6 flex flex-col gap-3 sm:flex-row">

        <a
            href="{{ route('orders.index') }}"
            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-600 shadow-sm transition hover:bg-slate-50 hover:text-slate-900"
        >
            View My Orders
        </a>


        <a
            href="{{ route('home') }}"
            class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700"
        >
            Continue Shopping →
        </a>

    </div>

</main>


{{-- FOOTER --}}
<footer class="border-t border-slate-200 bg-slate-950 text-white">

    <div class="mx-auto max-w-7xl px-4 py-7 text-center sm:px-6 lg:px-8">

        <p class="text-xs text-slate-500 sm:text-sm">
            © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
        </p>

    </div>

</footer>

@if($order->status !== 'delivered')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const refreshTimer = setInterval(() => {
                window.location.reload();
            }, 15000);

            window.addEventListener('beforeunload', () => {
                clearInterval(refreshTimer);
            });
        });
    </script>
@endif

</body>
</html>