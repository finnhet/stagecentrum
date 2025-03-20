<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Filter;
use App\Models\Field;

use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
{
    public function index($fieldId)
    {
        $filters = Filter::where('field_id', $fieldId)->get();
        $vacancies = Vacancy::where('field_id', $fieldId)->get();

        return view('vacancies', compact('vacancies', 'filters', 'fieldId'));
    }

    public function allVacancies()
    {
        $vacancies = Vacancy::all();

        return view('all_vacancies', compact('vacancies'));
    }

    public function userVacancies()
    {
        $companyId = Auth::user()->id;
        $vacancies = Vacancy::where('company_id', $companyId)->get();

        return view('dashboard', compact('vacancies'));
    }

    public function view(Request $request)
    {
        $companyId = $request->query('id');
        $user = User::where('id', $companyId)->first();
        $vacancies = Vacancy::where('company_id', $companyId)->get();

        return view('users.show', compact('user', 'vacancies'));
    }

    public function vacanciesByField($fieldId, Request $request)
    {
        $filters = Filter::where('field_id', $fieldId)->get();
        $vacancies = Vacancy::where('field_id', $fieldId);

        if ($request->has('filter')) {
            $vacancies->whereHas('filters', function ($query) use ($request) {
                $query->whereIn('filters.id', $request->filter);
            });
        }

        $vacancies = $vacancies->get();

        return view('vacancies', compact('vacancies', 'filters', 'fieldId'));
    }

    public function filterVacancies(Request $request, $fieldId)
    {
        $selectedFilters = $request->input('filters', []);
        $filters = Filter::where('field_id', $fieldId)->get();
    
        if (!empty($selectedFilters)) {
            $vacancies = Vacancy::where('field_id', $fieldId)
                ->whereHas('filters', function ($query) use ($selectedFilters) {
                    $query->whereIn('filters.id', $selectedFilters);
                }, '=', count($selectedFilters))
                ->get();
        } else {
            $vacancies = Vacancy::where('field_id', $fieldId)->get();
        }
    
        return view('vacancies', compact('vacancies', 'filters', 'fieldId'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('filter');

        if (!$searchTerm) {
            return redirect()->route('vacancies.all')->with('error', 'Please enter a filter name.');
        }

        $vacancies = Vacancy::whereHas('filters', function ($query) use ($searchTerm) {
            $query->where('name', 'LIKE', '%' . $searchTerm . '%');
        })->get();

        return view('all_vacancies', compact('vacancies', 'searchTerm'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $vacancy = Vacancy::findOrFail($id);
        $companyId = Auth::user()->id;

        $selectedFieldId = $request->field_id ? $request->field_id : $vacancy->field_id;
        $filters = Filter::where('field_id', $selectedFieldId)->get();

        $fields = Field::all();

        $vacancyFilters = DB::table('vacancy_filters')
            ->where('vacancy_id', $id)
            ->get();

        if ($vacancy->company_id !== $companyId) {
            return redirect()->route('dashboard');
        } else {
            return view('vacancy-edit', compact('vacancy', 'selectedFieldId', 'fields', 'filters', 'vacancyFilters'));
        }
    }

    public function create(Request $request)
    {
        $fields = Field::all();
        $selectedFieldId = $request->input('field_id');
        $filters = $selectedFieldId ? Filter::where('field_id', $selectedFieldId)->get() : [];

        return view('vacancy_create', compact('fields', 'filters', 'selectedFieldId'));
    }

    public function store(Request $request)
    {
        $companyId = Auth::user()->id;

        $request->validate([
            'title' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'field_id' => 'required|exists:fields,id',
        ]);

        $vacancy = Vacancy::create([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'location' => $request->location,
            'field_id' => $request->field_id,
            'company_id' => $companyId,
        ]);

        if ($request->has('filters')) {
            $vacancy->filters()->attach($request->filters);
        }

        return redirect()->route('dashboard')->with('success', 'Vacature succesvol aangemaakt.');
    }


    public function getVacancyById(Request $request)
    {
        $request->validate([
            "id" => "required|integer|exists:vacancies,id"
        ]);

        $vacancy = Vacancy::find($request->id);

        return view('/vacancy', compact('vacancy'));
    }

    public function show($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $user = User::where('id', $vacancy->company_id)->first();

        return view('vacancy', compact('vacancy', 'user'));
    }

    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        DB::table('vacancy_filters')->where('vacancy_id', $id)->delete();

        return redirect()->route('dashboard')->with('success', 'Vacature succesvol verwijderd.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'introduction' => 'required|string|max:150',
            'description' => 'required|string|max:250',
            'location' => 'required|string|max:50',
            'field_id' => 'nullable|exists:fields,id',
            'filters' => 'nullable|array',
        ]);

        $filterIds = $request->filters ?? [];  // Default to empty array if no filters are provided

        DB::table('vacancy_filters')->where('vacancy_id', $id)->delete();

        $newFilters = array_map(fn($filterId) => [
            'vacancy_id' => $id,
            'filter_id' => $filterId,
        ], $filterIds);

        DB::table('vacancy_filters')->insert($newFilters);

        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'location' => $request->location,
            'field_id' => $request->field_id ?? $vacancy->field_id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Vacancy updated successfully!');
    }    
}


