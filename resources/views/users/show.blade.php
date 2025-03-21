@extends('layouts.header')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-link:hover .card {
            transform: scale(1.02);
            transition: 0.3s ease-in-out;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .back-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 15px;
        }

        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <a href="javascript:history.back()" class="back-btn">&larr; Terug</a>

        <h1 class="mb-4">{{ $user->name }}</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(isset($user))
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Telefoon:</strong> {{ $user->telephone }}</p>
            <p><strong>Beschrijving:</strong> {{ $user->description }}</p>
        @else
            <p class="text-muted">Geen user data beschikbaar.</p>
        @endif

        <h2 class="text-primary mt-4">Vacatures</h2>

        @forelse($vacancies as $vacancy)
            <a href="{{ route('vacancy.show', $vacancy->id) }}" class="card-link">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-primary">{{ $vacancy->title }}</h3>
                        <p class="card-text">{{ $vacancy->description }}</p>
                        <p class="text-muted">Locatie: {{ $vacancy->location }}</p>
                        <p class="text-muted">Werkveld: {{ $workfield }}</p>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-muted">Geen vacatures beschikbaar voor dit bedrijf.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
