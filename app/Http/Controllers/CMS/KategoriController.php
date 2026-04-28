<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriRequest;
use App\Repositories\KategoriRepositories;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $KategoriRepo;
    public function __construct(KategoriRepositories $KategoriRepo)
    {
        $this->KategoriRepo = $KategoriRepo;
    }
    public function getAllData()
    {
        return $this->KategoriRepo->getAllData();
    }
    public function createData(KategoriRequest $request)
    {
        return $this->KategoriRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->KategoriRepo->getDataById($id);
    }
    public function updateData(KategoriRequest $request, $id)
    {
        return $this->KategoriRepo->updateData($id, $request);
    }
    public function deleteData($id)
    {
        return $this->KategoriRepo->deleteData($id);
    }
}
