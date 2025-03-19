@extends('layouts.header')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $vacancy->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .company-logo {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }
        .filter-card {
            background-color: rgba(0, 0, 108, 1); 
            color: white; /* White text */
        }

        .filter-card .card-body {
            background-color: rgba(0, 0, 108, 1); 
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="text-center">
                    <h4>{{ $user->name }}</h4>
                    <p class="text-muted">{{ $vacancy->location }}</p>
                </div>
                @if (!empty($user->description))
                    <p><strong>Over ons:</strong></p>
                    <p>{{ $user->description }}</p>
                @endif
                <a href="{{ url('/users') }}?id={{ $vacancy->company_id }}" class="btn btn-outline-primary w-100 mt-2">
                    Bedrijfspagina
                </a>    
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-4">
                <h3 class="card-title">{{ $vacancy->title }}</h3>
                <h6 class="card-subtitle text-muted">{{ $vacancy->location }}</h6>
                <hr>
                @if (!empty($vacancy->introduction))
                    <p><strong>Introductie:</strong></p>
                    <p>{{ $vacancy->introduction }}</p>
                    <hr>
                @endif

                @if(!empty($vacancy->description))
                    <p><strong>Beschrijving:</strong></p>
                    <p>{{ $vacancy->description }}</p>
                    <hr>
                @endif

                @if($vacancy->filters->isNotEmpty())
                    <p><strong>Filters:</strong></p>
                    <div class="row">
                        @foreach($vacancy->filters as $filter)
                            <div class="col-md-2 col-sm-3 col-4 mb-2">
                                <div class="card h-100 text-center filter-card">
                                    <div class="card-body p-2">
                                        <h6 class="card-title mb-1" style="font-weight: 700; font-size: 0.9rem; color: white; background-color: rgba(0, 0, 108, 1);">{{ $filter->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No filters available for this vacancy.</p>
                @endif





               

                <div class="d-flex justify-content-between">
                    <a onclick="history.back();" class="btn btn-secondary">Terug naar vacatures</a>

                    @if (Auth::user() && Auth::user()->admin) 
                        <form action="{{ route('vacancy.destroy', $vacancy->id) }}" method="POST"
                              onsubmit="return confirm('Weet u zeker dat u deze vacature wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Verwijderen</button>
                        </form>
                    @endif
                </div>   
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
