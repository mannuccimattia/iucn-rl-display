<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
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
            ]);
        }

        return back();
    }
}
