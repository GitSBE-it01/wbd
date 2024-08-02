import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';

await auth2();
GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
let counter = 0;
const reff = await api_access('get','vjs_reff','');
const loc = await api_access('get','vjs_loc','');
reff.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
})
loc.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
})
let show_reff = reff;
let show_loc = loc;
console.log({reff, loc});

await TableDOM.parse_data('#reff_table', reff, 1);
NavDOM.pgList_init('#reff_page', reff, '#reff_table');
await TableDOM.parse_data('#loc_table', loc, 1);
NavDOM.pgList_init('#loc_page', loc, '#loc_table');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");

if(document.querySelector('#add_reff_btn') !== null) {
    ButtonDOM.insert_row('#add_reff_btn','#new_reff_table', '#reff_table', counter);
}
if(document.querySelector('#add_loc_btn') !== null) {
    ButtonDOM.insert_row('#add_loc_btn','#new_loc_table', '#loc_table', counter);
}

await TableDOM.parse_onclick('#reff_table', show_reff, 'data-group', 'reff_page');
await TableDOM.direct_filter_data('#reff_table', reff, show_reff, 'reff_inp', '#reff_page');

await TableDOM.parse_onclick('#loc_table', show_loc, 'data-group', 'loc_page');
await TableDOM.direct_filter_data('#loc_table', loc, show_loc, 'loc_inp', '#loc_page');


if(document.querySelector('#submit_loc_btn') !== null &&  document.querySelector('#submit_reff_btn') !== null) {
    document.addEventListener('change', function(event) {
        if(event.target.hasAttribute('name') && event.target.id.includes('loc_table')) {
            const td = event.target.closest('td');
            const tr = td.closest('tr');
            if(tr.hasAttribute('data-change')) {
                DOM.add_class('#submit_loc_btn', 'font-bold', 'bg-red-400');
                DOM.rmv_class('#submit_loc_btn', 'bg-gray-300');
                DOM.set_attr('#submit_loc_btn', 'data-method', 'submit');
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
                DOM.rmv_class('#submit_loc_btn', 'font-bold', 'bg-red-400');
                DOM.add_class('#submit_loc_btn', 'bg-gray-300');
                DOM.rmv_attr('#submit_loc_btn', 'data-method');
            }
            return
        }
        if(event.target.hasAttribute('name') && event.target.id.includes('reff_table')) {
            const td = event.target.closest('td');
            const tr = td.closest('tr');
            if(tr.hasAttribute('data-change')) {
                DOM.add_class('#submit_reff_btn', 'font-bold', 'bg-red-400');
                DOM.rmv_class('#submit_reff_btn', 'bg-gray-300');
                DOM.set_attr('#submit_reff_btn', 'data-method', 'submit');
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
                DOM.rmv_class('#submit_reff_btn', 'font-bold', 'bg-red-400');
                DOM.add_class('#submit_reff_btn', 'bg-gray-300');
                DOM.rmv_attr('#submit_reff_btn', 'data-method');
            }
            return
        }
    })
}

ButtonDOM.delete_data_table('[data-method ="delete"]', 'vjs_loc', 'location') ;
ButtonDOM.delete_data_table('[data-method ="delete"]', 'vjs_reff', 'subcat')

NavDOM.pgList_active('loc_page');
NavDOM.pgList_active('reff_page');

ButtonDOM.submit_dataset_table('#submit_loc_btn[data-method = "submit"]', '#loc_table', 'vjs_loc');
ButtonDOM.submit_dataset_table('#submit_reff_btn[data-method = "submit"]', '#reff_table', 'vjs_reff');
ButtonDOM.enter_keydown('#search_btn', '#input__tool_search');