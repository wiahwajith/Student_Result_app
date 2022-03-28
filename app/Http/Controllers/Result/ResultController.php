<?php

namespace App\Http\Controllers\Result;


use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\AllRequiredRequest;
use App\Repository\Result\ResultRepositoryInterface;

class ResultController extends Controller
{
    public $resultRepository;
    
    public function __construct(ResultRepositoryInterface $resultRepository )
    {
        $this->resultRepository = $resultRepository;
    }

    public function index($id)
    {
        //show own result
        $result = $this->resultRepository->getResult($id);

        return Inertia::render('Result/Index', [
            "student" => $result
        ]);
    }

    public function create($id)
    {
        list($student, $subjects, $exams ) = $this->resultRepository->getCreateData($id);

        return Inertia::render('Result/Create' ,['student'=>$student ,'subjects'=>$subjects,'exams'=> $exams]);
    }

    public function store(AllRequiredRequest $request)
    {
        list($result, $student )  = $this->resultRepository->store($request);

        $request->session()->flash('success', 'Result added for "'. $student->first_name .'" successfully!');

        return redirect()->route('administrator.index');
    }

    public function edit($id)
    {
        $student = $this->resultRepository->edit($id);

        return Inertia::render('Student/Edit', [
            'student' => $student
        ]);
    }
}
