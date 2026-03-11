<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Historique;

class HistoriqueController extends Controller
{
    public function index()
    {
        $historiques = Historique::with('user')->latest()->paginate(15);
        return view('back.historiques.index', compact('historiques'));
    }

    public function show(Historique $historique)
    {
        return view('back.historiques.show', compact('historique'));
    }

    public function create()
    {
        abort(404);
    }

    public function store()
    {
        abort(404);
    }

    public function edit(Historique $historique)
    {
        abort(404);
    }

    public function update()
    {
        abort(404);
    }

    public function destroy(Historique $historique)
    {
        $historique->delete();
        return redirect()->route('admin.historiques.index')->with('success', 'Historique supprimé avec succès.');
    }
}