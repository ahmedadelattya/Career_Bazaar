<x-app-layout>
    <div class="py-12">
        <div class="p-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-input-error :messages="$errors->all()" class="mt-2" />
            <div
                class="p-6 overflow-hidden bg-white rounded-lg shadow dark:bg-zinc-800 text-zinc-800 dark:text-zinc-300">
                <form id="jobForm" method="POST" action="{{ route('jobs.store') }}" class="space-y-6" novalidate>
                    <div class="flex flex-wrap gap-6 sm:gap-0 sm:divide-x-2 divide-zinc-100 dark:divide-zinc-700">
                        <div class="flex-grow pr-3 space-y-6">
                            <div>
                                <x-input-label for="title" :value="__('Job Title')" />
                                <x-text-input id="title" class="block w-full mt-2 " type="text" name="title"
                                    :value="old('title')" required autofocus />
                            </div>
                            <!-- Job Description & Requirements -->
                            <!-- Job Description -->
                            <div class="">
                                <x-input-label for="description" :value="__('Job Description')" />
                                <textarea id="description"
                                    class="block w-full mt-1 rounded-md shadow-sm border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                    name="description" required>{{ old('description') }}</textarea>
                            </div>
                            <!-- Job Requirements -->
                            <div class="">
                                <x-input-label for="requirements" :value="__('Job Requirements')" />
                                <textarea id="requirements"
                                    class="block w-full mt-1 rounded-md shadow-sm border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                    name="requirements" required>{{ old('requirements') }}</textarea>
                            </div>
                            <!-- Skills Dropdown -->
                            <div class="max-w-[755px]">
                                <x-input-label for="skills" :value="__('Skills')" />
                                <div class="mt-2"></div>
                                <select id="skills" name="skills[]" multiple>
                                    @foreach ($skills as $skill)
                                        <option value="{{ $skill->name }}"
                                            {{ in_array($skill->name, old('skills', [])) ? 'selected' : '' }}>
                                            {{ $skill->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Salary  -->
                            <div>
                                <x-input-label for="salary_type" :value="__('Salary Type')" />
                                <div class="flex mt-1">
                                    <div class="flex">
                                        <!-- Fixed -->
                                        <input id="fixed" type="radio" name="salary_type" value="fixed"
                                            {{ old('salary_type', 'fixed') == 'fixed' ? 'checked' : '' }}
                                            class="sr-only peer/fixed">
                                        <label for="fixed"
                                            class="flex items-center justify-center px-4 text-indigo-900 duration-75 bg-indigo-200 cursor-pointer py-auto rounded-s-lg peer-checked/fixed:bg-indigo-700 peer-checked/fixed:text-indigo-50 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/fixed:bg-indigo-900 dark:peer-checked/fixed:text-indigo-50">
                                            {{ __('Fixed') }}
                                        </label>

                                        <!-- Hourly -->
                                        <input id="hourly" type="radio" name="salary_type" value="hourly"
                                            {{ old('salary_type', 'fixed') == 'hourly' ? 'checked' : '' }}
                                            class="sr-only peer/hourly">
                                        <label for="hourly"
                                            class="flex items-center justify-center px-4 text-indigo-900 duration-75 bg-indigo-200 cursor-pointer py-auto peer-checked/hourly:bg-indigo-700 peer-checked/hourly:text-indigo-50 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/hourly:bg-indigo-900 dark:peer-checked/hourly:text-indigo-50">
                                            {{ __('Hourly') }}
                                        </label>
                                    </div>
                                    <input type="text" id="salary-input"
                                        value="{{ old('fixed_salary') ?: old('hourly_rate') }}"
                                        class="flex-1 border-l-0 shadow-sm rounded-e-lg border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 border-l-transparent" />
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col justify-between pl-3 space-y-6 sm:space-y-0">
                            <!-- Category -->
                            <div class="">
                                <label for="categories"
                                    class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Category</label>
                                <select id="categories" name="category"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}"
                                            {{ old('category') == $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Job Type -->
                            <div class="">
                                <label for="jobType"
                                    class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Job
                                    type</label>
                                <select id="jobType" name="job_type"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                    <option value="full-time" {{ old('job_type') == 'full-time' ? 'selected' : '' }}>
                                        Full-time</option>
                                    <option value="part-time" {{ old('job_type') == 'part-time' ? 'selected' : '' }}>
                                        Part time</option>
                                </select>
                            </div>
                            <!-- Work Place -->
                            <div class="">
                                <label for="workPlace"
                                    class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Work
                                    place</label>
                                <select id="workPlace" name="work_place"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                    <option value="on-site" {{ old('work_place') == 'on-site' ? 'selected' : '' }}>
                                        On-site</option>
                                    <option value="remote" {{ old('work_place') == 'remote' ? 'selected' : '' }}>Remote
                                    </option>
                                    <option value="hybrid" {{ old('work_place') == 'hybrid' ? 'selected' : '' }}>Hybrid
                                    </option>
                                </select>
                            </div>
                            <!-- Location -->
                            <div class="">
                                <label for="locations"
                                    class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Location</label>
                                <select id="locations" name="location"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                    @foreach ($locations as $location)
                                        <option value="{{ $location->name }}"
                                            {{ old('location') == $location->name ? 'selected' : '' }}>
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Experience Level -->
                            <div>
                                <label for="experience"
                                    class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Experience</label>
                                <select id="experience" name="experience_level"
                                    class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                    <option value="entry-level"
                                        {{ old('experience_level') == 'entry-level' ? 'selected' : '' }}>
                                        {{ __('Entry Level') }}
                                    </option>
                                    <option value="intermediate"
                                        {{ old('experience_level') == 'intermediate' ? 'selected' : '' }}>
                                        {{ __('Intermediate') }}
                                    </option>
                                    <option value="expert" {{ old('experience_level') == 'expert' ? 'selected' : '' }}>
                                        {{ __('Expert') }}
                                    </option>
                                </select>
                            </div>

                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex flex-row-reverse items-center justify-between mt-4">
                        <button type="submit"
                            class="relative flex items-center h-10 bg-indigo-700 border border-indigo-700 rounded-lg cursor-pointer w-36 group hover:bg-indigo-700 active:bg-indigo-700 active:border-indigo-700">
                            <span
                                class="ml-8 font-semibold text-gray-200 transition-all duration-300 transform group-hover:opacity-0 group-focus:opacity-0">Create</span>
                            <span
                                class="absolute right-0 flex items-center justify-center w-10 h-full transition-all duration-300 transform bg-indigo-700 rounded-lg group-hover:translate-x-0 group-focus:translate-x-0 group-hover:w-full group-focus:w-full">
                                <svg class="w-8 text-white svg" fill="none" height="24" stroke="currentColor"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                    <line x1="12" x2="12" y1="5" y2="19"></line>
                                    <line x1="5" x2="19" y1="12" y2="12"></line>
                                </svg>
                            </span>
                        </button>
                        <a href="{{ route('jobs.index') }}"
                            class="duration-150 text-zinc-600 dark:text-zinc-300 hover:text-indigo-800">Cancel</a>

                    </div>
                    @csrf
                </form>
            </div>
        </div>
</x-app-layout>

<!-- Include Choices.js JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const skillInput = document.getElementById('skills');
        if (skillInput) {
            new Choices(skillInput, {
                removeItemButton: true,
                placeholderValue: 'Select your skills...',
                duplicateItemsAllowed: false,
                searchResultLimit: 3,
                noResultsText: 'No skills found'
            });
        }


        document.querySelector('form#jobForm').addEventListener('submit', function(event) {
            // event.preventDefault(); // Prevent form from submitting normally

            const formData = new FormData(this); // Gather form data
            formData.forEach((value, key) => {
                console.log(`${key}: ${value}`); // Log each key-value pair
            });
            console.log('first')
        });
    });
</script>


<script>
    function updateSalaryInputName() {
        const selectedRadio = document.querySelector('input[name="salary_type"]:checked');
        const salaryInput = document.getElementById('salary-input');
        if (selectedRadio) {
            if (selectedRadio.value === 'fixed') {
                salaryInput.setAttribute('name', selectedRadio.value + '_salary');
                salaryInput.setAttribute('placeholder', 'Enter fixed salary');
            } else if (selectedRadio.value === 'hourly') {
                salaryInput.setAttribute('name', selectedRadio.value + '_rate');
                salaryInput.setAttribute('placeholder', 'Enter hourly rate');
            }
        }
    }

    // document.addEventListener('DOMContentLoaded', function() {
    //     // Call it initially to set the correct name and placeholder based on old value
    //     updateSalaryInputName();
    // });

    document.getElementById('fixed').addEventListener('change', updateSalaryInputName);
    document.getElementById('hourly').addEventListener('change', updateSalaryInputName);

    updateSalaryInputName();

    document.getElementById('salary-input').addEventListener('input', function(e) {
        const regex = /[^0-9]/g;
        e.target.value = e.target.value.replace(regex, '');
    });
</script>
