<?php

namespace App\Modules\Navigation\Services;

use App\Modules\Navigation\Models\Navigation;

class NavigationService
{
    public function all()
    {
        $navigations = Navigation::all();

        return $navigations;
    }

    public function find($id)
    {
        $navigation = Navigation::find($id);

        return $navigation;
    }

    public function create($request)
    {
        $data = $request->except('_token');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        if (Navigation::create($data)) {
            return ['status' => 'Меню добавлен'];
        }
    }

    public function update($request, $id)
    {
        $navigation = Navigation::find($id);

        $data = $request->except('_token', '_method');

        if (empty($data)) {
            return ['error' => 'Нет данных'];
        }

        $navigation->fill($data);

        if ($navigation->update()) {
            return ['status' => 'Меню обновлен'];
        }
    }

    public function destroy($id)
    {
        $navigation = Navigation::find($id);

        if ($navigation->delete()) {
            return ['status' => 'Меню удален'];
        }
    }
}
