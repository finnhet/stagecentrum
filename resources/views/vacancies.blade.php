@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 font-weight-bold">vacatures</h2>
    <p class="text-center text-muted mb-5">
        mooie stage plekjes
    </p>

    <div class="row justify-content-center">
        @forelse ($vacancies as $vacancy)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card shadow-lg border-0 rounded-lg hover-effect">
                    <div class="card-body text-center">
                        <h5 class="card-title font-weight-bold">{{ $vacancy->title }}</h5>
                        <p class="text-muted">{{ Str::limit($vacancy->introduction,) }}</p>
                        <p class="text-info font-weight-bold">{{ $vacancy->location }}</p>
                        <a href="#" class="btn btn-primary btn-sm mt-2">Bekijk vacature</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">geen vacatures gevonden</p>
        @endforelse
    </div>
</div>

<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
