<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('back.contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('back.contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'is_read' => 'nullable|boolean',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => $request->boolean('is_read'),
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Message créé avec succès.');
    }

    public function show(Contact $contact)
    {
        return view('back.contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('back.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'is_read' => 'nullable|boolean',
        ]);

        $contact->update([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_read' => $request->boolean('is_read'),
        ]);

        return redirect()->route('admin.contacts.index')->with('success', 'Message modifié avec succès.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message supprimé avec succès.');
    }
}