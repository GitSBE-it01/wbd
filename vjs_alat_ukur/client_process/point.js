import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';

await auth2();
GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
let counter = 0;
const rf_ls = await api_access('get','vjs_reff','');
const master = await api_access('get','vjs_point','');
master.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
})
let show_data = master;
console.log({master});
DtlistDOM.parse_opt("#reff_list","-",rf_ls,"subcat");
await TableDOM.parse_data('#point_table', show_data, 1);
NavDOM.pgList_init('#point_page', master, '#point_table');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");

if(document.querySelector('#new__data') !== null) {
    ButtonDOM.insert_row('#new__data','#point_new', '#point_table', counter);
}
if(document.querySelector('#del_data') !== null) {
    ButtonDOM.show_hidden('#del_data', '[data-field = "data_group"]');
}
InputDOM.input_validity('[name ="loc"]');
InputDOM.input_validity('[name ="new_subcat"]');
NavDOM.pgList_active('point_page');
await TableDOM.parse_onclick('#point_table', show_data, 'data-group', 'point_page');
await TableDOM.filter_data('#point_table', master, show_data, 'search_btn', 'input__tool_search', '#point_page');

if(document.querySelector('#submit_form_btn') !== null) {
    document.addEventListener('change', function(event) {
        if(event.target.hasAttribute('name')) {
            const td = event.target.closest('td');
            const tr = td.closest('tr');
            if(tr.hasAttribute('data-change')) {
                DOM.add_class('#submit_form_btn', 'font-bold', 'bg-red-400');
                DOM.rmv_class('#submit_form_btn', 'bg-gray-300', 'text-slate-200');
                DOM.rmv_attr('#submit_form_btn', 'disabled');
                DOM.set_attr('#submit_form_btn', 'data-method', 'submit');
                return;
            }
            const table = tr.closest('table');
            const tr_all = table.querySelectorAll('tr');
            let valid = false;
            tr_all.forEach(dt=>{
                if(tr.hasAttribute('data-change')) {
                    valid = true;
                }
            })
            if(!valid) {
                DOM.rmv_class('#submit_form_btn', 'font-bold', 'bg-red-400');
                DOM.add_class('#submit_form_btn', 'bg-gray-300', 'text-slate-200');
                DOM.set_attr('#submit_form_btn', 'disabled', 'true');
                DOM.rmv_attr('#submit_form_btn', 'data-method');
            }
            return
        }
    })
}

ButtonDOM.delete_data_table('[data-method ="delete"]', 'vjs_point', 'id');
ButtonDOM.submit_dataset_table('[data-method ="submit"]', '#point_table', 'vjs_point');
ButtonDOM.enter_keydown('#search_btn', '#input__tool_search');