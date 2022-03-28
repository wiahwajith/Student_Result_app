<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudetUpdateRequest;
use App\Repository\Admin\AdminRepositoryInterface;
use App\Repository\Student\StudentRepositoryInterface;

class AdministratorController extends Controller
{
    public $adminRepository;
    public $studentRepository;

    public function __construct(AdminRepositoryInterface $adminRepository ,StudentRepositoryInterface $studentRepository )
    {
        $this->adminRepository = $adminRepository;
        $this->studentRepository = $studentRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //all student
        $students = $this->studentRepository->getAllStudent();
        return Inertia::render('Admin/Index', [
            "student" => $students
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->studentRepository->find($id);
        return Inertia::render('Admin/Edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudetUpdateRequest $request, $id)
    {

        $student = $this->studentRepository->update($request,$id);

        $request->session()->flash('success', 'Student updated successfully!');

        return redirect()->route('administrator.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        $student = $this->adminRepository->deleteStudent($id);

        $request->session()->flash('success', 'Post deleted successfully!');

        return redirect()->route('administrator.index');
    }
}
