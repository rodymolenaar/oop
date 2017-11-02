<?php

namespace App\Models;

abstract class Model
{
    protected $attributes = [];

    /**
     * Model constructor.
     * @param mixed $source
     */
    public function __construct($source = null)
    {
        if ($source) {
            $this->setAttributes($source);
        }
    }

    /**
     * Set attributes on the model.
     * @param array $values
     */
    protected function setAttributes($values)
    {
        foreach ((array) $values as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * Get a fresh model instance.
     * @param array $values
     * @return $this
     */
    public function refresh($values)
    {
        return new $this($values);
    }

    public function __get($key)
    {
        if (!isset($this->attributes[$key])) {
            return null;
        }

        return $this->attributes[$key];
    }

    public function __set($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function __isset($key) {
        return array_key_exists($key, $this->attributes);
    }
}
