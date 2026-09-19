<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Apna Local Bazaar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-x-hidden bg-slate-950 text-slate-900 antialiased">
    
    <div class="pointer-events-none fixed inset-0 overflow-hidden">

        <div class="absolute -left-32 -top-32 h-80 w-80 rounded-full bg-emerald-500/20 blur-3xl"></div>

        <div class="absolute -bottom-40 -right-20 h-96 w-96 rounded-full bg-cyan-500/10 blur-3xl"></div>

        <div class="absolute left-1/2 top-1/3 h-72 w-72 -translate-x-1/2 rounded-full bg-emerald-400/5 blur-3xl"></div>

        <div
            class="absolute inset-0 opacity-30"
            style="background-image: radial-gradient(rgba(255,255,255,.14) 1px, transparent 1px); background-size: 26px 26px;"
        ></div>

    </div>


    {{-- =========================================================
        PAGE
    ========================================================== --}}
    <main class="relative z-10 flex min-h-screen items-center justify-center px-4 py-8 sm:px-6 lg:px-8">

        <div class="grid w-full max-w-6xl overflow-hidden rounded-[32px] border border-white/10 bg-white/95 shadow-2xl shadow-black/30 backdrop-blur-xl lg:grid-cols-2">


            {{-- =================================================
                LEFT PREMIUM PANEL
            ================================================== --}}
            <section class="relative hidden overflow-hidden bg-slate-950 lg:flex">

                {{-- Decorative circles --}}
                <div class="absolute -left-24 top-20 h-64 w-64 rounded-full border border-emerald-400/20"></div>

                <div class="absolute -right-28 bottom-10 h-72 w-72 rounded-full border border-cyan-400/10"></div>

                <div class="relative z-10 flex min-h-[720px] w-full flex-col justify-between p-10 xl:p-12">


                    {{-- BRAND --}}
                    <a
                        href="{{ route('home') }}"
                        class="group inline-flex w-fit items-center gap-3"
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

                            <p class="text-xs text-slate-400 transition group-hover:text-emerald-300">
                                Your Local Marketplace
                            </p>

                        </div>

                    </a>


                    {{-- CONTENT --}}
                    <div class="max-w-xl">

                        <span class="inline-flex items-center gap-2 rounded-full border border-emerald-400/20 bg-emerald-400/10 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-300">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                            Welcome back
                        </span>


                        <h1 class="mt-6 text-4xl font-black leading-[1.05] tracking-tight text-white xl:text-5xl">

                            Your local market.

                            <span class="block text-emerald-400">
                                One login away.
                            </span>

                        </h1>


                        <p class="mt-6 max-w-lg text-sm leading-7 text-slate-300 xl:text-base">
                            Shop from local sellers, discover fresh products and manage your orders from one simple marketplace.
                        </p>


                        {{-- FEATURE CARDS --}}
                        <div class="mt-9 grid grid-cols-3 gap-3">

                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:bg-white/10">

                                <div class="text-xl">
                                    🚚
                                </div>

                                <p class="mt-3 text-xs font-bold text-white">
                                    Fast Delivery
                                </p>

                                <p class="mt-1 text-[10px] leading-4 text-slate-400">
                                    At your doorstep
                                </p>

                            </div>


                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:bg-white/10">

                                <div class="text-xl">
                                    🏪
                                </div>

                                <p class="mt-3 text-xs font-bold text-white">
                                    Local Sellers
                                </p>

                                <p class="mt-1 text-[10px] leading-4 text-slate-400">
                                    Trusted nearby shops
                                </p>

                            </div>


                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4 backdrop-blur transition duration-300 hover:-translate-y-1 hover:bg-white/10">

                                <div class="text-xl">
                                    💵
                                </div>

                                <p class="mt-3 text-xs font-bold text-white">
                                    Cash on Delivery
                                </p>

                                <p class="mt-1 text-[10px] leading-4 text-slate-400">
                                    Simple checkout
                                </p>

                            </div>

                        </div>


                        {{-- LIVE STATUS --}}
                        <div class="mt-6 inline-flex items-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-4 py-3">

                            <span class="relative flex h-3 w-3">

                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>

                                <span class="relative inline-flex h-3 w-3 rounded-full bg-emerald-400"></span>

                            </span>

                            <span class="text-xs font-medium text-slate-300">
                                Marketplace is ready for you
                            </span>

                        </div>

                    </div>


                    {{-- FOOTER --}}
                    <p class="text-xs text-slate-500">
                        © {{ date('Y') }} Apna Local Bazaar
                    </p>

                </div>

            </section>


            {{-- =================================================
                RIGHT LOGIN
            ================================================== --}}
            <section class="flex items-center justify-center bg-white px-5 py-8 sm:px-8 lg:px-12 xl:px-16">

                <div class="w-full max-w-md">


                    {{-- MOBILE BRAND --}}
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


                    {{-- LOGIN CARD --}}
                    <div class="relative">


                        {{-- TOP LABEL --}}
                        <div class="mb-7">

                            <div class="flex items-center justify-between gap-4">

                                <div>

                                    <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1.5 text-[10px] font-bold uppercase tracking-[0.16em] text-emerald-700">
                                        Account Login
                                    </span>

                                </div>

                                <a
                                    href="{{ route('home') }}"
                                    class="text-xs font-semibold text-slate-400 transition hover:text-emerald-600"
                                >
                                    ← Home
                                </a>

                            </div>


                            <h2 class="mt-5 text-3xl font-black tracking-tight text-slate-950 sm:text-4xl">
                                Welcome back
                            </h2>

                            <p class="mt-2 text-sm leading-6 text-slate-500">
                                Sign in to continue shopping and manage your orders.
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
                                            Login failed
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
                            id="loginForm"
                            action="{{ url('/login') }}"
                            method="POST"
                            class="space-y-5"
                        >

                            @csrf


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
                                        class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-4 text-sm font-medium text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
                                    >

                                </div>

                            </div>


                            {{-- PASSWORD --}}
                            <div class="group">

                                <div class="mb-2 flex items-center justify-between gap-3">

    <label
        for="password"
        class="block text-sm font-bold text-slate-700"
    >
        Password
    </label>

    <a
        href="{{ url('/forgot-password') }}"
        class="text-xs font-bold text-emerald-600 transition hover:text-emerald-700 hover:underline"
    >
        Forgot password?
    </a>

