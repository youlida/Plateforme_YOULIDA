<?php

namespace App\Http\Controllers;

use App\Models\PartnershipRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\NewPartnershipRequestNotification;
use Illuminate\Support\Facades\Notification;

class PartnershipRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'organization' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_name' => [
                'required',
                'string',
                'max:255',
            ],

            'contact_function' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:50',
            ],

            'proposal' => [
                'required',
                'string',
                'max:10000',
            ],

            'wants_callback' => [
                'required',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Génération d'une référence unique
        |--------------------------------------------------------------------------
        */

        do {
            $reference =
                'PAR-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));
        } while (
            PartnershipRequest::where(
                'reference',
                $reference
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Enregistrement
        |--------------------------------------------------------------------------
        */

        $partnershipRequest =
            PartnershipRequest::create([
                'reference' => $reference,

                'organization' =>
                $validated['organization'],

                'contact_name' =>
                $validated['contact_name'],

                'contact_function' =>
                $validated['contact_function'] ?? null,

                'email' =>
                $validated['email'],

                'phone' =>
                $validated['phone'] ?? null,

                'proposal' =>
                $validated['proposal'],

                'wants_callback' =>
                $validated['wants_callback'],

                'status' => 'nouveau',
            ]);
        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('slug', ['admin', 'superadmin']);
        })->get();

        Notification::send(
            $admins,
            new NewPartnershipRequestNotification($partnershipRequest)
        );

        /*
        |--------------------------------------------------------------------------
        | Réponse React
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
            'Votre proposition de partenariat a bien été envoyée.',

            'reference' =>
            $partnershipRequest->reference,
        ], 201);
    }
}
