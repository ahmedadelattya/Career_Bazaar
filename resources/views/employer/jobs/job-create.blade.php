<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Add new job') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-6">
            <x-input-error :messages="$errors->all()" class="mt-2" />
            <div
                class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg p-6 text-zinc-800 dark:text-zinc-300">
                <form id="jobForm" method="POST" action="{{ route('jobs.store') }}" class="space-y-6" novalidate>
                    <!-- Job Title -->
                    <div>
                        <x-input-label for="title" :value="__('Job Title')" />
                        <x-text-input id="title" class="block mt-2 w-full 
                        " type="text" name="title" :value="old('title')" required autofocus />
                    </div>
                    <!-- Job Description & Requirements -->
                    <div class="flex items-center gap-6 flex-wrap">
                        <!-- Job Description -->
                        <div class="flex-1 basis-96">
                            <x-input-label for="description" :value="__('Job Description')" />
                            <textarea id="description"
                                class="block mt-1 w-full
                        border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                name="description" required>{{ old('description') }}</textarea>
                        </div>
                        <!-- Job Requirements -->
                        <div class="flex-1 basis-96">
                            <x-input-label for="requirements" :value="__('Job Requirements')" />
                            <textarea id="requirements"
                                class="block mt-1 w-full
                        border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                name="requirements" required>{{ old('requirements') }}</textarea>
                        </div>
                    </div>
                    <!-- Skills Dropdown -->
                    <div>
                        <x-input-label for="skills" :value="__('Skills')" />
                        <div class="mt-2"></div>
                        <select id="skills" name="skills[]" multiple>
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->name }}">{{ $skill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Salary  -->
                    <div>
                        <x-input-label for="salary_type" :value="__('Salary Type')" />
                        <div class="flex mt-1">
                            <div class="flex">
                                <!-- Fixed -->
                                <input id="fixed" type="radio" name="salary_type" value="fixed" checked
                                    class="sr-only peer/fixed">
                                <label for="fixed"
                                    class="cursor-pointer py-auto flex items-center justify-center px-4 rounded-s-lg bg-indigo-200 text-indigo-900 peer-checked/fixed:bg-indigo-700 peer-checked/fixed:text-indigo-50 duration-75 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/fixed:bg-indigo-900 dark:peer-checked/fixed:text-indigo-50">
                                    {{ __('Fixed') }}
                                </label>

                                <!-- Hourly -->
                                <input id="hourly" type="radio" name="salary_type" value="hourly"
                                    class="sr-only peer/hourly">
                                <label for="hourly"
                                    class="cursor-pointer py-auto flex items-center justify-center px-4 bg-indigo-200 text-indigo-900 peer-checked/hourly:bg-indigo-700 peer-checked/hourly:text-indigo-50 duration-75 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/hourly:bg-indigo-900 dark:peer-checked/hourly:text-indigo-50">
                                    {{ __('Hourly') }}
                                </label>
                            </div>
                            <input type="text" id="salary-input"
                                class="rounded-e-lg flex-1
        border-zinc-300 dark:border-zinc-700 dark:bg-zinc-700 dark:text-zinc-300 focus:border-indigo-500 dark:focus:border-indigo-600 shadow-sm border-l-0 border-l-transparent" />
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Category -->
                        <div class="">
                            <label for="categories"
                                class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Category</label>
                            <select id="categories"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                @foreach($categories as $category)
                                    <option value="{{ $category }}">{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="jobType"
                                class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Job type</label>
                            <select id="jobType"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                <option selected value="onsite">Full-time</option>
                                <option value="remote">Part time</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="workPlace"
                                class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Work
                                place</label>
                            <select id="workPlace"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                <option selected value="onsite">On-site</option>
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                        <div class="">
                            <label for="locations"
                                class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Location</label>
                            <select id="locations"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                @foreach($locations as $location)
                                    <option value="{{ $location }}">{{$location}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="experience"
                                class="block mb-2 text-sm font-medium text-zinc-800 dark:text-zinc-200">Experience</label>
                            <select id="experience"
                                class="bg-zinc-50 border border-zinc-300 text-zinc-900 text-sm rounded-lg focus:ring-indigo-700 focus:border-indigo-700 block w-full p-2.5 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-700 dark:focus:border-indigo-700">
                                @foreach($experienceLevel as $level)
                                    <option value="{{ $level }}">{{$level}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('jobs.index') }}">Back</a> |
                        <x-primary-button>
                            {{ __('Create Job') }}
                        </x-primary-button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
</x-app-layout>

<!-- Include Choices.js JS from CDN -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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


        document.querySelector('form#jobForm').addEventListener('submit', function (event) {
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
        if (selectedRadio.value === 'fixed') {
            salaryInput.setAttribute('name', selectedRadio.value + '_salary');
            salaryInput.setAttribute('placeholder', 'Enter fixed salary');
        } else if (selectedRadio.value === 'hourly') {
            salaryInput.setAttribute('name', selectedRadio.value + '_rate');
            salaryInput.setAttribute('placeholder', 'Enter hourly rate');
        }
    }

    document.getElementById('fixed').addEventListener('change', updateSalaryInputName);
    document.getElementById('hourly').addEventListener('change', updateSalaryInputName);

    updateSalaryInputName();

    document.getElementById('salary-input').addEventListener('input', function (e) {
        const regex = /[^0-9]/g;
        e.target.value = e.target.value.replace(regex, '');
    });
</script>