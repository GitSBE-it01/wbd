import {Pagination, tableDOM, buttonDOM, activeLink, api_access} from '../../3.utility/index.js';
import {master, loc} from './general.js';

activeLink('');
const body = document.querySelector("body");
const load = body.querySelector(".loading");
let show_data = master;
let loc_data = [];
let use = [];
let use_data = [];
let page = 1; 
const jig_page = new Pagination('#main_page')
jig_page.pagination_init(show_data, '#table_jig');
load.classList.toggle("hidden");

const jig_table = new tableDOM('#table_jig');
jig_table.table_parse_data(show_data,page);

const table_loc_jig = new tableDOM('#table_loc_jig');
const table_use_jig = new tableDOM('#table_use_jig');
const close_div = new buttonDOM('[data-id ="close__detail"]');

const loc_pagination = new Pagination('#loc_page');
let loc_page = 1;
const use_pagination = new Pagination('#use_page');
let use_page = 1;
/* ===============================================================================
  click add even listener
=============================================================================== */
document.addEventListener("click", async function (event) {
  /* ---------------------------------------------------------
    close and open form div
  --------------------------------------------------------- */
  if(event.target.hasAttribute('data-page')) {
    const group = event.target.getAttribute('data-group');
    load.classList.toggle("hidden");
    const val = parseInt(event.target.getAttribute('data-page'));
    if(group === 'main_page') {
      jig_table.table_clear();
      if(page !== val ) {
        page = val;
        jig_page.page_active(page);
      }
      jig_table.table_parse_data(show_data,page);
    }
    if(group === 'loc_page') {
      table_loc_jig.table_clear();
      if(loc_page !== val ) {
        loc_page = val;
        loc_pagination.page_active(loc_page);
      }
      table_loc_jig.table_parse_data(loc_data,loc_page);
    }
    if(group === 'use_page') {
      table_use_jig.table_clear();
      if(use_page !== val ) {
        use_page = val;
        use_pagination.page_active(use_page);
      }
      table_use_jig.table_parse_data(use_data,use_page);
    }
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
    jig_page.pagination_init(show_data, '#table_jig');
    load.classList.toggle("hidden");
    return;
  }
  /* ---------------------------------------------------------
    open detail
  --------------------------------------------------------- */
  if(event.target.getAttribute('data-method') === 'open') {
    table_loc_jig.table_clear();
    table_use_jig.table_clear();
    const hidden_cont = document.querySelector('[data-card = "hidden_table"]');
    if(hidden_cont.classList.contains('hidden')) {
      hidden_cont.classList.toggle('hidden')
    }
    load.classList.toggle("hidden");
    let tr = event.target.closest('tr');
    let val_jig = tr.querySelector('[name ="item_jig"]');
    let fix_val = val_jig.textContent;
    // location detail
    loc_data = [];
    loc_data = loc.filter(obj=>obj.item_jig === fix_val);
    table_loc_jig.table_parse_data(loc_data,loc_page);
    loc_pagination.pagination_init(loc_data,'#table_loc_jig');
    // usage detail
    if(!use[fix_val]) {
      use[fix_val] = await api_access('fetch_jig_func_w_desc','jig_func', {item_jig: fix_val});
    }
    use_data = [];
    use_data = use[fix_val];
    table_use_jig.table_parse_data(use_data,use_page);
    use_pagination.pagination_init(use_data,'#table_use_jig');
    load.classList.toggle("hidden");
    return;
  }
  /* ---------------------------------------------------------
    close detail
  --------------------------------------------------------- */
  if(event.target.getAttribute('data-method') === 'close') {
    close_div.btn_hide('[data-card ="hidden_table"]');
    return;
  }
  /* ---------------------------------------------------------
   switch
  --------------------------------------------------------- */
  if(event.target.hasAttribute('data-switch')) {
    const trgt = event.target;
    const cek = event.target.getAttribute('data-switch');
    const table_loc = document.querySelector('#table_loc_jig');
    const table_use = document.querySelector('#table_use_jig');
    const page_loc = document.querySelector('#loc_page');
    const page_use = document.querySelector('#use_page');
    if(cek === 'lokasi') {
      const sets = document.querySelector('[data-switch="tipe"]');
      if(!table_use.classList.contains('hidden')) {
        table_use.classList.toggle('hidden');
        page_use.classList.toggle('hidden');
      }
      if(table_loc.classList.contains('hidden')) {
        table_loc.classList.toggle('hidden');
        page_loc.classList.toggle('hidden');
      }
      sets.setAttribute('class',"flex duration-300 justify-center items-center hover:font-bold text-lg sticky top-0 z-20 cursor-pointer h-[5vh] w-[50%] border-black border-2 hover:bg-slate-950 hover:text-2xl hover:text-white");
    } else {
      if(table_use.classList.contains('hidden')) {
        table_use.classList.toggle('hidden');
        page_use.classList.toggle('hidden');
      }
      if(!table_loc.classList.contains('hidden')) {
        table_loc.classList.toggle('hidden');
        page_loc.classList.toggle('hidden');
      }
      const sets = document.querySelector('[data-switch="lokasi"]');
      sets.setAttribute('class',"flex duration-300 justify-center items-center hover:font-bold text-lg sticky top-0 z-20 cursor-pointer h-[5vh] w-[50%] border-black border-2 hover:bg-slate-950 hover:text-2xl hover:text-white");
    }
    trgt.setAttribute('class',"flex duration-300 justify-center items-center font-bold text-2xl sticky top-0 z-20 h-[5vh] w-[50%] border-black border-2 hover:bg-slate-950 cursor-pointer hover:text-white bg-slate-950 text-white");
    return;
  }
})

/* ===============================================================================
  keydown add event listener
=============================================================================== */
document.addEventListener('keydown', function(event) {
  if (event.key === "Enter") {
      const submit_btn = document.querySelector('#search_btn');
      submit_btn.click();
  }
})
