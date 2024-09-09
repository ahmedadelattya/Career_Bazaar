<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto ">
            <div class="mx-4 sm:mx-0 bg-white text-zinc-800 shadow rounded-lg dark:bg-zinc-800 dark:text-zinc-200 ">
                <!-- Header -->
                <header class="p-6 border-b border-zinc-200 dark:border-zinc-700">
                    <div class="flex justify-between">
                        <div>
                            <h1 class="text-2xl font-bold">{{ $job->title }}</h1>
                            <h4 class="dark:text-zinc-500 capitalize mt-2">{{ $job->category }} - {{ $job->location }}
                            </h4>
                        </div>
                        @if (auth()->user()->role === 'employer' && auth()->id() === $job->employer_id)
                            <!-- Status badges -->
                            <div>
                                @if ($job->status === 'pending')
                                    <span data-tooltip-target="tooltip-pending" data-tooltip-placement="bottom"
                                        class="bg-amber-100 text-amber-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-amber-700 dark:text-amber-400 border border-amber-500 capitalize ">
                                        <svg class="w-[1em] h-[1em] me-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                        </svg>
                                        {{ $job->status }}
                                    </span>
                                    <div id="tooltip-pending" role="tooltip"
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-zinc-700">
                                        Pending manual review.
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                @elseif ($job->status === 'approved')
                                    <span
                                        class="bg-emerald-100 text-emerald-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-emerald-700 dark:text-emerald-400 border border-emerald-500 capitalize">
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
                                        class="bg-red-100 text-red-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-red-700 dark:text-red-100 border border-red-500 capitalize">
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
                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-zinc-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-zinc-700 max-w-48">
                                        Sorry, your post will not be publish since it does not follow our policies.
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                @endif
                            </div>
                        @elseif (auth()->user()->role === 'candidate')
                            <img src="{{ asset('images/employers/images/ktBcKk3j1feuHcLgtvSyX2LLL2Uh8ov5iRo1urPs.jpg') }}"
                                alt="Company logo" class="max-w-24 object-cover rounded">
                        @endif
                    </div>
                </header>
                <div class="p-6 grid grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold">Job type</h3>
                        <p class="text-zinc-400">{{ $job->job_type ?? 'N/A' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold">Workplace</h3>
                        <p class="text-zinc-400">{{ $job->work_place ?? 'N/A' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold">Experience Level</h3>
                        <p class="text-zinc-400">{{ $job->experience_level ?? 'N/A' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-semibold">Salary</h3>
                        @if ($job->salary_type === 'fixed')
                            <div class="flex items-center gap-2 text-zinc-400">
                                <span>Fixed (USD)</span>
                                <span>-</span>
                                <span>${{ $job->fixed_salary }}</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 text-zinc-400">
                                <span>Hourly (USD)</span>
                                <span>-</span>
                                <span>${{ $job->hourly_rate }}</span>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold">Description</h2>
                        <p class="text-zinc-400">{{ $job->description }}</p>
                    </div>
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold">Requirements</h2>
                        <p class="text-zinc-400">{{ $job->requirements ?? 'N/A' }}</p>
                    </div>
                    <div class="space-y-2">
                        <h2 class="text-xl font-semibold">Skills</h2>
                        @if (!$job->skills)
                            <p class="text-zinc-400">N/A</p>
                        @else
                            <ul class="mt-2 flex items-center gap-2 flex-wrap">
                                @foreach ($job->skills as $skill)
                                    <li>
                                        <span
                                            class="bg-zinc-100 text-indigo-800 text-sm font-medium px-2.5 py-0.5 shadow rounded-md border border-indigo-800 dark:bg-zinc-700 dark:text-zinc-400 dark:border-zinc-400">
                                            {{ $skill }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="p-6 border-t border-zinc-200 dark:border-zinc-700">
                    <div class="flex items-center justify-between">
                        <div class="flex items-end gap-2 text-sm">
                            <h4 class="text-zinc-600 dark:text-zinc-300">Created
                                {{ $job->created_at->diffForHumans() }}
                            </h4>
                            <span>-</span>
                            <h4 class="text-zinc-400 dark:text-zinc-500">Last update
                                {{ $job->updated_at->diffForHumans() }}
                            </h4>
                        </div>
                        <!-- Conditional buttons based on user role -->
                        @if (auth()->user()->role === 'employer' && auth()->id() === $job->employer_id)
                            <!-- Show Edit and Delete buttons for employers -->
                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                <a href="{{ route('jobs.edit', $job->id) }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-900 bg-white border border-zinc-200 rounded-s-lg hover:bg-zinc-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white dark:hover:text-white dark:hover:bg-zinc-700 dark:focus:ring-indigo-500 dark:focus:text-white">
                                    <svg class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2" />
                                    </svg>
                                    Edit
                                </a>

                                <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-900 bg-white border border-zinc-200 rounded-e-lg hover:bg-zinc-100 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700 dark:bg-zinc-800 dark:border-zinc-700 dark:text-white dark:hover:text-white dark:hover:bg-zinc-700 dark:focus:ring-indigo-500 dark:focus:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 me-2" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" aria-hidden="true" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path
                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                        </path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                    Delete
                                </button>
                            </div>
                        @elseif (auth()->user()->role === 'candidate')
                            <!-- Show Apply button for candidates -->
                            <button type="button" data-modal-target="apply-modal" data-modal-toggle="apply-modal"
                                @if ($hasApplied) disabled @endif
                                class="focus:outline-none text-zinc-200  bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 duration-150">
                                {{ $hasApplied ? 'Already Applied' : 'Apply' }}
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Apply Modal -->
    <div id="apply-modal" tabindex="-1" aria-hidden="true"
        class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="relative p-4 w-full max-w-2xl bg-white rounded-lg shadow dark:bg-zinc-800">
            <!-- Close button -->
            <button type="button" data-modal-toggle="apply-modal"
                class="absolute top-3 right-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm p-1.5 inline-flex items-center dark:hover:bg-zinc-700 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <!-- Modal content -->
            <h3 class="text-xl font-bold text-zinc-800 dark:text-zinc-200 mb-4">Apply for "{{ $job->title }}"
                vacancy</h3>
            <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data"
                class="mt-4">
                @csrf
                <!-- Candidate Name -->
                <div class="mb-4">
                    <label for="name" class="block text-md mb-2 font-medium text-zinc-700 dark:text-zinc-300">Full
                        Name</label>
                    <input type="text" id="name" name="name"
                        class="block p-2.5 w-full text-md text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required>
                </div>

                <!-- Candidate Email -->
                <div class="mb-4">
                    <label for="email"
                        class="block text-md mb-2 font-medium text-zinc-700 dark:text-zinc-300">Email</label>
                    <input type="email" id="email" name="email"
                        class="block p-2.5 w-full text-md text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required>
                </div>

                <!-- Candidate Phone -->
                <div class="mb-4">
                    <label for="phone"
                        class="block text-md mb-2 font-medium text-zinc-700 dark:text-zinc-300">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="block p-2.5 w-full text-md text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required>
                </div>

                <!-- Upload Resume -->
                <div class="mb-4">
                    <label for="resume"
                        class="block text-md mb-2 font-medium text-zinc-700 dark:text-zinc-300">Resume</label>
                    <input type="file" id="resume" name="resume"
                        class="block w-full text-md text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 cursor-pointer focus:outline-none focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        accept=".pdf,.doc,.docx" required>
                </div>

                <!-- Cover Letter -->
                <div class="mb-4">
                    <label for="cover_letter"
                        class="block text-md mb-2 font-medium text-zinc-700 dark:text-zinc-300">Cover Letter</label>
                    <textarea id="cover_letter" name="cover_letter" rows="6"
                        class="block p-2.5 w-full text-md text-zinc-900 bg-zinc-50 rounded-lg border border-zinc-300 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-800 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 dark:bg-indigo-700 dark:hover:bg-indigo-800">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Delete Modal -->
    <div id="delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                <button type="button"
                    class="absolute top-3 end-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                    data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-zinc-400 w-12 h-12 dark:text-zinc-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-zinc-500 dark:text-zinc-400">Are you sure you want to
                        delete this post?</h3>
                    <button data-modal-hide="delete-modal" type="button"
                        onclick="submitDeleteForm({{ $job->id }})"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-zinc-900 focus:outline-none bg-white rounded-lg border border-zinc-200 hover:bg-zinc-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-zinc-100 dark:focus:ring-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-700">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Hidden form for delete action -->
    <form id="delete-form-{{ $job->id }}" method="POST" action="{{ route('jobs.destroy', $job->id) }}"
        style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <!-- JavaScript for modals and delete action -->
    <script>
        document.querySelectorAll('[data-modal-toggle]').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-modal-target');
                document.getElementById(targetId).classList.toggle('hidden');
            });
        });

        function submitDeleteForm(jobId) {
            document.getElementById('delete-form-' + jobId).submit();
        }
    </script>
</x-app-layout>
