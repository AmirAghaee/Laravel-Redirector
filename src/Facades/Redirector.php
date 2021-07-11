<?php

namespace AmirAghaee\Redirector\Facades;

use Illuminate\Support\Facades\Facade;

class Redirector extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'redirector';
    }
}
