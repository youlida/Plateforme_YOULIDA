<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    /**
     * Liste des programmes.
     */
    public function index()
    {
        $programmes = Programme::latest()
            ->paginate(10);

        /*
        |--------------------------------------------------------------------------
        | Statistiques globales
        |--------------------------------------------------------------------------
        */

        $totalProgrammes = Programme::count();

        $activeProgrammes = Programme::where(
            'is_active',
            true
        )->count();

        $inactiveProgrammes = Programme::where(
            'is_active',
            false
        )->count();


        return view(
            'back.programmes.index',
            compact(
                'programmes',
                'totalProgrammes',
                'activeProgrammes',
                'inactiveProgrammes'
            )
        );
    }


    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('back.programmes.create');
    }


    /**
     * Enregistrer un programme.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'required',
                'string',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Upload de l'image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $data['image'] = $request
                ->file('image')
                ->store('programmes', 'public');

        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $data['slug'] = $this->generateUniqueSlug(
            $data['title']
        );


        /*
        |--------------------------------------------------------------------------
        | Statut
        |--------------------------------------------------------------------------
        */

        $data['is_active'] = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | Création
        |--------------------------------------------------------------------------
        */

        Programme::create($data);


        return redirect()
            ->route('admin.programmes.index')
            ->with(
                'success',
                'Programme créé avec succès.'
            );
    }


    /**
     * Afficher un programme.
     */
    public function show(Programme $programme)
    {
        return view(
            'back.programmes.show',
            compact('programme')
        );
    }


    /**
     * Formulaire de modification.
     */
    public function edit(Programme $programme)
    {
        return view(
            'back.programmes.edit',
            compact('programme')
        );
    }


    /**
     * Modifier un programme.
     */
    public function update(
        Request $request,
        Programme $programme
    ) {
        $data = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],

            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'description' => [
                'required',
                'string',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Remplacement de l'image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            /*
            | Supprimer l'ancienne image
            */

            if (
                $programme->image &&
                Storage::disk('public')->exists(
                    $programme->image
                )
            ) {
                Storage::disk('public')->delete(
                    $programme->image
                );
            }


            /*
            | Enregistrer la nouvelle image
            */

            $data['image'] = $request
                ->file('image')
                ->store('programmes', 'public');

        } else {

            /*
            | Très important :
            | si aucune nouvelle image n'est envoyée,
            | on conserve l'image actuelle.
            */

            unset($data['image']);
        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if ($programme->title !== $data['title']) {

            $data['slug'] = $this->generateUniqueSlug(
                $data['title'],
                $programme->id
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Statut
        |--------------------------------------------------------------------------
        */

        $data['is_active'] = $request->boolean(
            'is_active'
        );


        /*
        |--------------------------------------------------------------------------
        | Mise à jour
        |--------------------------------------------------------------------------
        */

        $programme->update($data);


        return redirect()
            ->route(
                'admin.programmes.show',
                $programme->id
            )
            ->with(
                'success',
                'Programme modifié avec succès.'
            );
    }


    /**
     * Supprimer un programme.
     */
    public function destroy(Programme $programme)
    {
        /*
        |--------------------------------------------------------------------------
        | Supprimer l'image associée
        |--------------------------------------------------------------------------
        */

        if (
            $programme->image &&
            Storage::disk('public')->exists(
                $programme->image
            )
        ) {
            Storage::disk('public')->delete(
                $programme->image
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Supprimer le programme
        |--------------------------------------------------------------------------
        */

        $programme->delete();


        return redirect()
            ->route('admin.programmes.index')
            ->with(
                'success',
                'Programme supprimé avec succès.'
            );
    }


    /**
     * Générer un slug unique.
     */
    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {

        $baseSlug = Str::slug($title);

        /*
        | Si le titre ne produit aucun slug exploitable.
        */
        if ($baseSlug === '') {
            $baseSlug = 'programme';
        }

        $slug = $baseSlug;
        $counter = 2;


        while (true) {

            $query = Programme::where(
                'slug',
                $slug
            );


            if ($ignoreId !== null) {

                $query->where(
                    'id',
                    '!=',
                    $ignoreId
                );

            }


            if (!$query->exists()) {
                break;
            }


            $slug = $baseSlug . '-' . $counter;

            $counter++;
        }


        return $slug;
    }
}