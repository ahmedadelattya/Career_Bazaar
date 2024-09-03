<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Common Registration Fields -->
        <x-registration-form />

        <!-- Employer-specific Fields -->
        <div class="mt-4">
            <x-input-label for="company_name" :value="__('Company Name')" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="website" :value="__('Website')" />
            <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>

        <!-- Hidden field for the role -->
        <input type="hidden" name="role" value="employer">

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
