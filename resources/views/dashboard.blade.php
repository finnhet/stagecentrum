<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
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
                                <a href="{{ route('vacancy.edit', ['id' => $vacancy->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('vacancy.toggleActive', ['id' => $vacancy->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                        class="btn {{ $vacancy->active ? 'btn-success' : 'btn-secondary' }}" 
                                        data-bs-toggle="tooltip" 
                                        title="{{ $vacancy->active ? 'Vacature is actief' : 'Vacature is inactief' }}">
                                        <i class="fas {{ $vacancy->active ? 'fa-eye' : 'fa-eye-slash' }}"></i>
                                    </button>
                                </form>

                                <!-- Verwijderen -->
                                <form action="{{ route('vacancy.destroy', ['id' => $vacancy->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                            onclick="return confirm('Weet u zeker dat u deze vacature wilt verwijderen?');">
                                        <i class="fas fa-trash"></i>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

</x-app-layout>
