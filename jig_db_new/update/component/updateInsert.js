import { splitCustomString, strToNumber, currentDate } from '../../component/process.js';
import { jig_location_query, log_location_query } from '../../class.js';

export const updateInsertData = async() => {
    try {
        // ambil data dari input / form
        const arrInput = document.querySelectorAll('[data-input]');
        const arrNew = document.querySelectorAll('[data-new]');
        let data = [];
        let newData = [];
        data['key']=[];
        newData['key']=[];
        for (let i=0; i<arrInput.length; i++) {
            const rawId = arrInput[i].id;
            const id = splitCustomString("+", rawId);
            const key = id[0];
            const value = arrInput[i].value;
            if (!data['key'].includes(`${key}`)) {
                const codeLength = data['key'].length;
                data['key'][codeLength] = key;
            }
            if (!data[key]) {
                data[key] = [value];    
            } else {
                data[key].push(value);
            }
        }

        for (let i=0; i<arrNew.length; i++) {
            const rawId = arrNew[i].id;
            const id = splitCustomString("+", rawId);
            const key = id[0];
            const value = arrNew[i].value;
            if (!newData['key'].includes(`${key}`)) {
                const codeLength = newData['key'].length;
                newData['key'][codeLength] = key;
            }
            if (!newData[key]) {
                newData[key] = [value];    
            } else {
                newData[key].push(value);
            }
        }
        // data olahan utk dimasukkan ke database
        data['code'] = [];
        data['item_jig']=[];
        data['id']=[];
        data['status']=[];
        data['toleransi']=[];
        data['trans_date']=[];
        data['qty_per_unit']=[];
        
        const itemJig = document.getElementById('searchStock').value;  
        const itemTol = document.getElementById('tol').value;   
        const status = "active";
        const cekInput = document.querySelectorAll(`[data-input][id*="${data['key'][0]}"]`);
        const cekInput2 = document.querySelectorAll(`[data-new][id*="${newData['key'][0]}"]`);
        for (let i=0; i<cekInput.length; i++) {
            // item_jig
            data['item_jig'][i] = itemJig;
            // status
            data['status'][i] = status;
            // toleransi
            data['toleransi'][i] = itemTol;
            // trans_date
            data['trans_date'][i] = currentDate();
            // qty_per_unit
            if (data['addSub'][i] === 'tambah') {
                data['qty_per_unit'][i] = parseInt(data['cur_qty_per_unit'][i]) + parseInt(data['qty'][i]);
            } else if (data['addSub'][i] === 'kurang') {
                if (data['cur_qty_per_unit'][i]< data['qty'][i]){
                    return alert("quantity perubahan lebih kecil dari pada qty on hand");
                }
                data['qty_per_unit'][i] = parseInt(data['cur_qty_per_unit'][i]) - parseInt(data['qty'][i]);
            }
            // id no dan code baru
            const codeGet = splitCustomString("+", cekInput[i].id);
            const cekID = splitCustomString("--", codeGet[1]);
            data['code'][i] = codeGet[1];
            data['id'][i] = parseInt(cekID[1]);
        }
        
        newData['code'] = [];
        newData['item_jig']=[];
        newData['id']=[];
        newData['status']=[];
        newData['toleransi']=[];
        newData['trans_date']=[];
        newData['qty_per_unit']=[];
        let cekLength = cekInput.length + 1;
        for (let i=0; i<cekInput2.length; i++) {
            // item_jig
            newData['item_jig'][i] = itemJig;
            // status
            newData['status'][i] = status;
            // toleransi
            newData['toleransi'][i] = itemTol;
            // trans_date
            newData['trans_date'][i] = currentDate();
            // qty_per_unit
            if (newData['addSub'][i] === 'tambah') {
                newData['qty_per_unit'][i] = parseInt(newData['qty'][i]);
            } 
            // id no dan code baru
            newData['id'].push(cekLength);
            newData['code'][i] = newData['item_jig'][i] + "--" + strToNumber(cekLength,3,0);
            cekLength++
        }
        // utk jig_location_query
        // code, item_jig, qty_per_unit, unit, lokasi, status, id, toleransi
        let update1 = [];
        update1['item_jig'] = data['item_jig'];
        update1['qty_per_unit'] = data['qty_per_unit'];
        update1['unit'] = data['unit'];
        update1['lokasi'] = data['lokasi'];
        update1['status'] = data['status'];
        update1['id'] = data['id'];
        update1['toleransi'] = data['toleransi'];
        let filter1 = []
        filter1['code'] = data['code'];

        // insert too jig_location_query
        let insert1 = [];
        insert1['code'] = data['code'];
        insert1['item_jig'] = data['item_jig'];
        insert1['qty_per_unit'] = data['qty_per_unit'];
        insert1['unit'] = data['unit'];
        insert1['lokasi'] = data['lokasi'];
        insert1['trans_date'] = data['trans_date'];
        insert1['remark'] = data['remark'];
        insert1['status'] = data['status'];
        insert1['id'] = data['id'];
        insert1['toleransi'] = data['toleransi'];
        insert1['addSub'] = data['addSub'];
        insert1['qty_change'] = data['qty'];

        // insert too jig_location for new data
        let insert2 = [];
        insert2['code'] = newData['code'];
        insert2['item_jig'] = newData['item_jig'];
        insert2['qty_per_unit'] = newData['qty_per_unit'];
        insert2['unit'] = newData['unit'];
        insert2['lokasi'] = newData['lokasi'];
        insert2['status'] = newData['status'];
        insert2['id'] = newData['id'];
        insert2['toleransi'] = newData['toleransi'];

        // insert log_location for new data
        let insert3 = [];
        insert3['code'] = newData['code'];
        insert3['item_jig'] = newData['item_jig'];
        insert3['qty_per_unit'] = newData['qty_per_unit'];
        insert3['unit'] = newData['unit'];
        insert3['lokasi'] = newData['lokasi'];
        insert3['trans_date'] = newData['trans_date'];
        insert3['remark'] = newData['remark'];
        insert3['status'] = newData['status'];
        insert3['id'] = newData['id'];
        insert3['toleransi'] = newData['toleransi'];
        insert3['addSub'] = newData['addSub'];
        insert3['qty_change'] = newData['qty'];

        if (newData['code'].length == 0) {
            const result3 = await jig_location_query.updateData(update1, filter1);     
            const result1 = await log_location_query.insertData(insert1);
            console.log({result1, result3});
            return;
        }
        const result3 = await jig_location_query.updateData(update1, filter1);     
        const result1 = await log_location_query.insertData(insert1);     
        const result2 = await jig_location_query.insertData(insert2);     
        const result4 = await log_location_query.insertData(insert3);     
        console.log({result1, result2, result3, result4});
    } catch(error){
        console.log(error);
    }

}



