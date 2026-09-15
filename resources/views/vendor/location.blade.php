<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shop Location - Apna Local Bazaar</title>

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


                <a
                    href="{{ route('vendor.products.create') }}"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50 hover:text-slate-900"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100">
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


                {{-- ACTIVE --}}
                <a
                    href="{{ route('vendor.location') }}"
                    class="flex items-center gap-3 rounded-xl bg-emerald-50 px-4 py-3 text-sm font-bold text-emerald-700"
                >

                    <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-100">
                        📍
                    </span>

                    Shop Location

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
                        Shop Location
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


        {{-- CONTENT --}}
        <main class="mx-auto max-w-5xl px-4 py-6 sm:px-6 sm:py-8 lg:px-8">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-100">
                            ✅
                        </div>

                        <div>

                            <p class="font-bold text-emerald-900">
                                Location Saved
                            </p>

                            <p class="mt-1 text-sm text-emerald-700">
                                {{ session('success') }}
                            </p>

                        </div>

                    </div>

                </div>

            @endif


            {{-- ERROR --}}
            @if($errors->any())

                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-4">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-red-100">
                            ⚠️
                        </div>

                        <div>

                            <p class="font-bold text-red-900">
                                Please fix the following
                            </p>

                            <ul class="mt-2 space-y-1 text-sm text-red-700">

                                @foreach($errors->all() as $error)

                                    <li>
                                        • {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- HERO CARD --}}
            <section class="overflow-hidden rounded-3xl bg-slate-900 shadow-sm">

                <div class="p-6 sm:p-8">

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

                        <div class="max-w-2xl">

                            <span class="inline-flex rounded-full bg-emerald-500/15 px-3 py-1 text-xs font-bold uppercase tracking-wider text-emerald-300">
                                Delivery Radius
                            </span>

                            <h2 class="mt-4 text-2xl font-black text-white sm:text-3xl">
                                Set your shop location
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-slate-300 sm:text-base">
                                Your shop location will help Apna Local Bazaar show your products
                                to customers who are within the delivery area.
                            </p>

                        </div>


                        <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-3xl bg-emerald-500/15 text-4xl">
                            📍
                        </div>

                    </div>

                </div>

            </section>


            {{-- LOCATION CARD --}}
            <section class="mt-6 rounded-3xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 p-5 sm:p-6">

                    <p class="text-xs font-bold uppercase tracking-[0.16em] text-emerald-600">
                        Shop Coordinates
                    </p>

                    <h3 class="mt-1 text-lg font-black text-slate-950">
                        Save your exact shop location
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Use your current browser location or enter the coordinates manually.
                    </p>

                </div>


                <div class="p-5 sm:p-6">

                    {{-- CURRENT SAVED LOCATION --}}
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                        <div class="flex items-start gap-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-white shadow-sm">
                                📌
                            </div>

                            <div class="min-w-0">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Current Saved Location
                                </p>

                                @if($vendor->latitude !== null && $vendor->longitude !== null)

                                    <p class="mt-2 break-all text-sm font-bold text-slate-800">
                                        Latitude:
                                        {{ number_format((float) $vendor->latitude, 7) }}
                                    </p>

                                    <p class="mt-1 break-all text-sm font-bold text-slate-800">
                                        Longitude:
                                        {{ number_format((float) $vendor->longitude, 7) }}
                                    </p>

                                @else

                                    <p class="mt-2 text-sm font-medium text-orange-600">
                                        No shop location saved yet.
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- LOCATION BUTTON --}}
                    <div class="mt-6">

                        <button
                            type="button"
                            id="useCurrentLocation"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-emerald-600 px-5 py-4 text-sm font-black text-white shadow-lg shadow-emerald-900/10 transition hover:bg-emerald-700 active:scale-[0.99] sm:w-auto"
                        >

                            <span id="locationButtonIcon">
                                📍
                            </span>

                            <span id="locationButtonText">
                                Use My Current Location
                            </span>

                        </button>

                        <p
                            id="locationStatus"
                            class="mt-3 hidden text-sm font-medium"
                        ></p>

                    </div>


                    {{-- FORM --}}
                    <form
                        action="{{ route('vendor.location.update') }}"
                        method="POST"
                        class="mt-7"
                    >

                        @csrf

                        @method('PUT')


                        <div class="grid gap-5 sm:grid-cols-2">

                            {{-- LATITUDE --}}
                            <div>

                                <label
                                    for="latitude"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Latitude
                                </label>

                                <input
                                    id="latitude"
                                    type="number"
                                    name="latitude"
                                    step="0.0000001"
                                    min="-90"
                                    max="90"
                                    value="{{ old('latitude', $vendor->latitude) }}"
                                    required
                                    placeholder="e.g. 30.7333"
                                    class="h-13 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-bold text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >

                            </div>


                            {{-- LONGITUDE --}}
                            <div>

                                <label
                                    for="longitude"
                                    class="mb-2 block text-sm font-bold text-slate-700"
                                >
                                    Longitude
                                </label>

                                <input
                                    id="longitude"
                                    type="number"
                                    name="longitude"
                                    step="0.0000001"
                                    min="-180"
                                    max="180"
                                    value="{{ old('longitude', $vendor->longitude) }}"
                                    required
                                    placeholder="e.g. 76.7794"
                                    class="h-13 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 text-sm font-bold text-slate-800 outline-none transition placeholder:text-slate-400 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                                >

                            </div>

                        </div>


                        {{-- SHOP INFO --}}
                        <div class="mt-6 grid gap-4 sm:grid-cols-2">

                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    Shop
                                </p>

                                <p class="mt-1 text-sm font-black text-slate-800">
                                    {{ $vendor->shop_name }}
                                </p>

                            </div>


                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">

                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">
                                    City
                                </p>

                                <p class="mt-1 text-sm font-black text-slate-800">
                                    {{ $vendor->city ?? 'Not set' }}
                                </p>

                            </div>

                        </div>


                        {{-- ACTIONS --}}
                        <div class="mt-7 flex flex-col gap-3 sm:flex-row">

                            <button
                                type="submit"
                                class="inline-flex flex-1 items-center justify-center rounded-2xl bg-slate-900 px-5 py-4 text-sm font-black text-white transition hover:bg-slate-800 active:scale-[0.99]"
                            >
                                Save Shop Location
                            </button>


                            <a
                                href="{{ route('vendor.dashboard') }}"
                                class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-bold text-slate-600 transition hover:bg-slate-50"
                            >
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </section>


            {{-- INFO CARDS --}}
            <section class="mt-6 grid gap-4 md:grid-cols-3">

                <div class="rounded-2xl border border-emerald-100 bg-emerald-50 p-5">

                    <div class="text-2xl">
                        📍
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Accurate Location
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-600">
                        Use your actual shop location for better delivery matching.
                    </p>

                </div>


                <div class="rounded-2xl border border-blue-100 bg-blue-50 p-5">

                    <div class="text-2xl">
                        🚚
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Easier Delivery
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-600">
                        Nearby customers can be matched with your store more efficiently.
                    </p>

                </div>


                <div class="rounded-2xl border border-orange-100 bg-orange-50 p-5">

                    <div class="text-2xl">
                        🔒
                    </div>

                    <h3 class="mt-3 font-black text-slate-900">
                        Secure
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-slate-600">
                        Your coordinates are used only for marketplace delivery matching.
                    </p>

                </div>

            </section>


            {{-- FOOTER --}}
            <footer class="mt-8 border-t border-slate-200 pt-6">

                <div class="flex flex-col gap-2 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left">

                    <p>
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                    <p>
                        Shop Location
                    </p>

                </div>

            </footer>

        </main>

    </div>


    {{-- =========================================================
        LOCATION SCRIPT
    ========================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const button = document.getElementById('useCurrentLocation');

            const buttonText = document.getElementById('locationButtonText');

            const buttonIcon = document.getElementById('locationButtonIcon');

            const status = document.getElementById('locationStatus');

            const latitudeInput = document.getElementById('latitude');

            const longitudeInput = document.getElementById('longitude');


            if (!button) {
                return;
            }


            const showStatus = (message, type = 'success') => {

                status.classList.remove(
                    'hidden',
                    'text-emerald-600',
                    'text-red-600',
                    'text-orange-600'
                );


                if (type === 'success') {
                    status.classList.add('text-emerald-600');
                }


                if (type === 'error') {
                    status.classList.add('text-red-600');
                }


                if (type === 'warning') {
                    status.classList.add('text-orange-600');
                }


                status.textContent = message;

            };


            button.addEventListener('click', function () {

                if (!navigator.geolocation) {

                    showStatus(
                        'Geolocation is not supported by this browser.',
                        'error'
                    );

                    return;
                }


                button.disabled = true;

                button.classList.add(
                    'cursor-not-allowed',
                    'opacity-70'
                );

                buttonIcon.textContent = '⏳';

                buttonText.textContent = 'Getting Location...';


                navigator.geolocation.getCurrentPosition(

                    function (position) {

                        const latitude = position.coords.latitude;

                        const longitude = position.coords.longitude;


                        latitudeInput.value = latitude.toFixed(7);

                        longitudeInput.value = longitude.toFixed(7);


                        showStatus(
                            'Location detected successfully. Now click Save Shop Location.',
                            'success'
                        );


                        button.disabled = false;

                        button.classList.remove(
                            'cursor-not-allowed',
                            'opacity-70'
                        );

                        buttonIcon.textContent = '✅';

                        buttonText.textContent = 'Location Detected';

                    },

                    function (error) {

                        let message =
                            'Unable to get your location.';


                        if (error.code === 1) {

                            message =
                                'Location permission was denied. Please allow location access in your browser.';

                        } else if (error.code === 2) {

                            message =
                                'Your location could not be determined. Please try again.';

                        } else if (error.code === 3) {

                            message =
                                'Location request timed out. Please try again.';

                        }


                        showStatus(
                            message,
                            'error'
                        );


                        button.disabled = false;

                        button.classList.remove(
                            'cursor-not-allowed',
                            'opacity-70'
                        );

                        buttonIcon.textContent = '📍';

                        buttonText.textContent = 'Use My Current Location';

                    },

                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }

                );

            });

        });

    </script>

</body>

</html>