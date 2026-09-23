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
<header class="sticky top-0 z-50 border-b border-slate-200 bg-white">

    <div class="mx-auto flex min-h-[70px] max-w-[1440px] items-center gap-3 px-4 sm:px-6 lg:min-h-[76px] lg:gap-5 lg:px-8">
<button
            type="button"
            id="mobileMenuButton"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl text-xl text-slate-700 transition hover:bg-emerald-50 lg:hidden"
            aria-label="Open menu"
        >
            ☰
        </button>
<a
            href="{{ route('home') }}"
            class="shrink-0"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-9 w-auto object-contain sm:h-10 lg:h-12"
            >
        </a>
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
                
                <p
                    id="desktopLocationText"
                    class="max-w-40 truncate text-sm font-bold text-slate-800"
                >
                    {{ auth()->check() && auth()->user()->latitude !== null && auth()->user()->longitude !== null ? 'Location Saved' : 'Select Location' }}                </p>
            </div>
        </button>
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
        </button>
<div
            class="relative hidden h-12 min-w-0 flex-1 items-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50 transition focus-within:border-emerald-500 focus-within:bg-white lg:flex"
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
                class="mr-1.5 flex h-10 w-12 shrink-0 items-center justify-center rounded-lg bg-emerald-600 text-white transition hover:bg-emerald-700"
                aria-label="Search"
            >
                ⌕
            </button>

        </div>
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
@auth

            <details class="relative hidden shrink-0 lg:block">

                <summary class="flex cursor-pointer list-none items-center gap-3 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 transition hover:border-emerald-100 hover:bg-emerald-50">

                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-800">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="hidden text-left xl:block"></div>

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
<main class="mx-auto max-w-[1440px] px-4 py-4 pb-40 sm:px-6 sm:py-6 lg:px-8">
<section class="hidden gap-6 lg:grid lg:grid-cols-[245px_minmax(0,1fr)]">
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
<div
            id="heroSliderDesktop"
            class="relative h-[340px] overflow-hidden rounded-2xl border border-slate-200 shadow-sm"
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


            <div class="relative z-10 flex h-full max-w-[620px] flex-col justify-center px-8 sm:px-10 xl:px-12">

                <span class="w-fit rounded-full bg-white/85 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700 backdrop-blur">
                    Apna Local Bazaar
                </span>

                <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950 xl:text-[42px]">

                    Local products.

                    <span class="block text-emerald-600">
                        Simple shopping.
                    </span>

                </h1>

                <p class="mt-4 max-w-lg text-sm leading-6 text-slate-700 xl:text-base">
                    Shop from nearby sellers and get the things you need without the extra hassle.
                </p>

                <a
                    href="#desktopProducts"
                    class="mt-6 inline-flex w-fit items-center gap-2 rounded-xl bg-emerald-600 px-6 py-3 font-bold text-white transition hover:bg-emerald-700"
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

                    Local products.

                    <span class="block text-emerald-600">
                        Simple shopping.
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

                                <span class="text-slate-500">Local shop</span>

                            </div>

                        </div>

                    </div>


                    <div class="mt-3 rounded-xl bg-emerald-50 px-3 py-2 text-center text-xs font-semibold text-emerald-700">
                        Local delivery available
                    </div>

                </div>

            @empty

                <div class="w-full rounded-2xl border border-slate-200 bg-white p-8 text-center text-sm text-slate-500">
                    No local shops available.
                </div>

            @endforelse

        </div>

    </section>
