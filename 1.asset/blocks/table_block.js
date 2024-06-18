export const initTable = async(array) =>{
    const table = document.createElement('table');
    if(array.style !== undefined && array.style !== '') {
        table.setAttribute('class', array.style);
    } else {
        table.setAttribute('class', 'w-full ');
    }
    table.setAttribute('data-table',array.id);
    return table;
}


export const tableHeader = async(array) =>{
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

            if(array[i].headerStyle !== undefined && array[i].headerStyle !== '') {
                 th.setAttribute('class', array[i].headerStyle);
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

export const td_input = async(dt, data_array) =>{
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
    td_input.value = dt[data_array.field] ? dt[data_array.field] : '';
    td_input.setAttribute('data-field', data_array.field);
    if(data_array.dtlist !== undefined && data_array.dtlist !=='') {td_input.setAttribute('list', data_array.dtlist)}
    if(data_array.disable !==undefined) {td_input.disabled = true}
    if(data_array.style !== undefined && data_array.style !=='') {
        td_input.setAttribute('class', data_array.style);
    } else {
        td_input.setAttribute('class', 'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
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


export const td_logic = async(dt, data_array) =>{
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
    const divMain = document.createElement('div');
    if(data_array.divStyle !== undefined && data_array.divStyle !=='') {
        divMain.setAttribute('class', data_array.divStyle);
    } else {
        divMain.setAttribute('class', 'flex flex-col px-2 ');
    }

    // symbol check cross or minus
    const span = document.createElement('span');
    const spanValue = dt[data_array.field] ? dt[data_array.field] : '-';
    span.setAttribute('data-value', spanValue);
    span.setAttribute('class', 'minus w-8 h-8 justfiy-center ');
    if(spanValue.toUpperCase() === 'OK') {span.setAttribute('class', 'check w-8 h-8 justfiy-center');}
    if(spanValue.toUpperCase() === 'NG') {span.setAttribute('class', 'cross w-8 h-8 justfiy-center');}
    const logic = ['OK', 'NG'];
    const divSecond = document.createElement('div');
    divSecond.setAttribute('class', 'flex flex-row items-center');
    logic.forEach(dt2=>{
        const div = document.createElement('div');
        div.setAttribute('class', 'flex flex-row px-2 ');
        const td_radio = document.createElement('input');
        td_radio.type = 'radio';
        td_radio.setAttribute('data-field',data_array.field);
        td_radio.name = data_array.field + dt[data_array.id];

        if(data_array.disable !==undefined) {td_radio.disabled = true;}
        if(spanValue.toUpperCase() === dt2 ) {td_radio.setAttribute('checked',true);} 
        td_radio.id = `${dt[data_array.id]}__${dt2}`;
    
        const label = document.createElement('label');
        label.setAttribute("for", `${dt[data_array.id]}__${dt2}`);
        label.textContent = dt2;
        div.appendChild(label);
        div.appendChild(td_radio);
        divSecond.appendChild(div);
    })
    divMain.appendChild(span);
    divMain.appendChild(divSecond);
    return divMain;
}

export const td_span = (data_array) =>{
    /* data_array setup : 
        {
            target: '',
            text: '',
            style: ''
        },
    */
    const td_span = document.createElement('span');
    td_span.textContent = data_array.text ? data_array.text : '';
    if(data_array.style !== undefined && data_array.style !=='') {
        td_span.setAttribute('class', data_array.style);
    } 
    if(data_array.target !== undefined && data_array.target !== '') {
        const trgt = document.querySelector(data_array.target);
        if(trgt) {
            return trgt.appendChild(td_span);
        }
    }
    return td_span;
}

export const hidden_tr = async(dt, array) =>{
    const tr = document.createElement('tr');
    const td = document.createElement('td');
    td.setAttribute('class', 'hidden m-2');
    td.setAttribute('data-id',`${dt[array.field]}__detail`);
    if(array.colspan !==undefined && array.colspan !=='') {
        td.setAttribute('colspan', array.colspan);
    }
    if(array.rowspan !==undefined && array.rowspan !=='') {
        td.setAttribute('rowspan', array.rowspan);
    }
    tr.appendChild(td);
    return tr;
}