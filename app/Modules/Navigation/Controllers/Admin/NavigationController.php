<?php

namespace App\Modules\Navigation\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Modules\Navigation\Requests\NavigationRequest;
use Navigation;

class NavigationController extends AdminController
{
    public function index()
    {
        if (!auth()->user()->can('VIEW_ADMIN_MENUS')) {
            return back()->with(['error' => 'У вас нет прав для списка меню']);
        }

        $navigations = Navigation::all();

        $this->view('navigation::admin.index');

        return $this->render(compact('navigations'));
    }

    public function create()
    {
        if (!auth()->user()->can('ADD_MENUS')) {
            return back()->with(['error' => 'У вас нет прав для добавление меню']);
        }

        $title = 'Добавление меню';

        $this->view('navigation::admin.create');

        return $this->render(compact('title'));
    }

    public function store(NavigationRequest $request)
    {
        $result = Navigation::create($request);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.navigations.index')->with($result);

    }

    public function edit($id)
    {
        if (!auth()->user()->can('EDIT_MENUS')) {
            return back()->with(['error' => 'У вас нет прав для редактирование меню']);
        }

        $title = 'Редактирование меню';
        $navigation = Navigation::find($id);

        $this->view('navigation::admin.edit');

        return $this->render(compact('title', 'navigation'));
    }

    public function update(NavigationRequest $request, $id)
    {
        $result = Navigation::update($request, $id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.navigations.index')->with($result);
    }

    public function destroy($id)
    {
        if (env('APP_ENV') != 'testing') {
            if (!auth()->user()->can('DELETE_MENUS')) {
                return back()->with(['error' => 'У вас нет прав для удаление меню']);
            }
        }

        $result = Navigation::destroy($id);

        if (is_array($result) && !empty($result['error'])) {
            return back()->with($result);
        }

        return redirect()->route('admin.navigations.index')->with($result);
    }
}
