<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Cart - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

    {{-- HEADER --}}
    <header class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur-xl">

        <div class="mx-auto flex min-h-[72px] max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:min-h-[80px] lg:px-8">

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
                href="{{ route('home') }}"
                class="inline-flex shrink-0 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:px-5"
            >
                <span>←</span>

                <span class="hidden sm:inline">
                    Continue Shopping
                </span>

                <span class="sm:hidden">
                    Shop
                </span>

            </a>

        </div>

    </header>


    {{-- MAIN --}}
    <main class="mx-auto max-w-7xl px-4 py-6 pb-32 sm:px-6 sm:py-8 sm:pb-12 lg:px-8">

        <div class="mb-7">

            <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">

                <span>
                    Shopping Cart
                </span>

                <span class="h-1 w-1 rounded-full bg-emerald-400"></span>

                <span>
                    {{ $cart->items->count() }}
                    {{ $cart->items->count() === 1 ? 'item' : 'items' }}
                </span>

            </div>


            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                My Cart
            </h1>


            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
                Review your items, update quantities and continue to a secure checkout.
            </p>

        </div>


        {{-- SUCCESS --}}
        @if(session('success'))

            <div class="mb-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4">

                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-700">
                    ✓
                </div>

                <div>

                    <p class="text-sm font-semibold text-emerald-800">
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

                <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-red-100 text-sm font-bold text-red-700">
                    !
                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Error
                    </p>

                    <p class="mt-0.5 text-sm text-red-700">
                        {{ session('error') }}
                    </p>

                </div>

            </div>

        @endif


        @if($cart->items->count() > 0)

            @php
                $total = 0;
                $itemCount = 0;

                foreach($cart->items as $cartItem) {
                    $total += (float) $cartItem->price * (int) $cartItem->quantity;
                    $itemCount += (int) $cartItem->quantity;
                }
            @endphp


            {{-- FREE DELIVERY --}}
            <div class="mb-6 overflow-hidden rounded-2xl border border-emerald-100 bg-gradient-to-r from-emerald-50 via-white to-emerald-50">

                <div class="flex flex-col gap-3 px-4 py-4 sm:flex-row sm:items-center sm:justify-between sm:px-5">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-lg">
                            🚚
                        </div>

                        <div>

                            <p class="text-sm font-bold text-slate-900">
                                Free Delivery
                            </p>

                            <p class="mt-0.5 text-xs leading-5 text-slate-500">
                                Enjoy free delivery on your eligible order.
                            </p>

                        </div>

                    </div>

                    <span class="w-fit rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">
                        FREE
                    </span>

                </div>

            </div>


            {{-- CART LAYOUT --}}
            <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-start">


                {{-- ITEMS --}}
                <section class="min-w-0">

                    <div class="mb-4 flex items-center justify-between">

                        <div>

                            <h2 class="text-lg font-extrabold text-slate-950 sm:text-xl">
                                Your Items
                            </h2>

                            <p class="mt-1 text-xs text-slate-500 sm:text-sm">
                                {{ $itemCount }}
                                {{ $itemCount === 1 ? 'item' : 'items' }}
                                in your cart
                            </p>

                        </div>

                        <span class="rounded-full bg-white px-3 py-1.5 text-xs font-semibold text-slate-500 shadow-sm ring-1 ring-slate-200">
                            {{ $cart->items->count() }} products
                        </span>

                    </div>


                    <div class="space-y-4">

                        @foreach($cart->items as $item)

                            @php
                                $itemTotal = (float) $item->price * (int) $item->quantity;
                                $stock = (int) ($item->product?->stock ?? 999999);
                            @endphp


                            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:border-emerald-100 hover:shadow-md">

                                <div class="p-4 sm:p-5">

                                    <div class="flex gap-4">


                                        {{-- PRODUCT IMAGE --}}
                                        <a
                                            href="{{ $item->product ? route('product.show', $item->product->slug) : '#' }}"
                                            class="group flex h-24 w-24 shrink-0 items-center justify-center overflow-hidden rounded-2xl bg-slate-50 sm:h-32 sm:w-32"
                                        >

                                            @if($item->product && $item->product->image)

                                                <img
                                                    src="{{ asset('images/' . ltrim($item->product->image, '/')) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="h-full w-full object-contain p-2 transition duration-300 group-hover:scale-105"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';"
                                                >

                                            @else

                                                <img
                                                    src="{{ asset('images/products/product-placeholder.png') }}"
                                                    alt="Product"
                                                    class="h-20 w-20 object-contain"
                                                >

                                            @endif

                                        </a>


                                        {{-- DETAILS --}}
                                        <div class="min-w-0 flex-1">

                                            <div class="flex items-start justify-between gap-3">

                                                <div class="min-w-0">

                                                    @if($item->product)

                                                        <a
                                                            href="{{ route('product.show', $item->product->slug) }}"
                                                            class="block truncate text-base font-bold text-slate-900 hover:text-emerald-700 sm:text-lg"
                                                        >
                                                            {{ $item->product->name }}
                                                        </a>

                                                    @else

                                                        <p class="font-bold">
                                                            Product Unavailable
                                                        </p>

                                                    @endif


                                                    @if($item->product?->category)

                                                        <p class="mt-1 text-xs font-medium text-slate-500">
                                                            {{ $item->product->category->name }}
                                                        </p>

                                                    @endif

                                                </div>


                                                {{-- REMOVE --}}
                                                <form
                                                    action="{{ route('cart.remove', $item->id) }}"
                                                    method="POST"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 hover:bg-red-50 hover:text-red-600"
                                                        title="Remove"
                                                    >
                                                        ✕
                                                    </button>

                                                </form>

                                            </div>


                                            {{-- PRICE --}}
                                            <div class="mt-3 flex items-end gap-2">

                                                <span class="text-lg font-black text-emerald-700">
                                                    ₹{{ number_format($item->price, 2) }}
                                                </span>

                                                <span class="pb-0.5 text-xs text-slate-400">
                                                    per item
                                                </span>

                                            </div>


                                            {{-- UPDATE FORM --}}
                                            <form
                                                action="{{ route('cart.update', $item->id) }}"
                                                method="POST"
                                                class="mt-4 flex flex-wrap items-center gap-2"
                                            >

                                                @csrf
                                                @method('PUT')


                                                <span class="text-xs font-bold text-slate-500">
                                                    Qty
                                                </span>


                                                {{-- MINUS --}}
                                                <button
                                                    type="button"
                                                    onclick="changeQty({{ $item->id }}, -1)"
                                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-lg font-bold hover:bg-slate-50"
                                                >
                                                    −
                                                </button>


                                                {{-- QUANTITY --}}
                                                <input
                                                    id="qty-{{ $item->id }}"
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item->quantity }}"
                                                    min="1"
                                                    max="{{ $stock }}"
                                                    required
                                                    class="h-10 w-16 rounded-xl border border-slate-200 bg-white text-center font-bold outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100"
                                                >


                                                {{-- PLUS --}}
                                                <button
                                                    type="button"
                                                    onclick="changeQty({{ $item->id }}, 1)"
                                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-lg font-bold hover:bg-slate-50"
                                                >
                                                    +
                                                </button>


                                                {{-- UPDATE --}}
                                                <button
                                                    type="submit"
                                                    class="h-10 rounded-xl bg-slate-900 px-5 text-xs font-bold text-white transition hover:bg-emerald-700"
                                                >
                                                    Update
                                                </button>

                                            </form>


                                            <p class="mt-2 text-xs text-slate-400">
                                                Available stock: {{ $stock }}
                                            </p>

                                        </div>

                                    </div>


                                    {{-- ITEM TOTAL --}}
                                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-4">

                                        <span class="text-sm text-slate-500">
                                            Item Total
                                        </span>

                                        <span class="text-lg font-black text-slate-950">
                                            ₹{{ number_format($itemTotal, 2) }}
                                        </span>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                </section>


                {{-- SUMMARY --}}
                <aside>

                    <div class="sticky top-28 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                        <p class="text-xs font-bold uppercase tracking-widest text-emerald-600">
                            Checkout
                        </p>

                        <h2 class="mt-1 text-xl font-black text-slate-950">
                            Order Summary
                        </h2>


                        <div class="mt-6 space-y-4">

                            <div class="flex justify-between text-sm">

                                <span class="text-slate-500">
                                    Items ({{ $itemCount }})
                                </span>

                                <span class="font-bold">
                                    ₹{{ number_format($total, 2) }}
                                </span>

                            </div>


                            <div class="flex justify-between text-sm">

                                <span class="text-slate-500">
                                    Subtotal
                                </span>

                                <span class="font-bold">
                                    ₹{{ number_format($total, 2) }}
                                </span>

                            </div>


                            <div class="flex justify-between text-sm">

                                <span class="text-slate-500">
                                    Delivery
                                </span>

                                <span class="font-bold text-emerald-600">
                                    FREE
                                </span>

                            </div>

                        </div>


                        <div class="mt-6 border-t border-slate-200 pt-5">

                            <div class="flex items-center justify-between">

                                <span class="font-bold">
                                    Total Amount
                                </span>

                                <span class="text-2xl font-black">
                                    ₹{{ number_format($total, 2) }}
                                </span>

                            </div>

                        </div>


                        <a
                            href="{{ route('checkout.index') }}"
                            class="mt-6 flex h-12 w-full items-center justify-center rounded-xl bg-emerald-600 font-bold text-white hover:bg-emerald-700"
                        >
                            Proceed to Checkout →
                        </a>

                    </div>

                </aside>

            </div>


            {{-- CONTINUE SHOPPING --}}
            <div class="mt-6">

                <a
                    href="{{ route('home') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-600 hover:bg-emerald-50 hover:text-emerald-700"
                >
                    ← Continue Shopping
                </a>

            </div>


            {{-- MOBILE CHECKOUT --}}
            <div class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-200 bg-white/95 px-4 py-3 shadow-xl backdrop-blur-xl lg:hidden">

                <div class="mx-auto flex max-w-lg items-center gap-3">

                    <div class="flex-1">

                        <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                            Total
                        </p>

                        <p class="text-lg font-black">
                            ₹{{ number_format($total, 2) }}
                        </p>

                    </div>


                    <a
                        href="{{ route('checkout.index') }}"
                        class="flex h-11 items-center justify-center rounded-xl bg-emerald-600 px-5 text-sm font-bold text-white"
                    >
                        Checkout →
                    </a>

                </div>

            </div>


        @else

            {{-- EMPTY CART --}}
            <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="px-6 py-16 text-center sm:px-10 sm:py-20">

                    <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-emerald-50">

                        <img
                            src="{{ asset('images/icons/cart.png') }}"
                            alt="Empty Cart"
                            class="h-12 w-12 object-contain"
                        >

                    </div>


                    <h2 class="mt-6 text-2xl font-black text-slate-950 sm:text-3xl">
                        Your Cart is Empty
                    </h2>


                    <p class="mx-auto mt-3 max-w-lg text-sm leading-6 text-slate-500">
                        Discover fresh groceries, local favourites and everyday essentials from trusted local sellers.
                    </p>


                    <a
                        href="{{ route('home') }}"
                        class="mt-7 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-6 py-3.5 text-sm font-bold text-white hover:bg-emerald-700"
                    >
                        Start Shopping →
                    </a>

                </div>

            </section>

        @endif

    </main>


    {{-- FOOTER --}}
    <footer class="border-t border-slate-200 bg-slate-950 text-white">

        <div class="mx-auto max-w-7xl px-4 py-6 text-center sm:px-6 lg:px-8">

            <p class="text-xs text-slate-500 sm:text-sm">
                © {{ date('Y') }} Apna Local Bazaar. All rights reserved.
            </p>

        </div>

    </footer>


    {{-- QUANTITY JS --}}
    <script>

        function changeQty(id, change) {

            const input = document.getElementById('qty-' + id);

            if (!input) {
                return;
            }

            let value = parseInt(input.value, 10) || 1;

            const min = parseInt(input.min, 10) || 1;

            const max = parseInt(input.max, 10) || 999999;

            value = value + change;

            if (value < min) {
                value = min;
            }

            if (value > max) {
                value = max;
            }

            input.value = value;
        }

    </script>

</body>
</html>