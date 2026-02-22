<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class FavoriteController extends Controller
{
    /** Display current user's favorites page. */
    public function index(): View
    {
        // Store logged user.
        /** @var User $user */
        $user = Auth::user();

        // Get paginated favorites of logged user via relation.
        $favorites = $user->favorites()
            ->latest()
            ->paginate(18)
            ->withQueryString();

        return view('favorites', compact('favorites'));
    }

    /** Add/remove a taxon from user's favorites. */
    public function toggle(Request $request): RedirectResponse
    {
        // Store logged user.
        $user = Auth::user();

        // Check if requested taxon exists already.
        $favorite = Favorite::where('user_id', $user->id)
            ->where('sis_id', $request->sis_id)
            ->first();

        if ($favorite) { // If it exists, remove from favorites.
            $favorite->delete();
        } else { // If it doesn't exist, add to favorites.
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
