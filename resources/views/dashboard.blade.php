<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <!-- Bootstrap toegevoegd -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <div class="container mt-5">
        <h2 class="text-primary fw-bold mb-4">Uw vacatures</h2>

        @if(isset($vacancies) && $vacancies->isNotEmpty())
            <div class="row g-4">
                @foreach($vacancies as $vacancy)
                    <div class="col-md-6 col-lg-4">
                        <div class="card bg-light border-0 shadow-sm p-4 position-relative">
                            <h3 class="card-title text-primary">{{ $vacancy->title }}</h3>
                            <p class="card-text text-muted">{{ $vacancy->introduction }}</p>
                            <p class="card-text small text-secondary">Locatie: {{ $vacancy->location }}</p>

                            <div class="d-flex gap-2">
                                
                                <a href="{{ route('vacancy.edit', ['id' => $vacancy->id]) }}" 
                                   class="btn btn-primary">
                                    Bewerk
                                </a>

                                <form action="{{ route('vacancy.destroy', ['id' => $vacancy->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Weet u zeker dat u deze vacature wilt verwijderen?');">
                                        Verwijder
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-muted">U heeft nog geen vacatures.</p>
        @endif
    </div>
</x-app-layout>
