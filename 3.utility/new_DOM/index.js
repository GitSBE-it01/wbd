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
        this.dtshow = [];
        this.active_link();
        this.init(page_role);
        this.td_input_default();
    }
    
    load_toggle() {
        this.load.classList.toggle('hidden');
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

    async parse_dtlist(dbase) {
        try{
            for (let i=0; i<dbase.length; i++) {
                let dt = dbase[i];
                const dtlist = document.createElement('datalist');
                dtlist.id = dt.id_dtlist;
                this.dtbase[`${dt.db}`].forEach(dd=>{
                    const key = Object.keys(dd);
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
                    if(!dt.keyPick || dt.keyPick === '') {
                        option.value = valu;
                        option.textContent = valu;
                    } else {
                        let val = ''
                        dt.keyPick.forEach(dt2=>{
                            let cek = dd[dt2] ? dd[dt2].toString().trim() : "";
                            val += cek + this.separator.repeat(2);
                        })
                        val = val.replace(new RegExp(this.separator + "+$"), "");
                        option.value = val;
                        option.textContent = val;
                    }
                    dtlist.appendChild(option);
                })
                this.body.appendChild(dtlist);
            }
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
                    if(!tr.hasAttribute('data-change') && tr.getAttribute('data-change') !== 'new' && event.target.getAttribute('data-current') !== event.target.value) {
                        tr.setAttribute('data-change', 'change');
                    }
                    if(tr.hasAttribute('data-change') && event.target.getAttribute('data-current') === event.target.value) {
                        tr.removeAttribute('data-change');
                    }
                }
            }
        })
        return;
    }

    parse_input(key, data, dsbl=false, parent=document) {
        let target = '';
        if(key.nodeType) {
            target = key;
        } else {
            target = parent.querySelector(key);
        }
        if(target.tagName === 'TABLE') {
            let count = 0;
            const id_tbl = target.id;
            const dt_cnt = data.length;
            if(dt_cnt>50) {
                for(let i=0; i<49; i++) {
                    let dt = data[i];
                    console.log(dt);
                    const tr = target.querySelector(`[data-id="${id_tbl}__${count}"]`);
                    if(tr.classList.contains('hidden')) {
                        DOM2.class_toggle(tr, ['hidden']);
                    }
                    DOM2.class_toggle(tr, ['hidden']);
                    const td = tr.querySelectorAll('[name]');
                    td.forEach(d2=>{
                        const field = d2.getAttribute('name');
                        const curr = d2.hasAttribute('disabled') ? true : false;
                        d2.disabled = false;
                        d2.value = dt[`${field}`] ? dt[`${field}`] :'';
                        if(target.querySelector(`[for = "${d2.id}"]`) !== null) {
                            target.querySelector(`[for = "${d2.id}"]`).value = dt[`${field}`] ? dt[`${field}`] :'';
                        }
                        if(dsbl) {
                            d2.disabled = false;
                        } else {
                            d2.disabled = curr;
                        }
                    })
                }
            }
            return;
        } 
        if(data.length === 1) { 
            const inp_name = target.querySelectorAll('[name]');
            inp_name.forEach(dt=>{
                const field = dt.getAttribute('name');
                const curr = dt.hasAttribute('disabled') ? true : false;
                dt.disabled = false;
                dt.value = data[0][`${field}`] ? data[0][`${field}`] :'';
                if(target.querySelector(`[for = "${dt.id}"]`) !== null && dt.classList.contains('hidden')) {
                    target.querySelector(`[for = "${dt.id}"]`).value = data[0][`${field}`] ? data[0][`${field}`] :'';
                }
                if(dsbl) {
                    dt.disabled = false;
                } else {
                    dt.disabled = curr;
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