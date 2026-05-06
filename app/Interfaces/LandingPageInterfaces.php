<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface LandingPageInterfaces
{
    public function getListWo(Request $request);

    public function getDetailWo($id);

    public function getCategories();
    public function getWo();
}
