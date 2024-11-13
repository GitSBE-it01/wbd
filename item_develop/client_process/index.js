import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';

const main = new DOM2();
const dtl = await api_access('fetch', 'id_dtl', {status:'open'});
const mstr = await api_access('fetch', 'id_mstr', {status:'open'});
dtl.forEach(dt=>{
    if(dt['bom_release_date'] === '' || dt['bom_release_date'] === '0000-00-00' || dt['bom_release_date'] === null) {
        dt['age'] = 0;
    } else {
        let cls_dt = new Date();
        const cls_dt_int = Math.floor(cls_dt.getTime() / (1000 * 60 * 60 * 24));
        let rel_dt = new Date(dt['bom_release_date']);
        const rel_dt_int = Math.floor(rel_dt.getTime() / (1000 * 60 * 60 * 24));
        dt['age'] = cls_dt_int - rel_dt_int;
    }
})
main.view_init({type:'table', main_id:'idev', data:dtl});
main.load_toggle();

main.func(
    'click',
    '[data-switch]',
    async(e)=>{
        main.load_toggle();
        const code = e.target.getAttribute('data-switch');
        const arr = ['idev', 'master'];
        arr.forEach(dt=>{
            if(dt === code) {
                const swtc = document.querySelector(`#${dt}`);
                swtc.setAttribute('class','flex flex-1 h-full cursor-pointer hover:bg-blue-600 justify-center items-center items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-600 text-xl font-bold');
                const hd = document.querySelector(`#${dt}_div`);
                hd.classList.remove('hidden');
                const tbl= document.querySelector(`#${dt}_table`);
                tbl.classList.remove('hidden');
                const pg = document.querySelector(`#${dt}_page`);
                pg.classList.remove('hidden');
            } else {
                const swtc = document.querySelector(`#${dt}`);
                swtc.setAttribute('class','flex flex-1 h-full cursor-pointer hover:bg-blue-600 justify-center items-center items-center duration-300 hover:text-xl hover:font-bold text-white bg-blue-800');
                const hd = document.querySelector(`#${dt}_div`);
                hd.classList.add('hidden');
                const tbl= document.querySelector(`#${dt}_table`);
                tbl.classList.add('hidden');
                const pg = document.querySelector(`#${dt}_page`);
                pg.classList.add('hidden');
            }
        })
        if(code === 'master') {
            main.view_init({type:'table', main_id:'master', data:mstr});
        }
        main.load_toggle();
        return;
    }
)

main.func(
    'click',
    '#idev_dl_btn',
    async(e)=>{
        main.load_toggle();
        const id_ = e.target.id;
        const val = id_.split('_');
        const dat = main.dtbase[`detail__${val[0]}`]['show'];
        dat.forEach(dt=>{
            delete dt.filter;
        })
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(dat);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'parent');
        XLSX.writeFile(workbook, 'item_dev.xlsx')
        main.load_toggle();
        return;
    }
)

main.func(
    'click',
    '#master_dl_btn',
    async(e)=>{
        main.load_toggle();
        const id_ = e.target.id;
        const val = id_.split('_');
        const dat = main.dtbase[`detail__${val[0]}`]['show'];
        dat.forEach(dt=>{
            delete dt.filter;
        })
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(dat);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'komponen');
        XLSX.writeFile(workbook, 'item_dev.xlsx')
        main.load_toggle();
        return;
    }
)