<?php

namespace App\Repository\Student;

interface StudentRepositoryInterface
{
    public function getStudent();

    public function getAllStudent();

    public function find($id);

    public function store($request);

    public function edit($id);

    public function update($request, $id);

    public function delete($id);
}
