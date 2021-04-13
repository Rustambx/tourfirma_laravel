<?php

namespace App\Modules\News\Facades;

use Illuminate\Support\Facades\Facade;

class NewsFacade extends Facade
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
        return 'news';
    }
}
