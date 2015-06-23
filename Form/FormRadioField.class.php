<?php
namespace Form;

class FormRadioField extends FormOptionsFields
{
    function hydrate($value){
        foreach ($this->options as $key => $option){
            if ($option['selected'])
                $this->options[$key]['selected'] = false;
            if ($option['value'] == $value)
                $this->options[$key]['selected'] = true;
        }
    }

    private function getOptions(){
        $ret = '';
        foreach ($this->options as $option){
            $ret .= "<label><input type='radio' name='{$this->name}' {$this->getAttribs()} value='{$option['value']}'";
            if ($option['selected'])
                $ret .= " checked";
            $ret .= "/>{$option['content']}</label>";
        }
        return $ret;
    }

    function render(){
        return $this->getOptions();
    }
}