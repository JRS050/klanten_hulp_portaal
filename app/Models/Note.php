<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    public function ticket(): BelongsTo{
        return $this->belongsTo(Ticket::class);
    }

    protected $fillable = [
        'body',
        'ticket_id',
    ];
}

