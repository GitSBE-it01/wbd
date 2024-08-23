import {api_access, DOM, GeneralDOM, TableDOM2, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, globalEvent,calculateMean, calculateStdDev, calculateCPK,} from '../../3.utility/index.js';
import {auth2} from '../../3.utility/auth.js';


/* ====================================================================
  Initialize page
==================================================================== */
await auth2();
await GeneralDOM.init('');
GeneralDOM.td_input_default();
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const role = user_detail.role;
const url = window.location.href;

// split url to get data 
const data = url.split('?');
const sprt = data[1].split('&');

// group code
const group_code = sprt[0].split('=');
//wo_id 
const _id = group_code[1].split('__');

// descirption
const desc  = sprt[1].split('=');
const mod = desc[1].replace(/%20/g, ' ');
const mod2 = mod.split('%3A %0A');
const desc2 = mod2[1].split(' -- ');

// get data nt_had
const nt_hd = await api_access('fetch','nt_hd', {group_code: group_code[1]});
let data_all = [];
let counter = 0;
for(let i=0; i<nt_hd.length; i++) {
  const dt = nt_hd[i];
  const id_fltr = dt['id'];
  const nt_dt = await api_access('fetch', 'nt_data', {hd_code: id_fltr});
  nt_dt.sort((a,b)=>{
    a.no_repeat - b.no_repeat
  })
  data_all[`${dt['measure']}`]=nt_dt;
}
console.log({data_all});

const keys = Object.keys(data_all);
let max = 0;
keys.forEach(dt=>{
  const ky = data_all[dt];
  const count = ky.length-1;
  if(ky[count]['no_repeat']> max) {
    max= ky[count]['no_repeat']
  }
})
console.log({keys, max});

for(let i=0; i<nt_hd.length; i++) {
  const dt = nt_hd[i];
  const tbl_temp = document.querySelector('#browse_table_temp');
  const new_tbl = tbl_temp.cloneNode(true);
  new_tbl.id = 'table__'+counter;
  new_tbl.classList.remove('hidden');
  const prime = document.querySelector('#primary');
  prime.appendChild(new_tbl);
  const tr_header = new_tbl.querySelector('thead tr th');
  tr_header.textContent = dt['measure'];
  for(let ii=1; ii<=max; ii++) {
    const tr = new_tbl.querySelector(`[data-id="browse_table_temp__${ii-1}"]`);
    tr.classList.toggle('hidden');
    tr.setAttribute('data-id', dt['measure']+'__'+ii);
    const td = tr.querySelectorAll('td');
    const data2 = data_all[dt['measure']].find(obj=>obj.no_repeat === ii);
    if(data2 !== undefined) {
      td.forEach(d2=>{
        const field = d2.getAttribute('name');
        d2.textContent = data2[`${field}`];
      })
    } else {
      td.forEach(d2=>{
        const field = d2.getAttribute('name');
        if(field === 'no_repeat') {
          d2.textContent = ii;
        }
        if(field === 'result') {
          d2.textContent = '-'  ;
        }
      })
    }
  }
  counter++;
}

const item =document.querySelector('#item');
item.textContent = desc2[0];
const _desc =document.querySelector('#_desc');
_desc.textContent = desc2[1];
const wo_id =document.querySelector('#wo_id');
wo_id.textContent = _id[1];

DOM.add_class('#load',"hidden");

const result = [];
data_all['FO cone'].forEach(dt=>{
  result.push(dt.result);
})
console.log(result);
const usl ='';
const lsl ='';
const mean = calculateMean(result);
const stdev = calculateStdDev(result);
const cpk = calculateCPK(mean, stdev, 90, 70);
console.log({mean, stdev, cpk})
//Cpk = Min[(USL - Mean) / (3σ), (Mean - LSL) / (3σ)]
//Cp = (USL - LSL) / (6σ)

//$xi = round($xi, 10);
//$xin = $xi/$jumlahData;
//$stddev = sqrt($xin);
//$l_mean = ($mean - $minimum)/(3*$stddev);
//$u_mean = ($maximum - $mean)/(3*$stddev);
//$cp = ($maximum - $minimum)/(6*$stddev);
//$cpk = min($l_mean, $u_mean);
