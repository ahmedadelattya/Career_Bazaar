<x-app-layout>

    <div class="container text-white text-center mx-auto pt-6">

        <header class="text-2xl font-bold text-white">
            {{ __('Results for ??? ') }}
        </header>

        <div class="mt-6 space-y-6 ">
            @foreach ($jobs as $job)
                <div class="p-4 border rounded-lg shadow bg-zinc-100 dark:bg-zinc-800 dark:border-zinc-700">
                    <div class="flex justify-between">
                        <div>
                            <h2 class="mb-2 text-2xl font-semibold">{{ $job->title }}
                                -- {{ $job->fixed_salary }} -- {{ $job->hourly_rate }} </h2>
                            <div class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                                <p class="">{{ $job->user->company_name ?? 'N/A' }}</p>
                                <span>-</span>
                                <p>{{ $job->location }}</p>
                            </div>
                            <span class="inline-block text-xs text-zinc-300 dark:text-zinc-500">Posted
                                {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="object-cover">
                            <img src="{{ asset('images/employers/images/ktBcKk3j1feuHcLgtvSyX2LLL2Uh8ov5iRo1urPs.jpg') }}"
                                alt="Company logo" class="max-w-28">
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



</x-app-layout>
