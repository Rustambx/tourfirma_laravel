<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Menu;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected function render(array $data = [])
    {
        $data['menu'] = $this->getMenu();
        $data['auth_user'] = \Auth::user();

        return view($this->view)
            ->with($data);
    }

    protected function view(string $view): void
    {
        $this->view = $view;
    }

    public function getMenu()
    {
        return Menu::make('adminMenu', function ($menu) {
            $menu->add('Туры', ['route' => 'admin.tours.index']);
            $menu->add('Галерея', ['route' => 'admin.galleries.index']);
            $menu->add('Отели', ['route' => 'admin.hotels.index']);
            $menu->add('Страны', ['route' => 'admin.countries.index']);
            $menu->add('Города', ['route' => 'admin.cities.index']);
            $menu->add('Новости', ['route' => 'admin.news.index']);
            $menu->add('Меню', ['route' => 'admin.navigations.index']);
            $menu->add('Слайдер', ['route' => 'admin.sliders.index']);
            $menu->add('Пользователи', ['route' => 'admin.users.index']);
            $menu->add('Привилегии', ['route' => 'admin.permissions.index']);
        });
    }
}
