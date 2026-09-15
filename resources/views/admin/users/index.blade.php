<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users Management - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">


    {{-- =========================================================
        SIDEBAR
    ========================================================== --}}
    <aside class="fixed inset-y-0 left-0 z-50 hidden w-72 border-r border-slate-200 bg-white lg:block">

        <div class="flex h-full flex-col">

            {{-- BRAND --}}
            <div class="flex h-20 items-center border-b border-slate-100 px-6">

                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">

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
                            Admin Panel
                        </p>

                    </div>

                </a>

            </div>


            {{-- NAVIGATION --}}
            <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">

                <p class="px-3 pb-2 text-[10px] font-black uppercase tracking-[0.18em] text-slate-400">
                    Management
                </p>


                {{-- Dashboard --}}
                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📊
                    </span>

                    Dashboard
                </a>


                {{-- ACTIVE USERS --}}
                <a
                    href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        👥
                    </span>

                    Users
                </a>


                {{-- Vendors --}}
                <a
                    href="{{ route('admin.vendors.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🏪
                    </span>

                    Vendors
                </a>


                {{-- Products --}}
                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        📦
                    </span>

                    Products
                </a>


                {{-- Orders --}}
                <a
                    href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🛒
                    </span>

                    Orders
                </a>


                {{-- Delivery --}}
                <a
                    href="{{ route('admin.delivery-assignments.index') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
                        🚚
                    </span>

                    Delivery Assignments
                </a>

            </nav>


            {{-- SIDEBAR BOTTOM --}}
            <div class="border-t border-slate-100 p-4">

                <a
                    href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
                >
                    <span>←</span>
                    Back to Store
                </a>

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
                        Admin Panel
                    </p>

                    <h1 class="mt-1 text-xl font-black text-slate-950 sm:text-2xl">
                        Users Management
                    </h1>

                </div>


                <div class="flex items-center gap-2">

                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="hidden rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:border-emerald-200 hover:bg-emerald-50 hover:text-emerald-700 sm:inline-flex"
                    >
                        ← Dashboard
                    </a>


                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="rounded-xl border border-red-100 bg-red-50 px-3 py-2.5 text-xs font-bold text-red-600 transition hover:bg-red-100 sm:px-4"
                        >
                            Logout
                        </button>

                    </form>

                </div>

            </div>

        </header>


        {{-- =========================================================
            CONTENT
        ========================================================== --}}
        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">


            {{-- =====================================================
                SUCCESS MESSAGE
            ====================================================== --}}
            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 shadow-sm">

                    <div class="flex items-center gap-3">

                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                            ✓
                        </span>

                        <p class="text-sm font-bold text-emerald-700">
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =====================================================
                ERROR MESSAGE
            ====================================================== --}}
            @if(session('error'))

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 shadow-sm">

                    <div class="flex items-center gap-3">

                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">
                            !
                        </span>

                        <p class="text-sm font-bold text-red-700">
                            {{ session('error') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                PAGE INTRO
            ========================================================== --}}
            <section class="mb-6 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>

                        <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-700">
                            User Directory
                        </span>

                        <h2 class="mt-3 text-2xl font-black text-slate-950 sm:text-3xl">
                            All Users
                        </h2>

                        <p class="mt-2 text-sm text-slate-500">
                            Manage and monitor all registered marketplace users.
                        </p>

                    </div>


                    {{-- TOTAL --}}
                    <div class="flex items-center gap-4 rounded-2xl bg-slate-50 px-5 py-4">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-2xl">
                            👥
                        </div>

                        <div>

                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                Results
                            </p>

                            <p class="mt-1 text-2xl font-black text-slate-950">
                                {{ $users->count() }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    SEARCH + FILTER
                ================================================== --}}
                <form
                    method="GET"
                    action="{{ route('admin.users.index') }}"
                    class="mt-6"
                >

                    <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_220px_auto]">

                        {{-- SEARCH --}}
                        <div class="relative">

                            <span class="pointer-events-none absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                🔍
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search by name or email..."
                                class="h-12 w-full rounded-xl border border-slate-200 bg-white pl-11 pr-4 text-sm font-medium text-slate-700 outline-none transition focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                            >

                        </div>


                        {{-- ROLE --}}
                        <select
                            name="role"
                            class="h-12 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 outline-none focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100"
                        >

                            <option value="">
                                All Roles
                            </option>

                            <option
                                value="admin"
                                {{ request('role') === 'admin' ? 'selected' : '' }}
                            >
                                Admin
                            </option>

                            <option
                                value="vendor"
                                {{ request('role') === 'vendor' ? 'selected' : '' }}
                            >
                                Vendor
                            </option>

                            <option
                                value="delivery-boy"
                                {{ request('role') === 'delivery-boy' ? 'selected' : '' }}
                            >
                                Delivery Boy
                            </option>

                            <option
                                value="customer"
                                {{ request('role') === 'customer' ? 'selected' : '' }}
                            >
                                Customer
                            </option>

                        </select>


                        {{-- SEARCH BUTTON --}}
                        <button
                            type="submit"
                            class="h-12 rounded-xl bg-slate-900 px-6 text-sm font-bold text-white transition hover:bg-emerald-700 active:scale-[0.98]"
                        >
                            Search Users
                        </button>

                    </div>


                    {{-- ACTIVE FILTERS --}}
                    @if(request()->filled('search') || request()->filled('role'))

                        <div class="mt-4 flex flex-wrap items-center gap-2">

                            <span class="text-xs font-semibold text-slate-400">
                                Active filters:
                            </span>


                            @if(request()->filled('search'))

                                <span class="rounded-full bg-blue-50 px-3 py-1.5 text-xs font-bold text-blue-700">
                                    Search: {{ request('search') }}
                                </span>

                            @endif


                            @if(request()->filled('role'))

                                <span class="rounded-full bg-purple-50 px-3 py-1.5 text-xs font-bold text-purple-700">
                                    Role:
                                    {{ ucfirst(str_replace('-', ' ', request('role'))) }}
                                </span>

                            @endif


                            <a
                                href="{{ route('admin.users.index') }}"
                                class="rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-100"
                            >
                                Clear Filters ✕
                            </a>

                        </div>

                    @endif

                </form>

            </section>


            {{-- =================================================
                USERS
            ================================================== --}}
            @if($users->count() > 0)

                {{-- =================================================
                    DESKTOP TABLE
                ================================================== --}}
                <div class="hidden overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm md:block">

                    <div class="border-b border-slate-100 px-6 py-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <h3 class="text-lg font-black text-slate-950">
                                    Registered Users
                                </h3>

                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $users->count() }} matching user accounts found.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[1050px]">

                            <thead class="bg-slate-50">

                                <tr class="border-b border-slate-200 text-left">

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        ID
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        User
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Email
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Role
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Joined
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-xs font-black uppercase tracking-wider text-slate-400">
                                        Action
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach($users as $user)

                                    @php

                                        $roleClass = match($user->role) {

                                            'admin' =>
                                                'bg-red-50 text-red-700 ring-red-200',

                                            'vendor' =>
                                                'bg-purple-50 text-purple-700 ring-purple-200',

                                            'delivery-boy' =>
                                                'bg-orange-50 text-orange-700 ring-orange-200',

                                            'customer' =>
                                                'bg-blue-50 text-blue-700 ring-blue-200',

                                            default =>
                                                'bg-slate-100 text-slate-700 ring-slate-200',

                                        };

                                        $isActive = (bool) $user->is_active;

                                    @endphp


                                    <tr class="transition hover:bg-slate-50">


                                        {{-- ID --}}
                                        <td class="px-6 py-5">

                                            <span class="font-mono text-sm font-bold text-slate-500">
                                                #{{ $user->id }}
                                            </span>

                                        </td>


                                        {{-- USER --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-900 text-sm font-black text-white">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>

                                                <div>

                                                    <p class="font-bold text-slate-900">
                                                        {{ $user->name }}
                                                    </p>

                                                    <p class="text-xs text-slate-400">
                                                        Account #{{ $user->id }}
                                                    </p>

                                                </div>

                                            </div>

                                        </td>


                                        {{-- EMAIL --}}
                                        <td class="px-6 py-5">

                                            <p class="text-sm font-medium text-slate-600">
                                                {{ $user->email }}
                                            </p>

                                        </td>


                                        {{-- ROLE --}}
                                        <td class="px-6 py-5">

                                            <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold ring-1 {{ $roleClass }}">
                                                {{ ucfirst(str_replace('-', ' ', $user->role)) }}
                                            </span>

                                        </td>


                                        {{-- JOINED --}}
                                        <td class="px-6 py-5">

                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $user->created_at->format('d M Y') }}
                                            </p>

                                            <p class="mt-1 text-xs text-slate-400">
                                                {{ $user->created_at->format('h:i A') }}
                                            </p>

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-6 py-5">

                                            @if($isActive)

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-bold text-emerald-700 ring-1 ring-emerald-200">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

                                                    Active

                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-3 py-1.5 text-xs font-bold text-red-700 ring-1 ring-red-200">

                                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                                    Blocked

                                                </span>

                                            @endif

                                        </td>


                                        {{-- ACTION --}}
                                        <td class="px-6 py-5">

                                            @if($user->role === 'admin')

                                                <span class="inline-flex items-center rounded-xl bg-slate-100 px-4 py-2.5 text-xs font-bold text-slate-400">
                                                    🔒 Protected
                                                </span>

                                            @else

                                                <form
                                                    action="{{ route('admin.users.toggle', $user) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('{{ $isActive ? 'Block this user?' : 'Unblock this user?' }}')"
                                                >

                                                    @csrf
                                                    @method('PUT')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center justify-center rounded-xl px-4 py-2.5 text-xs font-bold transition active:scale-95
                                                        {{ $isActive
                                                            ? 'bg-red-50 text-red-600 ring-1 ring-red-200 hover:bg-red-100'
                                                            : 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100' }}"
                                                    >
                                                        {{ $isActive ? 'Block' : 'Unblock' }}
                                                    </button>

                                                </form>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>


                {{-- =================================================
                    MOBILE CARDS
                ================================================== --}}
                <div class="space-y-4 md:hidden">

                    @foreach($users as $user)

                        @php

                            $roleClass = match($user->role) {

                                'admin' =>
                                    'bg-red-50 text-red-700',

                                'vendor' =>
                                    'bg-purple-50 text-purple-700',

                                'delivery-boy' =>
                                    'bg-orange-50 text-orange-700',

                                'customer' =>
                                    'bg-blue-50 text-blue-700',

                                default =>
                                    'bg-slate-100 text-slate-700',

                            };

                            $isActive = (bool) $user->is_active;

                        @endphp


                        <article class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">


                            {{-- TOP --}}
                            <div class="flex items-start justify-between gap-3">

                                <div class="flex min-w-0 items-center gap-3">

                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-slate-900 text-base font-black text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div class="min-w-0">

                                        <h3 class="truncate font-bold text-slate-900">
                                            {{ $user->name }}
                                        </h3>

                                        <p class="mt-1 break-all text-xs text-slate-500">
                                            {{ $user->email }}
                                        </p>

                                    </div>

                                </div>


                                <span class="shrink-0 rounded-full px-3 py-1 text-[10px] font-bold {{ $roleClass }}">
                                    {{ ucfirst(str_replace('-', ' ', $user->role)) }}
                                </span>

                            </div>


                            {{-- INFO --}}
                            <div class="mt-5 grid grid-cols-2 gap-3">


                                {{-- USER ID --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        User ID
                                    </p>

                                    <p class="mt-1 font-mono text-sm font-bold text-slate-700">
                                        #{{ $user->id }}
                                    </p>

                                </div>


                                {{-- JOINED --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Joined
                                    </p>

                                    <p class="mt-1 text-sm font-bold text-slate-700">
                                        {{ $user->created_at->format('d M Y') }}
                                    </p>

                                </div>


                                {{-- STATUS --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Status
                                    </p>

                                    @if($isActive)

                                        <p class="mt-1 text-sm font-bold text-emerald-700">
                                            ● Active
                                        </p>

                                    @else

                                        <p class="mt-1 text-sm font-bold text-red-600">
                                            ● Blocked
                                        </p>

                                    @endif

                                </div>


                                {{-- ACCOUNT TYPE --}}
                                <div class="rounded-xl bg-slate-50 p-3">

                                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-400">
                                        Account Type
                                    </p>

                                    <p class="mt-1 truncate text-sm font-bold text-slate-700">
                                        {{ ucfirst(str_replace('-', ' ', $user->role)) }}
                                    </p>

                                </div>

                            </div>


                            {{-- ACTION --}}
                            @if($user->role === 'admin')

                                <div class="mt-4 rounded-xl bg-slate-100 px-4 py-3 text-center text-xs font-bold text-slate-400">
                                    🔒 Admin Account Protected
                                </div>

                            @else

                                <form
                                    action="{{ route('admin.users.toggle', $user) }}"
                                    method="POST"
                                    class="mt-4"
                                    onsubmit="return confirm('{{ $isActive ? 'Block this user?' : 'Unblock this user?' }}')"
                                >

                                    @csrf
                                    @method('PUT')

                                    <button
                                        type="submit"
                                        class="w-full rounded-xl px-4 py-3 text-sm font-bold transition active:scale-[0.98]
                                        {{ $isActive
                                            ? 'bg-red-50 text-red-600 ring-1 ring-red-200 hover:bg-red-100'
                                            : 'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200 hover:bg-emerald-100' }}"
                                    >
                                        {{ $isActive ? 'Block User' : 'Unblock User' }}
                                    </button>

                                </form>

                            @endif


                        </article>

                    @endforeach

                </div>


            @else

                {{-- =================================================
                    NO RESULTS
                ================================================== --}}
                <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">

                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-slate-100 text-4xl">
                        🔍
                    </div>

                    <h2 class="mt-6 text-2xl font-black text-slate-950">
                        No Users Found
                    </h2>

                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                        No user matched your current search or role filter.
                    </p>


                    <a
                        href="{{ route('admin.users.index') }}"
                        class="mt-6 inline-flex rounded-xl bg-slate-900 px-5 py-3 text-sm font-bold text-white transition hover:bg-emerald-700"
                    >
                        Clear Filters
                    </a>

                </div>

            @endif


            {{-- =================================================
                FOOTER
            ================================================== --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">

                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Users Management
                    </p>

                </div>

            </footer>

        </main>

    </div>

</body>
</html>