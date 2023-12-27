<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Student;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $student_id = $request->input('student_id');

            $student = Student::where('user_id', $user_id)->find($student_id);

            if ($student) {

                $workout = Workout::where('student_id', $student_id)->orderBy('created_at')->get();

                $groupedDays = [];

                foreach ($workout as $data) {
                    $day = $data['day'];
                    $exerciseId = $data['exercise_id'];

                    $exercise = Exercise::find($exerciseId);

                    if (!isset($groupedDays[$day])) {
                        $groupedDays[$day] = [];
                    }

                    $groupedDays[$day][] = [
                        'workout_details' => $data,
                        'exercise_details' => $exercise,
                    ];
                }

                return [
                    'student_id' => $student_id,
                    'student_name' => $student->name,
                    'workouts' => $groupedDays,
                ];
            } else {
                return $this->error(
                    'O usuário não tem permissão para visualizar essas informações.',
                    Response::HTTP_FORBIDDEN
                );
            }
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function store(Request $request)
    {
        try {
            $user_id = Auth::user()->id;

            $data = $request->validate([
                'student_id' => 'integer|required',
                'exercise_id' => 'integer|required',
                'repetitions' => 'integer|required',
                'weight' => 'numeric|required',
                'break_time' => 'integer|required',
                'day' => [
                    Rule::in(['SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO']),
                ],
                'observations' => 'nullable|string',
                'time' => 'integer|required',
            ]);

            $existingStudent = Student::find($data['student_id']);
            $existingExercise = Exercise::find($data['exercise_id']);

            if (!$existingStudent || $existingStudent->user_id !== $user_id || !$existingExercise || $existingExercise->user_id !== $user_id) {
                return $this->error('O usuário não tem permissão para cadastrar um treino para esse aluno ou o exercício é inválido.', Response::HTTP_CONFLICT);
            }

            $existingWorkoutDay = Workout::where('day', $data['day'])
                ->where('exercise_id', $data['exercise_id'])
                ->first();

            if ($existingWorkoutDay) {
                return $this->error('O treino já está cadastrado para este dia.', Response::HTTP_CONFLICT);
            }

            $exercise = Workout::create($data);

            return $exercise;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
