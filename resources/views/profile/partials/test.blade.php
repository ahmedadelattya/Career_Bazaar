<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-zinc-800 dark:text-zinc-200">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="p-6 bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                <div class="flex flex-col items-center space-x-4 md:flex-row">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile Picture"
                        class="w-24 h-24 rounded-full">
                    <div>
                        <h2 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Robert Smith</h2>
                        <p class="text-sm text-zinc-600 dark:text-zinc-300">Product Designer</p>
                        <div class="flex mt-2 space-x-2">
                            <button class="p-2 text-white rounded-full bg-zinc-800">
                                ✉️
                            </button>
                            <button class="p-2 text-white rounded-full bg-zinc-800">
                                📞
                            </button>
                            <button class="p-2 text-white rounded-full bg-zinc-800">
                                💬
                            </button>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <p class="text-zinc-600 dark:text-zinc-300">Time Slots</p>
                        <p class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">April, 2024</p>
                        <button class="px-4 py-2 mt-2 text-white bg-blue-500 rounded-lg">Meetings (3)</button>
                    </div>
                </div>
            </div>

            <!-- Ongoing Projects -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="col-span-1 p-6 bg-white shadow md:col-span-2 dark:bg-zinc-800 sm:rounded-lg">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Ongoing Projects</h3>
                    <div class="mt-4 space-y-4">
                        <!-- Project 1 -->
                        <div class="flex items-center justify-between p-4 bg-yellow-100 rounded-lg">
                            <div>
                                <h4 class="text-lg font-bold text-zinc-900">Web Designing</h4>
                                <p class="text-sm text-zinc-600">Prototyping</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-zinc-600">Progress</span>
                                <span class="px-2 py-1 text-xs text-white bg-yellow-400 rounded-full">2 Days Left</span>
                            </div>
                        </div>
                        <!-- Project 2 -->
                        <div class="flex items-center justify-between p-4 bg-blue-100 rounded-lg">
                            <div>
                                <h4 class="text-lg font-bold text-zinc-900">Mobile App</h4>
                                <p class="text-sm text-zinc-600">Design</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-zinc-600">Progress</span>
                                <span class="px-2 py-1 text-xs text-white bg-blue-400 rounded-full">5 Days Left</span>
                            </div>
                        </div>
                        <!-- Project 3 -->
                        <div class="flex items-center justify-between p-4 bg-pink-100 rounded-lg">
                            <div>
                                <h4 class="text-lg font-bold text-zinc-900">Dashboard</h4>
                                <p class="text-sm text-zinc-600">Wireframe</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-zinc-600">Progress</span>
                                <span class="px-2 py-1 text-xs text-white bg-pink-400 rounded-full">8 Days Left</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Section -->
                <div class="col-span-1 p-6 bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Calendar</h3>
                    <div class="grid grid-cols-7 gap-4 mt-4">
                        <!-- Example calendar dates -->
                        <div
                            class="p-2 text-center bg-gray-100 rounded-lg dark:bg-gray-700 text-zinc-900 dark:text-zinc-100">
                            1</div>
                        <div
                            class="p-2 text-center bg-gray-100 rounded-lg dark:bg-gray-700 text-zinc-900 dark:text-zinc-100">
                            2</div>
                        <div
                            class="p-2 text-center bg-gray-100 rounded-lg dark:bg-gray-700 text-zinc-900 dark:text-zinc-100">
                            3</div>
                        <!-- Add more dates as needed -->
                    </div>
                </div>
            </div>

            <!-- Detailed Information Section -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="col-span-1 p-6 bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Detailed Information</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-semibold text-zinc-600 dark:text-zinc-300">Full Name</p>
                            <p class="text-zinc-900 dark:text-zinc-100">Robert Smith</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-600 dark:text-zinc-300">Email Address</p>
                            <p class="text-zinc-900 dark:text-zinc-100">robertsmith64@gmail.com</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-600 dark:text-zinc-300">Contact Number</p>
                            <p class="text-zinc-900 dark:text-zinc-100">(555) 555-5674</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-600 dark:text-zinc-300">Designation</p>
                            <p class="text-zinc-900 dark:text-zinc-100">Product Designer</p>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-zinc-600 dark:text-zinc-300">Availability</p>
                            <p class="text-zinc-900 dark:text-zinc-100">Schedule the time slot</p>
                        </div>
                    </div>
                </div>

                <!-- Inbox Section -->
                <div class="col-span-2 p-6 bg-white shadow dark:bg-zinc-800 sm:rounded-lg">
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Inbox</h3>
                    <div class="mt-4 space-y-4">
                        <div class="p-4 bg-yellow-100 rounded-lg">
                            <p class="font-semibold text-zinc-900">Web Designing</p>
                            <p class="text-sm text-zinc-600">Hey tell me about progress of project? Waiting for your
                                response.</p>
                        </div>
                        <div class="p-4 text-white rounded-lg bg-zinc-800">
                            <p class="font-semibold">Stephanie</p>
                            <p class="text-sm">I got your first assignment. It was quite good 👏</p>
                        </div>
                        <div class="p-4 bg-gray-100 rounded-lg">
                            <p class="font-semibold text-zinc-900">William</p>
                            <p class="text-sm text-zinc-600">I want some changes in previous work you sent me. Waiting
                                for your reply.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
