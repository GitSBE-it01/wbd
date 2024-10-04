import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';

await auth2();
await GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
let counter = 0;
const rf_ls = await api_access('get','vjs_reff','');
const loc_ls = await api_access('get','vjs_loc','');
const master = await api_access('get','vjs_alat','');
master.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
})
let show_data = master;
console.log(show_data);
console.log({master, loc_ls});
DtlistDOM.parse_opt("#reff_list","-",rf_ls,"subcat");
DtlistDOM.parse_opt("#loc_list","-",loc_ls,"location");
TableDOM.parse_data('#tool_table', show_data, 1);
NavDOM.pgList_init('#tool_page', master, '#tool_table');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");
if(document.querySelector('#new__data') !== null) {
    ButtonDOM.insert_row('#new__data','#tool_new', '#tool_table', counter);
}
if(document.querySelector('#del_data') !== null) {
    ButtonDOM.show_hidden('#del_data', '[data-field = "data_group"]');
}

InputDOM.input_validity('[name ="loc"]');
InputDOM.input_validity('[name ="new_subcat"]');
NavDOM.pgList_active('tool_page');
await TableDOM.parse_onclick('#tool_table', show_data, 'data-group', 'tool_page');
await TableDOM.filter_data('#tool_table', master, show_data, 'search_btn', 'input__tool_search', '#tool_page');

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

ButtonDOM.delete_data_table('[data-method ="delete"]', 'vjs_alat', 'sn_id');
ButtonDOM.enter_keydown('#search_btn', '#input__tool_search');

document.addEventListener('click', async(e)=>{
    if(e.target.getAttribute('data-method') === 'submit') {
        const table = document.querySelector('#tool_table');
        const tr = table.querySelectorAll('tbody tr');
        console.log(tr);
        let update = [];
        let insert = [];
        tr.forEach(dt=>{
            if(dt.getAttribute('data-change') === 'change') {
                let data = {};
                const name = dt.querySelectorAll('[name]');
                name.forEach(d2=>{
                    data[d2.getAttribute('name')] = d2.value;
                })
                update.push(data);
            };
            if(dt.getAttribute('data-change') === 'new') {
                let data = {};
                const name = dt.querySelectorAll('[name]');
                name.forEach(d2=>{
                    if(d2.getAttribute('name') === 'sn_id') {
                        data[d2.getAttribute('name')] = 'SN--'+d2.value;
                    } else{
                        data[d2.getAttribute('name')] = d2.value;
                    }
                })
                insert.push(data);
            };
        }) 

        console.log({update, insert});
        let msg ='';
        if(update.length>0) {
            let result1 = await api_access('update','vjs_alat', update);
            if(result1.includes('fail')) {
                msg += 'update data gagal';
            } else {
                msg += update.length + 'data di update';
            }
        }

        if(insert.length>0) {
            let result2 = await api_access('insert','vjs_alat', insert);
            if(result2.includes('fail')) {
                msg += ' insert data gagal';
            } else {
                msg += insert.length + ' data di insert';
            }
        }
        alert (msg);
        DOM.add_class('#load',"hidden");
        location.reload();
        return;
    }
})