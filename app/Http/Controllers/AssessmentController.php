<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    public function index(string $type, string $code, IucnService $service): View
    {
        $metadata = array_first($service->getLatestAssessments($type, $code));
        $assessments = $service->getLatestAssessments($type, $code)['assessments'];

        return view('assessments.index', compact('metadata', 'assessments'));
    }

    public function show(string $type, string $id, int $taxon_id, IucnService $service): View
    {
        $taxon = $service->getTaxonDetail($taxon_id);

        // Passiamo l'oggetto alla vista
        return view('assessments.show', compact('taxon', 'type', 'id'));
    }
}
