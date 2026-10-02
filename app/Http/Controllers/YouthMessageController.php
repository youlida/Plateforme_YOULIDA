<?php

namespace App\Http\Controllers;

use App\Models\YouthMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\User;
use App\Notifications\NewYouthMessageNotification;
use Illuminate\Support\Facades\Notification;

class YouthMessageController extends Controller
{
    /**
     * Enregistrer un nouveau message du parcours jeune.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make($request->all(), [
            'message' => [
                'nullable',
                'string',
                'max:5000',
                'required_without:audio',
            ],

            'category' => [
                'nullable',
                'string',
                'in:ecole,famille,relations,bien-etre,sante-sexuelle,violence,substances,orientation,autre,non-precise',
            ],

            'audio' => [
                'nullable',
                'file',
                'max:10240', // 10 Mo
                'required_without:message',
            ],

            'wants_callback' => [
                'required',
                'boolean',
            ],

            'callback_channel' => [
                'nullable',
                'required_if:wants_callback,1',
                'string',
                'in:whatsapp,appel,sms,email,autre',
            ],

            'contact' => [
                'nullable',
                'required_if:wants_callback,1',
                'string',
                'max:255',
            ],

            'callback_time' => [
                'nullable',
                'required_if:wants_callback,1',
                'string',
                'in:matin,apres-midi,soir,indifferent',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Erreurs de validation
        |--------------------------------------------------------------------------
        */

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Veuillez vérifier les informations envoyées.',
                'errors' => $validator->errors(),
            ], 422);
        }

        /*
        |--------------------------------------------------------------------------
        | Enregistrement du fichier audio
        |--------------------------------------------------------------------------
        */

        $audioPath = null;

        if ($request->hasFile('audio')) {
            $audioPath = $request
                ->file('audio')
                ->store('youth-messages/audio', 'local');
        }

        /*
        |--------------------------------------------------------------------------
        | Génération d'une référence
        |--------------------------------------------------------------------------
        */

        do {
            $reference =
                'YOU-' .
                now()->format('Ymd') .
                '-' .
                strtoupper(Str::random(6));
        } while (
            YouthMessage::where('reference', $reference)->exists()
        );

        /*
        |--------------------------------------------------------------------------
        | Création du message
        |--------------------------------------------------------------------------
        */

        $youthMessage = YouthMessage::create([
            'reference' => $reference,

            'message' => $request->input('message'),
            'category' => $request->input('category'),
            'audio_path' => $audioPath,

            'wants_callback' => $request->boolean('wants_callback'),

            'callback_channel' => $request->boolean('wants_callback')
                ? $request->input('callback_channel')
                : null,

            'contact' => $request->boolean('wants_callback')
                ? $request->input('contact')
                : null,

            'callback_time' => $request->boolean('wants_callback')
                ? $request->input('callback_time')
                : null,

            'source_channel' => 'web',

            'status' => 'nouveau',
        ]);

        $admins = User::whereHas('role', function ($query) {
            $query->whereIn('slug', ['admin', 'superadmin']);
        })->get();

        Notification::send(
            $admins,
            new NewYouthMessageNotification($youthMessage)
        );

        /*
        |--------------------------------------------------------------------------
        | Réponse envoyée à React
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'success' => true,

            'message' =>
            'Votre message a bien été envoyé à YOULIDA.',

            'reference' => $youthMessage->reference,
        ], 201);
    }
}
