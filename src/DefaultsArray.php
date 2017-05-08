<?php
/**
 *
 */

namespace JPry;


/**
 *
 *
 * @package JPry
 */
class DefaultsArray implements \ArrayAccess
{
    /**
     * Internal data.
     *
     * @var array
     */
    protected $data;

    /**
     * Array of defaults.
     *
     * @var array
     */
    protected $defaults;

    /**
     * ArrayHelper constructor.
     *
     * @param mixed $data
     */
    public function __construct($data = array())
    {
        $this->data = (array) $data;
    }

    /**
     * Determine if a specific key exists in the array.
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * Get a particular key from the array.
     *
     * If a default has been set for that key and the key was not found, the default will be returned instead.
     *
     * @param mixed $offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        if ($this->offsetExists($offset)) {
            return $this->data[$offset];
        }

        if (array_key_exists($offset, $this->defaults)) {
            return $this->defaults[$offset];
        }

        return null;
    }

    /**
     * Get the value for a particular offset.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * Unset an offset from the array.
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
        unset($this->defaults[$offset]);
    }

    /**
     * Set a default value for a particular offset.
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function setDefault($offset, $value)
    {
        $this->defaults[$offset] = $value;
    }

    /**
     * Set an entire array of defaults.
     *
     * @param array $defaults
     */
    public function setDefaults($defaults)
    {
        $this->defaults = (array) $defaults;
    }
}
