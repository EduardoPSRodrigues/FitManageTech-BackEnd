<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {

            $user_id = Auth::user()->id;
            $plan_id = Auth::user()->plan_id;

            $amountExercises = Exercise::where('user_id', $user_id)->count();
            $amountStudents = Student::where('user_id', $user_id)->count();

            $current_user_plan = Plan::where('id', $plan_id)->get();

            $number_total_plan = $current_user_plan[0]['limit'];

            $remaining_students = $number_total_plan - $amountStudents;

            return [
                'registered_students' => $amountStudents,
                'registered_exercises' => $amountExercises,
                'current_user_plan' => 'PLANO '. $current_user_plan[0]['description'],
                'remaining_students' => $current_user_plan[0]['description'] === 'OURO'
                    ? 'ILIMITADO'
                    : $remaining_students,
            ];
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
