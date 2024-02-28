import { tableVJS, createTable, createHeader, createBtn, header4, openVJS, btnVjsEdit,
    btnVjsSbmt, headerForm, addVJS,  minVJS } from "../../component/index.js";


export const initVJS = async(data) =>{
    const cekFirst = document.querySelectorAll('[data-div*="mainVJS"]');
    let cekResult = [];
    cekFirst.forEach(dt => {
        const value = dt.getAttribute('data-div');
        const splt = value.split("--");    
        cekResult.push(splt[1]);
    })
    let counter = cekResult.length + 1;
    const vjsDivAll = document.getElementById('vjsDivAll');
    const mainVJS = document.createElement('div');
    mainVJS.id = `mainVJS${counter}`;
    mainVJS.setAttribute('data-div',`mainVJS--${counter}`);
    mainVJS.classList.add('tl7', 'p2');
    await createHeader(header4(`vjsDivAll`, counter));
    vjsDivAll.appendChild(mainVJS);
    const docHD = document.getElementById(`hdVJS${counter}`);
    docHD.appendChild(await createBtn(openVJS(counter)));
    await formVJS(data, counter);
    counter ++;
    return;
}

const formVJS = async(data, counter) => {
    await createTable(headerForm(counter));
    await createTable(tableVJS(data, counter));
    const hidDiv = vjsDivAll.querySelectorAll('.fullwidth');
    hidDiv.forEach(hid=>{
        hid.classList.remove('displayHide');
    })
    const mainVJS = document.getElementById(`mainVJS${counter}`);
    const vjsEdit = await createBtn(btnVjsEdit(counter));
    const vjsSbmt = await createBtn(btnVjsSbmt(counter));
    mainVJS.appendChild(vjsEdit);
    const vjsEdt = document.querySelector(`[data-btn*=vjsEdit--${counter}]`);
    vjsEdt.disabled = true;
    mainVJS.appendChild(vjsSbmt);
    const minDivVJS= await createBtn(minVJS(counter));
    mainVJS.appendChild(minDivVJS);
    const addDivVJS= await createBtn(addVJS(counter));
    mainVJS.appendChild(addDivVJS);
    return;
}



