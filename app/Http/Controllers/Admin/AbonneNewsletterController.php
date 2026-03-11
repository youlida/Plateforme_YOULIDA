<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonneNewsletter;
use Illuminate\Http\Request;

class AbonneNewsletterController extends Controller
{
    public function index()
    {
        $abonnements = AbonneNewsletter::latest()->paginate(10);
        return view('back.newsletters.index', compact('abonnements'));
    }

    public function create()
    {
        return view('back.newsletters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:abonne_newsletters,email',
            'is_active' => 'nullable|boolean',
        ]);

        AbonneNewsletter::create([
            'email' => $request->email,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Abonné ajouté avec succès.');
    }

    public function show(AbonneNewsletter $abonneNewsletter)
    {
        return view('back.newsletters.show', compact('abonneNewsletter'));
    }

    public function edit(AbonneNewsletter $abonneNewsletter)
    {
        return view('back.newsletters.edit', compact('abonneNewsletter'));
    }

    public function update(Request $request, AbonneNewsletter $abonneNewsletter)
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:abonne_newsletters,email,' . $abonneNewsletter->id,
            'is_active' => 'nullable|boolean',
        ]);

        $abonneNewsletter->update([
            'email' => $request->email,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'Abonné modifié avec succès.');
    }

    public function destroy(AbonneNewsletter $abonneNewsletter)
    {
        $abonneNewsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Abonné supprimé avec succès.');
    }
}