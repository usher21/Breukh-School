<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function classes() : BelongsToMany
    {
        return $this->belongsToMany(Classe::class, 'event_classe', 'event_id', 'classe_id');
    }
}
