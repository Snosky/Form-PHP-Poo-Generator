<?php
namespace Form;

/**
 * Class FormAttribs
 * @package Form
 * Manage attributes for html tag
 */
abstract class FormAttribs  extends FormDecorators
{
    protected $attribs = [];

    /**
     * @param string $attrib Attribute name
     * @param string $value Attribute value
     */
    function setAttrib($attrib, $value){
        if (isset($this->attribs[$attrib]))
            $this->attribs[$attrib] .= " $value";
        else
            $this->attribs[$attrib] = $value;
    }

    /**
     * @param array $array Attributes array where key is attribute name and value is value
     */
    function setAttribs(Array $array){
        foreach ($array as $attrib => $value)
            $this->setAttrib($attrib, $value);
        //$this->attribs = array_merge($this->attribs, $array);
    }

    /**
     * @param $name Name of the attribute you want
     * @return string Return something like name="value" wrap by space
     */
    function getAttrib($name){
        if (isset($this->attribs[$name]))
            return " $name='{$this->attribs[$name]}' ";
    }

    /**
     * @return string Return something like name1="value1" name2="value2" ... wrap by space
     */
    function getAttribs(){
        if (!empty($this->attribs)){
            $ret = '';
            foreach ($this->attribs as $name => $value)
                $ret .= " $name='$value' ";
            return $ret;
        }
    }
}