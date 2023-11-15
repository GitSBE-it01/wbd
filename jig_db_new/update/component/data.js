import { splitCustomString, strToNumber, currentDate } from '../../component/process.js';
import { jig_location_query } from '../../class.js';

export const updateInsertData = async() => {
    try {
        // ambil data dari input / form
        const arrInput = document.querySelectorAll('[data-input]');
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
        const cekInput = document.querySelectorAll(`input[id*="${data['key'][0]}"]`);
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
                data['qty_per_unit'][i] = data['cur_qty_per_unit'][i] + data['qty'][i];
            } else if (data['addSub'] === 'kurang') {
                data['qty_per_unit'][i] = data['cur_qty_per_unit'][i] - data['qty'][i];
            }
            // id no dan code baru
            const ii = i-1;
            const code2 = data['id'][ii];
            console.log({ii, code2});
            const codeGet = splitCustomString("+", cekInput[i].id);
            if (!codeGet[1] < 3) {
                const cekID = splitCustomString("--", codeGet[1]);
                data['code'][i] = codeGet[1];
                data['id'][i] = parseInt(cekID[1]);
            } else{
                data['id'][i] = code2+1;
                data['code'][i] = data['item_jig'][i] + "--" + strToNumber(code2,3,0);
            }
        }
        console.log(data);
        
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
        insert1['item_jig'] = data['item_jig'];
        insert1['qty_per_unit'] = data['qty_per_unit'];
        insert1['unit'] = data['unit'];
        insert1['lokasi'] = data['lokasi'];
        insert1['status'] = data['status'];
        insert1['id'] = data['id'];
        insert1['toleransi'] = data['toleransi'];
        insert1['code'] = data['code'];

        // insert too log_location_query
        let insert2 = [];
        insert2['code'] = data['code'];
        insert2['item_jig'] = data['item_jig'];
        insert2['qty_per_unit'] = data['qty_per_unit'];
        insert2['unit'] = data['unit'];
        insert2['lokasi'] = data['lokasi'];
        //insert2['trans_date'] = data['trans_date'];
        insert2['remark'] = data['remark'];
        insert2['status'] = data['status'];
        //insert2['id'] = data['id'];
        insert2['toleransi'] = data['toleransi'];
        insert2['addSub'] = data['addSub'];
        //qty
        insert2['qty_change'] = data['qty_change'];

        //const result = await jig_location_query.insertData(update1);     
        //const result = await jig_location_query.updateData(update1, filter1);     

    } catch(error){
        console.log(error);
    }

}
