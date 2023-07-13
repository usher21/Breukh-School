<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeByClasse(Builder $query, $classeId) : Builder
    {
        return $query->whereHas('classe', function ($innerQuery) use($classeId) {
            $innerQuery->where('id', $classeId);
        });
    }

    public function scopeBySubject(Builder $query, $disciplineId) : Builder
    {
        return $query->whereHas('discipline', function ($innerQuery) use($disciplineId) {
            $innerQuery->where('id', $disciplineId);
        });
    }

    public function scopeBySemester(Builder $query, $semesterId) : Builder
    {
        return $query->whereHas('semester', function ($innerQuery) use($semesterId) {
            $innerQuery->where('id', $semesterId);
        });
    }
}
