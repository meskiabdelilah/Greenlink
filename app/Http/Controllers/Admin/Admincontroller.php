<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{
    // Toggle ban
    public function toggleBan(User $user)
    {
        $user->is_banned = !$user->is_banned;
        $user->save();

        $message = $user->is_banned
            ? 'Utilisateur banni avec succès'
            : 'Utilisateur débanni avec succès';

        return back()->with('success', $message);
    }

    public function toggleVerify(User $user)
    {
        $user->is_verified = !$user->is_verified;
        $user->save();

        $message = $user->is_verified
            ? 'Utilisateur vérifié avec succès'
            : 'Vérification de l’utilisateur retirée';

        return back()->with('success', $message);
    }
}
