<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table with Search</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    
    <div class="container mx-auto p-6">
        <div class="mx-auto mt-6 max-w-7xl sm:px-6 lg:px-8 text-center">
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
                            <th class="px-6 py-3 text-xs font-medium text-left uppercase">Created At</th>
                            <th class="px-6 py-3 text-xs font-medium text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr>
                            <td class="px-6 py-4">Job Title Example</td>
                            <td class="px-6 py-4">John Doe</td>
                            <td class="px-6 py-4">Engineering</td>
                            <td class="px-6 py-4">cairo</td>
                            <td class="px-6 py-4">Hourly</td>
                            <td class="px-6 py-4">$50</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold leading-tight text-green-700 bg-green-100 rounded-full">Active</span>
                            </td>
                            <td class="px-6 py-4">2024-09-07</td>
                            <td class="px-6 py-4 text-center">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mr-2">
                                    Apply
                                </button>
                             
                            </td>
                        </tr>
                       <tr>
                            <td class="px-6 py-4">IT</td>
                            <td class="px-6 py-4">Jane Doe</td>
                            <td class="px-6 py-4">Engineering</td>
                            <td class="px-6 py-4">alexandria</td>
                            <td class="px-6 py-4">Hourly</td>
                            <td class="px-6 py-4">$50</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs font-semibold leading-tight text-red-700 bg-red-100 rounded-full">Closed</span>
                            </td>
                            <td class="px-6 py-4">2024-09-07</td>
                            <td class="px-6 py-4 text-center">
                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded mr-2">
                                    Apply
                                </button>
                            </td>
                       </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include simple-datatables -->
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
</html>
