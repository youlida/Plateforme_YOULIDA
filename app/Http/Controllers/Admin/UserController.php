<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs.
     */
    public function index()
    {
        $users = User::with('role')
            ->latest()
            ->paginate(10);

        // Statistiques globales
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $blockedUsers = User::where('is_active', false)->count();

        return view(
            'back.utilisateurs.index',
            compact(
                'users',
                'totalUsers',
                'activeUsers',
                'blockedUsers'
            )
        );
    }


    /**
     * Formulaire de création.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view(
            'back.utilisateurs.create',
            compact('roles')
        );
    }


    /**
     * Enregistrer un utilisateur.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
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
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:255',
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

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {
            $data['photo'] = $request
                ->file('photo')
                ->store('users', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Mot de passe
        |--------------------------------------------------------------------------
        */

        $data['password'] = Hash::make($data['password']);


        /*
        |--------------------------------------------------------------------------
        | Statut
        |--------------------------------------------------------------------------
        */

        $data['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | Création
        |--------------------------------------------------------------------------
        */

        User::create($data);


        return redirect()
            ->route('admin.utilisateurs.index')
            ->with(
                'success',
                'Utilisateur créé avec succès.'
            );
    }


    /**
     * Afficher un utilisateur.
     */
    public function show(User $utilisateur)
    {
        $utilisateur->load('role');

        $user = $utilisateur;

        return view(
            'back.utilisateurs.show',
            compact('user')
        );
    }


    /**
     * Formulaire de modification.
     */
    public function edit(User $utilisateur)
    {
        $user = $utilisateur;

        $roles = Role::orderBy('name')->get();

        return view(
            'back.utilisateurs.edit',
            compact('user', 'roles')
        );
    }


    /**
     * Modifier un utilisateur.
     */
    public function update(Request $request, User $utilisateur)
    {
        $data = $request->validate([
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
                'required',
                'email',
                'max:255',

                Rule::unique('users', 'email')
                    ->ignore($utilisateur->id),
            ],

            'telephone' => [
                'nullable',
                'string',
                'max:255',
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

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'role_id' => [
                'required',
                'exists:roles,id',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Nouvelle photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            // Supprimer l'ancienne photo
            if (
                $utilisateur->photo &&
                Storage::disk('public')->exists($utilisateur->photo)
            ) {
                Storage::disk('public')
                    ->delete($utilisateur->photo);
            }

            // Enregistrer la nouvelle
            $data['photo'] = $request
                ->file('photo')
                ->store('users', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Mot de passe
        |--------------------------------------------------------------------------
        */

        if ($request->filled('password')) {

            $data['password'] = Hash::make(
                $data['password']
            );

        } else {

            unset($data['password']);

        }


        /*
        |--------------------------------------------------------------------------
        | Statut
        |--------------------------------------------------------------------------
        */

        $data['is_active'] = $request->boolean('is_active');


        /*
        |--------------------------------------------------------------------------
        | Mise à jour
        |--------------------------------------------------------------------------
        */

        $utilisateur->update($data);


        return redirect()
            ->route('admin.utilisateurs.index')
            ->with(
                'success',
                'Utilisateur modifié avec succès.'
            );
    }


    /**
     * Supprimer un utilisateur.
     */
    public function destroy(User $utilisateur)
    {
        /*
        |--------------------------------------------------------------------------
        | Empêcher la suppression de son propre compte
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $utilisateur->id) {

            return redirect()
                ->route('admin.utilisateurs.index')
                ->with(
                    'error',
                    'Vous ne pouvez pas supprimer votre propre compte.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer la photo
        |--------------------------------------------------------------------------
        */

        if (
            $utilisateur->photo &&
            Storage::disk('public')->exists($utilisateur->photo)
        ) {
            Storage::disk('public')
                ->delete($utilisateur->photo);
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer l'utilisateur
        |--------------------------------------------------------------------------
        */

        $utilisateur->delete();


        return redirect()
            ->route('admin.utilisateurs.index')
            ->with(
                'success',
                'Utilisateur supprimé avec succès.'
            );
    }
}