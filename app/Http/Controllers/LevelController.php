<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Resources\LevelResource;
use App\Traits\JoinQueryParams;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    use JoinQueryParams;

    public function index(Request $request)
    {
        if ($request->join) {
            $levels = $this->resolve(Level::class, $request->join);
            if ($levels) {
                return LevelResource::collection($levels->get());
            }
        }

        return LevelResource::collection(Level::all());
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "label" => "required|min:2|unique:levels"
        ], [
            "label.required" => "Le nom du niveau est requis !",
            "label.min" => "Le nom du niveau doit être au minimum 2 caractères !",
            "label.unique" => "Le nom du niveau existe déjà"
        ])->validate();

        return new LevelResource(Level::create($validatedData));
    }

    public function show(Request $request, Level $level)
    {
        if ($request->join) {
            $levelObj = $this->resolve($level, $request->join);
            if ($levelObj) {
                return new LevelResource($levelObj->first());
            }
        }

        return new LevelResource($level);
    }
}
