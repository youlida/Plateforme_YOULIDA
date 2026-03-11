<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Don;
use Illuminate\Http\Request;

class DonController extends Controller
{
    public function index()
    {
        $dons = Don::latest()->paginate(10);
        return view('back.dons.index', compact('dons'));
    }

    public function create()
    {
        return view('back.dons.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'donated_at' => 'nullable|date',
        ]);

        Don::create($request->only([
            'donor_name',
            'email',
            'amount',
            'payment_method',
            'transaction_id',
            'message',
            'donated_at',
        ]));

        return redirect()->route('admin.dons.index')->with('success', 'Don enregistré avec succès.');
    }

    public function show(Don $don)
    {
        return view('back.dons.show', compact('don'));
    }

    public function edit(Don $don)
    {
        return view('back.dons.edit', compact('don'));
    }

    public function update(Request $request, Don $don)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:255',
            'transaction_id' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'donated_at' => 'nullable|date',
        ]);

        $don->update($request->only([
            'donor_name',
            'email',
            'amount',
            'payment_method',
            'transaction_id',
            'message',
            'donated_at',
        ]));

        return redirect()->route('admin.dons.index')->with('success', 'Don modifié avec succès.');
    }

    public function destroy(Don $don)
    {
        $don->delete();
        return redirect()->route('admin.dons.index')->with('success', 'Don supprimé avec succès.');
    }
}







