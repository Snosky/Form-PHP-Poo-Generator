<?php
namespace Form;

class FormTextField extends FormFields
{
    protected $label;
    protected $labelClass;

    public function setLabel($label, $class = null){
        $this->label = $label;
        if (!isset($this->attribs['id']))
            $this->attribs['id'] = $this->name;
        if (isset($class))
            $this->labelClass = $class;
    }

    function hydrate($value){
        $this->setAttrib('value', $value);
    }

    private function generateLabel(){
        return "<label for='{$this->attribs['id']}' class='{$this->labelClass}'>{$this->label}</label>";
    }

    function render(){
        $ret = "<input type='{$this->type}' name='{$this->name}' {$this->getAttribs()}/>";

        if (($deco = $this->generateDecorator('before')))
            $ret = $deco[0].$deco[1].$ret;
        if (($deco = $this->generateDecorator('after')))
            $ret .= $deco[0].$deco[1];

        if (($deco = $this->generateDecorator('input')))
            $ret = $deco[0].$ret.$deco[1];

        if (!empty($this->label)){
            $ret = $this->generateLabel().$ret;
        }

        if (($deco = $this->generateDecorator('global'))){
            $ret = $deco[0].$ret.$deco[1];
        }

        return $ret;
    }
}