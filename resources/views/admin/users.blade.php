<x-app-layout>
    <head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    </head>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Gebruikersbeheer</h2>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex items-center space-x-2 bg-gray-100 p-2 rounded-lg shadow-sm w-1/3">
            <input type="text" id="searchUsers" placeholder="Zoek gebruiker..." 
                   class="w-full p-2 border-none bg-transparent outline-none">
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-8">
            <div class="p-4 overflow-x-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Gebruikers</h3>
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300">ID</th>
                            <th class="px-4 py-3 border border-gray-300">Naam</th>
                            <th class="px-4 py-3 border border-gray-300">E-mail</th>
                            <th class="px-4 py-3 border border-gray-300">Admin</th>
                            <th class="px-4 py-3 border border-gray-300">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="userTable">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 text-center border border-gray-300">{{ $user->id }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $user->name }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $user->email }}</td>
                                <td class="px-4 py-3 text-center border border-gray-300">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $user->admin ? 'bg-green-500 text-black' : 'bg-gray-400 text-black' }}">
                                        {{ $user->admin ? 'Admin' : 'Gebruiker' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 border border-gray-300">
                                    <div class="flex justify-center space-x-2">
                                        <form action="{{ route('admin.toggleAdmin', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="px-3 py-1 text-sm font-medium rounded transition flex items-center space-x-1
                                                {{ $user->admin ? 'bg-red-500 hover:bg-red-600 text-black' : 'bg-green-500 hover:bg-green-600 text-black' }}">
                                                <i class="fas {{ $user->admin ? 'fa-user-times' : 'fa-user-plus' }}"></i>
                                                <span>{{ $user->admin ? 'Admin verwijderen' : 'Admin maken' }}</span>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-1 text-sm font-medium rounded bg-red-500 hover:bg-red-600 text-black flex items-center space-x-1">
                                                <i class="fas fa-trash-alt"></i> <span>Verwijderen</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-4 flex items-center space-x-2 bg-gray-100 p-2 rounded-lg shadow-sm w-1/3">
            <input type="text" id="searchVacancies" placeholder="Zoek vacature..." 
                   class="w-full p-2 border-none bg-transparent outline-none">
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 overflow-x-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Vacatures</h3>
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300">Titel</th>
                            <th class="px-4 py-3 border border-gray-300">Locatie</th>
                            <th class="px-4 py-3 border border-gray-300">Introductie</th>
                            <th class="px-4 py-3 border border-gray-300">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="vacancyTable">
                        @foreach ($vacancies as $vacancy)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 border border-gray-300">{{ $vacancy->title }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $vacancy->location }}</td>
                                <td class="px-4 py-3 border border-gray-300">{{ $vacancy->introduction }}</td>
                                <td class="px-4 py-3 border border-gray-300">
                                    <form action="{{ route('admin.deleteVacancy', $vacancy->id) }}" method="POST" 
                                          onsubmit="return confirm('Weet u zeker dat u deze vacature wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-sm font-medium rounded bg-red-500 hover:bg-red-600 text-black flex items-center space-x-1">
                                            <i class="fas fa-trash-alt"></i> <span>Verwijderen</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-4 flex items-center space-x-2 bg-gray-100 p-2 rounded-lg shadow-sm w-1/3">
            <input type="text" id="searchFilters" placeholder="Zoek filter..." 
                   class="w-full p-2 border-none bg-transparent outline-none">
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="p-4 overflow-x-auto">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Filters</h3>
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="px-4 py-3 border border-gray-300">Naam</th>
                            <th class="px-4 py-3 border border-gray-300">Acties</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700" id="filterTable">
                        @foreach ($filters as $filter)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-3 border border-gray-300">{{ $filter->name }}</td>
                                <td class="px-4 py-3 border border-gray-300">
                                    <form action="{{ route('filters.destroy', $filter->id) }}" method="POST" 
                                          onsubmit="return confirm('Weet u zeker dat u deze filter wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-sm font-medium rounded bg-red-500 hover:bg-red-600 text-black flex items-center space-x-1">
                                            <i class="fas fa-trash-alt"></i> <span>Verwijderen</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('searchUsers').addEventListener('keyup', function () {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#userTable tr');
            rows.forEach(row => {
                let name = row.children[1].textContent.toLowerCase();
                let email = row.children[2].textContent.toLowerCase();
                row.style.display = (name.includes(value) || email.includes(value)) ? '' : 'none';
            });
        });

        document.getElementById('searchVacancies').addEventListener('keyup', function () {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#vacancyTable tr');
            rows.forEach(row => {
                let title = row.children[0].textContent.toLowerCase();
                let location = row.children[1].textContent.toLowerCase();
                row.style.display = (title.includes(value) || location.includes(value)) ? '' : 'none';
            });
        });

        document.getElementById('searchFilters').addEventListener('keyup', function () {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#filterTable tr');
            rows.forEach(row => {
                let name = row.children[0].textContent.toLowerCase();
                row.style.display = name.includes(value) ? '' : 'none';
            });
        });
    </script>
</x-app-layout>
