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
console.log(role);
let data_mstr = [];
let data_show = [];
DOM.add_class('#load',"hidden");

document.addEventListener('click', async function(event) {
  if(event.target.id === 'search_type') {
    DOM.rmv_class('#load',"hidden");
    const dt1 = document.querySelector('#date1').value;
    const dt2 = document.querySelector('#date2').value;
    console.log({dt1,dt2});
    data_mstr = await api_access('fetch_jig_usg_filter_date', 'jig_usg', {tr_date: [dt1, dt2]});
    data_mstr.forEach(dt=>{
      const keys = Object.keys(dt);
      let fltr = '';
      keys.forEach(d2=>{
        fltr += '-'+dt[`${d2}`]+'-';
      })
      dt['filter']=fltr;
    })
    data_show = data_mstr.sort((a,b)=> {
      if (a.tr_date !== b.tr_date) return b.tr_date.localeCompare(a.tr_date);
      if (a.jig !== b.jig) return b.jig.localeCompare(a.jig);
      if (a.cat !== b.cat) return b.cat.localeCompare(a.cat);
    });
    console.log(data_mstr);
    TableDOM.parse_data('#usage_table', data_show, 1);
    NavDOM.pgList_init('#usage_page', data_show, '#usage_table');
    DOM.add_class('#load',"hidden");
    NavDOM.pgList_active('usage_page');
    await TableDOM.parse_onclick('#usage_table', data_show, 'data-group', 'usage_page');
    return;
  }
  if(event.target.id === 'search_usage') {
    data_show = GeneralDOM.filter_data_table(data_mstr, 'input__usage');
    TableDOM.parse_data('#usage_table', data_show, 1);
    NavDOM.pgList_init('#usage_page', data_show, '#usage_table');
    await TableDOM.parse_onclick('#usage_table', data_show, 'data-group', 'usage_page');
    return;
  }
})

ButtonDOM.enter_keydown('#search_usage', '#input__usage');