<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->admin_status == 1){
            return TicketResource::collection(Ticket::all()->sortBy('created_at'));
        } else {
            return TicketResource::collection(Ticket::query()->where('user_id', $user->id)->get()->sortBy('created_at'));
        }
        
    }

    public function store(StoreTicketRequest $request) {
        $ticket = Ticket::create($request->validated());

        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }

    public function update(StoreTicketRequest $request, Ticket $ticket) {
        $ticket->update($request->validated());

        $tickets = Ticket::all();
        return TicketResource::collection($tickets);
    }

    public function destroy(Ticket $ticket) {
        $ticket->delete();
        return response()->json(['message' => 'Auteur succesvol verwijderd']);
    }
}
