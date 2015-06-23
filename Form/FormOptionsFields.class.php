<?php
namespace Form;

abstract class FormOptionsFields extends FormFields
{
    protected $options = [];

    /**
     * @param string $value Option value
     * @param string $content Option text if empty $value is used
     * @param bool $selected True = Option selected
     */
    function setOption($value, $content = null, $selected = false){
        if ($content)
            $this->options[] = ['value' => $value, 'content' => $content, 'selected' => $selected];
        else
            $this->options[] = ['value' => $value, 'content' => $value, 'selected' => $selected];
    }

    /**
     * @param array $array Array of options like ['value'=>'value','content'=>'content','required'=>true]
     */
    function setOptions(array $array){
        foreach ($array as $v){
            $t = ['value' => $v['value'], 'content' => $v['value']];
            if (isset($v['content']))
                $t['content'] = $v['content'];
            if (isset($v['selected']))
                $t['selected'] = true;
            else
                $t['selected'] = false;
            $this->options[] = $t;
        }
    }
}