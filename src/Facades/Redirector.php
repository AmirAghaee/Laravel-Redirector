<?php

namespace AmirAghaee\Redirector\Facades;

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Collection;

/**
 * Class Redirector
 *
 * @method static get(string $route)
 * @method static bool set(string $route, int $status, $endpoint = null)
 * @method static Collection all()
 * @method static bool  delete(string $route)
 *
 */
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
