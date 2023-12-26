import { splitCustomString, strToNumber, currentDate } from '../../component/process.js';
import { jig_location_query, log_location_query, jig_master_query, log_master_query, jig_function_query, log_function_query } from '../../class.js';

export const updateInsertData = async() => {
    try {
        // ambil data dari input / form
        const arrInput = document.querySelectorAll('[data-input]');
        const arrNew = document.querySelectorAll('[data-new]');
        let data = [];
        let newData = [];
        data['key']=[];
        newData['key']=[];
        data['filter']=[];
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
                if (parseInt(data['cur_qty_per_unit'][i])<parseInt(data['qty'][i])){
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
        let filter1 = [];
        update1['item_jig'] =[];
        update1['qty_per_unit'] =[];
        update1['unit'] =[];
        update1['lokasi'] =[];
        update1['status'] =[];
        update1['id'] =[];
        update1['toleransi'] =[];
        filter1['code'] =[];
        let insert1 = [];
        insert1['code'] = [];
        insert1['item_jig'] = [];
        insert1['qty_per_unit'] = [];
        insert1['unit'] = [];
        insert1['lokasi'] = [];
        insert1['trans_date'] = [];
        insert1['remark'] = [];
        insert1['status'] = [];
        insert1['id'] = [];
        insert1['toleransi'] = [];
        insert1['addSub'] = [];
        insert1['qty_change'] = [];

        for (let i=0; i<data['qty'].length; i++) {
            if (!parseInt(data['qty'][i])==0 ) {
                update1['item_jig'].push(data['item_jig'][i]);
                update1['qty_per_unit'].push(data['qty_per_unit'][i]);
                update1['unit'].push(data['unit'][i]);
                update1['lokasi'].push(data['lokasi'][i]);
                update1['status'].push(data['status'][i]);
                update1['id'].push(data['id'][i]);
                update1['toleransi'].push(data['toleransi'][i]);

                filter1['code'].push(data['code'][i]);

                insert1['code'].push(data['code'][i]);
                insert1['item_jig'].push(data['item_jig'][i]);
                insert1['qty_per_unit'].push(data['qty_per_unit'][i]);
                insert1['unit'].push(data['unit'][i]);
                insert1['lokasi'].push(data['lokasi'][i]);
                insert1['trans_date'].push(data['trans_date'][i]);
                insert1['remark'].push(data['remark'][i]);
                insert1['status'].push(data['status'][i]);
                insert1['id'].push(data['id'][i]);
                insert1['toleransi'].push(data['toleransi'][i]);
                insert1['addSub'].push(data['addSub'][i]);
                insert1['qty_change'].push(data['qty'][i]);
            }
        }
        // insert too jig_location_query


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
            if (!result3.includes('fail')) {
                alert('data successfully updated');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                alert('data is not updated');
            }
            return;
        }
        const result3 = await jig_location_query.updateData(update1, filter1);     
        const result1 = await log_location_query.insertData(insert1);     
        const result2 = await jig_location_query.insertData(insert2);     
        const result4 = await log_location_query.insertData(insert3);     
        if (!result3.includes('fail') && !result2.includes('fail')) {
            alert('data successfully updated');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            alert('data is not updated');
        }
    } catch(error){
        console.log(error);
    }

}

export const delDataStock = async(id,pk) => {
    try {
        const code = splitCustomString("+", id);
        const idToDelete = code[1];
        const item = splitCustomString("--", idToDelete);
        const allData = document.querySelectorAll(`[id*="${idToDelete}"]`);
        let data = [];
        for (let i=0; i<allData.length; i++) {
            const rawId = allData[i].id;
            const id = splitCustomString("+", rawId);
            const key = id[0];
            const value = allData[i].value;
            if (!data[key]) {
                data[key] = [value];    
            } else {
                data[key].push(value);
            }
        }
        let insert1 = [];
        insert1['code'] = [idToDelete];
        insert1['item_jig'] = [item[0]];
        insert1['qty_per_unit'] = [data['cur_qty_per_unit'][0]];
        insert1['unit'] = [data['unit'][0]];
        insert1['lokasi'] = [data['lokasi'][0]];
        insert1['trans_date'] = [currentDate()];
        insert1['remark'] = ['delete'];
        insert1['qty_change'] = [data['qty'][0]];

        const result = await jig_location_query.deleteData(pk,idToDelete);
        const result1 = await log_location_query.insertData(insert1);  

        if (!result.includes('fail')) {
            alert('data successfully deleted');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            alert('data is not deleted');
        }
    } catch(error) {
        console.log(error);
    }
}



