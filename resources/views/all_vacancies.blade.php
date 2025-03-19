@extends('layouts.header')

@section('content')
<div class="container mt-4">
    <h2>Alle vacatures</h2>

    <form action="{{ route('vacancies.search') }}" method="GET" class="form-inline my-2">
        <input class="form-control mr-2" type="search" name="filter" placeholder="Zoek voor filter" aria-label="Search" value="{{ request('filter') }}">
        <button class="btn btn-primary" type="submit">zoek</button>
    </form>

    @if(isset($searchTerm))
        <h4 class="mt-3">Resultaten voor "{{ $searchTerm }}"</h4>
    @endif

    @if(count($vacancies) > 0)
        <div class="list-group mt-3">
            @foreach($vacancies as $vacancy)
                <a href="{{ route('vacancy.show', $vacancy->id) }}" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">{{ $vacancy->title }}</h5>
                    <p class="mb-1">{{ $vacancy->introduction }}</p>
                    <small>Location: {{ $vacancy->location }}</small>
                </a>
            @endforeach
        </div>
    @else
        <p class="mt-3">Geen vacatures gevonden voor dit filter.</p>
    @endif
</div>
@endsection
