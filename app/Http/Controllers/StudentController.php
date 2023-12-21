<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        try {
            $user_id = Auth::user()->id;

            $request->validate([
                'name' => 'string|required|max:255',
                'email' => 'string|email|required|max:255|unique:students',
                'date_birth' => 'date_format:Y-m-d|required',
                'cpf' => 'string|required|min:11|max:14|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|unique:students',
                'contact' => 'string|required|max:20',
                'city' => 'string|max:50|nullable',
                'neighborhood' => 'string|max:50|nullable',
                'number' => 'string|max:30|nullable',
                'street' => 'string|max:30|nullable',
                'state' => 'string|max:2|nullable',
                'cep' => 'string|max:20|nullable',
            ]);

            $student = Student::create([
                'user_id' => $user_id,
                ...$request->all()
            ]);

            return $student;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
