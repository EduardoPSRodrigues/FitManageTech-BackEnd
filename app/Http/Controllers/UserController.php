<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(Request $request) {
       try {
        $data = $request->all();

        $request->validate([
            'name' => 'string|max:255|required',
            'email' => 'string|email|max:255|required|unique:users',
            'date_birth' => 'date_format:Y-m-d|required',
            'cpf' => 'string|max:14|required|unique:users',
            'password'=> 'string|min:8|max:32|required',
            'plan_id'=> 'integer|required'
        ]);

        $user = User::create($data);

        return $user;

       } catch (\Exception $exception) {
        return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
       }
    }

}
