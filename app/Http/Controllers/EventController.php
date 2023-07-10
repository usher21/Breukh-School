<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        return Event::with('classes')->get();
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all('subject', 'description', 'date', 'user_id'), [
            "subject" => "required|min:5",
            "description" => "required|min:10",
            "date" => "required|date_format:Y-m-d",
            "user_id" => 'required|exists:users,id'
        ])->validate();

        return Event::create($validatedData);
    }

    public function addParticipations(Request $request, $eventId)
    {
        if (!Event::find($eventId)) {
            return ["message" => "Cette évènement n'existe pas"];
        }

        return DB::table('event_classe')->insert($request->all());
    }
}
