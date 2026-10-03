<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\YouthMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class YouthMessageController extends Controller
{
    /**
     * Liste des messages envoyés par les jeunes.
     */
    public function index(Request $request)
    {
        $query = YouthMessage::with('assignedUser')
            ->latest();

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Recherche par référence ou contact
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('contact', 'like', "%{$search}%");
            });
        }

        $messages = $query->paginate(15)->withQueryString();

        return view('back.youth-messages.index', compact('messages'));
    }

    /**
     * Afficher une demande.
     */
    public function show(YouthMessage $youthMessage)
    {
        $youthMessage->load('assignedUser');

        $users = User::orderBy('name')->get();

        return view(
            'back.youth-messages.show',
            compact('youthMessage', 'users')
        );
    }

    /**
     * Mise à jour du traitement interne YOULIDA.
     */
    public function update(Request $request, YouthMessage $youthMessage)
    {
        $validated = $request->validate([
            'qualification' => [
                'nullable',
                'string',
                'in:A,B,C,D',
            ],

            'assigned_to' => [
                'nullable',
                'exists:users,id',
            ],

            'internal_summary' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'action_taken' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'follow_up' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'status' => [
                'required',
                'string',
                'in:nouveau,en_cours,en_attente,traite,clos',
            ],
        ]);

        $youthMessage->update($validated);

        return redirect()
            ->route('admin.youth-messages.show', $youthMessage)
            ->with('success', 'Le suivi de la demande a été mis à jour.');
    }

    /**
     * Supprimer une demande.
     */


    /**
     * Lire le message vocal de manière sécurisée.
     */
    public function audio(YouthMessage $youthMessage)
    {
        abort_unless($youthMessage->audio_path, 404);

        if (!Storage::disk('local')->exists($youthMessage->audio_path)) {
            abort(404);
        }

        $disk = Storage::disk('local');
        $stream = $disk->readStream($youthMessage->audio_path);

        abort_if($stream === false, 404);

        return response()->stream(
            function () use ($stream) {
                fpassthru($stream);
                fclose($stream);
            },
            200,
            [
                'Content-Type' => $disk->mimeType($youthMessage->audio_path)
                    ?: 'application/octet-stream',
                'Cache-Control' => 'private, no-store, max-age=0',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }


    public function destroy(YouthMessage $youthMessage)
    {
        // Supprimer le vocal associé s'il existe
        if ($youthMessage->audio_path) {
            Storage::disk('local')->delete($youthMessage->audio_path);
        }

        $reference = $youthMessage->reference;

        $youthMessage->delete();

        return redirect()
            ->route('admin.youth-messages.index')
            ->with(
                'success',
                "La demande {$reference} a été supprimée."
            );
    }


    /**
     * Supprimer plusieurs demandes sélectionnées.
     */
    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1',
            ],

            'ids.*' => [
                'integer',
                'exists:youth_messages,id',
            ],
        ]);
        // Récupérer les messages à supprimer

        $messages = YouthMessage::whereIn(
            'id',
            $validated['ids']
        )->get();

        $count = $messages->count();

        foreach ($messages as $message) {

            if ($message->audio_path) {
                Storage::disk('local')->delete(
                    $message->audio_path
                );
            }

            $message->delete();
        }

        return redirect()
            ->route('admin.youth-messages.index')
            ->with(
                'success',
                "{$count} demande(s) supprimée(s) avec succès."
            );
    }
}
