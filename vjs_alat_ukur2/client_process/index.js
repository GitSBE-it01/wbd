import { master, point, vjs_log } from "./general.js";
import { currentDate, dtlist, inputEmptyRow,activeLink } from "../../3.utility/index.js";

/*
master : master alat


point: master point 


vjs_log : detail input data
  sn_id             : dari input search pertama 
  category          : dari input search pertama 
  no_asset          : dari input search pertama 
  check_point       : ketika buka vjs utk hari baru
  standard          : ketika buka vjs utk hari baru
  eff_date          : hasil user input
  result            : hasil user input
  data_group        : sama dengan check point
  user_input        : ambil dari user 
  decision          : summary user input
  approval_by       : user input
*/

console.log(master);
activeLink('');
const body = document.querySelector("body");
const load = body.querySelector(".loading");
let main_data = [];
let show_data = [];
let form_data = [];
let show_form = [];
let remark = [];
let temp_logic ='';
let n_numb = 1;
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + " - " + user_detail['jabatan']+' - '+ user_detail['grade']; // user_input atau approval_by
const today = currentDate("-"); 
let counter = 0;
const label_desc = document.querySelector("#desc_alat");
const label_cat = document.querySelector("#cat"); // category
const serial_id = document.querySelector("#seri"); //sn_id
const label_asset = document.querySelector("#asset"); // no_asset
const label_form = document.querySelector("[data-title='form_title']");

const table_base = document.querySelector("#table_index");
const tbody_base = table_base.querySelector('tbody');
const table_form = document.querySelector('#table_form_main')
const form_div = document.querySelector('[data-card ="form"]');

// const alat_detail = await master.dbProcess("get", "");
dtlist("#alat_list","/",alat_detail,"sn_id","new_subcat","no_asset","_desc");
load.classList.toggle("hidden");

document.addEventListener("click", async function (event) {
  // close form field and disabled
  if(event.target.id === 'close_form'){
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
      const data = dt.querySelectorAll("[name]");
      data.forEach(d=>{
        if (d.tagName === "TEXTAREA" || d.type === "text") {
          d.value = '';
        }
        if (d.type === "hidden") {
          d.value = '';
        }
      })
    })
    return;
  }

  // insert new line 
  if (event.target.id === "new__data") {
    const data_array = [
      {type:'date', field: 'eff_date', def_value:today}, 
      {type:'input', field:'user_input', def_value:user},
      {type:'input', field: 'approval_by'},
      {type:'btnSet', field: 'data_group', btn_style:'w-6 h-6 border-0', set:'open:arrow_right_black', def_value:'new' },
    ]
    tbody_base.insertBefore(await inputEmptyRow('',counter, data_array),tbody_base.childNodes[1]);
    counter++;
    return;
  }

  // open input search field
  if (event.target.id === "open_dtlist") {
    const inp = document.querySelector('[data-input ="input__alat_search"]');
    inp.classList.toggle("hidden");
    return;
  }

  // open input search field
  if (event.target.id === "submit_form") {
    const form = document.querySelector('#submit_form');
    const formData = new FormData(form);
    const point = formData.getAll('check_point');
    const std = formData.getAll('standard');
    const rslt = formData.getAll('result');
    let dt_input =
    point.forEach(dt=>{
      console.log(dt);
    })
    return;
  }

  // change logic value
  if (event.target.hasAttribute('data-logic')) {
    const td = event.target.closest('td');
    const input = td.querySelector('input[name="result"]');
    const span = td.querySelector('[data-logic ="result"]');
    const val = event.target.getAttribute('data-logic');
    const ok = td.querySelector('[data-logic="ok"]');
    const ng = td.querySelector('[data-logic="ng"]');
    if(event.target.getAttribute('data-logic').toLowerCase() !== input.getAttribute('data-old').toLowerCase()) {
      console.log('yup');
      const tr = event.target.closest('tr');
      tr.setAttribute('data-change', 'change');
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
      if(val === 'ok') {
        if(!ok.classList.contains('bg-green-400')) {ok.classList.toggle('bg-green-400');}
        if(ng.classList.contains('bg-red-400')) {ng.classList.toggle('bg-red-400');}
        span.setAttribute('class', 'w-14 h-14 check');
      }        
      if(val === 'ng') {
        if(ok.classList.contains('bg-green-400')) {ok.classList.toggle('bg-green-400');}
        if(!ng.classList.contains('bg-red-400')) {ng.classList.toggle('bg-red-400');}
        span.setAttribute('class', 'w-14 h-14 cross');
      } 
      return;
    }
  }

  // open form field
  if (event.target.getAttribute('data-method') === "open") {
    if(form_div.classList.contains('hidden')){
      form_div.classList.toggle('hidden');
    }
    load.classList.toggle("hidden");
    event.target.disabled = true;
    event.target.classList.toggle('opacity-25');
    const search_id = event.target.getAttribute('data-button');
    if(search_id !== 'new') {
      form_data = await vjs_log.dbProcess('fetch', {data_group: search_id});
    } else {
      form_data = await point.dbProcess('fetch', {new_cat: label_cat.value});
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
        row.setAttribute('data-change', 'change');
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
          if(event.target.getAttribute('data-button') === 'new') {
            d.value = 'ok';
          }
          d.setAttribute('data-old', d.value);
          temp_logic = show_form[i][`${d.getAttribute("name")}`];
        }
      })
      if (temp_logic === 'OK') {
        const ok = row.querySelector('[data-logic = "ok"]');
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
        const ng = row.querySelector('[data-logic = "ng"]');
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
    const row = table_form.querySelector(`[data-id="remark"]`);
    if (row.classList.contains("hidden")) {
      row.classList.toggle("hidden");
    }
    const data = row.querySelectorAll("[name]");
      data.forEach(d=>{
        if (d.tagName === "TEXTAREA" || d.type === "text") {
          d.value = remark[0][`${d.getAttribute("name")}`];
        }
        if (d.type === "hidden") {
          d.value = remark[0][`${d.getAttribute("name")}`];
          temp_logic = remark[0][`${d.getAttribute("name")}`];
        }
      })
    load.classList.toggle("hidden");
    return;
  }
});

