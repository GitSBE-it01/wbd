<?php

function createSelect($selArray) {
    $init = "<select ";
    if (isset($selArray['data']) && count($selArray['data'])>0) {
        foreach($selArray['data'] as $key=>$value) {
            $data = "data-" . $key ."='" . $value . "' " ;
            $init .= $data;
        }
    }
    $id = "";
        if(isset($selArray['id']) && $selArray['id'] !=='') {$id = "id='" . $selArray['id'] . "' ";}
    $disable = "";
        if(isset($selArray['id'])) {$disable = "disabled ";}
    $class = "class='w-4 bg-transparent' ";
        if($selArray['style'] !== '') {$class = "class='" . $selArray['style'] . "' " ;}

    $finish = $init.$id.$class.$disable.">
            <option value=''></option>
        </select>";
    return $finish;
}

/*
$dtlistArr = [
        'target'=> `body`, 
        'ID' => '',
        'src' =>src,
        "style"=> {
            dtlist: 'w-[50%] h-[90%] ml-4 pl-4 top-[1vh] rounded scrollable absolute bg-slate-400 z-40 hidden right-8 whitespace-pre-line',
            separator: 'w-[50%] h-[.2vh] bg-blue-200 flex items-center my-2'
        },
        'field' => ['no seri = sn_id', 'kategori alat = new_subcat', 'asset = no_asset', 'deskripsi alat = _desc']
    ]
*/