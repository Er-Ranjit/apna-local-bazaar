<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $category->name }} - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

@php
    $cartCount = $cartCount ?? 0;
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


        {{-- ACTIONS --}}
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
            >

                <img
                    src="{{ asset('images/icons/cart.png') }}"
                    alt="Cart"
                    class="h-7 w-7 object-contain"
                >

                <span class="absolute right-0 top-0 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[10px] font-bold text-white">
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
<main class="mx-auto max-w-7xl px-4 py-6 pb-12 sm:px-6 sm:py-8 lg:px-8">


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

        <span class="font-semibold text-slate-700">
            {{ $category->name }}
        </span>

    </div>


    {{-- CATEGORY HERO --}}
    <section class="mb-6 overflow-hidden rounded-3xl bg-slate-950 p-6 text-white shadow-sm sm:p-8">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.16em] text-emerald-300">
                    Category
                </span>

                <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">
                    {{ $category->name }}
                </h1>

                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                    Explore quality products from trusted local sellers in this category.
                </p>

            </div>


            <div class="flex shrink-0 items-center gap-3">

                <div class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4 text-center">

                    <p class="text-2xl font-black text-white">
                        {{ $products->count() }}
                    </p>

                    <p class="mt-1 text-[10px] font-bold uppercase tracking-wider text-slate-400">
                        Products
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- CATEGORY IMAGE --}}
    @if(!empty($category->image))

        <div class="mb-6 overflow-hidden rounded-2xl border border-slate-200 bg-white">

            <div class="flex items-center gap-4 p-4 sm:p-5">

                <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-emerald-50">

                    <img
                        src="{{ asset('images/' . ltrim($category->image, '/')) }}"
                        alt="{{ $category->name }}"
                        class="h-12 w-12 object-contain"
                        onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';"
                    >

                </div>

                <div>

                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">
                        Browse Category
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-900 sm:text-base">
                        {{ $category->name }} products from your local marketplace
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- CONTROLS --}}
    <div class="mb-5 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm sm:flex-row sm:items-center sm:justify-between">

        <div>

            <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">
                Product Collection
            </p>

            <h2 class="mt-1 text-xl font-black text-slate-950">
                {{ $category->name }}
            </h2>

        </div>


        <div class="flex flex-col gap-2 sm:flex-row">

            <div class="relative">

                <input
                    id="categorySearch"
                    type="search"
                    placeholder="Search in {{ $category->name }}..."
                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 sm:w-64"
                >

            </div>


            <button
                type="button"
                id="clearCategorySearch"
                class="hidden h-11 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Clear
            </button>

        </div>

    </div>


    {{-- SEARCH MESSAGE --}}
    <p
        id="categorySearchMessage"
        class="mb-4 hidden text-sm font-semibold text-emerald-700"
    ></p>


    {{-- PRODUCTS --}}
    @if($products->count())

        <div
            id="categoryProductGrid"
            class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5"
        >

            @foreach($products as $product)

                @php

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

                @endphp


                <article
                    class="category-product-card group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-100 hover:shadow-lg"
                    data-name="{{ strtolower($product->name) }}"
                    data-description="{{ strtolower($product->description ?? '') }}"
                >

                    {{-- IMAGE --}}
                    <a
                        href="{{ route('product.show', $product->slug) }}"
                        class="block"
                    >

                        <div class="relative flex h-40 items-center justify-center overflow-hidden bg-white p-3 sm:h-44">


                            @if($hasDiscount)

                                <span class="absolute left-2 top-2 z-10 rounded-lg bg-red-500 px-2 py-1 text-[9px] font-bold text-white">
                                    {{ $discountPercent }}% OFF
                                </span>

                            @endif


                            @if($product->stock <= 0)

                                <span class="absolute right-2 top-2 z-10 rounded-lg bg-slate-800 px-2 py-1 text-[9px] font-bold text-white">
                                    Out of Stock
                                </span>

                            @elseif($product->stock <= 5)

                                <span class="absolute right-2 top-2 z-10 rounded-lg bg-amber-500 px-2 py-1 text-[9px] font-bold text-white">
                                    Only {{ $product->stock }} left
                                </span>

                            @endif


                            @if($product->image)

                                <img
                                    src="{{ asset('images/' . ltrim($product->image, '/')) }}"
                                    alt="{{ $product->name }}"
                                    class="h-full w-full object-contain transition duration-300 group-hover:scale-105"
                                    onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                >

                            @else

                                <img
                                    src="{{ asset('images/products/product-placeholder.png') }}"
                                    alt="{{ $product->name }}"
                                    class="h-28 w-28 object-contain"
                                >

                            @endif

                        </div>

                    </a>


                    {{-- DETAILS --}}
                    <div class="p-3 sm:p-4">

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block truncate text-sm font-bold text-slate-900 transition hover:text-emerald-700 sm:text-base"
                        >
                            {{ $product->name }}
                        </a>


                        <p class="mt-1 line-clamp-2 min-h-[32px] text-xs leading-4 text-slate-500">
                            {{ $product->description ?: 'Quality product from a trusted local seller.' }}
                        </p>


                        {{-- VENDOR --}}
                        @if($product->vendor)

                            <p class="mt-2 truncate text-[10px] font-semibold uppercase tracking-wide text-slate-400">
                                {{ $product->vendor->shop_name }}
                            </p>

                        @endif


                        {{-- PRICE --}}
                        <div class="mt-3 flex items-end justify-between gap-2">

                            <div class="min-w-0">

                                <p class="text-base font-black text-emerald-700 sm:text-lg">
                                    ₹{{ number_format($sellingPrice, 2) }}
                                </p>


                                @if($hasDiscount)

                                    <p class="text-[10px] text-slate-400 line-through sm:text-xs">
                                        ₹{{ number_format($product->price, 2) }}
                                    </p>

                                @endif

                            </div>


                            {{-- ADD --}}
                            @auth

                                @if(
                                    $product->stock > 0 &&
                                    $product->is_active &&
                                    $product->is_available
                                )

                                    <form
                                        action="{{ route('cart.add', $product) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-600 text-xl font-medium text-white shadow-sm transition hover:bg-emerald-700 sm:h-auto sm:w-auto sm:rounded-xl sm:px-3 sm:py-2 sm:text-xs sm:font-bold"
                                            aria-label="Add {{ $product->name }} to cart"
                                        >
                                            <span class="sm:hidden">
                                                +
                                            </span>

                                            <span class="hidden sm:inline">
                                                + Add
                                            </span>

                                        </button>

                                    </form>

                                @else

                                    <button
                                        type="button"
                                        disabled
                                        class="h-10 shrink-0 rounded-xl bg-slate-100 px-3 text-[10px] font-bold text-slate-400"
                                    >
                                        Sold Out
                                    </button>

                                @endif

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-xl font-medium text-white sm:h-auto sm:w-auto sm:rounded-xl sm:px-3 sm:py-2 sm:text-xs sm:font-bold"
                                >
                                    <span class="sm:hidden">
                                        +
                                    </span>

                                    <span class="hidden sm:inline">
                                        + Add
                                    </span>

                                </a>

                            @endauth

                        </div>

                    </div>

                </article>

            @endforeach


            {{-- NO SEARCH RESULT --}}
            <div
                id="categoryNoResults"
                class="col-span-full hidden rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center"
            >

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-100 text-3xl">
                    🔎
                </div>

                <h3 class="mt-4 text-lg font-bold text-slate-900">
                    No matching products
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Try searching with another product name.
                </p>

                <button
                    type="button"
                    id="showAllCategoryProducts"
                    class="mt-5 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-700"
                >
                    Show All Products
                </button>

            </div>

        </div>


    @else

        {{-- EMPTY CATEGORY --}}
        <section class="rounded-3xl border border-slate-200 bg-white px-6 py-16 text-center shadow-sm sm:px-10 sm:py-20">

            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-emerald-50 text-4xl">
                🛍️
            </div>


            <h2 class="mt-6 text-2xl font-black text-slate-950 sm:text-3xl">
                No Products Available
            </h2>


            <p class="mx-auto mt-3 max-w-md text-sm leading-6 text-slate-500">
                There are currently no active products in this category.
                Please explore another category.
            </p>


            <a
                href="{{ route('home') }}"
                class="mt-7 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white shadow-sm shadow-emerald-600/20 transition hover:bg-emerald-700"
            >
                ← Back to Home
            </a>

        </section>

    @endif


    {{-- BACK HOME --}}
    <div class="mt-6">

        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-emerald-50 hover:text-emerald-700"
        >
            ← Continue Shopping
        </a>

    </div>

