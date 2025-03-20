<input type="hidden" name="field_id" value="{{ request()->get('field_id', $selectedFieldId) }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bewerk Vacature') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <br>
        <h2 class="text-2xl font-bold mt-8 mb-6 text-blue-700">Pas vacature aan</h2>

        <form method="GET" action="{{ route('vacancy.edit', $vacancy->id) }}">
            <div class="mb-3">
                <label for="fieldSelect" class="form-label">Werkveld</label>
                <select class="form-control" id="fieldSelect" name="field_id" onchange="this.form.submit()">
                    @foreach ($fields as $field)
                        <option value="{{ $field->id }}" {{ (request('field_id') == NULL && $field->id == $selectedFieldId) || (request('field_id') == $field->id) ? 'selected' : '' }}>
                            {{ $field->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <form method="POST" action="{{ route('vacancy.update', ['id' => $vacancy->id]) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <input type="hidden" name="field_id" value="{{ request('field_id') }}">

            <h5 class="text-center mt-4">Selecteer Filters</h5>

            <input type="text" id="filterSearch" placeholder="Zoek filters...">

            <div id="filtersContainer" class="row g-2">
                @forelse ($filters as $filter)
                    <div class="col-6 filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="filters[]" value="{{ $filter->id }}" id="filter{{ $filter->id }}" {{ $vacancyFilters->contains('filter_id', $filter->id) ? 'checked' : '' }}>
                            <label class="form-check-label filter-label" for="filter{{ $filter->id }}">{{ $filter->name }}</label>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">Geen filters beschikbaar.</p>
                @endforelse
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="title" id="title" value="{{ old('title', $vacancy->title) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="introduction" class="block text-sm font-medium text-gray-700">Inleiding</label>
                <textarea name="introduction" id="introduction" rows="3" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('introduction', $vacancy->introduction) }}</textarea>
                @error('introduction')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Beschrijving</label>
                <textarea name="description" id="description" rows="5" 
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">{{ old('description', $vacancy->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Locatie</label>
                <input type="text" name="location" id="location" value="{{ old('location', $vacancy->location) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                @error('location')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-lg shadow-md transition duration-200">
                    Bewerk vacature
                </button>
            </div>
        </form>
    </div>
    <script>
    // Prevent Enter from submitting the form
    document.getElementById("filterSearch").addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });

    // Live search functionality
    document.getElementById("filterSearch").addEventListener("input", function () {
        let searchValue = this.value.toLowerCase();
        let filterItems = document.querySelectorAll(".filter-item");

        filterItems.forEach(function (item) {
            let label = item.querySelector(".filter-label").textContent.toLowerCase();
            item.style.display = label.includes(searchValue) ? "" : "none";
        });
    });
</script>

</x-app-layout>