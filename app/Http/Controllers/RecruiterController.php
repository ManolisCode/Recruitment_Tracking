<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Validator;

class RecruiterController extends Controller
{
    public function create(Request $request)
    {
        $messages = ['required' => 'The :attribute field is required.'];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validatedData = $validator->validated();
        $validatedName = $validatedData['name'];
        $validatedSurname = $validatedData['surname'];
        Recruiter::create([
            'name' => $validatedName,
            'surname' => $validatedSurname,
        ]);
        return response()->json(['message' => 'Recruiter created successfully'], 200);
    }
}
