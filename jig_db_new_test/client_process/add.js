import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, currentDate} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';
import {data_switch} from './general.js';

/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('admin');
GeneralDOM.td_input_default();
NavDOM.active_link('nav','');
const check = window.location.href.split("/");

// initialize data 
//----------------------------------------------
let counter_row = 0;
let urut = 1;
let counter_loc = 1;
const ls_loc = await api_access('get','list_loc','');
const master = await api_access('get','jig_mstr','');
const mtnc = await api_access('get','list_mtnc','');
const role_cek = await api_access('fetch','role',{apps:`${check[4]}`});
const users = await api_access('get','auth_mstr','');
const item = await api_access('fetch_item__cache','qad_item','');
console.log({ls_loc
    ,master
    ,mtnc
    ,role_cek
    ,item
    ,users
})

// datalist parsing option
//----------------------------------------------
DtlistDOM.parse_opt("#jig_list","-",master,"item_jig", 'desc_jig');
DtlistDOM.parse_opt("#type_list","-",item,"pt_part", 'pt_desc1', 'pt_desc2');
DtlistDOM.parse_opt("#loc_list","-",ls_loc,"name");
DtlistDOM.parse_opt("#users","-",users,"Absensi", "Name");
DtlistDOM.parse_opt("#jig_type_list","-",mtnc,"type_jig");

const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade']; // user_input atau approval_by
DOM.add_class('#load',"hidden");

/* ====================================================================
  custom function and event
==================================================================== */
// click switch to change page (show hide and hide current display)
//----------------------------------------------
let code_array = [
    'jig',
    'speaker',
    'loc',
    'type_jig',
    'user',
  ]
  let target_array = [
    'switch',
    'add',
  ]

  document.addEventListener('click', async function(event) {
    if(event.target.id === 'jig_switch') {
      data_switch('jig', code_array, target_array); 
      const sbmt_btn = document.getElementById('submit_button');
      sbmt_btn.setAttribute('data-method', 'jig_submit');
      return;
    }
    if(event.target.id === 'speaker_switch') {
      data_switch('speaker', code_array, target_array); 
      const sbmt_btn = document.getElementById('submit_button');
      sbmt_btn.setAttribute('data-method', 'spk_submit');
      return;
    }
    if(event.target.id === 'loc_switch') {
      data_switch('loc', code_array, target_array); 
      const sbmt_btn = document.getElementById('submit_button');
      sbmt_btn.setAttribute('data-method', 'loc_submit');
      return;
    }
    if(event.target.id === 'type_jig_switch') {
      data_switch('type_jig', code_array, target_array); 
      const sbmt_btn = document.getElementById('submit_button');
      sbmt_btn.setAttribute('data-method', 'type_jig_submit');
      return;
    }
    if(event.target.id === 'user_switch') {
      data_switch('user', code_array, target_array); 
      const sbmt_btn = document.getElementById('submit_button');
      sbmt_btn.setAttribute('data-method', 'user_submit');
      return;
    }
  })

