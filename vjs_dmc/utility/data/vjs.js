import { tableVJS, createTable, createHeader, header3, createDatalist, woList, headerForm } from "../../component/index.js";
import { bom, wo_list } from "../class.js";

export const initVJS = async(data, vjsEdit, vjsSbmt) =>{
    const vjs = await bom.fetchDataFilter({category: data[2], dmc_vjs: 'vjs'});
    let counter = 1;
    const vjsDivAll = document.createElement('div');
    vjsDivAll.id = 'vjsDivAll';
    const main = document.getElementById('main');
    main.appendChild(vjsDivAll);
    const mainVJS = document.createElement('div');
    mainVJS.id = 'mainVJS';
    vjsDivAll.appendChild(mainVJS);
    await createHeader(header3);
    const woDT = await wo_list.fetchDataFilter({wo_status:'R'});
    await createDatalist(woList(woDT));
    await createTable(headerForm());
    await createTable(tableVJS(vjs));
    const hidDiv = vjsDivAll.querySelectorAll('.fullwidth');
    hidDiv.forEach(hid=>{
        hid.classList.remove('displayHide');
    })
    counter ++;
    vjsDivAll.appendChild(vjsEdit);
    vjsDivAll.appendChild(vjsSbmt);
    return;
}

