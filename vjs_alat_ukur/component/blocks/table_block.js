/* complete table : 
customTable({
    table: {
        target: '',
        style: '',
        ID:''
    },
    setting: {
        th_style: '',
        th_style_first: ''.
        td_style: '',
        td_style_first: ''.
        td_style_even: '',
    },
    data_array : [
        {
            header: '',
            field: '',
            ///optional
            type: '',
            pk: '',

        }
    ]
)
*/

export const tableDiv = (array) =>{
    /* array example
    tableDiv({
        target: '',
        style: '',
        ID:''
    })
    */
    const trgt = document.querySelector(array.target);
    const table = document.createElement('table');
    const classStyle = array.style ? array.style : 'w-full h-full';
    table.setAttribute('class', classStyle);
    table.setAttribute('data-table', array.ID);
    trgt.appendChild(table);
    return;
}


export const th = (setting, data) =>{
    /*setting
    {
        target:'',
        th_style_first: ''.
        th_style: '',
    }
    */
    const trgt = document.querySelector(setting.target);
    const header_tr = document.createElement('tr');
    for (let i=0; i<data.length; i++) {
        if(arrya[i].pk === undefined || array[i].pk === 'show') {
            const th = document.createElement('th');
            th.textContent = data[i].header;
            if (i===0) {
                if(!setting.th_style_first) {
                    th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20');
                } else {
                    th.setAttribute('class', setting.th_style_first);
                }
            } else {
                if(!setting.th_style) {
                    th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky top-0 z-10');
                } else {
                    th.setAttribute('class', setting.th_style);
                }
            }
            header_tr.appendChild(th);
        }
    }
    trgt.appendChild(header_tr);
    return;
}

/*
const data = [
    {
        header:'Periode', 
        field: 'period',
        pk:'',
    },
    {header:'', 
    field: 'id_vjs_h', 
    pk:''},
];
*/
export const td = (dt, data_array) =>{
    /*setting
    [[],[],[]]
    {
        target:'',
        td_style: '',
        td_style_first: ''.
        td_style_even: '',
    },
    {
        header: '',
        field: '',
        type: '', text, input, button, select
        dtlist: '', if input
        disable: '', if input or button

    }
    */
    const data_tr = document.createElement('tr');
    let filter ='';
    for (let i=0; i<data_array.length; i++) {
        if(arrya[i].pk === undefined || data_array[i].pk === 'show') {
            // create td
            const td = document.createElement('td');
            let el ='';
            filter += dt[`${data_array[i].field}`] + "--";
            // style
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-sm border-black sticky left-0 z-10 font-semibold');
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black');
            }
            // create Element 
            if(data_array[i].type === 'input') {
                el = td_input(dt, data_array[i]);
                td.appendChild(el);
            };
            if(data_array[i].type === 'button') {
                el = td_button(dt, data_array[i]);
                td.appendChild(el);
            };
            if(data_array[i].type === 'select') {
                el = td_select(dt, data_array[i]);
                td.appendChild(el);
            };
            if(data_array[i].type === 'text') {
                td.classList.add('p-2');
                td.textContent = dt[`${data_array[i].field}`];
                td.setAttribute('data-field', data_array[i].field);
            };
            data_tr.appendChild(td);
        } else {
            data_tr.setAttribute('data-id',dt[`${data_array[i].field}`])
        }
    }
    data_tr.setAttribute(`data-filter`, filter);
    return data_tr;
}


const td_input = (dt, data_array) =>{
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

const td_button = (dt, data_array) =>{
    const td_button = document.createElement('button');
    td_button.type = 'button';
    td_button.value = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_button.setAttribute('data-field', data_array.field);
    if(data_array.disable !==undefined) {td_button.disabled = true}
    if(data_array.btn_style !== undefined && data_array.btn_style !== '' ) {
        td_button.setAttribute('class', data_array.btn_style);
    } else {
        td_button.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    return td_button;
}


const td_select = (dt, data_array) =>{
    const td_select = document.createElement('select');
    td_select.value = dt[`${data_array.field}`] ? dt[`${data_array.field}`] : '';
    td_select.setAttribute('data-field', data_array.field);
    data_array.option.forEach(dt=>{
        
    })
    td_select.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    return td_select;
}