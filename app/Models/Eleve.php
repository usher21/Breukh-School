<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Eleve extends Model
{
    use HasFactory;

    public function __construct()
    {
        static::creating(function ($student) {
            if ($student->profil === 1) {
                $student->number = $this->generateNumber();
            } else {
                $student->number = null;
            }
        });
    }

    public static function generateNumber()
    {
        $allocatedNumbers = DB::table('eleves')->where('profil', 1)->where('state', 1)->get()->sortBy('number');

        for ($i = 0; $i < count($allocatedNumbers); $i++) {
            if ($allocatedNumbers[$i]->number != ($i + 1)) {
                return $allocatedNumbers[$i]->number - 1;
            }
        }

        return count($allocatedNumbers) + 1;
    }

    public function classes() : BelongsToMany
    {
        return $this->belongsToMany(Classe::class, 'inscriptions', 'eleve_id', 'classe_id');
    }

    protected $guarded = ['id'];
}
