<?php
/**
 * Created by PhpStorm.
 * User: Ivan Koretskiy aka gillbeits[at]gmail.com
 * Date: 08/07/15
 * Time: 15:39
 */

namespace RPItemDataService\Ornamental;


use Doctrine\Common\Annotations\Reader;

trait ExtendProperties
{
    /** @var Reader  */
    protected $annotationReader;

    public function __construct($obj = [], Reader $annotationReader = null)
    {
        $this->annotationReader = $annotationReader;
        foreach ($obj as $field => $value) {
            $this->__set($field, $value);
        }
    }

    /**
     * @return Reader
     */
    public function getAnnotationReader()
    {
        return $this->annotationReader;
    }

    /**
     * @param $field
     * @return string
     */
    private function camelize($field)
    {
        return strtr(ucwords(strtr($field, array('_' => ' ', '.' => '_ '))), array(' ' => ''));
    }

    public function toArray()
    {
        $properties = [];
        foreach ((new \ReflectionObject($this))->getProperties(\ReflectionProperty::IS_PROTECTED) as $prop) {
            if (($name = $prop->getName()) && $name == 'annotationReader') continue;
            $prop->setAccessible(true);

            if (is_array($value = $prop->getValue($this))) {
                foreach ($value as &$val) {
                    if (is_object($val) && in_array('RPItemDataService\Ornamental\ExtendProperties', class_uses($val))) {
                        $val = $val->toArray();
                    }
                }
            }

            if (is_object($value) && in_array('RPItemDataService\Ornamental\ExtendProperties', class_uses($value))) {
                $value = $value->toArray();
            }

            if (!is_object($value)) {
                $properties[$name] = $value;
            }
        }
        return $properties;
    }

    /**
     * @param \XMLReader $xml
     * @return static
     */
    public static function parseXml(\XMLReader $xml)
    {
        $self = new self();
        $xml = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?>' . $xml->readOuterXml());

        foreach ($xml->attributes() as $attribute => $value) {
            $method = 'set' . $self->camelize($attribute);
            if (method_exists($self, $method)) {
                call_user_func([$self, $method], (string)$value);
            }
        }
        return $self;
    }

    public function __get($name)
    {
        if (property_exists($this, $name))
            return $this->$name;
    }

    public function __set($name, $value)
    {
        if ($this->annotationReader && property_exists($this, $name)) {
            if (($typeAnnotation = $this->annotationReader->getPropertyAnnotation(new \ReflectionProperty($this, $name), "Symfony\Component\Validator\Constraints\Type")) && class_exists($type = $typeAnnotation->type)) {
                $value = new $type($value, $this->annotationReader);
            }
        }
        if (method_exists($this, $setter = "set" . $this->camelize($name))) {
            call_user_func_array([$this, $setter], [$value]);
        } elseif (property_exists($this, $name)) {
            $this->$name = $value;
        }
    }
}