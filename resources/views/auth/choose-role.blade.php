<x-guest-layout>
    <form method="GET" action="{{ route('register-role') }}">
        @csrf
        
        <div>
            <input type="radio" id="employer" name="role" value="employer" required>
            <label for="employer">Register as Employer</label>
            
            <input type="radio" id="candidate" name="role" value="candidate" required>
            <label for="candidate">Register as Candidate</label>
        </div>
        
        <x-primary-button class="mt-4">
            {{ __('Next') }}
        </x-primary-button>
    </form>
</x-guest-layout>
