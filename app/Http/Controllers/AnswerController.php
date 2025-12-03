<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(){
        return AnswerResource::collection(Answer::all());
    }

    public function store(StoreAnswerRequest $request){
        $answer = Answer::create($request->validated());
        $answers = Answer::all();
        return AnswerResource::collection($answers);
    }

    public function update(StoreAnswerRequest $request, Answer $answer){
        $answer->update($request->validated());
        $answers = Answer::all();
        return AnswerResource::collection($answers);
    }

    public function destroy(Answer $answer){
        $answer->delete();
        return response()->json(['message' => 'Answer deleted successfully']);
    }
}
