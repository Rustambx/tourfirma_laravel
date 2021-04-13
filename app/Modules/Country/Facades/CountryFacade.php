<?php

namespace App\Modules\Country\Facades;

use Illuminate\Support\Facades\Facade;

class CountryFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'country';
    }
}
