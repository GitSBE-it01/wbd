import { currentDate} from "../../3.utility/index.js";
import {api_access, DOM} from '../../3.utility/index.js';

DOM.active_link('');
let main_data = [];
let outer_data = [];
let form_data = [];
let show_form = [];
let remark = [];
let page = 1;
let sbmt_dt = [];
let temp_dt = {};
const today = currentDate("-"); 
let counter = 0;

const master = await api_access('get','vjs_alat', '');
console.log({master});
let master_filter =[];
DOM.dtList_parse_opt("#alat_list","/",master,"sn_id","new_subcat","no_asset","_desc");
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + " - " + user_detail['jabatan']+' - '+ user_detail['grade']; // user_input atau approval_by
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
  DOM.table_insert_row('#table_index', counter);
  counter++;
  return;
}
/* ---------------------------------------------------------
  close and open form div
--------------------------------------------------------- */
  if(event.target.id === 'close_form_btn'){
    form_div.classList.toggle('hidden');
    const open = document.querySelectorAll('[data-method]');
    open.forEach(dt=>{
      if(dt.disabled === true) {
        dt.disabled = false;
      }
      if(dt.classList.contains('opacity-25')) {
        dt.classList.toggle('opacity-25');
      }
    })
    const row = table_form.querySelectorAll(`[data-value]`);
    row.forEach(dt=>{
      if(!dt.classList.contains('hidden')) {
        dt.classList.add("hidden");
      }
      dt.removeAttribute('data-value');
      if(dt.hasAttribute('data-change')) {
        dt.removeAttribute('data-change');
      }
      const data = dt.querySelectorAll("[name]");
      data.forEach(d=>{
        if (d.tagName === "TEXTAREA" || d.type === "text") {
          d.value = '';
        }
        if (d.type === "hidden") {
          d.value = '';
        }
      })
      const data2 = dt.querySelectorAll("[data-logic]");
      data2.forEach(d=>{
        if(d.classList.contains('bg-green-400')) {d.classList.toggle('bg-green-400');}
        if(d.classList.contains('bg-red-400')) {d.classList.toggle('bg-red-400');}
        if(d.classList.contains('cross')) {d.classList.toggle('cross');d.classList.toggle('minus');}
        if(d.classList.contains('check')) {d.classList.toggle('check');d.classList.toggle('minus');}
      })
    })
    const remark = table_form.querySelector('[data-id="remark"]');
    if(remark.hasAttribute('data-change')) {
      remark.removeAttribute('data-change');
    }
    return;
  }



/* ---------------------------------------------------------
  submit form 
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

/* ---------------------------------------------------------
  ganti value utk opsi ok ng dari table result di form hidden
--------------------------------------------------------- */
  if (event.target.hasAttribute('data-logic')) {
    const td = event.target.closest('td');
    const input = td.querySelector('input[name="result"]');
    const span = td.querySelector('[data-logic ="result"]');
    const val = event.target.getAttribute('data-logic');
    const ok = td.querySelector('[data-logic="OK"]');
    const ng = td.querySelector('[data-logic="NG"]');
    if(event.target.getAttribute('data-logic').toLowerCase() !== input.getAttribute('data-old').toLowerCase()) {
      const tr = event.target.closest('tr');
      if(!tr.hasAttribute('data-change') || tr.getAttribute('data-change') !== 'new') {
        tr.setAttribute('data-change', 'change');
      }
    }
    if(input.value.toLowerCase() === val.toLowerCase()){
      span.setAttribute('class', 'w-14 h-14 minus');
      if(ok.classList.contains('bg-green-400')) {ok.classList.toggle('bg-green-400');}
      if(ng.classList.contains('bg-red-400')) {ng.classList.toggle('bg-red-400');}
      input.value = '';
      return;
    }
    if(input.value.toLowerCase() !== val.toLowerCase()) {
      input.value = val;
      if(val === 'OK') {
        if(!ok.classList.contains('bg-green-400')) {ok.classList.toggle('bg-green-400');}
        if(ng.classList.contains('bg-red-400')) {ng.classList.toggle('bg-red-400');}
        span.setAttribute('class', 'w-14 h-14 check');
      }        
      if(val === 'NG') {
        if(ok.classList.contains('bg-green-400')) {ok.classList.toggle('bg-green-400');}
        if(!ng.classList.contains('bg-red-400')) {ng.classList.toggle('bg-red-400');}
        span.setAttribute('class', 'w-14 h-14 cross');
      }   
      return;
    }
  }

