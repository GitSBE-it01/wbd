<?php

class Component {
    private $element;
    private $end;
    public $class;
    public $type_attr;
    public $id;
    public $for;
    public $name;
    public $list;
    public $require;
    public $placeholder;
    public $disable;
    public $select;
    public $data_attr;
    public $cols;
    public $rows;
    public $autocomplete;
    public $maxlength;
    public $value;
    public $href;
    public $body;

    public function __construct($array) {
        $this->element = $array['element'];
        $this->class = isset($array['class']) ? "class='".$array['class']."' " : '';
        $this->type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : '';
        $this->id = isset($array['id']) ? "id='".$array['id']."' " : '';
        $this->for = isset($array['for']) ? "for='".$array['for']."' " : '';
        $this->name = isset($array['name']) ? "name='".$array['name']."' " : '';
        $this->list = isset($array['list']) ? "list='".$array['list']."' " : '';
        $this->placeholder = isset($array['placeholder']) ? "placeholder='".$array['placeholder']."' " : '';
        $this->disable = isset($array['disable']) ? "disabled " : '';
        $this->select = isset($array['select']) ? "selected " : '';
        $this->require = isset($array['require']) ? "required " : '';
        $this->value = isset($array['value']) ? "value='".$array['value']."' " : '';
        $this->cols = isset($array['cols']) ? "colspan='".$array['cols']."' " : '';
        $this->rows = isset($array['rows']) ? "rowspan='".$array['rows']."' " : '';
        $this->autocomplete = isset($array['autocomplete']) ? "autocomplete='".$array['autocomplete']."' " : '';
        $this->maxlength = isset($array['maxlength']) ? "maxlength='".$array['maxlength']."' " : '';
        $this->href = isset($array['href']) ? "href='".$array['href']."' " : '';
        $this->body = '';
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val) {
                    $this->body .= $val;
                }
            } else {
                $this->body = $array['body'];
            }
        }
        $this->end = isset($array['end']) ? true : false;
        $this->data_attr = '';
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val2) {
                $data_att = explode('::', $val2);
                $this->data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        }
        return;
    }

    public function create($array) {
        $id = isset($array['id']) ? "id='".$array['id']."' " : $this->id;
        $for = isset($array['for']) ? "for='".$array['for']."' " : $this->for;

        $name = isset($array['name']) ? "name='".$array['name']."' " : $this->name;

        $type_attr = isset($array['type_attr']) ? "type='".$array['type_attr']."' " : $this->type_attr;

        $list = isset($array['list']) ? "list='".$array['list']."' " : $this->list;

        $placeholder = isset($array['placeholder']) ? "placeholder='".$array['placeholder']."' " : $this->placeholder;

        $value = isset($array['value']) ? "value='".$array['value']."' " : $this->value;

        $href = isset($array['href']) ? "href='".$array['href']."' " : $this->href;
        $autocomplete = isset($array['autocomplete']) ? "autocomplete='".$array['autocomplete']."' " : $this->autocomplete;
        $cols = isset($array['cols']) ? "colspan='".$array['cols']."' " : $this->cols;
        $rows = isset($array['rows']) ? "rowspan='".$array['rows']."' " : $this->rows;
        $maxlength = isset($array['maxlength']) ? "maxlength='".$array['maxlength']."' " : $this->maxlength;

        $class = isset($array['class']) ? "class='".$array['class']."' " : $this->class;

        $disable = isset($array['disable']) ? "disabled " : $this->disable;
        $select = isset($array['select']) ? "selected " : $this->select;
        $require = isset($array['require']) ? "required " : $this->require;

        $data_attr = '';   
        if(isset($array['data_attr'])) {
            foreach($array['data_attr'] as $val3) {
                $data_att = explode('::', $val3);
                $data_attr .= 'data-'.$data_att[0]."='".$data_att[1]."' ";
            }
        } else {
            $data_attr = $this->data_attr;
        }

        $body = '';   
        if(isset($array['body'])) {
            if(is_array($array['body'])) {
                foreach($array['body'] as $val4) {
                    $body .= $val4;
                }
            } else {
                $body = $array['body'];
            }
        } else {
            $body = $this->body;
        }
        
        if($this->end) {
            $component = "<".$this->element." "
            .$id
            .$for
            .$name
            .$type_attr
            .$list
            .$placeholder
            .$value
            .$href
            .$autocomplete
            .$rows
            .$cols
            .$maxlength
            .$data_attr
            .$require
            .$select
            .$class
            .$disable.">"
            .$body."
            ";
        } else {
            $component = "<".$this->element." "
            .$id
            .$for
            .$name
            .$type_attr
            .$list
            .$placeholder
            .$value
            .$href
            .$autocomplete
            .$rows
            .$cols
            .$maxlength
            .$data_attr
            .$require
            .$select
            .$class
            .$disable.">"
            .$body."
            </".$this->element.">";
        }
        return $component;
    }
}

