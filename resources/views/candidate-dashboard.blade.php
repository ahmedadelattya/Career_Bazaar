<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" text-zinc-800 dark:text-zinc-200">
                <header class="text-2xl font-bold ">
                    {{__('Newly added jobs')}}
                </header>
                <div class="space-y-6 mt-6">
                    @foreach ($jobs as $job)
                        <div class="p-4 bg-zinc-100 dark:bg-zinc-800 shadow rounded-lg border dark:border-zinc-700">
                            <div class="flex justify-between">
                                <div>
                                    <h2 class="text-2xl font-semibold mb-2">{{$job->title}}</h2>
                                    <div class="flex items-center gap-2 text-zinc-600 dark:text-zinc-400 text-sm">
                                        <p class="">{{$employer->name ?? 'N/A'}}</p>
                                        <span>-</span>
                                        <p>{{$job->location}}</p>
                                    </div>
                                    <span class="inline-block text-zinc-300 dark:text-zinc-500 text-xs">Posted
                                        {{$job->created_at->diffForHumans()}}</span>
                                </div>
                                <div class="object-cover">
                                    <img src="{{asset('images/employers/images/ktBcKk3j1feuHcLgtvSyX2LLL2Uh8ov5iRo1urPs.jpg')}}"
                                        alt="Company logo" class="max-w-28">
                                </div>
                            </div>
                            <div class="mt-4 flex items-center gap-2">
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{$job->job_type}}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{$job->work_place}}</span>
                                <span
                                    class="bg-zinc-100 text-zinc-800 text-sm font-medium px-2.5 py-1 rounded dark:bg-zinc-700 dark:text-zinc-300 capitalize">{{$job->salary_type === 'fixed' ? "Fixed salary" : "Hourly rate"}}</span>
                            </div>
                            <div class="flex items-center mt-4 gap-4 flex-wrap">
                                <div class=" capitalize divide-x-2 divide-zinc-700">
                                    <span class="pr-1 ">{{$job->experience_level}}</span><span
                                        class="pl-1 ">{{$job->category}}</span>
                                </div>
                                <ul class="flex items-center gap-2">
                                    @foreach(json_decode($job->skills) as $skill)
                                        @if ($loop->iteration < 4)
                                            <li
                                                class="bg-zinc-100 text-zinc-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-zinc-700 dark:text-zinc-300">
                                                {{ $skill }}
                                            </li>
                                        @elseif ($loop->iteration === 4) 
                                            <li class="text-zinc-800 text-xs font-medium dark:text-zinc-300">
                                                and more...
                                            </li>
                                            @break
                                        @endif
                                    @endforeach
                                </ul>

                                <a href="{{ route('jobs.show', $job->id) }}"
                                    class="flex justify-center gap-2 items-center ml-auto text-sm bg-zinc-50 dark:bg-zinc-700 backdrop-blur-md lg:font-semibold isolation-auto border-zinc-50 dark:border-zinc-500 before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0 before:rounded-full before:bg-indigo-600 hover:text-zinc-50 before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700 relative z-10 px-2.5 py-1 overflow-hidden border-2 rounded-full group">
                                    More details
                                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 group-hover:bg-zinc-50 text-zinc-50 ease-linear duration-300 rounded-full  group-hover:border-none p-2 rotate-45"
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
<div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">

@if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">{{ session('success') }}</strong>
    </div>
@endif

<h3 class="font-semibold mb-4">{{ __('Approved Job Listings') }}</h3>

@if ($jobs->isEmpty())
    <p>{{ __('No approved jobs available.') }}</p>
@else
    @foreach ($jobs as $job)
        <div class="mb-4 p-4 bg-zinc-100 dark:bg-zinc-700 rounded-lg shadow">
            <h4 class="font-bold">{{ $job->title }}</h4>
            <p>{{ $job->description }}</p>
            <p><strong>{{ __('Category:') }}</strong> {{ $job->category }}</p>
            <p><strong>{{ __('Location:') }}</strong> {{ $job->location }}</p>
            <p><strong>{{ __('Salary Type:') }}</strong> {{ ucfirst($job->salary_type) }}</p>

            @if (in_array($job->id, $appliedJobs))
                <button disabled class="bg-gray-400 text-white px-4 py-2 rounded">{{ __('Applied') }}</button>
            @else
                <a href="{{ route('jobs.show', $job->id) }}" class="text-blue-500 hover:underline">{{ __('Apply Now') }}</a>
            @endif
        </div>
    @endforeach

    {{ $jobs->links() }}
@endif
</div>
</div>
-->