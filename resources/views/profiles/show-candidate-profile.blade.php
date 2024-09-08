<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <!-- Profile Section -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <!-- Profile Picture -->
            <div class="flex justify-center mb-4">
                <img class="w-32 h-32 rounded-full border-4 border-indigo-500" 
                     src="{{ asset($user->profile_picture) }}" 
                     alt="Profile Picture">
            </div>

            <!-- User Name -->
            <div class="text-center">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
            </div>
            <!-- User Email -->
            <div class="text-center">
                <p class="text-gray-600">{{ $user->email }}</p>
            </div>
            <!-- user job title -->
            <div class="text-center">
                <p class="text-gray-600">{{ $user->candidate_job_title }}</p>
            </div>
            <!-- Skills Section -->
            <div class="mt-6">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Skills</h3>
                <div class="flex flex-wrap justify-center">
                  @foreach ($user->candidate_skills as $skill)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $skill }}</span>
                  @endforeach
                </div>
            </div>
            <!-- projects -->
            <div class="mt-6">
                <h3 class="text-xl font-medium text-gray-700 mb-4">Projects</h3>
                <div class="flex flex-wrap justify-center">
                  @foreach ($user->candidate_projects as $project)
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $project }}</span>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>
