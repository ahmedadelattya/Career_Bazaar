<x-app-layout>
    <div id="notificationsContainer" class="fixed top-0 right-0 z-50 w-full p-4 space-y-4 md:w-1/3">
        @foreach ($notifications as $notification)
            <div x-data="{ show: true, timer: 5 }" x-show="show" x-init="setTimeout(() => show = false, 5000);
                        setInterval(() => { if (timer > 0) timer--; }, 1000)"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-full"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-full"
                class="relative flex items-center p-4 text-gray-700 bg-white border-l-4 rounded-lg shadow-lg dark:bg-zinc-800 dark:text-gray-100
                           {{ isset($notification->data['status']) ? ($notification->data['status'] === 'approved' ? 'border-green-500' : 'border-red-500') : 'border-gray-500' }}">
                <div class="flex-shrink-0 mr-3">
                    @if (isset($notification->data['status']))
                        @if ($notification->data['status'] === 'approved')
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4">
                                </path>
                            </svg>
                        @else
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        @endif
                    @else
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 9 9-9">
                            </path>
                        </svg>
                    @endif
                </div>

                <div class="flex-grow">
                    @if (isset($notification->data['status']))
                        <p class="text-sm font-medium">
                            {{ $notification->data['job_title'] }} has been {{ $notification->data['status'] }}.
                        </p>
                    @else
                        <p class="text-sm font-medium">
                            {{ $notification->data['message'] ?? 'No message available' }}
                        </p>
                    @endif
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
    @if (session('success'))
        <x-success-toast :message="session('success')" />
    @endif
    <div class="py-12">
        <div class="container mx-auto">
            <div class="p-6 text-zinc-800 dark:text-zinc-200">
                @if ($jobs->count())
                    <div class="flex flex-col justify-between min-h-[calc(100dvh-220px)]">
                        <div class="flex justify-between mb-12">
                            <h1 class="text-2xl font-bold">Your recent job posts</h1>
                            <a href="{{ route('jobs.create') }}" title="Add new job"
                                class="text-4xl duration-300 outline-none cursor-pointer group hover:rotate-90">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                    class="duration-300 stroke-indigo-400 fill-none group-hover:fill-indigo-100 group-hover:stroke-indigo-600 group-active:stroke-indigo-500 group-active:fill-indigo-200 group-active:duration-0 dark:group-hover:fill-indigo-800 dark:group-active:stroke-indigo-200 dark:group-active:fill-indigo-600">
                                    <path
                                        d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                                        stroke-width="1.5"></path>
                                    <path d="M8 12H16" stroke-width="1.5"></path>
                                    <path d="M12 16V8" stroke-width="1.5"></path>
                                </svg>
                            </a>

                        </div>
                        <div class="grid grid-cols-1 gap-4 mb-auto lg:grid-cols-2">
                            @foreach ($jobs as $job)
                                <div
                                    class="p-6 duration-500 border rounded-lg shadow-md bg-zinc-50 dark:bg-zinc-800 hover:shadow-lg dark:shadow-indigo-950 border-zinc-50 hover:border-indigo-200 dark:border-zinc-800 dark:hover:border-indigo-700 dark:hover:bg-zinc-950 hover:bg-white text-zinc-600 dark:text-zinc-200">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-xl">{{ $job->title }}</h2>
                                        <!-- Status badges -->
                                        <div>
                                            @if ($job->status === 'pending')
                                                <span data-tooltip-target="tooltip-pending" data-tooltip-placement="bottom"
                                                    class="bg-amber-100 text-amber-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded  dark:bg-amber-700 dark:text-amber-400 border border-amber-500 capitalize ">
                                                    <svg class="w-[1em] h-[1em] me-1.5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                                    </svg>
                                                    {{ $job->status }}
                                                </span>
                                                <div id="tooltip-pending" role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white rounded-lg shadow-sm opacity-0 bg-zinc-900 tooltip dark:bg-zinc-700">
                                                    Pending manual review.
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            @elseif ($job->status === 'approved')
                                                <span
                                                    class="bg-emerald-100 text-emerald-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded  dark:bg-emerald-700 dark:text-emerald-400 border border-emerald-500 capitalize">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[1em] h-[1em] me-1.5"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-check-circle">
                                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                    </svg>
                                                    Published
                                                </span>
                                            @elseif ($job->status === 'declined')
                                                <span data-tooltip-target="tooltip-declined" data-tooltip-placement="bottom"
                                                    class="bg-red-100 text-red-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded  dark:bg-red-700 dark:text-red-100 border border-red-500 capitalize">
                                                    <svg class="fill-current w-[1em] h-[1em] me-1.5" viewBox="0 0 36 36"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M23.7,10.41a1,1,0,0,1-.71-.29L15.56,2.69A1,1,0,0,1,17,1.28l7.44,7.43a1,1,0,0,1-.71,1.7Z">
                                                        </path>
                                                        <path
                                                            d="M11.86,22.25a1,1,0,0,0-.29-.71L4.14,14.11a1,1,0,0,0-1.42,1.42L10.15,23a1,1,0,0,0,1.42,0A1,1,0,0,0,11.86,22.25Z">
                                                        </path>
                                                        <path
                                                            d="M21.93,34H3a1,1,0,0,1-1-1.27l1.13-4a1,1,0,0,1,1-.73H20.8a1,1,0,0,1,1,.73l1.13,4a1,1,0,0,1-.17.87A1,1,0,0,1,21.93,34ZM4.31,32H20.6L20,30H4.87Z">
                                                        </path>
                                                        <path
                                                            d="M33.11,27.44l-14-14,2.36-2.36L14.52,4.13,5.58,13.07,12.51,20l2.35-2.34,14,14a3,3,0,0,0,4.24,0A3,3,0,0,0,33.11,27.44ZM8.4,13.07,14.52,7l4.11,4.11-6.12,6.11Zm23.29,17.2a1,1,0,0,1-1.41,0l-14-14,1.41-1.41,14,14A1,1,0,0,1,31.69,30.27Z">
                                                        </path>
                                                    </svg>

                                                    {{ $job->status }}
                                                </span>
                                                <div id="tooltip-declined" role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white rounded-lg shadow-sm opacity-0 bg-zinc-900 tooltip dark:bg-zinc-700 max-w-48">
                                                    Sorry, your post will not be publish since it does not follow our
                                                    policies.
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <span
                                        class="mt-2 text-sm text-zinc-400 dark:text-zinc-600">{{ $job->created_at->diffForHumans() }}</span>
                                    <div class="flex items-center gap-2 mt-4 capitalize">
                                        <div class="flex flex-col">
                                            <p class="dark:text-zinc-400">{{ $job->category }}</p>
                                            <p class="dark:text-zinc-500">{{ $job->location }}</p>
                                        </div>
                                        <a href="{{ route('jobs.show', $job->id) }}"
                                            class="flex items-center gap-1 ml-auto text-indigo-400 duration-150 text-md hover:text-indigo-600 hover:animate-pulse group">
                                            <span>View</span>
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="1em"
                                                height="1em" class="duration-300 transform group-hover:rotate-45">
                                                <path d="M7 17L17 7M17 7H8M17 7V16" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <!--** TODO: Customize Tailwind Pagination **-->
                            {{ $jobs->links() }}
                            <!--** TODO: Customize Tailwind Pagination **-->
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center gap-10 ">
                        <div
                            class="p-8 text-6xl text-indigo-600 border border-indigo-600 rounded-full shadow-lg dark:bg-zinc-800">
                            <svg width="1em" height="1em" viewBox="0 0 312 312" xmlns="http://www.w3.org/2000/svg">
                                <g id="empty_inbox" data-name="empty inbox" transform="translate(-2956.982 -3048.416)">
                                    <path id="Path_26" data-name="Path 26"
                                        d="M3268.982,3078.286a29.869,29.869,0,0,0-29.869-29.87H2986.851a29.869,29.869,0,0,0-29.869,29.87v252.259a29.87,29.87,0,0,0,29.869,29.871h252.262a29.87,29.87,0,0,0,29.869-29.871Zm-281.9-4.87H3239.3a5.378,5.378,0,0,1,5.684,5.268v141.732h-73.54a12.038,12.038,0,0,0-12.114,12.025,47.854,47.854,0,0,1-95.668,1.918,11.273,11.273,0,0,0,.162-1.906,12.049,12.049,0,0,0-12.116-12.037h-70.724V3078.684C2980.982,3075.574,2983.97,3073.416,2987.08,3073.416Zm252.218,263H2987.08c-3.11,0-6.1-2.4-6.1-5.514v-86.486h59.426a72.092,72.092,0,0,0,142.13,0h62.444V3330.9A5.577,5.577,0,0,1,3239.3,3336.416Z"
                                        fill="currentColor" />
                                </g>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-600">You have not posted any
                            jobs
                            yet
                        </h1>
                        <div class="">
                            <a href="{{ route('jobs.create') }}"
                                class="relative flex items-center px-6 py-3 overflow-hidden font-medium transition-all bg-indigo-600 rounded-md group">
                                <span
                                    class="absolute top-0 right-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-800 rounded group-hover:-mr-4 group-hover:-mt-4">
                                    <span
                                        class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 dark:bg-zinc-900"></span>
                                </span>
                                <span
                                    class="absolute bottom-0 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out rotate-180 bg-indigo-800 rounded group-hover:-ml-4 group-hover:-mb-4">
                                    <span
                                        class="absolute top-0 right-0 w-5 h-5 rotate-45 translate-x-1/2 -translate-y-1/2 dark:bg-zinc-900"></span>
                                </span>
                                <span
                                    class="absolute bottom-0 left-0 w-full h-full transition-all duration-500 ease-in-out delay-200 -translate-x-full bg-indigo-700 rounded-md group-hover:translate-x-0"></span>
                                <span
                                    class="relative w-full text-left text-white transition-colors duration-200 ease-in-out group-hover:text-white">Get
                                    Started</span>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


    <script>
        function createNotification(data) {
            const container = document.getElementById('notificationsContainer');
            const notification = document.createElement('div');

            let content;

            if (data.type === 'App\\Notifications\\JobStatusNotification') {
                content = `
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
                        ${data.job_title} has been ${data.status}.
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
            } else if (data.type === 'App\\Notifications\\CandidateApplied') {
                content = `
            <div x-data="{ show: true, timer: 5 }"
                 x-show="show"
                 x-init="setTimeout(() => { show = false; $el.remove(); }, 5000); setInterval(() => timer--, 1000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform translate-x-full"
                 x-transition:enter-end="opacity-100 transform translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-x-0"
                 x-transition:leave-end="opacity-0 transform translate-x-full"
                 class="relative flex items-center p-4 mb-4 text-gray-700 bg-white border-l-4 border-blue-500 rounded-lg shadow-lg dark:bg-zinc-800 dark:text-gray-100">
                <div class="flex-shrink-0 mr-3">
                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 9 9-9"></path>
                    </svg>
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
            }

            notification.innerHTML = content;
            container.prepend(notification.firstElementChild);
        }
    </script>
</x-app-layout>