<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(IucnService $service): View
    {
        $systems = $service->getSystems();
        $countries = $service->getCountries();

        // dd($systems, $countries);

        return view('dashboard', compact('systems', 'countries'));
    }
}
