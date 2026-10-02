<?php

namespace App\Http\Controllers;

use App\Models\InterventionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Notifications\NewInterventionRequestNotification;
use Illuminate\Support\Facades\Notification;

class InterventionRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'structure_type' => [
                'required',
                'string',
                'in:ecole,communaute,association,groupe_jeunes,evenement,autre',
            ],

            'structure_name' => [
                'nullable',
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

            /*
            | Téléphone OU e-mail obligatoire.
            | Si l'un est absent, l'autre devient obligatoire.
            */
            'phone' => [
                'nullable',
                'string',
                'max:50',
                'required_without:email',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                'required_without:phone',
            ],

            'location' => [
                'required',
                'string',
                'max:255',
            ],

            'need' => [
                'required',
                'string',
                'max:10000',
            ],

            'target_audience' => [
                'required',
                'string',
                'max:255',
            ],

            'estimated_participants' => [
                'nullable',
                'integer',
                'min:1',
                'max:1000000',
            ],

            'desired_period' => [
                'nullable',
                'string',
                'max:255',
            ],

            'intervention_format' => [
                'required',
                'string',
                'in:ponctuelle,duree',
            ],

            'duration' => [
                'nullable',
                'string',
                'max:255',
                'required_if:intervention_format,duree',
            ],

            'additional_information' => [
                'nullable',
                'string',
                'max:10000',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Référence unique
        |--------------------------------------------------------------------------
        */

        do {
            $reference =
                'INT-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));
        } while (
            InterventionRequest::where(
                'reference',
                $reference
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Enregistrement
        |--------------------------------------------------------------------------
        */

        $interventionRequest =
            InterventionRequest::create([
                'reference' => $reference,

                'structure_type' =>
                $validated['structure_type'],

                'structure_name' =>
                $validated['structure_name'] ?? null,

                'contact_name' =>
                $validated['contact_name'],

                'contact_function' =>
                $validated['contact_function'] ?? null,

                'phone' =>
                $validated['phone'] ?? null,

                'email' =>
                $validated['email'] ?? null,

                'location' =>
                $validated['location'],

                'need' =>
                $validated['need'],

                'target_audience' =>
                $validated['target_audience'],

                'estimated_participants' =>
                $validated['estimated_participants'] ?? null,

                'desired_period' =>
                $validated['desired_period'] ?? null,

                'intervention_format' =>
                $validated['intervention_format'],

                'duration' =>
                $validated['duration'] ?? null,

                'additional_information' =>
                $validated['additional_information'] ?? null,

                'status' => 'nouveau',
            ]);

        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('slug', ['admin', 'superadmin']);
        })->get();

        Notification::send(
            $admins,
            new NewInterventionRequestNotification($interventionRequest)
        );

        /*
        |--------------------------------------------------------------------------
        | Réponse pour React
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
            'Votre demande d’intervention a bien été envoyée.',

            'reference' =>
            $interventionRequest->reference,
        ], 201);
    }
}
