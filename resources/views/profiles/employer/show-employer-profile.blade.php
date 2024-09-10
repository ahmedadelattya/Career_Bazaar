<x-app-layout>
    <div class="py-12 container mx-auto px-4">
        <div class="bg-zinc-50 dark:bg-zinc-800 p-6 rounded-lg shadow-lg">
            <div class="flex items-center gap-4 mb-4 relative">
                <!-- User Image -->
                <img src="{{ asset('images/employers/' . $user->image) }}" alt="User image"
                    class="w-32 h-32 rounded-full border-2 border-indigo-400 dark:border-indigo-700 shadow-lg">
                <div>
                    <!-- User Name -->
                    <h2 class="text-2xl font-semibold text-zinc-800 dark:text-zinc-200 capitalize">{{$user->name}}</h2>
                    <!-- User Email -->
                    <p class="text-zinc-500 dark:text-zinc-400">{{$user->email}}</p>
                    <!-- Joined Date -->
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        Joined on {{ \Carbon\Carbon::parse($user->created_at)->format('F j, Y') }}
                    </p>
                </div>
                <!-- Edit Link -->
                <a href="{{route('profile.edit')}}" data-tooltip-target="tooltip-edit-profile"
                    data-tooltip-placement="left"
                    class="absolute right-0 top-0 ml-auto mb-auto text-zinc-400 hover:text-indigo-600 dark:text-zinc-500 dark:hover:text-indigo-700 duration-200 text-4xl">
                    <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                </a>
                <div id="tooltip-edit-profile" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-indigo-800 rounded-lg shadow-sm opacity-0 tooltip dark:bg-indigo-700 duration-200">
                    Edit profile
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

            </div>

            <!-- Company Name -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Company:</h3>
                <p class="text-zinc-600 dark:text-zinc-300">{{$user->company_name ?? "Not provided"}}</p>
            </div>

            <!-- Website Link -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">Website:</h3>
                <a href="{{$user->website ?? "#"}}"
                    class="text-zinc-600 hover:text-indigo-700 dark:text-zinc-300 dark:hover:text-indigo-600 duration-200">{{$user->website ?? "Not provided"}}</a>
            </div>
            <!-- About Section -->
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">About:</h3>
                <p class="text-zinc-600 dark:text-zinc-300">{{$user->about ?? "Not provided"}}</p>
            </div>
        </div>
    </div>
</x-app-layout>
<!-- 
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/employers/' . $user->image) }}" class="w-60" alt="">
            <h4 class="text-2xl">{{ $user->name }}</h4>
            <h4 class="text-2xl">{{ $user->email }}</h4>
            <h4 class="text-2xl">{{ $user->company_name }}</h4>
            <h4 class="text-2xl">{{ $user->about }}</h4>
            <a href="{{ $user->website }}" class="underline text-blue-600 hover:text-white">Visit us</a>
        </div>
-->



{{-- ------------------------------------------------------------------------------------------------------------- --}}
{{-- ------------------------------------------------------------------------------------------------------------- --}}
{{-- ------------------------------------------------------------------------------------------------------------- --}}
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Employer_Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-zinc-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
--}}