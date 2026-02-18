<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index(string $type, string $id)
    {
        $systems = [
            'terrestrial' => 'Terrestre',
            'marine' => 'Marino',
            'freshwater' => 'Acque Dolci'
        ];

        $title = ($type === 'system')
            ? $systems[$id]
            : $id;

        $viewData = [
            'type' => $type,
            'id' => $id,
            'title' => ($type === 'system') ? "Sistema: $title" : "Nazione: $title",
            'items' => [
                ['taxon_id' => 123, 'scientific_name' => 'Lorem voluptus', 'category' => 'VU'],
                ['taxon_id' => 456, 'scientific_name' => 'Dolor eliquiscit', 'category' => 'EN'],
            ]
        ];

        return view('assessments.index', $viewData);
    }
}
