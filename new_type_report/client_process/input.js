import {api_access, DOM, GeneralDOM, TableDOM2, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, globalEvent, currentDate} from '../../3.utility/index.js';
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

let counter = 0;
let data_filter_val = '';
const wo_id_inp = document.querySelector('#id_input');
const itm_inp = document.querySelector('#item_nbr');
const desc_inp = document.querySelector('#_desc');
let code_data_hd = '';
let code_data_hd_1 = '';
let code_data_hd_2 = '';
let grp_code = '';
const item = await api_access('get','qad_item', '');
const reff = await api_access('get','nt_reff', '');
const wo_list = await api_access('fetch_wo_prot_specific_item__cache','qad_wo', '');
console.log({item, wo_list, reff});
DtlistDOM.parse_opt('#wo_list', '-', wo_list, 'wo_id', 'wo','item_number', '_desc');
DtlistDOM.parse_opt('#item_list', '-', item, 'pt_part', 'pt_desc1', 'pt_desc2');
DOM.add_class('#load',"hidden");


/* ====================================================================
 change add event listnere
==================================================================== */
document.addEventListener('change', async(e) =>{
  // utk open disable button and sets item and desc
  // ------------------------------------------------------
  if(e.target.id === 'id_input' ) {
    DOM.rmv_class('#load', 'hidden');
    data_filter_val = e.target.value.split('--');
    e.target.value = data_filter_val[0];
    itm_inp.textContent = data_filter_val[2];
    desc_inp.textContent = data_filter_val[3];
    code_data_hd = data_filter_val[2]+'__'+data_filter_val[0];
    const btn = document.querySelector('#add_new');
    if(btn.disabled === true) {
      btn.disabled = false;
      btn.classList.toggle('opacity-25');
    }
    grp_code = data_filter_val[2]+'__'+data_filter_val[0];
    console.log(grp_code);
    const nt_hd_dt = await api_access('fetch', 'nt_hd', {group_code:grp_code})
    console.log({nt_hd_dt});
    const templ = document.querySelector('#template');
    if(nt_hd_dt.length>0) {
      for(let i=0; i<nt_hd_dt.length; i++) {
        const dt = nt_hd_dt[i];
        const new_tmp = templ.cloneNode(true);
        new_tmp.id = 'data__'+dt.id;
        const btn_submit = new_tmp.querySelector(`#submit_btn`);
        btn_submit.id += '__'+dt.id;
        btn_submit.disabled = true;
        btn_submit.classList.toggle('text-white')
        new_tmp.setAttribute('data-detail', dt.id);
        if(new_tmp.classList.contains('hidden')) {
          new_tmp.classList.toggle('hidden');
        }
        const cek_id = new_tmp.querySelectorAll('[id]');
        cek_id.forEach(d2=>{
          d2.id += '__'+dt.id;
        })
        const field = new_tmp.querySelectorAll('[name]');
        field.forEach(d2=>{
          const fld = d2.getAttribute('name');
          if(d2.tagName === 'INPUT' || d2.tagName==='SELECT') {
            d2.value = dt[`${fld}`];
            d2.disabled = true;
            d2.classList.toggle('bg-slate-700');
            d2.classList.toggle('text-white');
          } else {
            d2.textContent = dt[`${fld}`];
          }
        })
        const detail_data = await api_access('fetch', 'nt_data', {hd_code:dt.id});
        console.log({detail_data});
        for(let ii=0; ii<detail_data.length; ii++) {
          let count = ii+1;
          const inp = new_tmp.querySelector(`[data-id="${count}"]`);
          inp.value = detail_data[ii].result;
          if(inp.classList.contains('hidden')){
            inp.classList.toggle('hidden');
          }
        }
        console.log({detail_data});
        const primary = document.querySelector('#primary');
        primary.insertBefore(new_tmp, primary.firstChild);
      }
    }
    DOM.add_class('#load', 'hidden');
    return;
  }

    // utk show hidden result 
  // ------------------------------------------------------
  if(e.target.getAttribute('name') === 'item_comp' ) {
    const val = e.target.value.split('--');
    e.target.value = val[0];
    const dtl = e.target.closest('[data-detail]');
    const dsc = dtl.querySelector('[data-name="desc_comp"]');
    code_data_hd_1 = code_data_hd + '__'+val[0] + '__';
    const par_prod = dtl.querySelector('[name="part_prod"]');
    if(val[0] === itm_inp.value) {
      par_prod.value = 'product';
    } else {
      par_prod.value = 'part';
    }
    if(val.length === 3) {
      dsc.value = val[1]+" "+val[2];
    } else {
      dsc.value = val[1];
    }
    return;
  }
  
  // utk complete code id
  // ------------------------------------------------------
  if(e.target.getAttribute('name') === 'measure' ) {
    const val = e.target.value;
    code_data_hd_2 = code_data_hd_1+val;
    return;
  }

  // utk show hidden result 
  // ------------------------------------------------------
  if(e.target.id.includes('sample') ) {
    const val = parseInt(e.target.value);
    const dtl = e.target.closest('[data-detail]');
    const all = dtl.querySelectorAll('[data-id]');
    all.forEach(dt=>{
      const check = parseInt(dt.getAttribute('data-id'));
      if(check<=val) {
        if(dt.classList.contains('hidden')) {
          dt.classList.toggle('hidden');
        }
      } else {
        if(!dt.classList.contains('hidden')) {
          dt.classList.toggle('hidden');
        }
        if(dt.hasAttribute('data-change')){
          dt.removeAttribute('data-change');
        }
      }
    })
    return;
  }

  // penanda perubahan di 1 sets dan setiap result
  // ------------------------------------------------------
  if(e.target.getAttribute('name').includes('result') ) {
    if(e.target.getAttribute('data-change') !== 'new' || !e.target.classList.contains('hidden')){
      e.target.setAttribute('data-change', 'change');
    }
    if(e.target.value === '' && e.target.hasAttribute('data-change')) {
      e.target.removeAttribute('data-change');
    }
    const main = e.target.closest('[data-detail]');
    if(!main.hasAttribute('data-change') || main.getAttribute('data-change') !== 'new') {
      main.setAttribute('data-change', 'change');
    }
    return;
  }
})


