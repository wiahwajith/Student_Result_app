<?php

namespace App\Http\Controllers\Student;


use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StudetUpdateRequest;
use App\Http\Requests\StudentRegisterRequest;
use App\Repository\Student\StudentRepositoryInterface;

class StudentController extends Controller
{
    public $studentRepository;

    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
        // $this->middleware("auth")->except(["index"]);
    }

    public function index()
    {

        $student = $this->studentRepository->getStudent();
        return Inertia::render('Student/Index', [
            "student" => $student
        ]);
    }

    public function create()
    {
        return Inertia::render('Student/Create');
    }

    public function store(StudentRegisterRequest $request)
    {

        $student = $this->studentRepository->store($request);

        $request->session()->flash('success', 'Student registered successfully!');

        return redirect()->route('administrator.index');
    }

    public function edit($id)
    {
        $student = $this->studentRepository->edit($id);
        return Inertia::render('Student/Edit', [
            'student' => $student
        ]);
    }

    public function update(StudetUpdateRequest $request, $id)
    {

        $student = $this->studentRepository->update($request,$id);

        $request->session()->flash('success', 'Student updated successfully!');

        return redirect()->route('student.index');
    }

    public function destroy(Request $request, $id)
    {
        $student = $this->studentRepository->delete($id);

        $request->session()->flash('success', 'Post deleted successfully!');

        return redirect()->route('student.index');
    }

}