<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Vacancy;

class VacancyController extends Controller
{
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

    public function vacanciesByField($fieldId)
    {
        $vacancies = Vacancy::where('field_id', $fieldId)->get();
        return view('vacancies', compact('vacancies'));
    }

    public function edit($id)
    {
        // findorfail is om te checken of the primary key bestaat
        $vacancy = Vacancy::findOrFail($id);
        // if statement checked of de vacature wel gekoppeld is aan de gebruiker
        $companyId = Auth::user()->id;
        if ($vacancy->company_id !== $companyId) {
            return redirect()->route('dashboard');
        } else {
            return view('vacancy-edit', compact('vacancy'));
        }
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
    
        Vacancy::create([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'location' => $request->location,
            'field_id' => $request->field_id,
            'company_id' => $companyId,
        ]);
    
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
        $vacancy = Vacancy::findOrFail($id); // Fetch vacancy by ID or show 404
        $user = User::where('id', $vacancy->company_id)->first();
        return view('vacancy', compact('vacancy', 'user'));
    }


    public function destroy($id)
{
    $vacancy = Vacancy::findOrFail($id);
    $vacancy->delete();

    return redirect()->route('dashboard')->with('success', 'Vacature succesvol verwijderd.');
}

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'introduction' => 'required|string|max:150',
            'description' => 'required|string|max:250',
            'location' => 'required|string|max:50',
        ]);

        $vacancy = Vacancy::findOrFail($id);

        $vacancy->update([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return redirect()->route('dashboard')->with('success', 'Vacancy updated successfully!');
    }
}

