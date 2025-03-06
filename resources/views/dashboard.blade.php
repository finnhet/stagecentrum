<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <br>
        <h2 class="text-2xl font-bold mt-8 mb-6 text-blue-700">U vacatures</h2>

        @if(isset($vacancies) && $vacancies->isNotEmpty())
            <div class="space-y-6">
                @foreach($vacancies as $vacancy)
                    <div class="bg-blue-100 p-6 rounded-lg shadow">
                        <h3 class="text-xl font-semibold text-blue-800">{{ $vacancy->title }}</h3>
                        <p class="text-gray-700">{{ $vacancy->introduction }}</p>
                        <p class="text-gray-500 text-sm">Location: {{ $vacancy->location }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-700">Uw heeft nog geen vacatures.</p>
        @endif
    </div>
</x-app-layout>
