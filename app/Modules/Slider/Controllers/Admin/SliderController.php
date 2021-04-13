<?php

namespace App\Modules\Slider\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\Slider\Requests\SliderRequest;
use Slider;
use Country;

class SliderController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_SLIDERS')) {
            return back()->with(['error' => 'У вас нет прав для списка слайдеров']);
        }

        $sliders = Slider::all();

        $this->view('slider::admin.index');

        return $this->render(compact('sliders'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_SLIDERS')) {
            return back()->with(['error' => 'У вас нет прав для добавление слайдера']);
        }

        $title = 'Добавление слайдера';
        $countries = Country::all();

        $this->view('slider::admin.create');

        return $this->render(compact('title', 'countries'));
    }

    public function store(SliderRequest $request)
    {
        $result = Slider::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.sliders.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_SLIDERS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование слайдера']);
        }

        $title = 'Редактирование слайдера';
        $slider = Slider::find($id);
        $countries = Country::all();

        if ($slider->img) {
            $slider->resized_image = CImage::resize($slider->img, 500, 300);
        }

        $this->view('slider::admin.edit');

        return $this->render(compact('title', 'countries', 'slider'));
    }

    public function update(SliderRequest $request, $id)
    {
        $result = Slider::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.sliders.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_SLIDERS')) {
                return back()->with(['error' => 'У вас нет прав для удаление слайдера']);
            }
        }

        $result = Slider::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.sliders.index')->with($result);
    }
}
