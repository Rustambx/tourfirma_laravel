<?php

namespace App\Modules\Navigation\Facades;

use Illuminate\Support\Facades\Facade;

class NavigationFacade extends Facade
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
        return 'navigation';
    }
}