/* ---------------------------------------------------------
  show hidden div yg berisi form detail data 
--------------------------------------------------------- */
  if (event.target.getAttribute('data-method') === "open") {
    const btn_sbmt = document.querySelector('#submit_form_btn');
    btn_sbmt.disabled = true;
    btn_sbmt.classList.toggle('hover:font-semibold');
    btn_sbmt.classList.toggle('text-slate-200');
    btn_sbmt.classList.toggle('hover:bg-gray-200');
    if(form_div.classList.contains('hidden')){
      form_div.classList.toggle('hidden');
    }
    load.classList.toggle("hidden");
    event.target.disabled = true;
    event.target.classList.toggle('opacity-25');
    const search_id = event.target.getAttribute('data-button');
    if(search_id !== 'new') {
      form_data = await api_access('fetch','vjs_log', {data_group: search_id});
    } else {
      let temp_form_dt = await api_access('fetch','vjs_point', {new_cat: label_cat.value});
      form_data = [];
      temp_form_dt.forEach(dt=>{
        const data = {
          approval_by: '',
          category: main_data[0].category,
          check_point: dt.check_point,
          data_group: currentDate('')+main_data[0].sn_id,
          decision: 1,
          eff_date: currentDate('-'),
          no_asset: main_data[0].no_asset,
          result: "OK",
          sn_id: main_data[0].sn_id,
          standard: dt.standard,
          user_input: user
        }
        form_data.push(data);
      })
    }
    const tr_ = event.target.closest('tr');
    const date_cek = tr_.querySelector('input[type="date"]').value;
    label_form.textContent = "VJS Detail tgl "+date_cek;
    show_form = form_data.filter(obj=>obj.check_point !== 'remark');
    remark = form_data.filter(obj=>obj.check_point === 'remark');

    show_form.sort((a,b) => {
      if (a.check_point !== b.check_point)
        return a.check_point.localeCompare(b.check_point);
    });
    for (let i=0; i<show_form.length; i++){
      const row = table_form.querySelector(`[data-id='${i}']`);
      if(event.target.getAttribute('data-button') === 'new') {
        row.setAttribute('data-change', 'new');
      }
      if (row.classList.contains("hidden")) {
        row.classList.toggle("hidden");
      }

      row.setAttribute("data-value", i);
      const data = row.querySelectorAll("[name]");
      data.forEach(d=>{
        if (d.tagName === "TEXTAREA" || d.type === "text") {
          d.value = show_form[i][`${d.getAttribute("name")}`];
        }
        if (d.type === "hidden") {
          d.value = show_form[i][`${d.getAttribute("name")}`];
          d.setAttribute('data-old', d.value);
        }
        if(d.getAttribute('name') === 'result') {
          if(event.target.getAttribute('data-button') === 'new') {
              d.value = 'OK';
            }
          temp_logic = d.value; 
        }
      })
      //----------------------------------
      // styling warna dan perubahan icon
      if (temp_logic === 'OK') {
        const ok = row.querySelector('[data-logic = "OK"]');
        if(!ok.classList.contains('bg-green-400')) {
          ok.classList.toggle('bg-green-400');
        }
        const result = row.querySelector('[data-logic = "result"]');
        if(!result.classList.contains('check')) {
          result.classList.toggle('check');
          result.classList.remove('minus');
        }
      }
      if (temp_logic === 'NG') {
        const ng = row.querySelector('[data-logic = "NG"]');
        if(!ng.classList.contains('bg-red-400')) {
          ng.classList.toggle('bg-red-400');
        }
        const result = row.querySelector('[data-logic = "result"]');
        if(!result.classList.contains('cross')) {
          result.classList.toggle('cross');
          result.classList.remove('minus');
        }
      }
    }
    //----------------------------------
    // remark row only 
    const row_remark = table_form.querySelector(`[data-id="remark"]`);
    if (row_remark.classList.contains("hidden")) {
      row_remark.classList.toggle("hidden");
    }
    if(event.target.getAttribute('data-button') === 'new') {
      row_remark.setAttribute('data-change', 'new');
    }
    const data_remark = row_remark.querySelectorAll("[name]");
      data_remark.forEach(d=>{
        if (d.tagName === "TEXTAREA" || d.type === "text") {
          d.value = remark[0][`${d.getAttribute("name")}`];
        }
        if (d.type === "hidden") {
          d.value = remark[0][`${d.getAttribute("name")}`];
          temp_logic = remark[0][`${d.getAttribute("name")}`];
        }
      })
    load.classList.toggle("hidden");
    btn_sbmt.disabled = false;
    btn_sbmt.classList.toggle('hover:font-semibold');
    btn_sbmt.classList.toggle('text-slate-200');
    btn_sbmt.classList.toggle('hover:bg-gray-200');
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
    if (!DOM.add_class('#input__alat_search',"hidden")) {
      DOM.rmv_class('#input__alat_search',"hidden");
    }
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

/* ---------------------------------------------------------
penanda utk perubahan di kolom remark
--------------------------------------------------------- */
  if(event.target.getAttribute('data-add_row') === 'remark') {
    const tr = event.target.closest('tr')
    if(!tr.hasAttribute('data-change')) {
      tr.setAttribute('data-change', 'change')
    }
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
})

/* ===============================================================================
  change add even listener
=============================================================================== */
document.addEventListener("blur", async function (event) {

})
