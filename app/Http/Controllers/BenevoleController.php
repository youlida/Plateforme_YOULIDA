<?php

namespace App\Http\Controllers;

use App\Models\Benevole;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewBenevoleNotification;
use Illuminate\Support\Facades\Notification;

class BenevoleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'prenom' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'required_without:telephone',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:50',
                'required_without:email',
            ],

            'pays' => [
                'nullable',
                'string',
                'max:255',
            ],

            'ville' => [
                'nullable',
                'string',
                'max:255',
            ],

            'motivation' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $benevole = Benevole::create([
            ...$validated,
            'is_approved' => false,
        ]);


        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('slug', ['admin', 'superadmin']);
        })->get();

        Notification::send(
            $admins,
            new NewBenevoleNotification($benevole)
        );


        return response()->json([
            'success' => true,
            'message' => 'Votre candidature de bénévolat a bien été envoyée à YOULIDA.',
            'id' => $benevole->id,
        ], 201);
    }
}
