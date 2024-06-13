/*
div 
custom table(setting, detail)
setting = {
    target: '',
    id: '',
    style: {
        table: '',
        row_header: '',
        header: '',
        row_data: '',
        data: '',
    }
},
header = [
    {text:'', style:''},
    {text:'', style:''},
]
tr_data = [
    {
        header: '',
        style: {
            div: '',
            header: '',
            data: ''
        },
        detail: [
            {
                type:'',
                style: '',
                field: '',
                text: '',
                id: '',

            },
            {}
        ] 
    },
]

*/
    /*
        setting = {
            target: '',
            id: '',
            style: {
                table: '',
                row_header: '',
                header: '',
                row_data: '',
                data: '',
            }
        },
    */

    /*
    tr_data = {
    0:[{
        type:'',
        style: '',
        field: '',
        text: '',
        id: '',
    },
{}]
    },
}
    */
export const custom_table = (setting, thead, tr_data, data)=>{
    /*setting = {
        target: '',
        id: '',
        style: {
            table: '',
            row_header: '',
            header: '',
            row_data: '',
            data: '',
        }
    },*/
    //target
    const table = document.createElement('table');
    if(setting.id !== undefined && setting.id !== '') {
        table.id = setting.id;
    }
    //style table;
    table.setAttribute('class', 'w-full');
    if(setting.style !== undefined && setting.style.table !== undefined && setting.style.table !== '') {
        table.setAttribute('class', setting.style.table);
    }

    //additional detail
    const key = Object.keys(setting);
    const dflt = ['target', 'id', 'style'];
    key.forEach(dt=>{
        if(!dflt.includes(dt)) {
            table.setAttribute(`data-${dt}`, setting.dt);
        }
    })

    // header style
    let def_style_row_header = '';
    if(setting.style !== undefined && setting.style.row_header !== undefined && setting.style.row_header !== '') {
        def_style_row_header = setting.style.row_header
    }
    let def_style_header = 'bg-blue-700 border-2 text-white uppercase border-black p-2 sticky top-0 z-10';
    if(setting.style !== undefined && setting.style.header !== undefined && setting.style.header !== '') {
        def_style_header = setting.style.header
    }
    // header
    const row_header = document.createElement('tr');
    row_header.setAttribute('class', def_style_row_header);
    thead.forEach(dt=>{
        let style_header = def_style_header;
        if(dt.style !== undefined && dt.style !== '') {
            style_header = dt.style;
        }
        row_header.appendChild(createTh(dt.text, style_header));
    })
    table.appendChild(row_header);

    // data style
    let def_style_row_data = '';
    if(setting.style !== undefined && setting.style.row_data !== undefined && setting.style.row_data !== '') {
        def_style_row_data = setting.style.row_data
    }

    let def_style_data = 'bg-slate-300 border-2 text-sm border-black p-2';
    if(setting.style !== undefined && setting.style.data !== undefined && setting.style.data !== '') {
        def_style_data = setting.style.data
    }

    // data
    data.forEach(dt=>{
        const row_data = document.createElement('tr');
        row_data.setAttribute('class', def_style_row_data);
        let filter = '';
        let id = '';
        tr_data.forEach(td=>{
            let parent = '';
            let cell = '';
            for(let i=0; i<td.length; i++) {
                if(td[i].type === 'div') {
                    parent = document.createElement('td');
                    parent.setAttribute('class', 'm-0 p-0 w-full h-full');
                    cell = document.createElement('div');
                    let style_data = def_style_data;
                    if(td[i].style !== undefined && td[i].style !== '') {
                        style_data = td[i].style;
                    }
                    cell.setAttribute('class', style_data);

                } else {
                    cell = document.createElement('td');
                    if(td[i].field !== undefined && td[i].field !== '') {filter += dt[td[i].field];}
                    if(td[i].pk !== undefined && td[i].pk !== '') {id += dt[td[i].pk];}
                    
                    if(td[i].type === 'text') {td_text(td[i], dt, cell)};
                    if(td[i].type === 'input') {cell.appendChild(td_input(td[i],dt))};
                    if(td[i].type === 'button') {cell.appendChild(td_button(td[i],dt))}
                    if(td[i].type === 'select') {cell.appendChild(td_select(td[i],dt))}
                    if(td[i].type === 'radio') {cell.appendChild(td_radio(td[i],dt))}
                    if(td[i].type === 'span') {cell.appendChild(td_span(td[i],dt))}
                }
            }
            row_data.setAttribute('data-filter', filter);
            row_data.setAttribute('data-id', id);
            row_data.appendChild(cell);
        })
        table.appendChild(row_data);
    })
    if(setting.target !== undefined && setting.target !== '') {
        const trgt = document.querySelector(setting.target);
        return trgt.appendChild(table);
    }
    return table;
}

