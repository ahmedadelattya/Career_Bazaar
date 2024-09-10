<x-app-layout>
    <div id="notificationsContainer" class="fixed top-0 right-0 z-50 w-full p-4 space-y-4 md:w-1/3">
        @foreach ($notifications as $notification)
            <div x-data="{ show: true, timer: 5 }" x-show="show" x-init="setTimeout(() => show = false, 5000);
            setInterval(() => timer--, 1000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full"
                class="relative flex items-center p-4 text-gray-700 bg-white border-l-4 rounded-lg shadow-lg dark:bg-zinc-800 dark:text-gray-100
                        {{ $notification->data['status'] === 'approved' ? 'border-green-500' : 'border-red-500' }}">
                <div class="flex-shrink-0 mr-3">
                    @if ($notification->data['status'] === 'approved')
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4">
                            </path>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    @endif
                </div>
                <div class="flex-grow">
                    <p class="text-sm font-medium">
                        {{ $notification->data['message'] }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="ml-auto text-sm font-medium" x-text="timer"></div>
                <button @click="show = false" class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class=" text-zinc-800 dark:text-zinc-200">
                <header class="text-2xl font-bold ">
                    {{ __('Newly added jobs') }}
                </header>
                <div class="mt-6 space-y-6">
                    @foreach ($jobs as $job)
                        <div class="p-4 border rounded-lg shadow bg-zinc-100 dark:bg-zinc-800 dark:border-zinc-700">
                            <div class="flex justify-between">
                                <div>
                                    <h2 class="mb-2 text-2xl font-semibold">{{ $job->title }}</h2>
                                    <div class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                                        <p class="">{{ $job->user->company_name ?? 'N/A' }}</p>
                                        <span>-</span>
                                        <p>{{ $job->location }}</p>
                                    </div>
                                    <span class="inline-block text-xs text-zinc-300 dark:text-zinc-500">Posted
                                        {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="object-cover">
                                    @if($job->image && file_exists(public_path("images/candidates/$job->image")))
                                        <img src="{{ asset('images/employers/images/ktBcKk3j1feuHcLgtvSyX2LLL2Uh8ov5iRo1urPs.jpg') }}"
                                            alt="Company logo" class="max-w-28">
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4">
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->job_type }}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->work_place }}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->salary_type === 'fixed' ? 'Fixed salary' : 'Hourly rate' }}</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 mt-4">
                                <div class="capitalize divide-x-2 divide-zinc-700">
                                    <span class="pr-1 ">{{ $job->experience_level }}</span><span
                                        class="pl-1 ">{{ $job->category }}</span>
                                </div>
                                <ul class="flex items-center gap-2">
                                    @foreach (json_decode($job->skills) as $skill)
                                        @if ($loop->iteration < 4)
                                            <li
                                                class="bg-zinc-100 text-zinc-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-zinc-700 dark:text-zinc-300">
                                                {{ $skill }}
                                            </li>
                                        @elseif ($loop->iteration === 4)
                                            <li class="text-xs font-medium text-zinc-800 dark:text-zinc-300">
                                                and more...
                                            </li>
                                            @break
                                        @endif
                                    @endforeach
                                </ul>

                                <a href="{{ route('jobs.show', $job->id) }}"
                                    class="flex justify-center gap-2 items-center ml-auto text-sm bg-zinc-50 dark:bg-zinc-700 backdrop-blur-md lg:font-semibold isolation-auto border-zinc-50 dark:border-zinc-500 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-indigo-600 hover:text-zinc-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-2.5 py-1 overflow-hidden border-2 rounded-full group">
                                    More details
                                    <svg class="justify-end w-8 h-8 p-2 duration-300 ease-linear rotate-45 rounded-full group-hover:rotate-90 group-hover:bg-zinc-50 text-zinc-50 group-hover:border-none"
                                        viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                                            class="fill-zinc-600 group-hover:fill-zinc-600"></path>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
<<<<<<< HEAD
    {{ $jobs->links() }}
=======
</div>
{{ $jobs->links() }}
<script>
    function createNotification(data) {
        const container = document.getElementById('notificationsContainer');
        const notification = document.createElement('div');
>>>>>>> baa39b7c6399a6f6517962387eb23b3cb772abf5

        notification.innerHTML = `
        <div x-data="{ show: true, timer: 5 }"
             x-show="show"
             x-init="setTimeout(() => { show = false; $el.remove(); }, 5000); setInterval(() => timer--, 1000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform translate-x-full"
             class="relative flex items-center p-4 mb-4 text-gray-700 bg-white border-l-4 rounded-lg shadow-lg dark:bg-zinc-800 dark:text-gray-100
                    ${data.status === 'approved' ? 'border-green-500' : 'border-red-500'}">
            <div class="flex-shrink-0 mr-3">
                ${data.status === 'approved'
                    ? '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path></svg>'
                    : '<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>'
                }
            </div>
            <div class="flex-grow">
                <p class="text-sm font-medium">
                    ${data.message}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    Just now
                </p>
            </div>
            <div class="ml-auto text-sm font-medium" x-text="timer"></div>
            <button @click="show = false" class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    `;

        container.prepend(notification.firstElementChild);
    }
</script>
</x-app-layout>
<<<<<<< HEAD
<!--
<div class="overflow-hidden bg-white shadow-sm dark:bg-zinc-800 sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">

@if (session('success'))
<div class="relative px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
    <strong class="font-bold">{{ session('success') }}</strong>
</div>
@endif

<h3 class="mb-4 font-semibold">{{ __('Approved Job Listings') }}</h3>

@if ($jobs->isEmpty())
<p>{{ __('No approved jobs available.') }}</p>
@else
@foreach ($jobs as $job)
<div class="p-4 mb-4 rounded-lg shadow bg-zinc-100 dark:bg-zinc-700">
        <h4 class="font-bold">{{ $job->title }}</h4>
        <p>{{ $job->description }}</p>
        <p><strong>{{ __('Category:') }}</strong> {{ $job->category }}</p>
        <p><strong>{{ __('Location:') }}</strong> {{ $job->location }}</p>
        <p><strong>{{ __('Salary Type:') }}</strong> {{ ucfirst($job->salary_type) }}</p>

        @if (in_array($job->id, $appliedJobs))
<button disabled class="px-4 py-2 text-white bg-gray-400 rounded">{{ __('Applied') }}</button>
@else
<a href="{{ route('jobs.show', $job->id) }}" class="text-blue-500 hover:underline">{{ __('Apply Now') }}</a>
@endif
    </div>
@endforeach

{{ $jobs->links() }}
@endif
</div>
</div>
-->
=======
>>>>>>> baa39b7c6399a6f6517962387eb23b3cb772abf5
