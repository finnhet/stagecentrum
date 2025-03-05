<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vacancy;

class VacancyController extends Controller
{
    public function store(Request $request)
    {
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
            'field_id' => 1,
            'company_id' => 1
        ]);
        return view('vacancy_create');
    }
}
