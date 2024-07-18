import {Pagination, tableDOM, buttonDOM, DtlistDOM, activeLink, api_access} from '../../3.utility/index.js';
import {master} from './general.js';

activeLink('');
const spk_dtls = await api_access('fetch_distinct_jig__cache','jig_func', '');
const list_loc = await api_access('get','list_loc', '');

const jig_ls = new DtlistDOM('#jig_list');
const spk_ls = new DtlistDOM('#spk_list');
const loc_ls = new DtlistDOM('#loc_list');
jig_ls.parse_option('-', master, 'item_jig', 'desc_jig');
spk_ls.parse_option('-', spk_dtls, 'item_type', 'description');
loc_ls.parse_option('-', list_loc, 'name');

const stock_tbl = new tableDOM('#stock_table');
const hist_tbl = new tableDOM('#history_table');
const stock_page = new Pagination('#stock_page');
const hist_page = new Pagination('#hist_page');
let stock_data =[];
let hist_data =[];
let stock_pg = 1;
let hist_pg = 1;
const body = document.querySelector("body");
const load = body.querySelector(".loading");
load.classList.toggle("hidden");

/* ===============================================================================
  click add even listener
=============================================================================== */
document.addEventListener("click", async function (event) {
  /* ---------------------------------------------------------
    search
  --------------------------------------------------------- */
  if(event.target.id === 'stock_btn') {
    stock_tbl.table_clear();
    hist_tbl.table_clear();
    load.classList.toggle("hidden");
    let val_search = document.querySelector('#stock_search').value.split('--');
    console.log(val_search);
    let fix_val = val_search[0].toLowerCase();
    // data stock
    stock_data = await api_access('fetch','jig_loc', {item_jig:fix_val});
    console.log(stock_data);
    stock_tbl.table_parse_data(stock_data,stock_pg);
    stock_page.pagination_init(stock_data, '#stock_table');
    // data history
    hist_data = await api_access('fetch','log_loc', {item_jig:fix_val});
    hist_tbl.table_parse_data(hist_data, hist_pg);
    hist_page.pagination_init(hist_data, '#history_table');
    load.classList.toggle("hidden");
    return;
  }
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
    close and open form div
  --------------------------------------------------------- */
  if(event.target.hasAttribute('data-field')) {
    const trgt = event.target;
    if(trgt.querySelector('input')) {
      const inp_hidden = trgt.querySelector('input');
      if(inp_hidden.classList.contains('hidden')) {
        inp_hidden.classList.toggle('hidden');
        inp_hidden.classList.toggle('z-20');
      }
    }
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


/* ===============================================================================
  focus
=============================================================================== */
document.addEventListener('focusout', function(event) {
    /* ---------------------------------------------------------
    close and open form div
  --------------------------------------------------------- */
  if(event.target.tagName === 'INPUT' && event.target.getAttribute('type')==='text' && event.target.hasAttribute('name')) {
    const trgt = event.target;
    if(!trgt.classList.contains('hidden')) {
      trgt.classList.toggle('hidden');
      trgt.classList.toggle('z-20');
    }
    const value = trgt.value;
    const td = trgt.closest('td');
    let curr = '';
    if(td.innerHTML.includes('value')) {
      curr = td.innerHTML.split("value");
    } else {
      curr = td.innerHTML.split(">");
    }
    console.log(curr);
    td.innerHTML = curr[0]+"value='"+value+"'>"+value;
    return;
  }
})
