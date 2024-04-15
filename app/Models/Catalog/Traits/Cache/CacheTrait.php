<?php

namespace App\Models\Catalog\Traits\Cache;

use Illuminate\Support\Facades\Cache;

trait CacheTrait
{
    public function setCache(CacheTypeEnum $cacheType): self
    {
        $key = (new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $this->id;
        Cache::put($key, $this);

        return $this;
    }

    public function getCache(CacheTypeEnum $cacheType, int $id): ?self
    {
        $key = (new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $id;

        return Cache::get($key);
    }

    public function deleteCache(CacheTypeEnum $cacheType): self
    {
        Cache::delete((new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $this->id);

        return $this;
    }
}
