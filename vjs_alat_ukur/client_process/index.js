import { currentDate,customPeriod, sort_array} from "../../3.utility/index.js";
import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM} from '../../3.utility/index.js';

GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
let hd_data = [];
let log_data = [];
let detail_data = [];
let point_data = [];
let remark_data = [];
let dflt_arr = [];
let page = 1;
const today = currentDate("-"); 
let period = customPeriod(today);
let counter = 0;

const user_list = await api_access('get','user','');
const loc_list = await api_access('get','vjs_loc','');
const master = await api_access('get','vjs_alat', '');
let master_filter =[];
DtlistDOM.parse_opt("#alat_list","/",master,"sn_id","new_subcat","no_asset","_desc");
DtlistDOM.parse_opt("#user_list","-",user_list,"Name","Position","Grade");
DtlistDOM.parse_opt("#loc_list","-",loc_list,"location");
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");


/* ===============================================================================
===============================================================================
  click add even listener
===============================================================================
=============================================================================== */
document.addEventListener("click", async function (event) {
/* show hidden input, hanya ganti display
--------------------------------------------------------- */
if (event.target.id === "open_dtlist") {
  if (!DOM.rmv_class('#input__alat_search',"hidden")) {
    DOM.add_class('#input__alat_search',"hidden");
  }
  return;
}

/* insert new line di table main
--------------------------------------------------------- */
if (event.target.id === "new__data") {
  let inserting = false;
  while(!inserting) {
    inserting = DOM.table_insert_row('#new_main','#table_index', counter);
  }
  if(inserting) {
    const table = document.querySelector('#table_index');
    const tr_new = table.querySelector(`[data-id ="new__#table_index${counter}"]`);
    const td = tr_new.querySelectorAll('[name]');
    dflt_arr = {
      data_group:  currentDate("")+master_filter.sn_id,
      sn_id: master_filter.sn_id ,
      no_asset: master_filter.no_asset,
      eff_date: today,
      period: period,
      category: master_filter.new_subcat,
      user_input: user,
      approval_by: '',
      loc: '',
      decision: '',
    }
    td.forEach(dt=>{
      const key = dt.getAttribute('name');
      if(dflt_arr[key]) {
        dt.value = dflt_arr[key];
      }
      if(document.querySelector(`[for="${dt.id}"]`) !== null) {
        const lbl = document.querySelector(`[for="${dt.id}"]`);
        lbl.textContent = dflt_arr[key];
      }
    })

    counter++;
  }
  return;
}

/* show hidden div yg berisi form detail data 
--------------------------------------------------------- */
if (event.target.getAttribute('data-method') === "open") {
  DOM.rmv_class('#load',"hidden");
  let btn_sbmt = document.querySelector('#submit_form_btn');
  DOM.set_attr(`#${event.target.id}`, 'disabled',true);
  const tr_parent = event.target.closest('tr');
  if(tr_parent.hasAttribute('data-change')) {
    
  }
  if(!DOM.add_class('[data-card="detail"]','hidden')) {
    DOM.rmv_class('[data-card="detail"]','hidden')
  }
  const tr = event.target.closest('tr');
  if(tr.getAttribute('data-id').includes('new_')) {
    await DOM.insert_data(tr, 'vjs_hd');
    btn_sbmt.setAttribute('data-method', 'insert');
    point_data = [];
    point_data = await api_access('fetch', 'vjs_point', {new_cat:master_filter.new_subcat});
    detail_data = point_data.filter(obj=>obj.check_point !=='remark');
    DOM.table_parse_data('#detail_table', detail_data, 1);
    remark_data = point_data.filter(obj=>obj.check_point ==='remark');
    DOM.table_parse_data('#add_table', remark_data, 1);
    const tbl_dtl = document.querySelector('#detail_table');
    const tr_dtl = tbl_dtl.querySelectorAll('tr');
    tr_dtl.forEach(dt=>{
      if(dt.hasAttribute('data-value')) {
        dt.setAttribute('data-change', 'new');
      }
      if(dt.getAttribute('data-id') !== 'header') {
        let dt_group = dt.querySelector('[name = "data_group"]');
        dt_group.value = dflt_arr['data_group'];
        let new_id = dt.querySelector('[name = "id"]');
        new_id.value = '';
      }
    })
    const tbl_add = document.querySelector('#add_table');
    const tr_add = tbl_add.querySelectorAll('tr');
    tr_add.forEach(dt=>{
      if(dt.hasAttribute('data-value')) {
        dt.setAttribute('data-change', 'new');
      }
      if(dt.getAttribute('data-id') !== 'header') {
        let dt_group = dt.querySelector('[name = "data_group"]');
        dt_group.value = dflt_arr['data_group'];
        let new_id = dt.querySelector('[name = "id"]');
        new_id.value = '';
      }
    })

  } else {
    const fltr = tr.querySelector('[name="data_group"]').value;
    btn_sbmt.setAttribute('data-method', 'update');
    log_data = [];
    log_data = await api_access('fetch', 'vjs_log', {data_group:fltr});
    detail_data = log_data.filter(obj=>obj.check_point !=='remark');
    DOM.table_parse_data('#detail_table', detail_data, 1);
    remark_data = log_data.filter(obj=>obj.check_point ==='remark');
    DOM.table_parse_data('#add_table', remark_data, 1);
  }
  const tbl = document.querySelector('#detail_table');
  const select = tbl.querySelectorAll('label[data-field = "result"]');
  select.forEach(dt=>{
    const td = dt.closest('td');
    DOM.rmv_class(td, 'bg-slate-300');
    if(dt.textContent === 'OK') {
      DOM.rmv_class(td, 'bg-red-400');
      DOM.add_class(td, 'bg-green-400');
    }
    if(dt.textContent === 'NG') {
      DOM.add_class(td, 'bg-red-400');
      DOM.rmv_class(td, 'bg-green-400');
    }
    if(dt.textContent === '-' || dt.textContent === '' ) {
      DOM.add_class(td, 'bg-slate-300');
      DOM.rmv_class(td, 'bg-red-400');
      DOM.rmv_class(td, 'bg-green-400');
    }
  })
  DOM.add_class('#load',"hidden");
  return;
}

/* close and open form div
--------------------------------------------------------- */
  if(event.target.id === 'close_form_btn'){
    DOM.rmv_class('#load',"hidden");
    const btn = document.querySelectorAll('[data-method = "open"]');
    btn.forEach(dt=>{
      if(dt.id) {
        DOM.rmv_attr(`#${dt.id}`, 'disabled');
      }
    })
    DOM.add_class('[data-card="detail"]','hidden')
    DOM.table_clear('#detail_table');
    DOM.table_clear('#add_table');
    DOM.add_class('#load',"hidden");
    return;
  }

/* delete data
--------------------------------------------------------- */
  if(event.target.getAttribute('data-method') === 'delete'){
    DOM.rmv_class('#load',"hidden");
    const tr = event.target.closest('tr');
    const result = await DOM.delete_data(tr, 'vjs_hd', 'data_group');
    if(!result.includes('fail')) {
      alert ('data deleted');
      location.reload();
  }
    DOM.add_class('#load',"hidden");
    return;
  }

/* submit form 
--------------------------------------------------------- */
  if (event.target.id === "submit_form_btn") {
    DOM.rmv_class('#load',"hidden");
    const trgt = document.querySelector('[data-card="detail"]');
    if(event.target.getAttribute('data-method') === 'insert') {
      const result = await DOM.insert_dataset_table(trgt, 'vjs_log');
      if(!result.includes('fail')) {
        alert ('data inserted');
        location.reload();
      }
    } else {
      const result = await DOM.update_dataset_table(trgt, 'vjs_log');
      if(!result.includes('fail')) {
        alert ('data updated');
        location.reload();
      }
    }
    DOM.add_class('#load',"hidden");
    return;
  }
});

