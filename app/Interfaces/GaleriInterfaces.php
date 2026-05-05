<?php

namespace App\Interfaces;

use App\Http\Requests\GaleriRequest;

interface GaleriInterfaces
{
    public function getAllData();
    public function createData(GaleriRequest $request);
    public function getDataById($id);
    public function deleteData($id);
}