</main>


{{-- =========================================================
    MOBILE BOTTOM NAV
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

            <span class="absolute left-1/2 top-0 ml-2 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[9px] font-bold text-white">
                {{ $cartCount }}
            </span>

            <span class="text-[10px] font-bold">
                Cart
            </span>

        </a>

    </div>

</nav>


<div class="h-20 lg:hidden"></div>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput =
        document.getElementById('categorySearch');

    const clearButton =
        document.getElementById('clearCategorySearch');

    const searchMessage =
        document.getElementById('categorySearchMessage');

    const noResults =
        document.getElementById('categoryNoResults');

    const showAllButton =
        document.getElementById('showAllCategoryProducts');

    const cards = [
        ...document.querySelectorAll('.category-product-card')
    ];


    const applySearch = () => {

        const query =
            (searchInput?.value || '').trim().toLowerCase();


        let visibleCount = 0;


        cards.forEach((card) => {

            const name =
                (card.dataset.name || '').toLowerCase();

            const description =
                (card.dataset.description || '').toLowerCase();


            const matches =
                !query ||
                name.includes(query) ||
                description.includes(query);


            card.classList.toggle(
                'hidden',
                !matches
            );


            if (matches) {
                visibleCount++;
            }

        });


        if (query) {

            clearButton?.classList.remove('hidden');

            searchMessage?.classList.remove('hidden');

            if (searchMessage) {

                searchMessage.textContent =
                    visibleCount === 0
                        ? `No products found for "${searchInput.value.trim()}"`
                        : `${visibleCount} product${visibleCount > 1 ? 's' : ''} found`;

            }

        } else {

            clearButton?.classList.add('hidden');
            searchMessage?.classList.add('hidden');

        }


        if (query && visibleCount === 0) {

            noResults?.classList.remove('hidden');

        } else {

            noResults?.classList.add('hidden');

        }

    };


    const resetSearch = () => {

        if (searchInput) {
            searchInput.value = '';
        }

        cards.forEach((card) => {
            card.classList.remove('hidden');
        });

        clearButton?.classList.add('hidden');
        searchMessage?.classList.add('hidden');
        noResults?.classList.add('hidden');

    };


    searchInput?.addEventListener(
        'input',
        applySearch
    );


    searchInput?.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                applySearch();

            }

        }
    );


    clearButton?.addEventListener(
        'click',
        resetSearch
    );


    showAllButton?.addEventListener(
        'click',
        resetSearch
    );

});

</script>

</body>
</html>