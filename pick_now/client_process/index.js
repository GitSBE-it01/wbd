import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';
import {currentDate} from '../../3.utility/index.js';

const main = new DOM2();
const mstr = await api_access('patch_P1.ASSY', 'pn_fix', '');
let curr_dept = document.querySelector('#filter__dept_pick');
main.view_init({type:'table', main_id:'pick', data: mstr, filter:curr_dept.value});
main.load_toggle();

main.func(
    'change',
    '#filter__dept_pick',
    async(e)=>{
        main.load_toggle();
        const val = e.target.value;
        const data = await api_access('patch_'+val, 'pn_fix', '');
        main.view_init('table','pick', data, curr_dept.value);
        console.log(main.dtbase);
        main.load_toggle();
        return;
    }
)

main.func(
    'click',
    '#dl_btn',
    async()=>{
        main.load_toggle();
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(main.dtbase[`detail__${curr_dept.value}`]['show']);
        XLSX.utils.book_append_sheet(workbook, worksheet, 'data');
        XLSX.writeFile(workbook, 'pick_now.xlsx')
        setTimeout(() => {
            main.load_toggle();
        }, 1000)
        return;
    }
)