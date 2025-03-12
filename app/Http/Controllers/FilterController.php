<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;

class FilterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'field_id' => 'required|exists:fields,id',
        ]);

        $filter = Filter::create([
            'name' => $request->name,
            'field_id' => $request->field_id,
        ]);

        return response()->json($filter);
    }
}

