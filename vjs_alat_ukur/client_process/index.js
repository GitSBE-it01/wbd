import { currentDate} from "../../3.utility/index.js";
import {api_access, DOM} from '../../3.utility/index.js';

DOM.active_link('');
let main_data = [];
let outer_data = [];
let detail_data = [];
let show_form = [];
let remark_data = [];
let page = 1;
let sbmt_dt = [];
let temp_dt = {};
const today = currentDate("-"); 
let counter = 0;

const user_list = await api_access('get','user','');
const loc_list = await api_access('get','vjs_loc','');
const master = await api_access('get','vjs_alat', '');
console.log({master});
let master_filter =[];
DOM.dtList_parse_opt("#alat_list","/",master,"sn_id","new_subcat","no_asset","_desc");
DOM.dtList_parse_opt("#user_list","-",user_list,"Name","Position","Grade");
DOM.dtList_parse_opt("#loc_list","-",loc_list,"location");
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");


/* ===============================================================================
  click add even listener
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
    const tr_new = table.querySelector(`[data-id ="new__${counter}"]`);
    const td = tr_new.querySelectorAll('td');
    td.forEach(dt=>{
      if(dt.getAttribute('data-field') === 'eff_date') {
        const input = dt.querySelector('INPUT');
        input.setAttribute('value',today);
        const label = dt.querySelector('label');
        label.textContent = today;
      }
      if(dt.getAttribute('data-field') === 'user_input') {
        const input = dt.querySelector('INPUT');
        input.setAttribute('value',user);
        const label = dt.querySelector('label');
        label.textContent = user;
      }
    })
    counter++;
  }
  return;
}

/* show input in table main
--------------------------------------------------------- */
if (event.target.hasAttribute('data-field')) {
  let id = '';
  if(event.target.tagName === 'TD') {
    if(event.target.querySelector(`INPUT`)) {
      const inp = event.target.querySelector(`INPUT`);
      id = inp.id;
    }
    if(event.target.querySelector(`SELECT`)) {
      const inp = event.target.querySelector(`SELECT`);
      id = inp.id;
    }
  } 
  if(event.target.tagName === 'LABEL') {
    id = event.target.getAttribute('for');
  }
  let input = document.querySelector(`#${id}`);
  if (!DOM.add_class(`#${id}`,"hidden") && !input.disabled) {
    DOM.rmv_class(`#${id}`,"hidden");
    DOM.add_class(`[for="${id}"]`, 'hidden');
    input.focus();
  }
  if(input.disabled) {
    input.setCustomValidity("Data tidak bisa di rubah");
    input.reportValidity();
    input.setCustomValidity("");
  }
  return;
}

/* show hidden div yg berisi form detail data 
--------------------------------------------------------- */
if (event.target.getAttribute('data-method') === "open") {
  DOM.rmv_class('#load',"hidden");
  DOM.set_attr(`#${event.target.id}`, 'disabled',true);
  if(!DOM.add_class('[data-card="detail"]','hidden')) {
    DOM.rmv_class('[data-card="detail"]','hidden')
  }
  const tr = event.target.closest('tr');
  if(tr.getAttribute('data-id').includes('new_')) {
    show_form = await api_access('fetch', 'vjs_point', {new_cat:master_filter.new_subcat});
    detail_data = show_form.filter(obj=>obj.check_point !=='remark');
    console.log(detail_data);
    DOM.table_parse_data('#detail_table', detail_data, 1);
    remark_data = show_form.filter(obj=>obj.check_point ==='remark');
    DOM.table_parse_data('#add_table', remark_data, 1);
  } else {
    const fltr = tr.querySelector('[name="data_group"]').value;
    detail_data = main_data.filter(obj=>obj.data_group === fltr && obj.check_point !=='remark');
    DOM.table_parse_data('#detail_table', detail_data, 1);
    remark_data = main_data.filter(obj=>obj.data_group === fltr && obj.check_point ==='remark');
    DOM.table_parse_data('#add_table', remark_data, 1);
  }
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
    if(!DOM.rmv_class('[data-card="detail"]','hidden')) {
      DOM.add_class('[data-card="detail"]','hidden')
    }
    DOM.table_clear('#detail_table');
    DOM.table_clear('#add_table');
    DOM.add_class('#load',"hidden");
    return;
  }