/* ====================================================================
setup changes data from another changes
==================================================================== */
document.addEventListener('change', function(event) {
// New Jig
//----------------------------------------------
// change qty per unit, di summary di qty total 
//----------------------------------------------
    if(event.target.getAttribute('name') === 'qty_per_unit') {
        const td = event.target.closest('td');
        const tr = td.closest('tr');
        const table = tr.closest('table');
        const target = document.getElementById('qty_total');
        let total = 0;
        if(table.id == 'add_loc_jig_form') {
            const all_dt = table.querySelectorAll('[name="qty_per_unit"]');
            all_dt.forEach(dt=>{
              const td = dt.closest('td');
              const tr = td.closest('tr');
              const qty_change = tr.querySelector('[name="qty_change"]');
              const val = dt.value === '' ? 0 : dt.value;
              qty_change.value = val;
                total += parseInt(val);
            })
        }
        target.value = total;
        return;
    }
// split value to get only item number
//----------------------------------------------
    if(event.target.getAttribute('name') === 'item_type') {
      if(event.target.closest('td') !== null)  {
        const td = event.target.closest('td');
        const tr = td.closest('tr');
        const table = tr.closest('table');
        if(table.id === 'add_type_jig_form') {
          const splt = event.target.value.split('--');
          event.target.value = splt[0];
        }
        return;
      } else {
        const form = event.target.closest('form');
        const div = form.closest('div');
        const val_filter = event.target.value.split('--');
        const tbl = div.querySelectorAll('#add_speaker_type_jig_form tbody tr [name="item_type"]');
        const tbl_temp = div.querySelector('#add_new_speaker_type_jig_form tbody tr [name="item_type"]');
        tbl.forEach(dt=>{
          dt.value = val_filter[0];
        })
        tbl_temp.value = val_filter[0];
        const tr_dt = div.querySelectorAll('[name="trans_date"]');
        tr_dt.forEach(dt=>{
          dt.value = currentDate('-');
        })
        return;
      }
    }
// input data item jig baru, otomatis mengisi data location dan usage
//----------------------------------------------
    if(event.target.id === 'item_jig') {
      const main_loc = document.querySelector('#add_loc_jig_form');
      const new_loc = document.querySelector('#add_loc_jig_new_form');
      const main_spk = document.querySelector('#add_type_jig_form');
      const new_spk = document.querySelector('#add_type_jig_new_form');
      const row_main_loc = main_loc.querySelectorAll('[name="item_jig"]');
      const row_main_spk = main_spk.querySelectorAll('[name="item_jig"]');
      const cont_ = document.querySelectorAll('#jig_add [name="trans_date"]');
      cont_.forEach(dt=>{
        dt.value = currentDate("-");
      })
      row_main_loc.forEach(dt=>{
        dt.value = event.target.value;
      })
      row_main_spk.forEach(dt=>{
        dt.value = event.target.value;
      })
      const row_new_loc = new_loc.querySelector('[name="item_jig"]');
      row_new_loc.value = event.target.value;
      const row_new_spk = new_spk.querySelector('[name="item_jig"]');
      row_new_spk.value = event.target.value;
      const code_main_loc = main_loc.querySelectorAll('[name="code"]');
      const urut_inp = main_loc.querySelectorAll('[name="urut"]');
      let new_urut = 1;
      code_main_loc.forEach(dt=>{
        let cek_count ='';
        if(new_urut<10) {
          cek_count += '00' + new_urut;
        } else if(new_urut<100) {
          cek_count += '0' + new_urut;
        } else {
          cek_count += new_urut;
        }
        dt.value = event.target.value + "--" + cek_count;
        const count = new_urut-1;
        urut_inp[count].value = new_urut
        const label = document.querySelector(`[for="${dt.id}"]`);
        label.textContent= event.target.value + "--" + cek_count;
        new_urut++;
      })
      urut = new_urut;
      const code_new_loc = new_loc.querySelectorAll('[name="code"]');
      code_new_loc.value = event.target.value;
      return;
    } 

// change qty per unit, di summary di qty total 
//----------------------------------------------
  if(event.target.getAttribute('name') === 'item_jig' && event.target.closest('td') !== null) {
    const splt = event.target.value.split('--');
    const lbl = document.querySelector(`[for="${event.target.id}"]`);
    lbl.textContent = splt[0];
    event.target.value = splt[0];
    return;
  }
})

/* ====================================================================
proses add new row
==================================================================== */
document.addEventListener('click', async function(event) {
  // insert row loc table
//----------------------------------------------
  if(event.target.id === 'add_loc_row') {
    TableDOM.insert_row2('#add_loc_jig_new_form', '#add_loc_jig_form', urut, 'bot');
    const new_tr = document.querySelector(`[data-id="new__#add_loc_jig_form__${urut}"]`);
    const code = new_tr.querySelector('[name="code"]');
    const urut_inp = new_tr.querySelector('[name="urut"]');
    urut_inp.value = urut;
    let cek_count ='';
    if(urut<10) {
      cek_count += '00' + urut;
    } else if(urut<100) {
      cek_count += '0' + urut;
    } else {
      cek_count += urut;
    }

    const itm = new_tr.querySelector('[name="item_jig"]');
    code.value = itm.value +"--"+ cek_count;
    const lbl_code = new_tr.querySelector(`[for="${code.id}"]`);
    lbl_code.textContent = itm.value +"--"+ cek_count;
    urut++;
    return;
  }
// insert row type table
//----------------------------------------------
  if(event.target.id === 'add_type_row') {
    counter_row++;
    TableDOM.insert_row2('#add_type_jig_new_form', '#add_type_jig_form', counter_row, 'bot');
    counter_loc++;
    return;
  }
// insert row jig table
//----------------------------------------------
  if(event.target.id === 'add_jig_row') {
    counter_row++;
    TableDOM.insert_row2('#add_new_speaker_type_jig_form', '#add_speaker_type_jig_form', counter_row, 'bot');
    counter_loc++;
    return;
  }
})

