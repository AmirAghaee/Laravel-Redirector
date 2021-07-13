<?php


namespace AmirAghaee\Redirector\DataEngines;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redis;

class RedisEngine implements DataEngine
{

    public function delete(string $key): bool
    {
        Redis::del('redirector:' . $key);
        return true;
    }

    public function get(string $route): array
    {
        return [
            'source' => $route,
            'endpoint' => Redis::hgetall('redirector:' . $route)['endpoint'],
            'status' => Redis::hgetall('redirector:' . $route)['status']
        ];
    }

    public function set(string $route, $status, $value = null): bool
    {
        Redis::hmset('redirector:' . $this->clearUrlRoute($route), ['endpoint' => $this->clearUrlRoute($value), 'status' => $status]);
        return true;
    }

    public function exists(string $key): bool
    {
        $allRoutes = $this->all();
        return $allRoutes->contains('source', $key);
    }

    public function all(): Collection
    {
        $keys = Redis::keys('redirector:*');
        $export = collect([]);
        foreach ($keys as $key) {
            $key = preg_replace('/.*:/', '', $key);
            $export->push($this->get($key));
        }
        return $export;
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
