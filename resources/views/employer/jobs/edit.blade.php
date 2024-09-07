<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Job Posting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('jobs.update', $job->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Job Title -->
                    <div class="mb-4">
                        <x-input-label for="title" :value="__('Job Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                            :value="old('title', $job->title)" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Job Description -->
                    <div class="mb-4">
                        <x-input-label for="description" :value="__('Job Description')" />
                        <textarea id="description" class="block mt-1 w-full" name="description" required>{{ old('description', $job->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Skills Input Field -->
                    <div class="mb-4">
                        <x-input-label for="skills" :value="__('Skills')" />
                        <select id="skills" name="skills[]" multiple class="block mt-1 w-full">
                            @foreach ($allSkills as $skill)
                                <option value="{{ $skill->name }}"
                                    {{ in_array($skill->name, old('skills', $job->skills ?? [])) ? 'selected' : '' }}>
                                    {{ $skill->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                    </div>

                    <!-- Salary Type -->
                    <div class="mb-4">
                        <x-input-label for="salary_type" :value="__('Salary Type')" />
                        <div>
                            <label>
                                <input type="radio" name="salary_type" value="fixed"
                                    {{ old('salary_type', $job->salary_type) === 'fixed' ? 'checked' : '' }}>
                                {{ __('Fixed Price') }}
                            </label>
                            <label class="ml-4">
                                <input type="radio" name="salary_type" value="hourly"
                                    {{ old('salary_type', $job->salary_type) === 'hourly' ? 'checked' : '' }}>
                                {{ __('Per Hour') }}
                            </label>
                        </div>
                    </div>

                    <!-- Fixed Salary Field -->
                    <div class="mb-4 salary-input" id="fixed-salary-input"
                        style="{{ old('salary_type', $job->salary_type) === 'fixed' ? '' : 'display:none;' }}">
                        <x-input-label for="fixed_salary" :value="__('Fixed Salary ($USD)')" />
                        <x-text-input id="fixed_salary" class="block mt-1 w-full" type="text" name="fixed_salary"
                            :value="old('fixed_salary', $job->fixed_salary)" placeholder="Enter fixed salary..." />
                        <x-input-error :messages="$errors->get('fixed_salary')" class="mt-2" />
                    </div>

                    <!-- Hourly Rate Field -->
                    <div class="mb-4 salary-input" id="hourly-rate-input"
                        style="{{ old('salary_type', $job->salary_type) === 'hourly' ? '' : 'display:none;' }}">
                        <x-input-label for="hourly_rate" :value="__('Hourly Rate ($USD)')" />
                        <x-text-input id="hourly_rate" class="block mt-1 w-full" type="text" name="hourly_rate"
                            :value="old('hourly_rate', $job->hourly_rate)" placeholder="Enter hourly rate..." />
                        <x-input-error :messages="$errors->get('hourly_rate')" class="mt-2" />
                    </div>

                    <!-- Location Input Field -->
                    <div class="mb-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <input id="location" type="text" class="block mt-1 w-full" name="location"
                            value="{{ old('location', $job->location) }}" placeholder="Select or type location..." />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <!-- Category, Work Type-->
                    <div class="mb-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select id="category" name="category" class="block mt-1 w-full" required>
                            <option value="programming"
                                {{ old('category', $job->category) === 'programming' ? 'selected' : '' }}>Programming
                            </option>
                            <option value="management"
                                {{ old('category', $job->category) === 'management' ? 'selected' : '' }}>Management
                            </option>
                            <option value="translation"
                                {{ old('category', $job->category) === 'translation' ? 'selected' : '' }}>Translation
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Update Job') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include Choices.js JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- Include JavaScript for Skills, Salary, and Location Inputs -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Choices.js
        const choices = new Choices('#skills', {
            removeItemButton: true,
            placeholderValue: 'Select or type skills...',
            duplicateItemsAllowed: false,
            searchResultLimit: 3,
            noResultsText: 'No skills found'
        });

        // Handle Salary Type Toggle
        const salaryTypeRadios = document.querySelectorAll('input[name="salary_type"]');
        const fixedSalaryInput = document.getElementById('fixed-salary-input');
        const hourlyRateInput = document.getElementById('hourly-rate-input');

        salaryTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'fixed') {
                    fixedSalaryInput.style.display = 'block';
                    hourlyRateInput.style.display = 'none';
                } else {
                    fixedSalaryInput.style.display = 'none';
                    hourlyRateInput.style.display = 'block';
                }
            });
        });
    });
</script>
