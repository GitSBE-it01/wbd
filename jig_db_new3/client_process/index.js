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

// get data from database
// -------------------------------------------------------
const loc = await api_access('get','jig_loc','');
const master = await api_access('get','jig_mstr','');
let detail_show = [];
let item = [];
let func = [];

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
    if(loc_sum[`${dt.item_jig}`]) {
      loc_sum[`${dt.item_jig}`]['qty_total'] += parseInt(dt.qty_per_unit)
    } else {
      let data = {
        ...dt,
        qty_total: parseInt(dt.qty_per_unit)
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
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
NavDOM.pgList_active('jig_page');
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
document.addEventListener('click', async function(event) {
  // click switch to change page (show hide and hide current display)
//----------------------------------------------
  if(event.target.id === 'jig_switch') {
    data_switch('jig', code_array, target_array); 
    return;
  }

// click switch to change page (show hide and hide current display)
//----------------------------------------------
  if(event.target.id === 'type_switch') {
    DOM.rmv_class('#load', 'hidden');
    data_switch('type', code_array, target_array); 
    item = await api_access('get','qad_item','');
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
    let func_show = func;
    TableDOM.parse_data('#type_table', func_show, 1);
    NavDOM.pgList_init('#type_page', func_show, '#type_table');
    NavDOM.pgList_active('type_page');
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
    detail_show = [];
    let filter_dt = loc.filter(obj=> obj.item_jig === filter.textContent);
    filter_dt.forEach(dt=>{
      let trans_dt = {};
      const cek = trans.find(obj=>obj.code === dt.code);
      trans_dt.code =  dt.code;
      trans_dt.item_jig =  dt.item_jig;
      trans_dt.lokasi = dt.lokasi;
      trans_dt.qty_per_unit =  dt.qty_per_unit;
      trans_dt.qty = dt.qty_per_unit;
      trans_dt.unit =  dt.unit;
      trans_dt.loc =  '';
      trans_dt.start_date =  currentDate('-');
      trans_dt.end_date =  '';
      trans_dt.status = 'open';
      if(cek !== undefined) {
        trans_dt.start_date =  cek.start_date;
        trans_dt.end_date =  currentDate("-");
        trans_dt.loc = cek.loc;
        trans_dt.id = cek.id;
        trans_dt.qty = cek.qty;
      }
      detail_show.push(trans_dt);
    })
    console.log(detail_show);
    TableDOM.parse_data('#trans_detail_table', detail_show, 1);
    NavDOM.pgList_init('#trans_detail_page', detail_show, '#trans_detail_table');
    const tbl = document.querySelector('#trans_detail_table');
    const tr_all = tbl.querySelectorAll('tr[data-value]');
    console.log(tr_all);
    tr_all.forEach(dt=>{
      if(dt.querySelector('[name="loc"]').value !== '' ){
        const inp = dt.querySelector('[name="loc"]');
        inp.disabled = true;
        const btn = dt.querySelector('[data-method="submit"]');
        btn.setAttribute('data-method', 'update');
        btn.classList.toggle('arrow_right');
        btn.classList.toggle('arrow_left');
      }
    })
    DOM.rmv_class('#load',"z-40");
    DOM.add_class('#loadscreen',"z-10");
    DOM.add_class('.loading2',"hidden");
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

ButtonDOM.dl_excel_dt('#dl_type','type_speaker_usage', func_show );
ButtonDOM.dl_excel_dt('#dl_jig', 'jig_detail', mstr_show, func_show, loc);
