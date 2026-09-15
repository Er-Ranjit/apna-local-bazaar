<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900 antialiased">

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
<header class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/95 backdrop-blur-xl">

    <div class="mx-auto flex min-h-[70px] max-w-[1440px] items-center gap-3 px-4 sm:px-6 lg:min-h-[82px] lg:gap-5 lg:px-8">

        {{-- Mobile Menu --}}
        <button
            type="button"
            id="mobileMenuButton"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-xl text-slate-700 transition hover:bg-emerald-50 lg:hidden"
            aria-label="Open menu"
        >
            ☰
        </button>


        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            class="shrink-0"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-9 w-auto object-contain sm:h-10 lg:h-14"
            >
        </a>


        {{-- Desktop Location --}}
        <button
            type="button"
            class="customer-location-button hidden shrink-0 items-center gap-2 rounded-xl px-3 py-2.5 text-left transition hover:bg-emerald-50 lg:flex"
        >
            <img
                src="{{ asset('images/icons/location.png') }}"
                alt=""
                class="h-7 w-7 object-contain"
            >

            <div>
                <p class="text-[11px] font-medium text-slate-400">
                    Deliver to
                </p>

                <p
                    id="desktopLocationText"
                    class="max-w-40 truncate text-sm font-bold text-slate-800"
                >
                    {{ auth()->check() && auth()->user()->latitude !== null && auth()->user()->longitude !== null ? 'Location Saved' : 'Select Location' }}
                    <span class="ml-1 text-slate-400">⌄</span>
                </p>
            </div>
        </button>


        {{-- Mobile Location --}}
        <button
            type="button"
            class="customer-location-button ml-auto flex items-center gap-1.5 rounded-xl px-2 py-2 transition hover:bg-emerald-50 lg:hidden"
        >
            <img
                src="{{ asset('images/icons/location.png') }}"
                alt=""
                class="h-5 w-5 object-contain"
            >

            <span
                id="mobileLocationText"
                class="max-w-28 truncate text-xs font-bold text-slate-800 sm:max-w-36"
            >
                {{ auth()->check() && auth()->user()->latitude !== null && auth()->user()->longitude !== null ? 'Location Saved' : 'Select Location' }}
            </span>

            <span class="text-slate-400">
                ⌄
            </span>
        </button>


        {{-- Desktop Search --}}
        <div
            class="relative hidden h-14 min-w-0 flex-1 items-center overflow-hidden rounded-2xl border border-slate-200 bg-slate-50 shadow-sm transition focus-within:border-emerald-500 focus-within:bg-white focus-within:ring-4 focus-within:ring-emerald-100 lg:flex"
        >

            <img
                src="{{ asset('images/icons/search.png') }}"
                alt=""
                class="ml-4 h-5 w-5 shrink-0 object-contain"
            >

            <input
                id="desktopProductSearch"
                type="search"
                autocomplete="off"
                placeholder="Search for products, groceries and more..."
                class="h-full min-w-0 flex-1 bg-transparent px-4 text-sm text-slate-700 outline-none placeholder:text-slate-400"
            >

            <button
                type="button"
                id="desktopSearchButton"
                class="mr-1.5 flex h-11 w-14 shrink-0 items-center justify-center rounded-xl bg-emerald-600 text-white transition hover:bg-emerald-700"
                aria-label="Search"
            >
                ⌕
            </button>

        </div>


        {{-- Cart --}}
        <a
            href="{{ auth()->check() ? route('cart.index') : route('login') }}"
            class="relative hidden shrink-0 rounded-xl p-3 transition hover:bg-emerald-50 lg:block"
        >
            <img
                src="{{ asset('images/icons/cart.png') }}"
                alt="Cart"
                class="h-7 w-7 object-contain"
            >

            <span
                id="desktopCartCount"
                class="absolute right-1 top-1 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[10px] font-bold text-white"
            >
                {{ $cartCount }}
            </span>
        </a>


        {{-- Account --}}
        @auth

            <details class="relative hidden shrink-0 lg:block">

                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 transition hover:border-emerald-100 hover:bg-emerald-50">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-800">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="hidden text-left xl:block">

                        <p class="text-[11px] font-medium text-slate-400">
                            Welcome back
                        </p>

                        <p class="max-w-28 truncate text-sm font-bold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>

                    </div>

                    <span class="text-slate-400">
                        ⌄
                    </span>

                </summary>


                <div class="absolute right-0 top-14 z-50 w-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-2xl">

                    <div class="border-b border-slate-100 p-4">

                        <p class="font-bold text-slate-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="mt-1 truncate text-xs text-slate-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>


                    <a
                        href="{{ route('orders.index') }}"
                        class="block px-4 py-3 text-sm transition hover:bg-emerald-50"
                    >
                        My Orders
                    </a>

                    <a
                        href="{{ route('cart.index') }}"
                        class="block px-4 py-3 text-sm transition hover:bg-emerald-50"
                    >
                        My Cart
                    </a>


                    <div class="border-t border-slate-100">

                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="w-full px-4 py-3 text-left text-sm font-medium text-red-600 transition hover:bg-red-50"
                            >
                                Logout
                            </button>

                        </form>

                    </div>

                </div>

            </details>

        @else

            <a
                href="{{ route('login') }}"
                class="hidden shrink-0 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-700 lg:block"
            >
                Login
            </a>

        @endauth

    </div>


    {{-- Mobile Search --}}
    <div class="border-t border-slate-100 px-4 pb-3 lg:hidden">

        <div class="flex h-12 items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 shadow-sm focus-within:border-emerald-500 focus-within:bg-white">

            <img
                src="{{ asset('images/icons/search.png') }}"
                alt=""
                class="ml-3 h-5 w-5 shrink-0 object-contain"
            >

            <input
                id="mobileProductSearch"
                type="search"
                autocomplete="off"
                placeholder="Search products and more..."
                class="h-full min-w-0 flex-1 bg-transparent px-3 text-sm outline-none placeholder:text-slate-400"
            >

            <button
                id="mobileSearchButton"
                type="button"
                class="mr-1 flex h-10 w-11 shrink-0 items-center justify-center rounded-lg bg-emerald-600 text-white"
                aria-label="Search"
            >
                ⌕
            </button>

        </div>

    </div>

