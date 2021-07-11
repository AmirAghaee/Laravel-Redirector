<?php

namespace AmirAghaee\Redirector\DataEngines;


interface DataEngine
{
    public function delete(string $key): bool;

    public function get(string $route);

    public function all();

    public function set(string $route, int $status, $value = null): bool;

    public function exists(string $key): bool;

    public function fresh();

}
