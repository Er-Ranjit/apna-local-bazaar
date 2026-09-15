<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management - Apna Local Bazaar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">

<aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">
    <div class="flex h-full flex-col">
        <div class="flex h-20 items-center border-b border-slate-100 px-6">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Apna Local Bazaar" class="h-11 w-auto">
                <div>
                    <p class="text-sm font-black text-slate-950">Apna Local Bazaar</p>
                    <p class="text-xs text-slate-400">Admin Panel</p>
                </div>
            </a>
        </div>

        <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">
            <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">Management</p>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">📊</span>
                Dashboard
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">👥</span>
                Users
            </a>

            <a href="{{ route('admin.vendors.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">🏪</span>
                Vendors
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">📦</span>
                Products
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">🛒</span>
                Orders
            </a>

            <a href="{{ route('admin.delivery-assignments.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">🚚</span>
                Delivery Assignments
            </a>
        </nav>

        <div class="border-t border-slate-100 p-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900">
                ← Back to Store
            </a>
        </div>
    </div>
</aside>

<div class="lg:pl-72">
    <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-xl">
        <div class="flex min-h-[72px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
            <div>
                <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">Admin Panel</p>
                <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">Products Management</h1>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('admin.dashboard') }}" class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:inline-flex">← Dashboard</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="rounded-xl border border-red-100 bg-red-50 px-3 py-2.5 text-xs font-bold text-red-600 transition hover:bg-red-100 sm:px-4">Logout</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

        @if(session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">✓</span>
                    <p class="text-sm font-bold text-emerald-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 shadow-sm">
                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">!</span>
                    <p class="text-sm font-bold text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <section class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700">Product Catalog</span>
                    <h2 class="mt-3 text-2xl font-black text-slate-950 sm:text-3xl">All Products</h2>
                    <p class="mt-2 text-sm text-slate-500">Manage product visibility, availability, stock and vendor listings.</p>
                </div>

                <div class="flex items-center gap-4 rounded-2xl bg-slate-50 px-5 py-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-2xl">📦</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Results</p>
                        <p class="mt-1 text-2xl font-black text-slate-950">{{ $products->count() }}</p>
                    </div>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.products.index') }}" class="mt-6">
                <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_190px_190px_auto]">
                    <div class="relative">
                        <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">🔍</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product, vendor or category..." class="h-12 w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 text-sm font-medium text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                    </div>

                    <select name="stock" class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                        <option value="">All Stock</option>
                        <option value="in_stock" {{ request('stock') === 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="low_stock" {{ request('stock') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out_of_stock" {{ request('stock') === 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>

                    <select name="status" class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active & Available</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive / Unavailable</option>
                    </select>

                    <button type="submit" class="h-12 rounded-xl bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]">Search Products</button>
                </div>

                @if(request()->filled('search') || request()->filled('stock') || request()->filled('status'))
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <span class="text-xs font-semibold text-slate-400">Active filters:</span>
                        @if(request()->filled('search'))
                            <span class="rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">Search: {{ request('search') }}</span>
                        @endif
                        @if(request()->filled('stock'))
                            <span class="rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700">Stock: {{ ucwords(str_replace('_', ' ', request('stock'))) }}</span>
                        @endif
                        @if(request()->filled('status'))
                            <span class="rounded-full bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">Status: {{ request('status') === 'active' ? 'Active & Available' : 'Inactive / Unavailable' }}</span>
                        @endif
                        <a href="{{ route('admin.products.index') }}" class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-100">Clear Filters ✕</a>
                    </div>
                @endif
            </form>
        </section>

        @if($products->count() > 0)
            <div class="hidden overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:block">
                <div class="border-b border-slate-100 px-6 py-5">
                    <h3 class="text-lg font-black text-slate-950">Registered Products</h3>
                    <p class="mt-1 text-sm text-slate-500">{{ $products->count() }} matching products found.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1250px]">
                        <thead class="bg-slate-50">
                            <tr class="border-b border-slate-200 text-left">
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Product</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Vendor</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Category</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Price</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Stock</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Status</th>
                                <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach($products as $product)
                                @php
                                    $image = !empty($product->image)
                                        ? asset('storage/' . ltrim($product->image, '/'))
                                        : asset('images/products/product-placeholder.png');
                                @endphp

                                <tr class="transition hover:bg-slate-50">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-14 w-14 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                                <img src="{{ $image }}" alt="{{ $product->name }}" class="h-full w-full object-contain p-1" onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';">
                                            </div>
                                            <div class="min-w-0">
                                                <p class="max-w-[220px] truncate font-bold text-slate-900">{{ $product->name }}</p>
                                                <p class="mt-1 text-xs text-slate-400">Product #{{ $product->id }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <p class="font-semibold text-slate-700">{{ $product->vendor->shop_name ?? 'N/A' }}</p>
                                    </td>

                                    <td class="px-6 py-5">
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-600">{{ $product->category->name ?? 'N/A' }}</span>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div>
                                            <p class="font-black text-emerald-700">₹{{ number_format($product->discount_price ?? $product->price, 2) }}</p>
                                            @if($product->discount_price && $product->discount_price < $product->price)
                                                <p class="text-xs text-slate-400 line-through">₹{{ number_format($product->price, 2) }}</p>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        @if($product->stock <= 0)
                                            <span class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-red-200">Out of Stock</span>
                                        @elseif($product->stock <= 5)
                                            <span class="rounded-full bg-amber-50 px-3 py-1.5 text-xs font-bold text-amber-700 ring-1 ring-amber-200">{{ $product->stock }} Low</span>
                                        @else
                                            <span class="rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">{{ $product->stock }} In Stock</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex flex-col items-start gap-2">
                                            @if($product->is_active)
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Active
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-red-200">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span> Inactive
                                                </span>
                                            @endif

                                            @if($product->is_available)
                                                <span class="rounded-full bg-blue-50 px-3 py-1.5 text-[11px] font-bold text-blue-700">Available</span>
                                            @else
                                                <span class="rounded-full bg-slate-100 px-3 py-1.5 text-[11px] font-bold text-slate-600">Unavailable</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-2">
                                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST" onsubmit="return confirm('{{ $product->is_active ? 'Deactivate this product?' : 'Activate this product?' }}')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="w-full rounded-xl px-3 py-2 text-xs font-bold transition {{ $product->is_active ? 'bg-red-50 text-red-600 ring-1 ring-red-200 hover:bg-red-100' : 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100' }}">
                                                    {{ $product->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.products.availability', $product) }}" method="POST" onsubmit="return confirm('{{ $product->is_available ? 'Mark this product unavailable?' : 'Make this product available?' }}')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="w-full rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold text-slate-700 transition hover:bg-slate-200">
                                                    {{ $product->is_available ? 'Unavailable' : 'Available' }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-4 md:hidden">
                @foreach($products as $product)
                    @php
                        $image = !empty($product->image)
                            ? asset('storage/' . ltrim($product->image, '/'))
                            : asset('images/products/product-placeholder.png');
                    @endphp

                    <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <div class="flex items-start gap-3">
                            <div class="flex h-16 w-16 shrink-0 items-center justify-center overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                <img src="{{ $image }}" alt="{{ $product->name }}" class="h-full w-full object-contain p-1" onerror="this.onerror=null;this.src='{{ asset('images/products/product-placeholder.png') }}';">
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="truncate font-black text-slate-900">{{ $product->name }}</h3>
                                <p class="mt-1 text-xs text-slate-400">Product #{{ $product->id }}</p>
                                <p class="mt-2 font-black text-emerald-700">₹{{ number_format($product->discount_price ?? $product->price, 2) }}</p>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-3">
                            <div class="rounded-xl bg-slate-50 p-3">
                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Vendor</p>
                                <p class="mt-1 truncate text-sm font-bold text-slate-700">{{ $product->vendor->shop_name ?? 'N/A' }}</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3">
                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Category</p>
                                <p class="mt-1 truncate text-sm font-bold text-slate-700">{{ $product->category->name ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <div class="rounded-xl bg-slate-50 p-3">
                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Stock</p>
                                @if($product->stock <= 0)
                                    <p class="mt-1 text-sm font-bold text-red-600">Out of Stock</p>
                                @elseif($product->stock <= 5)
                                    <p class="mt-1 text-sm font-bold text-amber-600">{{ $product->stock }} Low</p>
                                @else
                                    <p class="mt-1 text-sm font-bold text-emerald-700">{{ $product->stock }} In Stock</p>
                                @endif
                            </div>

                            <div class="rounded-xl bg-slate-50 p-3">
                                <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">Status</p>
                                <p class="mt-1 text-sm font-bold {{ $product->is_active ? 'text-emerald-700' : 'text-red-600' }}">{{ $product->is_active ? 'Active' : 'Inactive' }}</p>
                                <p class="mt-0.5 text-xs font-semibold {{ $product->is_available ? 'text-blue-700' : 'text-slate-500' }}">{{ $product->is_available ? 'Available' : 'Unavailable' }}</p>
                            </div>
                        </div>

                        <div class="mt-4 grid gap-2 sm:grid-cols-2">
                            <form action="{{ route('admin.products.toggle', $product) }}" method="POST" onsubmit="return confirm('{{ $product->is_active ? 'Deactivate this product?' : 'Activate this product?' }}')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="flex w-full items-center justify-center rounded-xl px-4 py-3 text-sm font-bold transition {{ $product->is_active ? 'bg-red-50 text-red-600 ring-1 ring-red-200 hover:bg-red-100' : 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100' }}">
                                    {{ $product->is_active ? 'Deactivate Product' : 'Activate Product' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.products.availability', $product) }}" method="POST" onsubmit="return confirm('{{ $product->is_available ? 'Mark this product unavailable?' : 'Make this product available?' }}')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="flex w-full items-center justify-center rounded-xl bg-slate-100 px-4 py-3 text-sm font-bold text-slate-700 transition hover:bg-slate-200">
                                    {{ $product->is_available ? 'Mark Unavailable' : 'Mark Available' }}
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-blue-50 text-4xl">🔍</div>
                <h2 class="mt-6 text-2xl font-black text-slate-950">No Products Found</h2>
                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">No product matched your current search, stock or status filter.</p>
                <a href="{{ route('admin.products.index') }}" class="mt-6 inline-flex rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-700">Clear Filters</a>
            </div>
        @endif

        <footer class="mt-8 border-t border-slate-200 pt-6">
            <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">
                <p>© {{ date('Y') }} Apna Local Bazaar</p>
                <p>Products Management</p>
            </div>
        </footer>
    </main>
</div>
</body>
</html>
