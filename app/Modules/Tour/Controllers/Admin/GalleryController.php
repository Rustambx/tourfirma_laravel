<?php

namespace App\Modules\Tour\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\Tour\Requests\GalleryRequest;
use Gallery;
use Tour;

class GalleryController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_GALLERIES')) {
            return back()->with(['error' => 'У вас нет прав для списка галереи']);
        }

        $galleries = Gallery::all();

        foreach ($galleries as $gallery) {
            $gallery->resized_image = CImage::resize($gallery->img, 500, 300);
        }

        $this->view('tour::admin.gallery.index');

        return $this->render(compact('galleries'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_GALLERIES')) {
            return back()->with(['error' => 'У вас нет прав для добавление галереи']);
        }

        $title = 'Добавление галереи';
        $tours = Tour::all();

        $this->view('tour::admin.gallery.create');

        return $this->render(compact('tours', 'title'));
    }

    public function store(GalleryRequest $request)
    {
        $result = Gallery::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.galleries.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_GALLERIES')) {
            return back()->with(['error' => 'У вас нет прав для редактирование галереи']);
        }

        $title = 'Редактирование галереи';
        $gallery = Gallery::find($id);
        $tours = Tour::all();

        if ($gallery->img) {
            $gallery->resized_image = CImage::resize($gallery->img, 500, 300);
        }

        $this->view('tour::admin.gallery.edit');

        return $this->render(compact('gallery', 'title', 'tours'));
    }

    public function update(GalleryRequest $request, $id)
    {
        $result = Gallery::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.galleries.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_GALLERIES')) {
                return back()->with(['error' => 'У вас нет прав для удаление галереи']);
            }
        }
        $result = Gallery::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.galleries.index')->with($result);
    }
}
