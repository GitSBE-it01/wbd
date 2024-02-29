/*
const nameInput = 'preload';
const dbName = 'jig_database';
const storeName = 'dataStore_db';
const parameter1 = 'jig_master'; 
const parameter2 = 'new_jig_drawing'; 
const parameter3 = 'list_location'; 
const parameter4 = 'list_mtnc'; 
const parameter5 = 'new_jig_usage'; 
const parameter6 = 'new_jig_mtnc'; 
const parameter7 = 'new_jig_function'; 
const parameter8 = 'new_item_detail';
const storageKey1 = 'preload-jig_master';
const storageKey2 = 'preload-new_jig_drawing';
const storageKey3 = 'preload-list_location';
const storageKey4 = 'preload-list_mtnc';
const storageKey5 = 'preload-new_jig_usage';
const storageKey6 = 'preload-new_jig_mtnc';
const storageKey7 = 'preload-new_jig_function';
const storageKey8 = 'preload-new_item_detail';

document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/jig_db_new/add_data/';
    const extractedPortion = currentUrl.substring(0,specificUrls.length);
    if (extractedPortion == specificUrls){
        let result1 = await fetchedDataIndexDB(dbName, storeName, storageKey1, parameter1);
        let result3 = await fetchedDataIndexDB(dbName, storeName, storageKey3, parameter3);
        let result4 = await fetchedDataIndexDB(dbName, storeName, storageKey4, parameter4);
        let result8 = await fetchedDataIndexDB(dbName, storeName, storageKey8, parameter8);
        console.log({result1,result3,result4,result8});
        const populate1 = document.getElementById('suggestion2');//type speaker
        const populate2 = document.getElementById('suggest3'); //lokasi
        const populate3 = document.getElementById('suggest'); // item jig
        const populate4 = document.getElementById('type_jig'); // item jig
        const data = result8.map((obj1) => {
            return {
                item_speaker: obj1.pt_part,
                description: obj1.pt_desc1
          }
        });
        const data2 = result3.map((obj1) => {
            return {
                lokasi: obj1.name
            }
        });
        const data3 = result1.map((obj1) => {
            return {
                item_jig: obj1.item_jig,
                desc_jig: obj1.desc_jig,
          }
        });
        const data4 = result4.map((obj1) => {
            return {
                type: obj1.type_jig,
                mtnc_std_lifetime: obj1.mtnc_std_lifetime,
                mtnc_by: obj1.mtnc_by,
                lftm_unit: obj1.lftm_unit
          }
        });

        for (let i =0; i<data.length; i++){
            const option = document.createElement('option');
            option.value = data[i].item_speaker + "  //  " + data[i].description;
            populate1.appendChild(option);
        }

        for (let i =0; i<data2.length; i++){
            const option = document.createElement('option');
            option.value = data2[i].lokasi
            populate2.appendChild(option);
        }

        for (let i =0; i<data3.length; i++){
            const option = document.createElement('option');
            option.value = data3[i].item_jig + "  //  " + data3[i].desc_jig;
            populate3.appendChild(option);
        }

        for (let i =0; i<data4.length; i++){
            const option = document.createElement('option');
            option.value = data4[i].type;
            populate4.appendChild(option);
        }
    }
})*/

document.addEventListener("keyup", function(event) {
    if (event.target.getAttribute('id') === 'qty0') {
        const container = document.getElementById('qty_total');
        const qtySrc = document.querySelectorAll('#qty0');
        let sum = 0;
        qtySrc.forEach(item => {
            const value = parseFloat(item.value);
            if (!isNaN(value)) {
                sum += value;
            }
        });
        container.value = sum;
        console.log(sum);
    }
});