/* submit form 
--------------------------------------------------------- */
  if (event.target.id === "submit_form_btn") {
    load.classList.toggle('hidden');
    const btn_sbmt = event.target;
    btn_sbmt.disabled = true;
    btn_sbmt.classList.toggle('hover:font-semibold');
    btn_sbmt.classList.toggle('text-slate-200');
    btn_sbmt.classList.toggle('hover:bg-gray-200');

    const form = document.querySelector('#submit_form');
    const tr = form.querySelectorAll('tr');
    tr.forEach(dt=>{
      if(dt.getAttribute('data-id') === 'remark' && !dt.hasAttribute('data-change')) {
        const tarea = dt.querySelector('textarea');
        tarea.disabled = true;
      }
      if(dt.hasAttribute('data-change')) {
        const disbld = dt.querySelectorAll(':disabled');
        disbld.forEach(d=>{
          d.disabled = false;
        })
      }
    })
    const formData = new FormData(form);
    sbmt_dt = [];
    for (const pair of formData.entries()) {
      temp_dt[pair[0]] = pair[1];
      if(pair[0] === 'approval_by') {
        sbmt_dt.push(temp_dt);
        temp_dt = {};
      }
    }

    let method = '';
    tr.forEach(dt=>{
      if(dt.getAttribute('data-id') === 'remark' && !dt.hasAttribute('data-change')) {
        const tarea = dt.querySelector('textarea');
        tarea.disabled = false;
      }
      if(dt.hasAttribute('data-change')) {
        method = dt.getAttribute('data-change')
        const disbld = dt.querySelectorAll(':disabled');
        disbld.forEach(d=>{
          d.disabled = true;
        })
      }
    })

    let result_submit = '';
    if(method === 'new') {
      result_submit = await api_access('insert', 'vjs_log', sbmt_dt);
      console.log(result_submit);
    } else {
      result_submit = await api_access('update', 'vjs_log', sbmt_dt);
    }
    const close = document.querySelector('#close_form_btn');
    if(result_submit.includes('fail')) {
      btn_sbmt.disabled = false;
      btn_sbmt.classList.toggle('hover:font-semibold');
      btn_sbmt.classList.toggle('text-slate-200');
      btn_sbmt.classList.toggle('hover:bg-gray-200');
      load.classList.toggle('hidden');
      alert('data failed to processed');
    } else {
      btn_sbmt.disabled = false;
      btn_sbmt.classList.toggle('hover:font-semibold');
      btn_sbmt.classList.toggle('text-slate-200');
      btn_sbmt.classList.toggle('hover:bg-gray-200');
      load.classList.toggle('hidden');
      alert('data successfully processed');
      close.click();
    }
    return;
  }

});

/* ===============================================================================
  change add even listener
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
    main_data = [];
    main_data = await api_access('fetch','vjs_log', {sn_id: master_filter.sn_id});
    outer_data = [];
    let cek = [];
    main_data.forEach(dt=>{
      if(!cek.includes(dt.eff_date)){
        cek.push(dt.eff_date);
        outer_data.push(dt);
      }
    })

    if(DOM.rmv_attr('#new__data','disabled')) {
      DOM.rmv_attr('#new__data','disabled');
      if (!DOM.add_class('#new__data',"opacity-50")) {
        DOM.rmv_class('#new__data',"opacity-50");
      }
    }
    DOM.pgList_init('#main_page', outer_data, '#table_index');
    DOM.table_parse_data('#table_index', outer_data, page);
    DOM.add_class('#load',"hidden");
    return;
  }
/* auto pick first option in datalist
--------------------------------------------------------- */
  if (event.target.hasAttribute('name') && event.target.hasAttribute('list') ) {
    const id = event.target.id;
    DOM.label_parse_value(`[for="${id}"]`, event.target.value);
    event.target.blur();
    return;
  }
/* approval input
--------------------------------------------------------- */
  if (event.target.hasAttribute('name') && event.target.tagName === 'SELECT' ) {
    const id = event.target.id;
    const opt = event.target.querySelectorAll('option');
    console.log(opt);
    let val = '';
    for(let i=0; i<opt.length; i++) {
      if(opt[i].selected === true) {
        val = opt[i].value;
        break;
      }
    }
    DOM.label_parse_value(`[for="${id}"]`, val);
    event.target.blur();
    return;
  }
})

/* ===============================================================================
  change add even listener
=============================================================================== */
document.addEventListener("keydown", async function (event) {
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
  focus out add even listener
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
