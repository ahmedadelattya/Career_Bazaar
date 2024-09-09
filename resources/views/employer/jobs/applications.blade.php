<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Applications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3>Applications for: {{ $job->title }}</h3>

                @foreach ($applications as $application)
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
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
