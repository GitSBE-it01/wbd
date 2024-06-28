<?php

function table($tableArr) {
    $init = "<table ";
        if (isset($tableArr['table']['data']) && count($tableArr['table']['data'])>0) {
            foreach($tableArr['table']['data'] as $key=>$value) {
                $data = "data-" .$key ."='" .$value ."' ";
                $init .= $data;
            }
        }
    $id = "";
        if(isset($tableArr['table']['id']) && $tableArr['table']['id'] !=="") {$id = "id='" . $tableArr['table']['id'] . "' ";}
    $tbl_class = 'class="w-full" ';
        if(isset($tableArr['table']['style']) && $tableArr['table']['style'] !== "") {$tbl_class = "class='" . $tableArr['table']['style']."' ";}
    
    $th_all = "";
    $td_all = "";
    $tr_dt= "";
    for($i=0; $i<count($tableArr['data_array']); $i++) {
        $th_class_dflt = "class='bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10' " ;
        if($i === 0) {
            $th_class_dflt = "class='bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20' " ;
        }
        $th_all .= theader($tableArr['data_array'][$i], $th_class_dflt);

        $td_class_dflt = "class='bg-slate-300 whitespace-normal border-2 text-sm border-black p-2' ";
        if($i === 0) {
            $td_class_dflt = "class='bg-slate-400 whitespace-normal border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10' ";
        }
        $tr_dt .= tdata($tableArr['data_array'][$i], $td_class_dflt);
    }

    $th_row_class = '';
        if(isset($tableArr['th_row_style']) && $tableArr['th_row_style'] !== "") {$th_row_class = "class='" . $tableArr['th_row_style'] . "' " ;}

    $header_all = "<tr data-id='header' ".$th_row_class.">
        ".$th_all
            ."</tr>";

    $tr_dt_class = "class='w-full hidden' ";
        if(isset($tableArr['td_row_style']) && $tableArr['td_row_style'] !== "") {$tr_dt_class = "class='" . $tableArr['td_row_style'] . "' " ;}

    for($i=0; $i<$tableArr['row_count']; $i++) {
        $td_all .= "<tr data-id='".$i."' ".$tr_dt_class.">
        ".$tr_dt."</tr>
        ";
    }

    $finish = $init.$id.$tbl_class.">
        ".$header_all."
        ".$td_all."</table>";
    return $finish;
}

function theader($set, $th_class_dflt) {
    $th_init = "    <th ";
    $th_class = $th_class_dflt;
    if(isset($set['th_style']) && $set['th_style'] !== "") {
        $th_class = "class='" . $set['th_style'] . "' ";
    }
    $th_text ="";
    if(isset($set['header']) && $set['header'] !== "") {
        $th_text = $set['header']." ";
    }
    $th = $th_init.$th_class.">
                ".$th_text."
            </th>
        ";
    return $th;
}

function tdata($set, $td_class_dflt) {
    $body = "";
    if(!isset($set['type']) || strtolower($set['type']) === 'text') {
        $field = "data-field='".$set['field']."' ";
        $td_class = $td_class_dflt;
        if(isset($set['td_style']) && $set['td_style'] !== "") {
            $td_class = "class='" . $set['td_style']."'> ";
        }
        $body .= $field.$td_class;
    }
    if(isset($set['type']) && strtolower($set['type']) === 'input') {
        $td_class = "class='bg-slate-300 whitespace-normal border-2 text-sm border-black' ";
        if(isset($set['td_style']) && $set['td_style'] !== "") {
            $td_class = "class='" . $set['td_style'] . "' ";
        }
        $body .= $td_class.">
                ".td_input($set);
    }
    if(isset($set['type']) && strtolower($set['type']) === 'set_btn') {
        $td_class = "class='bg-slate-300 whitespace-normal flex flex-row border-2 text-sm border-black' ";
        if(isset($set['td_style']) && $set['td_style'] !== "") {
            $td_class = "class='" . $set['td_style'] . "' ";
        }
        $body .= $td_class.">
                ".td_btn_set($set);
    }
    $td="    <td ".$body."
            </td>
        ";
    return $td;
}
/*
    example 
    $btnArr = [
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>"",
        'style'=>""
        'text'=>"",
    ]

    $tableArr = [
        'target'=> ``,
        'table'=> [
            'id'=> "", 
            'style'=> ""
        ],
        'hidden_tr'=>"",
        'td_row_style'=>"",
        'data_array'=> [
            [
                'type'=>'text', 
                'header'=>"", 
                'field'=> 'id', 
                'pk'=>""
                'header'=>'point',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ],
            [
                'type'=>'text'
                'field'=> 'check_point',
                'header'=>'point',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ],
            [
                'type'=>'text'
                'field'=> 'standard',
                'header'=>'standard',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ],
            [
                'type'=>'text'
                'field'=> 'mod_by',
                'header'=>'Last Mod',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ],
            [
                'type'=>'text'
                'field'=> 'mod_date',
                'header'=>'Mod date',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ],
            [
                'type'=> 'logic'
                'field'=> 'result',
                'id'=>'check_point',
                'header'=>'result',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>""
            ]
    ]
*/