</header>


{{-- =========================================================
    MOBILE MENU
========================================================= --}}
<div
    id="mobileMenu"
    class="fixed inset-0 z-[60] hidden lg:hidden"
>

    <div
        id="mobileMenuOverlay"
        class="absolute inset-0 bg-slate-950/40 backdrop-blur-sm"
    ></div>


    <div class="relative h-full w-[84%] max-w-sm bg-white shadow-2xl">

        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-9 w-auto"
            >

            <button
                id="closeMobileMenu"
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl text-lg hover:bg-slate-100"
                aria-label="Close menu"
            >
                ✕
            </button>

        </div>


        <div class="p-4">

            @auth

                <div class="mb-5 flex items-center gap-3 rounded-2xl bg-emerald-50 p-4">

                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-800">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">

                        <p class="text-xs text-slate-400">
                            Welcome back
                        </p>

                        <p class="truncate font-bold">
                            {{ auth()->user()->name }}
                        </p>

                    </div>

                </div>

            @endauth


            <nav class="space-y-1">

                <a
                    href="{{ route('home') }}"
                    class="block rounded-xl px-4 py-3 font-medium transition hover:bg-emerald-50"
                >
                    Home
                </a>

                @auth

                    <a
                        href="{{ route('orders.index') }}"
                        class="block rounded-xl px-4 py-3 font-medium transition hover:bg-emerald-50"
                    >
                        My Orders
                    </a>

                    <a
                        href="{{ route('cart.index') }}"
                        class="block rounded-xl px-4 py-3 font-medium transition hover:bg-emerald-50"
                    >
                        My Cart
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="block rounded-xl px-4 py-3 font-medium transition hover:bg-emerald-50"
                    >
                        Login
                    </a>

                @endauth

            </nav>


            @auth

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-4 border-t border-slate-100 pt-4"
                >
                    @csrf

                    <button
                        type="submit"
                        class="w-full rounded-xl px-4 py-3 text-left font-medium text-red-600 transition hover:bg-red-50"
                    >
                        Logout
                    </button>

                </form>

            @endauth

        </div>

    </div>

</div>


