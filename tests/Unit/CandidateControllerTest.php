<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Controllers\CandidateController;

class CandidateControllerTest extends TestCase
{

    public function testCreateCandidate()
    {
        $candidateName = 'John';
        $candidateSurname = 'Doe';

        $controller = new CandidateController();

        $newCandidateId = $controller->create($candidateName, $candidateSurname);

        $this->assertNotNull($newCandidateId);
        $this->assertIsInt($newCandidateId);

        $this->assertDatabaseHas('candidates', [
            'id' => $newCandidateId,
            'name' => $candidateName,
            'surname' => $candidateSurname,
        ]);
    }
}
