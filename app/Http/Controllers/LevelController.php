<?php

namespace App\Http\Controllers;

use App\Http\Resources\LevelResource;
use App\Models\Level;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    use JoinQueryParams;

    public function index(Request $request)
    {
        if (method_exists(Level::class, $request->join)) {
            return LevelResource::collection(Level::with($request->join)->get());
        }

        return LevelResource::collection(Level::all());
    }

    public function store(Request $request)
    {
        
    }

    public function show(Request $request, Level $level)
    {
        if (method_exists(Level::class, $request->join)) {
            return new LevelResource($level->with($request->join)->first());
        }

        return $level;
    }
}
