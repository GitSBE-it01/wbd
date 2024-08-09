import {DOM, NavDOM} from '../../3.utility/index.js';

export const inputEmptyRow = async(target, counter, data_array) =>{
    const data_tr = document.createElement('tr');
    data_tr.classList.add('w-full');
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
                td.setAttribute('name', data_array[i].field);
                td.textContent = data_array[i].def_value;
            }
            if(data_array[i].type === 'input') {
                td.appendChild(await td_input(data_array[i]));
            }
            if(data_array[i].type === 'date') {
                td.appendChild(await td_date(data_array[i]));
            }
            if(data_array[i].type === 'btnSet') {
                td.classList.add('flex');
                td.classList.add('flex-row');
                const sets =  data_array[i].set.split(" ");
                sets.forEach(dt=>{
                    td.appendChild(td_button(dt, data_array[i]));
                })
            }
        data_tr.appendChild(td);
        } 
    }
    data_tr.setAttribute(`data-id`, `new__${counter}`);
    if(target !== '') {
        const trgt = document.querySelector(target);
        trgt.appendChild(data_tr);
        return;
    }
    return data_tr;
}



const td_input = async(data_array) =>{
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
    td_input.placeholder = data_array.placeholder ? data_array.placeholder : 'input text here';
    td_input.value = data_array.def_value ? data_array.def_value : '';
    td_input.setAttribute('name', data_array.field);
    if(data_array.dtlist !== undefined && data_array.dtlist !=='') {td_input.setAttribute('list', data_array.dtlist)}
    if(data_array.disable !==undefined) {td_input.disabled = true}
    if(data_array.style !== undefined && data_array.style !=='') {
        td_input.setAttribute('class', data_array.style);
    } else {
        td_input.setAttribute('class', 'w-full h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent');
    }
    return td_input;
}

const td_date = async(data_array) =>{
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
    const td_date = document.createElement('input');
    td_date.type = 'date';
    td_date.setAttribute('name', data_array.field);
    if(data_array.disable !==undefined) {td_date.disabled = true}
    let style = 'w-full rounded flex justify-center items-center h-full focus:ring focus:ring-blue-600 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-transparent';
    if(data_array.style !== undefined && data_array.style !=='') {
        style = data_array.style;
    }
    td_date.setAttribute('class', style);
    return td_date;
}

const td_button = (dt, data_array) =>{
    const btn = document.createElement('button');
    btn.type = 'button';
    btn.name = data_array.field;
    const ls = dt.split(':');
    btn.setAttribute('class', data_array.btn_style+" "+ls[1]);
    if(ls.length>2 && ls[2]=== 'disable') {
        btn.disabled= true;
        btn.classList.add('opacity-25');
    }
    btn.setAttribute('data-method', ls[0]);
    btn.setAttribute('data-button', data_array.def_value);

    return btn;
}


export class TableDOM {
    static async filter_data(key, data, result, button_id, filter_id, pagi_key) {
        document.addEventListener('click', async function(event) {
            if(event.target.id === button_id) {
                DOM.rmv_class('#load',"hidden");
                const fltr_val = document.getElementById(filter_id).value;
                result = data.filter(obj=>obj.filter.toLowerCase().includes(fltr_val.toLowerCase()));
                await TableDOM.parse_data(key,result,1);
                NavDOM.pgList_init(pagi_key, result, key);
                DOM.add_class('#load',"hidden");
                console.log(result);
                return result;
            }
        })
    }
    
    static async direct_filter_data(key, data, result, filter_id, pagi_key) {
        document.addEventListener('keyup', async function(event) {
            if(event.target.id === filter_id && event.key !=='Enter') {
                DOM.rmv_class('#load',"hidden");
                const fltr_val = document.getElementById(filter_id).value;
                result = data.filter(obj=>obj.filter.toLowerCase().includes(fltr_val.toLowerCase()));
                await TableDOM.parse_data(key,result,1);
                NavDOM.pgList_init(pagi_key, result, key);
                DOM.add_class('#load',"hidden");
                return result;
            }
        })
    }

