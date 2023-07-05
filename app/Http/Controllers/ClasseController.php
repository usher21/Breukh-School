<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Http\Resources\ClasseResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InscriptionRessource;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (method_exists(Classe::class, $request->join)) {
            return ClasseResource::collection(Classe::with($request->join)->get());
        }

        return ClasseResource::collection(Classe::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all('label', 'level_id'), [
            "label" => "required|unique:classes",
            "level_id" => "required"
        ], [
            "label.required" => "Le nom de la classe est requis",
            "label.unique" => "Le nom de la classe existe déjà",
            "level_id.required" => "Le niveau de la classe est requis"
        ])->validated();

        return new ClasseResource(Classe::create($validated)->with('level')->first());
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        if (method_exists(Classe::class, $request->join)) {
            return new ClasseResource(Classe::with($request->join)->where('id', $id)->first());
        }

        return new ClasseResource(Classe::where('id', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all('label', 'level_id'), [
            "label" => "sometimes:required|unique:classes",
            "level_id" => "sometimes:required"
        ], [
            "label.required" => "Le nom de la classe est requis",
            "label.unique" => "Le nom de la classe existe déjà",
            "level_id.required" => "Le niveau de la classe est requis"
        ])->validated();

        dd($validated);
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

    public function addCoef()
    {

    }

    public function listCoef()
    {
        
    }
}
