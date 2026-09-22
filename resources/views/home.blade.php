<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f7faf8] text-slate-900 antialiased">

@php
    $categoryOrder = [
        'fast-food' => ['🍔', 'Fast Food'],
        'fruits-vegetables' => ['🍎', 'Fruits & Vegetables'],
        'kirana' => ['🛍️', 'Grocery'],
        'dairy-products' => ['🥛', 'Dairy Products'],
        'bakery' => ['🍰', 'Bakery'],
        'medicines' => ['💊', 'Medicines'],
        'beverages' => ['🥤', 'Beverages'],
        'household-essentials' => ['🏠', 'Household Essentials'],
    ];

    $categoryMap = $categories->keyBy('slug');

    $cartCount = $cartCount ?? 0;
@endphp


{{-- =========================================================
    HEADER
========================================================= --}}

<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 shadow-sm backdrop-blur">

    <div class="mx-auto flex h-16 max-w-[1440px] items-center gap-3 px-4 sm:px-6 lg:px-8">

        {{-- Mobile Menu --}}
        <button
            id="mobileMenuButton"
            type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 transition hover:bg-slate-50 lg:hidden"
        >
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>


        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            class="flex shrink-0 items-center gap-2"
        >
            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-600 text-xl shadow-sm">
                🛍️
            </div>

            <div class="hidden sm:block">
                <div class="text-base font-black leading-none text-slate-900">
                    Apna Local Bazaar
                </div>

                <div class="mt-1 text-[10px] font-semibold text-emerald-600">
                    Shop Local • Live Local
                </div>
            </div>
        </a>


        {{-- Desktop Location --}}
        <button
            type="button"
            class="customer-location-button ml-2 hidden h-10 max-w-[190px] items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 text-left transition hover:border-emerald-300 hover:bg-emerald-50 lg:flex"
        >
            <span class="text-lg">📍</span>

            <span class="min-w-0">
                <span class="block text-[10px] font-bold uppercase tracking-wide text-slate-400">
                    Deliver to
                </span>

                <span
                    id="desktopLocationText"
                    class="block truncate text-xs font-bold text-slate-700"
                >
                    @auth
                        {{ auth()->user()->latitude ? 'Current Location' : 'Select Location' }}
                    @else
                        Select Location
                    @endauth
                </span>
            </span>
        </button>


        {{-- Desktop Search --}}
        <div class="relative ml-auto hidden w-full max-w-xl lg:block">

            <input
                id="desktopProductSearch"
                type="search"
                placeholder="Search products, categories..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-100"
            >

            <svg
                class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>

            <button
                id="desktopSearchButton"
                type="button"
                class="absolute right-1.5 top-1.5 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-600 text-white transition hover:bg-emerald-700"
            >
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
            </button>

        </div>


        {{-- Mobile Location --}}
        <button
            type="button"
            class="customer-location-button ml-auto inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-lg lg:hidden"
        >
            📍
        </button>


        {{-- Cart --}}
        <a
            href="{{ route('cart.index') }}"
            class="relative flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white transition hover:border-emerald-300 hover:bg-emerald-50"
        >
            <svg class="h-5 w-5 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M3 3h2l2.4 11.4a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 7H6"/>
                <circle cx="10" cy="20" r="1.5"/>
                <circle cx="18" cy="20" r="1.5"/>
            </svg>

            <span
                id="desktopCartCount"
                class="absolute -right-1.5 -top-1.5 flex min-h-5 min-w-5 items-center justify-center rounded-full bg-emerald-600 px-1 text-[10px] font-black text-white"
            >
                {{ $cartCount }}
            </span>
        </a>


        {{-- Auth --}}
        @auth

            <div class="group relative hidden lg:block">

                <button
                    type="button"
                    class="flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 transition hover:bg-slate-50"
                >
                    <div class="flex h-7 w-7 items-center justify-center rounded-full bg-emerald-100 text-xs font-black text-emerald-700">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <span class="max-w-[100px] truncate text-xs font-bold text-slate-700">
                        {{ auth()->user()->name }}
                    </span>

                    <svg class="h-4 w-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m6 9 6 6 6-6"/>
                    </svg>
                </button>


                <div class="invisible absolute right-0 top-full mt-2 w-52 translate-y-2 rounded-2xl border border-slate-200 bg-white p-2 opacity-0 shadow-xl transition-all group-hover:visible group-hover:translate-y-0 group-hover:opacity-100">

                    <div class="border-b border-slate-100 px-3 py-2">
                        <p class="text-xs font-black text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-0.5 truncate text-[11px] text-slate-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                    <a
                        href="{{ route('orders.index') }}"
                        class="mt-1 flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        📦 My Orders
                    </a>

                    <a
                        href="{{ route('cart.index') }}"
                        class="flex items-center gap-2 rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                    >
                        🛒 My Cart
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-left text-sm font-semibold text-red-600 hover:bg-red-50"
                        >
                            🚪 Logout
                        </button>
                    </form>

                </div>

            </div>

        @else

            <a
                href="{{ route('login') }}"
                class="hidden rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-black text-white transition hover:bg-emerald-700 lg:block"
            >
                Login
            </a>

        @endauth

    </div>


    {{-- Mobile Search --}}
    <div class="px-4 pb-3 lg:hidden">

        <div class="relative">

            <input
                id="mobileProductSearch"
                type="search"
                placeholder="Search products..."
                class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 pl-11 pr-12 text-sm outline-none focus:border-emerald-500 focus:bg-white focus:ring-2 focus:ring-emerald-100"
            >

            <svg
                class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
            </svg>

            <button
                id="mobileSearchButton"
                type="button"
                class="absolute right-1.5 top-1.5 flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-600 text-white"
            >
                🔍
            </button>

        </div>

    </div>

</header>



{{-- =========================================================
    MOBILE MENU
========================================================= --}}

<div
    id="mobileMenu"
    class="fixed inset-0 z-[70] hidden"
>

    <div
        id="mobileMenuOverlay"
        class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm"
    ></div>


    <aside class="absolute left-0 top-0 h-full w-[85%] max-w-sm overflow-y-auto bg-white shadow-2xl">

        <div class="flex h-16 items-center justify-between border-b border-slate-100 px-5">

            <a
                href="{{ route('home') }}"
                class="flex items-center gap-2"
            >
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600">
                    🛍️
                </div>

                <span class="text-sm font-black">
                    Apna Local Bazaar
                </span>
            </a>


            <button
                id="closeMobileMenu"
                type="button"
                class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100"
            >
                ✕
            </button>

        </div>


        <div class="p-4">

            @auth

                <div class="mb-4 rounded-2xl bg-emerald-50 p-4">

                    <div class="flex items-center gap-3">

                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-600 font-black text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0">

                            <p class="truncate text-sm font-black text-slate-800">
                                {{ auth()->user()->name }}
                            </p>

                            <p class="truncate text-xs text-slate-500">
                                {{ auth()->user()->email }}
                            </p>

                        </div>

                    </div>

                </div>

            @endauth


            <nav class="space-y-1">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50"
                >
                    🏠 Home
                </a>


                @auth

                    <a
                        href="{{ route('orders.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50"
                    >
                        📦 My Orders
                    </a>

                    <a
                        href="{{ route('cart.index') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50"
                    >
                        🛒 My Cart
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button
                            type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-3 text-left text-sm font-bold text-red-600 hover:bg-red-50"
                        >
                            🚪 Logout
                        </button>
                    </form>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-bold text-emerald-700 hover:bg-emerald-50"
                    >
                        🔐 Login
                    </a>

                @endauth

            </nav>

        </div>

    </aside>

</div>



{{-- =========================================================
    MAIN
========================================================= --}}

