import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';

await auth2();
await GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
const loc = await api_access('get','jig_loc','');
const tr = await api_access('fetch','jig_trans',{status:'open'});
const master = await api_access('get','jig_mstr','');
let loc_sum = [];
let detail_show = [];
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
console.log({loc_sum});
let header_master = [];
master.forEach(dt=>{
    const bor = tr.filter(obj=>obj.item_jig === dt.item_jig);
    let qty_bor = 0;
    bor.forEach(d2=>{
      if(d2.item_jig === dt.item_jig) {
        qty_bor += parseInt(d2.qty);
      }
    })
    const data = {
      item_jig: dt.item_jig,
      filter: dt.item_jig,
      qty_oh: loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`].qty_total :0,
      qty_curr: loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`]['qty_total'] - qty_bor :0,
      qty_br: qty_bor,
    }
    dt['qty_oh'] = loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`]['qty_total'] :0,
    dt['qty_curr'] = loc_sum[`${dt.item_jig}`] ? loc_sum[`${dt.item_jig}`]['qty_total'] - qty_bor : 0,
    dt['qty_br'] = qty_bor,
    header_master.push(data);
})
let header_show = header_master;
console.log({loc, master, header_master});

TableDOM.parse_data('#trans_header_table', header_show, 1);
NavDOM.pgList_init('#trans_page', header_show, '#trans_header_table');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");

NavDOM.pgList_active('jig_page');
await TableDOM.parse_onclick('#trans_header_table', header_show, 'data-group', 'trans_page');
await TableDOM.filter_data('#trans_header_table', header_master, header_show, 'search_jig', 'input__jig', '#trans_page');
ButtonDOM.enter_keydown('#search_jig', '#input__jig');

document.addEventListener('click', function(event) {
  if(event.target.getAttribute('data-method') === 'detail') {
    const td = event.target.closest('td');
    const tr = td.closest('tr');
    const filter = tr.querySelector('[name="item_jig"]');
    console.log(filter.textContent);
    const trgt = document.querySelector('[data-card="detail"]');
    DOM.rmv_class(trgt, 'hidden');
    detail_show = loc.filter(obj=> obj.item_jig === filter.textContent);
    console.log({detail_show});
    TableDOM.parse_data('#trans_detail_table', detail_show, 1);
    NavDOM.pgList_init('#trans_detail_page', detail_show, '#trans_detail_table');
  }
})

ButtonDOM.show_hidden('#close_detail', '[data-card="detail"]');