{{-- =========================================================
    MAIN
========================================================= --}}
<main class="mx-auto max-w-[1440px] px-4 py-4 pb-24 sm:px-6 sm:py-6 lg:px-8">


    {{-- =====================================================
        DESKTOP HERO + CATEGORIES
    ====================================================== --}}
    <section class="hidden gap-6 lg:grid lg:grid-cols-[245px_minmax(0,1fr)]">


        {{-- Categories --}}
        <aside class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center gap-3 bg-emerald-600 px-5 py-4 text-white">

                <span class="text-xl">
                    ☰
                </span>

                <h2 class="font-bold">
                    All Categories
                </h2>

            </div>


            <div class="divide-y divide-slate-100">

                @foreach($categoryOrder as $slug => $meta)

                    @if($categoryMap->has($slug))

                        @php
                            $category = $categoryMap->get($slug);
                        @endphp

                        <a
                            href="{{ route('category', $category->slug) }}"
                            class="group flex min-h-[48px] items-center gap-3 px-5 py-2.5 transition hover:bg-emerald-50"
                        >

                            @if(!empty($category->image))

                                <img
                                    src="{{ asset('images/' . ltrim($category->image, '/')) }}"
                                    alt="{{ $meta[1] }}"
                                    class="h-7 w-7 shrink-0 rounded-md object-contain"
                                    onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';"
                                >

                            @else

                                <span class="flex h-7 w-7 shrink-0 items-center justify-center text-xl">
                                    {{ $meta[0] }}
                                </span>

                            @endif


                            <span class="text-sm font-medium text-slate-800 group-hover:text-emerald-700">
                                {{ $meta[1] }}
                            </span>


                            <span class="ml-auto text-slate-400 transition group-hover:translate-x-1 group-hover:text-emerald-600">
                                ›
                            </span>

                        </a>

                    @endif

                @endforeach

            </div>


            <a
                href="#mobileCategories"
                class="m-3 flex items-center justify-center rounded-lg bg-emerald-50 py-2.5 text-xs font-bold text-emerald-700 transition hover:bg-emerald-100"
            >
                View All Categories
            </a>

        </aside>


        {{-- HERO --}}
        <div
            id="heroSliderDesktop"
            class="relative h-[360px] overflow-hidden rounded-2xl shadow-sm"
        >

            <div class="hero-slide-desktop absolute inset-0 opacity-100 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner1.png') }}"
                    alt="Fast delivery"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="hero-slide-desktop absolute inset-0 opacity-0 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner2.png') }}"
                    alt="Fresh groceries"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="hero-slide-desktop absolute inset-0 opacity-0 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner3.png') }}"
                    alt="Local marketplace"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="absolute inset-0 bg-gradient-to-r from-white/90 via-white/40 to-transparent"></div>


            <div class="relative z-10 flex h-full max-w-[630px] flex-col justify-center px-10 xl:px-12">

                <span class="w-fit rounded-full bg-white/85 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700 backdrop-blur">
                    Apna Local Bazaar
                </span>

                <h1 class="mt-4 text-4xl font-black leading-[1.08] text-slate-950 xl:text-[44px]">

                    Everything Local.

                    <span class="block text-emerald-600">
                        Delivered Fresh.
                    </span>

                </h1>

                <p class="mt-4 max-w-lg text-sm font-medium leading-6 text-slate-700 xl:text-base">
                    Fresh groceries, local favourites and everyday essentials delivered straight to your doorstep.
                </p>

                <a
                    href="#desktopProducts"
                    class="mt-6 inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 font-bold text-white shadow-lg shadow-emerald-900/10 transition hover:bg-emerald-700"
                >
                    Shop Now

                    <span class="text-xl">
                        →
                    </span>
                </a>

            </div>


            <button
                id="prevSlideDesktop"
                type="button"
                aria-label="Previous banner"
                class="absolute left-4 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg shadow-lg transition hover:bg-white"
            >
                ‹
            </button>


            <button
                id="nextSlideDesktop"
                type="button"
                aria-label="Next banner"
                class="absolute right-4 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg shadow-lg transition hover:bg-white"
            >
                ›
            </button>


            <div class="absolute bottom-4 left-1/2 z-20 flex -translate-x-1/2 gap-2">

                <button
                    type="button"
                    data-desktop-slide="0"
                    class="desktop-slider-dot h-2 w-7 rounded-full bg-emerald-600"
                    aria-label="Slide 1"
                ></button>

                <button
                    type="button"
                    data-desktop-slide="1"
                    class="desktop-slider-dot h-2 w-2 rounded-full bg-white/70"
                    aria-label="Slide 2"
                ></button>

                <button
                    type="button"
                    data-desktop-slide="2"
                    class="desktop-slider-dot h-2 w-2 rounded-full bg-white/70"
                    aria-label="Slide 3"
                ></button>

            </div>

        </div>

    </section>


    {{-- =====================================================
        MOBILE HERO
    ====================================================== --}}
    <section class="lg:hidden">

        <div
            id="heroSliderMobile"
            class="relative h-[230px] overflow-hidden rounded-2xl shadow-sm sm:h-[290px]"
        >

            <div class="hero-slide-mobile absolute inset-0 opacity-100 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner1.png') }}"
                    alt="Fast delivery"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="hero-slide-mobile absolute inset-0 opacity-0 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner2.png') }}"
                    alt="Fresh groceries"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="hero-slide-mobile absolute inset-0 opacity-0 transition-opacity duration-700">

                <img
                    src="{{ asset('images/banner3.png') }}"
                    alt="Local marketplace"
                    class="h-full w-full object-cover"
                >

            </div>


            <div class="absolute inset-0 bg-gradient-to-r from-white/90 via-white/30 to-transparent"></div>


            <div class="relative z-10 flex h-full max-w-[74%] flex-col justify-center px-5 sm:max-w-[64%] sm:px-7">

                <span class="w-fit rounded-full bg-white/85 px-2.5 py-1 text-[9px] font-bold uppercase tracking-wider text-emerald-700 backdrop-blur">
                    Apna Local Bazaar
                </span>

                <h1 class="mt-2 text-2xl font-black leading-[1.08] text-slate-950 sm:text-3xl">

                    Everything Local.

                    <span class="block text-emerald-600">
                        Delivered Fresh.
                    </span>

                </h1>

                <p class="mt-2 text-[11px] font-semibold leading-5 text-slate-700 sm:text-sm">
                    Fast delivery • Best quality • Cash on Delivery
                </p>

                <a
                    href="#mobileProducts"
                    class="mt-3 inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white shadow-lg sm:px-5 sm:py-3 sm:text-sm"
                >
                    Shop Now

                    <span class="text-base">
                        →
                    </span>
                </a>

            </div>


            <button
                id="prevSlideMobile"
                type="button"
                aria-label="Previous banner"
                class="absolute left-2.5 top-1/2 z-20 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg shadow-md"
            >
                ‹
            </button>


            <button
                id="nextSlideMobile"
                type="button"
                aria-label="Next banner"
                class="absolute right-2.5 top-1/2 z-20 flex h-8 w-8 -translate-y-1/2 items-center justify-center rounded-full bg-white/90 text-lg shadow-md"
            >
                ›
            </button>


            <div class="absolute bottom-3 left-1/2 z-20 flex -translate-x-1/2 gap-2">

                <span class="mobile-slider-dot h-2 w-7 rounded-full bg-emerald-600"></span>

                <span class="mobile-slider-dot h-2 w-2 rounded-full bg-white/70"></span>

                <span class="mobile-slider-dot h-2 w-2 rounded-full bg-white/70"></span>

            </div>

        </div>

    </section>


    {{-- =====================================================
        MOBILE CATEGORIES
    ====================================================== --}}
    <section
        id="mobileCategories"
        class="mt-6 lg:hidden"
    >

        <div class="mb-3 flex items-center justify-between">

            <h2 class="text-lg font-extrabold">
                Categories
            </h2>

            <span class="text-xs font-semibold text-slate-400">
                Swipe to explore
            </span>

        </div>


        <div class="flex gap-3 overflow-x-auto pb-2">

            @foreach($categoryOrder as $slug => $meta)

                @if($categoryMap->has($slug))

                    @php
                        $category = $categoryMap->get($slug);
                    @endphp

                    <a
                        href="{{ route('category', $category->slug) }}"
                        class="group flex w-[88px] shrink-0 flex-col items-center"
                    >

                        <div class="flex h-[78px] w-[78px] items-center justify-center rounded-2xl border border-slate-200 bg-white shadow-sm transition group-hover:border-emerald-200 group-hover:bg-emerald-50">

                            @if(!empty($category->image))

                                <img
                                    src="{{ asset('images/' . ltrim($category->image, '/')) }}"
                                    alt="{{ $meta[1] }}"
                                    class="h-14 w-14 object-contain"
                                    onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';"
                                >

                            @else

                                <span class="text-3xl">
                                    {{ $meta[0] }}
                                </span>

                            @endif

                        </div>

                        <p class="mt-2 line-clamp-2 text-center text-xs font-semibold text-slate-700">
                            {{ $meta[1] }}
                        </p>

                    </a>

                @endif

            @endforeach

        </div>

    </section>


    {{-- =====================================================
        MOBILE CATEGORY FILTERS
    ====================================================== --}}
    <section
        class="mt-7 lg:hidden"
        id="mobileCategoryFilters"
    >

        <div class="mb-3 flex items-center justify-between">

            <div>

                <h2 class="text-xl font-extrabold">
                    Popular Categories
                </h2>

                <p
                    id="mobileCategoryMessage"
                    class="mt-1 hidden text-xs font-medium text-emerald-700"
                ></p>

            </div>

            <button
                type="button"
                id="mobileFilterReset"
                class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold text-emerald-700 shadow-sm"
            >
                All Products
            </button>

        </div>


        <div class="flex gap-2 overflow-x-auto pb-1">

            @foreach([
                ['All', ''],
                ['Burgers', 'burger'],
                ['Pizza', 'pizza'],
                ['Rolls', 'roll'],
                ['Snacks', 'snack'],
                ['Drinks', 'drink'],
            ] as $index => $chip)

                <button
                    type="button"
                    data-mobile-category="{{ $chip[1] }}"
                    class="category-chip shrink-0 rounded-xl border px-5 py-2.5 text-sm font-semibold transition
                    {{ $index === 0
                        ? 'border-emerald-600 bg-emerald-600 text-white shadow-sm'
                        : 'border-slate-200 bg-white text-slate-700 hover:bg-emerald-50' }}"
                >
                    {{ $chip[0] }}
                </button>

            @endforeach

        </div>

    </section>


    {{-- =====================================================
        MOBILE LOCAL SHOPS
    ====================================================== --}}
    <section class="mt-7 lg:hidden">

        <div class="mb-3 flex items-end justify-between">

            <div>

                <h2 class="text-xl font-extrabold">
                    Local Shops
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Trusted stores around you
                </p>

            </div>

            <span class="text-xs font-bold text-emerald-700">
                View All →
            </span>

        </div>


        <div class="flex gap-3 overflow-x-auto pb-2">

            @forelse($vendors as $vendor)

                <div class="w-[245px] shrink-0 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">

                    <div class="flex items-center gap-3">

                        @if(!empty($vendor->image))

                            <img
                                src="{{ asset('storage/' . ltrim($vendor->image, '/')) }}"
                                alt="{{ $vendor->shop_name ?? 'Local Shop' }}"
                                class="h-14 w-14 shrink-0 rounded-full object-cover"
                                onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';"
                            >

                        @else

                            <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-emerald-50">

                                <img
                                    src="{{ asset('images/features/shop.png') }}"
                                    alt=""
                                    class="h-9 w-9 object-contain"
                                >

                            </div>

                        @endif


                        <div class="min-w-0 flex-1">

                            <h3 class="truncate text-sm font-bold text-slate-900">
                                {{ $vendor->shop_name ?? 'Local Store' }}
                            </h3>

                            <p class="mt-1 truncate text-xs text-slate-500">
                                {{ $vendor->city ?? 'Local Store' }}
                            </p>

                            <div class="mt-2 flex items-center gap-3 text-xs">

                                <span class="font-semibold text-slate-600">
                                    ★ 4.5
                                </span>

                                <span class="text-slate-500">
                                    20–30 min
                                </span>

                            </div>

                        </div>

                    </div>


                    <div class="mt-3 rounded-xl bg-emerald-50 px-3 py-2 text-center text-xs font-semibold text-emerald-700">
                        Free delivery above ₹199
                    </div>

                </div>

            @empty

                <div class="w-full rounded-2xl border border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                    No local shops available.
                </div>

            @endforelse

        </div>

    </section>


    {{-- =====================================================
        DESKTOP FEATURES
    ====================================================== --}}
    <section class="relative z-20 mx-auto ml-70 -mt-[120px] hidden max-w-5xl overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:block">

        <div class="grid grid-cols-4">

            @foreach([
                ['images/features/delivery.png', 'Fast Delivery', 'Delivered to your door'],
                ['images/features/payment.png', 'Cash on Delivery', 'Safe and convenient'],
                ['images/features/quality.png', 'Best Quality', '100% trusted'],
                ['images/features/shop.png', 'Local Shops', 'Support local sellers'],
            ] as $feature)

                <div class="flex items-center gap-4 border-r border-slate-100 px-5 py-5 last:border-r-0">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-50">

                        <img
                            src="{{ asset($feature[0]) }}"
                            alt=""
                            class="h-9 w-9 object-contain"
                        >

                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-slate-900">
                            {{ $feature[1] }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-500">
                            {{ $feature[2] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </section>


    {{-- =====================================================
        DESKTOP PRODUCTS
    ====================================================== --}}
    <section
        id="desktopProducts"
        class="mt-18 hidden scroll-mt-24 items-start gap-6 lg:grid lg:grid-cols-[235px_minmax(0,1fr)_330px]"
    >


        {{-- OFFER --}}
        <div
            class="h-fit self-start rounded-2xl border border-amber-100 bg-gradient-to-b from-amber-50 to-orange-50 p-5"
        >

            <span class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700">
                Special Offer
            </span>

            <p class="mt-4 text-lg font-extrabold">
                First Order?
            </p>

            <p class="mt-2 text-sm leading-6 text-slate-700">
                Get an exclusive discount on your first purchase.
            </p>

            <p class="mt-5 text-3xl font-black text-orange-500">
                10%

                <span class="text-lg">
                    OFF
                </span>
            </p>

            <p class="mt-2 text-xs text-slate-600">
                Coupon Code:
                <b>FIRST10</b>
            </p>

            <a
                href="#desktopProducts"
                class="mt-5 inline-flex rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-emerald-700"
            >
                Shop Now
            </a>

        </div>


        {{-- PRODUCT LIST --}}
        <div class="min-w-0">

            <div class="mb-4 flex items-end justify-between">

                <div>

                    <h2 class="text-2xl font-extrabold">
                        Popular Products
                    </h2>

                    <p
                        id="desktopSearchMessage"
                        class="mt-1 hidden text-xs font-medium text-emerald-700"
                    ></p>

                    <p
                        id="desktopCategoryMessage"
                        class="mt-1 hidden text-xs font-medium text-emerald-700"
                    ></p>

                </div>


                <button
                    type="button"
                    id="desktopResetProducts"
                    class="hidden text-sm font-bold text-emerald-700"
                >
                    Show All →
                </button>

            </div>


            <div
                id="desktopProductGrid"
                class="grid grid-cols-3 items-start gap-3 xl:grid-cols-5"
            >

                @forelse($products as $product)

                    <div
                        class="product-card group overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:border-emerald-100 hover:shadow-lg"
                        data-name="{{ strtolower($product->name) }}"
                        data-category="{{ strtolower($product->category?->name ?? '') }}"
                    >

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block"
                        >

                            <div class="flex h-32 items-center justify-center overflow-hidden bg-white p-3">

                                @if(!empty($product->image))

                                    <img
                                        src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                        alt="{{ $product->name }}"
                                        class="h-full w-full object-contain transition duration-300 group-hover:scale-105"
                                        onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                    >

                                @else

                                    <img
                                        src="{{ asset('images/products/product-placeholder.png') }}"
                                        alt="{{ $product->name }}"
                                        class="h-24 w-24 object-contain"
                                    >

                                @endif

                            </div>

                        </a>


                        <div class="p-3">

                            <a
                                href="{{ route('product.show', $product->slug) }}"
                                class="block truncate text-sm font-bold text-slate-900 transition hover:text-emerald-700"
                            >
                                {{ $product->name }}
                            </a>


                            <p class="mt-1 truncate text-xs text-slate-500">
                                {{ $product->category?->name ?? 'Local Product' }}
                            </p>


                            <div class="mt-3 flex items-center justify-between gap-2">

                                <div>

                                    <span class="block text-base font-black text-emerald-700">
                                        ₹{{ number_format($product->discount_price ?? $product->price, 2) }}
                                    </span>


                                    @if($product->discount_price && $product->discount_price < $product->price)

                                        <span class="text-[11px] text-slate-400 line-through">
                                            ₹{{ number_format($product->price, 2) }}
                                        </span>

                                    @endif

                                </div>


                                @auth

                                    <form
                                        action="{{ route('cart.add', $product) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="rounded-xl bg-emerald-600 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-emerald-700"
                                        >
                                            + Add
                                        </button>

                                    </form>

                                @else

                                    <a
                                        href="{{ route('login') }}"
                                        class="rounded-xl bg-emerald-600 px-3 py-1.5 text-xs font-bold text-white"
                                    >
                                        + Add
                                    </a>

                                @endauth

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full rounded-2xl border border-slate-200 bg-white p-10 text-center text-sm text-slate-500">
                        No products available right now.
                    </div>

                @endforelse

            </div>

        </div>


        {{-- DESKTOP SHOPS --}}
        <div class="self-start">

            <div class="mb-4 flex items-end justify-between">

                <div>

                    <h2 class="text-2xl font-extrabold">
                        Local Shops
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Trusted local sellers
                    </p>

                </div>

                <span class="text-sm font-bold text-emerald-700">
                    View All →
                </span>

            </div>


            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                @forelse($vendors->take(4) as $vendor)

                    <div class="flex items-center gap-3 border-b border-slate-100 p-3 last:border-0">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-50">

                            @if(!empty($vendor->image))

                                <img
                                    src="{{ asset('storage/' . ltrim($vendor->image, '/')) }}"
                                    alt="{{ $vendor->shop_name ?? 'Local Shop' }}"
                                    class="h-12 w-12 rounded-full object-cover"
                                    onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';"
                                >

                            @else

                                <img
                                    src="{{ asset('images/features/shop.png') }}"
                                    alt=""
                                    class="h-8 w-8 object-contain"
                                >

                            @endif

                        </div>


                        <div class="min-w-0 flex-1">

                            <h3 class="truncate text-sm font-bold">
                                {{ $vendor->shop_name ?? 'Local Shop' }}
                            </h3>

                            <p class="truncate text-xs text-slate-500">
                                {{ $vendor->city ?? 'Local Store' }}
                            </p>

                            <p class="mt-1 text-xs">

                                <span class="text-amber-500">
                                    ★
                                </span>

                                4.5

                            </p>

                        </div>

                    </div>

                @empty

                    <div class="p-8 text-center text-sm text-slate-500">
                        No local shops available.
                    </div>

                @endforelse

            </div>

        </div>

    </section>


    {{-- =====================================================
        MOBILE PRODUCTS
    ====================================================== --}}
    <section
        id="mobileProducts"
        class="mt-8 scroll-mt-24 lg:hidden"
    >

        <div class="mb-4 flex items-end justify-between">

            <div>

                <h2 class="text-xl font-extrabold">
                    Popular Items
                </h2>

                <p
                    id="mobileSearchMessage"
                    class="mt-1 hidden text-xs font-medium text-emerald-700"
                ></p>

                <p
                    id="mobileCategoryProductMessage"
                    class="mt-1 hidden text-xs font-medium text-emerald-700"
                ></p>

            </div>


            <button
                type="button"
                id="mobileResetProducts"
                class="hidden text-sm font-bold text-emerald-700"
            >
                Show All →
            </button>

        </div>


        <div
            id="mobileProductGrid"
            class="grid grid-cols-2 gap-3"
        >

            @forelse($products as $product)

                <div
                    class="product-card-mobile group relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
                    data-name="{{ strtolower($product->name) }}"
                    data-category="{{ strtolower($product->category?->name ?? '') }}"
                >

                    @if($loop->first)

                        <span class="absolute left-2 top-2 z-10 rounded-lg bg-emerald-600 px-2 py-1 text-[10px] font-bold text-white shadow-sm">
                            Bestseller
                        </span>

                    @endif


                    <button
                        type="button"
                        class="absolute right-2 top-2 z-10 flex h-8 w-8 items-center justify-center rounded-full border border-slate-100 bg-white/90 text-lg text-slate-400 shadow-sm transition hover:text-red-500"
                        aria-label="Wishlist"
                    >
                        ♡
                    </button>


                    {{-- Image --}}
                    <a
                        href="{{ route('product.show', $product->slug) }}"
                        class="block"
                    >

                        <div class="flex h-36 items-center justify-center overflow-hidden bg-white p-3 sm:h-40">

                            @if(!empty($product->image))

                                <img
                                    src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
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


                    <div class="p-3">

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block truncate text-base font-bold text-slate-900 transition hover:text-emerald-700"
                        >
                            {{ $product->name }}
                        </a>


                        <p class="mt-1 truncate text-xs text-slate-500">
                            {{ $product->category?->name ?? 'Local Product' }}
                        </p>


                        <div class="mt-3 flex items-end justify-between gap-2">

                            <div>

                                <p class="text-lg font-black text-slate-900">
                                    ₹{{ number_format($product->discount_price ?? $product->price, 0) }}
                                </p>


                                @if($product->discount_price && $product->discount_price < $product->price)

                                    <p class="text-xs text-slate-400 line-through">
                                        ₹{{ number_format($product->price, 0) }}
                                    </p>

                                @endif

                            </div>


                            @auth

                                <form
                                    action="{{ route('cart.add', $product) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-2xl font-medium text-white shadow-sm transition hover:bg-emerald-700"
                                        aria-label="Add {{ $product->name }} to cart"
                                    >
                                        +
                                    </button>

                                </form>

                            @else

                                <a
                                    href="{{ route('login') }}"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-600 text-2xl font-medium text-white"
                                >
                                    +
                                </a>

                            @endauth

                        </div>

                    </div>

                </div>

            @empty

                <div class="col-span-full rounded-2xl border border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                    No products available right now.
                </div>

            @endforelse


            <div
                id="mobileNoSearchResults"
                class="col-span-full hidden rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center"
            >

                <div class="text-3xl">
                    🔎
                </div>

                <h3 class="mt-2 font-bold">
                    No matching products
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Try another product name or category.
                </p>

                <button
                    id="mobileClearSearchEmpty"
                    type="button"
                    class="mt-4 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-bold text-white"
                >
                    Show All Products
                </button>

            </div>

        </div>

    </section>


    {{-- =====================================================
        MOBILE BENEFITS
    ====================================================== --}}
    <section class="mt-8 rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm lg:hidden">

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-4">

            @foreach([
                ['images/features/delivery.png', 'Fast Delivery', 'At your doorstep'],
                ['images/features/payment.png', 'Cash on Delivery', 'Safe payment'],
                ['images/features/quality.png', 'Best Quality', '100% trusted'],
                ['images/features/shop.png', 'Local Support', 'Always here for you'],
            ] as $feature)

                <div class="flex items-center gap-2">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-50">

                        <img
                            src="{{ asset($feature[0]) }}"
                            alt=""
                            class="h-7 w-7 object-contain"
                        >

                    </div>

                    <div class="min-w-0">

                        <p class="truncate text-xs font-bold sm:text-sm">
                            {{ $feature[1] }}
                        </p>

                        <p class="truncate text-[10px] text-slate-500 sm:text-xs">
                            {{ $feature[2] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </section>


    {{-- =====================================================
        DESKTOP APP STRIP
    ====================================================== --}}
    <section class="mt-7 hidden grid-cols-3 items-center gap-4 rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm lg:grid lg:px-8">

        <div class="flex items-center gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-600 text-white">
                ▣
            </div>

            <div>

                <p class="font-bold">
                    Apna Local Bazaar App
                </p>

                <p class="text-xs text-slate-500">
                    A better shopping experience is coming soon.
                </p>

            </div>

        </div>


        <button
            type="button"
            class="mx-auto rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-emerald-700"
        >
            Coming Soon
        </button>


        <div class="flex items-center justify-end gap-3">

            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-50">
                ?
            </div>

            <div>

                <p class="font-bold">
                    Need Help?
                </p>

                <p class="text-xs text-slate-500">
                    Our support team is here for you.
                </p>

            </div>

        </div>

    </section>


    {{-- =====================================================
        WHY CHOOSE US
    ====================================================== --}}
    <section class="mt-8 hidden lg:block">

        <h2 class="text-2xl font-extrabold">
            Why Choose Apna Local Bazaar?
        </h2>


        <div class="mt-4 grid gap-4 lg:grid-cols-4">

            @foreach([
                ['images/features/delivery.png', 'Fast Delivery', 'Quick doorstep delivery'],
                ['images/features/quality.png', 'Best Quality', 'Fresh and trusted products'],
                ['images/features/shop.png', 'Local Support', 'Support local businesses'],
                ['images/features/payment.png', 'Secure Payment', 'Simple and reliable checkout'],
            ] as $item)

                <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-50">

                        <img
                            src="{{ asset($item[0]) }}"
                            alt=""
                            class="h-9 w-9 object-contain"
                        >

                    </div>

                    <div>

                        <p class="font-bold">
                            {{ $item[1] }}
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $item[2] }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </section>

</main>


{{-- =========================================================
    DESKTOP FOOTER
========================================================= --}}
<footer class="mt-12 hidden border-t border-slate-200 bg-slate-950 text-white lg:block">

    <div class="mx-auto grid max-w-[1440px] gap-8 px-5 py-10 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">

        <div>

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-12 rounded-lg bg-white p-1"
            >

            <p class="mt-4 text-sm leading-6 text-slate-400">
                Your trusted digital marketplace for local shops, groceries and everyday essentials.
            </p>

        </div>


        <div>

            <h3 class="font-bold">
                Quick Links
            </h3>

            <div class="mt-4 space-y-2 text-sm text-slate-400">

                <a
                    href="#desktopProducts"
                    class="block transition hover:text-white"
                >
                    Popular Products
                </a>

                <a
                    href="#mobileCategories"
                    class="block transition hover:text-white"
                >
                    Categories
                </a>

                <a
                    href="{{ route('home') }}"
                    class="block transition hover:text-white"
                >
                    Home
                </a>

            </div>

        </div>


        <div>

            <h3 class="font-bold">
                Customer Support
            </h3>

            <div class="mt-4 space-y-2 text-sm text-slate-400">

                <p>
                    Help Center
                </p>

                <p>
                    Contact Us
                </p>

                <p>
                    Privacy Policy
                </p>

            </div>

        </div>


        <div>

            <h3 class="font-bold">
                App
            </h3>

            <p class="mt-4 text-sm text-slate-400">
                Android and iOS app coming soon.
            </p>

            <button
                type="button"
                class="mt-4 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-bold transition hover:bg-emerald-700"
            >
                Coming Soon
            </button>

        </div>

    </div>


    <div class="border-t border-white/10 py-4 text-center text-xs text-slate-500">
        © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
    </div>

</footer>


{{-- =========================================================
    MOBILE BOTTOM NAVIGATION
========================================================= --}}
<nav class="fixed inset-x-0 bottom-0 z-50 border-t border-slate-200 bg-white/95 px-2 pt-2 shadow-[0_-6px_24px_rgba(15,23,42,0.08)] backdrop-blur-xl lg:hidden">

    <div class="mx-auto grid max-w-lg grid-cols-4">

        <a
            href="{{ route('home') }}"
            class="flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-emerald-600"
        >
            <span class="text-xl leading-none">
                ⌂
            </span>

            <span class="text-[10px] font-bold">
                Home
            </span>
        </a>


        <a
            href="#mobileCategories"
            class="flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-slate-500"
        >
            <span class="text-xl leading-none">
                ▦
            </span>

            <span class="text-[10px] font-semibold">
                Categories
            </span>
        </a>


        @auth

            <a
                href="{{ route('orders.index') }}"
                class="flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-slate-500"
            >
                <span class="text-xl leading-none">
                    ▤
                </span>

                <span class="text-[10px] font-semibold">
                    Orders
                </span>
            </a>


            <a
                href="{{ route('cart.index') }}"
                class="relative flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-slate-500"
            >

                <span class="text-xl leading-none">
                    🛒
                </span>

                <span
                    id="mobileCartCount"
                    class="absolute right-4 top-0 flex h-5 min-w-5 items-center justify-center rounded-full bg-orange-500 px-1 text-[9px] font-bold text-white"
                >
                    {{ $cartCount }}
                </span>

                <span class="text-[10px] font-semibold">
                    Cart
                </span>

            </a>

        @else

            <a
                href="{{ route('login') }}"
                class="flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-slate-500"
            >

                <span class="text-xl leading-none">
                    ◯
                </span>

                <span class="text-[10px] font-semibold">
                    Login
                </span>

            </a>


            <a
                href="{{ route('login') }}"
                class="flex flex-col items-center gap-1 rounded-xl px-2 py-1.5 text-slate-500"
            >

                <span class="text-xl leading-none">
                    🛒
                </span>

                <span class="text-[10px] font-semibold">
                    Cart
                </span>

            </a>

        @endauth

    </div>

</nav>


<div class="h-20 lg:hidden"></div>


{{-- =========================================================
    JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', () => {


    /* =====================================================
       CUSTOMER LOCATION
    ====================================================== */

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
                button.querySelector('#desktopLocationText, #mobileLocationText');

            if (textElement) {
                textElement.textContent = 'Getting location...';
            }

            button.disabled = true;

            button.classList.add(
                'cursor-not-allowed',
                'opacity-70'
            );

            navigator.geolocation.getCurrentPosition(

                async (position) => {

                    const latitude =
                        Number(position.coords.latitude);

                    const longitude =
                        Number(position.coords.longitude);

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
                        textElement.textContent = 'Select Location';
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
    ====================================================== */

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
       DESKTOP SLIDER
    ====================================================== */

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
       MOBILE SLIDER
    ====================================================== */

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


        showSlide(0);
        restart();

    };


    createDesktopSlider();
    createMobileSlider();


    /* =====================================================
       PRODUCT ELEMENTS
    ====================================================== */

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


    /* =====================================================
       SYNC SEARCH INPUTS
    ====================================================== */

    const syncSearchInputs = (value) => {

        if (desktopSearch) {
            desktopSearch.value = value;
        }

        if (mobileSearch) {
            mobileSearch.value = value;
        }

    };


    /* =====================================================
       PRODUCT MATCH
    ====================================================== */

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


    /* =====================================================
       APPLY FILTERS
    ====================================================== */

    const applyFilters = () => {

        let desktopCount = 0;
        let mobileCount = 0;


        desktopProducts.forEach((card) => {

            const matches = matchesProduct(card);

            card.classList.toggle(
                'hidden',
                !matches
            );

            if (matches) {
                desktopCount++;
            }

        });


        mobileProducts.forEach((card) => {

            const matches = matchesProduct(card);

            card.classList.toggle(
                'hidden',
                !matches
            );

            if (matches) {
                mobileCount++;
            }

        });


        /* Search message */

        if (desktopMessage) {

            if (currentSearch) {

                desktopMessage.classList.remove('hidden');

                desktopMessage.textContent =
                    desktopCount === 0
                        ? `No products found for "${currentSearch}"`
                        : `${desktopCount} product${desktopCount > 1 ? 's' : ''} found`;

            } else {

                desktopMessage.classList.add('hidden');

            }

        }


        if (mobileMessage) {

            if (currentSearch) {

                mobileMessage.classList.remove('hidden');

                mobileMessage.textContent =
                    mobileCount === 0
                        ? `No products found for "${currentSearch}"`
                        : `${mobileCount} product${mobileCount > 1 ? 's' : ''} found`;

            } else {

                mobileMessage.classList.add('hidden');

            }

        }


        /* Category message */

        if (currentCategory) {

            const label =
                currentCategory.charAt(0).toUpperCase() +
                currentCategory.slice(1);


            desktopCategoryMessage?.classList.remove('hidden');

            if (desktopCategoryMessage) {

                desktopCategoryMessage.textContent =
                    desktopCount === 0
                        ? `No products found in ${label}`
                        : `${desktopCount} product${desktopCount > 1 ? 's' : ''} in ${label}`;

            }


            mobileCategoryMessage?.classList.remove('hidden');

            if (mobileCategoryMessage) {

                mobileCategoryMessage.textContent =
                    mobileCount === 0
                        ? `No products found in ${label}`
                        : `${mobileCount} product${mobileCount > 1 ? 's' : ''} in ${label}`;

            }

        } else {

            desktopCategoryMessage?.classList.add('hidden');

            mobileCategoryMessage?.classList.add('hidden');

        }


        /* Empty state */

        if (currentSearch || currentCategory) {

            mobileReset?.classList.remove('hidden');
            mobileFilterReset?.classList.remove('hidden');
            desktopReset?.classList.remove('hidden');

        } else {

            mobileReset?.classList.add('hidden');
            mobileFilterReset?.classList.add('hidden');
            desktopReset?.classList.add('hidden');

        }


        if (mobileCount === 0 && (currentSearch || currentCategory)) {

            mobileEmpty?.classList.remove('hidden');

        } else {

            mobileEmpty?.classList.add('hidden');

        }

    };


    /* =====================================================
       SEARCH
    ====================================================== */

    const searchProducts = (value) => {

        currentSearch =
            value.trim().toLowerCase();

        syncSearchInputs(value);

        applyFilters();

    };


    desktopSearch?.addEventListener(
        'input',
        (event) => {
            searchProducts(event.target.value);
        }
    );


    mobileSearch?.addEventListener(
        'input',
        (event) => {
            searchProducts(event.target.value);
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
                .getElementById('mobileProducts')
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

        }
    );


    /* =====================================================
       ENTER SEARCH
    ====================================================== */

    [desktopSearch, mobileSearch].forEach((input) => {

        input?.addEventListener(
            'keydown',
            (event) => {

                if (event.key === 'Enter') {

                    event.preventDefault();

                    searchProducts(input.value);

                }

            }
        );

    });


    /* =====================================================
       RESET ALL
    ====================================================== */

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
                .getElementById('mobileProducts')
                ?.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

        }
    );


    /* =====================================================
       CATEGORY CHIPS
    ====================================================== */

    chips.forEach((chip) => {

        chip.addEventListener(
            'click',
            () => {

                currentCategory =
                    (chip.dataset.mobileCategory || '').toLowerCase();


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
                    .getElementById('mobileProducts')
                    ?.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

            }
        );

    });

});

</script>

</body>
</html>