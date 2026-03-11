<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rapport;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $rapports = Rapport::latest()->paginate(10);
        return view('back.rapports.index', compact('rapports'));
    }

    public function create()
    {
        return view('back.rapports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|string|max:255',
            'report_date' => 'nullable|date',
        ]);

        Rapport::create($request->only(['title', 'description', 'file', 'report_date']));

        return redirect()->route('admin.rapports.index')->with('success', 'Rapport créé avec succès.');
    }

    public function show(Rapport $rapport)
    {
        return view('back.rapports.show', compact('rapport'));
    }

    public function edit(Rapport $rapport)
    {
        return view('back.rapports.edit', compact('rapport'));
    }

    public function update(Request $request, Rapport $rapport)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|string|max:255',
            'report_date' => 'nullable|date',
        ]);

        $rapport->update($request->only(['title', 'description', 'file', 'report_date']));

        return redirect()->route('admin.rapports.index')->with('success', 'Rapport modifié avec succès.');
    }

    public function destroy(Rapport $rapport)
    {
        $rapport->delete();
        return redirect()->route('admin.rapports.index')->with('success', 'Rapport supprimé avec succès.');
    }
}