/* ===============================================================================
===============================================================================
  change add even listener
===============================================================================
=============================================================================== */
document.addEventListener("change", async function (event) {
/* search tool input
--------------------------------------------------------- */
  if (event.target.id === "input__alat_search") {
    const split = event.target.value.split("//");
    master_filter = await master.find(obj=>obj.sn_id === split[0]);

    DOM.form_parse_data('#detail_form', master_filter);
    DOM.rmv_class('#load',"hidden");
    event.target.blur();
    hd_data = [];
    hd_data = await api_access('fetch','vjs_hd', {sn_id: master_filter.sn_id});
    hd_data.sort((a,b) => {
      if (a.data_group !== b.data_group) return b.data_group.localeCompare(a.data_group);
    })
    if(DOM.rmv_attr('#new__data','disabled')) {
      DOM.rmv_attr('#new__data','disabled');
      if (!DOM.add_class('#new__data',"opacity-50")) {
        DOM.rmv_class('#new__data',"opacity-50");
      }
    }
    DOM.pgList_init('#main_page', hd_data, '#table_index');
    DOM.table_parse_data('#table_index', hd_data, page);
    DOM.add_class('#load',"hidden");
    return;
  }
/* auto pick first option in datalist
--------------------------------------------------------- */
  if (event.target.hasAttribute('name') && event.target.tagName === 'INPUT' ) {
    const trgt = event.target;
    const id = event.target.id;
    DOM.label_parse_value(`[for="${id}"]`, event.target.value);
    if(trgt.getAttribute('data-current') !== event.target.value) {
      const tr = trgt.closest('tr');
      if(!tr.hasAttribute('data-change') || tr.getAttribute('data-change') !== 'new') {
        tr.setAttribute('data-change', 'change');
      }
    } else {
      if(tr.hasAttribute('data-change')) {
        tr.removeAttribute('data-change');
      }
    }
    if(trgt.getAttribute('name') === 'eff_date') {
      const tr = trgt.closest('tr');
      const data_gr = tr.querySelector('[name = "data_group"]');
      data_gr.value = event.target.value.replaceAll('-','')+master_filter.sn_id;
    }
    event.target.blur();
    return;
  }
/* approval input
--------------------------------------------------------- */
  if (event.target.hasAttribute('name') && event.target.tagName === 'SELECT' ) {
    const id = event.target.id;
    const trgt = event.target;
    const opt = event.target.querySelectorAll('option');
    let val = '';
    for(let i=0; i<opt.length; i++) {
      if(opt[i].selected === true) {
        val = opt[i].value;
        break;
      }
    }
    const tr = trgt.closest('tr');
    if(trgt.getAttribute('data-current') !== val) {
      if(!tr.hasAttribute('data-change') || tr.getAttribute('data-change') !== 'new') {
        tr.setAttribute('data-change', 'change')
      }
    } else {
      if(tr.hasAttribute('data-change')) {
        tr.removeAttribute('data-change');
      }
    }
    DOM.label_parse_value(`[for="${id}"]`, val);
    const td = event.target.closest('td');
    DOM.rmv_class(td, 'bg-slate-300');
    if(val === 'OK') {
      DOM.rmv_class(td, 'bg-red-400');
      DOM.add_class(td, 'bg-green-400');
    }
    if(val === 'NG') {
      DOM.add_class(td, 'bg-red-400');
      DOM.rmv_class(td, 'bg-green-400');
    }
    if(val === '-') {
      DOM.add_class(td, 'bg-slate-300');
      DOM.rmv_class(td, 'bg-red-400');
      DOM.rmv_class(td, 'bg-green-400');
    }
    event.target.blur();
    return;
  }
})

