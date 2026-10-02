<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemoignageController extends Controller
{
    /**
     * Afficher la liste des témoignages.
     */
    public function index()
    {
        $temoignages = Temoignage::latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Statistiques globales
        |--------------------------------------------------------------------------
        */

        $totalTemoignages = Temoignage::count();

        $publishedTemoignages = Temoignage::where(
            'is_published',
            true
        )->count();

        $unpublishedTemoignages = Temoignage::where(
            'is_published',
            false
        )->count();


        return view(
            'back.temoignages.index',
            compact(
                'temoignages',
                'totalTemoignages',
                'publishedTemoignages',
                'unpublishedTemoignages'
            )
        );
    }


    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('back.temoignages.create');
    }


    /**
     * Enregistrer un nouveau témoignage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'message' => [
                'required',
                'string',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload de la photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            $data['photo'] = $request
                ->file('photo')
                ->store('temoignages', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Statut de publication
        |--------------------------------------------------------------------------
        */

        $data['is_published'] = $request->boolean(
            'is_published'
        );


        /*
        |--------------------------------------------------------------------------
        | Création
        |--------------------------------------------------------------------------
        */

        Temoignage::create($data);


        return redirect()
            ->route('admin.temoignages.index')
            ->with(
                'success',
                'Témoignage créé avec succès.'
            );
    }


    /**
     * Afficher un témoignage.
     */
    public function show(Temoignage $temoignage)
    {
        return view(
            'back.temoignages.show',
            compact('temoignage')
        );
    }


    /**
     * Formulaire de modification.
     */
    public function edit(Temoignage $temoignage)
    {
        return view(
            'back.temoignages.edit',
            compact('temoignage')
        );
    }


    /**
     * Mettre à jour un témoignage.
     */
    public function update(
        Request $request,
        Temoignage $temoignage
    ) {
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'message' => [
                'required',
                'string',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Remplacement de la photo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('photo')) {

            /*
            | Supprimer l'ancienne photo si elle existe.
            */

            if (
                $temoignage->photo &&
                Storage::disk('public')->exists(
                    $temoignage->photo
                )
            ) {

                Storage::disk('public')->delete(
                    $temoignage->photo
                );

            }


            /*
            | Enregistrer la nouvelle photo.
            */

            $data['photo'] = $request
                ->file('photo')
                ->store('temoignages', 'public');

        } else {

            /*
            | Aucune nouvelle photo :
            | on conserve l'ancienne.
            */

            unset($data['photo']);
        }


        /*
        |--------------------------------------------------------------------------
        | Statut de publication
        |--------------------------------------------------------------------------
        */

        $data['is_published'] = $request->boolean(
            'is_published'
        );


        /*
        |--------------------------------------------------------------------------
        | Mise à jour
        |--------------------------------------------------------------------------
        */

        $temoignage->update($data);


        return redirect()
            ->route(
                'admin.temoignages.show',
                $temoignage->id
            )
            ->with(
                'success',
                'Témoignage modifié avec succès.'
            );
    }


    /**
     * Supprimer un témoignage.
     */
    public function destroy(Temoignage $temoignage)
    {
        /*
        |--------------------------------------------------------------------------
        | Supprimer la photo associée
        |--------------------------------------------------------------------------
        */

        if (
            $temoignage->photo &&
            Storage::disk('public')->exists(
                $temoignage->photo
            )
        ) {

            Storage::disk('public')->delete(
                $temoignage->photo
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer le témoignage
        |--------------------------------------------------------------------------
        */

        $temoignage->delete();


        return redirect()
            ->route('admin.temoignages.index')
            ->with(
                'success',
                'Témoignage supprimé avec succès.'
            );
    }
}