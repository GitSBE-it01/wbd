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
    public $data_attr;
    public $cols;
    public $rows;
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
        $this->require = isset($array['require']) ? "required " : '';
        $this->value = isset($array['value']) ? "value='".$array['value']."' " : '';
        $this->cols = isset($array['cols']) ? "colspan='".$array['cols']."' " : '';
        $this->rows = isset($array['rows']) ? "rowspan='".$array['rows']."' " : '';
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
        $cols = isset($array['cols']) ? "colspan='".$array['cols']."' " : $this->cols;
        $rows = isset($array['rows']) ? "rowspan='".$array['rows']."' " : $this->rows;
        $maxlength = isset($array['maxlength']) ? "maxlength='".$array['maxlength']."' " : $this->maxlength;

        $class = isset($array['class']) ? "class='".$array['class']."' " : $this->class;

        $disable = isset($array['disable']) ? "disabled " : $this->disable;
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
            .$rows
            .$cols
            .$maxlength
            .$data_attr
            .$require
            .$class
            .$disable.">"
            .$body;
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
            .$rows
            .$cols
            .$maxlength
            .$data_attr
            .$require
            .$class
            .$disable.">"
            .$body
            ."</".$this->element.">";
        }
        return $component;
    }
}


$button = new Component([
    'element'=> 'button',
    'class'=> 'rounded bg-gray-300 text-sm px-4 my-3 border-2 border-slate-400 shadow-md hover:font-semibold hover:bg-gray-200 h-[1.6rem] duration-300',
    'type_attr'=> 'button',
]);


/* =======================================================
    structure 
======================================================= */
$div = new Component([
    'element'=>'div',
]);

$load = $div->create(['class'=>'loading z-40']);

$nav = new Component([
    'element'=>'nav',
    'class'=>'fixed flex flex-row top-0 bg-slate-950 w-screen h-[5vh]',
]);

$header = new Component([
    'element'=>'header',
    'class'=>'fixed top-[5vh] bg-slate-700 w-screen h-[5vh]'
]);

$main = new Component([
    'element'=>'main',
    'class'=>'fixed flex flex-col top-[10vh] bg-slate-300 w-screen h-[85vh] custom_scroll'
]);

$aside = new Component([
    'element'=>'aside',
    'class'=>'fixed flex flex-row top-[10vh] left-0 bg-teal-700 w-[25vw] h-[85vh]'
]);

$footer = new Component([
    'element'=>'footer',
    'class'=>'fixed bottom-0 bg-slate-500 w-screen h-[5vh]'
]);

/* =======================================================

======================================================= */

$li = new Component([
    'element'=>'li',
    'class'=>'h-full w-[10vw] justify-center items-center flex',
]);

$a = new Component([
    'element'=>'a',
    'class'=>'h-full w-[10vw] text-white justify-center items-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 bg-blue-800 border-blue-300 border-b-4 font-semibold'
]);

$ul = new Component([
    'element'=>'ul',
    'class'=>'w-[63vw] h-full flex flex-row'
]);

$title = new Component([
    'element'=>'h1',
    'class'=>'text-2xl underline h-full w-full pt-2 capitalize font-bold italic text-slate-200 text-right mr-[1vw]'
]);

$form = new Component([
    'element'=>'form',
    'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]'
]);