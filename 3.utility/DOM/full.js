import { api_access } from "../index.js";

export class DOM {
    // input dan datalist
    static dtList_parse_opt (key, separator, dataArr, ...keyPick) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        dataArr.forEach(dt=>{
            const key = Object.keys(dt);
            let defaultVal = '';
            let valu = '';
            if(key.length>0) {
                key.forEach(dt2=>{
                    let cek = dt[dt2] ? dt[dt2].toString().trim() : "";
                    defaultVal +=  cek + separator.repeat(2);
                })
                valu = defaultVal.replace(new RegExp(separator + "+$"), "");
            } else {
                valu = dt;
            }
            const option = document.createElement('option');
            if(!keyPick || keyPick === '') {
                option.value = valu;
                option.textContent = valu;
            } else {
                let val = ''
                keyPick.forEach(dt2=>{
                    let cek = dt[dt2] ? dt[dt2].toString().trim() : "";
                    val += cek + separator.repeat(2);
                })
                val = val.replace(new RegExp(separator + "+$"), "");
                option.value = val;
                option.textContent = val;
            }
            target.appendChild(option);
        })
        return;
    }

    static select_first_opt(value_search, dtlist, key) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }

        let datalist = '';
        if(dtlist.nodeType) {
            datalist = dtlist;
        } else {
            datalist = document.querySelector(dtlist);
        }
        const option = datalist.querySelectorAll('option');
        for (let i=0; i<option.length; i++) {
            if(option[i].value.toLowerCase().includes(value_search.toLowerCase())) {
              target.value = option[i].value;
              break;
            }
        }
        return;
    }

    static input_valid (key, value, input) {
        let dtlist = '';
        if(key.nodeType) {
            dtlist = key;
        } else {
            dtlist = document.querySelector(key);
        }
        let inpt = '';
        if(input.nodeType) {
            inpt = input;
        } else {
            inpt = document.querySelector(input);
        }
        const opt = dtlist.querySelectorAll('option');
        let valid = false;
        for( let i=0; i<opt.length; i++) {
            if(opt[i].value.includes(value)) {
                valid = true;
                return;
            }
        }
        if(!valid) {
            inpt.setCustomValidity("Data tidak termasuk dalam list");
            inpt.reportValidity();
        }
        return;
    }

    // pagination 
    static pgList_init(key, data, table, ...cls) {
        let div = '';
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        if (!cls === '') {
            mute = cls;
        }
        if(key.nodeType) {
            div = key;
        } else {
            div = document.querySelector(key);
        }
        const dt_cnt = data.length;
        const tbl = document.querySelector(table);
        const tr = tbl.querySelectorAll('tr');
        const tr_cnt = tr.length -1; //-1 utk header
        const max_page = Math.ceil(dt_cnt/tr_cnt);
        const pagi = div.querySelectorAll('[data-group]');
        pagi.forEach(dt=>{
            const pg = dt.getAttribute('data-page');
            if(!dt.classList.contains("hidden")) {
                dt.classList.toggle('hidden');
            }
            if(max_page<8) {
                if(pg==='7' && max_page===7){dt.setAttribute('data-page', `${max_page}`);}
                if(dt.classList.contains('hidden') && parseInt(pg)<=parseInt(max_page)){
                    dt.classList.toggle('hidden');
                }
            } else {
                if(pg==='6') {
                    dt.disabled = true;
                    dt.textContent="...";
                    mute.forEach(cls=>{
                        if(dt.classList.contains(cls)) {
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

    static pgList_active(key, page) {
        let div = '';
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        let active = ['text-white', 'font-bold', 'bg-blue-700', 'bg-slate-200'];
        if(key.nodeType) {
            div = key;
        } else {
            div = document.querySelector(key);
        }
        const pagi = div.querySelectorAll('[data-id]');
        const max = div.querySelector('[data-id = "7"]').getAttribute('data-page');
        pagi.forEach(dt=>{
            const id = dt.getAttribute('data-id');
            if(!dt.disabled) {
                active.forEach(cls=>{
                    if(cls !== 'bg-slate-200' && dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                    if(cls === 'bg-slate-200' && !dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                })
            }
            if(!dt.disabled) {
                mute.forEach(cls=>{
                    if(!dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                })
            }
            if(max>7) {
                if(id==="1") {
                    if(page === 1) {
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
                    if(page === 2) {
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
                    if(page<=4 && dt.textContent!=="2") {
                        dt.disabled = false;
                        dt.textContent="2";
                        dt.setAttribute('data-page', "2");
                    }
                    if(page>4 && dt.textContent!=="...") {
                        dt.disabled = true;
                        dt.textContent = "...";
                        mute.forEach(cls=>{
                            if(dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    }
                }
                if(id==="3"){
                    if(page === 3) {
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
                    if(page >3 && page<=(parseInt(max)-4)) {
                        dt.setAttribute('data-page', `${page-1}`);
                        dt.textContent = page-1;
                    }
                    if(page>(parseInt(max)-4)) {
                        dt.setAttribute('data-page', `${parseInt(max)-4}`);
                        dt.textContent = parseInt(max)-4;
                    }
                    if(page<5) {
                        dt.setAttribute('data-page', "3");
                        dt.textContent = 3;
                    }
                }
                if(id==="4"){
                    if(page<(parseInt(max)-2) && page>3) {
                        dt.textContent=page;
                        dt.setAttribute('data-page', `${page}`);
                        active.forEach(cls=>{
                            if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                            if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    } 
                    if(page<4) {
                        dt.textContent=4;
                        dt.setAttribute('data-page', "4");
                    }
                    if(page>=(parseInt(max)-1) ) {
                        const curPage = parseInt(max)-3;
                        dt.textContent= curPage;
                        dt.setAttribute('data-page', `${curPage}`);
                    }
                }
                if(id==="5"){
                    if(page === parseInt(max)-2) {
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
                    if(page<(parseInt(max)-2) && page>4) {
                        dt.setAttribute('data-page', `${parseInt(page)+1}`);
                        dt.textContent = parseInt(page)+1;
                    }
                    if(page>=(parseInt(max)-2)) {
                        dt.setAttribute('data-page', `${parseInt(max)-2}`);
                        dt.textContent = parseInt(max)-2;
                    }
                    if(page<5) {
                        dt.setAttribute('data-page', "5");
                        dt.textContent = 5;
                    }
                }
                if(id==="6"){
                    if(page === (parseInt(max)-1)) {
                        dt.disabled = false;
                        dt.textContent= page;
                        dt.setAttribute('data-page', `${page}`);
                        active.forEach(cls=>{
                            if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                            if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    }
                    if(page<(parseInt(max)-3) && dt.textContent!=="...") {
                        dt.disabled = true;
                        dt.textContent = "...";
                        mute.forEach(cls=>{
                            if(dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    }

                    if(page>=(parseInt(max)-3)) {
                        dt.disabled = false;
                        const curPage = parseInt(max)-1;
                        dt.textContent= curPage;
                        dt.setAttribute('data-page', `${curPage}`);
                    }
                }
                if(id==="7") {
                    if(page === parseInt(max)) {
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
            }
        })
        return;
    }

    // table 
    static async table_parse_data (key, data, page) {
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

    static async table_clear(key) {
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
            })
            return;
        } catch(error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
    }

    static table_insert_row(template_tbl, tbl,counter) {
        const target = document.querySelector(tbl);
        const tbody = target.querySelector('tbody')
        const table = document.querySelector(template_tbl);
        const tbodyRow = table.querySelector('tbody');
        const row_dt = tbodyRow.querySelector('tr');
        const new_row = row_dt.cloneNode(true);
        new_row.setAttribute('data-id', `new__${tbl}${counter}`);
        new_row.setAttribute('data-change', `new`);
        const td = new_row.querySelectorAll('td');
        td.forEach(dt=>{
            if(dt.hasAttribute('data-field')) {
                if(dt.querySelectorAll('INPUT').length>0) {
                    const input = dt.querySelectorAll("INPUT");
                    for(let i=0; i<input.length; i++) {
                        input[i].id = input[i].id+"__new";
                    }
                }
                if(dt.querySelectorAll('LABEL').length>0) {
                    const label = dt.querySelectorAll("LABEL");
                    for(let i=0; i<label.length; i++) {
                        let old = label[i].getAttribute('for');
                        label[i].setAttribute('for',old+"__new");
                    }
                }
                if(dt.querySelectorAll('BUTTON').length>0) {
                    const button = dt.querySelectorAll("BUTTON");
                    for(let i=0; i<button.length; i++) {
                        button[i].id = button[i].getAttribute('data-method')+"__"+counter+"__new";
                    }
                }
            }
        })
        tbody.insertBefore(new_row,tbody.rows[0]);
        return true;
    }

    // navigation 
    static active_link(cls) {
        const container = document.querySelector('nav');
        const ul = container.querySelector('ul');
        const aLink = ul.querySelectorAll('a');
        let styleClass = "h-full w-[10vw] text-white justify-center items-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 bg-blue-800 border-blue-300 border-b-4 font-semibold";
        if(cls!=='') {
            styleClass = cls;
        }
        aLink.forEach(link=> {
            const currentUrl = window.location.href.split('/');
            const compare = currentUrl[currentUrl.length-1];
            const hrefValue = link.getAttribute('href');
            if (hrefValue === compare) {
                link.setAttribute('class', styleClass);
            }
        })
        return;
    }

    // general 
    static rmv_class(key, ...cls) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let valid = false;
        cls.forEach(dt=>{
            if(target.classList.contains(dt)) {
                target.classList.remove(dt);
                valid = true;
            }
        })
        return valid;
    }

    static add_class(key, ...cls) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let valid = false;
        cls.forEach(dt=>{
            if(!target.classList.contains(dt)) {
                target.classList.add(dt);
                valid = true;
            }
        })
        return valid;
    }

    static rmv_attr(key, attr) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let valid = false;
        if(target.hasAttribute(attr)) {
            target.removeAttribute(attr);
            valid = true;
        }
        return valid;
    }

    static set_attr(key, attr, attr_val) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let valid = false;
        if(!target.hasAttribute(attr) || target.getAttribute(attr)!== attr_val) {
            target.setAttribute(attr, attr_val);
            valid = true;
        }
        return valid;
    }

    // form 
    static form_parse_data(key, data) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        const inp_name = target.querySelectorAll('[name]');
        inp_name.forEach(dt=>{
            const field = dt.getAttribute('name');
            dt.value = data[`${field}`] ? data[`${field}`] :'';
        })
        return;
    }

    static label_parse_value(key, value) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        target.textContent = value;
        return;
    }

    static async update_dataset_table(key, model_tbl) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let data_array =[];
        const all_field = target.querySelectorAll('tr');
        all_field.forEach(dt=>{
          if(dt.hasAttribute('data-change')) {
            let data = {};
            const name = dt.querySelectorAll('[name]');
            name.forEach(d2=>{
              data[d2.getAttribute('name')] = d2.value;
            })
            data_array.push(data);
          }
        })
        let result = '';
        if(data_array.length === 0) {
            alert('tidak ada data yang akan di update');
        } else {
            result = await api_access('update',model_tbl, data_array);
            if(result.includes('fail')) {
                alert ('data error');
            }
        }
        return result;
    }

    static async insert_dataset_table(key, model_tbl) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let data_array =[];
        const all_field = target.querySelectorAll('tr');
        all_field.forEach(dt=>{
          if(dt.hasAttribute('data-change')) {
            let data = {};
            const name = dt.querySelectorAll('[name]');
            name.forEach(d2=>{
              data[d2.getAttribute('name')] = d2.value;
            })
            data_array.push(data);
          }
        })
        let result = '';
        if(data_array.length === 0) {
            alert('tidak ada data yang akan di insert');
        } else {
            result = await api_access('insert',model_tbl, data_array);
            if(result.includes('fail')) {
                alert ('data error');
            }
        }
        return result;
    }

    static async insert_data(key, model_tbl) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let data_array =[];
        let data = {};
        const name = target.querySelectorAll('[name]');
        name.forEach(dt=>{
            data[dt.getAttribute('name')] = dt.value;
        })
        data_array.push(data);
        let result = '';
        if(data_array.length === 0) {
            alert('tidak ada data yang akan di insert');
        } else {
            result = await api_access('insert',model_tbl, data_array);
            if(result.includes('fail')) {
                alert ('data error');
            }
        }
        return result;
    }

    static async update_data(key, model_tbl) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let data_array =[];
        let data = {};
        const name = target.querySelectorAll('[name]');
        name.forEach(dt=>{
            data[dt.getAttribute('name')] = dt.value;
        })
        data_array.push(data);
        let result = '';
        if(data_array.length === 0) {
            alert('tidak ada data yang akan di update');
        } else {
            result = await api_access('update',model_tbl, data_array);
            if(result.includes('fail')) {
                alert ('data error');
            }
        }
        return result;
    }

    static async delete_data(key, model_tbl, pk) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = document.querySelector(key);
        }
        let data_array =[];
        let data = {};
        const name = target.querySelectorAll('[name]');
        name.forEach(dt=>{
            if(dt.getAttribute('name') === pk) {
                data[dt.getAttribute('name')] = dt.value;
            }
        })
        data_array.push(data);
        let result = '';
        if(data_array.length === 0) {
            alert('tidak ada data yang akan di delete');
        } else {
            result = await api_access('delete',model_tbl, data_array);
            if(result.includes('fail')) {
                alert ('data error');
            }
        }
        return result;
    }

}
