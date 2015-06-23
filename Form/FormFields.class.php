<?php
namespace Form;

abstract class FormFields extends FormAttribs
{
    protected $type;
    protected $name;
    protected $required = false;

    function __construct($type, $name, $params = []){
        $this->type = $type;
        $this->name = $name;
        if (!empty($params)){
            foreach ($params as $method => $args){
                $method = 'set'.ucfirst($method);
                if (method_exists($this, $method))
                    $this->$method($args);
            }
        }
    }

    function __toString(){
        return $this->render();
    }

    function getName(){
        return $this->name;
    }

    /**
     * @param bool $required If true add attrib required and on validation can't be empty
     */
    function setRequired($required = true){
        $this->required = $required;
        if ($this->required)
            $this->setAttrib('required', 'required');
    }

    /**
     * @return mixed HTML Input
     */
    abstract function render();

    abstract function hydrate($value);
}