export const updateInsertJig = async() => {
    try {
        const arrInput = document.querySelectorAll('[data-updJig]');
        let data = [];
        data['key']=[];
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
        
        const itemJig = document.getElementById('searchJig').value;  
        let update1 = [];
        update1['desc_jig'] = data['desc_jig'];
        update1['status_jig'] = data['status_jig'];
        update1['material'] = data['material'];
        update1['type'] = data['type'];
        update1['drawing'] = data['drawing'];
        let filter1 = []
        filter1['item_jig'] = [itemJig];
        
        let insert1 = [];
        insert1['item_jig'] = [itemJig];
        insert1['desc_jig'] = data['desc_jig'];
        insert1['status_jig'] = data['status_jig'];
        insert1['material'] = data['material'];
        insert1['type'] = data['type'];
        insert1['drawing'] = data['drawing'];
        insert1['trans_date'] = [currentDate()];
        insert1['remark'] = data['remark'];
        console.log({update1, filter1, insert1});

        const result3 = await jig_master_query.updateData(update1, filter1);     
        const result1 = await log_master_query.insertData(insert1);
        if (!result3.includes('fail')) {
            alert('data successfully updated');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            alert('data is not updated');
        }
    } catch(error){
        console.log(error);
    }

}


export const updateInsertType = async() => {
    try {
        // ambil data dari input / form
        const arrInput = document.querySelectorAll('[data-updtype]');
        const arrNew = document.querySelectorAll('[data-addType]');
        const item = document.getElementById('searchType').value;
        let data = [];
        let newData = [];
        data['key']=[];
        newData['key']=[];
        data['id'] = [];
        for (let i=0; i<arrInput.length; i++) {
            const rawId = arrInput[i].id;
            const id = splitCustomString("+", rawId);
            if (!data['id'].includes(id[1])) {
                data['id'].push(id[1]);
            }
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
        
        let update1 = [];
        update1['item_jig'] = [];
        update1['opt_on'] = [];
        update1['opt_off'] = [];
        update1['status'] = [];
        update1['item_type'] = [];
        let filter1 = []
        filter1['id'] = [];
        let insert1 = [];
        insert1['item_jig'] = [];
        insert1['item_type'] = [];
        insert1['opt_on'] = [];
        insert1['opt_off'] = [];
        insert1['status'] = [];
        insert1['remark'] = [];
        insert1['trans_date'] = [];
        let insert2 = [];
        insert2['item_jig'] = [];
        insert2['item_type'] = [];
        insert2['opt_on'] = [];
        insert2['opt_off'] = [];
        insert2['status'] = [];
        insert2['remark'] = [];
        insert2['trans_date'] = [];
        let insert3 = [];
        insert3['item_jig'] = [];
        insert3['item_type'] = [];
        insert3['opt_on'] = [];
        insert3['opt_off'] = [];
        insert3['status'] = [];
        insert3['remark'] = [];
        insert3['trans_date'] = [];

        console.log(data);
        for (let i=0; i<data['mark'].length; i++) {
            // item_jig item_type opt on opt off status
            const cekChange = `${data['item_jig'][i]}+${item}+${data['opt_on'][i]}+${data['opt_off'][i]}+${data['status'][i]}`;
            if (cekChange !== data['mark'][i]) {
                update1['item_jig'].push(data['item_jig'][i]);
                update1['opt_on'].push(data['opt_on'][i]);
                update1['opt_off'].push(data['opt_off'][i]);
                update1['status'].push(data['status'][i]);
                update1['item_type'].push(item);
                filter1['id'].push(data['id'][i]);

                insert1['item_jig'].push(data['item_jig'][i]);
                insert1['item_type'].push(item);
                insert1['opt_on'].push(data['opt_on'][i]);
                insert1['opt_off'].push(data['opt_off'][i]);
                insert1['status'].push(data['status'][i]);
                insert1['remark'].push(data['remark'][i]);
                insert1['trans_date'].push(currentDate());

                insert2['item_jig'].push(newData['item_jig'][i]);
                insert2['item_type'].push(item);
                insert2['opt_on'].push(newData['opt_on'][i]);
                insert2['opt_off'].push(newData['opt_off'][i]);
                insert2['status'].push(newData['status'][i]);
                insert2['remark'].push(newData['remark'][i]);
                insert2['trans_date'].push(currentDate());

                insert3['item_jig'].push(newData['item_jig'][i]);
                insert3['item_type'].push(item);
                insert3['opt_on'].push(newData['opt_on'][i]);
                insert3['opt_off'].push(newData['opt_off'][i]);
                insert3['status'].push(newData['status'][i]);
                insert3['remark'].push(newData['remark'][i]);
                insert3['trans_date'].push(currentDate());
            }
        }

        if (newData['item_jig'].length == 0) {
            const result3 = await jig_function_query.updateData(update1, filter1);     
            const result1 = await log_function_query.insertData(insert1);
            if (!result3.includes('fail')) {
                alert('data successfully updated');
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                alert('data is not updated');
            }
            return;
        }
        const result3 = await jig_function_query.updateData(update1, filter1);     
        const result1 = await log_function_query.insertData(insert1);     
        const result2 = await jig_function_query.insertData(insert2);     
        const result4 = await log_function_query.insertData(insert3);     
        if (!result3.includes('fail') && !result2.includes('fail') ) {
            alert('data successfully updated and inserted');
            setTimeout(() => {
                location.reload();
            }, 2000);
        } else {
            alert('data is not updated or inserted');
        }
    } catch(error){
        console.log(error);
    }

}