<section class="mt-5 hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:block">

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
<section id="desktopProducts" class="mt-12 hidden lg:block scroll-mt-28">
        <div class="rounded-2xl border border-amber-100 bg-amber-50/60 p-5">
            <div class="flex items-center justify-between gap-5">
                <div class="flex min-w-0 items-center gap-4">
                    <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm ring-1 ring-slate-200">🎁</div>
                    <div class="min-w-0">
                        <p class="text-[11px] font-black uppercase tracking-[0.18em] text-orange-600">First order offer</p>
                        <h3 class="mt-1 text-lg font-black text-slate-950 sm:text-xl">Get 10% OFF on your first purchase</h3>
                        <p class="mt-1 text-sm text-slate-500">Use coupon code <span class="font-extrabold text-emerald-700">FIRST10</span></p>
                    </div>
                </div>
                <a href="#desktopProductGrid" class="hidden shrink-0 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-extrabold text-white shadow-sm transition hover:bg-emerald-700 xl:inline-flex">Shop Now →</a>
            </div>
        </div>

        <div class="mt-10 flex items-end justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-100 text-xl">🛍️</div>
                    <div>
                        <h2 class="text-2xl font-black tracking-tight text-slate-950 xl:text-3xl">Popular Products</h2>
                        <p class="mt-1 text-sm text-slate-500">Popular products from nearby shops</p>
                    </div>
                </div>
                <p id="desktopSearchMessage" class="mt-2 hidden text-xs font-bold text-emerald-700"></p>
                <p id="desktopCategoryMessage" class="mt-2 hidden text-xs font-bold text-emerald-700"></p>
            </div>
            <button type="button" id="desktopResetProducts" class="hidden text-sm font-extrabold text-emerald-700 hover:text-emerald-800">Show All →</button>
        </div>

        <div id="desktopProductGrid" class="mt-5 grid grid-cols-2 gap-4 sm:grid-cols-3 xl:grid-cols-5">
            @forelse($products as $product)
                @php
                    $hasDiscount = $product->discount_price && $product->discount_price < $product->price;
                    $discountPercent = $hasDiscount ? round((($product->price - $product->discount_price) / $product->price) * 100) : 0;
                @endphp
                <article class="product-card group flex min-h-[400px] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md" data-name="{{ strtolower($product->name) }}" data-category="{{ strtolower($product->category?->name ?? '') }}">
                    <div class="relative p-2.5">
                        @if($hasDiscount)
                            <span class="absolute left-4 top-4 z-10 rounded-full bg-emerald-600 px-3 py-1.5 text-[10px] font-black text-white shadow-sm">{{ $discountPercent }}% OFF</span>
                        @endif
                        <button type="button" class="absolute right-4 top-4 z-10 flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-white/95 text-lg text-slate-400 shadow-sm transition hover:text-rose-500" aria-label="Wishlist">♡</button>
                        <a href="{{ route('product.show', $product->slug) }}" class="block">
                            <div class="flex h-48 items-center justify-center overflow-hidden rounded-xl bg-slate-50 px-4 py-4">
                                <img src="{{ !empty($product->image) ? asset('storage/' . ltrim($product->image, '/')) : asset('images/products/product-placeholder.png') }}" alt="{{ $product->name }}" class="h-full w-full object-contain mix-blend-multiply transition duration-500 group-hover:scale-105" onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';">
                            </div>
                        </a>
                    </div>

                    <div class="flex flex-1 flex-col px-4 pb-4 pt-1">
                        <div>
    <span class="inline-flex max-w-full rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black uppercase tracking-wide text-emerald-700">
        {{ $product->category?->name ?? 'Local Product' }}
    </span>

    <a href="{{ route('product.show', $product->slug) }}" class="mt-2 block min-h-[42px] line-clamp-2 text-[15px] font-extrabold leading-5 text-slate-900 transition hover:text-emerald-700">
        {{ $product->name }}
    </a>

    {{-- Product Description --}}
    @if(!empty($product->description))
        <p class="mt-1 line-clamp-2 text-xs leading-5 text-slate-500">
            {{ $product->description }}
        </p>
    @endif

    <div class="mt-2 flex items-center gap-1.5 text-xs font-medium text-slate-500">
        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
        In Stock
    </div>
