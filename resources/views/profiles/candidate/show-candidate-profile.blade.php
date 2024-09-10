<x-app-layout>
    <div class="container p-6 mx-auto">
        <!-- Profile Section -->
        <div
            class="flex flex-col items-start gap-8 p-8 bg-white shadow-lg dark:bg-zinc-800 rounded-xl md:gap-0 md:flex-row md:space-x-8">
            <!-- Profile Picture & CV Download -->
            <div class="flex-shrink-0 mx-auto mb-4 sm:mb-0 md:mx-0">
                <!-- Profile Picture -->
                <div class="relative w-36 h-36">
                    @if ($user->image && file_exists(public_path("images/candidates/$user->image")))
                        <img class="object-cover w-full h-full border-4 border-indigo-500 rounded-full shadow-lg"
                            src="{{ asset("images/candidates/$user->image") }}" alt="Profile Picture">
                    @else
                        <img class="object-cover w-full h-full border-4 border-indigo-500 rounded-full shadow-lg"
                            src="{{ asset('images/default-avatar.jpg') }}" alt="Default Profile Picture">
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
                                        <svg class="w-[1em] h-[1em] " aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                                        </svg>
                                        <span>
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
    </div>
</x-app-layout>
