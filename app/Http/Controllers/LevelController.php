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
        if (!$request->input('join')) {
            return Level::all('id', 'label');
        }

        if (method_exists(Level::class, $request->input('join'))) {
            return LevelResource::collection(Level::with($request->input('join'))->get());
        } else {
            return [
                'message' => "Route introuvable !"
            ];
        }
    }

    public function show(Request $request, Level $level)
    {
        $this->fun();
        dd($request->all());
        return $level;
    }
}
