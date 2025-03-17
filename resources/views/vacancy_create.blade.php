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

                <div class="border p-3 rounded bg-light mb-3">
                    <h5 class="text-center mb-2">Selecteer Filters</h5>
                    <div id="filtersContainer" class="row g-2">
                        @forelse ($filters as $filter)
                            <div class="col-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="filters[]" value="{{ $filter->id }}" id="filter{{ $filter->id }}">
                                    <label class="form-check-label" for="filter{{ $filter->id }}">{{ $filter->name }}</label>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">Geen filters beschikbaar.</p>
                        @endforelse
                    </div>

                    <div class="mt-3 d-flex gap-2">
                        <input type="text" id="newFilterName" class="form-control" placeholder="Nieuwe filter toevoegen">
                        <button type="button" id="addFilterBtn" class="btn text-white" style="background-color: rgb(0, 0, 108);">
                            Toevoegen
                        </button>
                    </div>
                </div>

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
<<<<<<< HEAD

                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn text-white w-100" style="background-color: rgb(0, 0, 108);">
                            Vacature Aanmaken
                        </button>
=======
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-primary w-100" style="background-color: rgb(0, 0, 108);">Vacature Aanmaken</button>
>>>>>>> 2fae9d9bddb89554c4ad34d4c5883d4c3b4556fd
                    </div>
                </form>
            </div>
        </div>
    </x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const addFilterBtn = document.getElementById("addFilterBtn");
            const filterInput = document.getElementById("newFilterName");
            const filtersContainer = document.getElementById("filtersContainer");
            const filterSearch = document.getElementById("filterSearch");
            const toggleFiltersBtn = document.getElementById("toggleFiltersBtn");
            let filterItems = Array.from(document.querySelectorAll(".filter-item"));
            let expanded = false;

            function updateToggleButtonVisibility() {
                toggleFiltersBtn.style.display = filterItems.length > 10 ? "block" : "none";
            }

            function resetFilterDisplay() {
                filterItems.forEach((item, index) => {
                    item.style.display = index < 10 ? "block" : "none";
                });
                updateToggleButtonVisibility();
            }
            resetFilterDisplay();

            toggleFiltersBtn.addEventListener("click", () => {
                expanded = !expanded;
                filterItems.forEach((item, index) => {
                    if (index >= 10) item.style.display = expanded ? "block" : "none";
                });
                toggleFiltersBtn.textContent = expanded ? "Verminder" : "Meer weergeven";
            });

            filterSearch.addEventListener("input", () => {
                const query = filterSearch.value.toLowerCase();
                let visibleCount = 0;

                filterItems.forEach((item) => {
                    const label = item.querySelector(".form-check-label").textContent.toLowerCase();
                    if (label.includes(query)) {
                        item.style.display = "block";
                        visibleCount++;
                    } else {
                        item.style.display = "none";
                    }
                });

                if (query === "") {
                    resetFilterDisplay();
                    expanded = false;
                    toggleFiltersBtn.textContent = "Meer weergeven";
                } else {
                    toggleFiltersBtn.textContent = visibleCount > 10 ? "Verminder" : "";
                }

                updateToggleButtonVisibility();
            });

            addFilterBtn.addEventListener("click", async () => {
                let filterName = filterInput.value.trim();

                if (!filterName) {
                    alert("Vul een filter naam in.");
                    return;
                }

                let existingFilters = filterItems.map(el => el.querySelector(".form-check-label").textContent.trim().toLowerCase());
                if (existingFilters.includes(filterName.toLowerCase())) {
                    alert("Deze filter bestaat al.");
                    return;
                }

                try {
                    let response = await fetch("{{ route('filters.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ name: filterName, field_id: "{{ $selectedFieldId }}" })
                    });

                    let data = await response.json();

                    if (data.id) {
                        let newFilter = document.createElement("div");
                        newFilter.classList.add("col-6", "filter-item", "fade-in");

                        newFilter.innerHTML = `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="filters[]" value="${data.id}" id="filter${data.id}" checked>
                                <label class="form-check-label" for="filter${data.id}">${data.name}</label>
                            </div>
                        `;

                        filtersContainer.appendChild(newFilter);
                        filterInput.value = "";

                        filterItems.push(newFilter);
                        resetFilterDisplay();

                        setTimeout(() => newFilter.classList.remove("fade-in"), 300);
                    }
                } catch (error) {
                    console.error("Error:", error);
                }
            });
        });
    </script>

    <style>
        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeIn 0.3s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</body>

</html>
 