<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisciplineClasse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function classe() : BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }

    public function discipline() : BelongsTo
    {
        return $this->belongsTo(Discipline::class);
    }

    public function evaluation() : BelongsTo
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function semester() : BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }
}
