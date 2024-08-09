<?php
/*
$input_text = new Component([
    'element'=> 'input',
    'type_attr'=> 'text',
    'placeholder'=> 'input text here',
    'autocomplete'=>'off',
    'class'=> 'rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[70%]',
    'end'=>''
]);

$input_hidden = new Component([
    'element'=> 'input',
    'type_attr'=> 'hidden',
    'end'=>''
]);
$input_date = new Component([
    'element'=> 'input',
    'type_attr'=> 'date',
    'end'=>''
]);
*/

$label = new Component([
    'element'=>'label',
    'class'=> 'p-2 w-[30%]',
]);

$input = new Component([
    'element'=> 'input',
    'type_attr'=> 'text',
    'class'=> 'rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[50%]',
    'end'=>''
]);

$input_text = $input->create([
    'placeholder'=> 'input text here',
    'autocomplete'=>'off',
]);

$textarea = new Component([
    'element'=> 'textarea',
    'placeholder'=> 'input text here',
    'autocomplete'=>'off',
    'class'=> 'rounded px-2 h-full focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-full ',
]);

$search_bar = new Component([
    'element'=> 'div',
    'class'=> 'w-full h-[5vh] flex flex-row gap-2 bg-slate-950',
    'body'=>[
        $input->create([]),
        $button->create(['body'=>'search'])
    ]
]);

$form = new Component([
    'element'=>'form',
]);


/* ==========================================================================
    cluster function
 ========================================================================= */
 /* Input Text
 ----------------------------------*/
function create_input($arr_inp) {
    global $input;
    global $label;

    if(isset($arr_inp['label']) && isset($arr_inp['input'])) {
        $lbl = $label->create($arr_inp['label']);
        $inp = $input->create($arr_inp['input']);
    } else {
        $val_label = isset($arr_inp['value']) ? $arr_inp['value'] : '';
        $lbl = $label->create([
            'for'=>$arr_inp['id'],
            'data_attr'=>['field::'.$arr_inp['name']],
            'body'=>$val_label
        ]);
        $inp = $input->create($arr_inp);
    }
    $all = $lbl.$inp;
    return $all;
}

/* Formset
 ----------------------------------*/
function create_formset($array) {
    global $div;
    global $option;
    global $select;
    global $input;
    global $form;

    $formset = $array['formset'];
    $formset['body']= '';
    if(isset($array['div'])) {
        $container = $array['div'];
    } else {
        $container= [
            'class'=>'flex flex-row w-full'
        ];
    }

    foreach($array['form'] as $set) {
        $container['body']='';
        $form_type = $set['type'];
        switch ($form_type) {
            case "select":
                $sel = $set['select'];
                $sel['body']='';
                foreach($set['option'] as $val_opt) {
                    $sel['body'] .= $option->create([
                        'body'=>$val_opt
                    ]);
                }
                $container['body'] .= $select->create($sel);
                break;
            case "hidden":
                $container['body'] .= Comp::input($set['input']);
                break;
            default: 
                $container['body'] .= create_input($set);
        }
        $formset['body'] .= $div->create($container);
    }
    $result = $form->create($formset);
    return $result;
}


function create_filter_form($array) {
    $container = '';

    
}