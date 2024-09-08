<x-app-layout>
    <div id="notificationsContainer" class="fixed top-0 right-0 z-50 w-full p-4 space-y-4 md:w-1/3">
        @foreach (Auth::user()->notifications as $notification)
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
                        {{ $notification->data['job_title'] }} has been {{ $notification->data['status'] }}.
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
    <!-- Page Header -->
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <!-- Dashboard Content -->
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-md dark:bg-zinc-800 sm:rounded-lg">
                <div class="p-6 text-xl text-center text-zinc-900 dark:text-zinc-100">
                    {{ __('Welcome to your Admin Dashboard!') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Job Listings Section -->
    <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md dark:bg-zinc-800">
            <table id="default-table" class="min-w-full text-sm bg-white rounded-lg dark:bg-zinc-800">
                <thead class="bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                    <tr>
                        @foreach (['Title', 'Creator', 'Category', 'Location', 'Salary Type', 'Salary', 'Status', 'Created At', 'Actions'] as $heading)
                            <th
                                class="px-6 py-3 text-xs font-semibold text-left text-gray-700 uppercase dark:text-gray-300">
                                {{ $heading }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($jobs as $job)
                        <tr class="transition bg-white cursor-pointer dark:bg-zinc-800 hover:bg-gray-50 dark:hover:bg-zinc-700"
                            onclick="openModal('{{ $job->id }}')">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                {{ $job->title }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-100">
                                {{ $job->user->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $job->category }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $job->location }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $job->salary_type }}</td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $job->salary_type == 'fixed' ? $job->fixed_salary : $job->hourly_rate }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $job->status === 'approved' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $job->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                {{ $job->created_at->format('Y/m/d') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Approve Button -->
                                    <form method="POST" action="{{ route('jobs.approve', $job->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-3 py-1 text-white bg-green-500 rounded-lg hover:bg-green-600">
                                            Approve
                                        </button>
                                    </form>
                                    <!-- Reject Button -->
                                    <form method="POST" action="{{ route('jobs.reject', $job->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="px-3 py-1 text-white bg-red-500 rounded-lg hover:bg-red-600">
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Notifications Section -->
    {{-- <div class="max-w-xl p-4 mx-auto mt-8">
        <h2 class="mb-4 text-2xl font-semibold text-gray-900 dark:text-gray-100">Notifications</h2>

        <div class="space-y-4">
            @forelse (Auth::user()->notifications as $notification)
                <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="relative flex items-center p-4 text-gray-700 bg-white border-l-4 rounded-lg shadow-md dark:bg-zinc-800 dark:text-gray-100
                            {{ $notification->data['status'] === 'approved' ? 'border-green-500' : 'border-red-500' }}">
                    <div class="flex-shrink-0 mr-3">
                        @if ($notification->data['status'] === 'approved')
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                            {{ $notification->data['job_title'] }} has been {{ $notification->data['status'] }}.
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <button @click="show = false"
                        class="ml-auto text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @empty
                <div
                    class="p-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-700 dark:text-yellow-200">
                    No notifications available.
                </div>
            @endforelse
        </div>
    </div> --}}

    <!-- Modal for Job Details -->
    <div id="jobModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 flex items-center justify-center hidden w-full p-4 overflow-x-hidden overflow-y-auto">
        <div class="relative w-full max-w-2xl">
            <div class="relative bg-white rounded-lg shadow dark:bg-zinc-800">
                <!-- Modal Header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white" id="modalTitle">Job Details</h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        onclick="closeModal()">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="p-6 space-y-6">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400" id="modalDescription">
                        Job description will appear here...
                    </p>
                    <ul class="space-y-2 text-gray-500 dark:text-gray-400" id="modalInfo">
                        <!-- Additional job info like category, salary, location, etc. -->
                    </ul>
                </div>

                <!-- Modal Footer -->
                <div class="flex items-center justify-end p-6 border-t border-gray-200 dark:border-gray-600">
                    <button type="button" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 rounded-lg"
                        onclick="closeModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>
    <script>
        const jobs = @json($jobs);

        function openModal(jobId) {
            const job = jobs.find(j => j.id == jobId);
            if (job) {
                document.getElementById('modalTitle').textContent = job.title;
                document.getElementById('modalDescription').textContent = job.description;
                document.getElementById('modalInfo').innerHTML = `
                    <li><strong>Category:</strong> ${job.category}</li>
                    <li><strong>Location:</strong> ${job.location}</li>
                    <li><strong>Salary Type:</strong> ${job.salary_type}</li>
                    <li><strong>Salary:</strong> ${job.fixed_salary ?? job.hourly_rate}</li>
                    <li><strong>Skills:</strong> ${job.skills}</li>
                `;
                document.getElementById('jobModal').classList.remove('hidden');
            }
        }

        function closeModal() {
            document.getElementById('jobModal').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dataTable = new simpleDatatables.DataTable("#default-table", {
                perPage: 5,
                perPageSelect: [5, 10, 20],
                searchable: true,
                sortable: true,
            });
        });

        function createNotification(data) {
            const container = document.getElementById('notificationsContainer');
            const notification = document.createElement('div');

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

            container.prepend(notification.firstElementChild);
        }
    </script>
</x-app-layout>
