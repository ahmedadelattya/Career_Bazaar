<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8p-6">
            <x-input-error :messages="$errors->all()" class="mt-2" />
            <div
                class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg p-6 text-zinc-800 dark:text-zinc-300">
                <form id="jobForm" method="POST" action="{{ route('jobs.update', $job->id) }}" class="space-y-6"
                    novalidate>
                    @method('PUT')
                    @csrf

                    <!-- Job Title -->
                    <div class="flex flex-wrap gap-6 sm:gap-0 sm:divide-x-2 divide-zinc-100 dark:divide-zinc-700">
                        <div class="space-y-6 flex-grow pr-3">
                            <div>
                                <x-input-label for="title" :value="__('Job Title')" />
                                <x-text-input id="title" class="block mt-2 w-full" type="text" name="title"
                                    :value="old('title', $job->title)" required autofocus />
                            </div>

                            <!-- Job Description & Requirements -->
                            <div>
                                <x-input-label for="description" :value="__('Job Description')" />
                                <textarea id="description"
                                    class="block mt-1 w-full
                        border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="description" required>{{ old('description', $job->description) }}</textarea>
                            </div>

                            <div>
                                <x-input-label for="requirements" :value="__('Job Requirements')" />
                                <textarea id="requirements"
                                    class="block mt-1 w-full
                        border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    name="requirements"
                                    required>{{ old('requirements', $job->requirements) }}</textarea>
                            </div>

                            <!-- Skills Dropdown -->
                            <div>
                                <x-input-label for="skills" :value="__('Skills')" />
                                <div class="mt-2"></div>
                                <select id="skills" name="skills[]" multiple>
                                    @foreach ($allSkills as $skill)
                                        <option value="{{ $skill->name }}" {{ in_array($skill->name, $job->skills) ? 'selected' : '' }}>{{ $skill->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Salary -->
                            <div>
                                <x-input-label for="salary_type" :value="__('Salary Type')" />
                                <div class="flex mt-1">
                                    <div class="flex">
                                        <input id="fixed" type="radio" name="salary_type" value="fixed" {{ $job->salary_type == 'fixed' ? 'checked' : '' }} class="sr-only peer/fixed">
                                        <label for="fixed"
                                            class="cursor-pointer py-auto flex items-center justify-center px-4 rounded-s-lg bg-zinc-50 border dark:bg-zinc-800 peer-checked/fixed:bg-sky-400 peer-checked/fixed:text-white">
                                            {{ __('Fixed') }}
                                        </label>
                                        <input id="hourly" type="radio" name="salary_type" value="hourly" {{ $job->salary_type == 'hourly' ? 'checked' : '' }} class="sr-only peer/hourly">
                                        <label for="hourly"
                                            class="cursor-pointer py-auto flex items-center justify-center px-4 rounded-e-lg bg-zinc-50 border dark:bg-zinc-800 peer-checked/hourly:bg-sky-400 peer-checked/hourly:text-white">
                                            {{ __('Hourly') }}
                                        </label>
                                    </div>
                                    <input type="text" id="salary-input"
                                        class="rounded-e-lg flex-1 bg-zinc-50 border-zinc-100 dark:bg-zinc-900 dark:border-zinc-600"
                                        name="{{ $job->salary_type == 'fixed' ? 'fixed_salary' : 'hourly_rate' }}"
                                        value="{{ $job->salary }}" />
                                </div>
                            </div>
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
                            <option value="programming" {{ old('category', $job->category) === 'programming' ? 'selected' : '' }}>Programming
                            </option>
                            <option value="management" {{ old('category', $job->category) === 'management' ? 'selected' : '' }}>Management
                            </option>
                            <option value="translation" {{ old('category', $job->category) === 'translation' ? 'selected' : '' }}>Translation
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <!-- Status Field -->
                    <div class="mb-4">
                        <x-input-label for="status" :value="__('Job Status')" />
                        <select id="status" name="status" class="block mt-1 w-full" required>
                            <option value="pending" {{ old('status', $job->status) === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="approved" {{ old('status', $job->status) === 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="declined" {{ old('status', $job->status) === 'declined' ? 'selected' : '' }}>
                                Declined
                            </option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <!-- Submit Button -->
                    <div class="flex flex-row-reverse items-center justify-between mt-4">
                        <button type="submit" class="relative rounded-lg w-36 h-10 overflow-hidden text-white group">
                            <span
                                class="bg-sky-600 h-full w-full absolute inset-0 transform translate-x-0 group-hover:translate-x-full transition duration-500 ease-out"></span>
                            <span
                                class="bg-sky-500 h-full w-full absolute inset-0 transform translate-x-full group-hover:translate-x-0 transition duration-500 ease-in"></span>
                            <span class="relative flex justify-center items-center h-full w-full">
                                <span class="text-gray-200 font-semibold ml-8">{{ __('Update') }}</span>
                                <span
                                    class="absolute right-0 h-full w-10 bg-gradient-to-l from-sky-600/50 to-transparent">
                                    <svg class="svg w-8 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <line x1="12" x2="12" y1="5" y2="19" />
                                        <polyline points="5 12 12 5 19 12" />
                                    </svg>
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const skillsInput = document.getElementById('skills');
            new Choices(skillsInput, { removeItemButton: true });

            const updateSalaryInputName = () => {
                const salaryInput = document.getElementById('salary-input');
                if (document.getElementById('fixed').checked) {
                    salaryInput.name = 'fixed_salary';
                } else {
                    salaryInput.name = 'hourly_rate';
                }
            };

            document.getElementById('fixed').addEventListener('change', updateSalaryInputName);
            document.getElementById('hourly').addEventListener('change', updateSalaryInputName);
            updateSalaryInputName();
        });
    </script>
</x-app-layout>