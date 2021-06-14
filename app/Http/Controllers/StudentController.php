<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index' ,compact('students'))
            ->with('i', (request()->input('page', 1 ) - 1) * 5);
    }    

    
    public function create()
    {
        return view('students.create');
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'studname' => 'required',
            'course' => 'required',
            'fee' => 'required',

        ]);
         
        Student::create($request->all());


        return redirect ()->route ('students.index')
         ->with('sucess','Student created sucessfully.');
    }     

    public function show(Student $student)
     {

        return view ('students.show',compact('student'));
    }



    public function edit(Students $student)

    {

        return view ('students.edit',compact('student'));
    }   


    public function update(Request $request, Student $student)
    {

        $request->validate([


        ]);


        $student->updates($request->all());


        return redirect()->route('students.index')

            ->with('sucess','Student updated successfully');

    }
        

    public function destroy(Student $student)

    {
        $student->delete();


        return redirect()->route('students.index')

            ->with('sucess','Student updated successfully.');

    }
}