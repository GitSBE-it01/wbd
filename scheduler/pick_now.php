<?php
function pick_now_sched() {
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    //echo '-------------------</br>';
    //echo 'const data </br>';
        $yesterday = date('Y-m-d', strtotime('yesterday'));
    //echo 'yesterday date = '.$yesterday.'</br>';
        $fix_date = (int)date('ymd');
    //echo 'fix date = '.$fix_date.'</br>';
    //echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data routing (rout) </br>';
        $rout_src = get_cache('general', 'qad_rout__fetch_rout_active');
        $rout =[];
        for($i=0; $i<count($rout_src); $i++) {
            $dt = $rout_src[$i];
            if($dt->ro_end === '?' && strtoupper($dt->ro_wkctr) === 'SUBCONT') {
                $rout[] = get_object_vars($dt);
            }
            if($dt->ro_end !== '?' ) {
                $cekNbr = explode('/',$dt->ro_end);
                $fix = (int)($cekNbr[2].$cekNbr[1].$cekNbr[0]);
                if($fix>$fix_date && strtoupper($dt->ro_wkctr) === 'SUBCONT') {
                    $rout[] = get_object_vars($dt);
                }
            }
        }
        $rout_src =null;
    // echo 'count : '.count($rout).'</br>';
    // echo 'type : '.gettype($rout).'</br>';
    // echo 'type of each data: '.gettype($rout[0]).'</br>';
    // print_r($rout[0]);
    /*
        print_r($rout[1758]);
        echo '</br>';
        print_r(array_slice($rout,0,1));
        echo '</br>';
    */
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data demand (demand)</br>';
        $demand = get_cache('general', 'qad_wobb__fetch_wobb');
    //echo 'count: '.count($demand).'</br>';
    //echo 'type : '.gettype($demand).'</br>';
    //echo 'type of each data : '.gettype($demand[0]).'</br>';
    //print_r($demand[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data wo release (woR)</br>';
        $woR = get_cache('general', 'qad_wo__fetch_wo_r');
    //echo 'count: '.count($woR).'</br>';
    //echo 'type : '.gettype($woR).'</br>';
    //echo 'type of each data : '.gettype($woR[0]).'</br>';
    //print_r($woR[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data lokasi (cekLoc)</br>';
        $query8 = 'SELECT * FROM dbpick_now.loc_dept';
        $cekLoc = DB::execQuery($query8, '');
    //echo 'count: '.count($cekLoc).'</br>';
    //echo 'type : '.gettype($cekLoc).'</br>';
    //echo 'type of each data : '.gettype($cekLoc[0]).'</br>';
    //print_r($cekLoc[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data PIC (pic)</br>';
        $query6 = 'SELECT * FROM dbpick_now.pic_part_category ';
        $pic = DB::execQuery($query6, '');
    //echo 'count: '.count($pic).'</br>';
    //echo 'type : '.gettype($pic).'</br>';
    //echo 'type of each data : '.gettype($pic[0]).'</br>';
    //print_r($pic[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data current result (cekNew)</br>';
        $query10 = 'SELECT * FROM dbpick_now.result_fix WHERE data_date="'.$yesterday.'"';
        $cekNew = DB::execQuery($query10, '');
    //echo 'count: '.count($cekNew).'</br>';
    //echo 'type : '.gettype($cekNew).'</br>';
    //echo 'type of each data : '.gettype($cekNew[0]).'</br>';
    //print_r($cekNew[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data reff utk cek ID dari yesterday data (cekIDnewR)</br>';
        $cekIDnewR = [];
        foreach($cekNew as $set) {
            if(!in_array(strtoupper($set['lot__id']),$cekIDnewR)) {
                $cekIDnewR[]=strtoupper($set['lot__id']);
            }
        }
    //echo 'count: '.count($cekIDnewR).'</br>';
    //echo 'type : '.gettype($cekIDnewR).'</br>';
    //echo 'type of each data : '.gettype($cekIDnewR[0]).'</br>';
    //print_r($cekIDnewR[0]);
    echo '</br>-------------------</br>';

    
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data departement (cekDept)</br>';
        $query4 = 'SELECT * FROM dbpick_now.dept_new'; 
        $cekDept = DB::execQuery($query4, '');
    //echo 'count: '.count($cekDept).'</br>';
    //echo 'type : '.gettype($cekDept).'</br>';
    //echo 'type of each data: '.gettype($cekDept[0]).'</br>';
    //print_r($cekDept[0]);
    echo '</br>-------------------</br>';


/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data reff utk cek departement dari cekDept variable (ls_dept)</br>';
        $ls_dept = [];
        foreach($cekDept as $set) {
            if(!in_array(strtoupper($set['dept']),$ls_dept)) {
                $ls_dept[]=strtoupper($set['dept']);
            }
        }

    //cho 'count: '.count($ls_dept).'</br>';
    //cho 'type : '.gettype($ls_dept).'</br>';
    //cho 'type of each data : '.gettype($ls_dept[0]).'</br>';
    //rint_r($ls_dept[0]);
    echo '</br>-------------------</br>';

    
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data reff utk cek ID yg Release dari QAD (id_R)</br>';
        $id_R = [];
        foreach($woR as $set) {
            if(!in_array(strtoupper($set->wo_lot),$id_R)) {
                $id_R[]=strtoupper($set->wo_lot);
            }
        }
    //echo 'count: '.count($id_R).'</br>';
    //echo 'type : '.gettype($id_R).'</br>';
    //echo 'type of each data : '.gettype($id_R[0]).'</br>';
    //print_r($id_R[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data demand new, demand dengan tambahan data (dmnd_new)</br>';
        foreach($demand as $set) {
            if(in_array($set->wod_lot,$id_R)) {
                $data_wo = array_filter($woR,
                    function ($wo) use ($set) {
                        return $wo->wo_lot === $set->wod_lot;
                    }
                );
                foreach($set as $key=>$value) {
                    $data[$key] = $value;
                }
                foreach($data_wo as $key=>$value) {
                    $cek = $key;
                }
                $data['item'] = $data_wo[$cek]->wo_part;
                $data['routing'] = $data_wo[$cek]->wo_routing;
                $data['assyLine'] = $data_wo[$cek]->wo__chr04;
                $data['rel_dt'] = $data_wo[$cek]->wo_rel_date;
                $data['due_dt'] = $data_wo[$cek]->wo_due_date;
                $data['wo_vend'] = $data_wo[$cek]->wo_vend;
                $dmnd_new[] = $data;
                $data = null;
            }
        }
        $demand = null;
        $id_R = null;
    //echo 'count: '.count($dmnd_new).'</br>';
    //echo 'type : '.gettype($dmnd_new).'</br>';
    //echo 'type of each data : '.gettype($dmnd_new[0]).'</br>';
    //print_r($dmnd_new[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'add data to demand new utk data subcont (dmnd_new2)</br>';
        foreach($dmnd_new as $set) {
            $data = array_filter($cekDept,
                    function ($itm) use ($set) {
                        return $itm['assyLine'] === $set['assyLine'];
                    }
                );
            foreach($data as $set2) {
                $set['dept'] = isset($set2['dept']) ? $set2['dept'] : '';
            }
            $dmnd_new2[] =$set;
            $subcont = array_filter($rout,
                function ($rt) use ($set) {
                    return $rt['ro_routing'] === $set['item'];
                }
            );
            if(count($subcont)>0) {
                $data2 = $set;
                $data2['dept'] = "SUBCONT";
                $dmnd_new2[] = $data2;
            }
            $data = null;
            $data2 = null;
        }
        $dmnd_new = null;
        $cekDept = null;
        $rout = null;
    //echo 'count: '.count($dmnd_new2).'</br>';
    //echo 'type : '.gettype($dmnd_new2).'</br>';
    //echo 'type of each data : '.gettype($dmnd_new2[0]).'</br>';
    //print_r($dmnd_new2[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data On Hand (oh)</br>';
        $oh = get_cache('general', 'qad_loc__fetch_qad_loc');
    //echo 'count: '.count($oh).'</br>';
    //echo 'type : '.gettype($oh).'</br>';
    //echo 'type of each data : '.gettype($oh[0]).'</br>';
    //print_r($oh[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'add departement to all On Hand base on location (oh_new)</br>';
        foreach($oh as $set) {
            $current = $set->ld_loc;
            foreach($set as $key=>$value) {
                $data[$key] = $value;
            }
            foreach($cekLoc as $set2) {
                if($current === $set2['loc']) {
                    $data['dept']= $set2['dept'];
                } 
            }
            if(!isset($data['dept'])) {$data['dept'] = '';}
            $oh_new[]=$data;
            $data =null;
        }
        $oh =null;
    //echo 'count: '.count($oh_new).'</br>';
    //echo 'type : '.gettype($oh_new).'</br>';
    //echo 'type of each data : '.gettype($oh_new[0]).'</br>';
    //print_r($oh_new[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'summary data qty OH per item number per departement (invDet)</br>';
        $invDet =[];
        foreach($oh_new as $set) {
            $part = isset($set['ld_part']) ? $set['ld_part'] :'N';
            $dept = isset($set['dept']) ? $set['dept'] :'N';
            $fltr = strtolower($part.$dept);
            if(isset($invDet[$fltr])) {
                $exst = $invDet[$fltr];
                $exst['qty_OH'] += floatval($set['ld_qty_oh']);
                $exst['detail'] .= $set['ld_lot'].'--'.$set['ld_loc'].'='.$set['ld_qty_oh'].', ';
                $exst['count'] += 1;
                $invDet[$fltr]= $exst;
             } else {
                $data = [
                    'dept'=>$set['dept'],
                    'loc'=>$set['ld_loc'],
                    'item'=>$set['ld_part'],
                    'qty_OH'=>floatval($set['ld_qty_oh']),
                    'lot'=>$set['ld_lot'],
                    'reff'=>$set['ld_ref'],
                    'detail'=>$set['ld_lot'] + "--" + $set['ld_loc'] + "=" + $set['ld_qty_oh'] + ", ",
                    'count'=>1
                ];
                $invDet[$fltr] = $data;
                $data = null;
            }
        }
        $oh_new = null;
    //echo 'count: '.count($invDet).'</br>';
    //echo 'type : '.gettype($invDet).'</br>';
    //$count_invDet = 0;
    //$count_cek = 0;
    //foreach($invDet as $set) {
    //    $count_cek += $set['count'];
    //    if($count_invDet<2) {
    //        print_r($set);
    //        echo '</br>';
    //    }
    //    $count_invDet++;
    //}
    //echo 'checking data count ='.$count_cek.'</br>';
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'change invDet to array (oh_all)</br>';
        foreach($invDet as $set) {
            $oh_all[]=$set;
        }
        $invDet =null;
    echo 'count: '.count($oh_all).'</br>';
    echo 'type : '.gettype($oh_all).'</br>';
    echo 'type of each data : '.gettype($oh_all[0]).'</br>';
    print_r($oh_all[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'change dmnd_new2 to array (gabCek, item)</br>';
        $item = [];
        foreach($dmnd_new2 as $set) {
            list($day, $month, $year) = explode("/", $set['rel_dt']);
            if (strlen($year) === 2) {
                $year = "20" . $year;
            }
            $cekDate = $year . "-" . $month . "-" . $day;
            $data = [
                'item'=>$set['wod_part'],
                'remark'=>'2.demand',
                'loc__line'=>$set['assyLine'],
                'dept'=>isset($set['dept']) ? $set['dept'] : '',
                'qty'=>floatval($set['wod_qty_req']),
                'lot__id'=>$set['wod_lot'],
                'item_id'=>$set['item'],
                'old_id'=>$set['wo_vend'],
                'date'=>$cekDate,
                'current'=>date("Y-m-d"),
            ];
            if(!in_array($set['wod_part'],$item)) {
                $item[]=$set['wod_part'];
            }
            $gabCek[]=$data;
            $data = null;
        }
    echo '-------------------</br>';
    echo 'gabCek data </br>';
    echo 'count: '.count($gabCek).'</br>';
    echo 'type : '.gettype($gabCek).'</br>';
    echo 'type of each data : '.gettype($gabCek[0]).'</br>';
    print_r($gabCek[0]);
    echo '</br>-------------------</br>';
    echo 'item data </br>';
    echo 'count: '.count($item).'</br>';
    echo 'type : '.gettype($item).'</br>';
    echo 'type of each data : '.gettype($item[0]).'</br>';
    print_r($item[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'add data OH all ke gab cek (gabCek)</br>';
        foreach($oh_all as $set) {
            if(in_array($set['dept'], $ls_dept) && in_array($set['item'], $item)) {
                $data = [
                    'item'=>$set['item'],
                    'remark'=> '1.on hand',
                    'loc__line'=>$set['loc'],
                    'dept'=>$set['dept'],
                    'qty'=>$set['qty_OH'],
                    'lot__id'=>$set['lot'],
                    'item_id'=> '-',
                    'old_id'=> '',
                    'date'=> '2000-01-01',
                    'current'=> date("Y-m-d"),
                    'detail'=>$set['detail']
                ];
                $gabCek[]=$data;
                $data = null;
            }
        }
    echo 'count: '.count($gabCek).'</br>';
    echo 'type : '.gettype($gabCek).'</br>';
    echo 'type of each data : '.gettype($gabCek[0]).'</br>';
    print_r($gabCek[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'sort gabCek (gabCek)</br>';
        usort($gabCek, function ($a,$b){
            if ($a['item'] < $b['item']) {return -1;} 
            elseif ($a['item'] > $b['item']) {return 1;}

            if ($a['dept'] < $b['dept']) {return -1;} 
            elseif ($a['dept'] > $b['dept']) {return 1;}

            if ($a['date'] < $b['date']) {return -1;} 
            elseif ($a['date'] > $b['date']) {return 1;}

            if ($a['remark'] < $b['remark']) {return -1;} 
            elseif ($a['remark'] > $b['remark']) {return 1;}

            return 0;
        });
    echo 'count: '.count($gabCek).'</br>';
    echo 'type : '.gettype($gabCek).'</br>';
    echo 'type of each data : '.gettype($gabCek[0]).'</br>';
    echo '<pre>';
    print_r(array_slice($gabCek,0,5));
    echo '</pre>';
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'add additional data gabCek (gabCek2)</br>';
    $codeCek = '';
    $tempVal = 0;
    $action = '';
    $gabCek2 =[];
    foreach($gabCek as $set) {
        if($codeCek != $set['item'].$set['dept']) {
            $tempVal =0;
            $codeCek = $set['item'].$set['dept'];
            if($set['remark'] === '1.on hand') {
                $tempVal = floatval($set['qty']);
            } else {
                $tempVal = (-1) * floatval($set['qty']);
            }
        } else {
            if($set['remark'] === '1.on hand') {
                $tempVal = $tempVal + floatval($set['qty']);
            } else {
                $tempVal = $tempVal - floatval($set['qty']);
            }
        }
        if($tempVal < 0) {
            $action = 'pick now';
        } else { $action = '';}
        $data = $set;
        $data['code'] =  $codeCek;
        $data['valAcc'] = $tempVal;
        $data['pick'] = $action;
        if(in_array($set['lot__id'],$cekIDnewR)) {
            $action = 'baru';
        } else { $action = '';}
        $data['id_new'] = $action;
        $gabCek2[] = $data;
        $data = null;
    }
    $gabCek = null;
    echo 'count: '.count($gabCek2).'</br>';
    echo 'type : '.gettype($gabCek2).'</br>';
    echo 'type of each data : '.gettype($gabCek2[0]).'</br>';
    echo '<pre>';
    print_r($gabCek2[0]);
    echo '</pre>';
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'ref data (ls_pick dan typePick)</br>';
        $ls_pick = [];
        $typePick = [];
        foreach($gabCek2 as $set) {
            if(!in_array($set['lot__id'], $ls_pick) && $set['pick'] === 'pick now') {
                $ls_pick[]=$set['lot__id'];
            }
            if(!in_array($set['item'], $typePick) && $set['pick'] === 'pick now') {
                $typePick[]=$set['item'];
            }
        }
    echo 'ls_pick ';
    echo 'count: '.count($ls_pick).'</br>';
    echo 'type : '.gettype($ls_pick).'</br>';
    echo 'type of each data : '.gettype($ls_pick[0]).'</br>';
    print_r($ls_pick[0]);
    echo '</br>-------------------</br>';
    echo 'typePick ';
    echo 'count: '.count($typePick).'</br>';
    echo 'type : '.gettype($typePick).'</br>';
    echo 'type of each data : '.gettype($typePick[0]).'</br>';
    print_r($typePick[0]);
    echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'ref data2 (result_pick)</br>';
        $result_pick = [];
        foreach($gabCek2 as $set) {
            if(in_array($set['lot__id'],$ls_pick)) {
                $result_pick[] = $set;
            } else 
            if(in_array($set['item'], $typePick)) {
                $result_pick[] = $set;
            } else if($set['remark'] === '1.on hand') {
                $result_pick[] = $set;
            }
        }
    echo 'count: '.count($result_pick).'</br>';
    echo 'type : '.gettype($result_pick).'</br>';
    echo 'type of each data : '.gettype($result_pick[0]).'</br>';
    print_r($result_pick[0]);
    echo '</br>-------------------</br>';
    
/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
echo '</br>-------------------</br>';
echo 'data item master (item_mstr)</br>';
    $item_mstr = get_cache('general', 'qad_item__fetch_item');
echo 'count: '.count($item_mstr).'</br>';
echo 'type : '.gettype($item_mstr).'</br>';
echo 'type of each data : '.gettype($item_mstr[0]).'</br>';
print_r($item_mstr[0]);
echo '</br>-------------------</br>';

/*||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    echo '</br>-------------------</br>';
    echo 'data akhir (finalResult)</br>';
    $finalResult = [];
    $new_count = 0;
        foreach($result_pick as $set) {
            $picCek = array_filter($pic, function ($dt) use ($set) {
                return $dt['tipe'] === $set['item'];
            });
            $OH = array_filter($oh_all, function($dt) use ($set) {
                return $dt['item'] === $set['item'] && $dt['dept'] === 'WH';
            });
            $wo = array_filter($woR, function($dt) use ($set) {
                return $dt->wo_lot === $set['lot__id'];
            });
            $it = array_filter($item_mstr, function($dt) use ($set) {
                return $dt->pt_part === $set['item'];
            });
            if(count($it)>0) {
                foreach($it  as $set2) {
                    $data['desc']= $set2->pt_desc1;
                }
            } else {
                $data['desc']= '';
            }

            $it2 = array_filter($item_mstr, function($dt) use ($set) {
                return $dt->pt_part === $set['item_id'];
            });
            if(count($it2)>0) {
                foreach($it2  as $set3) {
                    $data['desc2']= $set3->pt_desc1;
                }
            } else {
                $data['desc2']= '';
            }
            $data =$set;
            if(count($wo)>0) {
                foreach($wo  as $set4) {
                    $data['rel_date']= $set4->wo_rel_datex;
                    $data['due_date']= $set4->wo_due_datex;
                    $data['rmks']= $set4->wo_rmks;
                }
            }
            if(count($picCek)>0) {
                //echo 'picCek  count = '. count($picCek).'</br>';
                //echo '</br>'; print_r($picCek); echo '</br>'; 
                foreach($picCek  as $set5) {
                    $data['pic']= $set5['optr'];
                }
            } else {
                $data['pic']= '';
            }
            if(count($OH)>0) {
                foreach($OH  as $set6) {
                    $data['all_lot']=$set6['lot'];
                    $data['qtyOnHand']=$set6['qty_OH'];
                }
            } else {
                $data['all_lot']= "-";
                $data['qtyOnHand']= 0;
            }
            $finalResult[] = $data;
            $data = null;
            if($new_count%100 === 0) {
                echo $new_count.'</br>';
            } 
            $new_count++;
        }
        $picCek =null;
        $OH  = null;
        $wo = null;
        $it = null;
        $it2 =  null;
    echo 'count: '.count($finalResult).'</br>';
    echo 'type : '.gettype($finalResult).'</br>';
    echo 'type of each data : '.gettype($finalResult[0]).'</br>';
    print_r($finalResult[0]);
    echo '</br>-------------------</br>';


    echo 'Pick Now Scheduler Succesfully run </br>';
    return;
}