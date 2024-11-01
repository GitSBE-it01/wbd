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
function item_develop() {
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
        WHERE pt.pt_status ="develop"';
    $data = DB::execQuery($query,'');
    echo 'cek data awal ='.count($data).'</br>';
    echo "<pre>";
    print_r(array_slice($data,0,2));
    echo "</pre>";
    $query = 'TRUNCATE db_wbd.id_master';
    DB::execQuery($query,'');

    $full = [];
    foreach($data as $set) {
        if($set['rout_cek'] !== null) {$rt = 'OK';}else{$rt='';}
        if($set['bom_cek'] !== null) {$bom = 'OK';}else{$bom='';}
        $dt =[
            "item_number"=>$set['item_number'],
            "desc1"=>$set['desc1'],
            "desc2"=>$set['desc2'],
            "item_site"=>$set['item_site'],
            "item_status"=>$set['item_status'],
            "prod_line"=>$set['prod_line'],
            "pm_code"=>$set['pm_code'],
            "buyer"=>$set['buyer'],
            "rout_cek"=>$rt,
            "bom_cek"=>$bom
        ];
        $full[]=$dt;
    }
    unset($data);
    echo 'cek data awal ='.count($full).'</br>';
    echo "<pre>";
    print_r(array_slice($full,0,10));
    echo "</pre>";
    if(count($full)>0) {
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
            bom_cek)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?,?)
        ';
        $insert = DB::execQuery($query,'ssssssssss', $full);
        echo $insert;
        if($insert === 'success'){
            $msg = $insert." inserting ".count($full)." data utk tanggal ".date('Y-m-d').'</br>';
        }
    } else  {
        $msg = 'data sudah ada utk tgl'.date('Y-m-d');
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
        const link = `download data : <a href="http://informationsystem.sbe.co.id:8080/wbd/item_develop/file_dl.html">http://informationsystem.sbe.co.id:8080/wbd/item_develop/file_dl.html</a></br>`;
        send_email({
            to: "mkt.yenny@sbe.co.id, it.robby@sbe.co.id", 
            subject: "Item Develop", 
            body : link+fix
        });
    </script>';
    return;
}

?>
