    static async parse_onclick(key, data, page_key, page_id) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute(page_key) === page_id) {
                DOM.rmv_class('#load',"hidden");
                let page = parseInt(event.target.getAttribute('data-page'));
                await TableDOM.parse_data(key,data,page);
                DOM.add_class('#load',"hidden");
                return;
            }
        })
    }

    static async parse_data (key, data, page) {
        try {
            let table = '';
            if(key.nodeType) {
                table = key;
            } else {
                table = document.querySelector(key);
            }
            const tr = table.querySelectorAll('tr');
            let count = 0;
            if(page >1) {
                count = (tr.length-1) * (page-1);
            }
            tr.forEach(dt=>{
                if(dt.getAttribute('data-id') !== 'header' && !dt.classList.contains('hidden')) {
                    dt.classList.toggle('hidden');
                }
                let fltr = '';
                if(dt.getAttribute('data-id') !== 'header' && data[count]) {
                    const fld = dt.querySelectorAll("[name]");
                    if(dt.classList.contains('hidden')) {
                        dt.classList.toggle('hidden');
                    }
                    dt.setAttribute('data-value', count);
                    fld.forEach(d2=>{
                        const key_fld = d2.getAttribute('name');
                        const currVal = data[count][`${key_fld}`] ? data[count][`${key_fld}`] : '';
                        fltr += currVal + "----";
                        if(d2.tagName === 'INPUT')
                            if(d2.getAttribute('type')==='text' || d2.getAttribute('type')==='date') {
                                d2.value = currVal;
                                d2.setAttribute('data-current', currVal);
                                const lbl = table.querySelector(`[for="${d2.id}"]`);
                                lbl.textContent= currVal;
                            }   
                            if(d2.getAttribute('type')==='hidden') {
                                d2.value = currVal;
                                d2.setAttribute('data-current', currVal);
                            }
                        if(d2.tagName === 'SELECT') {
                            d2.setAttribute('data-current', currVal);
                            d2.value = currVal;
                            const opt = d2.querySelectorAll('option');
                            opt.forEach(dt=>{
                                if(dt.value === currVal){
                                    dt.setAttribute("selected", true);
                                }
                            })
                            const lbl = table.querySelector(`[for="${d2.id}"]`);
                            lbl.textContent= currVal;
                        }
                        if(d2.tagName === 'TD') {
                            d2.textContent = currVal;
                            d2.setAttribute('data-current', currVal);
                        }
                    })
                    count++;
                }
            })
            return;
        } catch(error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
    }

    static async clear(key) {
        try {
            const table = document.querySelector(key);
            const tr = table.querySelectorAll('tr');
            tr.forEach(dt=>{
                if(dt.getAttribute('data-id') !== 'header') {
                    const td = dt.querySelectorAll("[name]");
                    dt.removeAttribute('data-value');
                    if(!dt.classList.contains('hidden')) {
                        dt.classList.toggle('hidden');
                    }
                    td.forEach(d2=>{
                        if(d2.tagName === 'INPUT' && d2.getAttribute('type')==='text') {
                            d2.setAttribute('value', '');
                            d2.removeAttribute('data-current');
                            const lbl = document.querySelector(`[for="${d2.id}"]`);
                            lbl.textContent = '';
                        }
                        if(d2.tagName === 'INPUT' && d2.getAttribute('type')==='hidden') {
                            d2.value = '';
                            d2.removeAttribute('data-current');
                        }
                        if(d2.tagName === 'SELECT') {
                            d2.removeAttribute('data-current');
                            const opt = d2.querySelectorAll('option');
                            opt.forEach(dt=>{
                                if(dt.hasAttribute('selected')){
                                    dt.removeAttribute('selected');
                                }
                            })
                            const lbl = table.querySelector(`[for="${d2.id}"]`);
                            lbl.textContent= '';
                        }
                        if(d2.tagName === 'TD') {
                            d2.removeAttribute('data-current');
                            d2.textContent = '';
                        }
                    })
                }
                if(dt.getAttribute('data-id').includes('new')) {
                    dt.remove();
                } 
            })
            return;
        } catch(error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
    }
    
    static set_default_new_row(table_key, data, array) {
        const tbl = table_key.nodeType ? table_key : document.querySelector(table_key);
        const tbody = tbl.querySelector('tbody');
        const tr = tbody.querySelector(`tr`)
        const field = tr.querySelectorAll("[name]");
        field.forEach(dt=>{
            const field_name = dt.getAttribute('name');
            if(array.includes(field_name)) {
                if(dt.tagName === 'INPUT' || dt.tagName === 'SELECT') {
                    dt.value = data[0][`${field_name}`];
                } else {
                    dt.textContent = data[`${field_name}`]
                }
            }
        })
        return;
    }

    static insert_row(template_tbl, tbl, counter) {
        const target = document.querySelector(tbl);
        const tbody = target.querySelector('tbody')
        const table = document.querySelector(template_tbl);
        const tbodyRow = table.querySelector('tbody');
        const row_dt = tbodyRow.querySelector('tr');
        const new_row = row_dt.cloneNode(true);
        new_row.setAttribute('data-id', `new__${tbl}__${counter}`);
        new_row.setAttribute('data-change', `new`);
        const name = new_row.querySelectorAll('[name]');
        name.forEach(dt=>{
            if(dt.tagName === 'INPUT' || dt.tagName === 'SELECT') {
                const name = dt.getAttribute('name');
                let td = '';
                if(dt.disabled) {dt.disabled = false;}
                if(dt.closest('td') !== null) {
                    td = dt.closest('td');
                    const label = td.querySelector('label');
                    if(dt.hasAttribute('id')) {
                        dt.id = `${name}__${target.id}__new__${counter}`;
                        label.setAttribute('for', `${name}__${target.id}__new__${counter}`)
                    }
                }
            }
        })
        tbody.insertBefore(new_row,tbody.rows[0]);
        return;
    }

    static insert_row2(template_tbl, tbl, counter, pos) {
        const target = document.querySelector(tbl);
        const tbody = target.querySelector('tbody')
        const table = document.querySelector(template_tbl);
        const tbodyRow = table.querySelector('tbody');
        const row_dt = tbodyRow.querySelector('tr');
        const new_row = row_dt.cloneNode(true);
        new_row.setAttribute('data-id', `new__${tbl}__${counter}`);
        new_row.setAttribute('data-change', `new`);
        const name = new_row.querySelectorAll('[name]');
        name.forEach(dt=>{
            if(dt.tagName === 'INPUT' || dt.tagName === 'SELECT') {
                const name = dt.getAttribute('name');
                let td = '';
                if(dt.disabled) {dt.disabled = false;}
                if(dt.closest('td') !== null) {
                    td = dt.closest('td');
                    const label = td.querySelector('label');
                    if(dt.hasAttribute('id')) {
                        dt.id = `${name}__${target.id}__new__${counter}`;
                        label.setAttribute('for', `${name}__${target.id}__new__${counter}`)
                    }
                }
            }
        })
        if(pos === '') {
            tbody.insertBefore(new_row,tbody.rows[0]);
        } else {
            tbody.appendChild(new_row);
        }
        return;
    }
}