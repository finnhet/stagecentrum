@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 font-weight-bold">Vacatures</h2>
    <div class="row">
        <!-- Sidebar voor de filters -->
        <div class="col-md-2 bg-light p-3 rounded">
            <h5 class="font-weight-bold">Filters</h5>
            <form action="{{ route('vacancies.filter', ['fieldId' => $fieldId]) }}" method="GET" class="mb-4">
                @foreach ($filters as $filter)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="filters[]" value="{{ $filter->id }}" 
                            id="filter-{{ $filter->id }}" 
                            {{ in_array($filter->id, request()->input('filters', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="filter-{{ $filter->id }}">
                            {{ $filter->name }}
                        </label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary btn-sm mt-2">Filter</button>
            </form>
        </div>
        
        <!--- Hier staan de vacancies --->
        <div class="col-md-10">
            @if(session('message'))
                <p class="text-center text-danger">{{ session('message') }}</p>
            @endif

            <div class="row">
                @forelse ($vacancies as $vacancy)
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4"> 
                        <div class="card shadow-lg border-0 rounded-lg hover-effect">
                            <div class="card-body text-center">
                                <h5 class="card-title font-weight-bold">{{ $vacancy->title }}</h5>
                                <p class="text-muted">{{ Str::limit($vacancy->introduction, 50) }}</p>
                                <p class="text-info font-weight-bold">{{ $vacancy->location }}</p>
                                <a href="{{ route('vacancy.show', $vacancy->id) }}" class="btn btn-primary btn-sm mt-2">Bekijk vacature</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Sorry, we hebben geen vacatures kunnen vinden.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
