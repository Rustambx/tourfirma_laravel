<?php

namespace App\Http\Controllers;

use App\Modules\User\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Navigation;

class Controller extends BaseController
{
    protected $arNavigation = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->arNavigation = Navigation::all();
    }

    protected function render(array $data = [])
    {
        $data['navigations'] = $this->arNavigation;
        return view($this->view)
            ->with($data);
    }

    protected function view(string $view): void
    {
        $this->view = $view;
    }
}
