<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-950 text-slate-900 antialiased">

    {{-- BACKGROUND --}}
    <div class="pointer-events-none fixed inset-0 overflow-hidden">

        <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl"></div>

        <div class="absolute -bottom-40 -right-20 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>

        <div
            class="absolute inset-0 opacity-30"
            style="background-image: radial-gradient(rgba(255,255,255,.14) 1px, transparent 1px); background-size: 26px 26px;"
        ></div>

    </div>


    {{-- PAGE --}}
    <main class="relative z-10 flex min-h-screen items-center justify-center px-4 py-8 sm:px-6 lg:px-8">

        <div class="grid w-full max-w-6xl overflow-hidden rounded-[32px] border border-white/10 bg-white/95 shadow-2xl shadow-black/30 backdrop-blur-xl lg:grid-cols-2">


            {{-- LEFT --}}
            <section class="relative hidden overflow-hidden bg-slate-950 lg:flex">

                <div class="absolute -left-24 top-20 h-64 w-64 rounded-full border border-emerald-400/20"></div>

                <div class="absolute -right-28 bottom-10 h-72 w-72 rounded-full border border-cyan-400/10"></div>


                <div class="relative z-10 flex min-h-[760px] w-full flex-col justify-between p-10 xl:p-12">


                    {{-- BRAND --}}
                    <a
                        href="{{ route('home') }}"
                        class="inline-flex w-fit items-center gap-3"
                    >

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white p-1 shadow-lg">

                            <img
                                src="{{ asset('images/logo.png') }}"
                                alt="Apna Local Bazaar"
                                class="max-h-10 w-auto object-contain"
                            >

                        </div>


                        <div>

                            <p class="text-sm font-bold text-white">
                                Apna Local Bazaar
                            </p>

                            <p class="text-xs text-slate-400">
                                Your Local Marketplace
                            </p>

                        </div>

                    </a>


                    {{-- CONTENT --}}
                    <div class="max-w-xl">

                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300">
                            Join the marketplace
                        </span>


                        <h1 class="mt-6 text-4xl font-black leading-[1.05] tracking-tight text-white xl:text-5xl">

                            Create your account.

                            <span class="block text-emerald-400">
                                Start shopping local.
                            </span>

                        </h1>


                        <p class="mt-6 max-w-lg text-sm leading-7 text-slate-300 xl:text-base">
                            Join Apna Local Bazaar and connect with trusted local sellers, products and convenient doorstep delivery.
                        </p>


                        {{-- FEATURES --}}
                        <div class="mt-9 space-y-3">

                            <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-400/10 text-xl">
                                    🛍️
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-white">
                                        Shop from local stores
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Discover products from trusted sellers.
                                    </p>

                                </div>

                            </div>


                            <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-400/10 text-xl">
                                    🚚
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-white">
                                        Easy doorstep delivery
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Track your order from placement to delivery.
                                    </p>

                                </div>

                            </div>


                            <div class="flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 transition hover:bg-white/10">

                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-400/10 text-xl">
                                    🔒
                                </div>

                                <div>

                                    <p class="text-sm font-bold text-white">
                                        Secure account
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Your login credentials stay protected.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>


                    <p class="text-xs text-slate-500">
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                </div>

            </section>


            {{-- RIGHT --}}
            <section class="flex items-center justify-center bg-white px-5 py-8 sm:px-8 lg:px-12 xl:px-16">

                <div class="w-full max-w-md">


                    {{-- MOBILE LOGO --}}
                    <div class="mb-8 text-center lg:hidden">

                        <a
                            href="{{ route('home') }}"
                            class="inline-flex flex-col items-center"
                        >

                            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-emerald-50 p-2 shadow-sm">

                                <img
                                    src="{{ asset('images/logo.png') }}"
                                    alt="Apna Local Bazaar"
                                    class="max-h-12 w-auto object-contain"
                                >

                            </div>


                            <p class="mt-3 text-base font-black text-slate-900">
                                Apna Local Bazaar
                            </p>

                            <p class="text-xs text-slate-400">
                                Your Local Marketplace
                            </p>

                        </a>

                    </div>


                    {{-- HEADER --}}
                    <div class="mb-7">

                        <div class="flex items-center justify-between gap-4">

                            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.16em] text-emerald-700">
                                Create Account
                            </span>


                            <a
                                href="{{ route('home') }}"
                                class="text-xs font-semibold text-slate-400 transition hover:text-emerald-600"
                            >
                                ← Home
                            </a>

                        </div>


                        <h2 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                            Join Apna Local Bazaar
                        </h2>


                        <p class="mt-2 text-sm leading-6 text-slate-500">
                            Create your account and get started in a few seconds.
                        </p>

                    </div>


                    {{-- ERRORS --}}
                    @if($errors->any())

                        <div class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-red-50">

                            <div class="flex gap-3 p-4">

                                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-red-100 font-bold text-red-700">
                                    !
                                </div>


                                <div class="min-w-0">

                                    <p class="text-sm font-bold text-red-800">
                                        Registration failed
                                    </p>


                                    <ul class="mt-2 space-y-1 text-xs leading-5 text-red-700">

                                        @foreach($errors->all() as $error)
                                            <li>• {{ $error }}</li>
                                        @endforeach

                                    </ul>

                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- FORM --}}
                    <form
                        id="registerForm"
                        action="{{ route('register') }}"
                        method="POST"
                        class="space-y-5"
                    >

                        @csrf


                        {{-- NAME --}}
                        <div class="group">

                            <label
                                for="name"
                                class="mb-2 block text-sm font-bold text-slate-700"
                            >
                                Full Name
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-emerald-600">
                                    👤
                                </div>


                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    required
                                    autocomplete="name"
                                    placeholder="Enter your full name"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-medium outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="group">

                            <label
                                for="email"
                                class="mb-2 block text-sm font-bold text-slate-700"
                            >
                                Email Address
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-emerald-600">
                                    @
                                </div>


                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="email"
                                    placeholder="you@example.com"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-medium outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                            </div>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="group">

                            <label
                                for="password"
                                class="mb-2 block text-sm font-bold text-slate-700"
                            >
                                Password
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-emerald-600">
                                    •••
                                </div>


                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Create a password"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-12 text-sm font-medium outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >


                                <button
                                    type="button"
                                    id="togglePassword"
                                    class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white hover:text-slate-700"
                                    aria-label="Show password"
                                >
                                    👁
                                </button>

                            </div>


                            {{-- PASSWORD STRENGTH --}}
                            <div class="mt-3">

                                <div class="flex gap-1">

                                    <span id="strength1" class="h-1.5 flex-1 rounded-full bg-slate-200 transition"></span>
                                    <span id="strength2" class="h-1.5 flex-1 rounded-full bg-slate-200 transition"></span>
                                    <span id="strength3" class="h-1.5 flex-1 rounded-full bg-slate-200 transition"></span>
                                    <span id="strength4" class="h-1.5 flex-1 rounded-full bg-slate-200 transition"></span>

                                </div>


                                <p
                                    id="passwordStrength"
                                    class="mt-1.5 text-[10px] font-semibold text-slate-400"
                                >
                                    Use 8+ characters for a stronger password.
                                </p>

                            </div>

                        </div>


                        {{-- CONFIRM PASSWORD --}}
                        <div class="group">

                            <label
                                for="password_confirmation"
                                class="mb-2 block text-sm font-bold text-slate-700"
                            >
                                Confirm Password
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-emerald-600">
                                    ✓
                                </div>


                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm your password"
                                    class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-12 text-sm font-medium outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >


                                <button
                                    type="button"
                                    id="toggleConfirmPassword"
                                    class="absolute right-2 top-1/2 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-xl text-slate-400 transition hover:bg-white hover:text-slate-700"
                                    aria-label="Show confirmation password"
                                >
                                    👁
                                </button>

                            </div>


                            <p
                                id="passwordMatch"
                                class="mt-1.5 hidden text-[10px] font-semibold"
                            ></p>

                        </div>


                        {{-- ROLE --}}
                        <div class="group">

                            <label
                                for="role"
                                class="mb-2 block text-sm font-bold text-slate-700"
                            >
                                Account Type
                            </label>


                            <div class="relative">

                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400">
                                    🏷️
                                </div>


                                <select
                                    id="role"
                                    name="role"
                                    required
                                    class="h-14 w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-12 text-sm font-medium outline-none transition hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                >

                                    <option value="customer" {{ old('role', 'customer') === 'customer' ? 'selected' : '' }}>
                                        Customer
                                    </option>

                                    <option value="vendor" {{ old('role') === 'vendor' ? 'selected' : '' }}>
                                        Vendor
                                    </option>

                                    <option value="delivery_boy" {{ old('role') === 'delivery-boy' ? 'selected' : '' }}>
                                        Delivery Boy
                                    </option>

                                </select>

                            </div>


                            <p class="mt-2 text-[10px] leading-4 text-slate-400">
                                Admin accounts are created privately by the system administrator.
                            </p>

                        </div>


                        {{-- SECURITY --}}
                        <div class="flex items-center gap-3 rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">

                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                🔒
                            </div>

                            <div>

                                <p class="text-xs font-bold text-slate-700">
                                    Secure Registration
                                </p>

                                <p class="text-[10px] text-slate-400">
                                    Your account information is protected.
                                </p>

                            </div>

                        </div>


                        {{-- SUBMIT --}}
                        <button
                            id="registerButton"
                            type="submit"
                            class="group relative flex h-14 w-full items-center justify-center overflow-hidden rounded-2xl bg-emerald-600 px-5 text-sm font-black text-white shadow-lg shadow-emerald-600/20 transition duration-300 hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-xl hover:shadow-emerald-600/25 active:translate-y-0"
                        >

                            <span
                                class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/15 to-transparent transition duration-700 group-hover:translate-x-full"
                            ></span>


                            <span
                                id="registerButtonText"
                                class="relative"
                            >
                                Create Account →
                            </span>

                        </button>


                    </form>


                    {{-- LOGIN --}}
                    <div class="mt-7 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-center">

                        <p class="text-sm text-slate-500">
                            Already have an account?
                        </p>


                        <a
                            href="{{ route('login') }}"
                            class="mt-3 inline-flex items-center justify-center rounded-xl border border-emerald-200 bg-white px-5 py-2.5 text-sm font-bold text-emerald-700 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50"
                        >
                            Login →
                        </a>

                    </div>


                    <div class="mt-6 flex items-center justify-center gap-2 text-[11px] text-slate-400">

                        <span>🔒</span>

                        <span>
                            Secure account authentication
                        </span>

                    </div>

                </div>

            </section>

        </div>

    </main>


    {{-- JAVASCRIPT --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const password =
                document.getElementById('password');

            const confirmPassword =
                document.getElementById('password_confirmation');


            const togglePassword =
                document.getElementById('togglePassword');

            const toggleConfirmPassword =
                document.getElementById('toggleConfirmPassword');


            const strengthText =
                document.getElementById('passwordStrength');


            const strengthBars = [
                document.getElementById('strength1'),
                document.getElementById('strength2'),
                document.getElementById('strength3'),
                document.getElementById('strength4')
            ];


            const matchText =
                document.getElementById('passwordMatch');


            const registerForm =
                document.getElementById('registerForm');

            const registerButton =
                document.getElementById('registerButton');

            const registerButtonText =
                document.getElementById('registerButtonText');


            /* ================================================
               PASSWORD TOGGLE
            ================================================= */

            togglePassword?.addEventListener('click', function () {

                if (!password) {
                    return;
                }

                const hidden =
                    password.type === 'password';

                password.type =
                    hidden ? 'text' : 'password';

                this.textContent =
                    hidden ? '🙈' : '👁';

            });


            toggleConfirmPassword?.addEventListener('click', function () {

                if (!confirmPassword) {
                    return;
                }

                const hidden =
                    confirmPassword.type === 'password';

                confirmPassword.type =
                    hidden ? 'text' : 'password';

                this.textContent =
                    hidden ? '🙈' : '👁';

            });


            /* ================================================
               PASSWORD STRENGTH
            ================================================= */

            const updateStrength = () => {

                const value =
                    password?.value || '';

                let score = 0;

                if (value.length >= 8) {
                    score++;
                }

                if (/[A-Z]/.test(value)) {
                    score++;
                }

                if (/[0-9]/.test(value)) {
                    score++;
                }

                if (/[^A-Za-z0-9]/.test(value)) {
                    score++;
                }


                strengthBars.forEach((bar, index) => {

                    if (!bar) {
                        return;
                    }

                    if (index < score) {

                        bar.classList.remove(
                            'bg-slate-200'
                        );

                        bar.classList.add(
                            'bg-emerald-500'
                        );

                    } else {

                        bar.classList.remove(
                            'bg-emerald-500'
                        );

                        bar.classList.add(
                            'bg-slate-200'
                        );

                    }

                });


                if (!value) {

                    strengthText.textContent =
                        'Use 8+ characters for a stronger password.';

                    strengthText.className =
                        'mt-1.5 text-[10px] font-semibold text-slate-400';

                    return;

                }


                if (score <= 1) {

                    strengthText.textContent =
                        'Weak password';

                    strengthText.className =
                        'mt-1.5 text-[10px] font-semibold text-red-500';

                } else if (score <= 2) {

                    strengthText.textContent =
                        'Medium password';

                    strengthText.className =
                        'mt-1.5 text-[10px] font-semibold text-amber-500';

                } else if (score === 3) {

                    strengthText.textContent =
                        'Good password';

                    strengthText.className =
                        'mt-1.5 text-[10px] font-semibold text-blue-600';

                } else {

                    strengthText.textContent =
                        'Strong password';

                    strengthText.className =
                        'mt-1.5 text-[10px] font-semibold text-emerald-600';

                }

            };


            password?.addEventListener(
                'input',
                updateStrength
            );


            /* ================================================
               PASSWORD MATCH
            ================================================= */

            const updateMatch = () => {

                const first =
                    password?.value || '';

                const second =
                    confirmPassword?.value || '';


                if (!second) {

                    matchText?.classList.add('hidden');

                    return;

                }


                matchText?.classList.remove('hidden');


                if (first === second) {

                    matchText.textContent =
                        '✓ Passwords match';

                    matchText.className =
                        'mt-1.5 text-[10px] font-semibold text-emerald-600';

                } else {

                    matchText.textContent =
                        'Passwords do not match';

                    matchText.className =
                        'mt-1.5 text-[10px] font-semibold text-red-500';

                }

            };


            password?.addEventListener(
                'input',
                updateMatch
            );

            confirmPassword?.addEventListener(
                'input',
                updateMatch
            );


            /* ================================================
               FORM LOADING
            ================================================= */

            registerForm?.addEventListener('submit', function () {

                if (
                    !password ||
                    !confirmPassword
                ) {
                    return;
                }


                if (password.value !== confirmPassword.value) {

                    return;

                }


                if (!registerButton || !registerButtonText) {
                    return;
                }


                registerButton.disabled = true;

                registerButton.classList.add(
                    'cursor-wait',
                    'opacity-90'
                );


                registerButtonText.innerHTML =
                    '<span class="inline-flex items-center gap-2">\
                        <span class="h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white"></span>\
                        Creating account...\
                    </span>';

            });

        });

    </script>

</body>

</html>