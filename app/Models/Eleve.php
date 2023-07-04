<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    public static function generateNumber()
    {
        $number = 0;
        $allocatedNumbers = DB::table('eleves')->where('state', 0)->where('allocated_number', 0)->get();

        if ($allocatedNumbers->isEmpty()) {
            $last = DB::table('eleves')->orderByDesc('number')->first();
            $number = $last->number + 1;
        } else {
            $minNumber = $allocatedNumbers->sortByDesc('number')->last();
            $number = $minNumber->number;
            DB::table("eleves")->where('id', $minNumber->id)->update(['allocated_number' => 1]);
        }

        return $number;
    }

    protected $fillable = [
        "firstname",
        "lastname",
        "birthdate",
        "birthplace",
        "profil",
        "sex",
        "number",
        "allocated_number"
    ];
}
