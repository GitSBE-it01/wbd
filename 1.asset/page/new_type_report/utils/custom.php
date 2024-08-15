<?php

function input_spc ($col_count, $row_count) {
    $all = '';
    $count = 1;
    for($i=0; $i<$row_count; $i++) {
        $row_total = '';
        for($ii=0; $ii<$col_count; $ii++) {
            $input = Comp::input([
                'id'=>$count,
                'type_attr'=>'text',
                'placeholder'=>$count,
                'class'=>'rounded border-2 mx-2 mt-2 px-2 border-black w-[5vw]'
            ]);
            $count++;
            $row_total .= $input;
        }
        $all .= Comp::div([
            'class'=>'w-full block',
            'body'=>$row_total
        ]);
    }
    $result = Comp::div([
        'class'=>'w-full h-[50%]',
        'body'=>$all
    ]);
    return $result;
}

$form = input_spc(10,10);



?>