</div>

                        <div class="mt-auto pt-4">
                            <div class="flex items-end justify-between gap-2">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-baseline gap-x-2 gap-y-0.5">
                                        <span class="text-xl font-black text-emerald-700">₹{{ number_format($product->discount_price ?? $product->price, 2) }}</span>
                                        @if($hasDiscount)
                                            <span class="text-xs font-medium text-slate-400 line-through">₹{{ number_format($product->price, 2) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @auth
                                    <form
                                        action="{{ route('cart.add', $product) }}"
                                        method="POST"
                                        class="shrink-0 home-cart-form"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->discount_price ?? $product->price }}"
                                        data-product-image="{{ !empty($product->image) ? asset('storage/' . ltrim($product->image, '/')) : asset('images/products/product-placeholder.png') }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="inline-flex h-10 items-center gap-2 whitespace-nowrap rounded-xl bg-emerald-600 px-4 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700 active:scale-95"
                                        >
                                            <span>🛒</span>
                                            <span class="add-cart-text">Add to Cart</span>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="inline-flex h-10 shrink-0 items-center gap-2 whitespace-nowrap rounded-xl bg-emerald-600 px-4 text-xs font-black text-white shadow-sm transition hover:bg-emerald-700"><span>🛒</span>Add to Cart</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl border border-slate-200 bg-white p-12 text-center text-sm text-slate-500">No products available right now.</div>
            @endforelse
        </div>

        <div class="mt-12 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="mb-5 flex items-end justify-between gap-4">
                <div>
                    <p class="text-[11px] font-black uppercase tracking-[0.18em] text-emerald-600">Around you</p>
                    <h3 class="mt-1 text-2xl font-black text-slate-950">Local Shops</h3>
                    <p class="mt-1 text-sm text-slate-500">Shops around you</p>
                </div>
                <span class="text-sm font-black text-emerald-700">View All →</span>
            </div>
            <div class="grid grid-cols-2 gap-3 xl:grid-cols-4">
                @forelse($vendors->take(4) as $vendor)
                    <div class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white p-4 transition hover:border-emerald-200 hover:bg-emerald-50/30">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white ring-1 ring-slate-200">
                            @if(!empty($vendor->image))
                                <img src="{{ asset('storage/' . ltrim($vendor->image, '/')) }}" alt="{{ $vendor->shop_name ?? 'Local Shop' }}" class="h-10 w-10 rounded-xl object-cover" onerror="this.onerror=null;this.src='{{ asset('images/features/shop.png') }}';">
                            @else
                                <img src="{{ asset('images/features/shop.png') }}" alt="" class="h-8 w-8 object-contain">
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-black text-slate-900">{{ $vendor->shop_name ?? 'Local Shop' }}</p>
                            <p class="truncate text-xs text-slate-500">{{ $vendor->city ?? 'Local Store' }}</p>
                            <p class="mt-1 text-xs text-slate-500">Local seller</p>
                        </div>
                        <span class="text-slate-400">›</span>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-sm text-slate-500">No local shops available.</div>
                @endforelse
            </div>
        </div>
    </section>
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
            class="grid grid-cols-2 items-stretch gap-3"
        >

            @forelse($products as $product)

                <div
                    class="product-card-mobile group relative flex h-full min-h-[360px] flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md"
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
<a
                        href="{{ route('product.show', $product->slug) }}"
                        class="block"
                    >

                        <div class="flex h-36 shrink-0 items-center justify-center overflow-hidden bg-slate-50 p-3 sm:h-40">

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


                    <div class="flex flex-1 flex-col p-3">

                        <a
                            href="{{ route('product.show', $product->slug) }}"
                            class="block truncate text-base font-bold text-slate-900 transition hover:text-emerald-700"
                        >
                            {{ $product->name }}
                        </a>


                        <p class="mt-1 truncate text-xs text-slate-500">
                            {{ $product->category?->name ?? 'Local Product' }}
                        </p>


                        <div class="mt-auto flex items-end justify-between gap-2 pt-4">

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
                                    class="home-cart-form"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->name }}"
                                    data-product-price="{{ $product->discount_price ?? $product->price }}"
                                    data-product-image="{{ !empty($product->image) ? asset('storage/' . ltrim($product->image, '/')) : asset('images/products/product-placeholder.png') }}"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="inline-flex shrink-0 items-center gap-1 rounded-xl bg-emerald-600 px-3 py-2 text-xs font-extrabold text-white shadow-sm transition hover:bg-emerald-700"
                                        aria-label="Add {{ $product->name }} to cart"
                                    >
                                        🛒
                                        <span class="add-cart-text">Add</span>
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
<section class="mt-8">
        <div class="flex items-end justify-between gap-4">
            <div>
                <h2 class="text-2xl font-extrabold text-slate-950 sm:text-3xl">
                    Shop by Category
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Everyday products, all in one place
                </p>
            </div>

            <a
                href="#desktopProducts"
                class="shrink-0 text-sm font-extrabold text-emerald-700 hover:text-emerald-800"
            >
                View Products →
            </a>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-3 sm:grid-cols-4 lg:grid-cols-8">
            @foreach($categoryOrder as $slug => $meta)
                @php($category = $categoryMap->get($slug))
                @if($category)
                    <a
                        href="{{ route('category', $category->slug) }}"
                        class="group rounded-xl border border-slate-200 bg-white p-3 text-center transition hover:border-emerald-200 hover:bg-emerald-50/30"
                    >
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 transition group-hover:bg-emerald-100">
                            <img
                                src="{{ asset('images/categories/' . match($category->slug) {
    'fast-food' => 'fast-food.png',
    'fruits-vegetables' => 'vegetables.png',
    'kirana' => 'grocery.png',
    'dairy-products' => 'dairy.png',
    'bakery' => 'bakery.png',
    'medicines' => 'medicine.png',
    'beverages' => 'beverages.png',
    'household-essentials' => 'household.png',
    default => 'grocery.png',
}) }}"
                                alt="{{ $category->name }}"
                                class="h-11 w-11 object-contain"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block';"
                            >
                            <span class="hidden text-2xl">{{ $meta[0] }}</span>
                        </div>
                        <p class="mt-2 line-clamp-2 text-xs font-bold text-slate-700 group-hover:text-emerald-700">
                            {{ $category->name }}
                        </p>
                    </a>
                @endif
            @endforeach
        </div>
    </section>
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
                    We are working on the app.
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
                    Need help with your order?
                </p>

            </div>

        </div>

    </section>
