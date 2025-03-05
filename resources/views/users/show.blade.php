<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-blue-50 flex items-center justify-center min-h-screen p-6">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-6xl">
        <h1 class="text-3xl font-bold mb-6 text-blue-700">User Details</h1>

        @if(session('error'))
            <p class="text-red-500 mb-4">{{ session('error') }}</p>
        @endif

        @if(isset($user))
            <p class="mb-4"><strong>Name:</strong> {{ $user->name }}</p>
            <p class="mb-4"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="mb-4"><strong>Telefoon:</strong> {{ $user->telephone }}</p>
            <p class="mb-4"><strong>Beschrijving:</strong> {{ $user->description }}</p>
        @else
            <p class="text-gray-700">No user data available.</p>
        @endif

        <h2 class="text-2xl font-bold mt-8 mb-6 text-blue-700">Vacancies</h2>

        @forelse($vacancies as $vacancy)
            <div class="bg-blue-100 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-blue-800">{{ $vacancy->title }}</h3>
                <p class="text-gray-700">{{ $vacancy->description }}</p>
                <p class="text-gray-500 text-sm">Location: {{ $vacancy->location }}</p>
            </div>
        @empty
            <p class="text-gray-700">geen vacatures beschikbaar voor dit bedrijf.</p>
        @endforelse
    </div>
</body>
</html>
