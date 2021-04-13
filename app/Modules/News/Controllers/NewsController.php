<?php

namespace App\Modules\News\Controllers;

use App\Http\Controllers\Controller;
use News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();

        $this->view('news::index');

        return $this->render(compact('news'));
    }

    public function show($id)
    {
        $news = News::find($id);

        $this->view('news::show');

        return $this->render(compact('news'));
    }
}
