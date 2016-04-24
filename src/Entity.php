<?php
namespace Paybox;

/**
 * Base entity class.
 */
abstract class Entity
{
    /**
     * Response data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Sets property.
     *
     * @param  string         $name
     * @param  mixed          $value
     * @return \Paybox\Entity
     */
    public function set($name, $value)
    {
        if (in_array($name, $this->getFields())) {
            $this->data[$name] = $value;
        }

        return $this;
    }

    /**
     * Returns property value.
     *
     * @param  string     $name
     * @param  null       $default
     * @return null|mixed
     */
    public function get($name, $default = null)
    {
        return isset($this->data[$name]) ? $this->data[$name] : $default;
    }

    /**
     * Returns array representation from entity.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }

    /**
     * Constructs entity from array.
     *
     * @param  array          $input
     * @return \Paybox\Entity
     */
    public static function fromArray($input)
    {
        $entity = new static();

        if (is_array($input)) {
            foreach ($input as $name => $value) {
                $entity->set($name, $value);
            }
        }

        return $entity;
    }

    /**
     * Fields available in entity.
     *
     * @return array
     */
    abstract protected function getFields();
}
