<x-app-layout>
    <x-slot name="header">

        <h2 class=" text-xl text-zinc-700 dark:text-zinc-300 leading-tight">
            @if (count($applications) === 0)
                You have not received any applications yet for <span
                    class="font-semibold text-zinc-800 dark:text-zinc-200">"{{ $job->title }}"</span> Job post.
            @elseif (count($applications) === 1)
                You have received <span class="font-semibold text-zinc-800 dark:text-zinc-200">1</span> application for
                <span class="font-semibold text-zinc-800 dark:text-zinc-200">"{{ $job->title }}"</span> Job post.
            @else
                You have received <span
                    class="font-semibold text-zinc-800 dark:text-zinc-200">({{ count($applications) }})</span> applications
                for <span class="font-semibold text-zinc-800 dark:text-zinc-200">"{{ $job->title }}"</span> Job post.
            @endif
        </h2>
    </x-slot>
    <div class="py-12 container mx-auto px-4">
        @if (count($applications) === 0)
            <div class="flex flex-col items-center gap-4 font-bold text-2xl text-zinc-300 dark:text-zinc-700">
                <svg class="w-[4em] h-[4em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 13h3.439a.991.991 0 0 1 .908.6 3.978 3.978 0 0 0 7.306 0 .99.99 0 0 1 .908-.6H20M4 13v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-6M4 13l2-9h12l2 9" />
                </svg>
                <p class="">You did not receive any applications
                    yet</p>
            </div>
        @else
                @foreach ($applications as $application)
                        <div
                            class="mx-auto max-w-4xl bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 rounded-lg shadow-lg overflow-hidden space-y-4">
                            <div class="flex items-center justify-between p-4 border-zinc-700 border-b">
                                <h2 class="text-xl font-semibold">Applicant name: <span
                                        class="font-normal">{{ $application->name }}</span>
                                </h2>
                                <!-- Status Logic -->
                                <div>
                                    @if ($application->status === 'pending')
                                        <span
                                            class="bg-amber-100 text-amber-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-amber-700 dark:text-amber-400 border border-amber-500 capitalize ">
                                            <svg class="w-[1em] h-[1em] me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                            </svg>
                                            {{ $application->status }}
                                        </span>
                                    @elseif ($application->status === 'accepted')
                                        <span
                                            class="bg-emerald-100 text-emerald-800 text-sm font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-emerald-700 dark:text-emerald-400 border border-emerald-500 capitalize">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[1em] h-[1em] me-1.5" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" class="feather feather-check-circle">
                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                            </svg>
                                            {{$application->status}}
                                        </span>
                                    @elseif ($application->status === 'rejected')
                                        <span
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

                                            {{ $application->status }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-start gap-4 px-4">
                                @if($application->candidate->image && file_exists(public_path("images/candidates/" . $application->candidate->image)))
                                    <img src="{{asset("images/candidates/" . $application->candidate->image)}}" class="size-28 rounded-lg">
                                @else
                                    <img class="size-28 rounded-lg" src="{{ asset('images/default-avatar.jpg') }}"
                                        alt="Default Profile Picture">
                                @endif
                                <div class="">
                                    <h3 class="text-lg font-semibold mb-2">Contact Info</h3>

                                    <div class="grid grid-cols-2 gap-y-2 gap-x-4 max-w-fit">
                                        <a href="mailto:{{$application->email}}"
                                            class="text-zinc-700 dark:text-zinc-400 flex items-center gap-2 hover:text-indigo-600 dark:hover:text-indigo-600 duration-150">
                                            <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                    d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                            </svg>
                                            {{$application->email}}</a>
                                        <a href="tel:{{$application->phone}}"
                                            class="text-zinc-700 dark:text-zinc-400 flex items-center gap-2 hover:text-indigo-600 dark:hover:text-indigo-600 duration-150">
                                            <svg class="w-[1em] h-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z" />
                                            </svg>
                                            {{$application->phone}}</a>
                                        <a href="{{ asset("resumes/applications/$application->resume")}}" target="_blank"
                                            class="text-zinc-700 dark:text-zinc-400 flex items-center gap-2 hover:text-indigo-600 dark:hover:text-indigo-600 duration-150">
                                            <svg class="size-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd"
                                                    d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            View resume
                                        </a>
                                        <h3 class="text-zinc-700 dark:text-zinc-400 flex items-center gap-2 cursor-pointer hover:text-indigo-600 dark:hover:text-indigo-600 duration-150"
                                            data-modal-target="cover-letter-modal" data-modal-toggle="cover-letter-modal">
                                            <svg class="size-[1em]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18 5V4a1 1 0 0 0-1-1H8.914a1 1 0 0 0-.707.293L4.293 7.207A1 1 0 0 0 4 7.914V20a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5M9 3v4a1 1 0 0 1-1 1H4m11.383.772 2.745 2.746m1.215-3.906a2.089 2.089 0 0 1 0 2.953l-6.65 6.646L9 17.95l.739-3.692 6.646-6.646a2.087 2.087 0 0 1 2.958 0Z" />
                                            </svg>
                                            Cover letter
                                        </h3>
                                    </div>
                                </div>

                            </div>
                            <div class="p-4 border-zinc-700 border-t flex items-center justify-between">
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">Applied on
                                    {{ \Carbon\Carbon::parse($application->created_at)->format('M d, Y \a\t h:ia') }}
                                </p>

                                <div class="inline-flex rounded-md shadow-sm" role="group">
                                    <button type="button" data-modal-target="reject-modal" data-modal-toggle="reject-modal"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-900 bg-white border border-indigo-700 rounded-s-lg hover:bg-red-700 hover:text-white focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700 dark:bg-zinc-600 dark:border-zinc-700 duration-100 dark:text-white dark:hover:text-white dark:hover:bg-red-700 dark:focus:ring-indigo-500 dark:focus:text-white">
                                        <svg class="size-[1em] me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m15 9-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Reject
                                    </button>
                                    <button type="button" data-modal-target="accept-modal" data-modal-toggle="accept-modal"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-900 bg-white border border-indigo-700 rounded-e-lg hover:bg-green-700 hover:text-indigo-700 focus:z-10 focus:ring-2 focus:ring-indigo-700 focus:text-indigo-700 dark:bg-zinc-600 dark:border-zinc-700 duration-100 dark:text-white dark:hover:text-white dark:hover:bg-green-700 dark:focus:ring-indigo-500 dark:focus:text-white">
                                        <svg class="size-[1em] me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6" />
                                        </svg>
                                        Accept
                                    </button>
                                </div>

                                <!-- Confirmation Modals -->

                                <div id="reject-modal" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                                data-modal-hide="reject-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-zinc-400 w-12 h-12 dark:text-zinc-200" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-zinc-500 dark:text-zinc-400">Are you sure you
                                                    want to reject <span
                                                        class="text-zinc-600 dark:text-zinc-200 font-semibold">{{$application->candidate->name}}'s</span>
                                                    application?</h3>
                                                <button data-modal-hide="reject-modal" type="button" onclick="submitForm('rejected')"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                                <button data-modal-hide="reject-modal" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-zinc-900 focus:outline-none bg-white rounded-lg border border-zinc-200 hover:bg-zinc-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-zinc-100 dark:focus:ring-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-700">No,
                                                    cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="accept-modal" tabindex="-1"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-zinc-700">
                                            <button type="button"
                                                class="absolute top-3 end-2.5 text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                                data-modal-hide="accept-modal">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-zinc-400 w-12 h-12 dark:text-zinc-200" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                <h3 class="mb-5 text-lg font-normal text-zinc-500 dark:text-zinc-400">Are you sure you
                                                    want to accept <span
                                                        class="text-zinc-600 dark:text-zinc-200 font-semibold">{{$application->candidate->name}}'s</span>
                                                    application?</h3>
                                                <button data-modal-hide="accept-modal" type="button" onclick="submitForm('accepted')"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Yes, I'm sure
                                                </button>
                                                <button data-modal-hide="accept-modal" type="button"
                                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-zinc-900 focus:outline-none bg-white rounded-lg border border-zinc-200 hover:bg-zinc-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-zinc-100 dark:focus:ring-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:border-zinc-600 dark:hover:text-white dark:hover:bg-zinc-700">No,
                                                    cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div id="cover-letter-modal" tabindex="-1"
                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-4xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-zinc-200 rounded-lg shadow dark:bg-zinc-800">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-zinc-600">
                                    <h3 class="text-xl font-medium text-zinc-700 dark:text-white capitalize">
                                        {{$application->candidate->name}}'s cover letter
                                    </h3>
                                    <button type="button"
                                        class="text-zinc-400 bg-transparent hover:bg-zinc-200 hover:text-zinc-800 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-zinc-600 dark:hover:text-white"
                                        data-modal-hide="cover-letter-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4 min-h-64 bg-zinc-100 dark:bg-zinc-700 rounded-b">
                                    <p class="text-lg leading-relaxed text-zinc-800 dark:text-zinc-200">
                                        {{$application->cover_letter}}
                                    </p>

                                </div>

                            </div>
                        </div>
                    </div>

                    <form id="statusForm" action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="statusInput">
                    </form>

                    <script>
                        function submitForm(status) {
                            document.getElementById('statusInput').value = status;
                            document.getElementById('statusForm').submit();
                        }
                    </script>
                @endforeach
        @endif
    </div>
</x-app-layout>




{{--
<div class="mb-4 p-4 border-b">
    <p><strong>Candidate:</strong> {{ $application->candidate->name }}</p>
    <p><strong>Cover Letter:</strong> {{ $application->cover_letter }}</p>
    <p><strong>Status:</strong> {{ ucfirst($application->status) }}</p>

    <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="status">Update Status:</label>
        <select name="status" id="status">
            <option value="accepted">Accept</option>
            <option value="rejected">Reject</option>
        </select>
        <x-primary-button type="submit">Update</x-primary-button>
    </form>
</div>
--}}

<!-- I need one more design 

        "name" => string
        "email" => string
        "phone" => string
        "resume" => string
        "cover_letter" => string
        "status" => "pending"
        "created_at" => date (use carbon to display like jan 12, 2024)

Now I want to tell you what does the data means
name -> Applicant name
status -> will be a badge
created at -> application submitted at 



now create a design  -->