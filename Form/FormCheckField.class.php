<?php
namespace Form;

class FormCheckField extends FormTextField
{
    protected $checked = '';

    function hydrate($value){
        if ($value)
            $this->checked = 'checked';
    }

    function render(){
        $ret = "<label><input type='checkbox' name='{$this->name}' {$this->getAttribs()} {$this->checked}>{$this->label}</label>";

        if (($deco = $this->generateDecorator('before')))
            $ret = $deco[0].$deco[1].$ret;
        if (($deco = $this->generateDecorator('after')))
            $ret .= $deco[0].$deco[1];

        if (($deco = $this->generateDecorator('input')))
            $ret = $deco[0].$ret.$deco[1];

        if (($deco = $this->generateDecorator('global'))){
            $ret = $deco[0].$ret.$deco[1];
        }

        return $ret;
    }
}