import {activeLink } from "../../3.utility/index.js";
import {api_access, Pagination, tableDOM} from '../../3.utility/index.js';

activeLink('');
const body = document.querySelector("body");
const load = body.querySelector(".loading");
let master = await api_access('get','jig_mstr', '');
let loc = await api_access('get','jig_loc', '');
const gabungan = {};
loc.forEach(dt=>{
  if(gabungan[dt.item_jig]) {
    gabungan[dt.item_jig]['qty_total'] += parseInt(dt.qty_per_unit);
  } else {
    const data = {
      ...dt,
      qty_total: parseInt(dt.qty_per_unit)
    }
    gabungan[dt.item_jig] = data;
  }
})
master.forEach(dt=>{
  const fltr = dt.item_jig+ "--"+
    dt.desc_jig+ "--"+
    dt.status_jig+ "--"+
    dt.material+ "--"+
    dt.type+ "--"+
    dt.drawing;
  const qty = gabungan[dt.item_jig] ? gabungan[dt.item_jig].qty_total :0;
  dt['filter'] = fltr;
  dt['qty'] = qty;
})

let show_data = master;
let loc_data = [];
let page = 1; 
const jig_page = new Pagination('page')
jig_page.pagination_init(show_data, 'table_jig');
load.classList.toggle("hidden");

const jig_table = new tableDOM('table_jig');
jig_table.table_parse_data(show_data,page);

const table_loc_jig = new tableDOM('table_loc_jig');
table_loc_jig.table_parse_data(loc,"1");


/* ===============================================================================
  click add even listener
=============================================================================== */
document.addEventListener("click", async function (event) {
  /* ---------------------------------------------------------
    close and open form div
  --------------------------------------------------------- */
  if(event.target.hasAttribute('data-page')) {
    jig_table.table_clear();
    load.classList.toggle("hidden");
    const val = parseInt(event.target.getAttribute('data-page'));
    if(page !== val ) {
        page = val;
        jig_page.page_active(page);
    }
    jig_table.table_parse_data(show_data,page);
    load.classList.toggle("hidden");
    return;
  }
  /* ---------------------------------------------------------
    search
  --------------------------------------------------------- */
  if(event.target.id === 'search_btn') {
    jig_table.table_clear();
    load.classList.toggle("hidden");
    let val_search = document.querySelector('[data-input = "input__tool_search"]');
    let fix_val = val_search.value.toLowerCase();
    show_data = master.filter(obj=>obj.filter.toLowerCase().includes(fix_val));
    jig_table.table_parse_data(show_data,page);
    jig_page.pagination_init(show_data, 'table_jig');
    load.classList.toggle("hidden");
    return;
  }
  /* ---------------------------------------------------------
    open detail
  --------------------------------------------------------- */
  if(event.target.getAttribute('data-method') === 'open') {
    table_loc_jig.table_clear();
    const hidden_cont = document.querySelector('[data-card = "hidden_table"]');
    if(hidden_cont.classList.contains('hidden')) {
      hidden_cont.classList.toggle('hidden')
    }
    load.classList.toggle("hidden");
    let tr = event.target.closest('tr');
    let val_jig = tr.querySelector('[name ="item_jig"]');
    let fix_val = val_jig.textContent;
    loc_data = loc.filter(obj=>obj.item_jig.includes(fix_val));
    table_loc_jig.table_parse_data(loc_data,1);
    load.classList.toggle("hidden");
    return;
  }
})

