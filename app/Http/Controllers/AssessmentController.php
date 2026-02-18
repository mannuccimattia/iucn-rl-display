<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    public function index(string $type, string $id, IucnService $service): View
    {
        $title = __($id);

        $viewData = [
            'type' => $type,
            'id' => $id,
            'title' => ($type === 'system') ? "Sistema: $title" : "Nazione: $title",
            'items' => $service->getAssessments($type, $id),
        ];

        return view('assessments.index', $viewData);
    }

    public function show(string $type, string $id, int $taxon_id, IucnService $service): View
    {
        $items = $service->getAssessments($type, $id);

        $item = collect($items)->firstWhere('taxon_id', $taxon_id);

        if (!$item) abort(404);

        return view('assessments.show', compact('item', 'type', 'id'));
    }
}
