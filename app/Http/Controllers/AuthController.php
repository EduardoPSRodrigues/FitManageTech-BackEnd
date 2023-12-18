<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        try {
            $data = $request->only('email', 'password');

            $request->validate([
                'email' => 'string|email|required',
                'password' => 'string|required'
            ]);

            $authenticated = Auth::attempt($data);

            if (!$authenticated) {
                return $this->error('Não autorizado. Credenciais incorretas', Response::HTTP_UNAUTHORIZED);
            }

            $request->user()->tokens()->delete();

            $user = User::find($request->user()->id);

            $token = $request->user()->createToken('simple');

            return $this->response('Autorizado', 200, [
                'name' => $user->name,
                'token' => $token->plainTextToken
            ]);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

}
