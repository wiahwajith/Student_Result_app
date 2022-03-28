<?php

namespace App\Repository\Result;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Student;
use App\Models\Subject;

class ResultRepository implements ResultRepositoryInterface
{
    public function getResult($id)
    {
        $result =  Student::where('id',$id)->with(['Result','Result.subject','Result.exam'])->get();

        return $result;

    }

    public function getCreateData($id)
    {
        $student =  Student::find($id);
        $subjects =  Subject::all();
        $exams =  Exam::all();

        return [$student, $subjects, $exams];
    }

    public function store($request)
    {
        $student = Student::find($request->student_id);
        $examDate = Carbon::parse($request->input("exam_date"))->format('y-m-d');

        $result = $student->Result()->create($request->except(['student_id','exam_date']) + [ 'exam_date' => $examDate] );

        return [$result,$student];
    }

    public function edit($id)
    {
        $student =  Student::findOrFail($id);

        return $student;
    }
}
