<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssessmentController extends Controller
{
    public function index(string $type, string $id, IucnService $service): View
    {
        $systems = $service->getSystems();

        $title = ($type === 'system')
            ? $systems[$id]
            : $id;

        $viewData = [
            'type' => $type,
            'id' => $id,
            'title' => ($type === 'system') ? "Sistema: $title" : "Nazione: $title",
            'items' => $service->getAssessments($type, $id),
        ];

        return view('assessments.index', $viewData);
    }
}