document.addEventListener("change", async function (event) {
  // search tool input
  if (event.target.getAttribute("data-input") === "input__alat_search") {
    load.classList.toggle("hidden");
    const value = event.target.value;
    const split = value.split("//");
    label_desc.value = split[3] ? split[3].trim() : '';
    label_cat.value = split[1] ? split[1].trim() : '';
    serial_id.value = split[0] ? split[0].trim() : ''; //sn_id
    label_asset.value = split[2] ? split[2].trim() : ''; // no_asset
    event.target.classList.toggle("hidden");

    main_data = [];
    main_data = await vjs_log.dbProcess("fetch", {sn_id: split[0].trim() });
    const hd_row = table_base.querySelector('[data-id="header"]');

    if(main_data.length >0) {
      main_data.sort((a, b) => {
        if (a.eff_date     !== b.eff_date   )
          return b.eff_date   .localeCompare(a.eff_date   );
      });
      let btn = document.querySelector('#new__data');
      btn.classList.toggle('opacity-50');
      btn.disabled = false;
      let check = [];
      main_data.forEach((dt) => {
        if (!check.includes(dt.eff_date   )) {
          check.push(dt.eff_date    );
          show_data.push(dt);
        }
      });
      n_numb = Math.ceil(show_data.length / 100);
      if (show_data.length>0) {
        if (hd_row.classList.contains("hidden")) {
          hd_row.classList.toggle("hidden");
        }
        for (let i = 0; i < show_data.length; i++) {
          if (i === 100) {
            break;
          }
          let n_val = i * n_numb;
          let dt = show_data[n_val];
          const row = table_base.querySelector(`[data-id='${i}']`);
          row.setAttribute("data-value", n_val);
          if (row.classList.contains("hidden")) {
            row.classList.toggle("hidden");
          }
          const data = row.querySelectorAll("[name]");
          data.forEach((d) => {
            if (d.tagName === "TD") {
              d.textContent = dt[`${d.getAttribute("name")}`];
            }
            if (d.tagName === "TEXTAREA" || d.tagName === "INPUT") {
              d.value = dt[`${d.getAttribute("name")}`];
            }
            if (d.tagName === "BUTTON") {
              d.setAttribute('data-button', dt[`${d.getAttribute("name")}`]);
            }
          });
        }
      }
    } else {
      if (!hd_row.classList.contains("hidden")) {
        hd_row.classList.toggle("hidden");
      }
      const row = table_base.querySelectorAll(`[data-id]`);
      row.forEach(dt=>{
        if (!dt.classList.contains("hidden")) {
          dt.classList.toggle("hidden");
        }
      })
    };  
    load.classList.toggle("hidden");
    return;
  }
})