/* ====================================================================
 click add event listnere
==================================================================== */
document.addEventListener('click', async(e) =>{
  // tambah 1 node utk isi data hitungan baru
  // ------------------------------------------------------
 if(e.target.id==='add_new') {
    const templ = document.querySelector('#template');
    const new_tmp = templ.cloneNode(true);
    new_tmp.id = 'new__'+counter;
    new_tmp.setAttribute('data-change', 'new');
    new_tmp.setAttribute('data-detail', 'new');
    if(new_tmp.classList.contains('hidden')) {
      new_tmp.classList.toggle('hidden');
    }
    const cek_id = new_tmp.querySelectorAll('[id]');
    cek_id.forEach(dt=>{
      dt.id += '__'+counter;
    })
    const create = new_tmp.querySelector('[name="create_date"]');
    create.value = currentDate('-');
    const primary = document.querySelector('#primary');
    primary.insertBefore(new_tmp, primary.firstChild);
    counter++;
    return;
  }

  // masukkan data ke database
  // ------------------------------------------------------
  if(e.target.id.includes('submit')) {
    DOM.rmv_class('#load', 'hidden');
    const main = e.target.closest('[data-detail]');
    const counter_btn = e.target.id.split('__');
    const dtl = main.querySelector(`#detail__${counter_btn[1]}`);
    const dt_inp = main.querySelector(`#data_input__${counter_btn[1]}`);
    const field_dtl = dtl.querySelectorAll('[name]');
    let inp_hd = [];
    let inp_hd_data ={};
    field_dtl.forEach(dt=>{
      const field = dt.getAttribute('name');
      inp_hd_data[`${field}`] = dt.value;
    })
    inp_hd_data['id'] = code_data_hd_2;
    inp_hd_data['wo_id'] = wo_id_inp.value;
    inp_hd_data['group_code'] = itm_inp.textContent + "__"+wo_id_inp.value;
    inp_hd_data['item_number']= itm_inp.textContent;
    inp_hd.push(inp_hd_data);
    console.log({inp_hd, inp_hd_data});
    let inp_dt = [];
    const field_inp = dt_inp.querySelectorAll('[data-change]');
    field_inp.forEach(dt=>{
      let inp_dt_data ={};
      const field = dt.getAttribute('name');
      inp_dt_data[`${field}`] = dt.value;
      const field2 = dt.getAttribute('data-name')
      inp_dt_data[`${field2}`] = dt.getAttribute('data-id');
      inp_dt_data['hd_code'] = code_data_hd_2;
      inp_dt_data['repeat_code'] = code_data_hd+'__'+dt.getAttribute('data-id');
      inp_dt.push(inp_dt_data);
    })
    console.log({inp_dt});
    const result1 = await api_access('insert', 'nt_hd', inp_hd);
    if(!result1.includes('fail')){
      const result2 = await api_access('insert', 'nt_data', inp_dt);
      if(!result2.includes('fail')){
        alert('data inputted to database')
      }
    }
    DOM.add_class('#load', 'hidden');
    return;
  }
  
  // delete data / new disable
  // ------------------------------------------------------
  if(e.target.id.includes('edit')) {
    DOM.rmv_class('#load', 'hidden');
    const cont = e.target.closest('[data-detail]');
    const disbl = cont.querySelectorAll('input[disabled], select[disabled]')
    console.log(disbl);
    disbl.forEach(dt=>{
      dt.disabled =false;
      d2.classList.toggle('bg-slate-700');
      d2.classList.toggle('text-white');
    })
    DOM.add_class('#load', 'hidden');
    return;
  }
  
  // delete data / new disable
  // ------------------------------------------------------
  if(e.target.id.includes('del')) {
    DOM.rmv_class('#load', 'hidden');
    const cont = e.target.closest('[data-detail]');
    if(cont.hasAttribute('data-change')) {
      cont.remove();
    } else {
      const fltr = cont.id.substring(6);
      console.log({fltr});
      const result1 = await api_access('fetch_to_del_data_hd_code', 'nt_data', {hd_code: fltr});
      console.log(result1);
      if(!result1.includes('fail')){
        const result2 = await api_access('delete', 'nt_hd', [{id: fltr}]);
        console.log(result2);
        if(result2.includes('fail')) {
          alert('data gagal di hapus');
        } else {
          alert('data telah di hapus');
        }
      }
    }
    cont.remove();
    DOM.add_class('#load', 'hidden');
    return;
  }
})