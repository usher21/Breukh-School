<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return User::all(['id', 'fullname', 'email', 'password']);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all('fullname', 'email'), [
            'fullname' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'fullname.required' => 'Le nom complet est requis !',
            'fullname.min' => 'Le nom doit être au minimum 5 caractères',
            'email.required' => "L'addresse email est requis !",
            'email.email' => "L'addresse email n'est pas valide",
            'email.unique' => "L'addresse email existe déjà !"
        ])->validate();

        return User::create($validatedData);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "fullname" => "sometimes:required",
            "email" => "sometimes:required",
            "password" => "sometimes:required"
        ]);

        $user->update($request->only('fullname', 'email', 'password'));
        return $user;
    }
}
