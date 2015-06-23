<?php
namespace Form;

class FormSelectField extends FormOptionsFields
{
    /**
     * @return string All options in HTML
     */
    protected function getOptions(){
        $ret = '';
        foreach ($this->options as $option){
            $ret .= "<option value='{$option['value']}'";
            if ($option['selected'])
                $ret .= ' selected';
            $ret.= ">{$option['content']}</option>";
        }
        return $ret;
    }

    function hydrate($value){
        foreach ($this->options as $key => $option){
            if ($option['selected'])
                $this->options[$key]['selected'] = false;
            if ($option['value'] == $value)
                $this->options[$key]['selected'] = true;
        }
    }

    function render(){
        return "<select name='{$this->name}' {$this->getAttribs()}>{$this->getOptions()}</select>";
    }
}