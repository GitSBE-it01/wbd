import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';

/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const role = user_detail.role;

const master = await api_access('get','nt_mstr', '');
const wo_list = await api_access('fetch_wo_prot_with_desc','qad_wo', '');
console.log({master, wo_list});
let show_data = master;
let dtl_data = [];
let counter = 0;
show_data.sort((a,b) =>{
  if (a.item_group !== b.item_group) return b.item_group.localeCompare(a.data_group);
})
let page = 1;
TableDOM.parse_data('#table_index', show_data, page);
DtlistDOM.parse_opt("#wo_list","-",wo_list,"wo_lot");
DtlistDOM.parse_opt("#item_list","-",wo_list,"wo_part");
NavDOM.pgList_init('#main_page', master, '#table_index');
DOM.add_class('#load',"hidden");


