<x-app-layout>
    <div class="container p-6 mx-auto">
        <!-- Profile Section -->

        <div
            class="flex flex-col items-start gap-8 p-8 bg-white shadow-lg dark:bg-zinc-800 rounded-xl md:gap-0 md:flex-row md:space-x-8">
            <!-- Profile Picture & CV Download -->
            <div class="flex-shrink-0 mx-auto mb-4 sm:mb-0 md:mx-0">
                <!-- Profile Picture -->
                <div class="relative w-36 h-36">
                    @if ($user->image && Str::startsWith($user->image, 'http'))
                        <img src="{{ $user->image }}" alt="Profile Picture"
                            class="object-cover w-full h-full border-4 border-indigo-500 rounded-full shadow-lg">
                    @elseif ($user->image && file_exists(public_path('images/candidates/' . $user->image)))
                        <img src="{{ asset("images/candidates/$user->image") }}" alt="Profile Picture"
                            class="object-cover w-full h-full border-4 border-indigo-500 rounded-full shadow-lg">
                    @else
                        <img src="{{ asset('images/default-avatar.jpg') }}" alt="Profile Picture"
                            class="object-cover w-full h-full border-4 border-indigo-500 rounded-full shadow-lg">
                    @endif

                    <!-- CV Download Icon -->
                    @if ($user->cv_pdf)
                        <a href="{{ asset('pdfs/' . $user->cv_pdf) }}" target="_blank"
                            class="absolute bottom-0 right-0 p-2 transition-transform duration-300 transform bg-indigo-500 rounded-full shadow-lg hover:scale-110">
                            <svg class="w-6 h-6 text-indigo-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </a>
                    @endif
                </div>
            </div>

            <!-- User Info & Content -->
            <div class="relative flex-grow">
                <!-- Edit Link -->
                <a href="{{ route('profile.edit') }}" data-tooltip-target="tooltip-edit-profile"
                    data-tooltip-placement="left"
                    class="absolute top-0 right-0 mb-auto ml-auto text-4xl duration-200 text-zinc-400 hover:text-indigo-600 dark:text-zinc-500 dark:hover:text-indigo-700">
                    <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                </a>
                <!-- User Name, Job Title & Email -->

                <div class="mb-4">
                    <h2 class="text-3xl font-bold text-zinc-800 dark:text-zinc-200">{{ $user->name }}</h2>
                    <p class="text-sm text-indigo-600 dark:text-indigo-400">
                        {{ $user->candidate_job_title ?? 'No Job Title Available' }}
                    </p>
                    <p class="text-zinc-600 dark:text-zinc-400">{{ $user->email }}</p>
                </div>

                <!-- Job Description -->
                @if ($user->candidate_job_description)
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-zinc-800 dark:text-zinc-200">About Me</h3>
                        <p class="text-sm leading-relaxed text-zinc-600 dark:text-zinc-400">
                            {{ $user->candidate_job_description }}
                        </p>
                    </div>
                @endif

                <!-- Skills Section -->
                <div class="mb-4">
                    <h3 class="mb-2 text-lg font-semibold text-zinc-800 dark:text-zinc-200">Skills</h3>
                    <div class="flex flex-wrap gap-2">
                        @if ($user->candidate_skills && count($user->candidate_skills) > 0 && $user->candidate_skills[0] !== null)
                            @foreach ($user->candidate_skills as $skill)
                                <span
                                    class="bg-indigo-100 dark:bg-indigo-700 text-indigo-600 dark:text-indigo-100 px-2.5 py-0.5 rounded-lg text-sm shadow-md">
                                    {{ $skill }}
                                </span>
                            @endforeach
                        @else
                            <p class="text-zinc-600 dark:text-zinc-400">No skills added yet</p>
                        @endif
                    </div>
                </div>

                <!-- Projects Section -->
                <div class="mb-4">
                    <h3 class="mb-2 text-lg font-semibold text-zinc-800 dark:text-zinc-200">Projects</h3>
                    <div class="grid grid-cols-2 gap-2 lg:grid-cols-3 xl:grid-cols-4">
                        @if ($user->candidate_projects && count($user->candidate_projects) > 0 && $user->candidate_projects[0] !== null)
                            @foreach ($user->candidate_projects as $project)
                                <div>
                                    <a href="{{ $project }}" target="_blank"
                                        class="flex items-center gap-2 text-sm duration-200 text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-500 hover:underline underline-offset-4 ">
                                        <svg class="w-[1em] h-[1em] " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                        </svg>
                                        <span class="truncate">
                                            {{ $project }}
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-zinc-600 dark:text-zinc-400">No projects added yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- application section --}}
        <div class="mt-6 space-y-6">
            @foreach ($user->applications as $application)
                        @php
                            $job = $application->job;
                        @endphp
                        <div
                            class="p-4 border rounded-lg shadow bg-zinc-100 text-zinc-800 dark:text-zinc-200 dark:bg-zinc-800 dark:border-zinc-700">
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
                                <div class="object-cover overflow-hidden rounded-lg shadow-sm">
                                    @if ($job->user->image && Str::startsWith($job->user->image, 'http'))
                                        <img src="{{ $job->user->image }}" alt="Company logo" class="max-w-28">
                                    @elseif ($job->user->image && file_exists(public_path('images/employers/' . $job->user->image)))
                                        <img src="{{ asset('images/employers/' . $job->user->image) }}" alt="Company logo"
                                            class="max-w-28">
                                    @else
                                        <img src="{{ asset('images/image-not-found.jpg') }}" class="max-w-28">
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
</x-app-layout>