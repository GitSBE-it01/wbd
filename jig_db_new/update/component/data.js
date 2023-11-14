import { splitCustomString } from '../../component/process.js';

export const updateInsertData = async() => {
    try {
        const arrInput = document.querySelectorAll('[data-input]');
        const itemJig = document.getElementById('searchStock').value;        
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
        console.log(data);
    } catch(error){
        console.log(error);
    }

}