export const updateInsertJig = async() => {
    try {
        // ambil data dari input / form
        const arrInput = document.querySelectorAll('[data-updJig]');
        const arrNew = document.querySelectorAll('[data-new]');
        let data = [];
        let newData = [];
        data['key']=[];
        newData['key']=[];
        for (let i=0; i<arrInput.length; i++) {
            const rawId = arrInput[i].id;
            const id = splitCustomString("+", rawId);
            const key = id[0];
            const value = arrInput[i].value;
            if (!data['key'].includes(`${key}`)) {
                const codeLength = data['key'].length;
                data['key'][codeLength] = key;
            }
            if (!data[key]) {
                data[key] = [value];    
            } else {
                data[key].push(value);
            }
        }

        for (let i=0; i<arrNew.length; i++) {
            const rawId = arrNew[i].id;
            const id = splitCustomString("+", rawId);
            const key = id[0];
            const value = arrNew[i].value;
            if (!newData['key'].includes(`${key}`)) {
                const codeLength = newData['key'].length;
                newData['key'][codeLength] = key;
            }
            if (!newData[key]) {
                newData[key] = [value];    
            } else {
                newData[key].push(value);
            }
        }
        // data olahan utk dimasukkan ke database
        data['code'] = [];
        data['item_jig']=[];
        data['id']=[];
        data['status']=[];
        data['toleransi']=[];
        data['trans_date']=[];
        data['qty_per_unit']=[];
        
        const itemJig = document.getElementById('searchStock').value;  
        const itemTol = document.getElementById('tol').value;   
        const status = "active";
        const cekInput = document.querySelectorAll(`[data-input][id*="${data['key'][0]}"]`);
        const cekInput2 = document.querySelectorAll(`[data-new][id*="${newData['key'][0]}"]`);
        for (let i=0; i<cekInput.length; i++) {
            // item_jig
            data['item_jig'][i] = itemJig;
            // status
            data['status'][i] = status;
            // toleransi
            data['toleransi'][i] = itemTol;
            // trans_date
            data['trans_date'][i] = currentDate();
            // qty_per_unit
            if (data['addSub'][i] === 'tambah') {
                data['qty_per_unit'][i] = parseInt(data['cur_qty_per_unit'][i]) + parseInt(data['qty'][i]);
            } else if (data['addSub'][i] === 'kurang') {
                if (data['cur_qty_per_unit'][i]< data['qty'][i]){
                    return alert("quantity perubahan lebih kecil dari pada qty on hand");
                }
                data['qty_per_unit'][i] = parseInt(data['cur_qty_per_unit'][i]) - parseInt(data['qty'][i]);
            }
            // id no dan code baru
            const codeGet = splitCustomString("+", cekInput[i].id);
            const cekID = splitCustomString("--", codeGet[1]);
            data['code'][i] = codeGet[1];
            data['id'][i] = parseInt(cekID[1]);
        }
        
        newData['code'] = [];
        newData['item_jig']=[];
        newData['id']=[];
        newData['status']=[];
        newData['toleransi']=[];
        newData['trans_date']=[];
        newData['qty_per_unit']=[];
        let cekLength = cekInput.length + 1;
        for (let i=0; i<cekInput2.length; i++) {
            // item_jig
            newData['item_jig'][i] = itemJig;
            // status
            newData['status'][i] = status;
            // toleransi
            newData['toleransi'][i] = itemTol;
            // trans_date
            newData['trans_date'][i] = currentDate();
            // qty_per_unit
            if (newData['addSub'][i] === 'tambah') {
                newData['qty_per_unit'][i] = parseInt(newData['qty'][i]);
            } 
            // id no dan code baru
            newData['id'].push(cekLength);
            newData['code'][i] = newData['item_jig'][i] + "--" + strToNumber(cekLength,3,0);
            cekLength++
        }
        // utk jig_location_query
        // code, item_jig, qty_per_unit, unit, lokasi, status, id, toleransi
        let update1 = [];
        update1['item_jig'] = data['item_jig'];
        update1['qty_per_unit'] = data['qty_per_unit'];
        update1['unit'] = data['unit'];
        update1['lokasi'] = data['lokasi'];
        update1['status'] = data['status'];
        update1['id'] = data['id'];
        update1['toleransi'] = data['toleransi'];
        let filter1 = []
        filter1['code'] = data['code'];

        // insert too jig_location_query
        let insert1 = [];
        insert1['code'] = data['code'];
        insert1['item_jig'] = data['item_jig'];
        insert1['qty_per_unit'] = data['qty_per_unit'];
        insert1['unit'] = data['unit'];
        insert1['lokasi'] = data['lokasi'];
        insert1['trans_date'] = data['trans_date'];
        insert1['remark'] = data['remark'];
        insert1['status'] = data['status'];
        insert1['id'] = data['id'];
        insert1['toleransi'] = data['toleransi'];
        insert1['addSub'] = data['addSub'];
        insert1['qty_change'] = data['qty'];

        // insert too jig_location for new data
        let insert2 = [];
        insert2['code'] = newData['code'];
        insert2['item_jig'] = newData['item_jig'];
        insert2['qty_per_unit'] = newData['qty_per_unit'];
        insert2['unit'] = newData['unit'];
        insert2['lokasi'] = newData['lokasi'];
        insert2['status'] = newData['status'];
        insert2['id'] = newData['id'];
        insert2['toleransi'] = newData['toleransi'];

        // insert log_location for new data
        let insert3 = [];
        insert3['code'] = newData['code'];
        insert3['item_jig'] = newData['item_jig'];
        insert3['qty_per_unit'] = newData['qty_per_unit'];
        insert3['unit'] = newData['unit'];
        insert3['lokasi'] = newData['lokasi'];
        insert3['trans_date'] = newData['trans_date'];
        insert3['remark'] = newData['remark'];
        insert3['status'] = newData['status'];
        insert3['id'] = newData['id'];
        insert3['toleransi'] = newData['toleransi'];
        insert3['addSub'] = newData['addSub'];
        insert3['qty_change'] = newData['qty'];

        if (newData['code'].length == 0) {
            const result3 = await jig_location_query.updateData(update1, filter1);     
            const result1 = await log_location_query.insertData(insert1);
            console.log({result1, result3});
            return;
        }
        const result3 = await jig_location_query.updateData(update1, filter1);     
        const result1 = await log_location_query.insertData(insert1);     
        const result2 = await jig_location_query.insertData(insert2);     
        const result4 = await log_location_query.insertData(insert3);     
        console.log({result1, result2, result3, result4});
    } catch(error){
        console.log(error);
    }

}