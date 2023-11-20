import {jig_master_query,list_location, jig_function_query, item_detail_query} from '../../class.js';

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

export const locList = async(idList) => {
    try {
        const container = document.querySelector('body');
        const data = await list_location.getData();
        const select = document.createElement('datalist');
        select.id = idList;

        for (let i=0; i<data.length; i++) {
            const option = document.createElement('option');
            option.value = data[i].name;
            option.textContent = data[i].name;
            select.appendChild(option);
        }
        container.appendChild(select);
 } catch(error) {
    console.log(error);
 }
}

export const spkList = async(idList) => {
    try {
        const container = document.querySelector('body');
        const data = await jig_function_query.getData();
        const data2 = await item_detail_query.getData();
        const gabData = data.map((obj1) => {
            const matchedObj = data2.find((obj2)=> obj2.pt_part === obj1.item_type);
            return {
                item_type: obj1.item_type,
                desc: matchedObj ? matchedObj.pt_desc1 +  matchedObj.pt_desc2: "" 
            };
        })
        const select = document.createElement('datalist');
        select.id = idList;

        for (let i=0; i<gabData.length; i++) {
            const option = document.createElement('option');
            option.value = gabData[i].item_type;
            option.textContent = gabData[i].item_type + " -- " + gabData[i].desc;
            select.appendChild(option);
        }
        container.appendChild(select);
 } catch(error) {
    console.log(error);
 }
}

