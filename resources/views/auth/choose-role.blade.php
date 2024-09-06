<x-guest-layout>
    <!-- <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-zinc-800 shadow-md overflow-hidden sm:rounded-lg"> -->
    <form method="GET" action="{{ route('register-role') }}"
        class="w-full h-[calc(100vh-32px)] md:h-full flex flex-col items-center justify-center ">
        @csrf

        <div class="flex flex-col md:flex-row w-full h-full justify-center gap-4 ">
            <input class="sr-only peer/employer" type="radio" id="employer" name="role" value="employer" required>
            <label
                class="cursor-pointer md:w-96 py-20 bg-zinc-50 rounded-lg text-center border-2 border-zinc-300 shadow hover:bg-white hover:border-zinc-400 peer-checked/employer:bg-white peer-checked/employer:border-indigo-400 peer-checked/employer:shadow-xl duration-150"
                for="employer">
                <h2 class="text-2xl font-semibold text-zinc-700">Looking for new hires?</h2>
                <p class="text-lg text-zinc-500 mt-4">Register as Employer</p>
            </label>


            <input class="sr-only peer/employee" type="radio" id="candidate" name="role" value="candidate" required>
            <label
                class="cursor-pointer md:w-96 py-20 bg-zinc-50 rounded-lg text-center border-2 border-zinc-300 shadow hover:bg-white hover:border-zinc-400 peer-checked/employee:bg-white peer-checked/employee:border-indigo-400 peer-checked/employee:shadow-xl duration-150"
                for="candidate">
                <h2 class="text-2xl font-semibold text-zinc-700">Looking for a
                    job?</h2>
                <p class="text-lg text-zinc-500 mt-4">Register as Employee</p>
            </label>
        </div>
        <div class="mt-4 flex justify-end w-full">
            <x-primary-button>
                {{ __('Next') }}
            </x-primary-button>
        </div>
    </form>
    <!-- </div> -->
</x-guest-layout>