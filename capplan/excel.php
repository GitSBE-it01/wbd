<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
require_once 'D:/xampp/htdocs/wbd/2.backend/data_process/cache_data.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/middleware/index.php';
require_once 'D:/xampp/htdocs/wbd/2.backend/model/index.php';

echo "====================================================================</br>";
echo "testing</br>";
echo "====================================================================</br>";
$start_time = microtime(true);
set_time_limit(3600);
    $query = "SELECT 
       wo_part as item_number,
            pt_desc1 as desc1,
            pt_desc2 as desc2,
            wo_lot as ID,
            wo_routing as routs, 
            wo__chr03 as fixed_r,
            case 
                when wo__chr03='YES' then wr_op
                else ro_op
            end as operation,
            case 
                when wo__chr03='YES' then wr_desc
                else ro_desc
            end as op_desc,
            case 
                when wo__chr03='YES' then wr_wkctr
                else ro_wkctr
            end as work_center,
            ro__chr01 as work_center2,
            ro_start as start_dt,
            ro_end as end_dt,
            case 
                when wo__chr03='YES' then wr_run
                else ro_run
            end as std_run,
            case 
                when wo__chr03='YES' then (wr_run * wr_qty_ord)
                else (ro_run * wo_qty_ord)
            end as total_run_time_mhr,
            wo_qty_ord as qty_ord_wo,
            wo_qty_comp as qty_complete_wo,
            (wo_qty_ord-wo_qty_comp) as qty_open_wo,
            case 
                when wo__chr03='YES' then wr_qty_ord
                else wo_qty_ord 
            end as qty_ord_ops,
            case 
                when wo__chr03='YES' then wr_qty_comp
                else 0 
            end as qty_complete_ops,
            case 
                when wo__chr03='YES' then wr_qty_ord - (wr_qty_comp+wr_sub_comp)
                else wo_qty_ord
            end as qty_open_ops,
            ro_men_mch as run_crew,
            ro_setup as setup
        FROM pub.wo_mstr wo
        LEFT JOIN pub.wr_route wr 
            ON wo.wo_lot = wr.wr_lot
        JOIN pub.pt_mstr pt 
            ON wo.wo_part = pt.pt_part
        JOIN pub.ro_det ro 
            ON wo.wo_routing = ro.ro_routing 
        WHERE 
            (wo_status = 'R' OR wo_status = 'F')
            AND ro_end > '2024-11-07'
        WITH (NOLOCK, READPAST NOWAIT)";
    $data = odbc_qad::execQuery($query,'');
    echo 'jumlah data = '.count($data);
    /*
        $query = 'SELECT 
                    wr_lot as ID,
                    wr_op as ops,
                    wr_run as std_run 
                FROM pub.wr_route wr
                JOIN pub.wo_mstr wo
                    ON wr.wr_lot = wo.wo_lot
                WHERE wo__chr03 ="YES"
                WITH (NOLOCK, READPAST NOWAIT)';
        $data2 = odbc_qad::execQuery($query,'');
    */
    echo '<pre>';
    print_r(array_slice($data,0,1));
    echo '</pre>';
   /*
    $result = [];

    foreach($data as $set) {
        $cek = array_filter($data2, function($dt) use($set) {
            return $dt['ID'] === $set['wr_lot'];
        });
        $dd = $set;
        if(count($cek)>0) {
            echo count($cek);
            echo '<pre>';
            print_r($cek);
            echo '</pre>';
        }
    }
*/
 echo "
    <head>
        <title>data worb inan</title>
    </head>
    <body>
    <script src='../assets/template/library/sheetjs/xlsx.full.min.js'></script>
    <script>
        const data =".json_encode($data).";
        console.log(data);
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(data);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'data_intersite');
        XLSX.writeFile(workbook, 'data.xlsx')
    </script>
    </body>";
$end_time = microtime(true);
$elapsed_time = $end_time - $start_time;
echo "Time of Process: " . number_format($elapsed_time, 2) . " seconds </br>";
echo "********************************************************************</br></br>";

/*        

        
        */