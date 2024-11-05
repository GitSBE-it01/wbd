<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

function parent_item_dev() {
    $query = "SELECT * FROM dbspec_3.abor_main WHERE closed_date !=''";
    $abor = DB::execQuery($query, '');
    echo 'jumlah data abor = '.count($abor)."</br>";

    $query = "SELECT * FROM dbqad_live.pt_mstr";
    $item_all = DB::execQuery($query, '');
    $item =  array_filter($item_all, function($dt) {
        return $dt['pt_status'] === 'DEVELOP';
    });
    echo 'jumlah data item develop = '.count($item)."</br>";

    $query = "SELECT * FROM qad_ebom.ebom WHERE parent_item LIKE '1%'";
    $all_bom = DB::execQuery($query, '');
    echo 'jumlah data ebom = '.count($all_bom)."</br>";

    $parent =[];
    foreach($item as $set ) {
        $cek_parent = array_filter($all_bom, function($dt) use($set) {
            return $dt['component_item'] === $set['pt_part'];
        });
        if(count($cek_parent)>0) {
            foreach($cek_parent as $st ) {
                $fix_dt['parent'] = $st['parent_item'];
                $fix_dt['parent_desc'] = $st['parent_desc'];
                $fix_dt['comp'] = $st['component_item'];
                $fix_dt['comp_desc'] = $st['component_desc'];
                $fix_dt['status_item'] = $set['pt_status'];
                $fix_dt['buyer_planner'] = $set['pt_buyer'];
                $fix_dt['status_isir'] = $set['pt__chr01'];
                $fix_dt['need_isir'] = $set['pt__log01'];
                $fix_dt['finishing'] = $set['pt__chr08'];
                $fix_dt['construction'] = $set['pt__chr07'];
                $fix_dt['material'] = $set['pt_drwg_loc'];
                $parent[] = $fix_dt;
            }
        }
    }

    echo 'jumlah data item dengan comp item develop = '.count($parent);
    $result = [];
    $fltr_cek = [];
    foreach($parent as $set) {
        $fltr = $set['parent'].'__'.$set['comp'];
        $cek_fltr = array_filter($fltr_cek, function($dt) use($fltr) {
            return $dt === $fltr;
        });
        if(count($cek_fltr) === 0 ){
            $fltr_cek[] = $fltr;
            $data['code'] =$set['parent'].'__'.$set['comp'];
            $data['parent'] =$set['parent'];
            $data['parent_desc'] =$set['parent_desc'];
            $data['comp']=$set['comp'];
            $data['comp_desc']=$set['comp_desc'];
            $data['status_item_comp']=$set['status_item'];
            $data['buyer_planner']=$set['buyer_planner'];
            $data['status_isir']=$set['status_isir'];
            $data['need_isir']=$set['need_isir'];
            $data['finishing']=$set['finishing'];
            $data['construction']=$set['construction'];
            $data['material']=$set['material'];
            $cek_abor = array_filter($abor, function($dt) use($set) {
                return $dt['release_itemnumber'] === $set['parent'];
            });
            if(count($cek_abor) >0) {
                foreach($cek_abor as $st) {
                    $new_dt = DateTime::createFromFormat('H:i:s d/m/Y', $st['closed_date']);
                    $data['bom_release_date'] = $new_dt->format('Y-m-d'); 
                    $data['age'] = floor((strtotime(date('Y-m-d')) - strtotime($new_dt->format('Y-m-d')))/86400);
                }
            } else {
                $data['bom_release_date'] = '';
                $data['age'] = 0;
            }
            $data['status'] = 'open';
            $result[] =$data;
            unset($data);
        }
    }
    unset($parent);
    /*

    $query = 'INSERT INTO db_wbd.id_dtl_parent(
	    code,
	    parent,
	    parent_desc,
	    comp,
	    comp_desc,
	    status_item_comp,
	    buyer_planner,
	    status_isir,
	    need_isir,
	    finishing,
	    construction,
	    material,
	    bom_release_date,
	    age,
        status)
       VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ';
echo '<pre>';
print_r(array_slice($result,0,5));
echo '</pre>';
    $insert = DB::execQuery($query,'sssssssssssssis', $result);
    echo $insert;
    if($insert === 'success'){
        $msg = $insert." inserting ".count($result)." data utk tanggal ".date('Y-m-d').'</br>';
    }
    
    echo $msg.'</br>jumlah data item dengan comp item develop = '.count($result);
*/

    echo "
    <head>
        <title>item develop</title>
    </head>
    <body>
    <script src='../assets/template/library/sheetjs/xlsx.full.min.js'></script>
    <script>
        const result =".json_encode($result).";
        console.log(result);
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(result);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'item_dev');
        XLSX.writeFile(workbook, 'data.xlsx')
    </script>
    </body>";
    unset($result);
    return;
}
?>