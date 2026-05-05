<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositories $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function getAllData()
    {
        return $this->userRepo->getAllData();
    }

    public function createData(UserRequest $request)
    {
        return $this->userRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->userRepo->getDataById($id);
    }

    public function updateData(UserRequest $request, $id)
    {
        return $this->userRepo->updateData($id, $request);
    }

    public function deleteData($id)
    {
        return $this->userRepo->deleteData($id);
    }

    public function aktivasiAkunWo($id)
    {
        return $this->userRepo->aktivasiAkunWo($id);
    }
}
