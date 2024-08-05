import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';
import {data_switch} from './general.js';

/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
const check = window.location.href.split("/");
console.log(check);

// initialize data 
//----------------------------------------------
let counter_row = 0;
let counter_loc = 1;
const ls_loc = await api_access('get','list_loc','');
const master = await api_access('get','jig_mstr','');
const mtnc = await api_access('get','list_mtnc','');
const role_cek = await api_access('fetch','role',{apps:`${check[4]}`});
const item = await api_access('fetch_item__cache','qad_item','');
console.log({ls_loc
    ,master
    ,mtnc
    ,role_cek
    ,item
})

// datalist parsing option
//----------------------------------------------
DtlistDOM.parse_opt("#jig_list","-",master,"item_jig", 'desc_jig');
DtlistDOM.parse_opt("#type_list","-",item,"pt_part", 'pt_desc1', 'pt_desc2');
DtlistDOM.parse_opt("#loc_list","-",ls_loc,"name");
DtlistDOM.parse_opt("#jig_type_list","-",mtnc,"type_jig");

const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");



/* ====================================================================
  custom function and event
==================================================================== */
// click switch to change page (show hide and hide current display)
//----------------------------------------------
let code_array = [
    'jig',
    'speaker',
    'loc',
    'type_jig',
    'user',
  ]
  let target_array = [
    'switch',
    'add',
  ]

  document.addEventListener('click', async function(event) {
    if(event.target.id === 'jig_switch') {
      data_switch('jig', code_array, target_array); 
      return;
    }
    if(event.target.id === 'speaker_switch') {
      data_switch('speaker', code_array, target_array); 
      return;
    }
    if(event.target.id === 'loc_switch') {
      data_switch('loc', code_array, target_array); 
      return;
    }
    if(event.target.id === 'type_jig_switch') {
      data_switch('type_jig', code_array, target_array); 
      return;
    }
    if(event.target.id === 'loc_switch') {
      data_switch('loc', code_array, target_array); 
      return;
    }
  })

// update data qty total 
//----------------------------------------------
document.addEventListener('change', function(event) {
    if(event.target.getAttribute('name') === 'qty_per_unit') {
        const td = event.target.closest('td');
        const tr = td.closest('tr');
        const table = tr.closest('table');
        const target = document.getElementById('qty_total');
        let total = 0;
        if(table.id == 'add_loc_jig_form') {
            const all_dt = table.querySelectorAll('[name="qty_per_unit"]');
            all_dt.forEach(dt=>{
                total += parseInt(dt.value);
            })
        }
        target.value = total;
        return;
    }
    if(event.target.id === 'item_jig') {
      const main_loc = document.querySelector('#add_loc_jig_form');
      const new_loc = document.querySelector('#add_loc_jig_new_form');
      const main_spk = document.querySelector('#add_type_jig_form');
      const new_spk = document.querySelector('#add_type_jig_new_form');
      const row_main_loc = main_loc.querySelectorAll('[name="item_jig"]');
      const row_main_spk = main_spk.querySelectorAll('[name="item_jig"]');
      row_main_loc.forEach(dt=>{
        dt.value = event.target.value;
      })
      row_main_spk.forEach(dt=>{
        dt.value = event.target.value;
      })
      const row_new_loc = new_loc.querySelector('[name="item_jig"]');
      row_new_loc.value = event.target.value;
      const row_new_spk = new_spk.querySelector('[name="item_jig"]');
      row_new_spk.value = event.target.value;
      const code_main_loc = main_loc.querySelectorAll('[name="code"]');
      let cek_count ='';
      code_main_loc.forEach(dt=>{
        if(counter_loc<10) {
          cek_count += '00' + counter_loc;
        } else if(counter_loc<100) {
          cek_count += '0' + counter_loc;
        } else {
          cek_count += counter_loc;
        }
        dt.value = event.target.value + "--" + cek_count;
        counter_loc++;
      })
      const code_new_loc = new_loc.querySelectorAll('[name="code"]');
      code_new_loc.value = event.target.value;
      return;
    }
    if(event.target.id === 'add_loc_row') {
      TableDOM.insert_row('#add_loc_jig_new_form', '#add_loc_jig_form', counter_row);
      const new_tr = document.querySelector(`new__#add_loc_jig_form__${counter_row}`);
      const code = new_tr.querySelector('[name="code"]');
      let cek_count ='';
      dt.value = event.target.value + "--" + cek_count;
      if(counter_loc<10) {
        cek_count += '00' + counter_loc;
      } else if(counter_loc<100) {
        cek_count += '0' + counter_loc;
      } else {
        code.value += +"--"+counter_loc;
      }
      counter_loc++;
      counter_row++;
      const code_main_loc = main_loc.querySelectorAll('[name="code"]');

      const code_new_loc = new_loc.querySelectorAll('[name="code"]');
      code_new_loc.value = event.target.value
    }
})

//----------------------------------------------
// insert row to table
//----------------------------------------------
ButtonDOM.insert_row('#add_loc_row','#add_loc_jig_new_form', '#add_loc_jig_form', counter);
ButtonDOM.insert_row('#add_type_row','#add_type_jig_new_form', '#add_type_jig_form', counter);
ButtonDOM.insert_row('#add_jig_row','#add_new_speaker_type_jig_form', '#add_type_jig_form', counter);

