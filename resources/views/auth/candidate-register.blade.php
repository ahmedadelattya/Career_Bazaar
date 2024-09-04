<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Common Registration Fields -->
        <x-registration-form />

        <!-- Hidden field for the role -->
        <input type="hidden" name="role" value="candidate">

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>