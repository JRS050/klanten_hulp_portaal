<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    public function creator(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin(): BelongsTo {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function notes(): HasMany {
        return $this->hasMany(Note::class);
    }

    public function answers(): HasMany {
        return $this->hasMany(Answer::class);
    }

    public function category(): BelongsToMany{
        return $this->belongsToMany(Ticket::class);
    }
};
