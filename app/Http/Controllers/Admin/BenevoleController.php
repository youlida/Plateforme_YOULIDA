<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benevole;
use Illuminate\Http\Request;

class BenevoleController extends Controller
{
    public function index()
    {
        $benevoles = Benevole::latest()->paginate(10);
        return view('back.benevoles.index', compact('benevoles'));
    }

    public function create()
    {
        return view('back.benevoles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'motivation' => 'nullable|string',
            'is_approved' => 'nullable|boolean',
        ]);

        Benevole::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'motivation' => $request->motivation,
            'is_approved' => $request->boolean('is_approved'),
        ]);

        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole créé avec succès.');
    }

    public function show(Benevole $benevole)
    {
        return view('back.benevoles.show', compact('benevole'));
    }

    public function edit(Benevole $benevole)
    {
        return view('back.benevoles.edit', compact('benevole'));
    }

    public function update(Request $request, Benevole $benevole)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'motivation' => 'nullable|string',
            'is_approved' => 'nullable|boolean',
        ]);

        $benevole->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'pays' => $request->pays,
            'ville' => $request->ville,
            'motivation' => $request->motivation,
            'is_approved' => $request->boolean('is_approved'),
        ]);

        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole modifié avec succès.');
    }

    public function destroy(Benevole $benevole)
    {
        $benevole->delete();
        return redirect()->route('admin.benevoles.index')->with('success', 'Bénévole supprimé avec succès.');
    }
}