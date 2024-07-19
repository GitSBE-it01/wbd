<?php
$input_text = new Component([
    'element'=> 'input',
    'type_attr'=> 'text',
    'placeholder'=> 'input text here',
    'class'=> 'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 z-30 shadow-md w-[40vw] my-3',
    'end'=>''
]);

$input_hidden = new Component([
    'element'=> 'input',
    'type_attr'=> 'hidden',
    'end'=>''
]);

$search_bar = new Component([
    'element'=> 'div',
    'class'=> 'w-full h-[5vh] flex flex-row gap-2 bg-slate-950',
    'body'=>[
        $input_text->create([]),
        $button->create(['body'=>'search'])
    ]
]);

$label = new Component([
    'element'=>'label',
]);

$form = new Component([
    'element'=>'form',
]);

function create_input($arr_inp) {
    global $input_text;
    global $label;

    if(isset($arr_inp['label']) && isset($arr_inp['input'])) {
        $lbl = $label->create($arr_inp['label']);
        $inp = $input_text->create($arr_inp['input']);
    } else {
        $val_label = isset($arr_inp['value']) ? $arr_inp['value'] : '';
        $lbl = $label->create([
            'for'=>$arr_inp['id'],
            'data_attr'=>['field::'.$arr_inp['name']],
            'body'=>$val_label
        ]);
        $inp = $input_text->create($arr_inp);
    }
    $all = $lbl.$inp;
    return $all;
}

function create_formset($arr_form) {
    global $form;

    $inpt = '';
    foreach($arr_form['form'] as $set) {
        $inpt .= create_input($set);
    }

    $arr_form['formset']['body'] = $inpt;
    $formset = $form->create($arr_form['formset']);
    
    return $formset;
}
