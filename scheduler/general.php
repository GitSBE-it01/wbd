<?php
function cache_qad_data() {
    $query = [
        [
            'query'=>"SELECT *, DATE_FORMAT(STR_TO_DATE(ro_end, '%d/%m/%y'), '%y%m%d') as date2 FROM dbqad_live.ro_det WHERE DATE_FORMAT(STR_TO_DATE(ro_end, '%d/%m/%y'), '%y%m%d') > ".date('ymd')." OR ro_end ='?'",
            'param'=>'qad_rout__fetch_rout_active'
        ],
        [
            'query'=>'SELECT * FROM dbqad_live.wod_det',
            'param'=>'qad_wobb__fetch_wobb'
        ],
        [
            'query'=>'SELECT * FROM dbqad_live.wo_mstr WHERE wo_status="R"',
            'param'=>'qad_wo__fetch_wo_r'
        ],
        [
            'query'=>'SELECT * FROM dbqad_live.pt_mstr',
            'param'=>'qad_item__fetch_item'
        ],
        [
            'query'=>'SELECT * FROM dbqad_live.ld_det',
            'param'=>'qad_loc__fetch_qad_loc'
        ],
        [
            'query'=>'SELECT 
                a.wo_part AS item_number,
                CONCAT(b.pt_desc1," ", b.pt_desc2) AS _desc,
                a.wo_status as _status,
                a.wo_lot as wo_id,
                a.wo_nbr as wo, 
                a.wo_qty_ord as qty_ord,
                a.wo_rel_datex as rel_date,
                a.wo_due_datex as due_date
                FROM dbqad_live.wo_mstr a
                JOIN dbqad_live.pt_mstr b 
                ON a.wo_part = b.pt_part 
                WHERE wo_nbr LIKE "%prot%"',
            'param'=>'qad_wo__fetch_wo_prot_specific_item'
        ],
    ];

    foreach($query as $set) {
        if(!check_cache('general', $set['param'])) {
            delete_cache('general', $set['param']);
            $data = DB::execQuery($set['query'],'');
            cache_data('general', $set['param'], $data);
            echo $set['param']." has ".count($data).' data </br>';
        } else {
            echo $set['param']." already cached</br>";
        }
    }
    return;
}