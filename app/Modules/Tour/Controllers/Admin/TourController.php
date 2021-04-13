<?php

namespace App\Modules\Tour\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\Tour\Models\Type;
use App\Modules\Tour\Requests\TourRequest;
use Tour;
use Hotel;

class TourController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_TOURS')) {
            return back()->with(['error' => 'У вас нет прав для списка туров']);
        }

        $tours = Tour::all();

        $this->view('tour::admin.index');

        return $this->render(compact('tours'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_TOURS')) {
            return back()->with(['error' => 'У вас нет прав для добавление тура']);
        }

        $title = 'Добавление тура';
        $hotels = Hotel::all();
        $typeTours = Type::all();

        $this->view('tour::admin.create');

        return $this->render(compact('hotels', 'typeTours', 'title'));
    }

    public function store(TourRequest $request)
    {
        $result = Tour::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.tours.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_TOURS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование тура']);
        }

        $title = 'Редактирование тура';
        $tour = Tour::find($id);
        $hotel_id = $tour->ar_hotels->pluck('id')->toArray();
        $hotels = Hotel::all();

        foreach ($hotels as $hotel) {
            if (in_array($hotel->id, $hotel_id)) {
                $hotel->option = true;
            }
        }

        $typeTours = Type::all();

        if ($tour->img) {
            $tour->resized_image = CImage::resize($tour->img, 500, 300);
        }

        $this->view('tour::admin.edit');

        return $this->render(compact('hotels', 'title', 'typeTours', 'tour'));
    }

    public function update(TourRequest $request, $id)
    {
        $result = Tour::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.tours.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_TOURS')) {
                return back()->with(['error' => 'У вас нет прав для удаление тура']);
            }
        }

        $result = Tour::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.tours.index')->with($result);
    }
}
