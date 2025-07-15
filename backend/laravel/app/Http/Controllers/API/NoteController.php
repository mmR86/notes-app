<?php

namespace App\Http\Controllers\API;

use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //The method returns all the notes belonging to the authenticated user, along with their associated category and tags
        return $request->user()->notes()->with(['category', 'tags'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validates the incoming request using the specified rules
        $data = $request->validate([
            'content' => 'required|string',
            //If provided, the value must match an id in the categories table in the database.
            'category_id' => 'nullable|exists:categories,id',
            'tag_ids' => 'array',
            //Applies validation to each element in the tag_ids array. Each tag ID in the array must exist in the id column of the tags table
            'tag_ids.*' => 'exists:tags,id',
        ]);

        //Creates a new note for the currentlly authenticated user
        $note = $request->user()->notes()->create([
            'content' => $data['content'],
            'category_id' => $data['category_id'] ?? null,
        ]);

        //This snippet updates the tags associated with a note, but only if some tag_ids are provided. It ensures the tags in the database match the user’s current selection exactly
        if (!empty($data['tag_ids'])) {
            $note->tags()->sync($data['tag_ids']);
        }

        //Returns the note with its adequate tags or categorie as a JSON object
        return response()->json($note->load('category', 'tags'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        $this->authorizeAccess($note);
        return $note->load('category', 'tags');
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Note $note)
    {
        $this->authorizeAccess($note);

        $data = $request->validate([
            'content' => 'sometimes|string',
            'category_id' => 'nullable|exists:categories,id',
            'tag_ids' => 'array',
            'tag_ids.*' => 'exists:tags,id',
        ]);

        $note->update($data);

        if (isset($data['tag_ids'])) {
            $note->tags()->sync($data['tag_ids']);
        }

        return response()->json($note->load('category', 'tags'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorizeAccess($note);
        $note->delete();
        return response()->noContent();
    }

    private function authorizeAccess(Note $note)
    {
        if (auth()->id() !== $note->user_id) {
            abort(403, 'Unauthorized');
        }
    }
}
