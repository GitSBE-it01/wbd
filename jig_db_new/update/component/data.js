import { splitCustomString } from '../../component/process.js';
import { jig_location_query } from '../../class.js';

export const updateInsertData = async() => {
    try {
        const arrInput = document.querySelectorAll('[data-input]');
        const itemJig = document.getElementById('searchStock').value;        
        const itemTol = document.getElementById('tol').value;        
        let data = [];
        data['code'] = [];
        data['item_jig']=[];
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
        const cekInput = document.querySelectorAll(`input[id*="${data['key'][0]}"]`);
        for (let i=0; i<cekInput.length; i++) {
            data['item_jig'][i] = itemJig;
            const codeGet = splitCustomString("+", cekInput[i].id)
            data['code'][i] = codeGet[1];
        }
        // code, item_jig, qty_per_unit, unit, lokasi, status, id, toleransi
        let update1 = [];
        update1['code'] = data['code'];
        update1['item_jig'] = data['item_jig'];
        update1['qty_per_unit'] = data['qty_per_unit'];
        console.log(update1);
        const result = await jig_location_query.updateData(update1, filter1);     
        console.log(result);
    } catch(error){
        console.log(error);
    }

}