<section class="mt-8 hidden lg:block">

        <h2 class="text-2xl font-extrabold">
            Why shop with us?
        </h2>


        <div class="mt-4 grid gap-4 lg:grid-cols-4">

            @foreach([
                ['images/features/delivery.png', 'Fast Delivery', 'Quick doorstep delivery'],
                ['images/features/quality.png', 'Best Quality', 'Fresh and trusted products'],
                ['images/features/shop.png', 'Local Support', 'Support local businesses'],
                ['images/features/payment.png', 'Secure Payment', 'Simple and reliable checkout'],
            ] as $item)

                <div class="flex items-center gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

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

{{-- =========================================================
    HOME QUICK CART
========================================================= --}}

@auth

<div
    id="homeQuickCart"
    class="fixed inset-x-0 bottom-[68px] z-[55] hidden lg:bottom-0"
>
    <div class="mx-auto max-w-[1440px] px-2 pb-2 sm:px-4 lg:px-8 lg:pb-3">

        {{-- SELECTED PRODUCTS --}}
        <div
            id="homeQuickCartProducts"
            class="mb-2 flex gap-2 overflow-x-auto rounded-2xl border border-slate-200 bg-white/95 p-2 shadow-lg backdrop-blur-xl"
        ></div>

        {{-- CART SUMMARY --}}
        <div class="flex items-center gap-3 rounded-2xl bg-emerald-600 px-3 py-2.5 text-white shadow-[0_8px_30px_rgba(16,185,129,0.30)] sm:px-4 sm:py-3">

            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/15 text-xl sm:h-11 sm:w-11">
                🛒
            </div>

            <div class="min-w-0 flex-1">
                <p id="homeQuickCartCount" class="text-xs font-black sm:text-sm">
                    0 items
                </p>

                <p id="homeQuickCartTotal" class="mt-0.5 text-sm font-black sm:text-base">
                    ₹0.00
                </p>
            </div>

            <a
                href="{{ route('cart.index') }}"
                class="flex shrink-0 items-center gap-1 rounded-xl bg-white px-4 py-2.5 text-xs font-black text-emerald-700 shadow-sm transition hover:bg-emerald-50 active:scale-95 sm:px-5 sm:text-sm"
            >
                View Cart
                <span class="text-base">→</span>
            </a>

        </div>
    </div>
</div>

@endauth

</main>
<footer class="mt-10 hidden border-t border-slate-200 bg-slate-950 text-white lg:block">

    <div class="mx-auto grid max-w-[1440px] gap-8 px-5 py-10 sm:grid-cols-2 lg:grid-cols-4 lg:px-8">

        <div>

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Apna Local Bazaar"
                class="h-12 rounded-lg bg-white p-1"
            >

            <p class="mt-4 text-sm leading-6 text-slate-400">
                A simple place to buy everyday products from local shops.
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
                App is coming soon.
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
<script>

document.addEventListener('DOMContentLoaded', () => {


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


    /* =====================================================
       HOME QUICK CART
    ===================================================== */

    const homeCartForms =
        document.querySelectorAll('.home-cart-form');

    const homeQuickCart =
        document.getElementById('homeQuickCart');

    const homeQuickCartProducts =
        document.getElementById('homeQuickCartProducts');

    const homeQuickCartCount =
        document.getElementById('homeQuickCartCount');

    const homeQuickCartTotal =
        document.getElementById('homeQuickCartTotal');

    const homeCartStorageKey =
        'apna_local_bazaar_home_cart_{{ auth()->id() }}';
    if ({{ (int) $cartCount }} === 0) {
    localStorage.removeItem(homeCartStorageKey);
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
                            Number(product.price || 0) *
                            Number(product.quantity || 0)
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

        return Number(value || 0)
            .toLocaleString(
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
            homeSelectedProducts[productId]
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


                    /*
                    |--------------------------------------------------------------------------
                    | Update real header badge
                    |--------------------------------------------------------------------------
                    */

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


    /*
    |--------------------------------------------------------------------------
    | Restore QUICK CART after refresh
    |--------------------------------------------------------------------------
    */

    renderHomeQuickCart();

});

</script>

</body>
</html>