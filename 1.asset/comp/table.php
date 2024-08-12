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
    $_th = '';
    foreach($array['data_array'] as $set) {
        if(isset($set['th'])) {
            $_th .= Comp::th($set['th']);
        }
    }
    $thd = Comp::thead([
        'body'=> Comp::tr([
            'data_attr'=>['id::header'],
            'body'=>$_th
        ])
    ]);
    
    $count = 0;
    $_tr = '';
    if(isset($array['tr'])) {
        $_tr = $array['tr'];
    }

    $full_tr = '';
    for($i=0; $i<$array['row_count']; $i++) {
        $td_full = '';
        foreach($array['data_array'] as $set) {
            $type_td = $set['type'];
            $_td = '';
            switch ($type_td) {
                case "input":
                    $td_attr = $set['td'];
                    $set['inp']['id'] = $set['inp']['name']."__".$array['id'].$i;
                    $td_attr['body'] = [
                        create_input($set['inp'])
                    ];
                    $_td = Comp::td($td_attr);
                    break;
                case "select":
                    $td_attr = $set['td'];
                    $set['select']['id'] = $set['select']['name']."__".$array['id'].$i;

                    $val_label = isset($set['select']['value']) ? $set['select']['value'] : '';
                    $lbl = [
                        'for'=>$set['select']['id'],
                        'data_attr'=>['field::'.$set['select']['name']],
                        'body'=>$val_label
                    ];
                    $td_attr['body'] = Comp::label($lbl);

                    $sel = $set['select'];
                    $sel['body']='';
                    foreach($set['option'] as $val_opt) {
                        $sel['body'] .= Comp::option($val_opt);
                    }
                    $td_attr['body'] .= Comp::select($sel);
                    $_td = Comp::td($td_attr);
                    break;
                case "set_btn":
                    $td_attr = $set['td'];
                    $td_attr['body'] = '';
                    foreach($set['button'] as $st) {
                        $id = explode('::',$st['data_attr'][0]);
                        $st['id'] = $id[1]."__".$array['id'].$i;
                        $td_attr['body'] .= Comp::button($st);
                    }
                    $_td = Comp::td($td_attr);
                    break;
                case "hidden":
                    $set['class'] = '';
                    $_td = Comp::input($set);
                    break;
                default: 
                    $_td = Comp::td($set['td']);
            }
            $td_full .= $_td;
        }
        $_tr['body'] = $td_full;
        $_tr['data_attr'] = ['id::'.$array['id'].$i];
        $full_tr .= Comp::tr($_tr);
        $count++;
    }
    $tbd = Comp::tbody(['body'=>$full_tr]);

    $tbl = Comp::table([
        'id'=>$array['id'],
        'class'=>$array['class'],
        'body'=>[$thd, $tbd]
    ]);

    return $tbl;
}

function table_create2($array) {
    // setup header
    $_th = '';
    foreach($array['data_array'] as $set) {
        if(isset($set['th'])) {
            $_th .= Comp::th($set['th']);
        }
    }
    $thd = Comp::thead([
        'body'=> Comp::tr([
            'data_attr'=>['id::header'],
            'body'=>$_th
        ])
    ]);



    // setting 
    $trow = '';
    foreach($array['data_array'] as $set) {
        $type_td = $set['type'];
        $_td = '';
        switch ($type_td) {
            case "input":
                $td_attr = $set['td'];
                $set['inp']['id'] = $set['inp']['name']."__".$array['id'].'specifiid';
                $td_attr['body'] = [
                    create_input($set['inp'])
                ];
                $_td = Comp::td($td_attr);
                break;
            case "select":
                $td_attr = $set['td'];
                $set['select']['id'] = $set['select']['name']."__".$array['id'].'specifiid';

                $val_label = isset($set['select']['value']) ? $set['select']['value'] : '';
                $lbl = [
                    'for'=>$set['select']['id'],
                    'data_attr'=>['field::'.$set['select']['name']],
                    'body'=>$val_label
                ];
                $td_attr['body'] = Comp::label($lbl);

                $sel = $set['select'];
                $sel['body']='';
                foreach($set['option'] as $val_opt) {
                    $sel['body'] .= Comp::option($val_opt);
                }
                $td_attr['body'] .= Comp::select($sel);
                $_td = Comp::td($td_attr);
                break;
            case "set_btn":
                $td_attr = $set['td'];
                $td_attr['body'] = '';
                foreach($set['button'] as $st) {
                    $id = explode('::',$st['data_attr'][0]);
                    $st['id'] = $id[1]."__".$array['id'].'specifiid';
                    $td_attr['body'] .= Comp::button($st);
                }
                $_td = Comp::td($td_attr);
                break;
            case "hidden":
                $set['class'] = '';
                $_td = Comp::input($set);
                break;
            default: 
                $_td = Comp::td($set['td']);
        }
        $trow .= $_td;
    }
        
    // setting template tr
    $_tr = '';
    if(isset($array['tr'])) {
        $_tr = $array['tr'];
    }
    $_tr['body'] = $trow;
    $_tr['data_attr'] = ['id::'.$array['id'].'__specifiid'];

    $count_row = !isset($array['row_count']) ? 50 : $array['row_count'];
    $full_tr = str_replace('specifiid','template',Comp::tr($_tr));
    for($i=0; $i<$count_row; $i++) {
        $row = Comp::tr($_tr);
        $mod = str_replace('specifiid', $i,$row);
        $full_tr .= $mod;
    }
    $tbd = Comp::tbody(['body'=>$full_tr]);

    $tbl = Comp::table([
        'id'=>$array['id'],
        'class'=>$array['class'],
        'body'=>[$thd, $tbd]
    ]);

    return $tbl;
}