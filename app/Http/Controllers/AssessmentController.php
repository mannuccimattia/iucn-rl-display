<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    public function index(string $type, string $code, IucnService $service): View
    {
        $response = $service->getLatestAssessments($type, $code);

        $metadata = array_first($response);
        $assessments = $response['assessments'];

        return view('assessments.index', compact('metadata', 'assessments'));
    }

    public function show(string $type, string $code, int $sis_id, IucnService $service): View
    {
        $metadata = [
            'type' => $type,
            'code' => $code,
        ];

        $response = $service->getAssessmentsBySisId($sis_id);

        $taxon = $response['taxon'];
        $assessments = $response['assessments'];

        $taxon['common_names'] = collect($taxon['common_names'])
            ->sortByDesc('main')
            ->values()
            ->all();

        $legacyMap = [
            'LR/lc' => 'LC',
            'LR/nt' => 'NT',
            'LR/cd' => 'NT',
        ];

        foreach ($assessments as &$assessment) {
            $assessment['red_list_category_code'] = $legacyMap[$assessment['red_list_category_code']]
                ?? $assessment['red_list_category_code'];
        }

        return view('assessments.show', compact('metadata', 'taxon', 'assessments'));
    }
}
