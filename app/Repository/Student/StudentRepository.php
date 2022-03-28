<?php

namespace App\Repository\Student;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{

    public function getStudent()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        return $student;
    }
    public function getAllStudent()
    {
        $student = Student::orderBy('id', 'DESC')->paginate(10);
        return $student;
    }
    public function find($id)
    {
        $student = Student::findOrFail($id);
        return $student;
    }

    public function store($request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->save();

        $Student = new Student();
        $Student->first_name = $request->input("name");
        $Student->last_name = $request->input("lastname");
        $Student->email = $request->input("email");
        $Student->gender = $request->input("gender");
        $Student->dob = Carbon::parse($request->input("dob"))->format('y-m-d');
        $Student->address = $request->input("address");
        $user->studentDetails()->save($Student);
        //assign role student
        $user->assignRole('student');

        return $user;
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return $student;
    }

    public function update($request,$id)
    {
        $student = Student::find($id);

        $user = User::find($student->user_id);
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->save();


        $student->first_name = $request->input("name");
        $student->last_name = $request->input("lastname");
        $student->email = $request->input("email");
        $student->gender = $request->input("gender");
        $student->dob = Carbon::parse($request->input("dob"))->format('y-m-d');
        $student->address = $request->input("address");
        $user->studentDetails()->save($student);

        return $user;
    }

    public function delete($id)
    {
        $student = Student::find($id)->delete();
        return $student;
    }

}
