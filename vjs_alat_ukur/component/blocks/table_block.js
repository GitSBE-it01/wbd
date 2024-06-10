/*
setup custom table : 
1. customTable first for setup div and table tag
2. th for header 
3. tr for row and td for detail of it 
it is like this : 

custom table
    headerArray.foreach(
        createTh
    )
    data.foreach(
        list detail created for each data. tr and also td
        createTr
            createTd
                td_input
                td_button
                td_select
            createTd
            createTd
        createTr
            createTd
    )
        

*/
export const customTable = (tblArray)=>{
    /* tblArray setup : 
        {
            target: '',
            divID: '',
            tableID: '',
            style: ''
        },
    */
    const trgt = document.querySelector(tblArray.target);
    const div = document.createElement('div');
    if(tblArray.style !== undefined && tblArray.style !=='') {
        div.setAttribute('class', tblArray.style);
    } else {
        div.setAttribute('class', 'w-full h-full scrollable');
    }
    if(tblArray.divID !== undefined && tblArray.divID !== '') {
        div.id = tblArray.divID;
    }
    
    const table = document.createElement('table');
    table.setAttribute('class', 'w-full');
        if(tblArray.tableID !== undefined && tblArray.tableID !== '') {
            table.setAttribute('data-table', tblArray.tableID);
        } else { table.setAttribute('data-table','');}
    div.appendChild(table);
    trgt.appendChild(div);
    return;
}

export const createTh = (thArray) =>{
    /* thArray setup : 
        {    
            target: '',
            trStyle:'',
            id: '',
            defaultStyle: '',
            th: [
                {text: '', style:''},
                {text: '', style:''},
                {text: '', style:''},
            ]
        }
    */
    const header_tr = document.createElement('tr');
    if(thArray.trStyle !== undefined && thArray.trStyle !== '') {
        header_tr.setAttribute('class', thArray.trStyle);
    } 
    if(thArray.ID !== undefined && thArray.ID !== '') {
        header_tr.setAttribute('data-th', thArray.ID);
    } else  {
        header_tr.setAttribute('data-th', '');
    }
    let dflt = thArray.defaultStyle ? thArray.defaultStyle : 'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky top-0 z-10';
    for (let i=0; i<thArray.th.length; i++) {
        const th = document.createElement('th');
        th.textContent = thArray.th[i].text;
        if (thArray.th[i].style !== undefined && thArray.th[i].style !== '' ) {
            th.setAttribute('class', thArray.th[i].style);
        } else {
            th.setAttribute('class', dflt);
        }
        header_tr.appendChild(th);
    }
    const trgt = document.querySelector(thArray.target);
    if(trgt) {
        return trgt.appendChild(header_tr);
    }
    return header_tr;
}

export const createTr = (trArray) =>{
    /* trArray setup : 
        {
            target: '',
            filter: '',
            id: '',
            style: ''
        },
    */
    const trgt = document.querySelector(trArray.target);
    const data_tr = document.createElement('tr');
    data_tr.setAttribute('data-filter', trArray.filter);
    data_tr.setAttribute('data-tr', trArray.id);
    if(trArray.style !== undefined && trArray.style !== '') {
        data_tr.setAttribute('class',trArray.style);
    }
    if(trgt) {
        return trgt.appendChild(data_tr);
    }
    return data_tr;
}

export const createTd = (tdArray) =>{
    /* tdArray setup : 
        {
            target: '',
            field: '',
            id: '',
            style: ''
        },
    */
    const td = document.createElement('td');
    if(tdArray.style !== undefined && tdArray.style !== '') {
        td.setAttribute('class',tdArray.style);
    } else {
        td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
    }
    if(tdArray.field !== undefined && tdArray.field !== '') {
        td.setAttribute('data-field', tdArray.field);
    }
    if(tdArray.text !== undefined && tdArray.text !== '') {
        td.textContent = tdArray.text;
        }
    if(tdArray.id !== undefined && tdArray.id !== '') {
        td.setAttribute('data-td', `${tdArray.id}`);
    }
    if(tdArray.target !== undefined && tdArray.target !== '') {
        const trgt = document.querySelector(tdArray.target);
        if(trgt) {
            return trgt.appendChild(td);
        }
    }
    return td;
}


export const td_input = (data_array) =>{
    /* data_array setup : 
        {
            target: '',
            field: '',
            dtlist:'',
            text: '',
            disable:'',
            style: ''
        },
    */
    const td_input = document.createElement('input');
    td_input.type = 'text';
    td_input.autocomplete = 'off';
    td_input.placeholder = data_array.text ? data_array.text : 'input text here';
    td_input.value = data_array.field ? data_array.field : '';
    td_input.setAttribute('data-field', data_array.field);
    if(data_array.dtlist !== undefined && data_array.dtlist !=='') {td_input.setAttribute('list', data_array.dtlist)}
    if(data_array.disable !==undefined) {td_input.disabled = true}
    if(data_array.style !== undefined && data_array.style !=='') {
        td_input.setAttribute('class', data_array.style);
    } else {
        td_input.setAttribute('class', 'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    if(data_array.target !== undefined && data_array.target !== '') {
        const trgt = document.querySelector(data_array.target);
        if(trgt) {
            return trgt.appendChild(td_input);
        }
    }
    return td_input;
}

export const td_button = (data_array) =>{
    /* data_array setup : 
        {
            target: '',
            field: '',
            text: '',
            disable:'',
            style: ''
        },
    */
    const td_button = document.createElement('button');
    td_button.type = 'button';
    td_button.value = data_array.field ? data_array.field : '';
    td_button.textContent = data_array.text ? data_array.text : '';
    td_button.setAttribute('data-field', data_array.field);
    if(data_array.disable !==undefined) {td_button.disabled = true}
    if(data_array.style !== undefined && data_array.style !== '' ) {
        td_button.setAttribute('class', data_array.style);
    } else {
        td_button.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    if(data_array.target !== undefined && data_array.target !== '') {
        const trgt = document.querySelector(data_array.target);
        console.log('here', trgt);
        if(trgt) {
            return trgt.appendChild(td_button);
        }
    }
    return td_button;
}


export const td_select = (data_array) =>{
    /* data_array setup : 
        {
            target: '',
            field: '',
            option: [],
            disable:'',
            style: ''
        },
    */
    const td_select = document.createElement('select');
    td_select.value = data_array.field ? data_array.field : '';
    td_select.setAttribute('data-field', data_array.field);
    data_array.option.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt;
        td_select.appendChild(option);
    })
    if(data_array.disable !==undefined) {td_select.disabled = true}
    if(data_array.style !== undefined && data_array.style !== '' ) {
        td_select.setAttribute('class', data_array.style);
    } else {
        td_select.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    if(data_array.target !== undefined && data_array.target !== '') {
        const trgt = document.querySelector(data_array.target);
        if(trgt) {
            return trgt.appendChild(td_select);
        }
    }
    return td_select;
}