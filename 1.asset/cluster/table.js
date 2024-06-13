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
text table
==============================================================================================
*/
const tableDataDiv = async(dt, array) =>{
    const data_tr = document.createElement('tr');
    let filter ='';
    for (let i=0; i<array.length; i++) {
        const td = document.createElement('td');
        td.textContent = dt[`${array[i].field}`];
        filter += dt[`${array[i].field}`] + "--";
        td.setAttribute('data-field', array[i].field);
        if(i === 0) {
            td.setAttribute('class','bg-slate-400 border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10')
        } else {
            td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
        }
        if(array[i].pk !== undefined) {
            data_tr.setAttribute('data-id',dt[`${array[i].field}`])
            if (array[i].pk === 'show') {
                data_tr.appendChild(td);
            }
        } else {
            data_tr.appendChild(td);
        }
    }
    data_tr.setAttribute(`data-filter`, filter);
    return data_tr;
}

export const table = async(target, tableID, tableArrayData, data) =>{
    try {
        const trgt = document.querySelector(target);
        const div = document.createElement('div');
        div.setAttribute('class', 'w-full h-full scrollable');
        div.setAttribute('data-table',tableID);
        const table = document.createElement('table');
        table.setAttribute('class', 'w-full bg-teal-400 ');
        //header 
        table.appendChild(await tableHeader(tableArrayData));
        // data 
        for(let i =0; i<data.length; i++) {
            table.appendChild(await tableDataDiv(data[i], tableArrayData));
        }
        div.appendChild(table);
        trgt.appendChild(div);
        return;
    } catch(error) {
        console.log('error', error);
        return;
    }
}

/*
==============================================================================================
input table
==============================================================================================
*/
const tableDataInput = async(dt, array) =>{
    try{
        const data_tr = document.createElement('tr');
        let filter ='';
        let idBtn = '';
        for (let i=0; i<array.length; i++) {
            // create input
            const el = document.createElement('input');
            el.type = 'text';
            el.value = dt[`${array[i].field}`] ? dt[`${array[i].field}`] : '';
            el.autocomplete = 'off';
            el.setAttribute('data-field', array[i].field);
            if(array[i].list || array[i].list !=='') {el.setAttribute('list', array[i].list)}
            if(array[i].disable !==undefined) {el.disabled = true}
            // create td
            const td = document.createElement('td');
            td.appendChild(el);
            // filter
            filter += dt[`${array[i].field}`] + "--";
            // style utk td dan element dengan ketentuan yg paling atas atau paling kiri beda dengan yang lain
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-sm border-black sticky left-0 z-10 font-semibold')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
            }
            idBtn = dt[`${array[i].pk}`];
            if(array[i].pk !== undefined) {
                data_tr.setAttribute('data-id',dt[`${array[i].field}`])
                if (array[i].pk === 'show') {
                    data_tr.appendChild(td);
                }
            } else {
                data_tr.appendChild(td);
            }
        }
        data_tr.appendChild(minusButton(idBtn, 'hidden w-4 h-4 mt-1 fixed right-6 z-20'));
        data_tr.setAttribute(`data-filter`, filter);
        return data_tr;
    }catch(error) {
        console.log('error', error);
        return;
    }
}

export const inputTable = async(target, tableID, tableArrayData, data) =>{
    try {
        const trgt = document.querySelector(target);
        const div = document.createElement('div');
        div.setAttribute('class', 'w-full h-full bg-teal-100 scrollable');
        div.setAttribute('data-table',tableID);
        const table = document.createElement('table');
        table.setAttribute('class', 'w-full bg-teal-400 ');
        //header 
        table.appendChild(await tableHeader(tableArrayData));
        //data
        for(let i =0; i<data.length; i++) {
            table.appendChild(await tableDataInput(data[i], tableArrayData));
        }
        div.appendChild(table);
        trgt.appendChild(div);
        return;
    }catch(error) {
        console.log('error', error);
        return;
    }
}

/*
==============================================================================================
empty row
==============================================================================================
*/
export const inputEmptyRow = async(target, counter, array) =>{
    try{
        const trgt = document.querySelector(target);
        const data_tr = document.createElement('tr');
        let filter ='';
        for (let i=0; i<array.length; i++) {
            const el = document.createElement('input');
            el.type = 'text';
            el.placeholder = array[i].header ? array[i].header : '';
            el.autocomplete = 'off';
            el.setAttribute('data-field', array[i].field);
            if(array[i].list || array[i].list !=='') {el.setAttribute('list', array[i].list)}
            if(array[i].disable !==undefined) {el.disabled = true}
            const td = document.createElement('td');
            td.appendChild(el);
            if(i === 0) {
                td.setAttribute('class','bg-slate-200 border-4 text-sm border-blue-200 sticky left-0 z-10 font-semibold')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
            } else {
                td.setAttribute('class','bg-slate-200 border-4 text-sm border-blue-200')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
            }
            if(array[i].pk !== undefined) {
                data_tr.setAttribute('data-id',`new-${counter}`)
                if (array[i].pk === 'show') {
                    data_tr.appendChild(td);
                }
            } else {
                data_tr.appendChild(td);
            }
        }
        data_tr.setAttribute(`data-filter`, filter);
        trgt.insertBefore(data_tr, trgt.childNodes[1]);
        return;
    }catch(error) {
        console.log('error', error);
        return;
    }
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
        if(data_array[i].pk === undefined || data_array[i].pk !== '') {
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
                    if (data_array[i].pk === 'show') {
                        data_tr.appendChild(td);
                    }
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
        } else {
            id_pk = dt[`${data_array[i].field}`];
        }
    }
    data_tr.setAttribute('data-id', id_pk);
    data_tr.setAttribute(`data-filter`, filter);
    return data_tr;
}

const td_btnSet = async(dt, data_array) => {
    const div = document.createElement('div');
    div.setAttribute('class', 'flex flex-row w-full gap-2');
    if(data_array.set.includes('open')) {div.appendChild(symbolButton('openHide', dt[data_array.id], `open ${data_array.style}`))}
    if(data_array.set.includes('submit')) {div.appendChild(symbolButton('submit', dt[data_array.id], `enter ${data_array.style}`))}
    if(data_array.set.includes('edit')) {div.appendChild(symbolButton('edit', dt[data_array.id], `edit ${data_array.style}`))}
    if(data_array.set.includes('del')) {div.appendChild(symbolButton('delete', dt[data_array.id], `delete ${data_array.style}`))};
    return div;
}


