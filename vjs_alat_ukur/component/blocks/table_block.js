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
        detailTD
    )
        

*/


const createTh = (thArray) =>{
    /* thArray setup : 
        {    
            defaultStyle: '',
            th: [
                {text: '', style:''},
                {text: '', style:''},
                {text: '', style:''},
            ]
        }
    */
    const header_tr = document.createElement('tr');
    header_tr.setAttribute('data-header', '');
    let dflt = thArray.defaultStyle ? thArray.defaultStyle : 'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky top-0 z-10';
    console.log({thArray});
    for (let i=0; i<thArray.th.length; i++) {
        console.log(thArray.th[i]);
        const th = document.createElement('th');
        th.textContent = thArray.th[i].text;
        if (thArray.th[i].style !== undefined && thArray.th[i].style !== '' ) {
            th.setAttribute('class', thArray.th[i].style);
        } else {
            th.setAttribute('class', dflt);
        }
        header_tr.appendChild(th);
    }
    return header_tr;
}

export const customTable = (tblArray, thArray)=>{
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
    let classStyle ='';
    if(tblArray.style !== undefined && tblArray.style !== '') {
        classStyle = tblArray.style;
    } else {
        classStyle = 'w-full h-full scrollable';
    }
    div.setAttribute('class', classStyle);
    if(tblArray.divID !== undefined && tblArray.divID !== '') {
        div.id = tblArray.divID;
    }
    
    const table = document.createElement('table');
    table.setAttribute('class', 'w-full');
        if(tblArray.tableID !== undefined && tblArray.tableID !== '') {
            table.setAttribute('data-table', tblArray.tableID);
        }
    table.appendChild(createTh(thArray));
    div.appendChild(table);
    trgt.appendChild(div);
    return;
}

/* tdArray setup
{
    target: '',
    filter; '',
    id: ''

}
*/
export const createTr = (filter, id, style) =>{
    const data_tr = document.createElement('tr');
    data_tr.setAttribute('data-filter', filter);
    data_tr.setAttribute('data-id', id);
    if(style !== undefined && style !== '') {
        data_tr.setAttribute('class',style);
    }
    return data_tr;
}

export const createTd = (style, field, id) =>{
    const td = document.createElement('td');
    if(style !== undefined && style !== '') {
        td.setAttribute('class',style);
    }
    td.setAttribute('data-field', field);
    td.setAttribute('data-id', field+id);
    return td;
}


export const td_input = (dt, data_array) =>{
    const td_input = document.createElement('input');
    td_input.type = 'text';
    td_input.autocomplete = 'off';
    td_input.value = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_input.setAttribute('data-field', data_array.field);
    if(data_array.dtlist || data_array.dtlist !=='') {td_input.setAttribute('list', data_array.dtlist)}
    if(data_array.disable !==undefined) {td_input.disabled = true}
    td_input.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    return td_input;
}

export const td_button = (dt, data_array) =>{
    const td_button = document.createElement('button');
    td_button.type = 'button';
    td_button.value = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_button.textContent = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_button.setAttribute('data-field', data_array.field);
    if(data_array.disable !==undefined) {td_button.disabled = true}
    if(data_array.btn_style !== undefined && data_array.btn_style !== '' ) {
        td_button.setAttribute('class', data_array.btn_style);
    } else {
        td_button.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    return td_button;
}


export const td_select = (dt, data_array) =>{
    const td_select = document.createElement('select');
    td_select.value = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_select.setAttribute('data-field', data_array.field);
    data_array.option.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt;
        td_select.appendChild(option);
    })
    td_select.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    return td_select;
}