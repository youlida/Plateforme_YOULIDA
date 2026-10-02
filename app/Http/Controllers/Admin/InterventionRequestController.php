<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterventionRequest;
use App\Models\User;
use Illuminate\Http\Request;

class InterventionRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = InterventionRequest::with('assignedUser')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('structure_type')) {
            $query->where(
                'structure_type',
                $request->structure_type
            );
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where(
                    'reference',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'structure_name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'contact_name',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'phone',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'email',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'location',
                    'like',
                    "%{$search}%"
                );
            });
        }

        $requests = $query
            ->paginate(15)
            ->withQueryString();

        return view(
            'back.intervention-requests.index',
            compact('requests')
        );
    }


    public function show(
        InterventionRequest $interventionRequest
    ) {
        $interventionRequest->load('assignedUser');

        $users = User::orderBy('name')->get();

        return view(
            'back.intervention-requests.show',
            compact(
                'interventionRequest',
                'users'
            )
        );
    }


    public function update(
        Request $request,
        InterventionRequest $interventionRequest
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
                'in:nouveau,en_cours,en_attente,planifie,realise,annule,clos',
            ],
        ]);

        $interventionRequest->update($validated);

        return redirect()
            ->route(
                'admin.intervention-requests.show',
                $interventionRequest
            )
            ->with(
                'success',
                'La demande d’intervention a été mise à jour.'
            );
    }


    public function destroy(
        InterventionRequest $interventionRequest
    ) {
        $reference = $interventionRequest->reference;

        $interventionRequest->delete();

        return redirect()
            ->route('admin.intervention-requests.index')
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
                'exists:intervention_requests,id',
            ],
        ]);

        $count = InterventionRequest::whereIn(
            'id',
            $validated['ids']
        )->delete();

        return redirect()
            ->route('admin.intervention-requests.index')
            ->with(
                'success',
                "{$count} demande(s) d’intervention supprimée(s)."
            );
    }
}
