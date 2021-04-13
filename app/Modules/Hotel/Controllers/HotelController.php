<?php

namespace App\Modules\Hotel\Controllers;

use App\Http\Controllers\Controller;
use Hotel;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();

        $this->view('hotel::index');

        return $this->render(compact('hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::find($id);

        $this->view('hotel::show');

        return $this->render(compact('hotel'));
    }
}
