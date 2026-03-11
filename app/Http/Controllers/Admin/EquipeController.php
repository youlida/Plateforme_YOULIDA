<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
        $equipes = Equipe::latest()->paginate(10);
        return view('back.equipes.index', compact('equipes'));
    }

    public function create()
    {
        return view('back.equipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Equipe::create($request->only(['name', 'role', 'photo', 'bio']));

        return redirect()->route('admin.equipes.index')->with('success', 'Membre de l’équipe créé avec succès.');
    }

    public function show(Equipe $equipe)
    {
        return view('back.equipes.show', compact('equipe'));
    }

    public function edit(Equipe $equipe)
    {
        return view('back.equipes.edit', compact('equipe'));
    }

    public function update(Request $request, Equipe $equipe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $equipe->update($request->only(['name', 'role', 'photo', 'bio']));

        return redirect()->route('admin.equipes.index')->with('success', 'Membre de l’équipe modifié avec succès.');
    }

    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        return redirect()->route('admin.equipes.index')->with('success', 'Membre de l’équipe supprimé avec succès.');
    }
}