<?php

namespace App\Repository\Admin;

use App\Models\User;
use App\Models\Student;

class AdminRepository implements AdminRepositoryInterface
{
    public function deleteStudent($id)
    {
        $student = Student::find($id);
        //delete Account
        $user = User::find($student->user_id)->delete();
        //delete user details
        $student->delete();
        return $student;
    }
}
