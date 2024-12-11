import { currentDate } from "../utils/date.js";
import { TableDOM2 } from "./table/table.js";

export class DOM2 {
    constructor (page_role='user', sprtr = '/') {
        this.body = document.querySelector('body');
        this.nav = this.body.querySelector('nav');
        this.header = this.body.querySelector('header');
        this.aside = this.body.querySelector('aside');
        this.main = this.body.querySelector('main');
        this.footer = this.body.querySelector('footer');
        this.load = this.body.querySelector('#load');
        this.userData = this.auth();
        this.separator = sprtr;
        this.dtbase = [];
        this.counter = 0;
        this.active_link();
        this.init(page_role);
        this.td_input_default();
    }
    
    load_toggle() {
        this.load.classList.toggle('hidden');
    }

    async view_init({type, main_id, data, filter='', dtlist_key=[], post='upper', parent=document}) {
        if(data.length>0 && !data[0]['filter']) {
            data.forEach(dt=>{
                const keys = Object.keys(dt);
                let fltr = '';
                keys.forEach(d2=>{
                    fltr += dt[`${d2}`]+'--';
                })
                dt.filter = fltr;
            })
        }

        let name_db = '';
        if(filter === '') {
            name_db = main_id;
        } else {
            name_db = main_id+'_'+filter;
        }

        if(!this.dtbase[`detail__${name_db}`]) {
            this.dtbase[`detail__${name_db}`] = {
                data: data,
                show: data,
                main_id: main_id,
                name_id: name_db,
                filter_id: filter,
                filter: `${main_id}_search`,
                filter_btn: `${main_id}_search_btn`,
                submit_btn: `${main_id}_submit_btn`,
                table_id: `${main_id}_table`,
                page_id: `${main_id}_page`,
                dtlist_id: `${main_id}_list`,
                dtlist: dtlist_key,
                add_id: `${main_id}_add_btn`,
                dl_id: `${main_id}_dl_btn`,
                add_row: post,
                curr_page: 1
            }
        } else {
            if(!this.dtbase[`detail__${name_db}`]['dtlist'] || this.dtbase[`detail__${name_db}`]['dtlist']  !== dtlist_key) {
                this.dtbase[`detail__${name_db}`]['dtlist']= dtlist_key;
            }
        }
        if(type === 'table') {
            const arr_dt = this.dtbase[`detail__${name_db}`];
            this.counter = 0;
            let add_btn = parent.getElementById(arr_dt.add_id);
            if(add_btn !== null) {
                add_btn.setAttribute('data-scope', arr_dt.name_id)
            }
            let fltr_btn = parent.getElementById(arr_dt.filter_btn);
            if(fltr_btn !== null) {
                fltr_btn.setAttribute('data-scope', arr_dt.name_id)
            }
            let dl_btn = parent.getElementById(arr_dt.dl_id);
            if(dl_btn !== null) {
                dl_btn.setAttribute('data-scope', arr_dt.name_id)
            }
            await this.table_parse(arr_dt);
            await this.pagination_init(arr_dt);
            await this.pagination_response(arr_dt);
            await this.filter_table(arr_dt);
            await this.table_new_row(arr_dt);
            await this.table_dl(arr_dt);
            return;
        }
        if(type === 'datalist') {
            await this.parse_dtlist(this.dtbase[`detail__${name_db}`]);
            return;
        }
    }

    async filter_table(arr_dt, parent = document) {
        let btn = parent.getElementById(arr_dt.filter_btn);
        let search = parent.getElementById(arr_dt.filter);
        if(btn && search) {
            btn.addEventListener('click', async(e)=> {
                if(e.target.getAttribute('data-scope') === arr_dt.name_id) {
                    if(search.value !== '') {
                        arr_dt.show = arr_dt.data.filter(obj=>obj.filter.toLowerCase().includes(search.value.toLowerCase()));
                    } else {
                        arr_dt.show = arr_dt.data;
                    }
                    arr_dt.curr_page =1;
                    await this.table_parse(arr_dt);
                    await this.pagination_init(arr_dt);
                }
                return;
            })
            search.addEventListener('keyup', async(e)=>{
                if(e.key === 'Enter') {
                    if(search.value !== '') {
                        arr_dt.show = arr_dt.data.filter(obj=>obj.filter.toLowerCase().includes(search.value.toLowerCase()));
                    } else {
                        arr_dt.show = arr_dt.data;
                    }
                    arr_dt.curr_page =1;
                    await this.table_parse(arr_dt);
                    await this.pagination_init(arr_dt);
                }
                return;
            })
        }
        return;
    }

