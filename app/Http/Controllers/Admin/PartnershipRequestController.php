<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PartnershipRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = PartnershipRequest::with('assignedUser')
            ->latest();

        // Filtre par statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('organization', 'like', "%{$search}%")
                    ->orWhere('contact_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $requests = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'back.partnership-requests.index',
            compact('requests')
        );
    }


    public function show(PartnershipRequest $partnershipRequest)
    {
        $partnershipRequest->load('assignedUser');

        $users = User::orderBy('name')->get();

        return view(
            'back.partnership-requests.show',
            compact(
                'partnershipRequest',
                'users'
            )
        );
    }


    public function update(
        Request $request,
        PartnershipRequest $partnershipRequest
    ) {
        $validated = $request->validate([
            'assigned_to' => [
                'nullable',
                'exists:users,id',
            ],

            'internal_summary' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'action_taken' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'follow_up' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'status' => [
                'required',
                'string',
                'in:nouveau,en_cours,en_attente,accepte,refuse,clos',
            ],
        ]);

        $partnershipRequest->update($validated);

        return redirect()
            ->route(
                'admin.partnership-requests.show',
                $partnershipRequest
            )
            ->with(
                'success',
                'La demande de partenariat a été mise à jour.'
            );
    }


    public function destroy(
        PartnershipRequest $partnershipRequest
    ) {
        $reference = $partnershipRequest->reference;

        $partnershipRequest->delete();

        return redirect()
            ->route('admin.partnership-requests.index')
            ->with(
                'success',
                "La demande {$reference} a été supprimée."
            );
    }


    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1',
            ],

            'ids.*' => [
                'integer',
                'exists:partnership_requests,id',
            ],
        ]);

        $count = PartnershipRequest::whereIn(
            'id',
            $validated['ids']
        )->delete();

        return redirect()
            ->route('admin.partnership-requests.index')
            ->with(
                'success',
                "{$count} demande(s) de partenariat supprimée(s)."
            );
    }
}
