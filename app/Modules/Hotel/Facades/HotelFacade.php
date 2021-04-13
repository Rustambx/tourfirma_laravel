<?php

namespace App\Modules\Hotel\Facades;

use Illuminate\Support\Facades\Facade;

class HotelFacade extends Facade
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
        return 'hotel';
    }
}
