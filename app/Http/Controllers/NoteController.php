<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index(){
        return NoteResource::collection(Note::all());
    }

    public function store(StoreNoteRequest $request){
        $note = Note::create($request->all());
        $notes = Note::all();
        return NoteResource::collection($notes);
    }

    public function update(StoreNoteRequest $request, Note $note){
        $note->update($request->all());
        $notes = Note::all();
        return NoteResource::collection($notes);
    }

    public function destroy(Note $note){
        $note->delete();
        return response()->json(['message' => 'Note deleted successfully']);
    }
}
