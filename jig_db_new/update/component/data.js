import { splitCustomString } from '../../component/process.js';

export const updateInsertData = async() => {
    try {
        const arrInput = document.querySelectorAll('[data-input]');
        let data = [];
        for (let i=0; i<arrInput.length; i++) {
            const rawId = arrInput[i].id;
            const id = splitCustomString("-", rawId);
            const key = id[0];
            const value = arrInput[i].value;
            if (!data[key]) {
                data[key] = [{ value }];
            } else {
                data[key].push({ value });
            }
        }
        console.log(data);
    } catch(error){
        console.log(error);
    }

}