    async table_parse(arr_dt, dsbl=false, parent=document) {
        let table = parent.getElementById(arr_dt.table_id);
        if(table) {
            const tr = table.querySelectorAll('tbody tr');
            const tr_cnt = tr.length - 1; // -1 utk template
            let ii = arr_dt.curr_page ===1 ? 0 : (arr_dt.curr_page-1)* tr_cnt;
            for(let i=0; i<tr_cnt; i++) {
                let dt = arr_dt.show[ii];
                if(dt) {
                    const tr = table.querySelector(`[data-id="${arr_dt.table_id}__${i}"]`);
                    tr.setAttribute('data-value', ii);
                    if(tr.classList.contains('hidden')) {
                        DOM2.class_toggle(tr, ['hidden'], false);
                    }
                    const td = tr.querySelectorAll('[name]');
                    td.forEach(d2=>{
                        const field = d2.getAttribute('name');
                        const curr = d2.hasAttribute('disabled') ? true : false;
                        d2.disabled = false;
                        d2.value = dt[`${field}`] ? dt[`${field}`] :'';
                        d2.setAttribute('data-current', dt[`${field}`] ? dt[`${field}`] :'');
                        if(tr.querySelector(`[for = "${d2.id}"]`) !== null) {
                            tr.querySelector(`[for = "${d2.id}"]`).textContent = dt[`${field}`] ? dt[`${field}`] :'';
                        }
                        if(dsbl) {
                            d2.disabled = false;
                        } else {
                            d2.disabled = curr;
                        }
                    })
                } else {
                    const tr = table.querySelector(`[data-id="${arr_dt.table_id}__${i}"]`);
                    tr.removeAttribute('data-value');
                    if(!tr.classList.contains('hidden')) {
                        DOM2.class_toggle(tr, ['hidden']);
                    }
                    const td = tr.querySelectorAll('[name]');
                    td.forEach(d2=>{
                        const curr = d2.hasAttribute('disabled') ? true : false;
                        d2.disabled = false;
                        d2.value ='';
                        if(tr.querySelector(`[for = "${d2.id}"]`) !== null) {
                            tr.querySelector(`[for = "${d2.id}"]`).textContent ='';
                        }
                        if(dsbl) {
                            d2.disabled = false;
                        } else {
                            d2.disabled = curr;
                        }
                    })

                }
                ii++;
            }
        } 
        return;
    }

