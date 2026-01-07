<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewAnswer;

class AnswerController extends Controller
{
    public function index(){
        return AnswerResource::collection(Answer::all());
    }

    public function store(StoreAnswerRequest $request){
        // dd($request);
        $answer = Answer::create($request->validated());
        $answers = Answer::all();
        $user_id = Ticket::where('id', $request->ticket_id)->pluck('user_id');
        $user = User::where('id', $user_id)->first();
        Mail::to($user)->send(new NewAnswer);
        return AnswerResource::collection($answers);
    }

    public function update(StoreAnswerRequest $request, Answer $answer){
        $answer->update($request->validated());
        $answers = Answer::all();
        $user_id = Ticket::where('id', $request->ticket_id)->pluck('user_id');
        $user = User::where('id', $user_id)->first();
        Mail::to($user)->send(new NewAnswer);
        return AnswerResource::collection($answers);
    }

    public function destroy(Answer $answer){
        $answer->delete();
        return response()->json(['message' => 'Answer deleted successfully']);
    }
}
