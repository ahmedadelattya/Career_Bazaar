<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Candidate Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">

                    <!-- Display Success Message -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                        </div>
                    @endif

                    <h3 class="font-semibold mb-4">{{ __('Approved Job Listings') }}</h3>

                    <!-- List of approved jobs -->
                    @if ($jobs->isEmpty())
                        <p>{{ __('No approved jobs available.') }}</p>
                    @else
                        @foreach ($jobs as $job)
                            <div class="mb-4 p-4 bg-zinc-100 dark:bg-zinc-700 rounded-lg shadow">
                                <h4 class="font-bold">{{ $job->title }}</h4>
                                <p>{{ $job->description }}</p>
                                <p><strong>{{ __('Category:') }}</strong> {{ $job->category }}</p>
                                <p><strong>{{ __('Location:') }}</strong> {{ $job->location }}</p>
                                <p><strong>{{ __('Salary Type:') }}</strong> {{ ucfirst($job->salary_type) }}</p>

                                <!-- Apply Button or Disabled -->
                                @if (in_array($job->id, $appliedJobs))
                                    <button disabled
                                        class="bg-gray-400 text-white px-4 py-2 rounded">{{ __('Applied') }}</button>
                                @else
                                    <a href="{{ route('jobs.show', $job->id) }}"
                                        class="text-blue-500 hover:underline">{{ __('Apply Now') }}</a>
                                @endif
                            </div>
                        @endforeach

                        <!-- Pagination Links -->
                        {{ $jobs->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
