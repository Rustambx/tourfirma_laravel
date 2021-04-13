<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
    public function index()
    {
        $this->view('admin.index');

        return $this->render();
    }
}
