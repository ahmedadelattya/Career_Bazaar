<section>
    <header class="mb-6">
        <h2 class="text-lg font-medium text-zinc-900 dark:text-zinc-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-zinc-800 dark:text-zinc-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="ml-2 text-sm underline rounded-md text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-zinc-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif

        </div>
        {{-- Old Image field --}}
        <div class="mt-4">
            <x-input-label :value="__('Current Image/Logo')" />
            @if ($user->image)
                <img src="{{ asset('images/' . $user->role . 's/' . $user->image) }}" alt="Current Image/Logo"
                    class="mt-2 rounded-md h-20 w-20 object-cover" />
            @else
                <p>{{ __('No image uploaded') }}</p>
            @endif
        </div>

        @if (Auth::user()->role == 'candidate')
            {{-- image field --}}
            <div class="mt-4">
                <x-input-label :value="__('Image/Logo')" />
                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" required />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="candidate_job_title" :value="__('Candidate Job Title')" />
                <x-text-input id="candidate_job_title" name="candidate_job_title" type="text"
                    class="block w-full mt-1" :value="old('job_title', $user->job_title)" required autofocus autocomplete="job_title" />
                <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
            </div>

            <div>
                <x-input-label for="candidate_job_description" :value="__('Candidate Job Description')" />
                <textarea name="candidate_job_description" id="candidate_job_description" rows="5"
                    class="block w-full mt-1 rounded-md shadow-sm border-zinc-300 dark:border-zinc-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-zinc-800 dark:text-zinc-100"></textarea>
            </div>

            <div id="skills">
                <x-input-label for="skills" :value="__('Skills')" />
                <x-text-input type="text" name="candidate_skills[]" class="block w-full mt-1"
                    placeholder="Enter skill" />
            </div>
            <button type="button" onclick="addSkill()"
                class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest uppercase border border-transparent rounded-md bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 hover:bg-zinc-200 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                Add More Skills
            </button>

            <div id="projects" class="mt-4">
                <x-input-label for="projects" :value="__('Projects')" />
                <x-text-input type="text" name="candidate_projects[]" class="block w-full mt-1"
                    placeholder="Enter GitHub project link" />
            </div>
            <button type="button" onclick="addProject()"
                class="inline-flex items-center px-4 py-2 mt-2 text-xs font-semibold tracking-widest uppercase border border-transparent rounded-md bg-zinc-100 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-200 hover:bg-zinc-200 dark:hover:bg-zinc-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">
                Add More Projects
            </button>
        @endif

        @if (Auth::user()->role == 'employer')
            {{-- New Image field --}}
            <div class="mt-4">
                <x-input-label :value="__('Image/Logo')" />
                <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            {{-- Company Name field --}}
            <div class="mt-4">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name"
                    :value="old('company_name', $user->company_name)" required />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>
            {{-- about me field --}}
            <div class="mt-4">
                <x-input-label for="about" :value="__('About')" />
                <x-text-input id="about" class="block mt-1 w-full" type="text" name="about"
                    :value="old('about', $user->about)" />
                <x-input-error :messages="$errors->get('about')" class="mt-2" />
            </div>
            {{-- Web site field --}}
            <div class="mt-4">
                <x-input-label for="website" :value="__('Website')" />
                <x-text-input id="website" class="block mt-1 w-full" type="url" name="website"
                    :value="old('website', $user->website)" />
                <x-input-error :messages="$errors->get('website')" class="mt-2" />
            </div>
        @endif


        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-zinc-600 dark:text-zinc-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<script>
    function addSkill() {
        const skillContainer = document.getElementById('skills');
        const newSkill = document.createElement('input');
        newSkill.type = 'text';
        newSkill.name = 'candidate_skills[]';
        newSkill.className =
            'mt-2 block w-full border-zinc-300 dark:border-zinc-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-zinc-800 dark:text-zinc-100';
        newSkill.placeholder = 'Enter skill';
        skillContainer.appendChild(newSkill);
    }

    function addProject() {
        const projectContainer = document.getElementById('projects');
        const newProject = document.createElement('input');
        newProject.type = 'text';
        newProject.name = 'candidate_projects[]';
        newProject.className =
            'mt-2 block w-full border-zinc-300 dark:border-zinc-600 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm dark:bg-zinc-800 dark:text-zinc-100';
        newProject.placeholder = 'Enter GitHub project link';
        projectContainer.appendChild(newProject);
    }
</script>
