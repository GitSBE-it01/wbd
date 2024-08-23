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
                let page = parseInt(event.target.getAttribute('data-page'));
                await TableDOM.parse_data(key,data,page);
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


export class TableDOM2 {
    constructor(key, src, pagination_id) {
        this.id = key;
        this.pagination_id = pagination_id;
        this.table = document.getElementById(this.id);
        this.data = src;
        this.page_node = document.getElementById(pagination_id);
        this.page = 1;
        this.show_data = this.data;
    }

    async table_parse_data() {
        try {
            const tr = this.table.querySelectorAll('tbody tr');
            let count = 0;
            if(this.page >1) {
                count = (tr.length-1) * (this.page-1);
            }
            tr.forEach(dt=>{
                if(!dt.getAttribute('data-id').includes('template') && !dt.classList.contains('hidden')) {
                    dt.classList.toggle('hidden');
                }
                let fltr = '';
                if(!dt.getAttribute('data-id').includes('template') && this.show_data[count]) {
                    const fld = dt.querySelectorAll("[name]");
                    if(dt.classList.contains('hidden')) {
                        dt.classList.toggle('hidden');
                    }
                    dt.setAttribute('data-value', count);
                    fld.forEach(d2=>{
                        const key_fld = d2.getAttribute('name');
                        const currVal = this.show_data[count][`${key_fld}`] ? this.show_data[count][`${key_fld}`] : '';
                        fltr += currVal + "----";
                        if(d2.tagName === 'INPUT')
                            if(d2.getAttribute('type')==='text' || d2.getAttribute('type')==='date') {
                                d2.value = currVal;
                                d2.setAttribute('data-current', currVal);
                                const lbl = this.table.querySelector(`[for="${d2.id}"]`);
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
                            const lbl = this.table.querySelector(`[for="${d2.id}"]`);
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

    async table_clear() {
        try {
            const tr = this.table.querySelectorAll('tbody tr');
            tr.forEach(dt=>{
                if(!dt.getAttribute('data-id').includes('template')) {
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

    async table_new_row(post = 'upper') {
        const template = this.table.querySelector('[data-id *="template"]');
        const new_row = template.cloneNode(true);
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
        if(post === 'upper') {
            tbody.insertBefore(new_row,tbody.rows[0]);
        } else {
            tbody.appendChild(new_row);
        }
        return;
    }

    async table_pagination_init(cls = '') {
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        let dflt = 'border-2 border-slate-400 p-1 w-8 h-8 justify-center items-center duration-300 flex bg-slate-200';
        let active = ['text-white', 'font-bold', 'bg-blue-700', 'bg-slate-200'];
        if (!cls === '') {
            mute = cls;
        }
        const dt_cnt = this.show_data.length;
        const tr = this.table.querySelectorAll('tbody tr');
        const tr_cnt = tr.length - 1; // -1 utk template
        const max_page = Math.ceil(dt_cnt/tr_cnt);

        const maxi = max_page +1 
        const pagi = this.page_node.querySelectorAll('[data-group]');
        pagi.forEach(dt=>{
            const id_pg = dt.getAttribute('data-id');
            dt.setAttribute('data-page', `${id_pg}`); 
            dt.disabled = false;
            dt.textContent = id_pg;
            dt.setAttribute('class', dflt);
            const pg = dt.getAttribute('data-page');
            const pg_val = parseInt(pg);
            if(id_pg === '1') {
                dt.setAttribute('data-pagi','active');
                active.forEach(cls=>{
                    dt.classList.toggle(cls);   
                })
            }
            if(!dt.classList.contains("hidden")) {
                dt.classList.toggle('hidden');
            }
            if(max_page<8) {
                if(pg_val < maxi) {
                    dt.textContent = id_pg;
                    if(dt.classList.contains('hidden')){
                        dt.classList.toggle('hidden');
                    }
                }
            } else {
                if(pg==='6') {
                    dt.disabled = true;
                    dt.textContent="...";
                    mute.forEach(cls=>{
                        if(!dt.classList.contains(cls)) {
                            dt.classList.toggle(cls);
                        }
                    })
                };
                if(pg==='7'){
                    dt.setAttribute('data-page', `${max_page}`); 
                    dt.textContent=max_page;
                }
                if(dt.classList.contains('hidden') ){
                    dt.classList.toggle('hidden');
                }
            }
        })
        return;
    }

    async table_pagination_response() {
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        let active = ['text-white', 'font-bold', 'bg-blue-700', 'bg-slate-200'];
        if(this.page_node.nodeType) {
            this.page_node.addEventListener('click', async (event) => {
                if(event.target.getAttribute('data-group') === this.pagination_id) {
                    this.page = parseInt(event.target.getAttribute('data-page'));
                    this.table_parse_data();
                    const div = event.target.closest('div');
                    const pagi = div.querySelectorAll('[data-id]');
                    const max = div.querySelector('[data-id = "7"]').getAttribute('data-page');

                    pagi.forEach(dt=>{
                        const id = dt.getAttribute('data-id');
                        if(dt.hasAttribute('data-pagi')) {dt.removeAttribute('data-pagi')}
                        if(!dt.disabled) {
                            active.forEach(cls=>{
                                if(cls !== 'bg-slate-200' && dt.classList.contains(cls)) {
                                    dt.classList.toggle(cls);
                                }
                                if(cls === 'bg-slate-200' && !dt.classList.contains(cls)) {
                                    dt.classList.toggle(cls);
                                }
                            })
                            mute.forEach(cls=>{
                                if(!dt.classList.contains(cls)) {
                                    dt.classList.toggle(cls);
                                }
                            })
                        }
                        if(id==="1") {
                            if(this.page === 1) {
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                        }
                        if(id==="2"){
                            if(this.page === 2) {
                                dt.disabled = false;
                                dt.textContent="2";
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                            if(parseInt(max)>8) {
                                if(this.page<=4 && dt.textContent!=="2") {
                                    dt.disabled = false;
                                    dt.textContent="2";
                                    dt.setAttribute('data-page', "2");
                                }
                                if(this.page>4 && dt.textContent!=="...") {
                                    dt.disabled = true;
                                    dt.textContent = "...";
                                    mute.forEach(cls=>{
                                        if(dt.classList.contains(cls)) {
                                            dt.classList.toggle(cls);
                                        }
                                    })
                                }
                            }
                        }
                        if(id==="3"){
                            if(this.page === 3) {
                                dt.textContent="3";
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                            if(this.page >3 && this.page<=(parseInt(max)-4)) {
                                dt.setAttribute('data-page', `${this.page-1}`);
                                dt.textContent = this.page-1;
                            }
                            if(this.page>(parseInt(max)-4)) {
                                dt.setAttribute('data-page', `${parseInt(max)-4}`);
                                dt.textContent = parseInt(max)-4;
                            }
                            if(this.page<5) {
                                dt.setAttribute('data-page', "3");
                                dt.textContent = 3;
                            }
                        }
                        if(id==="4"){
                            dt.setAttribute('data-pagi', 'active');
                            if(this.page<(parseInt(max)-2) && this.page>3) {
                                dt.textContent=this.page;
                                dt.setAttribute('data-page', `${this.page}`);
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            } 
                            if(this.page<4) {
                                dt.textContent=4;
                                dt.setAttribute('data-page', "4");
                            }
                            if(this.page>=(parseInt(max)-1) ) {
                                const curPage = parseInt(max)-3;
                                dt.textContent= curPage;
                                dt.setAttribute('data-page', `${curPage}`);
                            }
                        }
                        if(id==="5"){
                            if(this.page === parseInt(max)-2) {
                                const curPage = parseInt(max)-2;
                                dt.textContent = curPage;
                                dt.setAttribute('data-page', `${curPage}`);
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                            if(this.page<(parseInt(max)-2) && this.page>4) {
                                dt.setAttribute('data-page', `${parseInt(this.page)+1}`);
                                dt.textContent = parseInt(this.page)+1;
                            }
                            if(this.page>=(parseInt(max)-2)) {
                                dt.setAttribute('data-page', `${parseInt(max)-2}`);
                                dt.textContent = parseInt(max)-2;
                            }
                            if(this.page<5) {
                                dt.setAttribute('data-page', "5");
                                dt.textContent = 5;
                            }
                        }
                        if(id==="6"){
                            if(this.page === (parseInt(max)-1)) {
                                dt.disabled = false;
                                dt.textContent= this.page;
                                dt.setAttribute('data-page', `${this.page}`);
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                            if(parseInt(max)>8) {
                                if(this.page<(parseInt(max)-3) && dt.textContent!=="...") {
                                    dt.disabled = true;
                                    dt.textContent = "...";
                                    mute.forEach(cls=>{
                                        if(dt.classList.contains(cls)) {
                                            dt.classList.toggle(cls);
                                        }
                                    })
                                }
            
                                if(this.page>=(parseInt(max)-3)) {
                                    dt.disabled = false;
                                    const curPage = parseInt(max)-1;
                                    dt.textContent= curPage;
                                    dt.setAttribute('data-page', `${curPage}`);
                                }
                            }
                        }
                        if(id==="7") {
                            if(this.page === parseInt(max)) {
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                        }
                    })
                    return;
                }
            })
        }
    }

    async table_filter_data_on_click(button_key, input_key) {
        let btn = '';
        if(button_key.nodeType) {
            btn = button_key
        } else {
            btn = document.querySelector(button_key);
        }
        let inp = '';
        if(input_key.nodeType) {
            inp = input_key
        } else {
            inp = document.querySelector(input_key);
        }
        if(btn) {
            btn.addEventListener('click', async()=>{
                DOM.rmv_class('#load',"hidden");
                this.show_data = this.data.filter(obj=>obj.filter.toLowerCase().includes(inp.value.toLowerCase()));
                this.page = 1;
                this.table_parse_data();
                DOM.add_class('#load',"hidden");
            })
        }
        if(inp) {
            inp.addEventListener('keyup', async(e)=>{
                if(e.key === 'Enter') {
                    DOM.rmv_class('#load',"hidden");
                    this.show_data = this.data.filter(obj=>obj.filter.toLowerCase().includes(inp.value.toLowerCase()));
                    this.page = 1;
                    this.table_parse_data();
                    DOM.add_class('#load',"hidden");
                }
            })
        }
        return;
    }

    async table_filter_data(filter_val) {
        this.show_data = this.data.filter(obj=>obj.filter.includes(filter_val));
        console.log(this.show_data);
        this.page = 1;
        this.table_parse_data();
        return;
    }

}