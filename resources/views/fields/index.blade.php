@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 font-weight-bold">Stagecentrum</h2>
    <p class="text-center text-muted mb-5">
        Welkom op Stagecentrum! Hier vind je de perfecte stage die past bij jouw studie en interesses. Blader door onze
        verschillende categorieën en ontdek een breed aanbod aan stages bij topbedrijven. Of je nu op zoek bent naar
        een stage in Informatica, Gezondheid, Taal en Communicatie of een andere sector, wij helpen je de juiste match
        te vinden. Start vandaag nog jouw zoektocht en zet de eerste stap naar een succesvolle carrière!
    </p>

    <div class="row justify-content-center">
        @foreach ($fields as $field)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card shadow-lg border-0 rounded-lg hover-effect">
                    <div class="card-body text-center">
                        <h5 class="card-title font-weight-bold">{{ $field->name }}</h5>
                        <p class="card-text text-muted">
                        </p>
                        <a href="{{ route('vacancies.byField', $field->id) }}" class="btn btn-info">vacatures</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    .hover-effect:hover {
        transform: scale(1.05);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
