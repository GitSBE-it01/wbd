import {
    currentDate,
} from '../../3.utility/index.js';

import {point} from '../general.js';

export const data_process = async(vjs_trans, value, user, data_table) =>{
    let cek = vjs_trans.find(obj=> obj.trans_date === currentDate("-"));
    if(!cek || vjs_trans.length === 0 || cek === undefined) {
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
            created_date: dt.created_date,
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
    let counter = 0;
    check_point.forEach(dt=>{
        const data = {
            id: `new__${counter}`,
            aprroval_by: "",
            category: dt.new_cat,
            check_point: dt.check_point,
            data_group: currentDate("")+vjs_trans[0].sn_id,
            decision: "",
            no_asset:vjs_trans[0].no_asset,
            result: "",
            sn_id: value[0],
            standard: dt.standard,
            trans_date: currentDate(),
            created_date: currentDate(),
            mod_date: currentDate(),
            mod_by: user.name + "-" + user.jabatan + "-" + user.dept + "-" + user.grade,
            user_input: user.name + "-" + user.jabatan + "-" + user.dept + "-" + user.grade,
        }
        counter++
        vjs_trans.push(data);
    })
    return vjs_trans;
}


export const insertUpdate = async(event, splitValue, user, update, insert) => {
    const trgt = event.target;
    const tr_main = trgt.closest('tr');
    const addTD = tr_main.querySelectorAll('[data-field');
    let user_create = '';
    let create_dt = '';
    let approval = '';
    addTD.forEach(dt=>{
        if(dt.getAttribute('data-field')==='user_input') {
            user_create = dt.textContent;
        }
        if(dt.getAttribute('data-field')==='created_date') {
            create_dt = dt.textContent;
        }
        if(dt.getAttribute('data-field')==='approval_by') {
            approval = dt.textContent;
        }
    })

    trgt.disabled = true;
    trgt.classList.toggle('opacity-25');
    const code = trgt.getAttribute('data-button').split('__');
    const table = document.querySelector(`[data-table = "${code[1]}"]`);
    const tr = table.querySelectorAll('[data-change = "change"]');
    tr.forEach(dt=>{
        const td = dt.querySelectorAll('td');
        let check_point = '';
        let std = '';
        let result = '';
        td.forEach(dt2=>{
            if(dt2.getAttribute('data-field') === 'check_point') {
                check_point = dt2.textContent;
            }
            if(dt2.getAttribute('data-field') === 'standard') {
                std = dt2.textContent;
            }

            if(dt2.querySelector('span') !== null) {
                const span = dt2.querySelector('span');
                result = span.getAttribute('data-value');
            } 
            if(dt2.querySelector('textarea')!== null ) {
                const textarea = dt2.querySelector('textarea');
                result = textarea.value;
            }
        })
        const id = dt.getAttribute('data-tr')
        const data = {
            sn_id:splitValue[0].split("=")[1].trim(),
            category:splitValue[1].split("=")[1].trim(),
            no_asset: splitValue[2] ? splitValue[2].split("=")[1].trim() : '',
            check_point: check_point,
            standard: std,
            trans_date:currentDate(),
            mod_date:currentDate(),
            result: result,
            data_group:code[1],
            mod_by: user.name + "-" + user.jabatan + "-" + user.dept + "-" + user.grade,
            user_input: user_create,
            created_date: create_dt,
            approval_by: approval,
        }
        if(dt.getAttribute('data-tr').includes('new')) {
            insert.push(data);
        } else {
            const data2 = {data: data, filter: {id:id}};
            update.push(data2);
        }
    })
    return;
}