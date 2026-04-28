<?php

namespace App\Interfaces;

use App\Http\Requests\LayananRequest;

interface LayananInterfaces
{
    public function getAllData();
    public function createData(LayananRequest $request);
    public function getDataById($id);
    public function updateData($id, LayananRequest $request);
    public function deleteData($id);
}
