<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use App\Models\Student;
use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidateLimitStudentsToUser
{
    use HttpResponses;

    public function handle(Request $request, Closure $next): Response
    {
        $plan_id = Auth::user()->plan_id;
        $user_id = Auth::user()->id;

        $current_user_plan = Plan::find($plan_id);
        $number_total_plan = $current_user_plan ? $current_user_plan->limit : null;

        if ($number_total_plan !== null) {
            $amountStudents = Student::where('user_id', $user_id)->count();
            $remaining_students = $number_total_plan - $amountStudents;

            if ($remaining_students === 0) {
                return $this->error(
                    'Não é possível cadastrar um novo estudante, pois atingiu o limite do plano.',
                    Response::HTTP_FORBIDDEN
                );
            }
        }

        return $next($request);
    }
}
