import {api_access, DOM, GeneralDOM, TableDOM2, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, globalEvent,calculateMean, calculateStdDev, calculateCPK,calculateCP, checkRange} from '../../3.utility/index.js';
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
console.log({nt_hd});
let data_all = [];
let counter = 0;
for(let i=0; i<nt_hd.length; i++) {
  const dt = nt_hd[i];
  const id_fltr = dt['id'];
  const nt_dt = await api_access('fetch', 'nt_data', {hd_code: id_fltr});
  nt_dt.sort((a,b)=>{
    a.no_repeat - b.no_repeat
  })
  data_all[`${dt['measure']}`]={};
  data_all[`${dt['measure']}`]['data']=nt_dt;
  data_all[`${dt['measure']}`]['max']=dt['std_max'];
  data_all[`${dt['measure']}`]['min']=dt['std_min'];
}
console.log({data_all});

const keys = Object.keys(data_all);
let max = 0;
keys.forEach(dt=>{
  const ky = data_all[dt];
  const count = ky['data'].length-1;
  if(ky['data'][count]['no_repeat']> max) {
    max= ky['data'][count]['no_repeat']
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
    const data2 = data_all[dt['measure']]['data'].find(obj=>obj.no_repeat === ii);
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

// data
const graph_name = 'Gauss';
console.log(graph_name);
const result = [];
console.log(data_all[`${graph_name}`]['data'])
data_all[`${graph_name}`]['data'].forEach(dt=>{
  result.push(dt.result);
})
console.log({result});
console.log( Math.min(...result))
console.log( Math.max(...result))
const usl = data_all[`${graph_name}`]['max'];
const lsl = data_all[`${graph_name}`]['min'];
const mean = calculateMean(result);
const mid = (usl +lsl) /2;
const stdev = calculateStdDev(result, mean);
const cp = calculateCP(stdev, usl, lsl);
const cpk = calculateCPK(mean, stdev, usl, lsl);
const range = checkRange(usl, lsl);
console.log({mean, stdev, cp, cpk, range})

const graph_dt = [];
let temp_dt = 0;
let max_normal_distribution =0;
for(let i=0; i<20; i++) {
  if(i===0) {
    temp_dt = mean - (stdev*3.5);
  } else {
    temp_dt = temp_dt + 7 * stdev/20;
  }
  let v1 = stdev * Math.sqrt(2*3.1416);
  let normal_distribution = 0;
  if(v1 !== 0){
    normal_distribution = Math.pow(2.7183, (-1 * Math.pow((temp_dt - mean), 2) / (2 * Math.pow(stdev, 2)))) / (stdev * Math.sqrt(2 * 3.1416));
  }
  if (normal_distribution > max_normal_distribution) {
    max_normal_distribution = normal_distribution;
  } 
  graph_dt.push({x:parseFloat(temp_dt.toFixed(range)),y:normal_distribution});
}
console.log({graph_dt});

// Prepare data for Chart.js
const data2 = {
    datasets: [
        {
            label: 'Capability Graphic',
            data: graph_dt,
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
        },
        {
          label: 'USL',
          data: [{x:usl, y:(max_normal_distribution*1.2)}],
          type: 'bar',
          borderColor: 'red',
          borderWidth: 1,
          barThickness: 1,
          fill: false,
        },
        {
          label: 'LSL',
          data: [{x:lsl, y:(max_normal_distribution*1.2)}],
          type: 'bar',
          borderColor: 'red',
          borderWidth: 1,
          barThickness: 1,
          fill: false,
        },
        {
          label: 'Mean',
          data: [{x:mid, y:(max_normal_distribution*1.2)}],
          type: 'bar',
          borderColor: 'red',
          borderWidth: 1,
          barThickness: 1,
          fill: false,
        },
    ],
};

const config = {
    type: 'line',
    data: data2,
    options: {
        scales: {
            x: {
                type: 'linear',
                beginAtZero: true,
                min: 7500,
                max: 12000,
                ticks: {
                  stepSize: 200, // Increment by 1
                  callback: function(value) {
                      return value; // Label the ticks with the value
                  }
              },
                title: {
                    display: true,
                    text: 'Process Output'
                }
            },
            y: {
                type: 'linear',
                beginAtZero: true,
                max: 0.01,
                ticks: {
                  stepSize: 0.001, // Increment by 1
                  callback: function(value) {
                      return value; // Label the ticks with the value
                  }
              },
                title: {
                    display: true,
                    text: 'Frequency'
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: `Process Capability (CP = ${cp}, CPK = ${cpk})`
            }
        }
    }
};

// Render the chart
const cpChart = new Chart(
    document.getElementById('cpChart'),
    config
);
