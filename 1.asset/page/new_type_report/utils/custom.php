<?php

function input_spc ($col_count, $row_count) {
    $all = '';
    $count = 1;
    for($i=0; $i<$row_count; $i++) {
        $row_total = '';
        for($ii=0; $ii<$col_count; $ii++) {
            $input = Comp::input([
                'type_attr'=>'text',
                'placeholder'=>$count,
                'name'=>'result',
                'data_attr'=>['name::no_repeat','id::'.$count],
                'class'=>'rounded border-2 px-2 flex items-center justify-center border-black w-[4vw] hidden'
            ]);
            $count++;
            $row_total .= $input;
        }
        $all .= Comp::div([
            'class'=>'w-full block flex flex-row gap-2',
            'body'=>$row_total
        ]);
    }
    $result = Comp::div([
        'class'=>'w-full h-full p-2 bg-blue-300 gap-2 flex flex-col items-center',
        'body'=>$all
    ]);
    return $result;
}
?>
