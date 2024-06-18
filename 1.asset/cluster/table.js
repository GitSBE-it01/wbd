import { hidden_tr } from "../blocks/table_block.js";
import {         
    minusButton,
    symbolButton,
    div,
    initTable,
    tableHeader,
    td_input,
    td_button,
    td_select,
    td_logic,
    td_span,
} from "../index.js";

/*
==============================================================================================
empty row
==============================================================================================
*/
export const inputEmptyRow = async(target, counter, data_array) =>{
    const data_tr = document.createElement('tr');
    for (let i=0; i<data_array.length; i++) {
        const td = document.createElement('td');
        if (data_array[i].pk !== undefined) {
            data_tr.setAttribute('data-tr', `new__${counter}`);
        }
        if(data_array[i].pk === undefined || data_array[i].pk === 'show') {
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10')
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
            }

            if(data_array[i].type === 'text') {
                td.setAttribute('data-field', data_array[i].field);
                if(data_array[i].pk !== undefined) {
                    data_tr.setAttribute('data-id', `new__${counter}`)
            }}
            if(data_array[i].type === 'input') {
                td.appendChild(await td_input('new', data_array[i]));
            }
            if(data_array[i].type === 'logic') {
                td.appendChild(await td_logic('new', data_array[i]));
            }
            if(data_array[i].type === 'btnSet') {
                td.appendChild(await td_btnSet('new', data_array[i]));
            }
        data_tr.appendChild(td);
        } 
    }
    data_tr.setAttribute(`data-filter`, 'new');
    if(target !== '') {
        const trgt = document.querySelector(target);
        trgt.appendChild(data_tr);
        return;
    }
    return data_tr;
}

/*
==============================================================================================
radio selection'
==============================================================================================
*/

export const createTable = async(tableArray) =>{
    /* array setup : 
        {
            target:'',
            table: {id: '', style: ''},
            data_src: data,
            hidden_tr: '',
            data_array: [
                {},
            ]
        }
    */
    try {
        const div = document.querySelector(tableArray.target);
        const table = await initTable(tableArray.table);
        //header 
        table.appendChild(await tableHeader(tableArray.data_array));
        // data 
        for(let i =0; i<tableArray.data_src.length; i++) {
            let data = tableArray.data_src[i];
            table.appendChild(await tableData(data, tableArray.data_array));
            if(tableArray.hidden_tr !== undefined && tableArray.hidden_tr !== '') {
                table.appendChild(await hidden_tr(data, tableArray.hidden_tr));
            }
        }
        div.appendChild(table);
        return;
    } catch(error) {
        console.log('error', error);
        return;
    }
}

const tableData = async(dt, data_array) =>{
    const data_tr = document.createElement('tr');
    let filter ='';
    let id_pk ='';
    for (let i=0; i<data_array.length; i++) {
        const td = document.createElement('td');
        filter += dt[`${data_array[i].field}`] + "--";
        if (data_array[i].pk !== undefined) {
            id_pk = dt[`${data_array[i].field}`];
            data_tr.setAttribute('data-tr', id_pk);
        }
        if(data_array[i].pk === undefined || data_array[i].pk === 'show') {
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10')
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
            }

            if(data_array[i].type === 'text') {
                td.textContent = dt[`${data_array[i].field}`];
                td.setAttribute('data-field', data_array[i].field);
                if(data_array[i].pk !== undefined) {
                    data_tr.setAttribute('data-id',dt[`${data_array[i].field}`])
            }}
            if(data_array[i].type === 'input') {
                td.appendChild(await td_input(dt, data_array[i]));
            }
            if(data_array[i].type === 'logic') {
                td.appendChild(await td_logic(dt, data_array[i]));
            }
            if(data_array[i].type === 'btnSet') {
                td.appendChild(await td_btnSet(dt, data_array[i]));
            }
        data_tr.appendChild(td);
        } 
    }
    data_tr.setAttribute(`data-filter`, filter);
    return data_tr;
}

const td_btnSet = async(dt, data_array) => {
    const div = document.createElement('div');
    div.setAttribute('class', 'flex flex-row w-full gap-2');
    
    //open
    if(data_array.set.includes('open')) {
        let disableSetup = '';
        let styleSetup = `open ${data_array.style}`;
        if(data_array.set.includes('open:disable')) {
            disableSetup = true;
            styleSetup += ' opacity-25'
        }
        div.appendChild(symbolButton({
            style: styleSetup,
            desc: 'open/hide detail',
            ID: `openHide__${dt[data_array.id]}`,
            disable: disableSetup
        }))
    }

    //submit
    if(data_array.set.includes('submit')) {
        let disableSetup = '';
        let styleSetup = `enter ${data_array.style}`;
        if(data_array.set.includes('submit:disable')) {
            disableSetup = true;
            styleSetup += ' opacity-25'
        }
        div.appendChild(symbolButton({
            style: styleSetup,
            desc: 'submit change',
            ID: `submit__${dt[data_array.id]}`,
            disable: disableSetup
        }))
    }

    //edit
    if(data_array.set.includes('edit')) {
        let disableSetup = '';
        let styleSetup = `edit ${data_array.style}`;
        if(data_array.set.includes('edit:disable')) {
            disableSetup = true;
            styleSetup += ' opacity-25'
        }
        div.appendChild(symbolButton({
            style: styleSetup,
            desc: 'edit data',
            ID: `edit__${dt[data_array.id]}`,
            disable: disableSetup
        }))
    }

    //delete
    if(data_array.set.includes('del')) {
        let disableSetup = '';
        let styleSetup = `minus ${data_array.style}`;
        if(data_array.set.includes('del:disable')) {
            disableSetup = true;
            styleSetup += ' opacity-25'
        }
        div.appendChild(symbolButton({
            style: styleSetup,
            desc: 'delete data',
            ID: `delete__${dt[data_array.id]}`,
            disable: disableSetup
    }))
    }
    return div;
}


