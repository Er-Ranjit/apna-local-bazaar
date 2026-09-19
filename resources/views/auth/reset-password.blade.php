<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Reset Password - Apna Local Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="min-h-screen bg-slate-950">

    <div class="flex min-h-screen items-center justify-center px-4 py-10">

        <div class="w-full max-w-md">


            {{-- BRAND --}}
            <div class="mb-8 text-center">

                <a
                    href="{{ url('/') }}"
                    class="inline-flex items-center gap-3"
                >

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Apna Local Bazaar"
                        class="h-12 w-12 rounded-2xl object-cover shadow-lg"
                    >

                    <div class="text-left">

                        <p class="text-lg font-black text-white">
                            Apna Local Bazaar
                        </p>

                        <p class="text-xs font-medium text-slate-400">
                            Local shopping made simple
                        </p>

                    </div>

                </a>

            </div>


            {{-- CARD --}}
            <div
                class="rounded-3xl border border-white/10 bg-white p-6 shadow-2xl sm:p-8"
            >

                {{-- HEADER --}}
                <div class="mb-6">

                    <div
                        class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-2xl"
                    >
                        🔑
                    </div>

                    <h1 class="text-2xl font-black text-slate-900">
                        Reset your password
                    </h1>

                    <p class="mt-2 text-sm leading-6 text-slate-500">
                        Enter your email address and choose a new password.
                    </p>

                </div>


                {{-- ERRORS --}}
                @if ($errors->any())

                    <div
                        class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3"
                    >

                        @foreach ($errors->all() as $error)

                            <p class="text-sm font-semibold text-red-700">
                                {{ $error }}
                            </p>

                        @endforeach

                    </div>

                @endif


                {{-- FORM --}}
                <form
                    action="{{ route('password.update') }}"
                    method="POST"
                    class="space-y-5"
                >

                    @csrf


                    {{-- TOKEN --}}
                    <input
                        type="hidden"
                        name="token"
                        value="{{ $token }}"
                    >


                    {{-- EMAIL --}}
                    <div>

                        <label
                            for="email"
                            class="mb-2 block text-sm font-bold text-slate-700"
                        >
                            Email address
                        </label>

                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email', request('email')) }}"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="Enter your registered email"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-medium text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- NEW PASSWORD --}}
                    <div>

                        <label
                            for="password"
                            class="mb-2 block text-sm font-bold text-slate-700"
                        >
                            New password
                        </label>

                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Enter new password"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-medium text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- CONFIRM PASSWORD --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="mb-2 block text-sm font-bold text-slate-700"
                        >
                            Confirm new password
                        </label>

                        <input
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            placeholder="Confirm new password"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm font-medium text-slate-900 outline-none transition focus:border-emerald-500 focus:bg-white focus:ring-4 focus:ring-emerald-100"
                        >

                    </div>


                    {{-- SUBMIT --}}
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-emerald-600 px-5 py-3.5 text-sm font-black text-white shadow-lg shadow-emerald-600/20 transition hover:bg-emerald-700 active:scale-[0.99]"
                    >
                        Reset Password
                    </button>

                </form>


                {{-- LOGIN --}}
                <div class="mt-6 text-center">

                    <a
                        href="{{ url('/login') }}"
                        class="text-sm font-bold text-emerald-600 transition hover:text-emerald-700 hover:underline"
                    >
                        ← Back to Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</body>

</html>