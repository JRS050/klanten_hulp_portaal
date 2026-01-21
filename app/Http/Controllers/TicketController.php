<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->admin_status !== true){
            return TicketResource::collection(Ticket::query()->where('user_id', $user->id)->get()->sortBy('created_at')); 
        } else {
            return TicketResource::collection(Ticket::all()->sortBy('created_at'));
        }
        
    }

    public function show(Request $request){
        $user = Auth::user();
        $admin_list = User::where('admin_status',1)->get();
        $ticket = Ticket::where('id', $request->id)->get();
        return response()->json([
            'user' => $user,
            'admins' => $admin_list,
            'ticket' => $ticket
        ]);
    }

    public function store(StoreTicketRequest $request) {
        $ticket = Ticket::create($request->validated());
        $user = Auth::user();
        $ticket->user_id = $user->id;
        $ticket->category_id = $request->category_id;
        $ticket->save();
        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }

    public function update(StoreTicketRequest $request, Ticket $ticket) {
        //dd($request->all());
        $ticket->update($request->validated());
        if($request->has('category_id')){
            $ticket->categories()->detach();
            $ticket->categories()->attach($request->validated(['category_id']));
        };
        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }

    public function destroy(Ticket $ticket) {
        $ticket->delete();
        return response()->json(['message' => 'Ticket succesfully deleted']);
    }
}
