<?php

namespace App\Modules\Slider\Facades;

use Illuminate\Support\Facades\Facade;

class SliderFacade extends Facade
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
        return 'slider';
    }
}
