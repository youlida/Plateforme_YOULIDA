<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10);
        return view('back.utilisateurs.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('back.utilisateurs.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'telephone' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'password' => 'required|string|min:6',
            'role_id' => 'nullable|exists:roles,id',
            'is_active' => 'nullable|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function show(User $utilisateur)
    {
        $user = $utilisateur;
        return view('back.utilisateurs.show', compact('user'));
    }

    public function edit(User $utilisateur)
    {
        $user = $utilisateur;
        $roles = Role::all();
        return view('back.utilisateurs.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $utilisateur)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $utilisateur->id,
            'telephone' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'role_id' => 'nullable|exists:roles,id',
            'is_active' => 'nullable|boolean',
        ]);

        $utilisateur->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'role_id' => $request->role_id,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur modifié avec succès.');
    }

    public function destroy(User $utilisateur)
    {
        $utilisateur->delete();

        return redirect()->route('admin.utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}