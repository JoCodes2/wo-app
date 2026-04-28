<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\LayananRequest;
use App\Repositories\LayananRepositories;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    protected $LayananRepo;
    public function __construct(LayananRepositories $LayananRepo)
    {
        $this->LayananRepo = $LayananRepo;
    }
    public function getAllData()
    {
        return $this->LayananRepo->getAllData();
    }
    public function createData(LayananRequest $request)
    {
        return $this->LayananRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->LayananRepo->getDataById($id);
    }
    public function updateData(LayananRequest $request, $id)
    {
        return $this->LayananRepo->updateData($id, $request);
    }
    public function deleteData($id)
    {
        return $this->LayananRepo->deleteData($id);
    }
}
