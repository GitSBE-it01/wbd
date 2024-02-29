import { tableVJS, createTable, createHeader, createBtn, header4, openVJS, btnVjsEdit,
    btnVjsSbmt, headerForm, addVJS,  minVJS } from "../../component/index.js";


export const initVJS = async(data) =>{
    let cekResult = [];
    if(data[0].dmc_vjs.substring(3) !== '') {
        data.forEach(dt=>{
            const val = dt.dmc_vjs.substring(3);
            if(!cekResult.includes(val)) {
                cekResult.push(val);
            }
        })
    }

    const vjsDivAll = document.getElementById('vjsDivAll');
    if(cekResult.length>0) {
        for (let i = 0; i<cekResult.length; i++) {
            const mainVJS = document.createElement('div');
            mainVJS.id = `mainVJS${cekResult[i]}`;
            mainVJS.setAttribute('data-div',`mainVJS--${cekResult[i]}`);
            mainVJS.classList.add('tl7', 'p2');
            await createHeader(header4(`vjsDivAll`, cekResult[i]));
            vjsDivAll.appendChild(mainVJS);
            const docHD = document.getElementById(`hdVJS${cekResult[i]}`);
            docHD.appendChild(await createBtn(openVJS(cekResult[i])));
            const dataFix = data.filter(dt=> dt.dmc_vjs === `VJS${cekResult[i]}`);
            await formVJS(dataFix, cekResult[i]);
        }
        return;
    }

    const cekFirst = document.querySelectorAll('[data-div*="mainVJS"]');
    cekFirst.forEach(dt => {
        const value = dt.getAttribute('data-div');
        const splt = value.split("--");
        if(!cekResult.includes(splt[1])) {cekResult.push(splt[1]);}
    })
    let counter = cekResult.length + 1;
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
    await createTable(headerForm([data[0]], counter));
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



