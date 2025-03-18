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

    public function destroy($id)
    {
        $filter = Filter::findOrFail($id);
        $filter->delete();

        return response()->json(['message' => 'Filter deleted successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $filters = Filter::where('name', 'like', "%{$query}%")->get();

        return response()->json($filters);
    }
}
