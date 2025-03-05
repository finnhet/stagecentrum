<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $userId = $request->query('id');

        if (!$userId || !is_numeric($userId)) {
            return redirect()->back()->with('error', 'Invalid user ID.');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        return view('users.show', ['user' => $user]);
    }
}
