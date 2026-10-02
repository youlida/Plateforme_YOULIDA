<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(10);

        return view('back.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('back.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'slug' => 'nullable|string|max:255|unique:roles,slug',
            'description' => 'nullable|string',
        ]);

        Role::create([
            'name' => strtoupper($request->name),
            'slug' => $request->filled('slug')
                ? Str::slug($request->slug)
                : Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rôle créé avec succès.');
    }

    public function show(Role $role)
    {
        return view('back.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('back.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'slug' => 'nullable|string|max:255|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update([
            'name' => strtoupper($request->name),
            'slug' => $request->filled('slug')
                ? Str::slug($request->slug)
                : Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Rôle modifié avec succès.');
    }

    public function destroy(Role $role)
{
    if ($role->slug === 'superadmin') {
        return back()->with(
            'error',
            'Le rôle Super Administrateur est protégé et ne peut pas être supprimé.'
        );
    }

    $role->delete();

    return redirect()
        ->route('admin.roles.index')
        ->with('success', 'Le rôle a été supprimé avec succès.');
}
}