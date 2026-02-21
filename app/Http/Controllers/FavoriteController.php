<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $favorites = Favorite::where('user_id', $user->id)
            ->get();

        return view('favorites', compact('favorites'));
    }

    public function toggle(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $favorite = Favorite::where('user_id', $user->id)
            ->where('sis_id', $request->sis_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'sis_id' => $request->sis_id,
                'scientific_name' => $request->scientific_name,
                'type' => $request->type,
                'code' => $request->code
            ]);
        }

        return back();
    }
}
