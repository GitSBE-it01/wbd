export const activeLink = (cls) => {
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
}

export class Pagination {
    constructor(key) {
        this.key = key;
    }

    init_page(data, table) {
        const dt_cnt = data.length;
        const tbl = document.getElementById(table);
        const tr = tbl.querySelectorAll('tr');
        const tr_cnt = tr.length -1; //-1 utk header
        const max_page = Math.ceil(dt_cnt/tr_cnt);
        const div = document.getElementById(this.key);
        const pagi = div.querySelectorAll('[data-page]');
        pagi.forEach(dt=>{
            const pg = dt.getAttribute('data-page');
            if(!dt.classList.contains("hidden")) {
                dt.classList.toggle('hidden');
            }
            if(pg<8) {
                if(pg==='7' && max_page===7){dt.setAttribute('data-page', max_page);}
                console.log(parseInt(pg));
                console.log(parseInt(pg)<=max_page);
                if(dt.classList.contains('hidden') && !parseInt(pg)<=max_page){
                    dt.classList.toggle('hidden');
                }
            } else {
                if(pg==='1') {
                    dt.textContent="first";
                    dt.classList.toggle('w-20');
                };
                if(pg==='6') {dt.textContent="..."};
                if(pg==='last'){dt.setAttribute('data-page', max_page);}
                if(dt.classList.contains('hidden') ){
                    dt.classList.toggle('hidden');
                }
            }
        })
    }

    active_page(page) {
        const div = document.getElementById(this.key);
        const pagi = div.querySelectorAll('[data-page]');
        const max = pagi.length;
        pagi.forEach(dt=>{
            const pg = dt.getAttribute('data-page');
            if(dt.classList.contains('font-semibold')) {
                dt.classList.toggle('font-semibold');
                dt.classList.toggle('w-6');
                dt.classList.toggle('h-6');
                dt.classList.toggle('w-8');
                dt.classList.toggle('h-8');
                dt.classList.toggle('border-black');
                dt.classList.toggle('border-slate-400');
            }
            if(page === 1 && !dt.classList.contains('font-semibold')) {
                dt.classList.toggle('font-semibold');
                dt.classList.toggle('w-6');
                dt.classList.toggle('h-6');
                dt.classList.toggle('w-8');
                dt.classList.toggle('h-8');
                dt.classList.toggle('border-black');
                dt.classList.toggle('border-slate-400');
            }
        })
    }
}