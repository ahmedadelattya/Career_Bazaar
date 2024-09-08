<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employer_DashBoard') }}
        </h2>
    </x-slot>
    {{-- @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <!-- Display notifications -->
        <div class="mt-4">
            <h3 class="text-lg font-medium">Notifications</h3>
            <ul>
                @foreach ($notifications as $notification)
                    <li>
                        {{ $notification->data['message'] }} - {{ $notification->created_at->diffForHumans() }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
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
</x-app-layout>
