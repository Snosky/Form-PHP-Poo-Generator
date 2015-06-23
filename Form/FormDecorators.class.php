<?php
namespace Form;

abstract class FormDecorators
{
    protected $decorators = [
        'global'    => [],
        'text'          => [],
        'select'        => [],
        'checkbox'      => [],
        'radio'         => [],
    ];
    protected $deco_field = [];

    function setDecorators($v, $where = 'global'){
        if ($this instanceof Form) {
            if ($where) {
                $this->decorators[$where] = array_merge($this->decorators[$where], $v);
            }
        }
        else if ($this instanceof FormFields) {
            $this->deco_field = array_merge($this->deco_field, $v);
            //echo "<pre>";print_r($this->deco_field); echo "</pre>";
        }
    }

    private function getDecorator($name){
        $d = 'global';
        switch (true){
            case $this instanceof FormCheckField:
                $d = 'checkbox';
                break;
            case $this instanceof FormTextField:
                $d = 'text';
                break;
        }

        if ($d == 'checkbox'){
            echo '<pre>';
            print_r($this->decorators);
            echo '</pre>';
        }

        if (!($this instanceof Form)) {
            if (isset($this->deco_field[$name]))
                return $this->deco_field[$name];
        }
        if (isset($this->decorators[$d][$name]))
            return ($this->decorators[$d][$name]);
        if (isset($this->decorators['global'][$name]))
            return $this->decorators['global'][$name];
    }

    function generateDecorator($name){
        $deco = $this->getDecorator($name);
        if (isset($deco['tag'])){
            $ret = [];
            $tag = $deco['tag'];
            unset($deco['tag']);

            if (isset($deco['content'])){
                $content = $deco['content'];
                unset($deco['content']);
            }

            $ret[0] = "<$tag";
            foreach ($deco as $attr => $v)
                $ret[0] .= " $attr='$v'";
            $ret[0] .= ">";

            if (isset($content))
                $ret[0] .= $content;
            $ret[1] = "</$tag>";
            return $ret;
        }
        return null;
    }


    function decoratorBootstrap(){
        $this->setDecorators([
            'global'    =>  ['tag' => 'div', 'class' => 'form-group']
        ], 'global');

        $this->setDecorators([
            'input'     =>  ['tag' => 'div', 'class' => 'checkbox']
        ], 'checkbox');
        //print_r($this->decorators);
    }
}