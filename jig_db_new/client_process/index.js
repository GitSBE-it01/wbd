import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';
import {data_switch} from './general.js';

/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const role = user_detail.role;
console.log(role);

// get data from database
// -------------------------------------------------------
const loc = await api_access('get','jig_loc','');
const master = await api_access('get','jig_mstr','');
let dtl_loc_show = [];
let item =  await api_access('get','qad_item','');;
let func = [];
let func_show = [];
let dtl_func = [];
let fltr = '';
let dtl_func_show = [];

// accumulation of data qty 
// -------------------------------------------------------
let loc_sum = [];
loc.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
    let qty__unit = 0;
    if(role === 'user') {
      qty__unit = Math.floor(parseInt(dt.qty_per_unit) * (1-dt.toleransi/100));
    } else {
      qty__unit = parseInt(dt.qty_per_unit);
    }
    if(loc_sum[`${dt.item_jig}`]) {
      loc_sum[`${dt.item_jig}`]['qty_total'] += qty__unit;
    } else {
      let data = {
        ...dt,
        qty_total: qty__unit
      };
      loc_sum[`${dt.item_jig}`] = data; 
    }
})

// process data master for qty total
// -------------------------------------------------------
master.forEach(dt=>{
    const keys = Object.keys(dt)
    let filter = '';
    keys.forEach(d2=>{
        filter += dt[d2] + '____';
    })
    dt['filter'] = filter;
    dt['qty_oh'] = loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`]['qty_total'] : 0;
})
let mstr_show = master;
console.log({master, mstr_show});

// parsing data to table
// -------------------------------------------------------
TableDOM.parse_data('#jig_table', mstr_show, 1);
NavDOM.pgList_init('#jig_page', mstr_show, '#jig_table');
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
NavDOM.pgList_active('jig_page');
TableDOM.parse_onclick('#jig_table',  mstr_show, 'data-group','jig_page');
DOM.add_class('#load',"hidden");


/* ====================================================================
  custom function and event
==================================================================== */
// click switch to change page (show hide and hide current display)
//----------------------------------------------
let code_array = [
  'jig',
  'type',
]
let target_array = [
  'switch',
  'div_search',
  'table',
  'page_div'
]
let code_array2 = [
  'detail_loc',
  'detail_type',
]
let target_array2 = [
  'switch',
  'jig',
  'jig_page'
]
document.addEventListener('click', async function(event) {
  // click switch to change page (show hide and hide current display)
//----------------------------------------------
  if(event.target.id === 'jig_switch') {
    data_switch('jig', code_array, target_array); 
    return;
  }

  if(event.target.id === 'detail_loc_switch') {
    data_switch('detail_loc', code_array2, target_array2); 
    return;
  }

  if(event.target.id === 'detail_type_switch') {
    DOM.rmv_class('.loading2',"hidden");
    DOM.add_class('.loading2',"z-40");
    DOM.add_class('#loadscreen',"z-40");
    data_switch('detail_type', code_array2, target_array2);
    if(func.length === 0) {
      const cek = dtl_func.find(obj=>obj.item_jig === fltr);
      if(cek === undefined){
        let dtl_func_data = await api_access('fetch','jig_func', {item_jig: fltr});
        dtl_func_data.forEach(dt=>{
          dtl_func.push(dt);
        });
      }
      dtl_func.forEach(dt=>{
        const desc = item.find(obj=>obj.pt_part === dt.item_type);
        const desc1 = desc ? desc.pt_desc1 :'';
        const desc2 = desc ? desc.pt_desc2 :'';
        dt['_desc'] = desc1 + " " + desc2;
        dt['status_spk'] = desc ? desc.pt_status : "";
      })
      dtl_func_show = dtl_func.filter(obj=>obj.item_jig === fltr);
    } else {
      dtl_func_show = func.filter(obj=>obj.item_jig === fltr);
    }
    console.log({dtl_func_show});
    TableDOM.parse_data('#detail_type_jig', dtl_func_show, 1);
    NavDOM.pgList_init('#detail_type_jig_page', dtl_func_show, '#detail_type_jig');
    NavDOM.pgList_active('detail_type_jig_page');
    TableDOM.parse_onclick('#detail_type_jig',  dtl_func_show, 'data-group','detail_type_jig_page');
    DOM.rmv_class('#load', 'hidden');
    DOM.add_class('.loading2',"hidden");
    DOM.rmv_class('.loading2',"z-40");
    DOM.rmv_class('#loadscreen',"z-40");
    return;
  }

// click switch to change page (show hide and hide current display)
//----------------------------------------------
  if(event.target.id === 'type_switch') {
    DOM.rmv_class('#load', 'hidden');
    data_switch('type', code_array, target_array); 
    if(func.length === 0){
      func = await api_access('get','jig_func','');
      func.forEach(dt=>{
        const desc = item.find(obj=>obj.pt_part === dt.item_type);
        const desc1 = desc ? desc.pt_desc1 :'';
        const desc2 = desc ? desc.pt_desc2 :'';
        dt['_desc'] = desc1 + " " + desc2;
        dt['status_spk'] = desc ? desc.pt_status : "";
        const jig = master.find(obj=>obj.item_jig === dt.item_jig);
        dt['desc_jig'] = jig ? jig.desc_jig : '';
        dt['qty_oh'] = loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`]['qty_total'] : 0;
        const keys = Object.keys(dt)
        let filter = '';
        keys.forEach(d2=>{
            filter += dt[d2] + '____';
        })
        dt['filter'] = filter;
      })
      func_show = func;
    }
    TableDOM.parse_data('#type_table', func_show, 1);
    NavDOM.pgList_init('#type_page', func_show, '#type_table');
    NavDOM.pgList_active('type_page');
    TableDOM.parse_onclick('#type_table',  dtl_func_show, 'data-group','type_page');
    DOM.add_class('#load', 'hidden');
    return;
  }

  if(event.target.getAttribute('data-method') === 'detail') {
    DOM.rmv_class('#load',"hidden");
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const filter = tr.querySelector('[name="item_jig"]');
    const trgt = document.querySelector('[data-card="detail"]');
    DOM.rmv_class(trgt, 'hidden');
    fltr = filter.getAttribute('data-current');
    trgt.setAttribute('data-jig_detail', fltr);
    dtl_loc_show = [];
    dtl_loc_show = loc.filter(obj=> obj.item_jig === fltr);
    console.log(dtl_loc_show)
    TableDOM.parse_data('#detail_loc_jig', dtl_loc_show, 1);
    NavDOM.pgList_init('#detail_loc_jig_page', dtl_loc_show, '#detail_loc_jig');
    DOM.rmv_class('#load',"z-40");
    DOM.add_class('#loadscreen',"z-10");
    DOM.add_class('.loading2',"hidden");
    return;
  }

  if(event.target.id === 'close_detail') {
    TableDOM.clear('#detail_loc_jig');
    TableDOM.clear('#detail_type_jig');
    DOM.rmv_class('#loadscreen',"z-10");
    DOM.rmv_class('.loading2',"hidden");
    DOM.add_class('#load',"z-40");
    DOM.add_class('[data-card="detail"]',"hidden");
    data_switch('detail_loc', code_array2, target_array2); 
    DOM.add_class('#load',"hidden");
    return;
  }

})

// search and parsing pagination
//----------------------------------------------
document.addEventListener('click', async function(event) {
  if(event.target.id === 'search_jig') {
    mstr_show = GeneralDOM.filter_data_table(master, 'input__jig');
    TableDOM.parse_data('#jig_table', mstr_show, 1);
    NavDOM.pgList_init('#jig_page', mstr_show, '#jig_table');
    await TableDOM.parse_onclick('#jig_table', mstr_show, 'data-group', 'jig_page');
    return;
  }

  if(event.target.id === 'search_type') {
    func_show = GeneralDOM.filter_data_table(func, 'input__type');
    TableDOM.parse_data('#type_table', func_show, 1);
    NavDOM.pgList_init('#type_page', func_show, '#type_table');
    await TableDOM.parse_onclick('#type_table', func_show, 'data-group', 'type_page');
    return;
  }

})
ButtonDOM.enter_keydown('#search_type', '#input__type');
ButtonDOM.enter_keydown('#search_jig', '#input__jig');
