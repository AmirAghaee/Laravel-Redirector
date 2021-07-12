<?php

namespace AmirAghaee\Redirector\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Redirector
 *
 * @method static get(string $route)
 * @method static set(string $route, int $status, $endpoint = null): bool
 * @method static all(): Collection
 * @method static delete(string $route): bool
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
