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

let data_filter_val = '';
const [mstr_dt, detail_data] = await Promise.all([
  await api_access('get','nt_mstr', ''),
  //await api_access('fetch_wo_prot_with_desc__cache','qad_wo', ''),
  await api_access('fetch_wo_prot_specific_item__cache', 'qad_wo', ''),
]);

mstr_dt.forEach(dt=>{
  const filter = Object.values(dt).map(value => String(value)).join('--');
  dt['filter']=filter;
})
let master = mstr_dt;
master.sort((a,b)=>{
  if (a.status_wo !== b.status_wo) return b.status_wo.localeCompare(a.status_wo);
  if (a.item_number !== b.item_number) return a.item_number.localeCompare(b.item_number);
  return;
})

detail_data.forEach(dt=>{
  const filter = Object.values(dt).map(value => String(value)).join('--');
  dt['filter']=filter;
})
detail_data.sort((a,b)=>{
  if (a.item_number !== b.item_number) return a.item_number.localeCompare(b.item_number);
  if (a.rel_date !== b.rel_date) return b.rel_date.localeCompare(a.rel_date);
  return;
})
console.log({master, detail_data, mstr_dt});
const main_dom = new TableDOM2('main_table', master, 'main_page');
let id_tabl = new TableDOM2('id_table', detail_data, 'id_page');
await main_dom.table_parse_data();
await main_dom.table_pagination_init();
await main_dom.table_pagination_response();
await main_dom.table_filter_data_on_click('#search_type', '#input__type');
DOM.add_class('#load',"hidden");

document.addEventListener('click', async(e)=>{
  // open hidden 
  // -----------------------------------------------------------
  if(e.target.getAttribute('data-method') === 'open') {
    DOM.rmv_class('#load',"hidden", 'z-40');
    DOM.add_class('#loadscreen',"z-40");
    DOM.add_class('.loading2',"z-40");
    const td = e.target.closest('td');
    const tr = td.closest('tr');
    data_filter_val = tr.querySelector('[name="item_number"]').value;
    const desc = tr.querySelector('[name="_desc"]').value;
    const title = document.querySelector('#detail_title');
    title.textContent = "List ID Untuk Type: \n" + data_filter_val + " -- " + desc;
    await id_tabl.table_filter_data(data_filter_val);
    await id_tabl.table_pagination_response();
    DOM.rmv_class('#detail', 'hidden');
    DOM.rmv_class('#loadscreen',"z-40");
    DOM.add_class('#loadscreen',"z-10");
    DOM.add_class('.loading2',"hidden");
  }
// close hidden 
// -----------------------------------------------------------
  if(e.target.getAttribute('data-method') === 'close') {
    DOM.add_class('#detail', 'hidden');
    DOM.add_class('#loadscreen',"z-40");
    DOM.rmv_class('#loadscreen',"z-10");
    DOM.rmv_class('.loading2',"hidden");
    await id_tabl.table_clear();
    const title = document.querySelector('#detail_title');
    title.textContent = '';
    DOM.add_class('#load',"hidden", 'z-40');
  }
// edit button for remove disable
// -----------------------------------------------------------
  if(e.target.getAttribute('data-method') === 'edit') {
    const td = e.target.closest('td');
    const tr = td.closest('tr');
    tr.classList.toggle('border-8');
    tr.classList.toggle('border-red-500');
    const input = tr.querySelectorAll('input');
    input.forEach(dt=>{
      if(dt.getAttribute('type')=== 'text' && dt.getAttribute('name') !== 'item_number' && dt.getAttribute('name') !== '_desc'){
        if(dt.disabled === true) {
          dt.disabled = false;
        } else {
          dt.disabled = true;
        }
      }
    })
  }
// open new tab for detail data
// -----------------------------------------------------------
  if(e.target.getAttribute('data-method') === 'link') {
    const td = e.target.closest('td');
    const tr = td.closest('tr');
    const id = tr.querySelector('[name="wo_id"]').value;
    const desc = document.querySelector('#detail_title').textContent;
    const data = {
      group_code: data_filter_val+'__'+id,
      _desc: desc
    };
    ButtonDOM.open_tab_with_data("http://informationsystem.sbe.co.id:8080/wbd/new_type_report/browse.html", data);
    return;
  }
})