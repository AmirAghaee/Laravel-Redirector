<?php

namespace AmirAghaee\Redirector;

use AmirAghaee\Redirector\DataEngines\DataEngine;
use AmirAghaee\Redirector\DataEngines\EloquentEngine;
use AmirAghaee\Redirector\DataEngines\RedisEngine;
use Exception;

class Redirector
{
    /**
     * @var DataEngine
     */
    protected $connection;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->connection = $this->determineConnection(config('redirector.engine') ?? 'redis');
    }

    /**
     * @throws Exception
     */
    protected function determineConnection($name)
    {
        $connections = [
            'redis' => RedisEngine::class,
            'eloquent' => EloquentEngine::class
        ];

        if (!array_key_exists($name, $connections)) {
            throw new Exception("(Redirector) The selected engine `$name` is not supported! Please correct this issue from config/redirector.php.");
        }

        return app($connections[$name]);
    }

    /**
     * get details of specific route
     * @param string $route
     * @return mixed
     */
    public function get(string $route)
    {
        return $this->connection->get($route);
    }

    /**
     * set new route
     * @param string $route
     * @param $value
     * @param integer $status
     * @return mixed
     */
    public function set(string $route, int $status, $value = null)
    {
        return $this->connection->set($route, $status, $value);
    }

    /**
     * get all routes
     * @return mixed
     */
    public function all()
    {
        return $this->connection->all();
    }

    /**
     * remove specific route
     * @return mixed
     */
    public function delete(string $route)
    {
        return $this->connection->delete($route);
    }

    /**
     * refresh database
     * @return mixed
     */
    public function fresh()
    {
        return $this->connection->fresh();
    }

}
