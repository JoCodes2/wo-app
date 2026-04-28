<?php

namespace App\Interfaces;

use App\Http\Requests\KategoriRequest;

interface KategoriInterfaces
{
    public function getAllData();
    public function createData(KategoriRequest $request);
    public function getDataById($id);
    public function updateData($id, KategoriRequest $request);
    public function deleteData($id);
}
