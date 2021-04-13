<?php

namespace App\Modules\Country\Controllers;

use App\Http\Controllers\Controller;
use Country;
use Illuminate\Database\Eloquent\Collection;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();

        $this->view('country::index');

        return $this->render(compact('countries'));
    }

    public function show($id)
    {
        $country = Country::find($id);

        $arResult = Country::arResult($country);

        $this->view('country::show');

        return $this->render(compact('country', 'arResult'));
    }
}
