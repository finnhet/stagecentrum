<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacature Aanmaken</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <x-app-layout>
        <div class="container mt-5">
            <div class="p-4 shadow-lg rounded mx-auto bg-white" style="max-width: 600px;">
                <h3 class="text-center mb-4">Vacature Aanmaken</h3>

                <form method="GET" action="{{ url('/vacancy_create') }}">
                    <div class="mb-3">
                        <label for="fieldSelect" class="form-label">Werkveld</label>
                        <select class="form-control" id="fieldSelect" name="field_id" onchange="this.form.submit()">
                            <option value="" disabled {{ is_null($selectedFieldId) ? 'selected' : '' }}>
                                Selecteer een werkveld
                            </option>
                            @foreach ($fields as $field)
                                <option value="{{ $field->id }}" {{ $selectedFieldId == $field->id ? 'selected' : '' }}>
                                    {{ $field->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>

                <form class="row g-3 mt-3" action="{{ url('/vacancy_create') }}" method="POST">
                    @csrf
                    <input type="hidden" name="field_id" value="{{ $selectedFieldId }}">

                    <h5 class="text-center mt-4">Selecteer Filters</h5>

                    <div class="mb-3">
                        <input type="text" id="filterSearch" class="form-control" placeholder="Zoek filters...">
                    </div>

                    <div id="filtersContainer" class="row g-2">
                        @forelse ($filters as $filter)
                            <div class="col-6 filter-item">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="filters[]" value="{{ $filter->id }}" id="filter{{ $filter->id }}">
                                    <label class="form-check-label" for="filter{{ $filter->id }}">{{ $filter->name }}</label>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Geen filters beschikbaar.</p>
                        @endforelse
                    </div>

                    <div class="text-center mt-2">
                        <button type="button" id="toggleFiltersBtn" class="btn btn-link">Meer weergeven</button>
                    </div>

                    <div class="mt-3">
                        <div class="input-group">
                            <input type="text" id="newFilterName" class="form-control" placeholder="Nieuwe filter toevoegen">
                            <button type="button" id="addFilterBtn" class="btn btn-success" style="background-color: rgb(0, 0, 108);">Toevoegen</button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="inputTitle" class="form-label">Titel</label>
                        <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Titel" maxlength="100" required>
                    </div>
                    <div class="col-12">
                        <label for="inputIntroduction" class="form-label">Introductie</label>
                        <input type="text" class="form-control" id="inputIntroduction" name="introduction" placeholder="Introductie" maxlength="150" required>
                    </div>
                    <div class="col-12">
                        <label for="inputDescription" class="form-label">Beschrijving</label>
                        <textarea class="form-control" id="inputDescription" name="description" rows="3" placeholder="Beschrijving" maxlength="250" required></textarea>
                    </div>
                    <div class="col-12">
                        <label for="inputLocation" class="form-label">Locatie</label>
                        <input type="text" class="form-control" id="inputLocation" name="location" placeholder="Locatie" maxlength="50" required>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: rgb(0, 0, 108);">Vacature Aanmaken</button>
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const addFilterBtn = document.getElementById("addFilterBtn");
        const newFilterName = document.getElementById("newFilterName");
        const filtersContainer = document.getElementById("filtersContainer");
        const filterSearch = document.getElementById("filterSearch");
        const toggleFiltersBtn = document.getElementById("toggleFiltersBtn");

        let allFilters = Array.from(filtersContainer.children);
        
        function updateFilterVisibility() {
            allFilters = Array.from(filtersContainer.children);
            if (allFilters.length > 10) {
                toggleFiltersBtn.style.display = "inline-block";
                allFilters.slice(10).forEach(filter => filter.style.display = "none");
            } else {
                toggleFiltersBtn.style.display = "none";
            }
        }

        updateFilterVisibility();

        filterSearch.addEventListener("input", function () {
            const searchValue = this.value.toLowerCase();
            allFilters.forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(searchValue) ? "block" : "none";
            });
        });

        toggleFiltersBtn.addEventListener("click", function () {
            if (toggleFiltersBtn.textContent === "Meer weergeven") {
                allFilters.slice(10).forEach(filter => filter.style.display = "block");
                toggleFiltersBtn.textContent = "Minder weergeven";
            } else {
                allFilters.slice(10).forEach(filter => filter.style.display = "none");
                toggleFiltersBtn.textContent = "Meer weergeven";
            }
        });

        addFilterBtn.addEventListener("click", function () {
            const filterValue = newFilterName.value.trim();

            if (!filterValue) {
                alert("Vul een filternaam in!");
                return;
            }

            fetch("{{ route('filters.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    name: filterValue,
                    field_id: "{{ $selectedFieldId }}"
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Netwerkprobleem of serverfout");
                }
                return response.json();
            })
            .then(filter => {
                const filterDiv = document.createElement("div");
                filterDiv.classList.add("col-6", "filter-item");
                filterDiv.innerHTML = `
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="filters[]" value="${filter.id}" checked>
                        <label class="form-check-label">${filter.name}</label>
                    </div>`;
                filtersContainer.appendChild(filterDiv);
                newFilterName.value = "";
                updateFilterVisibility();
            })
            .catch(error => console.error("Error:", error));
        });
    });
</script>
</body>
</html>