    async pagination_init(arr_dt, parent=document) {
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        let dflt = 'border-2 border-slate-400 p-1 w-8 h-8 justify-center items-center duration-300 flex bg-slate-200';
        let active = ['text-white', 'font-bold', 'bg-blue-700', 'bg-slate-200'];

        let table = parent.getElementById(arr_dt.table_id);
        const dt_cnt = arr_dt.show.length;
        const tr = table.querySelectorAll('tbody tr');
        const tr_cnt = tr.length - 1; // -1 utk template
        const max_page = Math.ceil(dt_cnt/tr_cnt);
        const maxi = max_page +1 
        let page_node = parent.getElementById(arr_dt.page_id);
        const pagi = page_node.querySelectorAll('[data-group]');
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

    
    async pagination_response(arr_dt, parent=document) {
        let mute = [
            'hover:font-bold',
            'hover:bg-blue-700',
            'hover:text-white',
            'hover:border-black',
            'cursor-pointer'
        ];
        let active = ['text-white', 'font-bold', 'bg-blue-700', 'bg-slate-200'];
        let page_node = parent.getElementById(arr_dt.page_id);
        if(page_node) {
            page_node.addEventListener('click', async (event) => {
                if(event.target.getAttribute('data-group') === arr_dt.page_id) {
                    arr_dt.curr_page = parseInt(event.target.getAttribute('data-page'));
                    await this.table_parse(arr_dt);
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
                            if(arr_dt.curr_page === 1) {
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
                            if(arr_dt.curr_page === 2) {
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
                                if(arr_dt.curr_page<=4 && dt.textContent!=="2") {
                                    dt.disabled = false;
                                    dt.textContent="2";
                                    dt.setAttribute('data-page', "2");
                                }
                                if(arr_dt.curr_page>4 && dt.textContent!=="...") {
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
                            if(arr_dt.curr_page === 3) {
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
                            if(arr_dt.curr_page >3 && arr_dt.curr_page<=(parseInt(max)-4)) {
                                dt.setAttribute('data-page', `${arr_dt.curr_page-1}`);
                                dt.textContent = arr_dt.curr_page-1;
                            }
                            if(arr_dt.curr_page>(parseInt(max)-4)) {
                                dt.setAttribute('data-page', `${parseInt(max)-4}`);
                                dt.textContent = parseInt(max)-4;
                            }
                            if(arr_dt.curr_page<5) {
                                dt.setAttribute('data-page', "3");
                                dt.textContent = 3;
                            }
                        }
                        if(id==="4"){
                            dt.setAttribute('data-pagi', 'active');
                            if(arr_dt.curr_page<(parseInt(max)-2) && arr_dt.curr_page>3) {
                                dt.textContent=arr_dt.curr_page;
                                dt.setAttribute('data-page', `${arr_dt.curr_page}`);
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            } 
                            if(arr_dt.curr_page<4) {
                                dt.textContent=4;
                                dt.setAttribute('data-page', "4");
                            }
                            if(arr_dt.curr_page>=(parseInt(max)-1) ) {
                                const curPage = parseInt(max)-3;
                                dt.textContent= curPage;
                                dt.setAttribute('data-page', `${curPage}`);
                            }
                        }
                        if(id==="5"){
                            if(arr_dt.curr_page === parseInt(max)-2) {
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
                            if(arr_dt.curr_page<(parseInt(max)-2) && arr_dt.curr_page>4) {
                                dt.setAttribute('data-page', `${parseInt(arr_dt.curr_page)+1}`);
                                dt.textContent = parseInt(arr_dt.curr_page)+1;
                            }
                            if(arr_dt.curr_page>=(parseInt(max)-2)) {
                                dt.setAttribute('data-page', `${parseInt(max)-2}`);
                                dt.textContent = parseInt(max)-2;
                            }
                            if(arr_dt.curr_page<5) {
                                dt.setAttribute('data-page', "5");
                                dt.textContent = 5;
                            }
                        }
                        if(id==="6"){
                            if(arr_dt.curr_page === (parseInt(max)-1)) {
                                dt.disabled = false;
                                dt.textContent= arr_dt.curr_page;
                                dt.setAttribute('data-page', `${arr_dt.curr_page}`);
                                active.forEach(cls=>{
                                    if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                    if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                        dt.classList.toggle(cls);
                                    }
                                })
                            }
                            if(parseInt(max)>7) {
                                if(arr_dt.curr_page<(parseInt(max)-3) && dt.textContent!=="...") {
                                    dt.disabled = true;
                                    dt.textContent = "...";
                                    mute.forEach(cls=>{
                                        if(dt.classList.contains(cls)) {
                                            dt.classList.toggle(cls);
                                        }
                                    })
                                }
            
                                if(arr_dt.curr_page>=(parseInt(max)-3)) {
                                    dt.disabled = false;
                                    const curPage = parseInt(max)-1;
                                    dt.textContent= curPage;
                                    dt.setAttribute('data-page', `${curPage}`);
                                }
                            }
                        }
                        if(id==="7") {
                            if(arr_dt.curr_page === parseInt(max)) {
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

    static class_toggle(key, cls, check=true, parent=document) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = parent.querySelector(key);
        }
        if(!check) {
            cls.forEach(dt=>{
                if(target.classList.contains(dt)) {
                    target.classList.toggle(dt);
                }
            })
        } else {
            cls.forEach(dt=>{
                if(!target.classList.contains(dt)) {
                    target.classList.toggle(dt);
                }
            })
        }
        return;
    }

    static attr_toggle(key, attr, parent=document) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = parent.querySelector(key);
        }
        attr.forEach(dt=>{
            if(!dt.includes('::') && target.hasAttribute(dt)) {
                target.removeAttribute(dt);
            } 
            if(dt.includes('::') && !target.hasAttribute(dt)) {
                const atr = dt.split('::');
                target.setAttribute(atr[0], atr[1]);
            }
        })
        return;
    }

    active_link(cls='') {
        const ul = this.nav.querySelector('ul');
        const aLink = ul.querySelectorAll('a');
        let styleClass = "h-full w-[10vw] text-white justify-center items-center flex hover:bg-slate-700 duration-200 ease-in-out hover:border-blue-500 hover:font-semibold hover:border-b-4 bg-blue-800 border-blue-300 border-b-4 font-semibold";
        if(cls!=='') {styleClass = cls;}
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

    async parse_dtlist(arr_dt) {
        try{
            const dtlist = document.createElement('datalist');
            dtlist.id = arr_dt.dtlist_id;
            let key =[];
            if(arr_dt['dtlist'].length >0) {
                arr_dt['dtlist'].forEach(dt=>{
                    key.push(dt);
                })
            } else {
                key = Object.keys(arr_dt['data'][0]);
            }
            arr_dt.data.forEach(dd=>{
                let defaultVal = '';
                let valu = '';
                if(key.length>0) {
                    key.forEach(dt2=>{
                        let cek = dd[dt2] ? dd[dt2].toString().trim() : "";
                        defaultVal +=  cek + this.separator.repeat(2);
                    })
                    valu = defaultVal.replace(new RegExp(this.separator + "+$"), "");
                } else {
                    valu = dd;
                }
                const option = document.createElement('option');
                option.value = valu;
                option.textContent = valu;
                dtlist.appendChild(option);
            })
            this.body.appendChild(dtlist);
            return;
        } catch(error){
            console.error('error ', error);
            return;
        }
    }

    async auth() {
        sessionStorage.clear();
        const check = window.location.href.split("/");
        let url =`http://${check[2]}/${check[3]}/2.backend/auth.php`;
        let ori =`http://${check[2]}`;
        try {
            const response = await fetch(url, {
                method: 'GET', 
                headers: {
                    'Content-Type': 'application/json',
                    'Ori': ori,
                }
            });
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            const data = await response.json();
            const check = window.location.href.split("/");
            const newURL = 'http://' + check[2] + '/sbe/index.php';
            if(typeof data === 'string' && data.includes('failed')) {
                window.location.replace(newURL);
                return;
            } else {
                const result = JSON.stringify(data);
                return result;
            }
        } catch (error) {
            console.error('Error:', error);
            return Promise.reject(error);
        }
    }

    async init(page_role) {
        let user_dtl = await this.userData;
        const check = window.location.href.split("/");
        const newURL = 'http://'+check[2]+'/'+check[3]+'/'+check[4]+'/index.html';
        if(user_dtl !== null) {
            if(page_role === '') {page_role = 'user';}
            if(page_role !== 'user' && user_dtl.role === 'user') {
                window.location.replace(newURL);
                return;
            }
            if(page_role === 'super' && user_dtl.role ==='admin') {
                window.location.replace(newURL);
                return;
            }
            if (user_dtl.role === 'admin' && page_role !=='super') {
                const del_node = document.querySelectorAll('[data-role]');
                del_node.forEach(dt=>{
                    const role = dt.getAttribute('data-role')
                    if(role === 'super') {
                        dt.remove();
                    }
                })
            }
            if (user_dtl.role === 'user' && page_role === 'user') {
                const del_node = document.querySelectorAll('[data-role]');
                del_node.forEach(dt=>{
                    dt.remove();
                })
            }
            const screen = document.getElementById('loadscreen');
            screen.classList.toggle('opacity-75');
        }
        return;
    }

    td_input_default() {
        document.addEventListener('click', function(event){
            if(event.target.tagName === 'TD' || event.target.closest('td')) {
                let td = event.target;
                if(event.target.tagName === 'LABEL') {
                    td = event.target.closest('td');
                }
                const inp = td.querySelector('input');
                const label = td.querySelector('label');
                if(inp !== null && !inp.disabled && inp.classList.contains('hidden')) {
                    inp.classList.toggle('hidden');
                    label.classList.toggle('hidden');
                    inp.focus();
                }
                const sel = td.querySelector('select');
                if(sel !== null && !sel.disabled && sel.classList.contains('hidden')) {
                    sel.classList.toggle('hidden');
                    label.classList.toggle('hidden');
                    sel.focus();
                }
            }
        })

        document.addEventListener('focusout', function(event) {
            if(event.target.closest('td') !== null) {
                if(event.target.tagName === 'INPUT' || event.target.tagName === 'SELECT') {
                    const curr = event.target;
                    const td = event.target.closest('td');
                    const label = td.querySelector('label');
                    if(!curr.classList.contains('hidden')) {
                        curr.classList.toggle('hidden');
                        label.textContent = curr.value;
                        label.classList.toggle('hidden');
                    }
                }
            }
        })

        document.addEventListener('change', function(event) {
            if(event.target.closest('td') !== null) {
                if(event.target.tagName === 'INPUT' || event.target.tagName === 'SELECT') {
                    const td = event.target.closest('td');
                    const tr = td.closest('tr');
                    const table = tr.closest('table');
                    const id = table.id.split('_');
                    const sbmt_btn = document.getElementById(id[0]+'_submit_btn');
                    let valid = false;
                    if(!tr.hasAttribute('data-change') && tr.getAttribute('data-change') !== 'new' && event.target.getAttribute('data-current') !== event.target.value) {
                        tr.setAttribute('data-change', 'change');
                    }
                    if(tr.hasAttribute('data-change') && event.target.getAttribute('data-current') === event.target.value) {
                        tr.removeAttribute('data-change');
                    }
                    const tr2 = table.querySelectorAll('tbody tr');
                    tr2.forEach(dt=>{
                        if(dt.hasAttribute('data-change')) {
                            valid = true;
                        }
                    })
                    if(valid) {
                        if(sbmt_btn !== null) {
                            if(sbmt_btn.disabled === true) {
                                sbmt_btn.disabled = false; 
                            }
                            if(sbmt_btn.classList.contains('text-white')) {
                                sbmt_btn.classList.remove('text-white')
                                sbmt_btn.classList.add('font-bold');
                            }
                        }
                    } else {
                        if(sbmt_btn !== null) {
                            if(sbmt_btn.disabled === false) {
                                sbmt_btn.disabled = true; 
                            }
                            if(!sbmt_btn.classList.contains('text-white')) {
                                sbmt_btn.classList.add('text-white')
                                sbmt_btn.classList.remove('font-bold');
                            }
                        }

                    }
                }
            }
        })
        return;
    }

    async submit_check(arr_dt, parent = document){
        const table = parent.getElementById(arr_dt.table_id);
        if(table !== null) {
            const tr = table.querySelectorAll('tbody tr');
            let valid = false;
            tr.forEach(dt=>{
                if(dt.hasAttribute('data-change')) {
                    valid = true;
                }
            })
            if(valid) {
                const sbmt_btn = document.getElementById(arr_dt.submit_btn);
                if(sbmt_btn !== null) {
                    if(sbmt_btn.disabled === true) {
                        sbmt_btn.disabled = false; 
                    }
                    if(sbmt_btn.classList.contains('text-white')) {
                        sbmt_btn.classList.remove('text-white')
                        sbmt_btn.classList.add('font-bold');
                    }
                }
            }
        }
        return;
    }

   async table_clear(main_id, parent=document) {
        if(this.dtbase[`detail__${main_id}`]) {
            const arr_dt = this.dtbase[`detail__${main_id}`];
            const table = parent.getElementById(arr_dt.table_id);
            const submit_btn = parent.getElementById(arr_dt.submit_btn);
            const all_tr = table.querySelectorAll('tbody tr');
            all_tr.forEach(dt=>{
                if(!dt.id.includes('template')) {
                    if(dt.hasAttribute('data-value')) {
                        const td = dt.querySelectorAll('td');
                        td.forEach(dd=>{
                            dd.removeAttribute('data-value');
                            const inpt = dd.querySelectorAll('input');
                            inpt.forEach(dd=>{
                                dd.value = '';
                            })
                            const label = dd.querySelectorAll('label');
                            label.forEach(dd=>{
                                dd.textContent = '';
                            })
                            const sel = dd.querySelectorAll('select');
                            sel.forEach(dd=>{
                                dd.value = '';
                            })
                        })
                        if(!dt.classList.contains('hidden')) {
                            dt.classList.add('hidden');
                        }
                    }
                }
                if(dt.hasAttribute('data-change')){ 
                    if(dt.getAttribute('data-change') === 'new') {
                        dt.remove();
                    }
                    if(dt.getAttribute('data-change') === 'change') {
                        dt.removeAttribute('data-change');
                    }
                    if(submit_btn) {
                        submit_btn.disabled = true;
                        submit_btn.classList.add('text-white');
                        submit_btn.classList.remove('font-bold');
                    }
                }
            })
            return;
        } else {
            console.log('database tidak ada ');
        }
    }

   async table_new_row(arr_dt, parent=document) {
        let btn = parent.getElementById(arr_dt.add_id);
        let table = parent.getElementById(arr_dt.table_id);
        let tbody = table.querySelector('tbody');
        if(btn) {
            btn.addEventListener('click', async(e)=>{
                if(e.target.getAttribute('data-scope') === arr_dt.name_id) {
                    const template = table.querySelector(`[data-id = "${arr_dt.table_id}__template"]`);
                    const new_row = template.cloneNode(true);
                    new_row.setAttribute('data-id', `new__${arr_dt.table_id}__${this.counter}`);
                    if(new_row.classList.contains('hidden')) {
                        new_row.classList.remove('hidden');
                    }
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
                                    label.setAttribute('for', `${name}__${arr_dt.table_id}__new__${this.counter}`);
                                    dt.id = `${name}__${arr_dt.table_id}__new__${this.counter}`;
                                }
                            }
                        }
                    })
                    if(arr_dt.add_row === 'upper') {
                        tbody.insertBefore(new_row,tbody.rows[0]);
                    } else {
                        tbody.appendChild(new_row);
                    }
                    await this.submit_check(arr_dt);
                }  
                this.counter++; 
            })
            return;
        }
    }
        
    async table_dl(arr_dt, parent=document) {
        const dl_btn = parent.getElementById(arr_dt.dl_id);
        this.load_toggle();
        if(dl_btn && arr_dt.show.length >0) {
            dl_btn.addEventListener('click', async(e)=>{
                if((e.target.getAttribute('data-scope') === arr_dt.name_id)){
                    let dl_dt = [];
                    arr_dt.show.forEach(dt=>{
                        let dd = dt;
                        delete dd.filter;
                        dl_dt.push(dd);
                    })
                    const workbook = XLSX.utils.book_new();
                    const worksheet = XLSX.utils.json_to_sheet(dl_dt);
                    XLSX.utils.book_append_sheet(workbook, worksheet, arr_dt.main_id);
                    XLSX.writeFile(workbook, `${currentDate('_')}__${arr_dt.main_id}.xlsx`)
                }
            })
        }
        this.load_toggle();
        return;
    }
        
    async new_row_default_value(array_value={}, arr_dt, parent=document) {
        const table = parent.getElementById(arr_dt.table_id);
        const temp = table.querySelector('[data-id *= "template"]');
        if(temp !== null) {
            const keys = Object.keys(array_value);
            keys.forEach(dt=>{
                const field = temp.querySelector(`[name ="${dt}"]`);
                if(field.disabled === true) {
                    field.disabled = false;
                    field.value = array_value[`${dt}`];
                    field.disabled = true;
                }
                field.value = array_value[`${dt}`];
                const label = temp.querySelector(`[for="${field.id}"]`);
                if(label !== null) {
                    label.textContent = array_value[`${dt}`];
                }
            })
        }
        return;
    }

    func(type, selector, callback, parent=document) {
        parent.addEventListener(type, e=>{
            if(e.target.matches(selector)) {
                callback(e);
            }
        })
    }

}