<?php

namespace App\Models;

use App\Http\Resources\MarkRessource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mark extends Model
{
    use HasFactory;

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }

    public function disciplineClasse(): BelongsTo
    {
        return $this->belongsTo(DisciplineClasse::class);
    }

    public function scopeByClasse(Builder $query, $classeId)
    {
        return $query->whereHas('disciplineClasse', function ($innerQuery) use ($classeId) {
            $innerQuery->where('classe_id', $classeId);
        });
    }

    public function scopeBySubject(Builder $query, $subjectId)
    {
        return $query->whereHas('disciplineClasse', function ($innerQuery) use ($subjectId) {
            $innerQuery->where('discipline_id', $subjectId);
        });
    }
    
    public function scopeByStudent(Builder $query, $studentId)
    {
        return $query->whereHas('inscription', function ($innerQuery) use ($studentId) {
            $innerQuery->where('eleve_id', $studentId);
        });
    }

    public function scopeWithResources(Builder $query)
    {
        return MarkRessource::collection($query->get());
    }

    public function scopeWithRelatedData(Builder $query)
    {
        return $query->join('discipline_classes', 'discipline_classes.id', '=', 'marks.discipline_classe_id')
            ->join('classes', 'classes.id', '=', 'discipline_classes.classe_id')
            ->join('disciplines', 'disciplines.id', '=', 'discipline_classes.discipline_id')
            ->join('evaluations', 'evaluations.id', '=', 'discipline_classes.evaluation_id')
            ->join('inscriptions', 'inscriptions.id', '=', 'marks.inscription_id')
            ->join('eleves', 'eleves.id', '=', 'inscriptions.eleve_id')
            ->select(
                'marks.id as mark_id',
                'marks.value as mark_value',
                'classes.id as classe_id',
                'classes.label as classe_name',
                'eleves.firstname as firstname',
                'eleves.lastname as lastname',
                'eleves.state as student_state',
                'eleves.number as student_number',
                'disciplines.id as discipline_id',
                'disciplines.label as discipline_name',
                'evaluations.id as evaluation_id',
                'evaluations.label as evaluation_name'
            );
    }
}
