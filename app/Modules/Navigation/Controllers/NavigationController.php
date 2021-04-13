<?php

namespace App\Modules\Navigation\Controllers;

use App\Http\Controllers\Controller;
use Navigation;

class NavigationController extends Controller
{
    public function navigation()
    {
        $navigations = Navigation::all();

        $this->view('layouts.app');

        $this->render(compact('navigations'));
    }
}
