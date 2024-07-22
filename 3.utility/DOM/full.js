export class DOM {
    static dtList_parse_opt (key, separator, dataArr, ...keyPick) {
        const dtlist = document.querySelector(key);
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
            dtlist.appendChild(option);
        })
        return;
    }

    static input_valid (key, value, input) {
        const dtlist = document.querySelector(key);
        const inpt = document.querySelector(input);
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

    static pgList_init(key, data, table) {
        const div = document.querySelector(key);
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
                    this.mute.forEach(cls=>{
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
        const div = document.querySelector(key);
        const pagi = div.querySelectorAll('[data-id]');
        const max = div.querySelector('[data-id = "7"]').getAttribute('data-page');
        pagi.forEach(dt=>{
            const id = dt.getAttribute('data-id');
            if(!dt.disabled) {
                this.active.forEach(cls=>{
                    if(cls !== 'bg-slate-200' && dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                    if(cls === 'bg-slate-200' && !dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                })
            }
            if(!dt.disabled) {
                this.mute.forEach(cls=>{
                    if(!dt.classList.contains(cls)) {
                        dt.classList.toggle(cls);
                    }
                })
            }
            if(max>7) {
                if(id==="1") {
                    if(page === 1) {
                        this.active.forEach(cls=>{
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
                        this.active.forEach(cls=>{
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
                        this.mute.forEach(cls=>{
                            if(dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    }
                }
                if(id==="3"){
                    if(page === 3) {
                        dt.textContent="3";
                        this.active.forEach(cls=>{
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
                        this.active.forEach(cls=>{
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
                        this.active.forEach(cls=>{
                            if(cls === 'bg-slate-200'&& dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                            if(cls !== 'bg-slate-200' && !dt.classList.contains(cls)) {
                                dt.classList.toggle(cls);
                            }
                        })
                    }
                    if(page<(parseInt(max)-2) && page>4) {
                        dt.setAttribute('data-page', `${page+1}`);
                        dt.textContent = page+1;
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
                        this.active.forEach(cls=>{
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
                        this.mute.forEach(cls=>{
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
                        this.active.forEach(cls=>{
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

    static async table_parse_data (key, data, page) {
        try {
            const table = document.querySelector(key);
            const tr = table.querySelectorAll('tr');
            let count = 0;
            if(page >1) {
                count = tr.length * (page-1);
            }
            tr.forEach(dt=>{
                if(dt.getAttribute('data-id') !== 'header' && !dt.classList.contains('hidden')) {
                    dt.classList.toggle('hidden');
                }
                if(dt.getAttribute('data-id') !== 'header' && data[count]) {
                    const fld = dt.querySelectorAll("[name]");
                    if(dt.classList.contains('hidden')) {
                        dt.classList.toggle('hidden');
                    }
                    dt.setAttribute('data-value', count);
                    fld.forEach(d2=>{
                        const key_fld = d2.getAttribute('name');
                        const currVal = data[count][`${key_fld}`] ? data[count][`${key_fld}`] : '';
                        if(d2.tagName === 'INPUT' && d2.getAttribute('type')==='text') {
                            d2.setAttribute('value', currVal);
                            const lbl = document.querySelector(`[for="${d2.id}"]`);
                            lbl.textContent= currVal;
                        }
                        if(d2.tagName === 'INPUT' && d2.getAttribute('type')==='hidden') {
                            d2.value = currVal;
                        }
                        if(d2.tagName === 'SELECT') {
                            d2.value = currVal;
                        }
                        if(d2.tagName === 'TD') {
                            d2.textContent = currVal;
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
                            const lbl = document.querySelector(`[for="${d2.id}"]`);
                            lbl.textContent = '';
                        }
                        if(d2.tagName === 'INPUT' && d2.getAttribute('type')==='hidden') {
                            d2.value = '';
                        }
                        if(d2.tagName === 'SELECT') {
                            d2.value = '';
                        }
                        if(d2.tagName === 'TD') {
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

    static rmv_class(trgt, ...cls) {
        const target = document.querySelector(trgt);
        cls.forEach(dt=>{
            if(target.classList.contains(dt)) {
                target.classList.remove(dt);
            }
        })
        return;
    }

    static add_class(trgt, ...cls) {
        const target = document.querySelector(trgt);
        cls.forEach(dt=>{
            if(!target.classList.contains(dt)) {
                target.classList.add(dt);
            }
        })
        return;
    }

    static form_parse_data() {

    }
}