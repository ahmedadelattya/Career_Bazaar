<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Employer_DashBoard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg flex">
                <div class="">
                    <img src="{{ asset('images/employers/' . Auth::user()->image) }}">
                </div>
                <div class="p-6 text-zinc-900 dark:text-zinc-100">
                    <p class="font-bold text-4xl"> {{ Auth::user()->name }} </p>
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
