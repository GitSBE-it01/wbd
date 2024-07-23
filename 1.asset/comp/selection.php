<?php

$datalist = new Component([
    'element'=>'datalist',
]);

$select = new Component([
    'element'=>'select',
    'class'=> 'rounded p-2 focus:ring focus:ring-blue-400 focus:ring-width-4 focus:outline focus:outline-blue-400 shadow-md w-[70%]',
]);

$option = new Component([
    'element'=>'option',
]);


/* ==========================================================================
    cluster function
 ========================================================================= */
 /* Selection Text
 ----------------------------------*/
 function create_select($arr_sel) {
    if(isset($arr_sel['label']) && isset($arr_sel['select'])) {
        $lbl = Comp::label($arr_sel['label']);
        $opt_full = '';
        foreach($arr_sel['opt'] as $set) {
            $opt_full .= Comp::option($set);
        }
        $arr_sel['select']['body'] = $opt_full;
        $sel = Comp::select($arr_sel['select']);
    } else {
        $val_label = isset($arr_sel['value']) ? $arr_sel['value'] : '';
        $lbl = Comp::label([
            'for'=>$arr_sel['id'],
            'data_attr'=>['field::'.$arr_sel['name']],
            'body'=>$val_label
        ]);
        $sel = Comp::label($arr_sel);
    }
    $all = $lbl.$sel;
    return $all;
}