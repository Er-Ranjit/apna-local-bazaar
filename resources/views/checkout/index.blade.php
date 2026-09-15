<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Checkout - Apna Local Bazaar</title>

@vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

{{-- HEADER --}}
<header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

    <div
        class="mx-auto flex min-h-[72px] max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:min-h-[80px] lg:px-8"
    >

        <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">

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


        <a
            href="{{ route('cart.index') }}"
            class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:px-5"
        >

            <span>←</span>

            <span class="hidden sm:inline">
                Back to Cart
            </span>

            <span class="sm:hidden">
                Cart
            </span>

        </a>

    </div>

</header>



{{-- MAIN --}}
<main class="mx-auto max-w-7xl px-4 py-6 pb-12 sm:px-6 sm:py-8 lg:px-8">

    {{-- PAGE INTRO --}}
    <div class="mb-7">

        <div
            class="flex items-center gap-2 text-xs font-bold uppercase tracking-[0.16em] text-emerald-600"
        >

            <span>
                Secure Checkout
            </span>

            <span class="h-1 w-1 rounded-full bg-emerald-400"></span>

            <span>
                COD Available
            </span>

        </div>


        <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
            Complete Your Order
        </h1>


        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
            Select your delivery address, review your items and place your order securely.
        </p>

    </div>



    {{-- ERROR --}}
    @if(session('error'))

        <div
            class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 px-5 py-4"
        >

            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 font-bold text-red-700"
            >
                !
            </div>

            <div>

                <p class="text-sm font-bold text-red-800">
                    Unable to continue
                </p>

                <p class="mt-1 text-sm text-red-700">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif



    {{-- SUCCESS --}}
    @if(session('success'))

        <div
            class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4"
        >

            <div
                class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-700"
            >
                ✓
            </div>

            <div>

                <p class="text-sm font-bold text-emerald-800">
                    Success
                </p>

                <p class="mt-1 text-sm text-emerald-700">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif



    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <p class="font-bold text-red-800">
                Please fix the following:
            </p>

            <ul class="mt-2 space-y-1 text-sm text-red-700">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif



    {{-- MAIN GRID --}}
    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_380px] lg:items-start">


        {{-- LEFT COLUMN --}}
        <div class="space-y-6">


            {{-- DELIVERY ADDRESS --}}
            <section
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            >

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"
                        >
                            📍
                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900 sm:text-lg">
                                Delivery Address
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Select where you'd like your order delivered.
                            </p>

                        </div>

                    </div>

                </div>



                <div class="p-5 sm:p-6">

                    @if($addresses->count() > 0)

                        <form
                            id="placeOrderForm"
                            action="{{ route('checkout.place-order') }}"
                            method="POST"
                        >

                            @csrf


                            <div
                                id="addressLocationWarning"
                                class="mb-4 hidden rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3"
                            >

                                <div class="flex items-start gap-3">

                                    <span class="text-lg">
                                        ⚠️
                                    </span>

                                    <div>

                                        <p class="text-sm font-bold text-amber-800">
                                            Location Required
                                        </p>

                                        <p class="mt-1 text-xs leading-5 text-amber-700">
                                            Please select an address with a saved location.
                                        </p>

                                    </div>

                                </div>

                            </div>



                            <div class="space-y-4">

                                @foreach($addresses as $address)

                                    <label class="block cursor-pointer">

                                        <input
                                            type="radio"
                                            name="address_id"
                                            value="{{ $address->id }}"
                                            data-lat="{{ $address->latitude }}"
                                            data-lng="{{ $address->longitude }}"
                                            required
                                            class="peer sr-only address-radio"
                                        >


                                        <div
                                            class="rounded-2xl border-2 border-slate-200 bg-white p-4 transition hover:border-emerald-200 hover:bg-emerald-50/20 peer-checked:border-emerald-500 peer-checked:bg-emerald-50/40"
                                        >

                                            <div class="flex items-start gap-4">


                                                {{-- ICON --}}
                                                <div
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-lg"
                                                >

                                                    @if($address->type === 'work')

                                                        💼

                                                    @else

                                                        🏠

                                                    @endif

                                                </div>


                                                {{-- DETAILS --}}
                                                <div class="min-w-0 flex-1">

                                                    <div
                                                        class="flex flex-wrap items-center gap-2"
                                                    >

                                                        <h3 class="font-bold text-slate-900">
                                                            {{ $address->name }}
                                                        </h3>

                                                        <span
                                                            class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-500"
                                                        >
                                                            {{ $address->type }}
                                                        </span>

                                                    </div>


                                                    <p class="mt-1 text-sm font-semibold text-slate-600">
                                                        {{ $address->phone }}
                                                    </p>


                                                    <p class="mt-2 text-sm leading-6 text-slate-600">

                                                        {{ $address->address }}

                                                        @if($address->landmark)
                                                            , {{ $address->landmark }}
                                                        @endif

                                                        @if($address->village)
                                                            , {{ $address->village }}
                                                        @endif

                                                        @if($address->city)
                                                            , {{ $address->city }}
                                                        @endif

                                                        @if($address->state)
                                                            , {{ $address->state }}
                                                        @endif

                                                        @if($address->pincode)
                                                            - {{ $address->pincode }}
                                                        @endif

                                                    </p>



                                                    {{-- LOCATION STATUS --}}
                                                    @if($address->latitude !== null && $address->longitude !== null)

                                                        <p class="mt-2 text-[11px] font-semibold text-emerald-600">
                                                            📍 Location saved
                                                        </p>

                                                    @else

                                                        <p class="mt-2 text-[11px] font-semibold text-amber-600">
                                                            ⚠ Location not set for this address
                                                        </p>

                                                    @endif

                                                </div>


                                                {{-- CHECK --}}
                                                <div
                                                    class="mt-1 hidden h-5 w-5 shrink-0 rounded-full border-2 border-emerald-500 bg-emerald-500 peer-checked:block"
                                                >
                                                </div>

                                            </div>

                                        </div>

                                    </label>

                                @endforeach

                            </div>

                        </form>

                    @else

                        {{-- EMPTY ADDRESS --}}
                        <div
                            class="rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center"
                        >

                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-white text-3xl shadow-sm"
                            >
                                📍
                            </div>

                            <h3 class="mt-4 font-bold text-slate-900">
                                No Saved Address
                            </h3>

                            <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                                Add a delivery address below to continue with your order.
                            </p>

                        </div>

                    @endif

                </div>

            </section>



            {{-- ADD ADDRESS --}}
            <section
                class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            >

                <div class="border-b border-slate-100 px-5 py-5 sm:px-6">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-50 text-blue-600"
                        >
                            +
                        </div>

                        <div>

                            <h2 class="font-bold text-slate-900 sm:text-lg">
                                Add New Address
                            </h2>

                            <p class="mt-0.5 text-xs text-slate-400">
                                Save another address for future orders.
                            </p>

                        </div>

                    </div>

                </div>



                <div class="p-5 sm:p-6">

                    <form
                        action="{{ route('address.store') }}"
                        method="POST"
                        class="space-y-5"
                    >

                        @csrf


                        {{-- NAME + PHONE --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="Enter full name"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>


                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Phone Number
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    required
                                    placeholder="Enter phone number"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>

                        </div>



                        {{-- ADDRESS --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Full Address
                            </label>

                            <textarea
                                name="address"
                                rows="3"
                                required
                                placeholder="House number, street, area..."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                            >{{ old('address') }}</textarea>

                        </div>



                        {{-- LANDMARK + VILLAGE --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Landmark
                                </label>

                                <input
                                    type="text"
                                    name="landmark"
                                    value="{{ old('landmark') }}"
                                    placeholder="Nearby landmark"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>


                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Village / Locality
                                </label>

                                <input
                                    type="text"
                                    name="village"
                                    value="{{ old('village') }}"
                                    placeholder="Village or locality"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>

                        </div>



                        {{-- CITY STATE PIN --}}
                        <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">

                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    City
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    value="{{ old('city') }}"
                                    required
                                    placeholder="City"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>


                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    State
                                </label>

                                <input
                                    type="text"
                                    name="state"
                                    value="{{ old('state') }}"
                                    required
                                    placeholder="State"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>


                            <div>

                                <label
                                    class="mb-2 block text-sm font-semibold text-slate-700"
                                >
                                    Pincode
                                </label>

                                <input
                                    type="text"
                                    name="pincode"
                                    value="{{ old('pincode') }}"
                                    required
                                    placeholder="Pincode"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>

                        </div>



                        {{-- LOCATION --}}
                        <div
                            class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4"
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-lg shadow-sm"
                                >
                                    📍
                                </div>


                                <div class="flex-1">

                                    <p class="text-sm font-bold text-emerald-800">
                                        Address Location
                                    </p>

                                    <p
                                        id="locationStatus"
                                        class="mt-1 text-xs leading-5 text-emerald-700"
                                    >
                                        Save your current map location with this address.
                                    </p>


                                    <button
                                        type="button"
                                        id="getAddressLocation"
                                        class="mt-3 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-4 py-2.5 text-xs font-bold text-white transition hover:bg-emerald-700"
                                    >
                                        📍 Use Current Location
                                    </button>

                                </div>

                            </div>

                        </div>



                        {{-- HIDDEN COORDINATES --}}
                        <input
                            type="hidden"
                            name="latitude"
                            id="addressLatitude"
                            value="{{ old('latitude') }}"
                        >

                        <input
                            type="hidden"
                            name="longitude"
                            id="addressLongitude"
                            value="{{ old('longitude') }}"
                        >



                        {{-- TYPE --}}
                        <div>

                            <label
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                Address Type
                            </label>

                            <select
                                name="type"
                                required
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 sm:w-64"
                            >

                                <option value="">
                                    Select Type
                                </option>

                                <option
                                    value="home"
                                    {{ old('type') === 'home' ? 'selected' : '' }}
                                >
                                    🏠 Home
                                </option>

                                <option
                                    value="work"
                                    {{ old('type') === 'work' ? 'selected' : '' }}
                                >
                                    💼 Work
                                </option>

                            </select>

                        </div>



                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-emerald-600"
                        >
                            Save Address
                        </button>

                    </form>

                </div>

            </section>

        </div>



        {{-- RIGHT COLUMN --}}
        <aside>

            <div
                class="sticky top-28 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm"
            >


                {{-- SUMMARY HEADER --}}
                <div class="border-b border-slate-100 bg-slate-950 p-5 text-white sm:p-6">

                    <p
                        class="text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300"
                    >
                        Your Order
                    </p>

                    <h2 class="mt-1 text-xl font-black">
                        Order Summary
                    </h2>

                    <p class="mt-1 text-xs text-slate-400">

                        {{ $cart->items->sum('quantity') }}

                        {{ $cart->items->sum('quantity') == 1 ? 'item' : 'items' }}

                    </p>

                </div>



                {{-- PRODUCTS --}}
                <div class="max-h-80 space-y-4 overflow-y-auto p-5 sm:p-6">

                    @foreach($cart->items as $item)

                        @php
                            $itemTotal =
                                (float) $item->price *
                                (int) $item->quantity;
                        @endphp


                        <div class="flex gap-3">


                            {{-- IMAGE --}}
                            <div
                                class="h-16 w-16 shrink-0 overflow-hidden rounded-xl bg-slate-50"
                            >

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
                                        class="h-full w-full object-contain p-1"
                                    >

                                @endif

                            </div>



                            {{-- DETAILS --}}
                            <div class="min-w-0 flex-1">

                                <p class="truncate text-sm font-bold text-slate-900">
                                    {{ $item->product->name ?? 'Product' }}
                                </p>

                                <p class="mt-1 text-xs text-slate-400">
                                    Qty: {{ $item->quantity }}
                                </p>

                            </div>


                            <p class="shrink-0 text-sm font-bold text-slate-900">
                                ₹{{ number_format($itemTotal, 2) }}
                            </p>

                        </div>

                    @endforeach

                </div>



                {{-- PRICE --}}
                <div class="border-t border-slate-100 p-5 sm:p-6">

                    <div class="space-y-4">


                        {{-- SUBTOTAL --}}
                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Subtotal
                            </span>

                            <span
                                id="checkoutSubtotal"
                                class="font-semibold text-slate-900"
                            >
                                ₹{{ number_format($subtotal ?? 0, 2) }}
                            </span>

                        </div>



                        {{-- DELIVERY DISTANCE --}}
                        <div
                            class="rounded-xl border border-blue-100 bg-blue-50/60 px-3 py-3"
                        >

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-slate-700">
                                        Delivery Distance
                                    </p>

                                    <p
                                        id="distanceDescription"
                                        class="mt-0.5 text-[11px] text-slate-400"
                                    >
                                        Select delivery address
                                    </p>

                                </div>


                                <span
                                    id="deliveryDistance"
                                    class="font-bold text-blue-700"
                                >
                                    —
                                </span>

                            </div>

                        </div>



                        {{-- DELIVERY CHARGE --}}
                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Delivery Charge
                            </span>

                            <span
                                id="deliveryCharge"
                                class="font-bold text-emerald-600"
                            >
                                —
                            </span>

                        </div>



                        {{-- DELIVERY PRICING INFO --}}
                        <div
                            class="rounded-xl border border-slate-100 bg-slate-50 px-3 py-3"
                        >

                            <div class="flex items-start gap-2">

                                <span class="text-base">
                                    🚚
                                </span>

                                <div>

                                    <p class="text-xs font-bold text-slate-700">
                                        Delivery pricing
                                    </p>

                                    <p class="mt-1 text-[11px] leading-5 text-slate-500">
                                        0–2 KM ₹10 · 2–5 KM ₹20 · 5–8 KM ₹30 · 8–10 KM ₹40
                                    </p>

                                </div>

                            </div>

                        </div>



                        {{-- DISCOUNT --}}
                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Discount
                            </span>

                            <span
                                id="checkoutDiscount"
                                class="font-semibold text-slate-900"
                            >
                                ₹{{ number_format($discount ?? 0, 2) }}
                            </span>

                        </div>

                    </div>



                    {{-- TOTAL --}}
                    <div class="mt-5 border-t border-slate-200 pt-5">

                        <div class="flex items-center justify-between">

                            <span class="font-bold text-slate-900">
                                Total
                            </span>

                            <span
                                id="checkoutTotal"
                                class="text-2xl font-black text-emerald-600"
                            >
                                —
                            </span>

                        </div>

                    </div>



                    {{-- PAYMENT --}}
                    <div
                        class="mt-5 rounded-2xl border border-emerald-200 bg-emerald-50 p-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-lg shadow-sm"
                            >
                                💵
                            </div>

                            <div>

                                <p class="text-sm font-bold text-emerald-800">
                                    Cash on Delivery
                                </p>

                                <p class="mt-0.5 text-xs text-emerald-700">
                                    Pay when your order arrives.
                                </p>

                            </div>

                        </div>

                    </div>



                    {{-- PLACE ORDER --}}
                    @if($addresses->count() > 0)

                        <button
                            id="placeOrderButton"
                            type="submit"
                            form="placeOrderForm"
                            disabled
                            class="mt-5 flex h-13 w-full cursor-not-allowed items-center justify-center rounded-xl bg-slate-300 px-5 py-3.5 text-sm font-bold text-slate-500 shadow-sm transition"
                        >
                            Place Order →
                        </button>


                        <p
                            id="orderSecurityText"
                            class="mt-3 text-center text-[11px] leading-5 text-slate-400"
                        >
                            Select a delivery address to continue.
                        </p>

                    @else

                        <button
                            type="button"
                            disabled
                            class="mt-5 w-full cursor-not-allowed rounded-xl bg-slate-200 px-5 py-3.5 text-sm font-bold text-slate-400"
                        >
                            Add Address to Continue
                        </button>

                    @endif



                    {{-- BACK CART --}}
                    <a
                        href="{{ route('cart.index') }}"
                        class="mt-3 flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                    >
                        ← Back to Cart
                    </a>

                </div>

            </div>

        </aside>

    </div>

</main>



{{-- FOOTER --}}
<footer class="border-t border-slate-200 bg-slate-950 text-white">

    <div class="mx-auto max-w-7xl px-4 py-7 sm:px-6 lg:px-8">

        <div
            class="flex flex-col items-center justify-between gap-3 text-center sm:flex-row sm:text-left"
        >

            <p class="text-xs text-slate-500 sm:text-sm">
                © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
            </p>

            <a
                href="{{ route('home') }}"
                class="text-xs font-semibold text-emerald-400 transition hover:text-emerald-300 sm:text-sm"
            >
                Back to Home
            </a>

        </div>

    </div>

</footer>



{{-- JAVASCRIPT --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const addressRadios =
        document.querySelectorAll('.address-radio');

    const distanceElement =
        document.getElementById('deliveryDistance');

    const distanceDescription =
        document.getElementById('distanceDescription');

    const chargeElement =
        document.getElementById('deliveryCharge');

    const totalElement =
        document.getElementById('checkoutTotal');

    const placeOrderButton =
        document.getElementById('placeOrderButton');

    const warningElement =
        document.getElementById('addressLocationWarning');

    const securityText =
        document.getElementById('orderSecurityText');


    /*
    |--------------------------------------------------------------------------
    | Update Summary From Server
    |--------------------------------------------------------------------------
    */

    function updateCheckout(addressId) {

        if (!addressId) {

            distanceElement.textContent = '—';
            distanceDescription.textContent =
                'Select delivery address';

            chargeElement.textContent = '—';
            totalElement.textContent = '—';

            setPlaceOrderState(false);

            return;
        }


        distanceElement.textContent =
            'Calculating...';

        distanceDescription.textContent =
            'Calculating delivery distance';

        chargeElement.textContent =
            '...';

        totalElement.textContent =
            '...';


        setPlaceOrderState(false);


        fetch(
            '{{ route('checkout.delivery-charge') }}?address_id=' +
            encodeURIComponent(addressId),
            {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }
        )

        .then(function (response) {

            return response.json();

        })

        .then(function (data) {

            if (!data.success) {

                throw new Error(
                    data.message ||
                    'Unable to calculate delivery.'
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Distance
            |--------------------------------------------------------------------------
            */

            distanceElement.textContent =
                Number(data.distance_km).toFixed(4) +
                ' KM';


            distanceDescription.textContent =
                'Selected address → Store';


            /*
            |--------------------------------------------------------------------------
            | Delivery Charge
            |--------------------------------------------------------------------------
            */

            chargeElement.textContent =
                '₹' +
                Number(data.delivery_charge).toFixed(2);


            chargeElement.classList.remove(
                'text-red-600'
            );

            chargeElement.classList.add(
                'text-emerald-600'
            );


            /*
            |--------------------------------------------------------------------------
            | Total
            |--------------------------------------------------------------------------
            */

            totalElement.textContent =
                '₹' +
                Number(data.total_amount).toFixed(2);


            /*
            |--------------------------------------------------------------------------
            | Hide Warning
            |--------------------------------------------------------------------------
            */

            warningElement?.classList.add(
                'hidden'
            );


            /*
            |--------------------------------------------------------------------------
            | Enable Order
            |--------------------------------------------------------------------------
            */

            setPlaceOrderState(true);


            if (securityText) {

                securityText.textContent =
                    '🔒 Your checkout is secure. Delivery charge is calculated automatically.';
            }

        })

        .catch(function (error) {

            distanceElement.textContent =
                'Unavailable';


            distanceDescription.textContent =
                'Unable to calculate delivery';


            chargeElement.textContent =
                'Unavailable';


            chargeElement.classList.remove(
                'text-emerald-600'
            );

            chargeElement.classList.add(
                'text-red-600'
            );


            totalElement.textContent =
                'Unavailable';


            warningElement?.classList.remove(
                'hidden'
            );


            setPlaceOrderState(false);


            if (securityText) {

                securityText.textContent =
                    '⚠️ ' + error.message;
            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Button State
    |--------------------------------------------------------------------------
    */

    function setPlaceOrderState(enabled) {

        if (!placeOrderButton) {
            return;
        }


        placeOrderButton.disabled =
            !enabled;


        if (enabled) {

            placeOrderButton.classList.remove(
                'cursor-not-allowed',
                'bg-slate-300',
                'text-slate-500'
            );

            placeOrderButton.classList.add(
                'bg-emerald-600',
                'text-white',
                'hover:bg-emerald-700'
            );

        } else {

            placeOrderButton.classList.remove(
                'bg-emerald-600',
                'text-white',
                'hover:bg-emerald-700'
            );

            placeOrderButton.classList.add(
                'cursor-not-allowed',
                'bg-slate-300',
                'text-slate-500'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Address Selection
    |--------------------------------------------------------------------------
    */

    addressRadios.forEach(function (radio) {

        radio.addEventListener(
            'change',
            function () {

                const latitude =
                    this.dataset.lat;

                const longitude =
                    this.dataset.lng;


                /*
                |--------------------------------------------------------------------------
                | Location Missing
                |--------------------------------------------------------------------------
                */

                if (
                    !latitude ||
                    !longitude
                ) {

                    distanceElement.textContent =
                        'Location missing';

                    distanceDescription.textContent =
                        'This address has no saved location.';

                    chargeElement.textContent =
                        'Unavailable';

                    chargeElement.classList.remove(
                        'text-emerald-600'
                    );

                    chargeElement.classList.add(
                        'text-red-600'
                    );

                    totalElement.textContent =
                        'Unavailable';


                    warningElement?.classList.remove(
                        'hidden'
                    );


                    setPlaceOrderState(false);


                    if (securityText) {

                        securityText.textContent =
                            '⚠️ Please select an address with saved location.';
                    }


                    return;
                }


                updateCheckout(
                    this.value
                );

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | Initial Address
    |--------------------------------------------------------------------------
    */

    const initialAddress =
        document.querySelector(
            '.address-radio:checked'
        );


    if (initialAddress) {

        updateCheckout(
            initialAddress.value
        );

    }

});

</script>
</body>
</html>
