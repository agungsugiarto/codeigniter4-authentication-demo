<?php

namespace App\Models\Traits;

use CodeIgniter\Exceptions\PageNotFoundException;

trait QueryTrait
{
    /**
     * Get the first record matching the attributes or create it.
     * 
     * @param  array  $attributes
     * @param  array  $values
     * @return mixed
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        if (!is_null($intance = $this->where($attributes)->first())) {
            return $intance;
        }

        $this->insert($attributes + $values);

        return $this->find($this->insertID);
    }

    /**
     * Execute the query and get the first result or throw an exception.
     *
     * @param  array  $columns
     * @return mixed
     *
     * @throws PageNotFoundException
     */
    public function firstOrFail($columns = ['*'])
    {
        if (!is_null($model = $this->select($columns)->first())) {
            return $model;
        }

        throw PageNotFoundException::forPageNotFound();
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  array|int|string  $id
     * @param  array  $columns
     * @return mixed
     *
     * @throws PageNotFoundException
     */
    public function findOrFail($id, $columns = ['*'])
    {
        $result = $this->select($columns)->find($id);

        if (is_array($id)) {
            if (count($result) === count(array_unique($id))) {
                return $result;
            }
        } elseif (!is_null($result)) {
            return $result;
        }

        throw PageNotFoundException::forPageNotFound();
    }

    /**
     * Insert or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        if (is_null($instance = $this->where($attributes)->first())) {
            $id = $this->insert($attributes + $values);

            return $this->find($id);
        }

        $this->update($instance->id, $values);

        return $this->find($instance->id);
    }

    /**
     * Apply the callback if the given "value" is truthy.
     *
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return $this
     */
    public function when($value, $callback, $default = null)
    {
        if ($value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
        }

        return $this;
    }

    /**
     * Apply the callback if the given "value" is falsy.
     *
     * @param  mixed  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return $this
     */
    public function unless($value, $callback, $default = null)
    {
        if (!$value) {
            return $callback($this, $value) ?: $this;
        } elseif ($default) {
            return $default($this, $value) ?: $this;
        }

        return $this;
    }
}
