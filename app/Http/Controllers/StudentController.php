<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(5);
        return view('students.index', compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'class' => 'required',
            'course' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');
        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/uploads/students');
        $image->move($destinationPath, $name);

        Student::create([
            'fullname' => $request->get('fullname'),
            'class' => $request->get('class'),
            'course' => $request->get('course'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'image' => $name
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $student = Student::find($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'class' => 'required',
            'course' => 'required',
            'email' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        $student = Student::find($id);
        $name = $student->image;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/students');
            $image->move($destinationPath, $name);
        }

        $student->fullname = $request->get('fullname');
        $student->class = $request->get('class');
        $student->course = $request->get('course');
        $student->email = $request->get('email');
        $student->address = $request->get('address');
        $student->image = $name;

        $student->save();

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        File::delete('public/uploads/students' . $student->image);

        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}
