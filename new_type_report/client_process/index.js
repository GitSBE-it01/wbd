import {currentDate, customPeriod} from "../../3.utility/index.js";
import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM} from '../../3.utility/index.js';

GeneralDOM.td_input_default();
NavDOM.active_link('');
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
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
TableDOM.parse_data('#table_index', show_data, page);
DtlistDOM.parse_opt("#wo_list","/",wo_list,"wo_lot");
DtlistDOM.parse_opt("#item_list","/",wo_list,"wo_part");
NavDOM.pgList_init('#main_page', master, '#table_index');
DOM.add_class('#load',"hidden");


