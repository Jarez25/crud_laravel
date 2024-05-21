<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }


    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'age' => 'required|integer|min:1'
        ]);

        Student::create($request->all()); // captura todo el valor del request

        return redirect()->route('students.index');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'age' => 'required|integer|min:1'
        ]);

        $students = Student::findOrFail($id);
        $students->update($request->all());

        return redirect()->route('students.index');
    }

    public function destroy(string $id)
    {
        $students = Student::findOrFail($id);
        $students->delete();
        return redirect()->route('students.index');
    }
}
