<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(Auth::user()->role=='candidate')
        <div>
            <x-input-label for="candidate_job_title" :value="__('candidate_job_title')" />
            <x-text-input id="candidate_job_title" name="candidate_job_title" type="text" class="mt-1 block w-full" :value="old('job_title', $user->job_title)" required autofocus autocomplete="job_title" />
            <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
        </div>

        <div>
            <x-input-label for="candidate_job_description" :value="__('candidate_job_description')" />
            <textarea name="candidate_job_description" id="" cols="30" rows="5"></textarea>
        </div>
        <div id="skills">
        <label for="skills">Skills:</label>
        <input type="text" name="candidate_skills[]" class="form-control" placeholder="Enter skill">
    </div>
    <button type="button" onclick="addSkill()">Add More Skills</button>

    <button type="submit">Submit</button>

    <div id="projects">
        <label for="projects">projects:</label>
        <input type="text" name="candidate_projects[]" class="form-control" placeholder="Enter link github of your projcet">
    </div>
    <button type="button" onclick="addproject()">Add More project</button>

    <button type="submit">Submit</button>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>


<script>
function addSkill() {
    var newSkill = document.createElement('input');
    newSkill.type = 'text';
    newSkill.name = 'candidate_skills[]';
    newSkill.className = 'form-control';
    newSkill.placeholder = 'Enter skill';
    document.getElementById('skills').appendChild(newSkill);
}

function addproject() {
    var newproject = document.createElement('input');
    newproject.type = 'text';
    newproject.name = 'candidate_projects[]';
    newproject.className = 'form-control';
    newproject.placeholder = 'Enter link github of your projcet';
    document.getElementById('projects').appendChild(newproject);
}
</script>