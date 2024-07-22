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
    let val_search = document.querySelector('#stock_search_inp').value.split('--');
    let fix_val = val_search[0].toLowerCase();
    // data stock
    stock_data = await api_access('fetch','jig_loc', {item_jig:fix_val});
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
      const inpt = trgt.querySelector('input');
      if(inpt.disabled === false) {
        const inp_hidden = trgt.querySelector('input');
        const inp_lbl = trgt.querySelector('label');
        if(inp_hidden.classList.contains('hidden')) {
          inp_hidden.classList.toggle('hidden');
          inp_hidden.classList.toggle('z-20');
          inp_lbl.classList.toggle('hidden');
        }
        inpt.focus();
      }
      return
    } 
    if(trgt.tagName === "LABEL") {
      const inpt = document.querySelector(`#${trgt.getAttribute('for')}`);
      if(inpt.disabled === false) {
        if(inpt.classList.contains('hidden')) {
          inpt.classList.toggle('hidden');
          inpt.classList.toggle('z-20');
          trgt.classList.toggle('hidden');
        }
        inpt.focus();
      }
      return;
    }
  }
  /* ---------------------------------------------------------
   switch
  --------------------------------------------------------- */
  if(event.target.getAttribute('data-method')==='switch') {
    const trgt = event.target;
    let code = '';
    const array = [
      'stock',
      'stock_search',
      'stock_div',
      'detail',
      'detail_search',
      'detail_div',
      'usage',
      'usage_search',
      'usage_div',
    ]
    if(trgt.id === 'stock') {code = 'stock'}
    if(trgt.id === 'detail') {code = 'detail'}
    if(trgt.id === 'usage') {code = 'usage'}
    array.forEach(dt=>{
      const trgt = document.querySelector(`#${dt}`);
      if(dt.includes(code)){
        if(dt !== code && trgt.classList.contains('hidden')) {
          trgt.classList.toggle('hidden');
        } 
        if(dt === code && !trgt.classList.contains('text-xl')) {
          trgt.classList.toggle('text-xl');
          trgt.classList.toggle('bg-blue-700');
          trgt.classList.toggle('font-bold');
        }
      }
      if(!dt.includes(code)){
        if(dt.includes('_') && !trgt.classList.contains('hidden')) {
          trgt.classList.toggle('hidden');
        } 
        if(!dt.includes('_') && trgt.classList.contains('text-xl')) {
          trgt.classList.toggle('text-xl');
          trgt.classList.toggle('bg-blue-700');
          trgt.classList.toggle('font-bold');
        }
      }
    })
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
    close input 
  --------------------------------------------------------- */
  if(event.target.tagName === 'INPUT' && event.target.getAttribute('type')==='text' && event.target.hasAttribute('name')) {
    const trgt = event.target;
    const value = trgt.value;
    let valid = true;
    if(trgt.hasAttribute('list')) {
      const ls = event.target.getAttribute('list');
      if(ls ==='loc_list') {
        loc_ls.validation_input(value, `#${trgt.id}`);
        if(!trgt.checkValidity()) {valid = false;}
      }
    }
    if(valid) {
      const lbl = document.querySelector(`label[for="${trgt.id}"]`);
      lbl.textContent = value;
      if(!trgt.classList.contains('hidden')) {
        trgt.classList.toggle('hidden');
        trgt.classList.toggle('z-20');
        lbl.classList.toggle('hidden');
      }
    }
    return;
  }
})

