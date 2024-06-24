<?php

function table($tableArr) {
    $init = '<table ';
        if (isset($tableArr['data']) && count($tableArr['data'])>0) {
            foreach($tableArr['data'] as $key=>$value) {
                $data = 'data-' . $key .'="' . $value . '" ' ;
                $init .= $data;
            }
        }
    $id = '';
        if(isset($tableArr['id']) && $tableArr['id'] !=='') {$id = 'id="' . $tableArr['id'] . '" ';}
    $tbl_class = 'class="w-full" ';
        if(isset($tableArr['style']) && $tableArr['style'] !== '') {$tblClass = 'class="' . $tableArr['style'] . '" ' ;}
    
    $th_all = '';
    $td_all = '';
    $tr_dt= '';
    for($i=0; $i<count($tableArr['data_array']); $i++) {
        $th_class_dflt = 'class="bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10" ' ;
        if($i === 0) {
            $th_class_dflt = 'class="bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20" ' ;
        }
        $th_all .= theader($tableArr['data_array'][$i], $th_class_dflt);

        $td_class_dflt = 'class="bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10" ' ;
        if($i === 0) {
            $td_class_dflt = 'class="bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20" ' ;
        }
        $tr_dt .= tdata($tableArr['data_array'][$i], $td_class_dflt);
    }

    $header_all = '<tr>' 
        .$th_all
        .'</tr>';

        
    $td_all = $tr_dt * 100;

    $end = '
        </table>
    ';

    $finish = $init 
        .$id
        .$tbl_class 
        .$header_all
        .$td_all
        .$end;
    return $finish;
}

function theader($set, $th_class_dflt) {
    $th ='';
    $th_init = '<th ';
    $th_class = $th_class_dflt;
    if(isset($set['th_style']) && $set['th_style'] === '') {
        $th_class = 'class="' . $set['th_style'] . '" ';
    }
    $th_text ='';
    if(isset($set['header']) && $set['header'] === '') {
        $th_text = '>' . $set['header'];
    }
    $th_end = '</th>';
    $th .= $th_init
        .$th_class
        .$th_text
        .$th_end;
    return $th;
}

function tdata($set, $td_class_dflt) {
    $td ='';
    $td_init = '<td ';
    $td_class = $td_class_dflt;
    if(isset($set['td_style']) && $set['td_style'] === '') {
        $td_class = 'class="' . $set['td_style'] . '" ';
    }
    $td_text ='';
    if(isset($set['header']) && $set['header'] === '') {
        $td_text = '>' . $set['header'];
    }
    $td_end = '</td>';
    $td .= $td_init
        .$td_class
        .$td_text
        .$td_end;
    return $td;
}
/*
    example 
    $btnArr = [
        'data => [
            'detail' => 'main',
            'field' => 'dua',
        ],
        'id'=>'',
        'style'=>''
        'text'=>'',
    ]

    $tableArr = [
        'target'=> ``,
        'table'=> [
            'id'=> '', 
            'style'=> ''
        ],
        'data_src'=> '',
        'hidden_tr'=>'',
        'data_array'=> [
            [
                'type'=>'text', 
                'header'=>'', 
                'field'=> 'id', 
                'pk'=>''
                'header'=>'point',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ],
            [
                'type'=>'text'
                'field'=> 'check_point',
                'header'=>'point',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ],
            [
                'type'=>'text'
                'field'=> 'standard',
                'header'=>'standard',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ],
            [
                'type'=>'text'
                'field'=> 'mod_by',
                'header'=>'Last Mod',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ],
            [
                'type'=>'text'
                'field'=> 'mod_date',
                'header'=>'Mod date',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ],
            [
                'type'=> 'logic'
                'field'=> 'result',
                'id'=>'check_point',
                'header'=>'result',
                'thStyle'=> 'bg-teal-400 border-2 uppercase border-black p-2 sticky top-[4vh] z-10',
                'tdStyle'=>''
            ]
    ]
*/