<?php

namespace App\Http\Controllers;

use App\Http\Resources\DisciplineRessource;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    const SUBJECT_NOT_FOUND = "Aucune discipline ne correspond à cette identifiant";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DisciplineRessource::collection(Discipline::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all('label'), [
            'label' => 'required|unique:disciplines'
        ], [
            "label.required" => "Le nom de la discipline est requis",
            "label.unique" => "Cette discipline existe déjà"
        ])->validated();

        return new DisciplineRessource(Discipline::create($validated));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject = Discipline::find($id);

        if ($subject) {
            return new DisciplineRessource($subject);
        }

        return ["error" => self::SUBJECT_NOT_FOUND];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all('label'), [
            'label' => 'required|unique:disciplines'
        ], [
            "label.required" => "Le nom de la discipline est requis",
            "label.unique" => "Cette discipline existe déjà"
        ])->validated();

        $subject = Discipline::find($id);

        if ($subject) {
            $subject->label = $validated['label'];
            $subject->save();
            return new DisciplineRessource($subject);
        }

        return ["error" => self::SUBJECT_NOT_FOUND];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Discipline::find($id);

        if ($subject) {
            return $subject->delete();
        }

        return ["error" => self::SUBJECT_NOT_FOUND];
    }
}
