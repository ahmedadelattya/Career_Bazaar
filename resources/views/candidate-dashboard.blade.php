<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class=" text-zinc-800 dark:text-zinc-200">
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
                <div class="my-8 space-x-4 flex flex-wrap justify-between gap-2">
                    <!-- Salary -->
                    <div class="text-white ">
                        <form method="get" action="{{ route('filter') }}">
                            @csrf
                            {{-- if user entered minimum amount more than the maximum amount he gets the whole records
                            --}}
                            <div class="flex">
                                <div class="flex">
                                    <!-- Fixed -->
                                    <input type="radio" name="salary_type" id="fixed" value="fixed" checked
                                        class="sr-only peer/fixed">
                                    <label for="fixed"
                                        class="cursor-pointer py-auto flex items-center justify-center px-4 rounded-s-lg bg-indigo-200 text-indigo-900 peer-checked/fixed:bg-indigo-700 peer-checked/fixed:text-indigo-50 duration-75 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/fixed:bg-indigo-900 dark:peer-checked/fixed:text-indigo-50">
                                        {{ __('Fixed') }}
                                    </label>

                                    <!-- Hourly -->
                                    <input type="radio" name="salary_type" id="hourly" value="hourly"
                                        class="sr-only peer/hourly">
                                    <label for="hourly"
                                        class="cursor-pointer py-auto flex items-center justify-center px-4 bg-indigo-200 text-indigo-900 peer-checked/hourly:bg-indigo-700 peer-checked/hourly:text-indigo-50 duration-75 dark:bg-indigo-600 dark:text-indigo-200 dark:peer-checked/hourly:bg-indigo-900 dark:peer-checked/hourly:text-indigo-50">
                                        {{ __('Hourly') }}
                                    </label>
                                </div>
                                <!-- Min -->
                                <div class="relative">
                                    <input type="text" id="min" name="min"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-zinc-900 bg-transparent  border-1 border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                        placeholder=" " required />
                                    <label for="min"
                                        class="absolute text-sm text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-zinc-900 px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Min</label>
                                </div>
                                <!-- Max -->
                                <div class="relative">
                                    <input type="text" id="max" name="max"
                                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-zinc-900 bg-transparent border-1 border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                        placeholder=" " required />
                                    <label for="max"
                                        class="absolute text-sm text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-zinc-900 px-2 peer-focus:px-2 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Max</label>
                                </div>
                                <button type="submit"
                                    class="focus:outline-none text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-e-lg text-sm px-5  dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-900">
                                    Filter
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Skill -->
                    <div class="text-zinc-800 dark:text-zinc-200">
                        <form method="get" action="{{ route('skillsearch') }}" class="flex items-center gap-2">
                            @csrf
                            <label for="underline_select" class="sr-only">Underline select</label>
                            <select id="underline_select" name="select_skill"
                                class="block py-2.5 px-0 w-full text-sm text-zinc-500 bg-transparent border-0 border-b-2 border-zinc-200 appearance-none dark:text-zinc-400 dark:border-zinc-700 focus:outline-none focus:ring-0 focus:border-zinc-200 peer">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->name }}"
                                        class="text-zinc-800 bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200">
                                        {{ $skill->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit"
                                class="px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Filter</button>
                        </form>
                    </div>
                    <!-- Date -->
                    <div class="text-zinc-800 dark:text-zinc-200">
                        <form method="GET" action="{{ route('datesearch') }}" class="flex items-center gap-2">
                            @csrf
                            <div class="relative z-0">
                                <input type="date" name="start" id="date-from"
                                    class="block py-2.5 px-0 w-full text-sm text-zinc-900 bg-transparent border-0 border-b-2 border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                    placeholder=" " />
                                <label for="date-from"
                                    class="absolute text-sm text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">From</label>
                            </div>
                            <div class="relative z-0">
                                <input type="date" name="end" id="date-to"
                                    class="block py-2.5 px-0 w-full text-sm text-zinc-900 bg-transparent border-0 border-b-2 border-zinc-300 appearance-none dark:text-white dark:border-zinc-600 dark:focus:border-indigo-500 focus:outline-none focus:ring-0 focus:border-indigo-600 peer"
                                    placeholder=" " />
                                <label for="date-to"
                                    class="absolute text-sm text-zinc-500 dark:text-zinc-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">To</label>
                            </div>
                            <button type="submit"
                                class="px-3 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Filter</button>
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