</div>


                                <div class="relative">

                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-emerald-600">
                                        •••
                                    </div>


                                    <input
                                        id="password"
                                        type="password"
                                        name="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="Enter your password"
                                        class="h-14 w-full rounded-2xl border border-slate-200 bg-slate-50 pl-12 pr-12 text-sm font-medium text-slate-900 outline-none transition duration-200 placeholder:text-slate-400 hover:border-slate-300 focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-500/10"
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

                            </div>


                            {{-- REMEMBER ME --}}
                            <div class="flex items-center justify-between gap-3">

                                <label class="flex cursor-pointer items-center gap-2.5">

                                    <input
                                        type="checkbox"
                                        name="remember"
                                        value="1"
                                        class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500"
                                    >

                                    <span class="text-sm font-medium text-slate-600">
                                        Remember me
                                    </span>

                                </label>

                                <span class="text-xs text-slate-400">
                                    Stay signed in
                                </span>

                            </div>


                            {{-- TRUST --}}
                            <div class="flex items-center justify-between gap-3 rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-100 text-emerald-700">
                                        ✓
                                    </div>

                                    <div>

                                        <p class="text-xs font-bold text-slate-700">
                                            Secure Sign In
                                        </p>

                                        <p class="text-[10px] text-slate-400">
                                            Your account stays protected
                                        </p>

                                    </div>

                                </div>


                                <span class="text-lg">
                                    🔒
                                </span>

                            </div>


                            {{-- SUBMIT --}}
                            <button
                                id="loginButton"
                                type="submit"
                                class="group relative flex h-14 w-full items-center justify-center overflow-hidden rounded-2xl bg-emerald-600 px-5 text-sm font-black text-white shadow-lg shadow-emerald-600/20 transition duration-300 hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-xl hover:shadow-emerald-600/25 active:translate-y-0"
                            >

                                <span
                                    class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-white/15 to-transparent transition duration-700 group-hover:translate-x-full"
                                ></span>


                                <span
                                    id="loginButtonText"
                                    class="relative"
                                >
                                    Login to Continue →
                                </span>

                            </button>


                        </form>


                        {{-- REGISTER --}}
                        <div class="mt-7 rounded-2xl border border-slate-200 bg-slate-50 p-5 text-center">

                            <p class="text-sm text-slate-500">
                                New to Apna Local Bazaar?
                            </p>


                            <a
                                href="{{ route('register') }}"
                                class="mt-3 inline-flex items-center justify-center rounded-xl border border-emerald-200 bg-white px-5 py-2.5 text-sm font-bold text-emerald-700 shadow-sm transition hover:border-emerald-300 hover:bg-emerald-50"
                            >
                                Create Your Account →
                            </a>

                        </div>


                        {{-- HELP --}}
                        <div class="mt-6 flex items-center justify-center gap-2 text-[11px] text-slate-400">

                            <span>
                                🔒
                            </span>

                            <span>
                                Secure account authentication
                            </span>

                        </div>

                    </div>

                </div>

            </section>

        </div>

    </main>


    {{-- =========================================================
        JAVASCRIPT
    ========================================================== --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const passwordInput =
                document.getElementById('password');

            const togglePassword =
                document.getElementById('togglePassword');


            const loginForm =
                document.getElementById('loginForm');

            const loginButton =
                document.getElementById('loginButton');

            const loginButtonText =
                document.getElementById('loginButtonText');


            /* =================================================
               PASSWORD TOGGLE
            ================================================== */

            togglePassword?.addEventListener('click', function () {

                if (!passwordInput) {
                    return;
                }


                const isHidden =
                    passwordInput.type === 'password';


                passwordInput.type =
                    isHidden ? 'text' : 'password';


                this.textContent =
                    isHidden ? '🙈' : '👁';


                this.setAttribute(
                    'aria-label',
                    isHidden
                        ? 'Hide password'
                        : 'Show password'
                );

            });


            /* =================================================
               FORM LOADING STATE
            ================================================== */

            loginForm?.addEventListener('submit', function () {

                if (!loginButton || !loginButtonText) {
                    return;
                }


                loginButton.disabled = true;

                loginButton.classList.add(
                    'cursor-wait',
                    'opacity-90'
                );


                loginButtonText.innerHTML =
                    '<span class="inline-flex items-center gap-2">\
                        <span class="h-4 w-4 animate-spin rounded-full border-2 border-white/30 border-t-white"></span>\
                        Signing in...\
                    </span>';

            });


            /* =================================================
               INPUT INTERACTION
            ================================================== */

            [email, passwordInput].forEach((input) => {

                input?.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Enter' &&
                            input === passwordInput
                        ) {

                            loginForm?.requestSubmit();

                        }

                    }
                );

            });

        });

    </script>

</body>
</html>