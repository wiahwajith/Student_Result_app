<?php

namespace App\Repository\Result;

interface ResultRepositoryInterface
{
    public function getResult($id);

    public function getCreateData($id);

    public function store($request);

    public function edit($id);
}
