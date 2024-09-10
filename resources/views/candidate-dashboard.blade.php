<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class=" text-zinc-800 dark:text-zinc-200">
                <div class="p-5 space-x-4 flex-col space-y-2 ">
                    <div class="text-black ">
                        <form method="GET" action="{{ route('datesearch') }}">
                            @csrf
                            <label class="text-white font-bold text-2xl block">filter by date</label>
                            <label class="text-white font-bold text-2xl ">Started</label>
                            <input type="date" name="start" id="" class="" required>
                            <label class="text-white font-bold text-2xl ">Ended</label>
                            <input type="date" name="end" id="" class="" required>
                            <input type="submit" value="Go"
                                class="bg-indigo-600 hover:bg-indigo-700 px-2 py-2 rounded-xl text-white font-bold">
                        </form>
                    </div>
                    <div class="text-black">
                        <form method="get" action="{{ route('skillsearch') }}">
                            @csrf
                            <select name="select_skill" class="rounded-xl">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->name }}"> {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="submit" value="Go"
                                class="bg-indigo-600 hover:bg-indigo-700 px-2 py-2 rounded-xl text-white font-bold">
                        </form>
                    </div>
                    <div class="w-full">
                        <form method="get" action="{{ route('search') }}" class="flex items-center gap-4">
                            @csrf
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-zinc-900 sr-only dark:text-white">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search"
                                    class="block w-full p-4 ps-10 text-sm text-zinc-900 border border-zinc-300 rounded-lg bg-zinc-50 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                    name="que" placeholder="i.e., title, description, experience, category, or location"
                                    required />
                                <button type="submit"
                                    class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class=" ml-4 text-white ">
                        <form method="get" action="{{ route('filter') }}">
                            @csrf
                            {{-- if user entered minimum amount more than the maximum amount he gets the whole records
                            --}}
                            <p class="text-2xl">Select type and enter the minimum
                            </p>
                            <div>
                                <label for="fixed"> Fixed </label>
                                <input type="radio" name="salary_type" id="fixed" value="fixed" checked>
                                <label for="hourly"> Hourly </label>
                                <input type="radio" name="salary_type" id="hourly" value="hourly">
                                <input type="text" name="min" id="" class="rounded-xl text-black"
                                    placeholder="Minimum value" required>
                                <input type="text" name="max" id="" class="rounded-xl text-black"
                                    placeholder="Maximum value" required>
                                <input type="submit" value="Filter"
                                    class="bg-indigo-600 hover:bg-indigo-700 px-2 py-2 rounded-xl text-white font-bold">
                            </div>
                        </form>
                    </div>
                </div>
                <header class="text-2xl font-bold ">
                    {{ __('Newly added jobs') }}
                </header>
                <div class="mt-6 space-y-6">
                    @foreach ($jobs as $job)
                        <div class="p-4 border rounded-lg shadow bg-zinc-100 dark:bg-zinc-800 dark:border-zinc-700">
                            <div class="flex justify-between">
                                <div>
                                    <h2 class="mb-2 text-2xl font-semibold">{{ $job->title }}</h2>
                                    <div class="flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                                        <p class="">{{ $job->user->company_name ?? 'N/A' }}</p>
                                        <span>-</span>
                                        <p>{{ $job->location }}</p>
                                    </div>
                                    <span class="inline-block text-xs text-zinc-300 dark:text-zinc-500">Posted
                                        {{ $job->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="object-cover">
                                    <img src="{{ asset('images/employers/images/ktBcKk3j1feuHcLgtvSyX2LLL2Uh8ov5iRo1urPs.jpg') }}"
                                        alt="Company logo" class="max-w-28">
                                </div>
                            </div>
                            <div class="flex items-center gap-2 mt-4">
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->job_type }}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->work_place }}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{ $job->salary_type === 'fixed' ? 'Fixed salary' : 'Hourly rate' }}</span>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 mt-4">
                                <div class="capitalize divide-x-2 divide-zinc-700">
                                    <span class="pr-1 ">{{ $job->experience_level }}</span><span
                                        class="pl-1 ">{{ $job->category }}</span>
                                </div>
                                <ul class="flex items-center gap-2">
                                    @foreach (json_decode($job->skills) as $skill)
                                        @if ($loop->iteration < 4)
                                            <li
                                                class="bg-zinc-100 text-zinc-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-zinc-700 dark:text-zinc-300">
                                                {{ $skill }}
                                            </li>
                                        @elseif ($loop->iteration === 4)
                                            <li class="text-xs font-medium text-zinc-800 dark:text-zinc-300">
                                                and more...
                                            </li>
                                            @break
                                        @endif
                                    @endforeach
                                </ul>

                                <a href="{{ route('jobs.show', $job->id) }}"
                                    class="flex justify-center gap-2 items-center ml-auto text-sm bg-zinc-50 dark:bg-zinc-700 backdrop-blur-md lg:font-semibold isolation-auto border-zinc-50 dark:border-zinc-500 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-indigo-600 hover:text-zinc-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-2.5 py-1 overflow-hidden border-2 rounded-full group">
                                    More details
                                    <svg class="justify-end w-8 h-8 p-2 duration-300 ease-linear rotate-45 rounded-full group-hover:rotate-90 group-hover:bg-zinc-50 text-zinc-50 group-hover:border-none"
                                        viewBox="0 0 16 19" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054 0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711 6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                                            class="fill-zinc-600 group-hover:fill-zinc-600"></path>
                                    </svg>
                                </a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {{ $jobs->links() }}

</x-app-layout>
<!--
<div class="overflow-hidden bg-white shadow-sm dark:bg-zinc-800 sm:rounded-lg">
<div class="p-6 text-zinc-900 dark:text-zinc-100">

@if (session('success'))
<div class="relative px-4 py-3 mb-4 text-indigo-700 bg-indigo-100 border border-indigo-400 rounded" role="alert">
<strong class="font-bold">{{ session('success') }}</strong>
</div>
@endif

<h3 class="mb-4 font-semibold">{{ __('Approved Job Listings') }}</h3>

@if ($jobs->isEmpty())
<p>{{ __('No approved jobs available.') }}</p>
@else
@foreach ($jobs as $job)
<div class="p-4 mb-4 rounded-lg shadow bg-zinc-100 dark:bg-zinc-700">
<h4 class="font-bold">{{ $job->title }}</h4>
<p>{{ $job->description }}</p>
<p><strong>{{ __('Category:') }}</strong> {{ $job->category }}</p>
<p><strong>{{ __('Location:') }}</strong> {{ $job->location }}</p>
<p><strong>{{ __('Salary Type:') }}</strong> {{ ucfirst($job->salary_type) }}</p>

@if (in_array($job->id, $appliedJobs))
<button disabled class="px-4 py-2 text-white bg-zinc-400 rounded">{{ __('Applied') }}</button>
@else
<a href="{{ route('jobs.show', $job->id) }}" class="text-indigo-500 hover:underline">{{ __('Apply Now') }}</a>
@endif
</div>
@endforeach

{{ $jobs->links() }}
@endif
</div>
</div>
-->