import {activeLink } from "../../3.utility/index.js";
import {api_access, Pagination, tableDOM} from '../../3.utility/index.js';

activeLink('');
const body = document.querySelector("body");
const load = body.querySelector(".loading");
const master = await api_access('get','jig_mstr', '');
let show_data = master;
let page = 1; 
const jig_page = new Pagination('page')
jig_page.init_page(master, 'table_jig');
load.classList.toggle("hidden");

const jig_table = new tableDOM('table_jig');
jig_table.parseData(master,page);


/* ===============================================================================
  click add even listener
=============================================================================== */
document.addEventListener("click", async function (event) {
  /* ---------------------------------------------------------
    close and open form div
  --------------------------------------------------------- */
  if(event.target.hasAttribute('data-page')) {
    jig_table.clearText();
    load.classList.toggle("hidden");
    const val = event.target.textContent;
    if(page !== val ) {
      if (val === "first" && page>1) {
        page=1;
      }
      else if (val === "last") {
        page = event.target.getAttribute('data-page');
      }
      else {
        page = val;
      }
    }
    jig_table.parseData(show_data,page);
    load.classList.toggle("hidden");
    return;
  }
})