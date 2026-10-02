<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Afficher le profil.
     */
    public function show(Request $request)
    {
        return view('back.profile.show', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Afficher le formulaire de modification.
     */
    public function edit(Request $request)
    {
        return view('back.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Modifier les informations personnelles.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'prenom' => [
                'nullable',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'pays' => [
                'nullable',
                'string',
                'max:100',
            ],

            'ville' => [
                'nullable',
                'string',
                'max:100',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Photo de profil
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('photo')) {

            if (
                $user->photo &&
                Storage::disk('public')->exists($user->photo)
            ) {
                Storage::disk('public')->delete($user->photo);
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store('profiles', 'public');
        }

        $user->update($validated);

        return redirect()
            ->route('admin.profile.show')
            ->with(
                'success',
                'Votre profil a été mis à jour avec succès.'
            );
    }

    /**
     * Supprimer uniquement la photo.
     */
    public function removePhoto(Request $request)
    {
        $user = $request->user();

        if (
            $user->photo &&
            Storage::disk('public')->exists($user->photo)
        ) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->update([
            'photo' => null,
        ]);

        return back()->with(
            'success',
            'Votre photo de profil a été supprimée.'
        );
    }

    /**
     * Modifier le mot de passe.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8),
            ],
        ]);

        $request->user()->update([
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return back()->with(
            'success',
            'Votre mot de passe a été modifié avec succès.'
        );
    }
}
