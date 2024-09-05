<x-guest-layout>
    <div class="gradient-bg text-zinc-950 dark:text-zinc-950">
    </div>
    <style>
        .gradient-bg {
            position: absolute;
            inset: 0;
            z-index: -9;
            background: radial-gradient(ellipse at bottom,
                    color-mix(in lab, currentColor 46%, white 9%),
                    color-mix(in lab, currentColor 44%, transparent 89%))
        }

        /* Optional: Transition effect when switching between light and dark mode */
        @media (prefers-color-scheme: dark) {
            .gradient-bg {
                transition: background 0.3s ease-in-out;
            }
        }
    </style>
    <div class="flex flex-row-reverse gap-28 items-center">
        <div class="">
            <img src="assets/business-deal-2.svg" class="size-96">
        </div>
        <form method="POST" action="{{ route('register') }}" class="grid grid-cols-2 gap-6 ">
            @csrf
            <style>
                form>* {
                    margin: 0 !important;
                }
            </style>

            <!-- Common Registration Fields -->
            <x-registration-form />
            <!-- Employer-specific Fields -->
            <div class="mt-4">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                    :value="old('company_name')" required />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="website" :value="__('Website')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website"
                    :value="old('website')" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>

            <!-- Hidden field for the role -->
            <input type="hidden" name="role" value="employer">

            <div class="flex items-center justify-between flex-row-reverse mt-4 col-span-2">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
                <a class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>


            </div>
        </form>
    </div>
</x-guest-layout>