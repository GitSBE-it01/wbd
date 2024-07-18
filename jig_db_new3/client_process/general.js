import {api_access} from '../../3.utility/index.js';

export let master = await api_access('get','jig_mstr', '');
export let loc = await api_access('get','jig_loc', '');


const gabungan = {};
loc.forEach(dt=>{
  if(gabungan[dt.item_jig]) {
    gabungan[dt.item_jig]['qty_total'] += parseInt(dt.qty_per_unit);
  } else {
    const data = {
      ...dt,
      qty_total: parseInt(dt.qty_per_unit)
    }
    gabungan[dt.item_jig] = data;
  }
})

master.forEach(dt=>{
  const fltr = dt.item_jig+ "--"+
    dt.desc_jig+ "--"+
    dt.status_jig+ "--"+
    dt.material+ "--"+
    dt.type+ "--"+
    dt.drawing;
  const qty = gabungan[dt.item_jig] ? gabungan[dt.item_jig].qty_total :0;
  dt['filter'] = fltr;
  dt['qty'] = qty;
})
