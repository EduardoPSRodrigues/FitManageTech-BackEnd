<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Student;
use App\Models\Workout;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkoutReportController extends Controller
{
    public function exportWorkoutPDF(Request $request)
    {

        try {
            $user_id = Auth::user()->id;
            $student_id = $request->input('student_id');

            $student = Student::where('user_id', $user_id)->find($student_id);

            if ($student) {

                $workouts = Workout::where('student_id', $student_id)->get();

                $groupedDays = [];

                foreach ($workouts as $data) {
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

                // Mapeando os dias da semana para seus índices de ordenação
                $orderedDays = [
                    'SEGUNDA' => 1,
                    'TERÇA' => 2,
                    'QUARTA' => 3,
                    'QUINTA' => 4,
                    'SEXTA' => 5,
                    'SÁBADO' => 6,
                    'DOMINGO' => 7,
                ];

                // Ordenando os dias usando a ordem definida no array $orderedDays
                uksort($groupedDays, function ($a, $b) use ($orderedDays) {
                    return $orderedDays[$a] <=> $orderedDays[$b];
                });

                $pdf = Pdf::loadView('pdfs.workoutStudent', [
                    'student_name' => $student->name,
                    'workouts' => $groupedDays,
                ]);


                return $pdf->stream('TreinosDoEstudante.pdf');
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
}
