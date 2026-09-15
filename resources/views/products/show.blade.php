<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $product->name }} - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

@php
    $cartCount = $cartCount ?? 0;

    $hasDiscount =
        $product->discount_price !== null &&
        (float) $product->discount_price < (float) $product->price;

    $sellingPrice = $hasDiscount
        ? (float) $product->discount_price
        : (float) $product->price;

    $discountPercent = $hasDiscount && (float) $product->price > 0
        ? round(
            (((float) $product->price - (float) $product->discount_price)
            / (float) $product->price) * 100
        )
        : 0;

    $stock = (int) ($product->stock ?? 0);

    $stockStatus = match (true) {
        $stock <= 0 => [
            'label' => 'Out of Stock',
            'class' => 'border-red-200 bg-red-50 text-red-700',
            'dot' => 'bg-red-500',
        ],

        $stock <= 5 => [
            'label' => 'Only ' . $stock . ' left',
            'class' => 'border-amber-200 bg-amber-50 text-amber-700',
            'dot' => 'bg-amber-500',
        ],

        default => [
            'label' => 'In Stock',
            'class' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
            'dot' => 'bg-emerald-500',
        ],
    };
@endphp


{{-- =========================================================
    HEADER
========================================================= --}}
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

    <div class="mx-auto flex min-h-[70px] max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:min-h-[80px] lg:px-8">

        {{-- LOGO --}}
        <a
            href="{{ route('home') }}"
            class="flex min-w-0 items-center gap-3"
        >

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-9 w-auto shrink-0 sm:h-11"
            >

            <div class="hidden sm:block">

                <p class="text-sm font-bold text-slate-900">
                    Apna Local Bazaar
                </p>

                <p class="text-xs text-slate-400">
                    Your Local Marketplace
                </p>

            </div>

        </a>


        {{-- HEADER ACTIONS --}}
        <div class="flex items-center gap-2 sm:gap-3">

            <a
                href="{{ route('home') }}"
                class="hidden items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700 sm:inline-flex"
            >
                Home
            </a>


            @auth

                <a
                    href="{{ route('orders.index') }}"
                    class="hidden items-center rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-emerald-50 hover:text-emerald-700 sm:inline-flex"
                >
                    My Orders
                </a>

            @endauth


            {{-- CART --}}
            <a
                href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                class="relative flex h-11 w-11 items-center justify-center rounded-xl transition hover:bg-emerald-50"
                aria-label="Cart"
            >

                <img
                    src="{{ asset('images/icons/cart.png') }}"
                    alt="Cart"
                    class="h-7 w-7 object-contain"
                >

                <span
                    class="absolute right-0 top-0 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[10px] font-bold text-white"
                >
                    {{ $cartCount }}
                </span>

            </a>


            @auth

                <div class="hidden h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700 sm:flex">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            @else

                <a
                    href="{{ route('login') }}"
                    class="hidden rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-bold text-white transition hover:bg-emerald-700 sm:inline-flex"
                >
                    Login
                </a>

            @endauth

        </div>

    </div>

</header>