const createTh = (text, style_header) =>{
    const th = document.createElement('th');
    th.textContent = text;
    th.setAttribute('class', style_header);
    return th;
}

const td_text = (td, dt, cell) =>{
    /* tdArray setup : 
        {
            target: '',
            field: '',
            id: '',
            style: ''
        },
    */
    if(td.field !== undefined && td.field !== '') {
        cell.textContent = dt[td.field];
    }
    if(td.id !== undefined && td.id !== '') {
        cell.setAttribute('data-id', `${td.id.text}__${dt[td.id.key]}`);
    }
    cell.setAttribute('data-field', td.field)
    return cell;
}


export const td_input = (td, dt) =>{
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
    td_input.placeholder = td.text ? td.text : 'input text here';
    if(td.field !== undefined && td.field !== '') {
        td_input.value = dt[td.field] ? dt[td.field] : '';
        td_input.setAttribute('data-field', td.field);
    }
    if(td.id !== undefined && td.id !== '') {
        td_input.setAttribute('data-id', `${dt[td.id]}`);
    }
    if(td.style !== undefined && td.style !== '') {
        td_input.setAttribute('class', td.style);
    } else {
        td_input.setAttribute('class', 'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    if(td.dtlist !== undefined && td.dtlist !=='') {td_input.setAttribute('list', td.dtlist)}
    if(td.disable !==undefined) {td_input.disabled = true}
    return td_input;
}

export const td_button = (td, dt) =>{
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
    td_button.textContent = td.text ? td.text : '';
    if(td.field !== undefined && td.field !== '') {
        td_button.value = dt[td.field] ? dt[td.field] : '';
        td_button.setAttribute('data-field', td.field);
    }
    if(td.style !== undefined && td.style !== '' ) {
        td_button.setAttribute('class', td.style);
    } else {
        td_button.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    if(td.id !==undefined && td.id !=='') {td_button.id = dt[td.id]}
    if(td.disable !==undefined) {td_button.disabled = true}
    return td_button;
}


export const td_select = (td, dt) =>{
    /* td setup : 
        {
            target: '',
            field: '',
            option: [],
            disable:'',
            style: ''
        },
    */
    const td_select = document.createElement('select');
    if(td.field !== undefined && td.field !== '') {
        td_select.value = dt[td.field] ? dt[td.field] : '';
        td_select.setAttribute('data-field', td.field);
    }
    if(td.style !== undefined && td.style !== '' ) {
        td_select.setAttribute('class', td.style);
    } else {
        td_select.setAttribute('class', 'px-4 w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    td.option.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt;
        td_select.appendChild(option);
    })
    if(td.disable !==undefined) {td_select.disabled = true}
    return td_select;
}

export const td_span = (td) =>{
    const td_span = document.createElement('span');
    td_span.textContent = td.text ? td.text : '';
    if(td.field !== undefined && td.field !== '') {
        td_span.setAttribute('data-field', td.field);
    }
    if(td.style !== undefined && td.style !=='') {
        td_span.setAttribute('class', td.style);
    } 
    return td_span;
}

export const td_radio = (td) =>{
    /* td setup : 
        {
            target: '',
            field: '',
            dtlist:'',
            text: '',
            disable:'',
            style: ''
        },
    */
    const div = document.createElement('div');
    if(td.divStyle !== undefined && td.divStyle !=='') {
        div.setAttribute('class', td.divStyle);
    } else {
        div.setAttribute('class', 'flex flex-row px-2 ');
    }
    const td_radio = document.createElement('input');
    td_radio.type = 'radio';
    if(td.field !== undefined && td.field !=='') {
        td_radio.setAttribute('data-field',td.field);
    }
    if(td.style !== undefined && td.style !=='') {
        td_radio.setAttribute('class', td.style);
    } else {
        td_radio.setAttribute('class', '');
    }
    td_radio.name = td.name ? td.name : 'radio' ;
    if(td.disable !==undefined) {td_radio.disabled = true}
    if(td.check !== undefined ) {
        td_radio.checked = true;
    } 
    td_radio.id = td.ID;
    const label = document.createElement('label');
    label.setAttribute("for", td.ID);
    label.textContent = td.text;
    if(td.post === 'right ') {
        div.appendChild(td_radio);
        div.appendChild(label);
    } else {
        div.appendChild(label);
        div.appendChild(td_radio);
    }
    return div;
}

