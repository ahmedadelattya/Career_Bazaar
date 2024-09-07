<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <x-input-label for="title" :value="__('Job Title')" />
                    <p class="mt-1">{{ $job->title }}</p>
                </div>

                <div class="mb-4">
                    <x-input-label for="description" :value="__('Job Description')" />
                    <p class="mt-1">{{ $job->description }}</p>
                </div>

                <div class="mb-4">
                    <x-input-label for="skills" :value="__('Skills')" />
                    <ul class="list-disc ml-5">
                        @foreach ($job->skills as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-4">
                    <x-input-label for="salary_type" :value="__('Salary Type')" />
                    <p class="mt-1">{{ ucfirst($job->salary_type) }}</p>
                </div>

                @if ($job->salary_type === 'fixed')
                    <div class="mb-4">
                        <x-input-label for="fixed_salary" :value="__('Fixed Salary ($USD)')" />
                        <p class="mt-1">${{ $job->fixed_salary }}</p>
                    </div>
                @else
                    <div class="mb-4">
                        <x-input-label for="hourly_rate" :value="__('Hourly Rate ($USD)')" />
                        <p class="mt-1">${{ $job->hourly_rate }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <x-input-label for="location" :value="__('Location')" />
                    <p class="mt-1">{{ $job->location }}</p>
                </div>

                <div class="mb-4">
                    <x-input-label for="category" :value="__('Category')" />
                    <p class="mt-1">{{ ucfirst($job->category) }}</p>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('jobs.index') }}">Back</a> |
                    <a href="{{ route('jobs.edit', $job->id) }}">Edit</a> |

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
