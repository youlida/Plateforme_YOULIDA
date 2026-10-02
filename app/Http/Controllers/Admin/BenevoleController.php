<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Benevole;
use Illuminate\Http\Request;

class BenevoleController extends Controller
{
    public function index(Request $request)
    {
        $query = Benevole::query()->latest();

        // Recherche
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telephone', 'like', "%{$search}%")
                    ->orWhere('pays', 'like', "%{$search}%")
                    ->orWhere('ville', 'like', "%{$search}%");
            });
        }

        // Filtre d'approbation
        if ($request->filled('status')) {
            if ($request->status === 'approved') {
                $query->where('is_approved', true);
            }

            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            }
        }

        $benevoles = $query
            ->paginate(15)
            ->withQueryString();

        // Statistiques globales
        $totalBenevoles = Benevole::count();

        $approvedBenevoles = Benevole::where(
            'is_approved',
            true
        )->count();

        $pendingBenevoles = Benevole::where(
            'is_approved',
            false
        )->count();

        return view(
            'back.benevoles.index',
            compact(
                'benevoles',
                'totalBenevoles',
                'approvedBenevoles',
                'pendingBenevoles'
            )
        );
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
