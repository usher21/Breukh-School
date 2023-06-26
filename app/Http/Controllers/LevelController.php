<?php

namespace App\Http\Controllers;

use App\Http\Resources\LevelResource;
use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        return LevelResource::collection(Level::with('classes')->get());
    }
}
