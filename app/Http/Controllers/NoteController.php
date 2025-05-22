<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Http\Requests\NoteUpdateRequest;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $notes = Note::latest()->paginate(5);

        return view('notes.index', compact('notes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NoteStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $validated['image'] = str_replace('public/', '', $path);
        }

        Note::create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): View
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): View
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NoteUpdateRequest $request, Note $note): RedirectResponse
    {
        $validated = $request->validated();
        
        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($note->image) {
                Storage::delete('public/' . $note->image);
            }
            
            $path = $request->file('image')->store('public/images');
            $validated['image'] = str_replace('public/', '', $path);
        }

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        // Delete associated image if exists
        if ($note->image) {
            Storage::delete('public/' . $note->image);
        }
        
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully');
    }
}