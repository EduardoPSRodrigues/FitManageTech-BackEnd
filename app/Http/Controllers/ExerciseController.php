<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{

    public function index()
    {
        $user_id = Auth::user()->id;

        $exercises = Exercise::where('user_id', $user_id)
            ->orderBy('description')
            ->get();;

        return $exercises;
    }

    public function store(Request $request)
    {
        try {

            $user_id = Auth::user()->id;

            $request->validate([
                'description' => 'string|required|max:255'
            ]);

            $description = $request->input('description');

            $existingExercise = Exercise::where('user_id', $user_id)
                ->where('description', $description)
                ->first();

            if ($existingExercise) {
                return $this->error('O exercício já existe para este usuário.', Response::HTTP_CONFLICT);
            }

            $exercise = Exercise::create([
                'user_id' => $user_id,
                'description' => $description
            ]);

            return $exercise;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {

        try {
            $user_id = Auth::user()->id;

            $exercise = Exercise::find($id);

            if (!$exercise) {
                return $this->error('Exercício não encontrado no banco de dados.', Response::HTTP_NOT_FOUND);
            }

            if ($exercise->user_id !== $user_id) {
                return $this->error('O usuário não pode deletar esse exercício.', Response::HTTP_FORBIDDEN);
            }

            $exercise->delete();

            return $this->response('', Response::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            return $this->error('Não é permitido deletar o exercício, pois está vinculado a um treino.', Response::HTTP_CONFLICT);
        }
    }
}