/* ====================================================================
submit processing
==================================================================== */
document.addEventListener('click', async function(event) {
// submit data jig
//----------------------------------------------
  if(event.target.getAttribute('data-method') === 'jig_submit') {
    DOM.rmv_class('#load',"hidden");
    const container = document.getElementById('jig_add');
    const data_mstr = container.querySelectorAll('#add_jig_form [name]');
    const ins_mstr = [];
    let dt_temp = {
      trans_date: currentDate("-"),
    };
    data_mstr.forEach(dt=>{
      const field = dt.getAttribute('name');
      if(!dt_temp[`${field}`]) {
        dt_temp[`${field}`] = dt.value;
      } else {
        console.log('error ', dt);
      }
    })
    ins_mstr.push(dt_temp);
    if(ins_mstr.length >0) {
      const result = await api_access('insert', 'jig_mstr', ins_mstr) ;
      if(result.includes('fail')) {
        alert('proses data error');
        return;
      } else {
        const result = await api_access('insert', 'log_mstr', ins_mstr) ;
      }
    }

    const ins_loc = [];
    const data_loc = container.querySelectorAll('#add_loc_jig_form tbody tr');
    data_loc.forEach(dt=>{
      const fields = dt.querySelectorAll('[name]');
      dt_temp = {
        trans_date: currentDate("-"),
        toleransi: parseInt(container.querySelector('#tol').value)
      };
      fields.forEach(d2=>{
        const fld = d2.getAttribute('name');
        if(!dt_temp[`${fld}`]) {
          dt_temp[`${fld}`] = d2.value;
        }
      })
      ins_loc.push(dt_temp);
    })
    if(ins_loc.length >0) {
      const result = await api_access('insert', 'jig_loc', ins_loc) ;
      if(result.includes('fail')) {
        alert('proses data error');
        return;
      } else {
        const result = await api_access('insert', 'log_loc', ins_loc) ;
      }
    }

    const ins_type = [];
    const data_type = container.querySelectorAll('#add_type_jig_form tbody tr');
    data_type.forEach(dt=>{
      const fields = dt.querySelectorAll('[name]');
      dt_temp = {
        trans_date: currentDate("-"),
      };
      fields.forEach(d2=>{
        const fld = d2.getAttribute('name');
        if(!dt_temp[`${fld}`]) {
          dt_temp[`${fld}`] = d2.value;
        }
      })
      ins_type.push(dt_temp);
    })
    if(ins_type.length >0) {
      const result = await api_access('insert', 'jig_func', ins_type) ;
      if(result.includes('fail')) {
        alert('proses data error');
        return;
      } else {
        const result = await api_access('insert', 'log_func', ins_type) ;
      }
    }
    alert('Proses data berhasil');
    location.reload();
    return;
  }

// submit data lokasi
//----------------------------------------------
  if(event.target.getAttribute('data-method') === 'loc_submit') {
    DOM.rmv_class('#load',"hidden");
    const container = document.getElementById('loc_add');
    const data_mstr = container.querySelectorAll('#add_location_form [name]');
    const ins_mstr = [];
    let dt_temp = {
      trans_date: currentDate("-"),
      remark: 'data awal'
    };
    data_mstr.forEach(dt=>{
      const field = dt.getAttribute('name');
      if(!dt_temp.field) {
        dt_temp[`${field}`] = dt.value;
      } else {
        console.log('error ', dt);
      }
      ins_mstr.push(dt_temp);
    })
    const cek = await api_access('fetch', 'list_loc', {name: ins_mstr[0]['name']});
    if(cek.length === 0 || cek === undefined ){
      const result = await api_access('insert','list_loc',ins_mstr);
      if(!result.includes('fail')) {
        alert('data berhasil ditambahkan');
      }
      data_mstr.forEach(dt=>{
        dt.value = '';
      })
    } else {
      alert('Lokasi sudah ada');
    }
    DOM.rmv_class('#load',"hidden");
    return;
  }

// submit data lokasi
//----------------------------------------------
  if(event.target.getAttribute('data-method') === 'spk_submit') {
    DOM.rmv_class('#load',"hidden");
    const container = document.getElementById('speaker_add');
    const data_mstr = container.querySelectorAll('#add_speaker_type_jig_form tbody tr');
    const ins_mstr = [];
    data_mstr.forEach(dt=>{
      const field = dt.querySelectorAll('[name]');
      let dt_temp = {};
      field.forEach(d2=>{
        const name = d2.getAttribute('name');
        if(!dt_temp[`${name}`]) {
          dt_temp[`${name}`] = d2.value;
        } else {
          console.log('error ', d2);
        }
      })
      console.log(dt_temp);
      ins_mstr.push(dt_temp);
    })
    console.log({ins_mstr});
    const result = await api_access('insert','jig_func',ins_mstr);
    if(!result.includes('fail')) {
      const result2 = await api_access('insert','log_func',ins_mstr);
      alert('data berhasil ditambahkan');
      location.reload();
    } else {
      alert('data gagal di proses');
      DOM.rmv_class('#load',"hidden");
      return;
    }
  }

// submit data type jig
//----------------------------------------------
  if(event.target.getAttribute('data-method') === 'type_jig_submit') {
    DOM.rmv_class('#load',"hidden");
    const container = document.getElementById('type_jig_add');
    const data_mstr = container.querySelectorAll('#add_jig_type_form [name]');
    const ins_mstr = [];
    let dt_temp = {
      trans_date: currentDate("-"),
      remark: 'data awal'
    };
    data_mstr.forEach(dt=>{
      const field = dt.getAttribute('name');
      if(!dt_temp.field) {
        dt_temp[`${field}`] = dt.value;
      } else {
        console.log('error ', dt);
      }
      ins_mstr.push(dt_temp);
    })
    const cek = await api_access('fetch', 'list_mtnc', {name: ins_mstr[0]['type_jig']});
    if(cek.length === 0 || cek === undefined ){
      const result = await api_access('insert','list_mtnc',ins_mstr);
      if(!result.includes('fail')) {
        alert('data berhasil ditambahkan');
      }
      data_mstr.forEach(dt=>{
        dt.value = '';
      })
    } else {
      alert('Type jig sudah ada');
    }
    DOM.rmv_class('#load',"hidden");
    return;
  }

// submit data users
//----------------------------------------------
  if(event.target.getAttribute('data-method') === 'user_submit') {
    const container = document.getElementById('user_add');
    const data_mstr = container.querySelectorAll('[name]');
    const ins_mstr = [];
    let dt_temp = {
      trans_date: currentDate("-"),
      remark: 'data awal',
      apps: 'jig_db_new3'
    };
    data_mstr.forEach(dt=>{
      const field = dt.getAttribute('name');
      if(!dt_temp.field) {
        dt_temp[`${field}`] = dt.value;
      } else {
        console.log('error ', dt);
      }
      ins_mstr.push(dt_temp);
    })
    const _inp = container.querySelector('#absen');
    const val_inp = _inp.value.split('--');
    const cek = role_cek.filter(obj=>obj.absen === val_inp[0]);
    if(cek.length === 0 || cek === undefined ){
      const result = await api_access('insert','auth_mstr',ins_mstr);
      if(!result.includes('fail')) {
        alert('data berhasil ditambahkan');
      }
      data_mstr.forEach(dt=>{
        dt.value = '';
      })
    } else {
      const result = await api_access('update','auth_mstr',ins_mstr);
      if(!result.includes('fail')) {
        alert('data berhasil di ubah');
      }
      data_mstr.forEach(dt=>{
        dt.value = '';
      })
    }
    DOM.rmv_class('#load',"hidden");
    return;
  }
})
 