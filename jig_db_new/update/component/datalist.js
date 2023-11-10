import {jig_master_query} from '../../class.js';

export const datalistLoc = async(idList) => {
    try {
        const container = document.querySelector('body');
        const data = await jig_master_query.getData();
        const select = document.createElement('datalist');
        select.id = idList;

        for (let i=0; i<data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].item_jig;
            option.textContent = data[i].item_jig + " -- " + data[i].desc_jig;
            select.appendChild(option);
        }
        container.appendChild(select);
 } catch(error) {
    console.log(error);
 }
}
