<?php


namespace AmirAghaee\Redirector\DataEngines;

use AmirAghaee\Redirector\Models\RedirectorModel;

class EloquentEngine implements DataEngine
{

    public function delete(string $key): bool
    {
        return RedirectorModel::where('source', $key)->first()->delete();
    }

    public function get(string $route): array
    {
        return RedirectorModel::where('source', $route)->first()->toArray();
    }

    public function set(string $route, $status, $value = null): bool
    {
        RedirectorModel::create([
            'source' => $this->clearUrlRoute($route),
            'endpoint' => $this->clearUrlRoute($value),
            'status' => $status,
        ]);
        return true;
    }

    public function exists(string $key): bool
    {
        return RedirectorModel::where('source', $key)->exist();
    }

    public function all()
    {
        return RedirectorModel::all();
    }

    public function fresh()
    {
        return RedirectorModel::truncate();
    }

    protected function clearUrlRoute($route): string
    {
        $route = parse_url($route);
        $path = $route['path'];
        $query = isset($route['query']) ? ('?' . $route['query']) : '';
        return $path . $query;
    }
}
