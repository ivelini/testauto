<?php

namespace App\Models\Catalog\Traits\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * Create or update cache for model
 */
trait CacheTrait
{
    /**
     * Set cache
     * @param CacheTypeEnum $cacheType
     * @return Model
     */
    public function setCache(CacheTypeEnum $cacheType): self
    {
        if(count($this->getAppends()) > 0) {
            array_map(fn($append) => $this->$append ,$this->getAppends());
        }

        //Build key concat class name, caheType and model id
        $key = (new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $this->id;

        Cache::put($key, $this);

        return $this;
    }

    /**
     * Get cache
     * @param CacheTypeEnum $cacheType
     * @param int $id
     * @return Model
     */
    public function getCache(CacheTypeEnum $cacheType, int $id): ?self
    {
        $key = (new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $id;

        return Cache::get($key);
    }

    /**
     * Delete cache
     * @param CacheTypeEnum $cacheType
     * @return Model
     */
    public function deleteCache(CacheTypeEnum $cacheType): self
    {
        Cache::delete((new \ReflectionClass($this))->getShortName() . ':' . $cacheType->name . ':' . $this->id);

        return $this;
    }
}
