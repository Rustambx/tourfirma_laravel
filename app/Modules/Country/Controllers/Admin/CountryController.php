<?php

namespace App\Modules\Country\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\Country\Requests\CountryRequest;
use Country;

class CountryController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_COUNTRIES')) {
            return back()->with(['error' => 'У вас нет прав для списки стран']);
        }

        $countries = Country::all();

        $this->view('country::admin.index');

        return $this->render(compact('countries'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_COUNTRIES')) {
            return back()->with(['error' => 'У вас нет прав для добавление страны']);
        }

        $this->view('country::admin.create');

        return $this->render();
    }

    public function store(CountryRequest $request)
    {
        $result = Country::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.countries.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_COUNTRIES')) {
            return back()->with(['error' => 'У вас нет прав для редактирование страны']);
        }

        $country = Country::find($id);
        if ($country->img) {
            $country->resized_image = CImage::resize($country->img, 500, 300);
        }

        $this->view('country::admin.edit');

        return $this->render(compact('country'));
    }

    public function update(CountryRequest $request, $id)
    {
        $result = Country::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.countries.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_COUNTRIES')) {
                return back()->with(['error' => 'У вас нет прав для удаление страны']);
            }
        }

        $result = Country::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.countries.index')->with($result);
    }
}
