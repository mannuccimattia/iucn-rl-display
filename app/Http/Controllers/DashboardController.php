<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(IucnService $service): View
    {
        $data = [
            'systems' => $service->getSystems(),
            'countries' => $service->getCountries(),
        ];

        return view('dashboard', $data);
    }
}
