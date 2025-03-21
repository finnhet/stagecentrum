@extends('layouts.header')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center mb-4">
        <button>
            <a href="{{ url('/') }}">Terug</a>
        </button>
        <h2 class="text-center flex-grow-1 font-weight-bold">Vacatures</h2>
    </div>

    <div class="row">
        <!-- Sidebar voor de filters -->
        <div class="col-md-2 bg-light p-3 m-10" style="border-radius: 25px; margin-bottom: 10px; box-shadow: -5px 6px 46px -7px rgb(0 0 0 / 36%);">
            <h5 class="font-weight-bold">Filters</h5>
            <nav class="navbar navbar-light bg-light">
                <div class="d-flex w-100">
                    <input class="form-control me-2 w-100" type="search" id="livesearch" placeholder="Zoek" aria-label="Search">
                </div>
            </nav>
            <form action="{{ route('vacancies.filter', ['fieldId' => $fieldId]) }}" method="GET" class="mb-4" id="filter-form">
                <div id="filter-container">
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
                </div>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Filter</button>
            </form>
        </div>
        
        <!--- Hier staan de vacatures --->
        <div class="col-md-10">
            @if(session('message'))
                <p class="text-center text-danger">{{ session('message') }}</p>
            @endif

            <div class="row">
                @forelse ($vacancies as $vacancy)
                    <div class="col-sm-6 col-md-4 col-lg-4 mb-4"> 
                        <div class="card shadow-lg border-0 rounded-lg hover-effect" style="height: 100%;">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("livesearch");

    searchInput.addEventListener("keyup", function () {
        let query = this.value;
        let fieldId = "{{ $fieldId }}";

        fetch("{{ route('filters.liveSearch') }}?query=" + query + "&fieldId=" + fieldId)
            .then(response => response.json())
            .then(data => {
                let filterContainer = document.getElementById("filter-container");
                let selectedFilters = new Set(
                    [...document.querySelectorAll("input[name='filters[]']:checked")].map(el => el.value)
                );

                filterContainer.innerHTML = "";

                if (data.length > 0) {
                    data.forEach(filter => {
                        let checked = selectedFilters.has(filter.id.toString()) ? "checked" : "";
                        let filterItem = `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="filters[]" value="${filter.id}" id="filter-${filter.id}" ${checked}>
                                <label class="form-check-label" for="filter-${filter.id}">${filter.name}</label>
                            </div>
                        `;
                        filterContainer.innerHTML += filterItem;
                    });
                } else {
                    filterContainer.innerHTML = `<p class="text-center">Geen filters gevonden.</p>`;
                }
            });
    });
});

</script>
