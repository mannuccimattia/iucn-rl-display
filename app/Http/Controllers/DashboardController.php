<?php

namespace App\Http\Controllers;

use App\Services\IucnService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /** Display dashboard with systems and countries lists. */
    public function index(IucnService $service): View
    {
        // Call service getters.
        $systems = $service->getSystems();
        $countries = $service->getCountries();

        return view('dashboard', compact('systems', 'countries'));
    }
}
