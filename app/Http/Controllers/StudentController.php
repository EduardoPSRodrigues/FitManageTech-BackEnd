<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function index(Request $request)
    {

        $user_id = Auth::user()->id;

        $search = $request->input('search');

        $students = Student::query()
            ->where('user_id', $user_id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'ilike', "%$search%")
                    ->orWhere('cpf', 'ilike', "%$search%")
                    ->orWhere('email', 'ilike', "%$search%");
            })
            ->orderBy('name')
            ->get();

        return $students;
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

    public function update($id, Request $request)
    {
        try {
            $user_id = Auth::user()->id;

            $data = $request->all();

            $request->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:students',
                'date_birth' => 'date_format:Y-m-d',
                'cpf' => 'string|min:11|max:14|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/|unique:students',
                'contact' => 'string|max:20',
                'city' => 'string|max:50|nullable',
                'neighborhood' => 'string|max:50|nullable',
                'number' => 'string|max:30|nullable',
                'street' => 'string|max:30|nullable',
                'state' => 'string|max:2|nullable',
                'cep' => 'string|max:20|nullable',
            ]);

            $student = Student::where('id', $id)
                ->where('user_id', $user_id)
                ->first();

            if (!$student) {
                return $this->error('Falha em atualizar: O usuário não tem permissão ou o estudante não está cadastrado no banco de dados.',
                Response::HTTP_NOT_FOUND);
            }

            $student->update($data);

            return $student;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id)
    {

        $user_id = Auth::user()->id;

        $student = Student::find($id);

        if (!$student) {
            return $this->error('O estudante não está cadastrado no banco de dados.', Response::HTTP_NOT_FOUND);
        }

        if ($student->user_id !== $user_id) {
            return $this->error('O usuário não pode deletar esse estudante.', Response::HTTP_FORBIDDEN);
        }

        $student->delete();

        return $this->response('', Response::HTTP_NO_CONTENT);
    }
}
