<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\GaleriRequest;
use App\Repositories\GaleriRepositories;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    protected $GaleriRepo;
    public function __construct(GaleriRepositories $GaleriRepo)
    {
        $this->GaleriRepo = $GaleriRepo;
    }
    public function getAllData()
    {
        return $this->GaleriRepo->getAllData();
    }
    public function createData(GaleriRequest $request)
    {
        return $this->GaleriRepo->createData($request);
    }
    public function getDataById($id)
    {
        return $this->GaleriRepo->getDataById($id);
    }

    public function deleteData($id)
    {
        return $this->GaleriRepo->deleteData($id);
    }
}
