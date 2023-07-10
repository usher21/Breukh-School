<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EvaluationRessource;

class EvaluationController extends Controller
{
    const EVALUATION_NOT_FOUND = "Aucune évaluation ne correspond à cette identifiant";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EvaluationRessource::collection(Evaluation::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all('label'), [
            'label' => 'required|unique:evaluations'
        ], [
            "label.required" => "Le nom de la discipline est requis",
            "label.unique" => "Cette discipline existe déjà"
        ])->validated();

        return new EvaluationRessource(Evaluation::create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluation = Evaluation::find($id);

        if ($evaluation) {
            return new EvaluationRessource($evaluation);
        }

        return ["error" => self::EVALUATION_NOT_FOUND];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all('label'), [
            'label' => 'required|unique:evaluations'
        ], [
            "label.required" => "Le nom de l'évaluation est requis",
            "label.unique" => "Cette évaluation existe déjà"
        ])->validated();

        $evaluation = Evaluation::find($id);

        if (!$evaluation) {
            return ["error" => self::EVALUATION_NOT_FOUND];
        }
        
        $evaluation->label = $validated['label'];
        $evaluation->save();
        return new EvaluationRessource($evaluation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evaluation = Evaluation::find($id);

        if ($evaluation) {
            return $evaluation->delete();
        }

        return ["error" => self::EVALUATION_NOT_FOUND];
    }
}
