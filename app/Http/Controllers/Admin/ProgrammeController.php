<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::latest()->paginate(10);
        return view('back.programmes.index', compact('programmes'));
    }

    public function create()
    {
        return view('back.programmes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        Programme::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.programmes.index')->with('success', 'Programme créé avec succès.');
    }

    public function show(Programme $programme)
    {
        return view('back.programmes.show', compact('programme'));
    }

    public function edit(Programme $programme)
    {
        return view('back.programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programme $programme)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'nullable|boolean',
        ]);

        $programme->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'location' => $request->location,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.programmes.index')->with('success', 'Programme modifié avec succès.');
    }

    public function destroy(Programme $programme)
    {
        $programme->delete();
        return redirect()->route('admin.programmes.index')->with('success', 'Programme supprimé avec succès.');
    }
}