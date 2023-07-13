<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

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

    public function subjects() : BelongsToMany
    {
        return $this->belongsToMany(Discipline::class, 'discipline_classes');
    }
}
