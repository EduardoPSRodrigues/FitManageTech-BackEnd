<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{

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
}
