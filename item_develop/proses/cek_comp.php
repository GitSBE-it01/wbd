<?php
/*
    $query = 'SELECT 
        distinct(pt.pt_part) as item_number,
        pt.pt_desc1 as desc1,
        pt.pt_desc2 as desc2,
        ptp.ptp_site as item_site,
        pt.pt_status as item_status,
        pt.pt_prod_line as prod_line,
        ptp.ptp_pm_code as pm_code,
        ptp.ptp_buyer as buyer,
        ro.ro_routing as rout_cek,
        ps.ps_par as bom_cek
    FROM dbqad_live.pt_mstr pt 
    RIGHT JOIN dbqad_live.ptp_det ptp 
        on pt.pt_part = ptp.ptp_part
    LEFT JOIN dbqad_live.ps_mstr ps 
        on pt.pt_part = ps.ps_par
    LEFT JOIN dbqad_live.ro_det ro 
        on pt.pt_part = ro.ro_routing
    WHERE pt.pt_status ="develop"
    GROUP BY pt.pt_part';
*/

function detail_item_dev() {
    $query = "SELECT 
            DISTINCT(pt_part) as item_number,
            pt_desc1 as desc1,
            pt_desc2 as desc2,
            ptp_site as item_site,
            pt_status as item_status,
            pt_prod_line as prod_line,
            ptp_pm_code as pm_code,
            ptp_buyer as buyer,
            ro_routing as rout_cek,
            ps_par as bom_cek
        FROM pub.pt_mstr pt 
        RIGHT JOIN pub.ptp_det ptp 
            on pt.pt_part = ptp.ptp_part
        LEFT JOIN pub.ps_mstr ps 
            on pt.pt_part = ps.ps_par
        LEFT JOIN pub.ro_det ro 
            on pt.pt_part = ro.ro_routing
        WHERE pt_status ='DEVELOP'
        WITH (NOLOCK, READPAST NOWAIT)";
    $data = odbc_qad::execQuery($query,'');
    echo 'cek data QAD ='.count($data).'</br>';
    echo "<pre>";
    print_r(array_slice($data,0,2));
    echo "</pre>";

    $full = [];
    foreach($data as $set) {
        if(isset($set['ITEM_NUMBER'])) {
            if(isset($set['ROUT_CEK'])) {$rt = 'OK';}else{$rt='';}
            if(isset($set['BOM_CEK'])) {$bom = 'OK';}else{$bom='';}
            $dt =[
                "item_number"=>$set['ITEM_NUMBER'],
                "desc1"=>$set['DESC1'],
                "desc2"=>$set['DESC2'],
                "item_site"=>$set['ITEM_SITE'],
                "item_status"=>$set['ITEM_STATUS'],
                "prod_line"=>$set['PROD_LINE'],
                "pm_code"=>$set['PM_CODE'],
                "buyer"=>$set['BUYER'],
                "rout_cek"=>$rt,
                "bom_cek"=>$bom,
                "added"=>date('Y-m-d'),
                "status"=>"open",
                "filter"=>$set['ITEM_NUMBER'].'--'.$set['DESC1'].'--'.$set['DESC2'].'--'.$set['ITEM_SITE'].'--'.$set['ITEM_STATUS'].'--'.$set['PROD_LINE'].'--'.$set['PM_CODE'].'--'.$set['BUYER'].'--'.$rt.'--'.$bom
            ];
            $full[]=$dt;
        }
    }
    unset($data);
    echo 'cek data full ='.count($full).'</br>';
    echo "<pre>";
    print_r(array_slice($full,0,2));
    echo "</pre>";
    $query = "SELECT * FROM db_wbd.id_master";
    $curr_mstr = DB::execQuery($query, '');

    $insert = [];
    $update = [];
    foreach($full as $set) {
        $cek = array_filter($curr_mstr, function($dt) use($set) {
            return $dt['item_number'] === $set['item_number'] && $dt['item_site'] === $set['item_site']  ;
        });
        if(count($cek) >0) {
            foreach($cek as $st) {
                $cekkk = $st['item_number'].'--'.$st['desc1'].'--'.$st['desc2'].'--'.$st['item_site'].'--'.$st['item_status'].'--'.$st['prod_line'].'--'.$st['pm_code'].'--'.$st['buyer'].'--'.$st['rout_cek'].'--'.$st['bom_cek'];
                if($cekkk !== $set['filter']) {
                    $dd['status'] = 'close';
                    $dd['close_date'] = date('Y-m-d');
                    $dd['item_number'] = $st['item_number'];
                    $update[] = $dd;
                }
            }
        } else {
            $dd = $set;
            unset($dd['filter']);
            $insert[]=$dd;
        }
    }
    echo 'cek data insert ='.count($insert).'</br>';
    echo 'cek data update ='.count($update).'</br>';
    echo "<pre>";
    print_r(array_slice($insert,0,2));
    print_r(array_slice($update,0,2));
    echo "</pre>";


    $msg = 'process data = </br>';
    if(count($insert)>0) {
        $query = 'INSERT INTO db_wbd.id_master(
            item_number,
            desc1,
            desc2,
            item_site,
            item_status,
            prod_line,
            pm_code,
            buyer,
            rout_cek,
            bom_cek,
            added,
            status
            )
                VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)
        ';
        $ins_process = DB::execQuery($query,'ssssssssssss', $insert);
        echo $ins_process;
        if($ins_process === 'success'){
            $msg .= $ins_process." inserting ".count($insert)." data utk tanggal ".date('Y-m-d').'</br>';
        }
    }

    if(count($update)>0) {
        $query = 'UPDATE db_wbd.id_master SET
                status=?,
                close_date=?
            WHERE 
                item_number=?
        ';
        $upd_process = DB::execQuery($query,'sss', $update);
        echo $upd_process;
        if($upd_process === 'success'){
            $msg .= $upd_process." inserting ".count($update)." data utk tanggal ".date('Y-m-d').'</br>';
        }
    }
    echo $msg."</br>";  
    echo '
    <script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
    <script type="module">
        import {send_email} from "../3.utility/index.js"
        const data ='.json_encode($full).';
        console.log(data);
        let fix = "<table><tr><th>item number</th><th>Deskripsi</th><th>site</th><th>status</th><th>p/m</th><th>BOM</th><th>routing</th></tr>";
        data.forEach(dt=>{
            fix += "<tr><td>"+dt.item_number+"</td><td>"+dt.desc1+"</td><td>"+dt.item_site+"</td><td>"+dt.item_status+"</td><td>"+dt.pm_code+"</td><td>"+dt.bom_cek+"</td><td>"+dt.rout_cek+"</td></tr>";
        })
        fix += "</table>";
        const link = `download data : <a href="http://informationsystem.sbe.co.id:62898/wbd/item_develop/file_dl.html">http://informationsystem.sbe.co.id:62898/wbd/item_develop/file_dl.html</a></br>`;
        send_email({
            to: "mkt.yenny@sbe.co.id, spec.anggrek@sbe.co.id, it.robby@sbe.co.id", 
            subject: "Item Develop", 
            body : link+fix
        });
    </script>';
    unset($full);
    return;
}

?>
