/* ===============================================================================
===============================================================================
  change add even listener
===============================================================================
=============================================================================== */
document.addEventListener("keydown", async function (event) {
  if(event.target.id === 'input__alat_search' && event.key !== 'Enter') {
    DOM.input_valid('#alat_list', event.target.value, '#input__alat_search');
    event.target.checkValidity(); 
    return;
  }
  if (event.target.id === "input__alat_search" && event.key ==='Enter') {
      DOM.select_first_opt(event.target.value,'#alat_list','#input__alat_search');
      return;
    }
  if (event.target.getAttribute('name') === 'approval_by' && event.key ==='Enter') {
      if(event.target.value !== '') {
        DOM.select_first_opt(event.target.value,'#user_list',`#${event.target.id}`);
      } else {
        event.target.value = '';
        event.target.blur();
      }
      return;
    }
  if (event.target.getAttribute('name') === 'loc' && event.key ==='Enter') {
      if(event.target.value !== '') {
        DOM.select_first_opt(event.target.value,'#loc_list',`#${event.target.id}`);
      } else {
        event.target.value = '';
        event.target.blur();
      }
      return;
    }
})

/* ===============================================================================
===============================================================================
  focus out add even listener
===============================================================================
=============================================================================== */
document.addEventListener("focusout", async function (event) {
  /* general input
--------------------------------------------------------- */
if (event.target.hasAttribute('name')) {
  const id = event.target.id;
  if (!DOM.rmv_class(`#${id}`,"hidden")) {
    DOM.add_class(`#${id}`,"hidden");
    DOM.rmv_class(`[for="${id}"]`, 'hidden');
  }
  return;
}
/* input utama
--------------------------------------------------------- */
if (event.target.id === "input__alat_search") {
  if (!DOM.add_class('#input__alat_search',"hidden")) {
    DOM.rmv_class('#input__alat_search',"hidden");
  }
  return;
}
})
