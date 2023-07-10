<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function students() : BelongsToMany
    {
        return $this->belongsToMany(Eleve::class, 'inscriptions', 'classe_id', 'eleve_id');
    }

    public function events() : BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_classe', 'classe_id', 'event_id');
    }
}
