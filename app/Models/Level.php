<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function classes() : HasMany
    {
        return $this->hasMany(Classe::class);
    }
}
