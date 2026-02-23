<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    /** Display all assessments given {type} and {code}.*/
    public function index(Request $request, IucnService $service, string $type, string $code): View
    {
        $page = max(1, (int) $request->query('page', 1));
        $perPage = 18;

        $result = $service->getLatestAssessments($type, $code, $page, $perPage);

        // Split pagination metadata from response.
        $response = $result['data'];
        $pagination = $result['pagination'];

        // Store $type and $code for backward navigation with safe fallbacks.
        $metadata = [
            'description' => [
                'en' => data_get($response, 'description.en', strtoupper($code)),
            ],
            'code' => data_get($response, 'code', strtoupper($code)),
        ];

        $assessments = $response['assessments'] ?? [];

        return view('assessments.index', compact('metadata', 'assessments', 'pagination'));
    }

    /** Display details of taxon given  it's id {sis_id}. */
    public function show(IucnService $service, string $type, string $code, int $sis_id): View
    {
        // Store $type and $code for backward navigation.
        $metadata = [
            'type' => $type,
            'code' => $code,
        ];

        // Call service getter.
        $response = $service->getAssessmentsBySisId($sis_id);

        // Split response for easier iteration.
        $taxon = $response['taxon'];
        $assessments = $response['assessments'];

        // Order common names: main name first.
        $taxon['common_names'] = collect($taxon['common_names'])
            ->sortByDesc('main')
            ->values()
            ->all();

        // Map for legacy conservation codes.
        $legacyMap = [
            'LR/lc' => 'LC',
            'LR/nt' => 'NT',
            'LR/cd' => 'NT',
            'V' => 'VU',
            'I' => 'NE',
            'K' => 'DD',
        ];

        // Iterate mapping.
        foreach ($assessments as &$assessment) {
            $assessment['red_list_category_code'] = $legacyMap[$assessment['red_list_category_code']]
                ?? $assessment['red_list_category_code'];
        }

        return view('assessments.show', compact('metadata', 'taxon', 'assessments'));
    }

    /** Display history of an asessment given it's id {assessment_id}. */
    public function showAssessment(IucnService $service, int $assessment_id): View
    {
        $assessment = $service->getAssessment($assessment_id);

        return view('assessments.show-assessment', compact('assessment'));
    }
}
