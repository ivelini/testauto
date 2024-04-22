<?php

namespace App\Services\ValidationService\CarAttributes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;


/**
 *  Check exist value for attribute
 *  pattern decorator
 * checks the links of all elements for compliance
 */
abstract class AttributeBuilder
{
    protected Model $model;         // Model current attribute

    protected string $foreignKey;   // Foreign key current attribute table

    protected string $table;        // Table current attribute

    protected ?AttributeBuilder $prevBuilder;   // Wrap class

    /**
     * @param string $name      validation value current attribute
     * @param AttributeBuilder|null $builder    // Wrap class
     */
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

    /**
     * builder
     * if prevBuilder exists then prevBuilder concat join current attribute
     */
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
