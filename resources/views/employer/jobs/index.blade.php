<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="py-12">
        <div class="container mx-auto">
            <div class="text-zinc-800 dark:text-zinc-200 p-6">
                @if ($jobs->count())
                    <div class="flex flex-col justify-between min-h-[calc(100dvh-220px)]">
                        <div class="flex justify-end mb-12">
                            <a href="{{ route('jobs.create') }}" title="Add new job"
                                class="group cursor-pointer outline-none hover:rotate-90 duration-300 text-4xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                    class="stroke-indigo-400 fill-none group-hover:fill-indigo-100 group-hover:stroke-indigo-600 group-active:stroke-indigo-500 group-active:fill-indigo-200 group-active:duration-0 duration-300 dark:group-hover:fill-indigo-800 dark:group-active:stroke-indigo-200 dark:group-active:fill-indigo-600">
                                    <path
                                        d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                                        stroke-width="1.5"></path>
                                    <path d="M8 12H16" stroke-width="1.5"></path>
                                    <path d="M12 16V8" stroke-width="1.5"></path>
                                </svg>
                            </a>

                        </div>
                        <div class="mb-auto grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                            @foreach ($jobs as $job)
                                <div
                                    class="bg-zinc-50 dark:bg-zinc-800 p-6 rounded-lg shadow-md hover:shadow-lg dark:shadow-indigo-950 border border-zinc-50 hover:border-indigo-200 dark:border-zinc-800 dark:hover:border-indigo-700 dark:hover:bg-zinc-950 hover:bg-white duration-500 text-zinc-600 dark:text-zinc-200">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-xl">{{ $job->title }}</h2>
                                        <span
                                            class="px-3 py-1 rounded-md bg-indigo-800 text-white text-sm capitalize shadow">{{ $job->status }}
                                        </span>
                                    </div>
                                    <span
                                        class="mt-2 text-sm text-zinc-400 dark:text-zinc-600">{{ $job->created_at->diffForHumans() }}</span>
                                    <div class="flex items-center mt-4 gap-2 capitalize">
                                        <p>{{ $job->category }}</p>
                                        <span>-</span>
                                        <p>{{ $job->location }}</p>
                                        <a href="{{ route('jobs.show', $job->id) }}"
                                            class="flex items-center gap-1 text-md text-indigo-400 ml-auto hover:text-indigo-600 hover:animate-pulse duration-150 group">
                                            <span>View</span>
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="1em"
                                                height="1em" class="transform duration-300 group-hover:rotate-45">
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
                            class="text-6xl p-8 text-indigo-600 rounded-full dark:bg-zinc-800 border border-indigo-600 shadow-lg">
                            <svg width="1em" height="1em" viewBox="0 0 312 312" xmlns="http://www.w3.org/2000/svg">
                                <g id="empty_inbox" data-name="empty inbox" transform="translate(-2956.982 -3048.416)">
                                    <path id="Path_26" data-name="Path 26"
                                        d="M3268.982,3078.286a29.869,29.869,0,0,0-29.869-29.87H2986.851a29.869,29.869,0,0,0-29.869,29.87v252.259a29.87,29.87,0,0,0,29.869,29.871h252.262a29.87,29.87,0,0,0,29.869-29.871Zm-281.9-4.87H3239.3a5.378,5.378,0,0,1,5.684,5.268v141.732h-73.54a12.038,12.038,0,0,0-12.114,12.025,47.854,47.854,0,0,1-95.668,1.918,11.273,11.273,0,0,0,.162-1.906,12.049,12.049,0,0,0-12.116-12.037h-70.724V3078.684C2980.982,3075.574,2983.97,3073.416,2987.08,3073.416Zm252.218,263H2987.08c-3.11,0-6.1-2.4-6.1-5.514v-86.486h59.426a72.092,72.092,0,0,0,142.13,0h62.444V3330.9A5.577,5.577,0,0,1,3239.3,3336.416Z"
                                        fill="currentColor" />
                                </g>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-indigo-600 dark:text-indigo-600">You have not posted any jobs
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
                                    class="absolute bottom-0 rotate-180 left-0 inline-block w-4 h-4 transition-all duration-500 ease-in-out bg-indigo-800 rounded group-hover:-ml-4 group-hover:-mb-4">
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
</x-app-layout>