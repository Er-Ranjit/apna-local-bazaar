<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Product - Apna Local Bazaar</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>


<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">


    {{-- =========================================================
        DESKTOP SIDEBAR
    ========================================================== --}}
    <aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">

        <div class="flex h-full flex-col">


            {{-- BRAND --}}
            <div class="flex h-20 items-center border-b border-slate-100 px-6">

                <a
                    href="{{ route('vendor.dashboard') }}"
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
                            Vendor Panel
                        </p>

                    </div>

                </a>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">


                <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">
                    Store Management
                </p>


                <a
                    href="{{ route('vendor.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📊
                    </span>

                    Dashboard

                </a>


                {{-- ACTIVE --}}
                <a
                    href="{{ route('vendor.products.create') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        ➕
                    </span>

                    Add Product

                </a>


                <a
                    href="{{ route('vendor.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🛒
                    </span>

                    Orders

                </a>


            </nav>


            {{-- BOTTOM --}}
            <div class="border-t border-slate-100 p-4">


                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    ← Back to Store

                </a>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="mt-2"
                >

                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-red-600 transition hover:bg-red-50"
                    >

                        ↪ Logout

                    </button>

                </form>

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
                        Vendor Panel
                    </p>

                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                        Add Product
                    </h1>

                </div>


                <a
                    href="{{ route('vendor.dashboard') }}"
                    class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-bold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:px-4 sm:text-sm"
                >
                    ← Dashboard
                </a>

            </div>

        </header>


        {{-- =========================================================
            CONTENT
        ========================================================== --}}
        <main class="mx-auto max-w-6xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">


            {{-- INTRO --}}
            <section class="mb-6 rounded-3xl bg-slate-900 p-6 shadow-sm sm:p-8">


                <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300">
                    Product Catalog
                </span>


                <h2 class="mt-4 text-2xl font-black text-white sm:text-3xl">
                    Add a new product
                </h2>


                <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-300">
                    Add complete product information, pricing, stock and a product image.
                    Your product will be added to your store catalog.
                </p>

            </section>


            {{-- VALIDATION ERRORS --}}
            @if ($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

                    <div class="flex gap-3">

                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100">
                            ⚠️
                        </div>


                        <div>

                            <p class="font-black text-red-800">
                                Please fix the following errors
                            </p>


                            <ul class="mt-2 space-y-1 text-sm text-red-700">

                                @foreach ($errors->all() as $error)

                                    <li class="flex gap-2">
                                        <span>•</span>
                                        <span>{{ $error }}</span>
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- FORM --}}
            <form
                action="{{ route('vendor.products.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div class="grid gap-6 xl:grid-cols-[1.6fr_0.9fr]">


                    {{-- =================================================
                        LEFT FORM
                    ================================================== --}}
                    <section class="rounded-3xl border border-slate-200 bg-white shadow-sm">


                        {{-- BASIC INFO --}}
                        <div class="border-b border-slate-100 p-5 sm:p-6">


                            <div class="mb-5">

                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                                    Step 1
                                </p>

                                <h3 class="mt-1 text-lg font-black text-slate-950">
                                    Basic Information
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    Enter the main details customers will see.
                                </p>

                            </div>


                            {{-- PRODUCT NAME --}}
                            <div>

                                <label
                                    for="name"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Product Name
                                    <span class="text-red-500">*</span>
                                </label>


                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="e.g. Paneer Roll"
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-medium text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >

                            </div>


                            {{-- CATEGORY --}}
                            <div class="mt-5">

                                <label
                                    for="category_id"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Category
                                    <span class="text-red-500">*</span>
                                </label>


                                <select
                                    id="category_id"
                                    name="category_id"
                                    required
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-medium text-slate-800 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >

                                    <option value="">
                                        Select Category
                                    </option>


                                    @foreach ($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- DESCRIPTION --}}
                            <div class="mt-5">

                                <label
                                    for="description"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Description
                                </label>


                                <textarea
                                    id="description"
                                    name="description"
                                    rows="6"
                                    placeholder="Write a clear description of your product..."
                                    class="w-full resize-y rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium leading-6 text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >{{ old('description') }}</textarea>


                                <p class="mt-2 text-xs text-slate-400">
                                    Keep the description simple and useful for customers.
                                </p>

                            </div>

                        </div>


                        {{-- PRICING --}}
                        <div class="border-b border-slate-100 p-5 sm:p-6">


                            <div class="mb-5">

                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                                    Step 2
                                </p>

                                <h3 class="mt-1 text-lg font-black text-slate-950">
                                    Pricing
                                </h3>

                            </div>


                            <div class="grid gap-5 sm:grid-cols-2">


                                {{-- PRICE --}}
                                <div>

                                    <label
                                        for="price"
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                    >
                                        Price
                                        <span class="text-red-500">*</span>
                                    </label>


                                    <div class="relative">

                                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400">
                                            ₹
                                        </span>


                                        <input
                                            id="price"
                                            type="number"
                                            name="price"
                                            value="{{ old('price') }}"
                                            step="0.01"
                                            min="0"
                                            required
                                            placeholder="0.00"
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm font-bold text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                        >

                                    </div>

                                </div>


                                {{-- DISCOUNT PRICE --}}
                                <div>

                                    <label
                                        for="discount_price"
                                        class="mb-2 block text-sm font-bold text-slate-700"
                                    >
                                        Discount Price
                                    </label>


                                    <div class="relative">

                                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 font-bold text-emerald-500">
                                            ₹
                                        </span>


                                        <input
                                            id="discount_price"
                                            type="number"
                                            name="discount_price"
                                            value="{{ old('discount_price') }}"
                                            step="0.01"
                                            min="0"
                                            placeholder="Optional"
                                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 pl-10 pr-4 text-sm font-bold text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                        >

                                    </div>


                                    <p class="mt-2 text-xs text-slate-400">
                                        Leave empty when there is no discount.
                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- STOCK --}}
                        <div class="p-5 sm:p-6">


                            <div class="mb-5">

                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                                    Step 3
                                </p>

                                <h3 class="mt-1 text-lg font-black text-slate-950">
                                    Inventory
                                </h3>

                            </div>


                            <div class="max-w-sm">

                                <label
                                    for="stock"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Available Stock
                                    <span class="text-red-500">*</span>
                                </label>


                                <input
                                    id="stock"
                                    type="number"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    min="0"
                                    required
                                    class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm font-bold text-slate-800 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >


                                <p class="mt-2 text-xs leading-5 text-slate-400">
                                    Set the number of items currently available for sale.
                                </p>

                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                        RIGHT SIDE
                    ================================================== --}}
                    <div class="space-y-6">


                        {{-- IMAGE UPLOAD --}}
                        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                                    Product Image
                                </p>

                                <h3 class="mt-1 text-lg font-black text-slate-950">
                                    Add a visual
                                </h3>

                                <p class="mt-1 text-sm leading-6 text-slate-500">
                                    A clear product image helps customers understand what they are buying.
                                </p>

                            </div>


                            {{-- PREVIEW --}}
                            <div
                                id="imagePreviewContainer"
                                class="mt-5 hidden overflow-hidden rounded-2xl border border-slate-200 bg-slate-50"
                            >

                                <img
                                    id="imagePreview"
                                    src=""
                                    alt="Product Preview"
                                    class="h-64 w-full object-contain p-3"
                                >

                            </div>


                            {{-- UPLOAD --}}
                            <label
                                for="image"
                                class="mt-5 flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 px-5 py-10 text-center transition hover:border-emerald-300 hover:bg-emerald-50/50"
                            >


                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-2xl shadow-sm">
                                    📷
                                </div>


                                <p class="mt-4 text-sm font-black text-slate-800">
                                    Upload Product Image
                                </p>


                                <p class="mt-1 text-xs text-slate-400">
                                    PNG, JPG, JPEG, WEBP
                                </p>


                                <span
                                    id="selectedFileName"
                                    class="mt-3 hidden max-w-full truncate rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700"
                                ></span>


                                <input
                                    id="image"
                                    type="file"
                                    name="image"
                                    accept="image/*"
                                    class="hidden"
                                >

                            </label>


                        </section>


                        {{-- PUBLISH CARD --}}
                        <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">


                            <div class="flex items-start gap-3">


                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-xl">
                                    ✅
                                </div>


                                <div>

                                    <h3 class="font-black text-slate-900">
                                        Ready to publish?
                                    </h3>

                                    <p class="mt-1 text-sm leading-6 text-slate-500">
                                        Check your product details before adding it to your store.
                                    </p>

                                </div>

                            </div>


                            <div class="mt-5 space-y-3">


                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-center rounded-xl bg-emerald-600 px-5 py-3.5 text-sm font-black text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                                >
                                    Add Product
                                </button>


                                <a
                                    href="{{ route('vendor.dashboard') }}"
                                    class="flex w-full items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-bold text-slate-600 transition hover:bg-slate-50"
                                >
                                    Cancel
                                </a>

                            </div>

                        </section>


                        {{-- TIPS --}}
                        <section class="rounded-3xl bg-slate-900 p-5 text-white shadow-sm sm:p-6">


                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-400">
                                Quick Tips
                            </p>


                            <div class="mt-4 space-y-4">


                                <div class="flex gap-3">

                                    <span class="text-emerald-400">
                                        ✓
                                    </span>

                                    <p class="text-sm leading-6 text-slate-300">
                                        Use a simple and recognizable product name.
                                    </p>

                                </div>


                                <div class="flex gap-3">

                                    <span class="text-emerald-400">
                                        ✓
                                    </span>

                                    <p class="text-sm leading-6 text-slate-300">
                                        Keep your stock quantity updated.
                                    </p>

                                </div>


                                <div class="flex gap-3">

                                    <span class="text-emerald-400">
                                        ✓
                                    </span>

                                    <p class="text-sm leading-6 text-slate-300">
                                        Use a clear image with good visibility.
                                    </p>

                                </div>


                            </div>

                        </section>

                    </div>

                </div>

            </form>


            {{-- FOOTER --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">

                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Add Product
                    </p>

                </div>

            </footer>


        </main>

    </div>


    {{-- =========================================================
        IMAGE PREVIEW
    ========================================================== --}}
    <script>

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const selectedFileName = document.getElementById('selectedFileName');

        imageInput.addEventListener('change', function () {

            const file = this.files[0];

            if (!file) {
                imagePreviewContainer.classList.add('hidden');
                selectedFileName.classList.add('hidden');
                return;
            }

            selectedFileName.textContent = file.name;
            selectedFileName.classList.remove('hidden');

            const reader = new FileReader();

            reader.onload = function (event) {

                imagePreview.src = event.target.result;

                imagePreviewContainer.classList.remove('hidden');

            };

            reader.readAsDataURL(file);

        });

    </script>


</body>
</html>