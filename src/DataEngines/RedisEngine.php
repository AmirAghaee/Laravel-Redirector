<?php


namespace AmirAghaee\Redirector\DataEngines;


use Illuminate\Support\Facades\Redis;

class RedisEngine implements DataEngine
{

    public function delete(string $key): bool
    {
        Redis::delete('redirector:' . $key);
        return true;
    }

    public function all(): array
    {
        $keys = Redis::keys('redirector:*');
        $export = [];
        foreach ($keys as $key) {
            $key = preg_replace('/.*:/', '', $key);
            $export[$key] = $this->get($key);
        }
        return $export;
    }

    public function set(string $route, $status, $value = null): bool
    {
        Redis::hmset('redirector:' . $this->clearUrlRoute($route), ['route' => $value, 'status' => $status]);
        return true;
    }

    public function exists(string $key): bool
    {
        $allRoutes = $this->all();
        return array_key_exists($key, $allRoutes);
    }

    public function get(string $route)
    {
        return Redis::hgetall('redirector:' . $route);
    }

    public function fresh(): bool
    {
        $keys = Redis::keys('redirector:*');
        foreach ($keys as $key) {
            $key = preg_replace('/.*:/', '', $key);
            Redis::del('redirector:' . $key);
        }
        return true;
    }

    protected function clearUrlRoute($route): string
    {
        $route = parse_url($route);
        $path = $route['path'];
        $query = isset($route['query']) ? ('?' . $route['query']) : '';
        return $path . $query;
    }
}
