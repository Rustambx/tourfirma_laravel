<?php

namespace App\Modules\City\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\City\Requests\CityRequest;
use City;
use Country;

class CityController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_CITIES')) {
            return back()->with(['error' => 'У вас нет прав для списки городов']);
        }

        $cities = City::all();

        $this->view('city::admin.index');

        return $this->render(compact('cities'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_CITIES')) {
            return back()->with(['error' => 'У вас нет прав для добавление города']);
        }

        $countries = Country::all();

        $this->view('city::admin.create');

        return $this->render(compact('countries'));
    }

    public function store(CityRequest $request)
    {
        $result = City::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.cities.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_CITIES')) {
            return back()->with(['error' => 'У вас нет прав для редактирование города']);
        }

        $city = City::find($id);
        $countries = Country::all();

        if ($city->img) {
            $city->resized_image = CImage::resize($city->img, 500, 300);
        }

        $this->view('city::admin.edit');

        return $this->render(compact('city', 'countries'));
    }

    public function update(CityRequest $request, $id)
    {
        $result = City::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.cities.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_CITIES')) {
                return back()->with(['error' => 'У вас нет прав для удаление города']);
            }
        }

        $result = City::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.cities.index')->with($result);
    }
}
