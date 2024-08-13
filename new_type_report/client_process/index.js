import {api_access, DOM, GeneralDOM, TableDOM2, DtlistDOM, NavDOM, ButtonDOM, InputDOM, globalEvent} from '../../3.utility/index.js';
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

const mstr_dt = await api_access('get','nt_mstr', '');
const wo_list = await api_access('fetch_wo_prot_with_desc','qad_wo', '');
console.log({mstr_dt, wo_list});
let master = [];
wo_list.forEach(dt=>{
  const cek = mstr_dt.find(obj=>obj.item_number === dt.item_number);
  let data = '';
  if(cek !== undefined) {
    data = {
      ...dt,
      fo_before_brk_in: cek.fo_before_brk_in,
      tol_fo_before: cek.tol_fo_before,
      fo_after_brk_in: cek.fo_after_brk_in,
      tol_fo_after: cek.tol_fo_after,
      added: cek.added,
    } 
  }else {
      data = {
        ...dt
      }
    }
    master.push(data);
})
console.log({master});
const test = new TableDOM2('main_table', master, 'main_page');
await test.table_parse_data();
await test.table_pagination_init();
await test.table_pagination_response();
DtlistDOM.parse_opt("#wo_list","-",wo_list,"wo_lot");
DtlistDOM.parse_opt("#item_list","-",wo_list,"wo_part");
DOM.add_class('#load',"hidden");

