import { currentDate, dtlist, inputEmptyRow,activeLink } from "../../3.utility/index.js";
import {api_access} from '../../3.utility/index.js';

activeLink('');
const body = document.querySelector("body");
const load = body.querySelector(".loading");
const master = await api_access('get','vjs_alat', '');
const table_base = document.querySelector('#table_tool');
let show_data =[];
let n_numb = 1;
let n_curr = 1;
const search_bar = document.querySelector('#input__tool_search');

const hd_row = table_base.querySelector('[data-id="header"]');
master.sort((a, b) => {
if (a.sn_id     !== b.sn_id   )
    return b.sn_id   .localeCompare(a.sn_id   );
});

show_data = master;
n_numb = Math.ceil(show_data.length / 100);
if (show_data.length>0) {
    if (hd_row.classList.contains("hidden")) {
        hd_row.classList.toggle("hidden");
    }
    for (let i = 0; i < show_data.length; i++) {
        if (i === 100) {
        break;
        }
        let n_val = i * n_curr;
        let dt = show_data[n_val];
        const row = table_base.querySelector(`[data-id='${i}']`);
        row.setAttribute("data-value", n_val);
        if (row.classList.contains("hidden")) {
        row.classList.toggle("hidden");
        }
        const data = row.querySelectorAll("[name]");
        data.forEach((d) => {
        if (d.tagName === "TD") {
            d.textContent = dt[`${d.getAttribute("name")}`];
        }
        if (d.tagName === "TEXTAREA" || d.tagName === "INPUT") {
            d.value = dt[`${d.getAttribute("name")}`];
        }
        if (d.tagName === "BUTTON") {
            d.setAttribute('data-button', dt[`${d.getAttribute("name")}`]);
        }
        });
    }
}
load.classList.toggle("hidden");