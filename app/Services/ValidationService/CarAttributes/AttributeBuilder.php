<?php

namespace App\Services\ValidationService\CarAttributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


abstract class AttributeBuilder
{
    protected Model $model;

    protected string $foreignKey;

    protected string $table;

    protected ?AttributeBuilder $prevBuilder;

    public function __construct(protected string $name, AttributeBuilder $builder = null)
    {
        $this->prevBuilder = $builder;
        $this->model = app($this->getModelClass());
        $this->table = $this->model->getTable();
        $this->foreignKey = $this->getForeignKey();
    }

    abstract protected function getModelClass(): string;

    abstract protected function getForeignKey(): string;

    abstract protected function emptyMessage(): string;

    protected function build(): Builder
    {
        if (empty($this->prevBuilder)) {

            return DB::table($this->table)->where($this->table . '.name', $this->name);
        } else {

            return $this->prevBuilder->build()
                ->join($this->table, $this->prevBuilder->table . '.' . $this->foreignKey, '=', $this->table . '.id')
                ->where($this->table . '.name', $this->name);
        }
    }

    public function exists(): bool
    {
        return $this->build()->exists();
    }

    public function message(): ?string
    {
        return ! $this->exists() ?
            $this->emptyMessage() :
            null;
    }
}
