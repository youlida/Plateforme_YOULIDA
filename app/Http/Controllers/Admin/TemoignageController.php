<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::latest()->paginate(10);
        return view('back.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('back.temoignages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|string|max:255',
            'message' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        Temoignage::create([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->photo,
            'message' => $request->message,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage créé avec succès.');
    }

    public function show(Temoignage $temoignage)
    {
        return view('back.temoignages.show', compact('temoignage'));
    }

    public function edit(Temoignage $temoignage)
    {
        return view('back.temoignages.edit', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|string|max:255',
            'message' => 'required|string',
            'is_published' => 'nullable|boolean',
        ]);

        $temoignage->update([
            'name' => $request->name,
            'email' => $request->email,
            'photo' => $request->photo,
            'message' => $request->message,
            'is_published' => $request->boolean('is_published'),
        ]);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage modifié avec succès.');
    }

    public function destroy(Temoignage $temoignage)
    {
        $temoignage->delete();
        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage supprimé avec succès.');
    }
}