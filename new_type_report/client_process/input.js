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
const item = await api_access('get','qad_item', '');
const reff = await api_access('get','nt_reff', '');
const wo_list = await api_access('fetch_wo_prot_specific_item__cache','qad_wo', '');
console.log({item, wo_list});
DtlistDOM.parse_opt('#wo_list', '-', wo_list, 'wo_id', 'wo','item_number', '_desc');
DtlistDOM.parse_opt('#item_list', '-', item, 'pt_part', 'pt_desc1', 'pt_desc2');
DtlistDOM.parse_opt('#jenis_ukur', '-', reff, 'type');
DOM.add_class('#load',"hidden");


document.addEventListener('change', async(e) =>{
  if(e.target.id === 'id_input' ) {
    console.log(e.target.value);
      const itm_inp = document.querySelector('#item_nbr');
      const desc_inp = document.querySelector('#_desc');
      const comp_inp = document.querySelector('#comp_item');
      const lot_inp = document.querySelector('#lot');
      const jenis_inp = document.querySelector('#jenis_ukur');
      const um_inp = document.querySelector('#um');
      const add_btn = document.querySelector('#add_check');
      data_filter_val = e.target.value.split('--');
      e.target.value = data_filter_val[0];
      itm_inp.textContent = data_filter_val[2];
      desc_inp.textContent = data_filter_val[3];
      if(comp_inp.disabled === true) {
        comp_inp.disabled = false;
        comp_inp.classList.toggle('bg-slate-700');
        comp_inp.classList.toggle('text-white');
        jenis_inp.disabled = false;
        jenis_inp.classList.toggle('bg-slate-700');
        jenis_inp.classList.toggle('text-white');
        lot_inp.disabled = false;
        lot_inp.classList.toggle('bg-slate-700');
        lot_inp.classList.toggle('text-white');
        um_inp.disabled = false;
        um_inp.classList.toggle('bg-slate-700');
        um_inp.classList.toggle('text-white');
        add_btn.disabled = false;
        add_btn.classList.toggle('text-white');
      }
      return;
  }
  if(e.target.id === 'comp_item' ) {
    const val = e.target.value.split('--');
    e.target.value = val[0];
    const dsc = document.querySelector('#comp_desc');
    if(val.length === 3) {
      dsc.textContent = val[1]+" "+val[2];
    } else {
      dsc.textContent = val[1];
    }
    return;
  }
})

document.addEventListener('click', async(e) =>{
  if(e.target.id === 'add_check' ) {
    DOM.rmv_class('#load', 'hidden');
    const id_const = data_filter_val[2]+"____"+data_filter_val[0];
    let check = await api_access('fetch', 'nt_hd', {id: id_const});
    console.log({check})
    if(check.length === 0) {
      const data = {
        id: id_const,
        item_number: data_filter_val[2],
        wo_id:data_filter_val[1],
        create_date: currentDate('-'),
      }
      //let insert_hd = await api_access('insert', 'nt_hd', data);
    }
    const template = document.querySelector('#template');
    const new_input = template.cloneNode(true);
    new_input.classList.toggle('hidden');
    new_input.id = counter;
    const ttl = new_input.querySelector('[data-detail="title"]');
    const comp = document.querySelector('#comp_item');
    const jns = document.querySelector('#jenis_ukur');
    const um_inp = document.querySelector('#um');
    const lot = document.querySelector('#lot');
    ttl.textContent = comp.value + " -- " + jns.value;
    new_input.setAttribute('data-change', 'new');
    new_input.setAttribute('data-id', counter);
    const hd_code = new_input.querySelector('[name="hd_code"]');
    hd_code.value = id_const;
    const msr_type = new_input.querySelector('[name="msr_type"]');
    msr_type.value = jns.value;
    const um = new_input.querySelector('[name="um"]');
    um.value = um_inp.value;
    const item_comp = new_input.querySelector('[name="item_comp"]');
    item_comp.value = comp.value;
    const no_lot = new_input.querySelector('[name="no_lot"]');
    no_lot.value = lot.value;
    counter++;
    const container = document.querySelector('#primary');
    container.insertBefore(new_input,template);
    DOM.add_class('#load', 'hidden');
    return;
  }

  if(e.target.getAttribute('data-method')==='detail' ) {
    DOM.rmv_class('#load', 'hidden');
    const div = e.closest('div');
    DOM.add_class('')
    DOM.add_class('#load', 'hidden');
    return;
  }

  if(e.target.getAttribute('data-method')==='submit' ) {
    DOM.rmv_class('#load', 'hidden');
    
    DOM.add_class('#load', 'hidden');
    return;
  }
})