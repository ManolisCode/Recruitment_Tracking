<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function create($candidate_name, $candidate_surname)
    {
        $newCandidate = Candidate::create([
            'name' => $candidate_name,
            'surname' => $candidate_surname,
        ]);
        $newCandidateId = $newCandidate->id;
        return $newCandidateId;
    }
}
