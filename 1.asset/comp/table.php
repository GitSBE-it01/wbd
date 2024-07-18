<?php
$table = new Component([
    'element'=>'table',
    'class'=>'w-full',
]);

$thead = new Component([
    'element'=>'thead',
]);

$tbody = new Component([
    'element'=>'tbody',
]);

$tfoot = new Component([
    'element'=>'tfoot',
]);

$tr = new Component([
    'element'=>'tr',
]);

$th = new Component([
    'element'=>'th',
    'class'=>'bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10 w-[34vw]'
]);

$td = new Component([
    'element'=>'td',
    'class'=>'bg-slate-300 whitespace-normal border-2 text-sm p-2 border-black w-[34vw]',
]);


function table_create($array) {
    global $table;
    global $thead;
    global $tbody;
    global $tfoot;
    global $tr;
    global $th;
    global $td;
    global $input_text;
    global $input_hidden;
    global $select;
    global $option;
    global $button;
    global $label;

    $_th = '';
    foreach($array['th'] as $val) {
        $_th .= $th->create($val);
    }
    $thd = $thead->create([
        'body'=> $tr->create([
            'data_attr'=>['id::header'],
            'body'=>$_th
        ])
    ]);

    $_tr = $array['tr'];
    $full_tr = '';
    for($i=0; $i<$array['row_count']; $i++) {
        $td_full = '';
        foreach($array['data_array'] as $set) {
            $type_td = $set['type'];
            $_td = '';
            switch ($type_td) {
                case "input":
                    $td_attr = $set['td'];
                    $td_attr['body'] = [
                        $label->create([$set['label']]),
                        $input_text->create($set['inp'])
                    ];
                    $_td = $td->create($td_attr);
                    break;
                case "select":
                    $td_attr = $set['td'];
                    $sel = $set['select'];
                    $sel['body']='';
                    foreach($set['option'] as $val_opt) {
                        $sel['body'] .= $option->create([
                            'body'=>$val_opt
                        ]);
                    }
                    $td_attr['body'] = $select->create($sel);
                    $_td = $td->create($td_attr);
                    break;
                case "set_btn":
                    $td_attr = $set['td'];
                    $td_attr['body'] = '';
                    foreach($set['button'] as $st) {
                        $td_attr['body'] .= $button->create($st);
                    }
                    $_td = $td->create($td_attr);
                    break;
                case "hidden":
                    $_td = $input_hidden->create($set);
                    break;
                default: 
                    $_td = $td->create($set);
            }
            $td_full .= $_td;
        }
        $_tr['body'] = $td_full;
        $_tr['data_attr'] = ['id::'.$i];
        $full_tr .= $tr->create($_tr);
    }
   
    $tbd = $tbody->create(['body'=>$full_tr]);

    $tbl = $table->create([
        'id'=>$array['id'],
        'class'=>$array['class'],
        'body'=>[$thd, $tbd]
    ]);

    return $tbl;
}