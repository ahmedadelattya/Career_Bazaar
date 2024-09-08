<x-app-layout>

    <body class="bg-gray-100 ">

        <div class="container mx-auto p-6 text-white ">
            <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8 text-center ">
                <h1>All Jobs</h1>

                <div class="overflow-x-auto bg-white rounded-lg shadow-md dark:bg-zinc-800">
                    <table id="default-table" class="min-w-full text-sm bg-white dark:bg-zinc-800">
                        <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Title</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Creator</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Category</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Location</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Salary Type</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Salary</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Status</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Skills</th>
                                <th class="px-6 py-3 text-xs font-medium text-left uppercase">Created At</th>
                                <th class="px-6 py-3 text-xs font-medium text-center uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 ">
                            @foreach ($jobs as $job)
                                @if ($job->status == 'approved')
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->title }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->category }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->location }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->salary_type }}</td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->salary_type == 'hourly' ? $job->hourly_rate : $job->fixed_salary }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->status }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->skills }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            {{ $job->created_at }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-medium  whitespace-nowrap ">
                                            <button class="px-4 py-2 text-white bg-blue-500 rounded-lg">Apply</button>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Include simple-datatables -->
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest"></script>


        <!-- Initialize the DataTable -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dataTable = new simpleDatatables.DataTable("#default-table", {
                    searchable: true, // Enable search
                    perPage: 5, // Pagination
                    perPageSelect: [5, 10, 20], // Dropdown for pagination options
                    sortable: true, // Enable sorting
                });
            });
        </script>
    </body>

</x-app-layout>