{{-- =========================================================
    MAIN
========================================================= --}}
<main class="mx-auto max-w-7xl px-4 py-6 pb-28 sm:px-6 sm:py-8 lg:px-8">


    {{-- BREADCRUMB --}}
    <div class="mb-5 flex flex-wrap items-center gap-2 text-xs font-medium text-slate-500 sm:text-sm">

        <a
            href="{{ route('home') }}"
            class="transition hover:text-emerald-700"
        >
            Home
        </a>

        <span class="text-slate-300">
            ›
        </span>


        @if($product->category)

            <a
                href="{{ route('category', $product->category->slug) }}"
                class="transition hover:text-emerald-700"
            >
                {{ $product->category->name }}
            </a>

            <span class="text-slate-300">
                ›
            </span>

        @endif


        <span class="truncate font-semibold text-slate-700">
            {{ $product->name }}
        </span>

    </div>


    {{-- PRODUCT CARD --}}
    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

        <div class="grid lg:grid-cols-2">


            {{-- =================================================
                PRODUCT IMAGE
            ================================================== --}}
            <div class="relative flex min-h-[340px] items-center justify-center bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 p-6 sm:min-h-[460px] sm:p-10 lg:min-h-[560px]">

                {{-- Discount Badge --}}
                @if($hasDiscount)

                    <span class="absolute left-5 top-5 z-10 inline-flex items-center rounded-full bg-red-500 px-3.5 py-1.5 text-xs font-bold text-white shadow-sm sm:left-7 sm:top-7">
                        {{ $discountPercent }}% OFF
                    </span>

                @endif


                {{-- Image Box --}}
                <div class="flex h-full w-full max-w-2xl items-center justify-center rounded-3xl bg-white/60 p-4">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                            alt="{{ $product->name }}"
                            class="max-h-[420px] w-full object-contain drop-shadow-sm sm:max-h-[460px]"
                            onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                        >

                    @else

                        <img
                            src="{{ asset('images/products/product-placeholder.png') }}"
                            alt="{{ $product->name }}"
                            class="h-64 w-64 object-contain"
                        >

                    @endif

                </div>

            </div>


            {{-- =================================================
                PRODUCT DETAILS
            ================================================== --}}
            <div class="flex flex-col p-6 sm:p-9 lg:p-12">


                {{-- CATEGORY --}}
                @if($product->category)

                    <a
                        href="{{ route('category', $product->category->slug) }}"
                        class="w-fit text-xs font-bold uppercase tracking-[0.16em] text-emerald-600 transition hover:text-emerald-700"
                    >
                        {{ $product->category->name }}
                    </a>

                @endif


                {{-- PRODUCT NAME --}}
                <h1 class="mt-3 text-3xl font-black leading-tight tracking-tight text-slate-950 sm:text-4xl">
                    {{ $product->name }}
                </h1>


                {{-- RATING --}}
                <div class="mt-4 flex flex-wrap items-center gap-2">

                    <span class="inline-flex items-center gap-1 rounded-lg bg-amber-50 px-2.5 py-1 text-sm font-bold text-amber-700">
                        <span>★</span>
                        <span>4.5</span>
                    </span>

                    <span class="text-xs font-medium text-slate-400 sm:text-sm">
                        Trusted local product
                    </span>

                </div>


                {{-- PRICE --}}
                <div class="mt-7">

                    <div class="flex flex-wrap items-end gap-3">

                        <span class="text-3xl font-black text-emerald-700 sm:text-4xl">
                            ₹{{ number_format($sellingPrice, 2) }}
                        </span>


                        @if($hasDiscount)

                            <span class="pb-1 text-lg text-slate-400 line-through">
                                ₹{{ number_format($product->price, 2) }}
                            </span>

                            <span class="rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700">
                                Save ₹{{ number_format((float) $product->price - $sellingPrice, 2) }}
                            </span>

                        @endif

                    </div>


                    <p class="mt-2 text-xs text-slate-400">
                        Price shown is for one item.
                    </p>

                </div>


                {{-- DESCRIPTION --}}
                <div class="mt-7 border-t border-slate-100 pt-6">

                    <h2 class="text-xs font-bold uppercase tracking-[0.14em] text-slate-400">
                        About this product
                    </h2>

                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        {{ $product->description ?: 'A quality product available from your trusted local marketplace.' }}
                    </p>

                </div>


                {{-- VENDOR --}}
                @if($product->vendor)

                    <div class="mt-6 flex items-center gap-3 rounded-2xl border border-slate-100 bg-slate-50 p-4">

                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                            🏪
                        </div>

                        <div class="min-w-0">

                            <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                Sold by
                            </p>

                            <p class="truncate text-sm font-bold text-slate-900">
                                {{ $product->vendor->shop_name ?? 'Local Store' }}
                            </p>

                            @if($product->vendor->city)

                                <p class="mt-0.5 text-xs text-slate-500">
                                    {{ $product->vendor->city }}
                                </p>

                            @endif

                        </div>

                    </div>

                @endif


                {{-- STOCK --}}
                <div class="mt-6">

                    <span class="inline-flex items-center gap-2 rounded-full border px-3 py-1.5 text-xs font-bold {{ $stockStatus['class'] }}">

                        <span class="h-2 w-2 rounded-full {{ $stockStatus['dot'] }}"></span>

                        {{ $stockStatus['label'] }}

                    </span>

                </div>


                {{-- ADD TO CART --}}
                @auth

                    @if(
                        $stock > 0 &&
                        $product->is_active &&
                        $product->is_available
                    )

                        <form
                            action="{{ route('cart.add', $product) }}"
                            method="POST"
                            class="mt-7"
                        >

                            @csrf


                            <div class="flex flex-col gap-3 sm:flex-row">


                                {{-- QUANTITY --}}
                                <div class="flex h-12 shrink-0 items-center overflow-hidden rounded-xl border border-slate-200 bg-white">

                                    <button
                                        type="button"
                                        id="minusBtn"
                                        class="flex h-full w-11 items-center justify-center text-lg font-bold text-slate-500 transition hover:bg-slate-50"
                                        aria-label="Decrease quantity"
                                    >
                                        −
                                    </button>


                                    <input
                                        id="quantity"
                                        name="quantity"
                                        type="number"
                                        min="1"
                                        max="{{ $stock }}"
                                        value="1"
                                        required
                                        class="h-full w-16 border-x border-slate-100 text-center text-sm font-bold outline-none"
                                    >


                                    <button
                                        type="button"
                                        id="plusBtn"
                                        class="flex h-full w-11 items-center justify-center text-lg font-bold text-slate-500 transition hover:bg-slate-50"
                                        aria-label="Increase quantity"
                                    >
                                        +
                                    </button>

                                </div>


                                {{-- ADD BUTTON --}}
                                <button
                                    type="submit"
                                    class="flex h-12 flex-1 items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 text-sm font-bold text-white shadow-lg shadow-emerald-900/10 transition hover:bg-emerald-700"
                                >
                                    <span>🛒</span>
                                    Add to Cart
                                </button>

                            </div>


                            <p class="mt-2 text-xs text-slate-400">
                                Maximum available quantity: {{ $stock }}
                            </p>

                        </form>

                    @else

                        <button
                            type="button"
                            disabled
                            class="mt-7 flex h-12 w-full cursor-not-allowed items-center justify-center rounded-xl bg-slate-200 text-sm font-bold text-slate-500"
                        >
                            Out of Stock
                        </button>

                    @endif

                @else

                    <a
                        href="{{ route('login') }}"
                        class="mt-7 flex h-12 items-center justify-center rounded-xl bg-emerald-600 px-6 text-sm font-bold text-white shadow-lg transition hover:bg-emerald-700 hover:bg-emerald-700"
                    >
                        Login to Add to Cart
                    </a>

                @endauth


                {{-- CONTINUE SHOPPING --}}
                <a
                    href="{{ route('home') }}"
                    class="mt-3 flex h-12 items-center justify-center rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 transition hover:bg-slate-50 hover:text-emerald-700"
                >
                    ← Continue Shopping
                </a>


                {{-- BENEFITS --}}
                <div class="mt-7 grid grid-cols-3 gap-2 border-t border-slate-100 pt-6">

                    <div class="rounded-xl p-2 text-center">

                        <div class="text-lg">
                            🚚
                        </div>

                        <p class="mt-1 text-[10px] font-bold text-slate-600 sm:text-xs">
                            Fast Delivery
                        </p>

                    </div>


                    <div class="rounded-xl p-2 text-center">

                        <div class="text-lg">
                            ✓
                        </div>

                        <p class="mt-1 text-[10px] font-bold text-slate-600 sm:text-xs">
                            Trusted Quality
                        </p>

                    </div>


                    <div class="rounded-xl p-2 text-center">

                        <div class="text-lg">
                            💵
                        </div>

                        <p class="mt-1 text-[10px] font-bold text-slate-600 sm:text-xs">
                            COD Available
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        RELATED PRODUCTS
    ========================================================== --}}
    @if($relatedProducts->count())

        <section class="mt-10">

            <div class="mb-5 flex items-end justify-between gap-4">

                <div>

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                        More to explore
                    </p>

                    <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-950">
                        Related Products
                    </h2>

                </div>


                @if($product->category)

                    <a
                        href="{{ route('category', $product->category->slug) }}"
                        class="shrink-0 text-sm font-bold text-emerald-700 transition hover:text-emerald-800"
                    >
                        View All →
                    </a>

                @endif

            </div>


            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">

                @foreach($relatedProducts as $related)

                    @php
                        $relatedHasDiscount =
                            $related->discount_price !== null &&
                            (float) $related->discount_price < (float) $related->price;
                    @endphp

                    <a
                        href="{{ route('product.show', $related->slug) }}"
                        class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:border-emerald-100 hover:shadow-md"
                    >

                        <div class="relative flex h-40 items-center justify-center overflow-hidden bg-white p-4">

                            @if($relatedHasDiscount)

                                <span class="absolute left-2 top-2 z-10 rounded-lg bg-red-500 px-2 py-1 text-[9px] font-bold text-white">
                                    SALE
                                </span>

                            @endif


                            @if($related->image)

                                <img
                                    src="{{ asset('storage/' . ltrim($related->image, '/')) }}"
                                    alt="{{ $related->name }}"
                                    class="h-full w-full object-contain transition duration-300 group-hover:scale-105"
                                    onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                >

                            @else

                                <img
                                    src="{{ asset('images/products/product-placeholder.png') }}"
                                    alt="{{ $related->name }}"
                                    class="h-28 w-28 object-contain"
                                >

                            @endif

                        </div>


                        <div class="p-4">

                            <h3 class="truncate text-sm font-bold text-slate-900">
                                {{ $related->name }}
                            </h3>


                            <p class="mt-1 truncate text-xs text-slate-500">
                                {{ $related->category?->name ?? 'Local Product' }}
                            </p>


                            <div class="mt-3 flex items-end gap-2">

                                <span class="text-base font-black text-emerald-700">
                                    ₹{{ number_format($related->discount_price ?? $related->price, 2) }}
                                </span>


                                @if($relatedHasDiscount)

                                    <span class="text-[10px] text-slate-400 line-through">
                                        ₹{{ number_format($related->price, 2) }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>

    @endif

</main>


{{-- =========================================================
    MOBILE BOTTOM NAVIGATION
========================================================= --}}
<nav class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-200 bg-white/95 px-3 pt-2 shadow-[0_-6px_24px_rgba(15,23,42,0.08)] backdrop-blur-xl lg:hidden">

    <div class="mx-auto grid max-w-lg grid-cols-3 gap-2">

        <a
            href="{{ route('home') }}"
            class="flex flex-col items-center gap-1 rounded-xl py-2 text-slate-500"
        >
            <span class="text-lg leading-none">
                ⌂
            </span>

            <span class="text-[10px] font-semibold">
                Home
            </span>
        </a>


        @auth

            <a
                href="{{ route('orders.index') }}"
                class="flex flex-col items-center gap-1 rounded-xl py-2 text-slate-500"
            >
                <span class="text-lg leading-none">
                    ▤
                </span>

                <span class="text-[10px] font-semibold">
                    Orders
                </span>
            </a>

        @else

            <a
                href="{{ route('login') }}"
                class="flex flex-col items-center gap-1 rounded-xl py-2 text-slate-500"
            >
                <span class="text-lg leading-none">
                    ◯
                </span>

                <span class="text-[10px] font-semibold">
                    Login
                </span>
            </a>

        @endauth


        <a
            href="{{ auth()->check() ? route('cart.index') : route('login') }}"
            class="relative flex flex-col items-center gap-1 rounded-xl py-2 text-emerald-600"
        >

            <span class="text-lg leading-none">
                🛒
            </span>

            <span
                class="absolute left-1/2 top-0 ml-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[9px] font-bold text-white"
            >
                {{ $cartCount }}
            </span>

            <span class="text-[10px] font-bold">
                Cart
            </span>

        </a>

    </div>

</nav>


{{-- =========================================================
    QUANTITY SCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const quantityInput =
        document.getElementById('quantity');

    const minusBtn =
        document.getElementById('minusBtn');

    const plusBtn =
        document.getElementById('plusBtn');


    if (!quantityInput) {
        return;
    }


    const getMin = () => {
        return parseInt(quantityInput.min, 10) || 1;
    };


    const getMax = () => {
        return parseInt(quantityInput.max, 10) || 999999;
    };


    const setQuantity = (value) => {

        let quantity =
            parseInt(value, 10) || getMin();

        if (quantity < getMin()) {
            quantity = getMin();
        }

        if (quantity > getMax()) {
            quantity = getMax();
        }

        quantityInput.value = quantity;

    };


    minusBtn?.addEventListener(
        'click',
        function () {

            setQuantity(
                parseInt(quantityInput.value, 10) - 1
            );

        }
    );


    plusBtn?.addEventListener(
        'click',
        function () {

            setQuantity(
                parseInt(quantityInput.value, 10) + 1
            );

        }
    );


    quantityInput.addEventListener(
        'input',
        function () {
            setQuantity(this.value);
        }
    );

});

</script>

</body>
</html>