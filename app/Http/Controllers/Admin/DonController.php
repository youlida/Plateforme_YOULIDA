<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Don;
use Illuminate\Http\Request;

class DonController extends Controller
{
    public function index(Request $request)
    {
        $query = Don::query()->latest();

        // Recherche
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('transaction_id', 'like', "%{$search}%")
                    ->orWhere('payment_method', 'like', "%{$search}%");
            });
        }

        // Filtre par méthode de paiement
        if ($request->filled('payment_method')) {
            $query->where(
                'payment_method',
                $request->payment_method
            );
        }

        // Filtre par date de début
        if ($request->filled('date_from')) {
            $query->whereDate(
                'donated_at',
                '>=',
                $request->date_from
            );
        }

        // Filtre par date de fin
        if ($request->filled('date_to')) {
            $query->whereDate(
                'donated_at',
                '<=',
                $request->date_to
            );
        }

        $dons = $query
            ->paginate(15)
            ->withQueryString();


        // Statistiques globales
        $totalDons = Don::count();

        $totalAmount = Don::sum('amount');

        $averageAmount = Don::avg('amount') ?? 0;

        // Méthodes existantes pour le filtre
        $paymentMethods = Don::query()
            ->whereNotNull('payment_method')
            ->where('payment_method', '!=', '')
            ->distinct()
            ->orderBy('payment_method')
            ->pluck('payment_method');


        return view(
            'back.dons.index',
            compact(
                'dons',
                'totalDons',
                'totalAmount',
                'averageAmount',
                'paymentMethods'
            )
        );
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
