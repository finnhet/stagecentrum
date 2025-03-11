<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('fields.index', compact('fields'));
    }
}