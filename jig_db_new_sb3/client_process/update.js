import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, currentDate} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';
import {data_switch} from './general.js';

document.addEventListener('DOMContentLoaded', async()=>{
/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
let loc = [];
let loc_show = [];
let log_loc = [];
let log_loc_show = [];
let func = [];
let func_show = [];
let log_func = [];
let log_func_show = [];
let detail = [];
let detail_show = [];
let log_detail = [];
let log_detail_show = [];
let start = performance.now();
const ls_loc = await api_access('get','loc_data_sb3','');
let end = performance.now();
console.log('ls_loc ', (end-start)/1000, ' ms');
start = performance.now();
const master = await api_access('get','master_data_sb3','');
end = performance.now();
console.log('master ', (end-start)/1000, ' ms');
start = performance.now();
const item = await api_access('fetch_item__cache','qad_item','');
end = performance.now();
console.log('item ', (end-start)/1000, ' ms');
// datalist parsing option
//----------------------------------------------
start = performance.now();
DtlistDOM.parse_opt("#jig_list","-",master,"item_jig", 'desc_jig');
DtlistDOM.parse_opt("#spk_list","-",item,"pt_part", 'pt_desc1', 'pt_desc2');
DtlistDOM.parse_opt("#loc_list","-",ls_loc,"name");
end = performance.now();
console.log('datalist loaded data ', (end-start)/1000, ' ms');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");


/* ====================================================================
  from classes function
==================================================================== */
// check input validity
//----------------------------------------------
InputDOM.input_validity('#input__stock');
InputDOM.input_validity('#input__detail');
InputDOM.input_validity('#input__type');

// enter keydown input trigger button
//----------------------------------------------
ButtonDOM.enter_keydown('#search_stock', '#input__stock');
ButtonDOM.enter_keydown('#search_detail', '#input__detail');
ButtonDOM.enter_keydown('#search_type', '#input__type');

// delete button to delete row table
//----------------------------------------------
ButtonDOM.delete_data_table('[data-method ="delete"]', 'jig_loc', 'id');
ButtonDOM.delete_data_table('[data-method ="delete"]', 'jig_func', 'id');

// input change trigger submit button style and attribute
//----------------------------------------------
InputDOM.submit_change_style_table('#type_table', '#submit_type');
InputDOM.submit_change_style_table('#stock_table', '#submit_stock');

// edit button trigger change attribute and style
//----------------------------------------------
ButtonDOM.edit_form_button('#edit_detail','#submit_detail', '#detail_form', ['font-bold', 'bg-red-400','bg-gray-300', 'text-slate-200'],
  ['text-white', 'bg-slate-600']
)

// add new button trigger new row inserted to table
//----------------------------------------------
let counter =0;
if(document.querySelector('#add_new_stock') !== null) {
  ButtonDOM.insert_row2('#add_new_stock','#stock_table_new', '#stock_table', counter, 'bot');
}
if(document.querySelector('#add_new_type') !== null) {
  ButtonDOM.insert_row2('#add_new_type','#type_table_new', '#type_table', counter, 'bot');
}

/* ====================================================================
  custom function and event
==================================================================== */
// click switch to change page (show hide and hide current display)
//----------------------------------------------
let code_array = [
  'stock',
  'detail',
  'type',
]
let target_array = [
  'switch',
  'div_search',
  'div'
]
document.addEventListener('click', async function(event) {
  if(event.target.id === 'stock_switch') {
    data_switch('stock', code_array, target_array); 
    return;
  }
  if(event.target.id === 'detail_switch') {
    data_switch('detail', code_array, target_array); 
    return;
  }
  if(event.target.id === 'type_switch') {
    data_switch('type', code_array, target_array); 
    return;
  }
})

//----------------------------------------------
// click search button to check validity and parsing data
//----------------------------------------------
document.addEventListener('click', async function(event) {
  // click search for stock
  //----------------------------------------------
  if(event.target.id === 'search_stock') {
    event.target.disabled = true;
    let src = document.getElementById('input__stock');
    let valid = src.checkValidity();
    if(!valid) {
      src.reportValidity();
      event.target.disabled = false;
        return;
    }
    DOM.rmv_class('#load',"hidden");
    TableDOM.clear('#stock_table');
    TableDOM.clear('#stock_table_hist');
    if(src.value === '') {
      event.target.disabled = false;
      DOM.add_class('#load',"hidden");
      return;
    }
    const value = src.value;
    const splt = value.split('--');
    if(loc.find(obj=>obj.item_jig === splt[0]) === undefined) {
      let data = await api_access('fetch','loc_data_sb3',{item_jig: splt[0]});
      data.forEach(dt=>{
        loc.push(dt);
      })
    }
    if(log_loc.find(obj=>obj.item_jig === splt[0]) === undefined) {
      let data = await api_access('fetch','loc_log_sb3',{item_jig: splt[0]});
      data.forEach(dt=>{
        log_loc.push(dt);
      })
    }
    loc_show = loc.filter(obj=>obj.item_jig === splt[0]);
    log_loc_show = log_loc.filter(obj=>obj.item_jig === splt[0]);
    console.log(log_loc_show);
    log_loc_show.sort((a,b)=>{
      if (a.trans_date !== b.trans_date) return b.trans_date.localeCompare(a.     trans_date);
    })
    console.log({loc, log_loc, loc_show, log_loc_show});
      TableDOM.parse_data('#stock_table', loc_show, 1);
      TableDOM.set_default_new_row('#stock_table_new', loc_show, ['item_jig', 'code'])
      NavDOM.pgList_init('#stock_page', loc_show, '#stock_table');
      TableDOM.parse_onclick('#stock_table',  loc_show, 'data-group','stock_page');
      NavDOM.pgList_active('stock_page');
        TableDOM.parse_data('#stock_table_hist', log_loc_show, 1);
        NavDOM.pgList_init('#stock_hist_page', log_loc_show, '#stock_table_hist');
        TableDOM.parse_onclick('#stock_table_hist',  log_loc_show, 'data-group','stock_hist_page');
        NavDOM.pgList_active('stock_hist_page');
    event.target.disabled = false;
    DOM.add_class('#load',"hidden");
    return;
  }

  // click search for type
  //----------------------------------------------
  if(event.target.id === 'search_type') {
    event.target.disabled = true;
    let src = document.getElementById('input__type');
    let valid = src.checkValidity();
    if(!valid) {
      src.reportValidity();
      event.target.disabled = false;
        return;
    }
    DOM.rmv_class('#load',"hidden");
    TableDOM.clear('#type_table');
    TableDOM.clear('#type_table_hist');
    if(src.value === '') {
      event.target.disabled = false;
      DOM.add_class('#load',"hidden");
      return;
    }
    const value = src.value;
    const splt = value.split('--')
    if(func.find(obj=>obj.item_type === splt[0]) === undefined) {
      let data = await api_access('fetch','func_data_sb3',{item_type: splt[0]});
      data.forEach(dt=>{
        const desc = master.find(obj=>obj.item_jig === dt.item_jig);
        if(desc !== undefined) {
          dt['desc_jig'] = desc.desc_jig
        }
        func.push(dt);
      })
    }
    if(log_func.find(obj=>obj.item_type === splt[0]) === undefined) {
      let data = await api_access('fetch','func_log_sb3',{item_type: splt[0]});
      console.log({data});
      data.forEach(dt=>{
        const desc = master.find(obj=>obj.item_jig === dt.item_jig);
        if(desc !== undefined) {
          dt['desc_jig'] = desc.desc_jig
        }
        log_func.push(dt);
      })
    }
    func_show = func.filter(obj=>obj.item_type === splt[0]);
    log_func_show = log_func.filter(obj=>obj.item_type === splt[0]);
    log_func_show.sort((a,b)=>{
      if (a.trans_date !== b.trans_date) return b.trans_date.localeCompare(a.trans_date);
    })
    console.log({func, log_func, func_show, log_func_show});
    if(func_show.length > 0 ) {
      TableDOM.parse_data('#type_table', func_show, 1);
      TableDOM.set_default_new_row('#type_table_new', func_show, ['item_type'])
      NavDOM.pgList_init('#type_page', func_show, '#type_table');
      TableDOM.parse_onclick('#type_table',  func_show, 'data-group','type_page');
      NavDOM.pgList_active('type_page');
      if(log_func_show.length> 0 ) {
        TableDOM.parse_data('#type_table_hist', log_func_show, 1);
        NavDOM.pgList_init('#type_hist_page', log_func_show, '#type_table_hist');
        TableDOM.parse_onclick('#type_table_hist',  log_func_show, 'data-group','type_hist_page');
        NavDOM.pgList_active('type_hist_page');
      }
    }
    event.target.disabled = false;
    DOM.add_class('#load',"hidden");
    return;
  }

  // click search for detail
  //----------------------------------------------
  if(event.target.id === 'search_detail') {
    event.target.disabled = true;
    let src = document.getElementById('input__detail');
    let valid = src.checkValidity();
    if(!valid) {
      src.reportValidity();
      event.target.disabled = false;
        return;
    }
    DOM.rmv_class('#load',"hidden");
    TableDOM.clear('#dtl_hist_table');
    if(src.value === '') {
      event.target.disabled = false;
      DOM.add_class('#load',"hidden");
      return;
    }
    const value = src.value;
    const splt = value.split('--')
    if(detail.find(obj=>obj.item_jig === splt[0]) === undefined) {
      let data = await api_access('fetch','master_data_sb3',{item_jig: splt[0]});
      data.forEach(dt=>{
        detail.push(dt);
      })
    }
    if(log_detail.find(obj=>obj.item_jig === splt[0]) === undefined) {
      let data = await api_access('fetch','master_log_sb3',{item_jig: splt[0]});
      data.forEach(dt=>{
        log_detail.push(dt);
      })
    }
    detail_show = detail.filter(obj=>obj.item_jig === splt[0]);
    log_detail_show = log_detail.filter(obj=>obj.item_jig === splt[0]);
    log_detail_show.sort((a,b)=>{
      if (a.trans_date !== b.trans_date) return b.trans_date.localeCompare(a.trans_date);
    })
    console.log({detail, log_detail, detail_show, log_detail_show});
    if(detail_show.length > 0 ) {
      InputDOM.form_parse_data('#detail_form', detail_show);
      if(log_detail_show.length> 0 ) {
        TableDOM.parse_data('#dtl_hist_table', log_detail_show, 1);
        NavDOM.pgList_init('#detail_hist_page', log_detail_show, '#dtl_hist_table');
        TableDOM.parse_onclick('#dtl_hist_table',  log_detail_show, 'data-group','detail_hist_page');
        NavDOM.pgList_active('detail_hist_page');
      }
    }
    event.target.disabled = false;
    DOM.add_class('#load',"hidden");
    return;
  }
})

//----------------------------------------------
// automate data change
//----------------------------------------------
document.addEventListener('change', function(event) {
  // calculate qty OH change
  if(event.target.getAttribute('name') === 'qty_change' || event.target.getAttribute('name') === 'addSub') {
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const qty_curr = tr.querySelector('[name ="qty_per_unit"]');
    const qty_change = tr.querySelector('[name ="qty_change"]');
    const addSub = tr.querySelector('[name ="addSub"]');
    let qty_current = Number.isNaN(parseInt(qty_curr.getAttribute('data-current'))) ? 0 :parseInt(qty_curr.getAttribute('data-current'));
    let qty_chng = Number.isNaN(parseInt(qty_change.value)) ? 0 : parseInt(qty_change.value);
    let qty_new = qty_current;
    if(addSub.value === 'tambah') {
      qty_new += qty_chng;
    } 
    if(addSub.value === 'kurang') {
      qty_new -= qty_chng;
    } 
    qty_curr.value = qty_new;
    let label = tr.querySelector(`[for = "${qty_curr.id}"]`);
    label.textContent = qty_new;
    const tgl = tr.querySelector('[name="trans_date"]');
    tgl.value = currentDate("-");
    return;
  }

  // code and no urut
  if(event.target.getAttribute('name') === 'code') {
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const urut = event.target.value.split('--');
    const new_urut = parseInt(urut[1]);
    const urut_node = tr.querySelector('[name="urut"]');
    urut_node.value = new_urut;
    return;
  } 

  // code and no urut
  if(event.target.hasAttribute('name')) {
    const div = event.target.closest('div');
    const form = div.closest('form');
    console.log(form);
    if(form !== null && form.id === 'detail_form') {
      const date = form.querySelector('#trans_date');
      date.value =currentDate('-');
    }
    return;
  } 
})

//----------------------------------------------
// focusout 
//----------------------------------------------
document.addEventListener('focusout', function(event){
  if(event.target.hasAttribute('name') && event.target.getAttribute('name') === 'code') {
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const tbl = tr.closest('table');
    const all_tr = tbl.querySelectorAll('input[name="code"]');
    let valid = true;
    for(let i=0; i<all_tr.length; i++) {
      if(!all_tr[i].id.includes('new')) {
        if(all_tr[i].value === event.target.value) {
          valid = false;
          break;
        }
      }
    }
    if(!valid) {
      event.target.setCustomValidity("Code sudah ada");
      td.click();
      event.target.reportValidity();
      return;
    } else {
      event.target.setCustomValidity("");
      event.target.reportValidity();
      return;
    }
  }

  if(event.target.hasAttribute('name') && event.target.getAttribute('name') === 'item_jig' && event.target.hasAttribute('list')) {
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const tbl = tr.closest('table');
    if(tbl.id === 'type_table') {
      const val = event.target.value;
      const splt = val.split('--');
      event.target.value = splt[0];
      const lbl = td.querySelector('label');
      lbl.textContent = splt[0];
      const stat = tr.querySelector('[name="status"]');
      stat.value = 'active';
      const lbl_stat = tr.querySelector(`[for="${stat.id}"]`);
      lbl_stat.textContent = 'active';
    }
  }
})


// submit button to insert and update data 
//----------------------------------------------
ButtonDOM.submit_dataset_and_log_table('#submit_stock[data-method ="submit"]', '#stock_table', ['jig_loc', 'log_loc']);
ButtonDOM.submit_dataset_and_log_table('#submit_type[data-method ="submit"]', '#type_table', ['jig_func', 'log_func']);
ButtonDOM.submit_dataset_and_log_form('#submit_detail[data-method ="submit"]', '#detail_form', ['jig_mstr', 'log_mstr']);

})