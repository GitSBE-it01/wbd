import {
    currentDate,
    curDate,
} from '../../3.utility/index.js';

import {point} from '../general.js';

export const data_process = async(vjs_trans, value, user, data_table) =>{
    let cek = vjs_trans.find(obj=> obj.trans_date === currentDate());
    if(!cek || vjs_trans.length === 0 || cek === undefined) {
        console.log('new');
        await createNewData(vjs_trans, user, value);
    }
    vjs_trans.sort((a,b) => {
        if (a.trans_date !== b.trans_date) return b.trans_date.localeCompare(a.trans_date);
        if (a.check_point === 'remark') return 1; 
        if (b.check_point === 'remark') return -1; 
        return a.check_point.localeCompare(b.check_point);
    })
    let cek2 = [];
    vjs_trans.forEach(dt=>{
        const data1 = {
            data_group: dt.data_group,
            trans_date: dt.trans_date,
            user_input: dt.user_input,
            approval_by: dt.approval_by
        }
        if (!cek2.includes(data1.data_group)){
            cek2.push(dt.data_group);
            data_table.push(data1);
        }
    })
}

const createNewData = async(vjs_trans, user, value) => {
    let check_point = await point.dbProcess('fetch',{new_cat: value[1], status:1});
    check_point.forEach(dt=>{
        const data = {
            aprroval_by: "",
            category: dt.new_cat,
            check_point: dt.check_point,
            data_group: curDate("")+vjs_trans[0].sn_id,
            decision: "",
            no_asset:vjs_trans[0].no_asset,
            result: "NG",
            sn_id: value[0],
            standard: dt.standard,
            trans_date: currentDate(),
            user_input: user.name + "-" + user.jabatan + "-" + user.dept + "-" + user.grade,
        }
        vjs_trans.push(data);
    })
    return vjs_trans;
}