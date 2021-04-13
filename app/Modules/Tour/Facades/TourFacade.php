<?php

namespace App\Modules\Tour\Facades;

use Illuminate\Support\Facades\Facade;

class TourFacade extends Facade
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
        return 'tour';
    }
}
