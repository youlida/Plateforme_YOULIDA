<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(10);
        return view('back.media.index', compact('media'));
    }

    public function create()
    {
        return view('back.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'file_path' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        Media::create($request->only(['title', 'file_path', 'type']));

        return redirect()->route('admin.media.index')->with('success', 'Média créé avec succès.');
    }

    public function show(Media $medium)
    {
        return view('back.media.show', ['media' => $medium]);
    }

    public function edit(Media $medium)
    {
        return view('back.media.edit', ['media' => $medium]);
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'file_path' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
        ]);

        $medium->update($request->only(['title', 'file_path', 'type']));

        return redirect()->route('admin.media.index')->with('success', 'Média modifié avec succès.');
    }

    public function destroy(Media $medium)
    {
        $medium->delete();
        return redirect()->route('admin.media.index')->with('success', 'Média supprimé avec succès.');
    }
}