<?php

namespace App\Interfaces;

use App\Http\Requests\PemesananRequest;

interface PemesananInterfaces
{
    public function getAllData();
    public function createData(PemesananRequest $request);
    public function konfirmasiPesanan($id, $status);
    public function getDataById($id);
    public function createUlasan($request);
    public function getLayananById($id);
}
