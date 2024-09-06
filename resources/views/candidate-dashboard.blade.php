<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-zinc-800 dark:text-zinc-200 leading-tight">
            {{ __('Candidate_DashBoard') }}
        </h2>
         <!-- Search Bar -->
         <div class="row mb-4">
            <div class="col-md-6 mx-auto">
                <input type="text" class="form-control" id="jobSearch" placeholder="Search by job title or skills needed">
            </div>
        </div>

    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="container mt-5">
       

        <!-- Job Listings Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Job Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Skills Needed</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Apply</th>
                    </tr>
                </thead>
                <tbody id="jobTable">
                    <tr>
                        <td>Frontend Developer</td>
                        <td>Develop user-facing features using HTML, CSS, and JavaScript</td>
                        <td>HTML, CSS, JavaScript, React</td>
                        <td>$80,000/year</td>
                        <td><button class="btn btn-primary">Apply</button></td>
                    </tr>
                    <tr>
                        <td>Backend Developer</td>
                        <td>Build and maintain server-side logic</td>
                        <td>Node.js, Express, MongoDB</td>
                        <td>$90,000/year</td>
                        <td><button class="btn btn-primary">Apply</button></td>
                    </tr>
                    <tr>
                        <td>Full Stack Developer</td>
                        <td>Work on both frontend and backend components</td>
                        <td>HTML, CSS, JavaScript, Node.js</td>
                        <td>$100,000/year</td>
                        <td><button class="btn btn-primary">Apply</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Search filter functionality
        document.getElementById('jobSearch').addEventListener('input', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#jobTable tr');

            rows.forEach(function(row) {
                let jobTitle = row.cells[0].textContent.toLowerCase();
                let skills = row.cells[2].textContent.toLowerCase();

                if (jobTitle.includes(searchValue) || skills.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>