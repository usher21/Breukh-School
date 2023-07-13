<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Models\DisciplineClasse;
use App\Http\Resources\ClasseResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InscriptionRessource;
use App\Http\Resources\DisciplineClasseRessource;
use App\Traits\JoinQueryParams;

class ClasseController extends Controller
{
    use JoinQueryParams;

    public function index(Request $request)
    {
        if ($request->join) {
            return ClasseResource::collection($this->resolve(Classe::class, $request->join)->get());
        }

        return ClasseResource::collection(Classe::all());
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all('label', 'level_id'), [
            "label" => "required|unique:classes",
            "level_id" => "required"
        ], [
            "label.required" => "Le nom de la classe est requis",
            "label.unique" => "Le nom de la classe existe déjà",
            "level_id.required" => "Le niveau de la classe est requis"
        ])->validate();

        return new ClasseResource(Classe::create($validated));
    }

    public function show(Request $request, string $id)
    {
        if ($request->join) {
            return new ClasseResource($this->resolve(Classe::class, $request->join)->first());
        }

        return new ClasseResource(Classe::find($id)->first());
    }

    public function update(Request $request, Classe $classe)
    {
        Validator::make($request->all('label', 'level_id', 'semester_id'), [
            "label" => "sometimes:required|unique:classes",
            "level_id" => "sometimes:required",
            "semester_id" => "sometimes:required|exists:semesters,id",
        ], [
            "label.required" => "Le nom de la classe est requis",
            "label.unique" => "Le nom de la classe existe déjà",
            "level_id.required" => "Le niveau de la classe est requis",
            "semester_id.required" => "L'identifiant du semestre est requis",
            "semester_id.exists" => "Ce semestre n'existe pas"
        ])->validate();

        return $classe->update($request->only('label', 'level_id', 'semester_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function allStudents(string $id)
    {
        return InscriptionRessource::collection(Inscription::where('classe_id', $id)->get());
    }

    public function addCoef(Request $request, string $classeId)
    {
        $validated = Validator::make($request->all('max_mark', 'discipline_id', 'evaluation_id', 'semester_id'), [
            "max_mark" => "required|min:0|max:30",
            "discipline_id" => "required",
            "evaluation_id" => "required",
            "semester_id" => "required|exists:semesters,id",
        ], [
            "max_mark.required" => "La note maximale est requis",
            "max_mark.min" => "La note maximale ne peut être négative",
            "max_mark.max" => "La note maximale ne doit pas être supérieur à 30",
            "discipline_id.required" => "La discipline est requis",
            "evaluation_id.required" => "Le type d'évaluation est requis",
            "semester_id.required" => "Le semestre est requis",
            "semester_id.exists" => "Le semestre n'existe pas"
        ])->validate();

        $disciplineClasse = DisciplineClasse::where('classe_id', $classeId)
                                            ->where('discipline_id', $validated['discipline_id'])
                                            ->where('evaluation_id', $validated['evaluation_id'])
                                            ->where('semester_id', $validated['semester_id'])
                                            ->get();

        if ($disciplineClasse->isEmpty()) {
            $validated['classe_id'] = $classeId;
            return DisciplineClasse::create($validated);
        }

        return [
            'error' => "La note maximale est déjà définie pour ce type d'évaluation dans cette semestre"
        ];
    }

    public function listCoef(string $classeId)
    {
        return DisciplineClasseRessource::collection(DisciplineClasse::where('classe_id', $classeId)->get());
    }
}
