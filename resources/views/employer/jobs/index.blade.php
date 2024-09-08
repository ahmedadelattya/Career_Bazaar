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
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Employer_DashBoard') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                @if ($jobs->count())
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr>
                                    <td>{{ $job->title }}</td>
                                    <td>{{ $job->category }}</td>
                                    <td>{{ $job->location }}</td>
                                    <td>{{ $job->status }}</td>
                                    <td>
                                        <a href="{{ route('jobs.show', $job->id) }}">Show</a> |
                                        <a href="{{ route('jobs.edit', $job) }}">Edit</a> |
                                        <form method="POST" action="{{ route('jobs.destroy', $job->id) }}"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $jobs->links() }}
                @else
                    <p>No job postings available.</p>
                @endif
                <div class="mt-4">
                    <a href="{{ route('jobs.create') }}" class="btn btn-secondary">Post a New Job</a>
                </div>
            </div>
        </div>
    </div>
    <script>
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
