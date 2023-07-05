<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElevePostRequest;
use App\Http\Resources\InscriptionRessource;
use App\Models\Eleve;
use App\Models\Inscription;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EleveController extends Controller
{
    const REQUIRE_RULES = "sometimes:required";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InscriptionRessource::collection(Inscription::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElevePostRequest $request)
    {
        $validatedData =  $request->validated();

        if (!$this->checkDate(new DateTime($validatedData['birthdate']))) {
            return response()->json([
                'message' => "L'éleve doit avoir au minimum 5 ans"
            ]);
        }

        DB::beginTransaction();
        try {
            $student = Eleve::create([
                "firstname" => $validatedData['firstname'],
                "lastname" => $validatedData['lastname'],
                "birthdate" => $validatedData['birthdate'],
                "birthplace" => $validatedData['birthplace'],
                "profil" => $validatedData['profil'],
                "sex" => $validatedData['sex'],
                "number" => $request->profil === 1 ? Eleve::generateNumber() : null,
                "allocated_number" => $request->profil === 1 ? 0 : null
            ]);

            Inscription::create([
                "annee_scolaire_id" => $validatedData['year'],
                "eleve_id" => $student['id'],
                "classe_id" => $validatedData['classe']
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            dd("Error => ", $exception);
            DB::rollBack();
        }

        return new InscriptionRessource(Inscription::where('eleve_id', $student->id)->first());
    }

    public function checkDate($studentDateTime)
    {
        $datetime = new DateTime(date('Y-m-d'));
        $age = $studentDateTime->add(new DateInterval("P5Y"));

        if ($datetime->format('Y-m-d') < $age->format('Y-m-d')) {
            return false;
        }

        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Inscription::where('eleve_id', $id)->first();
        
        if ($student) {
            return new InscriptionRessource($student);
        }

        return response()->json([
            'message' => "Impossible de trouver l'élève"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "firstname" => self::REQUIRE_RULES,
            "lastname" => self::REQUIRE_RULES,
            "birthdate" => self::REQUIRE_RULES . "|date_format:Y-m-d",
            "birthplace" => self::REQUIRE_RULES,
            "profil" => self::REQUIRE_RULES,
            "sex" => self::REQUIRE_RULES,
            "state" => self::REQUIRE_RULES,
            "number" => self::REQUIRE_RULES
        ]);

        $student = Eleve::where('id', $id);

        if (!$student) {
            return [
                "message" => "Elève introuvable !"
            ];
        }

        $student->update($request->only('firstname', 'lastname', 'birthdate', 'birthplace', 'profil', 'sex', 'state', 'number', 'allocated_number'));
        return new InscriptionRessource(Inscription::where('eleve_id', $id)->first());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
