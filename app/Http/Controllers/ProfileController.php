<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        $name = $user->name;
        $profilePicture = $user->avatar;

        return response()->json([
            'name' => $name,
            'avatar' => $profilePicture,
        ]);
        
    }

}
