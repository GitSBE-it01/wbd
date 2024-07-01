import { master, point, reff, vjs_log } from "./general.js";
import {
  button,
  addButton,
  minusButton,
  symbolButton,
  dtlist,
  textInput,
  textArea,
  hiddenInput,
  loading,
  header,
  main,
  section,
  aside,
  div,
  initTable,
  tableHeader,
  td_input,
  td_button,
  td_select,
  td_logic,
  td_span,
  hidden_tr,
  text,
  customDtlist,
  form,
  navigation,
  searchbar,
  selectionRow,
  selectionCol,
  inputEmptyRow,
  createTable,
} from "../../1.asset/index.js";

const alat_detail = await master.dbProcess("get", "");
const body = document.querySelector("body");
let main_data = [];
let show_data = [];
let form_data = [];
let n_numb = 1;
const label_desc = document.querySelector("#desc_alat");
const label_cat = document.querySelector("#cat");
const label_seri = document.querySelector("#seri");
const label_asset = document.querySelector("#asset");
const load = body.querySelector(".loading");
const table_base = document.getElementById("table_index");
const form_div = document.querySelector('[data-card ="form"]');

dtlist("alat_list","/",alat_detail,"sn_id","new_subcat","no_asset","_desc");
textInput({
  target: "body",
  style:
    "rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300 fixed top-[6vh] z-30 right-10 shadow-md w-[40vw] hidden",
  dtlist: "alat_list",
  ID: "alat_search",
});
load.classList.toggle("hidden");

document.addEventListener("click", async function (event) {
  // close form field and disabled
  if(!form_div.classList.contains('hidden')){
    form_div.classList.toggle('hidden');
    const open = document.querySelectorAll('[data-method]');
    open.forEach(dt=>{
      if(dt.disabled === true) {
        dt.disabled = false;
      }
      if(dt.classList.contains('opacity-25')) {
        dt.classList.toggle('opacity-25');
      }
    })
  }

  // open input search field
  if (event.target.id === "open_dtlist") {
    const inp = document.querySelector('[data-input ="input__alat_search"]');
    inp.classList.toggle("hidden");
    return;
  }

  // open form field
  if (event.target.getAttribute('data-method') === "open") {
    if(form_div.classList.contains('hidden')){
      form_div.classList.toggle('hidden');
    }
    event.target.disabled = true;
    event.target.classList.toggle('opacity-25');
    const search_id = event.target.getAttribute('data-button');
    form_data = await vjs_log.dbProcess('fetch', {data_group: search_id});
    console.log(form_data);

    return;
  }
});

document.addEventListener("change", async function (event) {
  // search tool input
  if (event.target.getAttribute("data-input") === "input__alat_search") {
    load.classList.toggle("hidden");
    const value = event.target.value;
    const split = value.split("//");
    label_desc.value = split[3] ? split[3].trim() : '';
    label_cat.value = split[1] ? split[1].trim() : '';
    label_seri.value = split[0] ? split[0].trim() : '';
    label_asset.value = split[2] ? split[2].trim() : '';
    event.target.classList.toggle("hidden");
    main_data = [];
    main_data = await vjs_log.dbProcess("fetch", { sn_id: split[0].trim() });
    const hd_row = table_base.querySelector('[data-id="header"]');
    if(main_data.length >0) {
      main_data.sort((a, b) => {
        if (a.created_date !== b.created_date)
          return b.created_date.localeCompare(a.created_date);
      });
      let check = [];
      main_data.forEach((dt) => {
        if (!check.includes(dt.created_date)) {
          check.push(dt.created_date);
          show_data.push(dt);
        }
      });
      n_numb = Math.ceil(show_data.length / 100);
      if (show_data.length > 0) {
        if (hd_row.classList.contains("hidden")) {
          hd_row.classList.toggle("hidden");
        }
        for (let i = 0; i < show_data.length; i++) {
          if (i === 100) {
            break;
          }
          let n_val = i * n_numb;
          let dt = show_data[n_val];
          const row = table_base.querySelector(`[data-id='${i}']`);
          row.setAttribute("data-value", n_val);
          if (row.classList.contains("hidden")) {
            row.classList.toggle("hidden");
          }
          const data = row.querySelectorAll("[data-field]");
          data.forEach((d) => {
            if (d.tagName === "TD") {
              d.textContent = dt[`${d.getAttribute("data-field")}`];
            }
            if (d.tagName === "TEXTAREA" || d.tagName === "INPUT") {
              d.value = dt[`${d.getAttribute("data-field")}`];
            }
            if (d.tagName === "BUTTON") {
              d.setAttribute('data-button', dt[`${d.getAttribute("data-field")}`]);
            }
          });
        }
      }
    } else {
      if (!hd_row.classList.contains("hidden")) {
        hd_row.classList.toggle("hidden");
      }
      const row = table_base.querySelectorAll(`[data-id]`);
      row.forEach(dt=>{
        if (!dt.classList.contains("hidden")) {
          dt.classList.toggle("hidden");
        }
      })
    };  
    load.classList.toggle("hidden");
    return;
  }
})
