import {api_access, DOM, GeneralDOM, TableDOM2, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, globalEvent} from '../../3.utility/index.js';
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

const [master] = await Promise.all([
  await api_access('get','nt_reff', ''),
]);

console.log({master});
const main_dom = new TableDOM2('reff_table', master, 'reff_page');
await main_dom.table_parse_data();
await main_dom.table_pagination_init();
await main_dom.table_pagination_response();
DOM.add_class('#load',"hidden");
