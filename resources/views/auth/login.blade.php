<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div
        class="max-w-sm sm:max-w-lg md:max-w-xl lg:max-w-2xl xl:max-w-4xl mx-auto min-h-[calc(100dvh-32px)] flex flex-col justify-between">
        <header class="flex justify-center mt-12 mb-8">
            <h1 class="text-3xl dark:text-zinc-200 font-semibold">Login</h1>
        </header>
        <div class="flex justify-center">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <x-input-error :messages="$errors->all()" />
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded dark:bg-zinc-900 border-zinc-300 dark:border-zinc-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-zinc-800"
                            name="remember">
                        <span class="ms-2 text-sm text-zinc-600 dark:text-zinc-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="mx-auto flex items-center flex-col mb-8">
            <hr class="border-zinc-500 dark:border-zinc-700 w-full mb-8">
            <h2 class="text-zinc-800 dark:text-zinc-200 text-xl font-semibold">Try other methods</h2>
            <div class="mt-4 flex items-center justify-center gap-2 w-full flex-wrap">
                <button  href="{{route("auth.github")}}" type="button" 
                     class="text-white bg-zinc-900 hover:bg-zinc-900/90 focus:ring-4 focus:outline-none focus:ring-zinc-900/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-zinc-500 dark:hover:bg-[#050708]/30 ">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z"
                            clip-rule="evenodd" />
                    </svg>
                    
                <a href="{{route("auth.github")}}"> Sign up with Github</a>

                </button>
                <button type="button"
                    class="text-white bg-indigo-900 hover:bg-indigo-900/90 focus:ring-4 focus:outline-none focus:ring-indigo-900/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-indigo-900/55 ">
                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 18 19">
                        <path fill-rule="evenodd"
                            d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z"
                            clip-rule="evenodd" />
                    </svg>
                    Sign up with Google
                </button>
                <a href="{{route("candidate-register")}}"
                    class="hidden text-zinc-900 hover:text-white border border-zinc-800 hover:bg-zinc-900 focus:ring-4 focus:outline-none focus:ring-zinc-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center  dark:border-zinc-600 dark:text-zinc-400 dark:hover:text-white dark:hover:bg-zinc-600 dark:focus:ring-zinc-800">Sign
                    up
                    as a candidate?</a>

            </div>
        </div>
    </div>
</x-guest-layout>