<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Product - Vendor Panel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="hidden lg:flex lg:w-64 bg-white border-r border-slate-200 fixed inset-y-0 left-0 z-30 flex-col">

            {{-- Logo --}}
            <div class="h-20 px-5 flex items-center border-b border-slate-100">
                <a href="{{ route('vendor.dashboard') }}" class="flex items-center gap-3">
                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Apna Local Bazaar"
                        class="h-11 w-auto object-contain"
                    >

                    <div>
                        <div class="font-bold text-sm text-slate-900">
                            Apna Local
                        </div>
                        <div class="font-bold text-sm text-slate-900">
                            Bazaar
                        </div>
                        <div class="text-[10px] text-slate-400">
                            Vendor Panel
                        </div>
                    </div>
                </a>
            </div>

            {{-- Menu --}}
            <div class="px-4 py-5">
                <p class="text-[10px] font-bold uppercase tracking-[0.16em] text-slate-400 px-3 mb-3">
                    Store Management
                </p>

                <nav class="space-y-1">

                    <a
                        href="{{ route('vendor.dashboard') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                    >
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            🏠
                        </span>
                        Dashboard
                    </a>

                    <a
                        href="{{ route('vendor.products.create') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                    >
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            ➕
                        </span>
                        Add Product
                    </a>

                    <a
                        href="{{ route('vendor.orders.index') }}"
                        class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition"
                    >
                        <span class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            📦
                        </span>
                        Orders
                    </a>

                </nav>
            </div>

            <div class="mt-auto p-4 border-t border-slate-100 space-y-2">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2.5 text-sm text-slate-500 hover:text-slate-900 transition"
                >
                    ← Back to Store
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition"
                    >
                        ↪ Logout
                    </button>
                </form>

            </div>

        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 lg:ml-64">

            {{-- HEADER --}}
            <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-5 sm:px-8">

                <div>
                    <p class="text-[11px] font-bold uppercase tracking-[0.18em] text-emerald-600">
                        Vendor Panel
                    </p>

                    <h1 class="text-lg sm:text-xl font-bold text-slate-900">
                        Edit Product
                    </h1>
                </div>

                <div class="flex items-center gap-3">

                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold text-slate-800">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-[11px] text-slate-400">
                            Vendor
                        </p>
                    </div>

                    <div class="h-10 w-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                </div>

            </header>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">

                {{-- INTRO --}}
                <div class="relative overflow-hidden rounded-3xl bg-slate-950 text-white p-6 sm:p-8 mb-6">

                    <div class="absolute -right-16 -top-16 w-56 h-56 rounded-full border border-emerald-400/20"></div>
                    <div class="absolute right-10 -bottom-16 w-40 h-40 rounded-full border border-emerald-400/10"></div>

                    <div class="relative">

                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-300 text-[10px] font-bold uppercase tracking-wider mb-3">
                            Product Management
                        </span>

                        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight">
                            Update Your Product
                        </h2>

                        <p class="mt-2 text-sm text-slate-300 max-w-2xl">
                            Modify product information, pricing, inventory and image details.
                        </p>

                    </div>
                </div>

                {{-- ERRORS --}}
                @if ($errors->any())
                    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="h-9 w-9 rounded-xl bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                !
                            </div>

                            <div>
                                <h3 class="font-semibold text-red-800">
                                    Please fix the following errors
                                </h3>

                                <ul class="mt-2 space-y-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>

                    </div>
                @endif

                {{-- FORM --}}
                <form
                    action="{{ route('vendor.products.update', $product->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >

                    @csrf
                    @method('PUT')

                    {{-- PRODUCT INFORMATION --}}
                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="px-5 sm:px-6 py-5 border-b border-slate-100">
                            <div class="flex items-center gap-3">

                                <div class="h-10 w-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    🛍️
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        Product Information
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Update the basic details of your product.
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="p-5 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAME --}}
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Product Name
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                    placeholder="Enter product name"
                                >

                            </div>

                            {{-- CATEGORY --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Category
                                </label>

                                <select
                                    name="category_id"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                >

                                    <option value="">
                                        Select Category
                                    </option>

                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- STOCK --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Stock Quantity
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    value="{{ old('stock', $product->stock) }}"
                                    min="0"
                                    required
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                    placeholder="0"
                                >

                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="md:col-span-2">

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Description
                                </label>

                                <textarea
                                    name="description"
                                    rows="5"
                                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm outline-none resize-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                    placeholder="Describe your product..."
                                >{{ old('description', $product->description) }}</textarea>

                            </div>

                        </div>

                    </section>

                    {{-- PRICING --}}
                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="px-5 sm:px-6 py-5 border-b border-slate-100">

                            <div class="flex items-center gap-3">

                                <div class="h-10 w-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                                    ₹
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        Pricing
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Update your selling and discount prices.
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="p-5 sm:p-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- PRICE --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Regular Price
                                </label>

                                <div class="relative">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-semibold">
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        step="0.01"
                                        min="0"
                                        required
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                        placeholder="0.00"
                                    >

                                </div>

                            </div>

                            {{-- DISCOUNT --}}
                            <div>

                                <label class="block text-sm font-semibold text-slate-700 mb-2">
                                    Discount Price
                                </label>

                                <div class="relative">

                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-semibold">
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        name="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}"
                                        step="0.01"
                                        min="0"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50 pl-9 pr-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 transition"
                                        placeholder="Optional"
                                    >

                                </div>

                                <p class="mt-2 text-xs text-slate-400">
                                    Leave empty if there is no discount.
                                </p>

                            </div>

                        </div>

                    </section>

                    {{-- IMAGE --}}
                    <section class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">

                        <div class="px-5 sm:px-6 py-5 border-b border-slate-100">

                            <div class="flex items-center gap-3">

                                <div class="h-10 w-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center">
                                    🖼️
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-900">
                                        Product Image
                                    </h3>

                                    <p class="text-xs text-slate-400 mt-0.5">
                                        Keep the current image or upload a new one.
                                    </p>
                                </div>

                            </div>

                        </div>

                        <div class="p-5 sm:p-6">

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                                {{-- CURRENT IMAGE --}}
                                <div>

                                    <p class="text-sm font-semibold text-slate-700 mb-3">
                                        Current Image
                                    </p>

                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 flex items-center justify-center min-h-[260px]">

                                        @if ($product->image)

                                            <img
                                                src="{{ asset('storage/' . ltrim($product->image, '/')) }}"
                                                alt="{{ $product->name }}"
                                                class="max-h-56 max-w-full object-contain rounded-xl"
                                            >

                                        @else

                                            <div class="text-center text-slate-400">

                                                <div class="text-4xl mb-2">
                                                    🖼️
                                                </div>

                                                <p class="text-sm">
                                                    No image available
                                                </p>

                                            </div>

                                        @endif

                                    </div>

                                </div>

                                {{-- NEW IMAGE --}}
                                <div>

                                    <p class="text-sm font-semibold text-slate-700 mb-3">
                                        New Product Image
                                    </p>

                                    <label
                                        for="image"
                                        class="group block rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/30 transition"
                                    >

                                        <div class="text-center">

                                            <div class="mx-auto h-14 w-14 rounded-2xl bg-white shadow-sm flex items-center justify-center text-2xl">
                                                📷
                                            </div>

                                            <h4 class="mt-4 font-semibold text-slate-800">
                                                Upload New Image
                                            </h4>

                                            <p class="mt-1 text-xs text-slate-400">
                                                PNG, JPG, JPEG or WEBP
                                            </p>

                                            <span class="inline-flex mt-4 px-4 py-2 rounded-xl bg-slate-900 text-white text-xs font-semibold group-hover:bg-emerald-600 transition">
                                                Choose Image
                                            </span>

                                        </div>

                                        <input
                                            id="image"
                                            type="file"
                                            name="image"
                                            accept="image/*"
                                            class="hidden"
                                        >

                                    </label>

                                    {{-- PREVIEW --}}
                                    <div id="imagePreviewWrapper" class="hidden mt-4">

                                        <p class="text-xs font-semibold text-slate-500 mb-2">
                                            New Image Preview
                                        </p>

                                        <div class="rounded-2xl border border-slate-200 bg-white p-3">

                                            <img
                                                id="imagePreview"
                                                src="#"
                                                alt="New product preview"
                                                class="w-full max-h-56 object-contain rounded-xl"
                                            >

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                    {{-- ACTIONS --}}
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-5 sm:p-6">

                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">

                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    Ready to save changes?
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Your updated product information will be saved immediately.
                                </p>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3">

                                <a
                                    href="{{ route('vendor.dashboard') }}"
                                    class="inline-flex items-center justify-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-700 hover:bg-slate-50 transition"
                                >
                                    Cancel
                                </a>

                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 shadow-sm shadow-emerald-600/20 transition"
                                >
                                    ✓ Update Product
                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </main>

    </div>

    {{-- IMAGE PREVIEW SCRIPT --}}
    <script>
        const imageInput = document.getElementById('image');
        const imagePreviewWrapper = document.getElementById('imagePreviewWrapper');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                imagePreviewWrapper.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            if (!file.type.startsWith('image/')) {
                imagePreviewWrapper.classList.add('hidden');
                imagePreview.src = '#';
                return;
            }

            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreviewWrapper.classList.remove('hidden');
            };

            reader.readAsDataURL(file);
        });
    </script>

</body>
</html>