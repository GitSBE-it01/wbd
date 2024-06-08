import { minusButton } from "../index.js";

/*
==============================================================================================
table header
==============================================================================================
*/
const tableHeader = async(array) =>{
    try {
        const header_tr = document.createElement('tr');
        for (let i=0; i<array.length; i++) {
            const th = document.createElement('th');
            th.textContent = array[i].header;
            if (i===0) {
                th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20');
            } else {
                th.setAttribute('class','bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10');
            }
            if(array[i].pk !== undefined) {
                if (array[i].pk === 'show') {
                    header_tr.appendChild(th);
                }
            } else {
                header_tr.appendChild(th);
            }
        }
        return header_tr;
    } catch(error) {
        console.error('error', error);
        return;
    }
}

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

