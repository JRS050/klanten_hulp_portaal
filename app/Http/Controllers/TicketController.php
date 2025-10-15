<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        return TicketResource::collection(Ticket::all());
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
