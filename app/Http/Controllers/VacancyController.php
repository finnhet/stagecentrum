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
    public function store(Request $request)
    {
        $companyId = Auth::user()->id;
        // Validate the input
        $request->validate([
            'title' => 'required|string|max:255',
            'introduction' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        // Save to the database
        Vacancy::create([
            'title' => $request->title,
            'introduction' => $request->introduction,
            'description' => $request->description,
            'location' => $request->location,
            'company_id' => $companyId,
        ]);
        return redirect()->route('dashboard');
    }
}
