<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['user', 'categorie'])->latest()->paginate(10);
        return view('back.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Categorie::where('is_active', true)->get();
        return view('back.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        Article::create([
            'user_id' => Auth::id(),
            'categorie_id' => $request->categorie_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'content' => $request->content,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
    }

    public function show(Article $article)
    {
        return view('back.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Categorie::where('is_active', true)->get();
        return view('back.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'categorie_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'content' => 'required|string',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $article->update([
            'categorie_id' => $request->categorie_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'image' => $request->image,
            'content' => $request->content,
            'is_published' => $request->boolean('is_published'),
            'published_at' => $request->published_at,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article modifié avec succès.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé avec succès.');
    }
}