<main class="mx-auto max-w-[1440px] px-4 py-4 pb-40 sm:px-6 sm:py-6 lg:px-8">


    {{-- =====================================================
        DESKTOP CATEGORY + HERO
    ====================================================== --}}

    <section class="hidden gap-6 lg:grid lg:grid-cols-[245px_minmax(0,1fr)]">

        {{-- Categories --}}
        <aside class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <div class="mb-3 flex items-center justify-between">

                <h2 class="text-sm font-black text-slate-900">
                    Shop by Category
                </h2>

                <span class="text-xs text-emerald-600">
                    All
                </span>

            </div>


            <div class="space-y-1">

                @foreach($categoryOrder as $slug => [$icon, $label])

                    @php
                        $category = $categoryMap->get($slug);
                    @endphp

                    @if($category)

                        <a
                            href="{{ route('category.show', $category->slug) }}"
                            class="group flex items-center gap-3 rounded-xl px-3 py-3 transition hover:bg-emerald-50"
                        >

                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-50 text-lg transition group-hover:bg-white">
                                {{ $icon }}
                            </span>

                            <span class="flex-1 text-sm font-semibold text-slate-700 group-hover:text-emerald-700">
                                {{ $label }}
                            </span>

                            <span class="text-slate-300 transition group-hover:translate-x-0.5 group-hover:text-emerald-500">
                                →
                            </span>

                        </a>

                    @endif

                @endforeach

            </div>

        </aside>


        {{-- Desktop Hero --}}
        <div class="relative min-h-[390px] overflow-hidden rounded-3xl bg-slate-900 shadow-sm">

            @foreach([1, 2, 3] as $banner)

                <div
                    class="hero-slide-desktop absolute inset-0 opacity-0 transition-opacity duration-700"
                >

                    <img
                        src="{{ asset('images/banner' . $banner . '.png') }}"
                        alt="Apna Local Bazaar Banner {{ $banner }}"
                        class="h-full w-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/75 via-slate-950/30 to-transparent"></div>


                    <div class="absolute inset-0 flex items-center px-8 xl:px-14">

                        <div class="max-w-xl text-white">

                            <span class="inline-flex rounded-full bg-white/15 px-3 py-1 text-xs font-bold backdrop-blur">
                                Local Shopping Made Easy
                            </span>

                            <h1 class="mt-4 text-4xl font-black leading-tight xl:text-5xl">
                                Fresh Products.
                                <br>
                                Local Shops.
                                <br>
                                Better Shopping.
                            </h1>

                            <p class="mt-4 max-w-lg text-sm leading-6 text-white/80">
                                Discover quality products from trusted local shops and get them delivered to your doorstep.
                            </p>

                            <a
                                href="#desktopProducts"
                                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-black text-white shadow-lg transition hover:bg-emerald-700"
                            >
                                Shop Now
                                <span>→</span>
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach


            <button
                id="prevSlideDesktop"
                type="button"
                class="absolute left-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur transition hover:bg-white/30"
            >
                ‹
            </button>


            <button
                id="nextSlideDesktop"
                type="button"
                class="absolute right-4 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur transition hover:bg-white/30"
            >
                ›
            </button>


            <div class="absolute bottom-5 left-1/2 flex -translate-x-1/2 items-center gap-2">

                @foreach([1, 2, 3] as $dot)

                    <button
                        type="button"
                        class="desktop-slider-dot h-2 rounded-full bg-white/70 transition-all"
                    ></button>

                @endforeach

            </div>

        </div>

    </section>



    {{-- =====================================================
        MOBILE HERO
    ====================================================== --}}

    <section class="relative lg:hidden">

        <div class="relative h-[300px] overflow-hidden rounded-3xl bg-slate-900 shadow-sm">

            @foreach([1, 2, 3] as $banner)

                <div
                    class="hero-slide-mobile absolute inset-0 opacity-0 transition-opacity duration-700"
                >

                    <img
                        src="{{ asset('images/banner' . $banner . '.png') }}"
                        alt="Apna Local Bazaar Banner {{ $banner }}"
                        class="h-full w-full object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/70 via-slate-950/20 to-transparent"></div>


                    <div class="absolute inset-0 flex items-center px-5">

                        <div class="max-w-[75%] text-white">

                            <span class="inline-flex rounded-full bg-white/15 px-2.5 py-1 text-[10px] font-bold backdrop-blur">
                                Shop Local
                            </span>

                            <h1 class="mt-3 text-2xl font-black leading-tight">
                                Fresh Products.
                                <br>
                                Local Delivery.
                            </h1>

                            <p class="mt-3 text-xs leading-5 text-white/80">
                                Quality products from trusted local shops.
                            </p>

                            <a
                                href="#mobileProducts"
                                class="mt-4 inline-flex rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-black text-white"
                            >
                                Shop Now →
                            </a>

                        </div>

                    </div>

                </div>

            @endforeach


            <button
                id="prevSlideMobile"
                type="button"
                class="absolute left-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur"
            >
                ‹
            </button>


            <button
                id="nextSlideMobile"
                type="button"
                class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-full bg-white/20 text-white backdrop-blur"
            >
                ›
            </button>


            <div class="absolute bottom-4 left-1/2 flex -translate-x-1/2 items-center gap-2">

                @foreach([1, 2, 3] as $dot)

                    <button
                        type="button"
                        class="mobile-slider-dot h-2 rounded-full bg-white/70 transition-all"
                    ></button>

                @endforeach

            </div>

        </div>

    </section>



    {{-- =====================================================
        MOBILE CATEGORIES
    ====================================================== --}}

    <section
        id="mobileCategories"
        class="mt-5 lg:hidden"
    >

        <div class="mb-3 flex items-center justify-between">

            <h2 class="text-sm font-black">
                Categories
            </h2>

            <span class="text-xs font-semibold text-emerald-600">
                Explore
            </span>

        </div>


        <div class="flex gap-3 overflow-x-auto pb-2">

            @foreach($categoryOrder as $slug => [$icon, $label])

                @php
                    $category = $categoryMap->get($slug);
                @endphp

                @if($category)

                    <a
                        href="{{ route('category.show', $category->slug) }}"
                        class="flex min-w-[92px] shrink-0 flex-col items-center rounded-2xl border border-slate-200 bg-white p-3 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50"
                    >

                        <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl">
                            {{ $icon }}
                        </span>

                        <span class="mt-2 text-center text-[11px] font-bold text-slate-700">
                            {{ $label }}
                        </span>

                    </a>

                @endif

            @endforeach

        </div>

    </section>



    {{-- =====================================================
        MOBILE CATEGORY FILTERS
    ====================================================== --}}

    <section
        id="mobileCategoryFilters"
        class="mt-5 lg:hidden"
    >

        <div class="flex gap-2 overflow-x-auto pb-1">

            @foreach([
                '' => 'All',
                'burger' => 'Burgers',
                'pizza' => 'Pizza',
                'roll' => 'Rolls',
                'momos' => 'Snacks',
                'drink' => 'Drinks',
            ] as $filter => $label)

                <button
                    type="button"
                    class="category-chip shrink-0 rounded-full border px-4 py-2 text-xs font-bold transition
                    {{ $filter === '' 
                        ? 'border-emerald-600 bg-emerald-600 text-white shadow-sm'
                        : 'border-slate-200 bg-white text-slate-700' }}"
                    data-mobile-category="{{ $filter }}"
                >
                    {{ $label }}
                </button>

            @endforeach

        </div>

    </section>



    {{-- =====================================================
        MOBILE LOCAL SHOPS
    ====================================================== --}}

    <section class="mt-7 lg:hidden">

        <div class="mb-3 flex items-center justify-between">

            <div>
                <h2 class="text-lg font-black">
                    Local Shops
                </h2>

                <p class="mt-0.5 text-xs text-slate-500">
                    Shops near you
                </p>
            </div>

        </div>


        <div class="flex gap-3 overflow-x-auto pb-2">

            @forelse($vendors as $vendor)

                <div class="min-w-[220px] shrink-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                    <div class="relative h-28 bg-slate-100">

                        <img
                            src="{{ $vendor->image ? asset($vendor->image) : asset('images/shop-placeholder.png') }}"
                            alt="{{ $vendor->shop_name }}"
                            class="h-full w-full object-cover"
                            onerror="this.onerror=null;this.src='{{ asset('images/shop-placeholder.png') }}';"
                        >

                        <span class="absolute left-3 top-3 rounded-full bg-white/90 px-2 py-1 text-[10px] font-black text-emerald-700 shadow-sm">
                            Local Shop
                        </span>

                    </div>


                    <div class="p-3">

                        <h3 class="truncate text-sm font-black text-slate-800">
                            {{ $vendor->shop_name }}
                        </h3>

                        <p class="mt-1 truncate text-xs text-slate-500">
                            📍 {{ $vendor->city ?: 'Nearby' }}
                        </p>

                        <div class="mt-2 flex items-center justify-between">

                            <span class="text-xs font-bold text-amber-500">
                                ★ 4.5
                            </span>

                            <span class="text-[10px] font-semibold text-emerald-600">
                                Local delivery available
                            </span>

                        </div>

                    </div>

                </div>

            @empty

                <div class="w-full rounded-2xl border border-dashed border-slate-300 bg-white p-6 text-center">

                    <div class="text-2xl">
                        🏪
                    </div>

                    <p class="mt-2 text-sm font-bold text-slate-700">
                        No nearby shops found
                    </p>

                </div>

            @endforelse

        </div>

    </section>



    {{-- =====================================================
        DESKTOP FEATURE STRIP
    ====================================================== --}}

    <section class="mt-8 hidden grid-cols-4 overflow-hidden rounded-2xl border border-slate-200 bg-white lg:grid">

        <div class="flex items-center gap-3 border-r border-slate-100 p-5">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-xl">
                🚚
            </div>

            <div>
                <h3 class="text-sm font-black">
                    Fast Delivery
                </h3>

                <p class="mt-0.5 text-xs text-slate-500">
                    Quick local delivery
                </p>
            </div>

        </div>


        <div class="flex items-center gap-3 border-r border-slate-100 p-5">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-xl">
                💵
            </div>

            <div>
                <h3 class="text-sm font-black">
                    Cash on Delivery
                </h3>

                <p class="mt-0.5 text-xs text-slate-500">
                    Pay when delivered
                </p>
            </div>

        </div>


        <div class="flex items-center gap-3 border-r border-slate-100 p-5">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-amber-50 text-xl">
                ⭐
            </div>

            <div>
                <h3 class="text-sm font-black">
                    Best Quality
                </h3>

                <p class="mt-0.5 text-xs text-slate-500">
                    Trusted local products
                </p>
            </div>

        </div>


        <div class="flex items-center gap-3 p-5">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-purple-50 text-xl">
                🏪
            </div>

            <div>
                <h3 class="text-sm font-black">
                    Local Shops
                </h3>

                <p class="mt-0.5 text-xs text-slate-500">
                    Support local business
                </p>
            </div>

        </div>

    </section>



    {{-- =====================================================
        DESKTOP PRODUCTS
    ====================================================== --}}

    <section
        id="desktopProducts"
        class="mt-12 hidden scroll-mt-28 lg:block"
    >

        <div class="flex items-center justify-between rounded-2xl border border-emerald-100 bg-emerald-50 p-4">

            <div class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white text-xl shadow-sm">
                    🎁
                </div>

                <div>

                    <p class="text-xs font-black uppercase tracking-wider text-emerald-600">
                        Special Offer
                    </p>

                    <h3 class="mt-0.5 text-sm font-black text-slate-900">
                        First Order Discount Available
                    </h3>

                </div>

            </div>


            <span class="hidden rounded-full bg-white px-3 py-1.5 text-xs font-black text-emerald-700 shadow-sm sm:inline-flex">
                Shop Now →
            </span>

        </div>


        <div class="mt-8 flex items-end justify-between gap-4">

            <div>

                <p class="text-xs font-bold uppercase tracking-wider text-emerald-600">
                    Discover Products
                </p>

                <h2 class="mt-1 text-2xl font-black tracking-tight text-slate-900">
                    Popular Products
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Quality products from local shops near you.
                </p>

            </div>


            <button
                id="desktopResetProducts"
                type="button"
                class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-slate-600 transition hover:border-emerald-300 hover:text-emerald-700"
            >
                Reset Filters
            </button>

        </div>


        <div
            id="desktopSearchMessage"
            class="mt-3 hidden rounded-xl bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700"
        ></div>


        <div
            id="desktopCategoryMessage"
            class="mt-2 hidden rounded-xl bg-slate-100 px-4 py-3 text-sm font-semibold text-slate-600"
        ></div>


        <div
            id="desktopProductGrid"
            class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 xl:grid-cols-5"
        >

            @forelse($products as $product)

                @php

                    $hasDiscount =
                        $product->discount_price &&
                        $product->discount_price < $product->price;

                    $discountPercent =
                        $hasDiscount
                            ? round(
                                (($product->price - $product->discount_price)
                                / $product->price) * 100
                            )
                            : 0;

                    /*
                    |--------------------------------------------------------------------------
                    | Rating UI
                    |--------------------------------------------------------------------------
                    */

                    $rating = $product->rating ?? 4.5;

                    $reviews = $product->reviews_count ?? 0;

                    $rating = max(0, min(5, (float) $rating));

                @endphp


                <article
                    class="product-card group flex min-h-[455px] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-xl"
                    data-name="{{ strtolower($product->name) }}"
                    data-category="{{ strtolower($product->category?->name ?? '') }}"
                >


                    {{-- Product Image --}}
                    <div class="relative h-56 overflow-hidden bg-slate-50">

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block h-full"
                        >

                            <img
                                src="{{ $product->image ? asset($product->image) : asset('images/products/product-placeholder.png') }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-contain p-5 transition duration-500 group-hover:scale-105"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                            >

                        </a>


                        @if($hasDiscount)

                            <span class="absolute left-3 top-3 rounded-full bg-red-500 px-2.5 py-1 text-[10px] font-black text-white shadow-sm">
                                {{ $discountPercent }}% OFF
                            </span>

                        @endif


                        <button
                            type="button"
                            class="absolute right-3 top-3 flex h-9 w-9 items-center justify-center rounded-full border border-white/80 bg-white/90 text-slate-500 shadow-sm backdrop-blur transition hover:scale-105 hover:text-red-500"
                            aria-label="Add to wishlist"
                        >
                            ♡
                        </button>


                        {{-- Floating Rating --}}
                        <div class="absolute bottom-3 left-3 flex items-center gap-1 rounded-full bg-white/95 px-2.5 py-1.5 shadow-md backdrop-blur">

                            <span class="text-xs text-amber-400">
                                ★
                            </span>

                            <span class="text-[11px] font-black text-slate-800">
                                {{ number_format($rating, 1) }}
                            </span>

                        </div>

                    </div>



                    {{-- Product Content --}}
                    <div class="flex flex-1 flex-col px-4 pb-4 pt-3">

                        <div class="flex-1">


                            {{-- Category + Rating --}}
                            <div class="flex items-center justify-between gap-2">

                                <span class="max-w-[55%] truncate rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black text-emerald-700">
                                    {{ $product->category?->name ?? 'Local Product' }}
                                </span>


                                <div class="flex shrink-0 items-center gap-1">

                                    <span class="text-[11px] tracking-tight text-amber-400">
                                        ★★★★★
                                    </span>

                                    <span class="text-[10px] font-bold text-slate-700">
                                        {{ number_format($rating, 1) }}
                                    </span>

                                    <span class="text-[10px] text-slate-400">
                                        ({{ $reviews }})
                                    </span>

                                </div>

                            </div>



                            {{-- Product Name --}}
                            <a
                                href="{{ route('product.show', $product->slug) }}"
                                class="mt-2 block min-h-[42px] text-sm font-black leading-5 text-slate-900 transition hover:text-emerald-700"
                            >
                                {{ $product->name }}
                            </a>



                            {{-- Product Description --}}
                            @if(!empty($product->description))

                                <p class="mt-2 min-h-[40px] line-clamp-2 text-xs leading-5 text-slate-500">
                                    {{ $product->description }}
                                </p>

                            @else

                                <p class="mt-2 min-h-[40px] text-xs leading-5 text-slate-400">
                                    Quality local product available for quick delivery.
                                </p>

                            @endif



                            {{-- Stock --}}
                            <div class="mt-3 flex items-center gap-1.5 text-xs font-semibold text-slate-500">

                                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                <span>
                                    In Stock
                                </span>

                            </div>

                        </div>



                        {{-- Price --}}
                        <div class="mt-4 flex items-end justify-between gap-3">

                            <div>

                                <div class="flex items-baseline gap-2">

                                    <span class="text-lg font-black text-slate-900">
                                        ₹{{ number_format($hasDiscount ? $product->discount_price : $product->price, 2) }}
                                    </span>

                                    @if($hasDiscount)

                                        <span class="text-xs font-semibold text-slate-400 line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>

                                    @endif

                                </div>

                                @if($hasDiscount)

                                    <p class="mt-0.5 text-[10px] font-bold text-emerald-600">
                                        You save ₹{{ number_format($product->price - $product->discount_price, 2) }}
                                    </p>

                                @else

                                    <p class="mt-0.5 text-[10px] text-slate-400">
                                        Inclusive local pricing
                                    </p>

                                @endif

                            </div>


                            @auth

                                <form
                                    action="{{ route('cart.add') }}"
                                    method="POST"
                                    class="home-cart-form"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $hasDiscount ? $product->discount_price : $product->price }}"
                                    data-product-image="{{ $product->image ? asset($product->image) : asset('images/products/product-placeholder.png') }}"
                                >

                                    @csrf

                                    <button
                                        type="submit"
                                        class="flex h-10 items-center justify-center gap-1.5 rounded-xl bg-emerald-600 px-3 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700 hover:shadow-md"
                                    >

                                        <span class="text-sm">
                                            +
                                        </span>

                                        <span class="add-cart-text">
                                            Add to Cart
                                        </span>

                                    </button>

                                </form>

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="flex h-10 items-center justify-center rounded-xl bg-emerald-600 px-3 text-xs font-black text-white transition hover:bg-emerald-700"
                                >
                                    Login to Buy
                                </a>

                            @endauth

                        </div>

                    </div>

                </article>

            @empty

                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center">

                    <div class="text-4xl">
                        🛒
                    </div>

                    <h3 class="mt-3 text-base font-black text-slate-800">
                        No products available
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Products from local shops will appear here.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Desktop Search Empty State --}}
        <div
            id="desktopNoSearchResults"
            class="mt-5 hidden rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center"
        >

            <div class="text-4xl">
                🔍
            </div>

            <h3 class="mt-3 text-base font-black text-slate-800">
                No products found
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                Try another product name or category.
            </p>

        </div>

    </section>
    {{-- =====================================================
        MOBILE PRODUCTS
    ====================================================== --}}

    <section
        id="mobileProducts"
        class="mt-8 scroll-mt-24 lg:hidden"
    >

        <div class="flex items-end justify-between gap-3">

            <div>

                <p class="text-[10px] font-black uppercase tracking-wider text-emerald-600">
                    Nearby Products
                </p>

                <h2 class="mt-1 text-xl font-black tracking-tight text-slate-900">
                    Popular Products
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Fresh products from local shops.
                </p>

            </div>


            <button
                id="mobileResetProducts"
                type="button"
                class="hidden rounded-xl border border-slate-200 bg-white px-3 py-2 text-[10px] font-black text-slate-600 shadow-sm"
            >
                Reset
            </button>

        </div>


        <div
            id="mobileSearchMessage"
            class="mt-3 hidden rounded-xl bg-emerald-50 px-3 py-2.5 text-xs font-bold text-emerald-700"
        ></div>


        <div
            id="mobileCategoryProductMessage"
            class="mt-2 hidden rounded-xl bg-slate-100 px-3 py-2.5 text-xs font-bold text-slate-600"
        ></div>


        <div
            id="mobileProductGrid"
            class="mt-4 grid grid-cols-2 gap-3"
        >

            @forelse($products as $index => $product)

                @php

                    $hasDiscount =
                        $product->discount_price &&
                        $product->discount_price < $product->price;

                    $discountPercent =
                        $hasDiscount
                            ? round(
                                (($product->price - $product->discount_price)
                                / $product->price) * 100
                            )
                            : 0;

                    /*
                    |--------------------------------------------------------------------------
                    | Rating
                    |--------------------------------------------------------------------------
                    */

                    $rating = $product->rating ?? 4.5;

                    $reviews = $product->reviews_count ?? 0;

                    $rating = max(0, min(5, (float) $rating));

                @endphp


                <article
                    class="product-card-mobile group flex min-h-[430px] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 active:scale-[0.99]"
                    data-name="{{ strtolower($product->name) }}"
                    data-category="{{ strtolower($product->category?->name ?? '') }}"
                >


                    {{-- Product Image --}}
                    <div class="relative h-44 overflow-hidden bg-slate-50">

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block h-full"
                        >

                            <img
                                src="{{ $product->image ? asset($product->image) : asset('images/products/product-placeholder.png') }}"
                                alt="{{ $product->name }}"
                                class="h-full w-full object-contain p-4 transition duration-500 group-hover:scale-105"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                            >

                        </a>


                        {{-- Bestseller --}}
                        @if($index === 0)

                            <span class="absolute left-2.5 top-2.5 rounded-full bg-amber-400 px-2 py-1 text-[9px] font-black text-slate-900 shadow-sm">
                                🔥 Bestseller
                            </span>

                        @elseif($hasDiscount)

                            <span class="absolute left-2.5 top-2.5 rounded-full bg-red-500 px-2 py-1 text-[9px] font-black text-white shadow-sm">
                                {{ $discountPercent }}% OFF
                            </span>

                        @endif


                        {{-- Wishlist --}}
                        <button
                            type="button"
                            class="absolute right-2.5 top-2.5 flex h-8 w-8 items-center justify-center rounded-full border border-white/80 bg-white/90 text-sm text-slate-500 shadow-sm backdrop-blur transition hover:text-red-500"
                            aria-label="Add to wishlist"
                        >
                            ♡
                        </button>


                        {{-- Rating Badge --}}
                        <div class="absolute bottom-2.5 left-2.5 flex items-center gap-1 rounded-full bg-white/95 px-2 py-1 shadow-md">

                            <span class="text-[10px] text-amber-400">
                                ★
                            </span>

                            <span class="text-[10px] font-black text-slate-800">
                                {{ number_format($rating, 1) }}
                            </span>

                        </div>

                    </div>



                    {{-- Product Content --}}
                    <div class="flex flex-1 flex-col p-3">

                        <div class="flex-1">


                            {{-- Category --}}
                            <div class="flex items-center justify-between gap-2">

                                <span class="max-w-[65%] truncate rounded-full bg-emerald-50 px-2 py-1 text-[9px] font-black text-emerald-700">
                                    {{ $product->category?->name ?? 'Local Product' }}
                                </span>

                                <span class="shrink-0 text-[9px] font-semibold text-slate-400">
                                    Local
                                </span>

                            </div>



                            {{-- Product Name --}}
                            <a
                                href="{{ route('product.show', $product->slug) }}"
                                class="mt-2 block min-h-[38px] text-sm font-black leading-[19px] text-slate-900 transition hover:text-emerald-700"
                            >
                                {{ $product->name }}
                            </a>



                            {{-- Rating + Reviews --}}
                            <div class="mt-1.5 flex items-center gap-1.5">

                                <span class="text-[11px] tracking-tight text-amber-400">
                                    ★★★★★
                                </span>

                                <span class="text-[10px] font-black text-slate-700">
                                    {{ number_format($rating, 1) }}
                                </span>

                                <span class="text-[10px] text-slate-400">
                                    ({{ $reviews }})
                                </span>

                            </div>



                            {{-- Description --}}
                            @if(!empty($product->description))

                                <p class="mt-2 min-h-[36px] line-clamp-2 text-[11px] leading-[18px] text-slate-500">
                                    {{ $product->description }}
                                </p>

                            @else

                                <p class="mt-2 min-h-[36px] text-[11px] leading-[18px] text-slate-400">
                                    Quality local product available for quick delivery.
                                </p>

                            @endif



                            {{-- Stock --}}
                            <div class="mt-2.5 flex items-center gap-1.5">

                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                <span class="text-[10px] font-semibold text-slate-500">
                                    In Stock
                                </span>

                            </div>

                        </div>



                        {{-- Price + Cart --}}
                        <div class="mt-3 border-t border-slate-100 pt-3">

                            <div class="flex items-end justify-between gap-2">

                                <div class="min-w-0">

                                    <div class="flex flex-wrap items-baseline gap-1.5">

                                        <span class="text-base font-black text-slate-900">
                                            ₹{{ number_format($hasDiscount ? $product->discount_price : $product->price, 2) }}
                                        </span>

                                        @if($hasDiscount)

                                            <span class="text-[10px] font-semibold text-slate-400 line-through">
                                                ₹{{ number_format($product->price, 2) }}
                                            </span>

                                        @endif

                                    </div>

                                    @if($hasDiscount)

                                        <p class="mt-0.5 text-[9px] font-bold text-emerald-600">
                                            Save ₹{{ number_format($product->price - $product->discount_price, 2) }}
                                        </p>

                                    @endif

                                </div>


                                @auth

                                    <form
                                        action="{{ route('cart.add') }}"
                                        method="POST"
                                        class="home-cart-form shrink-0"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $hasDiscount ? $product->discount_price : $product->price }}"
                                        data-product-image="{{ $product->image ? asset($product->image) : asset('images/products/product-placeholder.png') }}"
                                    >

                                        @csrf

                                        <button
                                            type="submit"
                                            class="flex h-9 items-center justify-center gap-1 rounded-xl bg-emerald-600 px-3 text-[10px] font-black text-white shadow-sm transition hover:bg-emerald-700"
                                        >

                                            <span class="text-sm">
                                                +
                                            </span>

                                            <span class="add-cart-text">
                                                Add
                                            </span>

                                        </button>

                                    </form>

                                @else

                                    <a
                                        href="{{ route('login') }}"
                                        class="flex h-9 items-center justify-center rounded-xl bg-emerald-600 px-3 text-[10px] font-black text-white"
                                    >
                                        Login
                                    </a>

                                @endauth

                            </div>

                        </div>

                    </div>

                </article>

            @empty

                <div class="col-span-2 rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center">

                    <div class="text-3xl">
                        🛒
                    </div>

                    <h3 class="mt-2 text-sm font-black text-slate-800">
                        No products available
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Local products will appear here.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Mobile Search Empty State --}}
        <div
            id="mobileNoSearchResults"
            class="mt-4 hidden rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center"
        >

            <div class="text-3xl">
                🔍
            </div>

            <h3 class="mt-2 text-sm font-black text-slate-800">
                No products found
            </h3>

            <p class="mt-1 text-xs text-slate-500">
                Try another product name or category.
            </p>

            <button
                id="mobileClearSearchEmpty"
                type="button"
                class="mt-4 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-black text-white"
            >
                Clear Search
            </button>

        </div>


        <button
            id="mobileFilterReset"
            type="button"
            class="mx-auto mt-4 hidden rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-black text-slate-600 shadow-sm"
        >
            Reset Filters
        </button>

    </section>



    {{-- =====================================================
        SHOP BY CATEGORY
    ====================================================== --}}

    <section class="mt-8">

        <div class="flex items-end justify-between">

            <div>

                <p class="text-[10px] font-black uppercase tracking-wider text-emerald-600">
                    Explore More
                </p>

                <h2 class="mt-1 text-xl font-black tracking-tight text-slate-900 sm:text-2xl">
                    Shop by Category
                </h2>

                <p class="mt-1 text-xs text-slate-500 sm:text-sm">
                    Find everything you need from nearby stores.
                </p>

            </div>

        </div>


        <div class="mt-5 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-8">

            @foreach($categoryOrder as $slug => [$icon, $label])

                @php
                    $category = $categoryMap->get($slug);

                    $categoryImage = match($slug) {
                        'fast-food' => 'fast-food.png',
                        'fruits-vegetables' => 'vegetables.png',
                        'kirana' => 'grocery.png',
                        'dairy-products' => 'dairy.png',
                        'bakery' => 'bakery.png',
                        'medicines' => 'medicine.png',
                        'beverages' => 'beverages.png',
                        'household-essentials' => 'household.png',
                        default => 'grocery.png',
                    };
                @endphp


                @if($category)

                    <a
                        href="{{ route('category.show', $category->slug) }}"
                        class="group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-200 hover:shadow-lg"
                    >

                        <div class="relative h-28 overflow-hidden bg-slate-50">

                            <img
                                src="{{ asset('images/categories/' . $categoryImage) }}"
                                alt="{{ $label }}"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                            >


                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/50 via-transparent to-transparent"></div>


                            <span class="absolute bottom-2 left-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white/90 text-lg shadow-sm">
                                {{ $icon }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-2 p-3">

                            <span class="truncate text-xs font-black text-slate-800 group-hover:text-emerald-700">
                                {{ $label }}
                            </span>

                            <span class="shrink-0 text-slate-300 transition group-hover:translate-x-1 group-hover:text-emerald-500">
                                →
                            </span>

                        </div>

                    </a>

                @endif

            @endforeach

        </div>

    </section>



    {{-- =====================================================
        MOBILE FEATURES
    ====================================================== --}}

    <section class="mt-8 lg:hidden">

        <div class="grid grid-cols-2 gap-3">

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-lg">
                    🚚
                </div>

                <h3 class="mt-3 text-xs font-black text-slate-800">
                    Fast Delivery
                </h3>

                <p class="mt-1 text-[10px] leading-4 text-slate-500">
                    Quick delivery from local shops.
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-lg">
                    💵
                </div>

                <h3 class="mt-3 text-xs font-black text-slate-800">
                    Cash on Delivery
                </h3>

                <p class="mt-1 text-[10px] leading-4 text-slate-500">
                    Pay when your order arrives.
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-lg">
                    ⭐
                </div>

                <h3 class="mt-3 text-xs font-black text-slate-800">
                    Best Quality
                </h3>

                <p class="mt-1 text-[10px] leading-4 text-slate-500">
                    Products from trusted sellers.
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-purple-50 text-lg">
                    🏪
                </div>

                <h3 class="mt-3 text-xs font-black text-slate-800">
                    Local Shops
                </h3>

                <p class="mt-1 text-[10px] leading-4 text-slate-500">
                    Support businesses near you.
                </p>

            </div>

        </div>

    </section>



    {{-- =====================================================
        APP COMING SOON + HELP
    ====================================================== --}}

    <section class="mt-10 hidden gap-6 lg:grid lg:grid-cols-2">

        {{-- App --}}
        <div class="relative overflow-hidden rounded-3xl bg-slate-900 p-8 text-white">

            <div class="relative z-10 max-w-lg">

                <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold text-emerald-300">
                    Coming Soon
                </span>

                <h2 class="mt-4 text-3xl font-black leading-tight">
                    Apna Local Bazaar
                    <br>
                    Mobile App
                </h2>

                <p class="mt-3 text-sm leading-6 text-white/70">
                    Shop from your favourite local stores even faster with our upcoming mobile application.
                </p>


                <div class="mt-6 flex gap-3">

                    <div class="flex items-center gap-2 rounded-xl bg-white/10 px-4 py-3">

                        <span class="text-xl">
                            ▶
                        </span>

                        <div>

                            <p class="text-[9px] uppercase tracking-wide text-white/50">
                                Coming soon on
                            </p>

                            <p class="text-xs font-black">
                                Google Play
                            </p>

                        </div>

                    </div>


                    <div class="flex items-center gap-2 rounded-xl bg-white/10 px-4 py-3">

                        <span class="text-xl">
                            
                        </span>

                        <div>

                            <p class="text-[9px] uppercase tracking-wide text-white/50">
                                Coming soon on
                            </p>

                            <p class="text-xs font-black">
                                App Store
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-emerald-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-10 h-64 w-64 rounded-full bg-blue-500/10 blur-3xl"></div>

        </div>



        {{-- Help --}}
        <div class="rounded-3xl border border-slate-200 bg-white p-8">

            <span class="text-xs font-black uppercase tracking-wider text-emerald-600">
                Need Help?
            </span>

            <h2 class="mt-2 text-2xl font-black text-slate-900">
                We're here for you.
            </h2>

            <p class="mt-2 max-w-lg text-sm leading-6 text-slate-500">
                Have a question about an order, product or delivery? Our support team is ready to help.
            </p>


            <div class="mt-6 grid grid-cols-2 gap-3">

                <a
                    href="#"
                    class="rounded-2xl border border-slate-200 p-4 transition hover:border-emerald-200 hover:bg-emerald-50"
                >

                    <div class="text-xl">
                        💬
                    </div>

                    <h3 class="mt-2 text-sm font-black">
                        Contact Support
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Get assistance
                    </p>

                </a>


                <a
                    href="#"
                    class="rounded-2xl border border-slate-200 p-4 transition hover:border-emerald-200 hover:bg-emerald-50"
                >

                    <div class="text-xl">
                        ❓
                    </div>

                    <h3 class="mt-2 text-sm font-black">
                        FAQs
                    </h3>

                    <p class="mt-1 text-xs text-slate-500">
                        Find answers
                    </p>

                </a>

            </div>

        </div>

    </section>



    {{-- =====================================================
        WHY SHOP WITH US
    ====================================================== --}}

    <section class="mt-10 hidden lg:block">

        <div class="text-center">

            <p class="text-xs font-black uppercase tracking-wider text-emerald-600">
                Why Choose Us
            </p>

            <h2 class="mt-2 text-2xl font-black text-slate-900">
                Why Shop With Us?
            </h2>

            <p class="mx-auto mt-2 max-w-2xl text-sm text-slate-500">
                A simple and convenient way to support local businesses while getting quality products delivered to you.
            </p>

        </div>


        <div class="mt-7 grid grid-cols-3 gap-5">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-emerald-50 text-2xl">
                    🏪
                </div>

                <h3 class="mt-4 text-base font-black">
                    Local & Trusted
                </h3>

                <p class="mt-2 text-xs leading-5 text-slate-500">
                    Discover products from nearby shops and local sellers.
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-2xl">
                    🚚
                </div>

                <h3 class="mt-4 text-base font-black">
                    Convenient Delivery
                </h3>

                <p class="mt-2 text-xs leading-5 text-slate-500">
                    Get your everyday essentials delivered right to your doorstep.
                </p>

            </div>


            <div class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-amber-50 text-2xl">
                    ❤️
                </div>

                <h3 class="mt-4 text-base font-black">
                    Support Local
                </h3>

                <p class="mt-2 text-xs leading-5 text-slate-500">
                    Every purchase helps local shops and businesses grow.
                </p>

            </div>

        </div>

    </section>

    {{-- =====================================================
        HOME QUICK CART
    ====================================================== --}}

    @auth

        <div
            id="homeQuickCart"
            class="fixed bottom-5 left-1/2 z-40 hidden w-[calc(100%-2rem)] max-w-4xl -translate-x-1/2 lg:bottom-6"
        >

            <div class="rounded-2xl border border-slate-200 bg-white/95 p-3 shadow-2xl backdrop-blur">

                <div class="flex items-center gap-3">

                    {{-- Products --}}
                    <div
                        id="homeQuickCartProducts"
                        class="flex min-w-0 flex-1 gap-2 overflow-x-auto"
                    ></div>


                    {{-- Cart Summary --}}
                    <div class="flex shrink-0 items-center gap-3 border-l border-slate-200 pl-3">

                        <div class="hidden text-right sm:block">

                            <p
                                id="homeQuickCartCount"
                                class="text-xs font-black text-slate-800"
                            >
                                0 items
                            </p>

                            <p class="mt-0.5 text-[10px] text-slate-400">
                                Quick Cart
                            </p>

                        </div>


                        <div class="text-right">

                            <p
                                id="homeQuickCartTotal"
                                class="text-sm font-black text-slate-900"
                            >
                                ₹0.00
                            </p>

                            <a
                                href="{{ route('cart.index') }}"
                                class="mt-1 inline-flex text-[10px] font-black text-emerald-600 hover:text-emerald-700"
                            >
                                View Cart →
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    @endauth



    {{-- =====================================================
        FOOTER
    ====================================================== --}}

    <footer class="mt-12 overflow-hidden rounded-3xl bg-slate-950 text-white">

        <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[1.5fr_1fr_1fr_1fr] lg:p-10">

            {{-- Brand --}}
            <div>

                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center gap-3"
                >

                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-xl">
                        🛍️
                    </div>

                    <div>

                        <h2 class="text-base font-black">
                            Apna Local Bazaar
                        </h2>

                        <p class="mt-0.5 text-[10px] text-slate-400">
                            Shop Local • Live Local
                        </p>

                    </div>

                </a>


                <p class="mt-4 max-w-sm text-xs leading-6 text-slate-400">
                    Your local marketplace for everyday products, trusted shops and convenient doorstep delivery.
                </p>


                <div class="mt-5 flex items-center gap-2">

                    <a
                        href="#"
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-sm transition hover:bg-emerald-600"
                        aria-label="Facebook"
                    >
                        f
                    </a>

                    <a
                        href="#"
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-sm transition hover:bg-emerald-600"
                        aria-label="Instagram"
                    >
                        ◎
                    </a>

                    <a
                        href="#"
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/5 text-sm transition hover:bg-emerald-600"
                        aria-label="Twitter"
                    >
                        𝕏
                    </a>

                </div>

            </div>


            {{-- Quick Links --}}
            <div>

                <h3 class="text-xs font-black uppercase tracking-wider text-white">
                    Quick Links
                </h3>

                <div class="mt-4 space-y-3">

                    <a
                        href="{{ route('home') }}"
                        class="block text-xs text-slate-400 transition hover:text-emerald-400"
                    >
                        Home
                    </a>

                    @auth

                        <a
                            href="{{ route('orders.index') }}"
                            class="block text-xs text-slate-400 transition hover:text-emerald-400"
                        >
                            My Orders
                        </a>

                        <a
                            href="{{ route('cart.index') }}"
                            class="block text-xs text-slate-400 transition hover:text-emerald-400"
                        >
                            My Cart
                        </a>

                    @endauth

                </div>

            </div>


            {{-- Categories --}}
            <div>

                <h3 class="text-xs font-black uppercase tracking-wider text-white">
                    Categories
                </h3>

                <div class="mt-4 space-y-3">

                    @foreach(array_slice($categoryOrder, 0, 5, true) as $slug => [$icon, $label])

                        @php
                            $category = $categoryMap->get($slug);
                        @endphp

                        @if($category)

                            <a
                                href="{{ route('category.show', $category->slug) }}"
                                class="flex items-center gap-2 text-xs text-slate-400 transition hover:text-emerald-400"
                            >
                                <span>{{ $icon }}</span>
                                <span>{{ $label }}</span>
                            </a>

                        @endif

                    @endforeach

                </div>

            </div>


            {{-- Contact --}}
            <div>

                <h3 class="text-xs font-black uppercase tracking-wider text-white">
                    Contact
                </h3>

                <div class="mt-4 space-y-4">

                    <div class="flex gap-3">

                        <span class="text-sm">
                            📍
                        </span>

                        <p class="text-xs leading-5 text-slate-400">
                            Chandigarh, Punjab
                            <br>
                            India
                        </p>

                    </div>


                    <div class="flex gap-3">

                        <span class="text-sm">
                            📧
                        </span>

                        <p class="text-xs text-slate-400">
                            support@apnalocalbazaar.com
                        </p>

                    </div>


                    <div class="flex gap-3">

                        <span class="text-sm">
                            📞
                        </span>

                        <p class="text-xs text-slate-400">
                            Customer Support
                        </p>

                    </div>

                </div>

            </div>

        </div>


        <div class="border-t border-white/10 px-6 py-5 sm:px-8 lg:px-10">

            <div class="flex flex-col gap-2 text-center sm:flex-row sm:items-center sm:justify-between sm:text-left">

                <p class="text-[10px] text-slate-500">
                    © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
                </p>

                <p class="text-[10px] text-slate-500">
                    Made with ❤️ for local businesses.
                </p>

            </div>

        </div>

    </footer>

</main>



{{-- =========================================================
    MOBILE BOTTOM NAVIGATION
========================================================= --}}

<nav class="fixed bottom-0 left-0 right-0 z-50 border-t border-slate-200 bg-white/95 px-3 py-2 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] backdrop-blur lg:hidden">

    <div class="mx-auto flex max-w-md items-center justify-around">

        <a
            href="{{ route('home') }}"
            class="flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-emerald-600"
        >

            <span class="text-lg">
                🏠
            </span>

            <span class="text-[9px] font-black">
                Home
            </span>

        </a>


        <button
            type="button"
            onclick="document.getElementById('mobileCategories')?.scrollIntoView({behavior:'smooth',block:'start'})"
            class="flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-slate-500"
        >

            <span class="text-lg">
                🗂️
            </span>

            <span class="text-[9px] font-black">
                Categories
            </span>

        </button>


        <button
            type="button"
            onclick="document.getElementById('mobileProducts')?.scrollIntoView({behavior:'smooth',block:'start'})"
            class="flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-slate-500"
        >

            <span class="text-lg">
                🛍️
            </span>

            <span class="text-[9px] font-black">
                Products
            </span>

        </button>


        <a
            href="{{ route('cart.index') }}"
            class="relative flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-slate-500"
        >

            <span class="relative text-lg">

                🛒

                <span
                    id="mobileCartCount"
                    class="absolute -right-3 -top-2 flex min-h-4 min-w-4 items-center justify-center rounded-full bg-emerald-600 px-1 text-[8px] font-black text-white"
                >
                    {{ $cartCount }}
                </span>

            </span>

            <span class="text-[9px] font-black">
                Cart
            </span>

        </a>


        @auth

            <a
                href="{{ route('orders.index') }}"
                class="flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-slate-500"
            >

                <span class="text-lg">
                    📦
                </span>

                <span class="text-[9px] font-black">
                    Orders
                </span>

            </a>

        @else

            <a
                href="{{ route('login') }}"
                class="flex min-w-[58px] flex-col items-center gap-1 rounded-xl px-3 py-1.5 text-slate-500"
            >

                <span class="text-lg">
                    👤
                </span>

                <span class="text-[9px] font-black">
                    Login
                </span>

            </a>

        @endauth

    </div>

</nav>



<div class="h-20 lg:hidden"></div>



<script>

document.addEventListener('DOMContentLoaded', () => {


    /* =====================================================
       CUSTOMER LOCATION
    ===================================================== */

    const locationButtons = document.querySelectorAll(
        '.customer-location-button'
    );


    const saveCustomerLocation = async (latitude, longitude) => {

        try {

            const response = await fetch(
                '{{ route('customer.location.store') }}',
                {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },

                    body: JSON.stringify({
                        latitude,
                        longitude,
                    }),
                }
            );


            const data = await response.json();


            if (!response.ok || !data.success) {
                throw new Error('Unable to save location.');
            }


            window.location.reload();


        } catch (error) {

            console.error(error);

            alert(
                'Location save nahi ho saki. Please dobara try karo.'
            );

        }

    };


    locationButtons.forEach((button) => {

        button.addEventListener('click', () => {

            @guest

                window.location.href = '{{ route('login') }}';

                return;

            @endguest


            if (!navigator.geolocation) {

                alert(
                    'Your browser does not support location services.'
                );

                return;

            }


            const textElement =
                button.querySelector(
                    '#desktopLocationText, #mobileLocationText'
                );


            if (textElement) {

                textElement.textContent =
                    'Getting location...';

            }


            button.disabled = true;


            button.classList.add(
                'cursor-not-allowed',
                'opacity-70'
            );


            navigator.geolocation.getCurrentPosition(

                async (position) => {

                    const latitude =
                        Number(
                            position.coords.latitude
                        );

                    const longitude =
                        Number(
                            position.coords.longitude
                        );


                    await saveCustomerLocation(
                        latitude,
                        longitude
                    );

                },


                (error) => {

                    console.error(error);


                    button.disabled = false;


                    button.classList.remove(
                        'cursor-not-allowed',
                        'opacity-70'
                    );


                    if (textElement) {

                        textElement.textContent =
                            'Select Location';

                    }


                    if (error.code === 1) {

                        alert(
                            'Location permission denied. Browser settings me location Allow karo.'
                        );

                    } else if (error.code === 2) {

                        alert(
                            'Location detect nahi ho saki. Please dobara try karo.'
                        );

                    } else if (error.code === 3) {

                        alert(
                            'Location request timeout ho gayi. Please dobara try karo.'
                        );

                    } else {

                        alert(
                            'Unable to detect your location.'
                        );

                    }

                },


                {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }

            );

        });

    });



    /* =====================================================
       MOBILE MENU
    ===================================================== */

    const mobileMenu =
        document.getElementById('mobileMenu');


    const mobileMenuButton =
        document.getElementById('mobileMenuButton');


    const closeMobileMenu =
        document.getElementById('closeMobileMenu');


    const mobileMenuOverlay =
        document.getElementById('mobileMenuOverlay');


    const openMobileMenu = () => {

        mobileMenu?.classList.remove('hidden');

        document.body.classList.add('overflow-hidden');

    };


    const hideMobileMenu = () => {

        mobileMenu?.classList.add('hidden');

        document.body.classList.remove('overflow-hidden');

    };


    mobileMenuButton?.addEventListener(
        'click',
        openMobileMenu
    );


    closeMobileMenu?.addEventListener(
        'click',
        hideMobileMenu
    );


    mobileMenuOverlay?.addEventListener(
        'click',
        hideMobileMenu
    );



    /* =====================================================
       DESKTOP HERO SLIDER
    ===================================================== */

    const createDesktopSlider = () => {

        const slides =
            document.querySelectorAll(
                '.hero-slide-desktop'
            );


        const dots =
            document.querySelectorAll(
                '.desktop-slider-dot'
            );


        const previous =
            document.getElementById(
                'prevSlideDesktop'
            );


        const next =
            document.getElementById(
                'nextSlideDesktop'
            );


        if (!slides.length) {
            return;
        }


        let current = 0;

        let timer;


        const showSlide = (index) => {

            current =
                (index + slides.length) %
                slides.length;


            slides.forEach((slide, i) => {

                slide.classList.toggle(
                    'opacity-100',
                    i === current
                );

                slide.classList.toggle(
                    'opacity-0',
                    i !== current
                );

            });


            dots.forEach((dot, i) => {

                dot.classList.toggle(
                    'w-7',
                    i === current
                );

                dot.classList.toggle(
                    'w-2',
                    i !== current
                );

                dot.classList.toggle(
                    'bg-emerald-600',
                    i === current
                );

                dot.classList.toggle(
                    'bg-white/70',
                    i !== current
                );

            });

        };


        const restart = () => {

            clearInterval(timer);


            timer = setInterval(() => {

                showSlide(current + 1);

            }, 4500);

        };


        previous?.addEventListener(
            'click',
            () => {

                showSlide(current - 1);

                restart();

            }
        );


        next?.addEventListener(
            'click',
            () => {

                showSlide(current + 1);

                restart();

            }
        );


        dots.forEach((dot, index) => {

            dot.addEventListener(
                'click',
                () => {

                    showSlide(index);

                    restart();

                }
            );

        });


        showSlide(0);

        restart();

    };



    /* =====================================================
       MOBILE HERO SLIDER
    ===================================================== */

    const createMobileSlider = () => {

        const slides =
            document.querySelectorAll(
                '.hero-slide-mobile'
            );


        const dots =
            document.querySelectorAll(
                '.mobile-slider-dot'
            );


        const previous =
            document.getElementById(
                'prevSlideMobile'
            );


        const next =
            document.getElementById(
                'nextSlideMobile'
            );


        if (!slides.length) {
            return;
        }


        let current = 0;

        let timer;


        const showSlide = (index) => {

            current =
                (index + slides.length) %
                slides.length;


            slides.forEach((slide, i) => {

                slide.classList.toggle(
                    'opacity-100',
                    i === current
                );

                slide.classList.toggle(
                    'opacity-0',
                    i !== current
                );

            });


            dots.forEach((dot, i) => {

                dot.classList.toggle(
                    'w-7',
                    i === current
                );

                dot.classList.toggle(
                    'w-2',
                    i !== current
                );

                dot.classList.toggle(
                    'bg-emerald-600',
                    i === current
                );

                dot.classList.toggle(
                    'bg-white/70',
                    i !== current
                );

            });

        };


        const restart = () => {

            clearInterval(timer);


            timer = setInterval(() => {

                showSlide(current + 1);

            }, 4500);

        };


        previous?.addEventListener(
            'click',
            () => {

                showSlide(current - 1);

                restart();

            }
        );


        next?.addEventListener(
            'click',
            () => {

                showSlide(current + 1);

                restart();

            }
        );


        dots.forEach((dot, index) => {

            dot.addEventListener(
                'click',
                () => {

                    showSlide(index);

                    restart();

                }
            );

        });


        showSlide(0);

        restart();

    };


    createDesktopSlider();

    createMobileSlider();



    /* =====================================================
       PRODUCT SEARCH + FILTER
    ===================================================== */

    const desktopSearch =
        document.getElementById(
            'desktopProductSearch'
        );


    const mobileSearch =
        document.getElementById(
            'mobileProductSearch'
        );


    const desktopSearchButton =
        document.getElementById(
            'desktopSearchButton'
        );


    const mobileSearchButton =
        document.getElementById(
            'mobileSearchButton'
        );


    const desktopProducts = [
        ...document.querySelectorAll(
            '#desktopProductGrid .product-card'
        )
    ];


    const mobileProducts = [
        ...document.querySelectorAll(
            '#mobileProductGrid .product-card-mobile'
        )
    ];


    const desktopMessage =
        document.getElementById(
            'desktopSearchMessage'
        );


    const mobileMessage =
        document.getElementById(
            'mobileSearchMessage'
        );


    const desktopCategoryMessage =
        document.getElementById(
            'desktopCategoryMessage'
        );


    const mobileCategoryMessage =
        document.getElementById(
            'mobileCategoryProductMessage'
        );


    const desktopReset =
        document.getElementById(
            'desktopResetProducts'
        );


    const mobileReset =
        document.getElementById(
            'mobileResetProducts'
        );


    const mobileEmpty =
        document.getElementById(
            'mobileNoSearchResults'
        );


    const mobileClearEmpty =
        document.getElementById(
            'mobileClearSearchEmpty'
        );


    const mobileFilterReset =
        document.getElementById(
            'mobileFilterReset'
        );


    const chips =
        document.querySelectorAll(
            '.category-chip'
        );


    let currentSearch = '';

    let currentCategory = '';



    const syncSearchInputs = (value) => {

        if (desktopSearch) {
            desktopSearch.value = value;
        }


        if (mobileSearch) {
            mobileSearch.value = value;
        }

    };



    const matchesProduct = (card) => {

        const name =
            (card.dataset.name || '').toLowerCase();


        const category =
            (card.dataset.category || '').toLowerCase();


        const searchMatches =
            !currentSearch ||
            name.includes(currentSearch) ||
            category.includes(currentSearch);


        const categoryMatches =
            !currentCategory ||
            name.includes(currentCategory) ||
            category.includes(currentCategory);


        return searchMatches && categoryMatches;

    };



    const applyFilters = () => {

        let desktopCount = 0;

        let mobileCount = 0;


        desktopProducts.forEach((card) => {

            const matches =
                matchesProduct(card);


            card.classList.toggle(
                'hidden',
                !matches
            );


            if (matches) {
                desktopCount++;
            }

        });


        mobileProducts.forEach((card) => {

            const matches =
                matchesProduct(card);


            card.classList.toggle(
                'hidden',
                !matches
            );


            if (matches) {
                mobileCount++;
            }

        });



        if (desktopMessage) {

            if (currentSearch) {

                desktopMessage.classList.remove(
                    'hidden'
                );


                desktopMessage.textContent =
                    desktopCount === 0
                        ? `No products found for "${currentSearch}"`
                        : `${desktopCount} product${desktopCount > 1 ? 's' : ''} found`;

            } else {

                desktopMessage.classList.add(
                    'hidden'
                );

            }

        }



        if (mobileMessage) {

            if (currentSearch) {

                mobileMessage.classList.remove(
                    'hidden'
                );


                mobileMessage.textContent =
                    mobileCount === 0
                        ? `No products found for "${currentSearch}"`
                        : `${mobileCount} product${mobileCount > 1 ? 's' : ''} found`;

            } else {

                mobileMessage.classList.add(
                    'hidden'
                );

            }

        }



        if (currentCategory) {

            const label =
                currentCategory.charAt(0).toUpperCase() +
                currentCategory.slice(1);


            desktopCategoryMessage?.classList.remove(
                'hidden'
            );


            if (desktopCategoryMessage) {

                desktopCategoryMessage.textContent =
                    desktopCount === 0
                        ? `No products found in ${label}`
                        : `${desktopCount} product${desktopCount > 1 ? 's' : ''} in ${label}`;

            }


            mobileCategoryMessage?.classList.remove(
                'hidden'
            );


            if (mobileCategoryMessage) {

                mobileCategoryMessage.textContent =
                    mobileCount === 0
                        ? `No products found in ${label}`
                        : `${mobileCount} product${mobileCount > 1 ? 's' : ''} in ${label}`;

            }

        } else {

            desktopCategoryMessage?.classList.add(
                'hidden'
            );


            mobileCategoryMessage?.classList.add(
                'hidden'
            );

        }



        if (currentSearch || currentCategory) {

            mobileReset?.classList.remove(
                'hidden'
            );

            mobileFilterReset?.classList.remove(
                'hidden'
            );

            desktopReset?.classList.remove(
                'hidden'
            );

        } else {

            mobileReset?.classList.add(
                'hidden'
            );

            mobileFilterReset?.classList.add(
                'hidden'
            );

            desktopReset?.classList.add(
                'hidden'
            );

        }



        if (
            mobileCount === 0 &&
            (currentSearch || currentCategory)
        ) {

            mobileEmpty?.classList.remove(
                'hidden'
            );

        } else {

            mobileEmpty?.classList.add(
                'hidden'
            );

        }

    };



    const searchProducts = (value) => {

        currentSearch =
            value.trim().toLowerCase();


        syncSearchInputs(value);

        applyFilters();

    };



    desktopSearch?.addEventListener(
        'input',
        (event) => {

            searchProducts(
                event.target.value
            );

        }
    );


    mobileSearch?.addEventListener(
        'input',
        (event) => {

            searchProducts(
                event.target.value
            );

        }
    );


    desktopSearchButton?.addEventListener(
        'click',
        () => {

            searchProducts(
                desktopSearch?.value || ''
            );

        }
    );


    mobileSearchButton?.addEventListener(
        'click',
        () => {

            searchProducts(
                mobileSearch?.value || ''
            );


            document
                .getElementById(
                    'mobileProducts'
                )
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

        }
    );



    [desktopSearch, mobileSearch].forEach((input) => {

        input?.addEventListener(
            'keydown',
            (event) => {

                if (event.key === 'Enter') {

                    event.preventDefault();

                    searchProducts(
                        input.value
                    );

                }

            }
        );

    });



    /* =====================================================
       RESET FILTERS
    ===================================================== */

    const resetAll = () => {

        currentSearch = '';

        currentCategory = '';


        syncSearchInputs('');


        chips.forEach((chip, index) => {

            chip.classList.remove(
                'bg-emerald-600',
                'text-white',
                'shadow-sm',
                'border-emerald-600'
            );


            chip.classList.add(
                'bg-white',
                'text-slate-700',
                'border-slate-200'
            );


            if (index === 0) {

                chip.classList.remove(
                    'bg-white',
                    'text-slate-700',
                    'border-slate-200'
                );


                chip.classList.add(
                    'bg-emerald-600',
                    'text-white',
                    'shadow-sm',
                    'border-emerald-600'
                );

            }

        });


        applyFilters();

    };



    desktopReset?.addEventListener(
        'click',
        resetAll
    );


    mobileReset?.addEventListener(
        'click',
        resetAll
    );


    mobileFilterReset?.addEventListener(
        'click',
        resetAll
    );


    mobileClearEmpty?.addEventListener(
        'click',
        () => {

            resetAll();


            document
                .getElementById(
                    'mobileProducts'
                )
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

        }
    );



    /* =====================================================
       CATEGORY CHIPS
    ===================================================== */

    chips.forEach((chip) => {

        chip.addEventListener(
            'click',
            () => {

                currentCategory =
                    (
                        chip.dataset.mobileCategory || ''
                    ).toLowerCase();


                chips.forEach((item) => {

                    item.classList.remove(
                        'bg-emerald-600',
                        'text-white',
                        'shadow-sm',
                        'border-emerald-600'
                    );


                    item.classList.add(
                        'bg-white',
                        'text-slate-700',
                        'border-slate-200'
                    );

                });


                chip.classList.remove(
                    'bg-white',
                    'text-slate-700',
                    'border-slate-200'
                );


                chip.classList.add(
                    'bg-emerald-600',
                    'text-white',
                    'shadow-sm',
                    'border-emerald-600'
                );


                applyFilters();


                document
                    .getElementById(
                        'mobileProducts'
                    )
                    ?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

            }
        );

    });



    /* =====================================================
       HOME QUICK CART
    ===================================================== */

    const homeCartForms =
        document.querySelectorAll(
            '.home-cart-form'
        );


    const homeQuickCart =
        document.getElementById(
            'homeQuickCart'
        );


    const homeQuickCartProducts =
        document.getElementById(
            'homeQuickCartProducts'
        );


    const homeQuickCartCount =
        document.getElementById(
            'homeQuickCartCount'
        );


    const homeQuickCartTotal =
        document.getElementById(
            'homeQuickCartTotal'
        );


    const homeCartStorageKey =
        'apna_local_bazaar_home_cart_{{ auth()->id() }}';


    if ({{ (int) $cartCount }} === 0) {

        localStorage.removeItem(
            homeCartStorageKey
        );

    }


    let homeSelectedProducts = {};


    try {

        homeSelectedProducts =
            JSON.parse(
                localStorage.getItem(
                    homeCartStorageKey
                ) || '{}'
            );

    } catch (error) {

        console.error(
            'Quick cart load error:',
            error
        );


        homeSelectedProducts = {};

    }



    const getHomeCartStats = () => {

        const products =
            Object.values(
                homeSelectedProducts
            );


        const items =
            products.reduce(
                (total, product) => {

                    return total +
                        Number(
                            product.quantity || 0
                        );

                },
                0
            );


        const total =
            products.reduce(
                (sum, product) => {

                    return sum +
                        (
                            Number(
                                product.price || 0
                            ) *
                            Number(
                                product.quantity || 0
                            )
                        );

                },
                0
            );


        return {
            products,
            items,
            total
        };

    };



    const formatHomePrice = (value) => {

        return Number(
            value || 0
        ).toLocaleString(
            'en-IN',
            {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }
        );

    };



    const renderHomeQuickCart = () => {

        if (
            !homeQuickCart ||
            !homeQuickCartProducts ||
            !homeQuickCartCount ||
            !homeQuickCartTotal
        ) {

            return;

        }


        const stats =
            getHomeCartStats();


        if (!stats.products.length) {

            homeQuickCart.classList.add(
                'hidden'
            );


            homeQuickCartProducts.innerHTML =
                '';


            return;

        }


        homeQuickCart.classList.remove(
            'hidden'
        );


        homeQuickCartCount.textContent =
            stats.items +
            (
                stats.items === 1
                    ? ' item'
                    : ' items'
            );


        homeQuickCartTotal.textContent =
            '₹' +
            formatHomePrice(
                stats.total
            );



        homeQuickCartProducts.innerHTML =
            stats.products
                .map((product) => {

                    return `
                        <div
                            class="relative flex h-[62px] w-[82px] shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-white p-1.5 shadow-sm"
                            title="${product.name} • Qty ${product.quantity}"
                        >

                            <img
                                src="${product.image}"
                                alt="${product.name}"
                                class="h-full w-full object-contain"
                                onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                            >

                            <span
                                class="absolute right-1 top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-emerald-600 px-1 text-[9px] font-black text-white shadow-sm"
                            >
                                ${product.quantity}
                            </span>

                        </div>
                    `;

                })
                .join('');


        localStorage.setItem(
            homeCartStorageKey,
            JSON.stringify(
                homeSelectedProducts
            )
        );

    };



    const addHomeCartProduct = (form) => {

        const productId =
            form.dataset.productId;


        if (!productId) {
            return;
        }


        const productName =
            form.dataset.productName;


        const productPrice =
            Number(
                form.dataset.productPrice
            );


        const productImage =
            form.dataset.productImage;



        if (
            homeSelectedProducts[
                productId
            ]
        ) {

            homeSelectedProducts[
                productId
            ].quantity += 1;

        } else {

            homeSelectedProducts[
                productId
            ] = {

                id:
                    productId,

                name:
                    productName,

                price:
                    productPrice,

                image:
                    productImage,

                quantity:
                    1

            };

        }


        renderHomeQuickCart();

    };



    homeCartForms.forEach((form) => {

        form.addEventListener(
            'submit',
            async (event) => {

                event.preventDefault();


                const button =
                    form.querySelector(
                        'button'
                    );


                const text =
                    form.querySelector(
                        '.add-cart-text'
                    );



                if (button) {

                    button.disabled = true;


                    button.classList.add(
                        'opacity-70',
                        'cursor-wait'
                    );

                }


                if (text) {

                    text.textContent =
                        'Adding...';

                }



                try {

                    const response =
                        await fetch(
                            form.action,
                            {
                                method: 'POST',

                                body:
                                    new FormData(
                                        form
                                    ),

                                headers: {

                                    'X-CSRF-TOKEN':
                                        '{{ csrf_token() }}',

                                    'X-Requested-With':
                                        'XMLHttpRequest',

                                    'Accept':
                                        'application/json,text/html'

                                },

                                credentials:
                                    'same-origin',

                                redirect:
                                    'follow'

                            }
                        );



                    if (!response.ok) {

                        throw new Error(
                            'Cart request failed.'
                        );

                    }


                    addHomeCartProduct(
                        form
                    );



                    /* ==========================================
                       UPDATE REAL HEADER CART BADGE
                    ========================================== */

                    const desktopCartCount =
                        document.getElementById(
                            'desktopCartCount'
                        );


                    const mobileCartCount =
                        document.getElementById(
                            'mobileCartCount'
                        );


                    [
                        desktopCartCount,
                        mobileCartCount
                    ].forEach((badge) => {

                        if (!badge) {
                            return;
                        }


                        const current =
                            Number(
                                badge.textContent
                            ) || 0;


                        badge.textContent =
                            current + 1;

                    });



                    if (text) {

                        text.textContent =
                            'Added ✓';

                    }



                    if (button) {

                        button.classList.remove(
                            'bg-emerald-600'
                        );


                        button.classList.add(
                            'bg-slate-900'
                        );

                    }



                    setTimeout(() => {

                        if (text) {

                            text.textContent =
                                form.closest(
                                    '#mobileProductGrid'
                                )
                                    ? 'Add'
                                    : 'Add to Cart';

                        }


                        if (button) {

                            button.disabled =
                                false;


                            button.classList.remove(
                                'opacity-70',
                                'cursor-wait',
                                'bg-slate-900'
                            );


                            button.classList.add(
                                'bg-emerald-600'
                            );

                        }

                    }, 1000);



                } catch (error) {

                    console.error(
                        'Add to cart error:',
                        error
                    );


                    if (text) {

                        text.textContent =
                            'Try Again';

                    }


                    if (button) {

                        button.disabled =
                            false;


                        button.classList.remove(
                            'opacity-70',
                            'cursor-wait'
                        );

                    }


                    alert(
                        'Product cart me add nahi ho saka. Please dobara try karo.'
                    );

                }

            }
        );

    });



    /* =====================================================
       RESTORE QUICK CART AFTER REFRESH
    ===================================================== */

    renderHomeQuickCart();

});

</script>



</body>
</html>


