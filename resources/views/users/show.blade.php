@extends('layouts.header')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-4">
        <h1 class="text-primary mb-4">User Details</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(isset($user))
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefoon:</strong> {{ $user->telephone }}</p>
            <p><strong>Beschrijving:</strong> {{ $user->description }}</p>
        @else
            <p class="text-muted">Geen user data beschikbaar.</p>
        @endif

        <h2 class="text-primary mt-4">Vacancies</h2>

        @forelse($vacancies as $vacancy)
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title text-primary">{{ $vacancy->title }}</h3>
                    <p class="card-text">{{ $vacancy->description }}</p>
                    <p class="text-muted">Locatie: {{ $vacancy->location }}</p>
                </div>
            </div>
        @empty
            <p class="text-muted">Geen vacatures beschikbaar voor dit bedrijf.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
