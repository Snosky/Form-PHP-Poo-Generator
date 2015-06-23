<?php
namespace Form;

/**
 * Class Form
 * @package Form
 * Manage and generate html form
 */
class Form extends FormAttribs
{
    protected $method;
    protected $action;
    protected $fields = [];

    function __construct($method = 'post', $action = '.'){
        $this->method = $method;
        $this->action = $action;
    }

    function __toString(){
        return $this->render();
    }
    /**
     * @param string|FormFields $type Field type or instance of FormFields
     * @param string $name Needed if $type != FormFields, name of field
     * @param array $params Params like ['label' => 'value', 'required' => 1]
     * Add new field in the form
     */
    function addField($type, $name = null, $params = []){
        if ($type instanceof FormFields){
            $this->fields[$type->getName()] = $type;
        }
        else if (is_string($type) && !empty($name))
            $this->fields[$name] = $this->createField($type, $name, $params);
    }

    /**
     * @param $type Field type
     * @param $name Field name
     * @param array $params $params Params like ['label' => 'value']
     * @return FormTextField
     * Create new instance of FormFields but isn't add to the form, you need to make $form->addField($instance)
     */
    function createField($type, $name, $params = []){
        if ($type == 'text' || $type == 'password' || $type == 'hidden')
            return new FormTextField($type, $name, $params);
        else if ($type == 'select')
            return new FormSelectField('select', $name, $params);
        else if ($type == 'checkbox')
            return new FormCheckField($type, $name, $params);
        else if ($type == 'radio')
            return new FormRadioField($type, $name, $params);
    }

    /**
     * @param array $values Array name=>value, name need to be the name of a field. Use $_POST is better
     */
    function hydrate(array $values){
        foreach ($values as $name => $value){
            if (isset($this->fields[$name]))
                $this->fields[$name]->hydrate($value);
        }
    }

    /**
     * @return string All HTML Fields
     */
    private function getFields(){
        $ret = '';
        $deco_global = $this->generateDecorator('global');
        foreach ($this->fields as $field) {
            $ret .= $deco_global[0].$field->render().$deco_global[1];
        }
        return $ret;
    }

    /**
     * @return string HTML Form
     */
    function render(){
        return "<form method='{$this->method}' action='{$this->action}' {$this->getAttribs()} >{$this->getFields()}</form>";
    }
}