<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partenaire;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    public function index()
    {
        $partenaires = Partenaire::latest()->paginate(10);
        return view('back.partenaires.index', compact('partenaires'));
    }

    public function create()
    {
        return view('back.partenaires.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        Partenaire::create([
            'name' => $request->name,
            'logo' => $request->logo,
            'website' => $request->website,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire créé avec succès.');
    }

    public function show(Partenaire $partenaire)
    {
        return view('back.partenaires.show', compact('partenaire'));
    }

    public function edit(Partenaire $partenaire)
    {
        return view('back.partenaires.edit', compact('partenaire'));
    }

    public function update(Request $request, Partenaire $partenaire)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string|max:255',
            'website' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $partenaire->update([
            'name' => $request->name,
            'logo' => $request->logo,
            'website' => $request->website,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire modifié avec succès.');
    }

    public function destroy(Partenaire $partenaire)
    {
        $partenaire->delete();
        return redirect()->route('admin.partenaires.index')->with('success', 'Partenaire supprimé avec succès.');
    }
}