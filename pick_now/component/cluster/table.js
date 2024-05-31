import { minusButton } from "../index.js";

export const table = async(target, tableID, arr, data) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'w-full h-full scrollable');
    div.setAttribute('data-table',tableID);
    const table = document.createElement('table');
    table.setAttribute('class', 'w-full bg-teal-400 ');
    
    const header_tr = document.createElement('tr');
    for (let i=0; i<arr.length; i++) {
        const th = document.createElement('th');
        th.textContent = arr[i].header;
        if (i===0) {
            th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20');
        } else {
            th.setAttribute('class','bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10');
        }
        header_tr.appendChild(th);
    }
    table.appendChild(header_tr);

    data.forEach(dt=>{
        const data_tr = document.createElement('tr');
        let filter ='';
        for (let i=0; i<arr.length; i++) {
            const td = document.createElement('td');
            td.textContent = dt[`${arr[i].data}`];
            filter += dt[`${arr[i].data}`] + "--";
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10')
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
            }
            data_tr.appendChild(td);
        }
        data_tr.setAttribute(`data-filter`, filter);
        table.appendChild(data_tr)
    })
    div.appendChild(table);
    trgt.appendChild(div);
}

export const inputTable = async(target, tableID, arr, data) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'w-full h-full bg-teal-100 scrollable');
    div.setAttribute('data-table',tableID);
    const table = document.createElement('table');
    table.setAttribute('class', 'w-full bg-teal-400 ');
    
    const header_tr = document.createElement('tr');
    header_tr.setAttribute('data-header','');
    for (let i=0; i<arr.length; i++) {
        if(!arr[i].pk) {
            const th = document.createElement('th');
            th.textContent = arr[i].header;
            if (i===0) {
                th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20');
            } else {
                th.setAttribute('class','bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10');
            }
            header_tr.appendChild(th);
        }
    }
    table.appendChild(header_tr);

    data.forEach(dt=>{
        const data_tr = document.createElement('tr');
        let filter ='';
        let idBtn = '';
        for (let i=0; i<arr.length; i++) {
            if(!arr[i].pk) {
                const el = document.createElement('input');
                el.type = 'text';
                el.value = dt[`${arr[i].data}`] ? dt[`${arr[i].data}`] : '';
                el.autocomplete = 'off';
                el.setAttribute('data-field', arr[i].data);
                if(arr[i].list || arr[i].list !=='') {el.setAttribute('list', arr[i].list)}
                if(arr[i].disable || arr[i].disable !=='') {el.disabled = arr[i].disable}
                const td = document.createElement('td');
                td.appendChild(el);
                filter += dt[`${arr[i].data}`] + "--";
                if(i === 0) {
                    td.setAttribute('class','bg-slate-400 border-2 text-sm border-black sticky left-0 z-10 font-semibold')
                    el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
                } else {
                    td.setAttribute('class','bg-slate-300 border-2 text-sm border-black')
                    el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
                }
                data_tr.appendChild(td);
            } else {
                idBtn = dt[`${arr[i].pk}`];
                data_tr.setAttribute('data-id', dt[`${arr[i].pk}`]);
            }
        }
        data_tr.appendChild(minusButton(idBtn, 'hidden w-3 v-3 fixed right-6'));
        data_tr.setAttribute(`data-filter`, filter);
        table.appendChild(data_tr)
    })
    div.appendChild(table);
    trgt.appendChild(div);
}


export const inputEmptyRow = async(target, counter, arr) =>{
    const trgt = document.querySelector(target);
    const data_tr = document.createElement('tr');
    let filter ='';
    for (let i=0; i<arr.length; i++) {
        if(!arr[i].pk) {
            const el = document.createElement('input');
            el.type = 'text';
            el.value = arr[i].header ? arr[i].header : '';
            el.autocomplete = 'off';
            el.setAttribute('data-field', arr[i].data);
            if(arr[i].list || arr[i].list !=='') {el.setAttribute('list', arr[i].list)}
            if(arr[i].disable || arr[i].disable !=='') {el.disabled = arr[i].disable}
            const td = document.createElement('td');
            td.appendChild(el);
            if(i === 0) {
                td.setAttribute('class','bg-slate-200 border-4 text-sm border-blue-200 sticky left-0 z-10 font-semibold')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
            } else {
                td.setAttribute('class','bg-slate-200 border-4 text-sm border-blue-200')
                el.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-100 focus:outline-blue-600 bg-transparent');
            }
            data_tr.appendChild(td);
        } else {
        data_tr.setAttribute('data-id', `new-${counter}`);
        }
    }
    data_tr.setAttribute(`data-filter`, filter);
    trgt.insertBefore(data_tr, trgt.childNodes[1]);
    return;
}