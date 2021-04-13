<?php

namespace App\Modules\News\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Lib\File\CImage;
use App\Modules\News\Requests\NewsRequest;
use News;

class NewsController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_NEWS')) {
            return back()->with(['error' => 'У вас нет прав для списка новостей']);
        }

        $news = News::all();

        foreach ($news as $item) {
            $item->resized_image = CImage::resize($item->img, 300, 364);
        }

        $this->view('news::admin.index');

        return $this->render(compact('news'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_NEWS')) {
            return back()->with(['error' => 'У вас нет прав для добавление новостей']);
        }

        $title = 'Добавление новости';

        $this->view('news::admin.create');

        return $this->render(compact('title'));
    }

    public function store(NewsRequest $request)
    {
        $result = News::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.news.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_NEWS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование новостей']);
        }

        $title = 'Редактирование новости';
        $news = News::find($id);

        if ($news->img) {
            $news->resized_image = CImage::resize($news->img, 500, 300);
        }

        $this->view('news::admin.edit');

        return $this->render(compact('title', 'news'));
    }

    public function update(NewsRequest $request, $id)
    {
        $result = News::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.news.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_NEWS')) {
                return back()->with(['error' => 'У вас нет прав для удаление новостей']);
            }
        }

        $result = News::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.news.index')->with($result);
    }
}
