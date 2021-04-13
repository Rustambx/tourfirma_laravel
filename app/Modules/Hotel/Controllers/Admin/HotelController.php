<?php

namespace App\Modules\Hotel\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\Hotel\Requests\HotelRequest;
use Hotel;
use City;


class HotelController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_HOTELS')) {
            return back()->with(['error' => 'У вас нет прав для списки отелей']);
        }

        $hotels = Hotel::all();

        $this->view('hotel::admin.index');

        return $this->render(compact('hotels'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_HOTELS')) {
            return back()->with(['error' => 'У вас нет прав для добавление отеля']);
        }

        $cities = City::all();

        $this->view('hotel::admin.create');

        return $this->render(compact('cities'));
    }

    public function store(HotelRequest $request)
    {
        $result = Hotel::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.hotels.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_HOTELS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование отеля']);
        }

        $hotel = Hotel::find($id);
        $cities = City::all();

        if ($hotel->img) {
            $hotel->resized_image = CImage::resize($hotel->img, 500, 300);
        }

        $this->view('hotel::admin.edit');

        return $this->render(compact('cities', 'hotel'));
    }

    public function update(HotelRequest $request, $id)
    {
        $result = Hotel::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.hotels.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_HOTELS')) {
                return back()->with(['error' => 'У вас нет прав для удаление отеля']);
            }
        }

        $result = Hotel::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.hotels.index')->with($result);
    }
}
