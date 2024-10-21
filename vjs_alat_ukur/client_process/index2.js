import {DOM2} from '../../3.utility/new_DOM/index.js';
import {api_access} from '../../3.utility/index.js';

const apps = new DOM2();
const [user_list,loc_list, master] = await Promise.all([
  api_access('get','user',''),
  api_access('get','vjs_loc',''),
  api_access('get','vjs_alat', ''),
])
apps.dtbase['user_list'] = user_list;
apps.dtbase['loc_list'] = loc_list;
apps.dtbase['master'] = master;
apps.dtbase['vjs_hd'] = [];
apps.dtbase['vjs_log'] = [];

console.log(apps.dtbase);
apps.parse_dtlist([
  {
    id_dtlist:"alat_list",
    db: 'master',
    keyPick:["sn_id",
    "new_subcat",
    "no_asset",
    "_desc"]
  },
  {
    id_dtlist:"loc_list",
    db: 'loc_list',
    keyPick:["location"]
  },
  {
    id_dtlist:"user_list",
    db: 'user_list',
    keyPick:["Name","Position","Grade"]
  },
])

DOM2.class_toggle('#load', ['hidden']);


/* ===================================================================
  input__alat_search function
=================================================================== */
// show search bar with click button
apps.func(
  'click',
  '#open_dtlist',
  ()=>{
    DOM2.class_toggle('#input__alat_search', ['hidden'], false);
    document.querySelector('#input__alat_search').select();
    return;
  }
)

// toggle hidden and pick the first option value
apps.func(
  'focusout',
  '#input__alat_search',
  e=>{
    DOM2.class_toggle('#load', ['hidden'], false);
    const dtlist_id = e.target.getAttribute('list');
    const dtlist = document.querySelector(`#${dtlist_id}`);
    const option = dtlist.querySelectorAll('option');
    for (let i=0; i<option.length; i++) {
      if(option[i].value.toLowerCase().includes(e.target.value.toLowerCase())) {
        e.target.value = option[i].value;
        break;
      }
    }
    DOM2.class_toggle(e.target, ['hidden']);
    DOM2.class_toggle('#load', ['hidden']);
    return;
  }
)

// toggle hidden and pick the first option value
apps.func(
  'change',
  '#input__alat_search',
  async(e)=>{
    DOM2.class_toggle('#load', ['hidden'], false);
    const split = e.target.value.split("//");
    apps.dtshow['master'] = await apps.dtbase['master'].filter(obj=>obj.sn_id === split[0]);
    apps.parse_input('#detail_form', apps.dtshow['master']);
    const tbl = document.querySelector('#table_index');
    const tr = tbl.querySelectorAll('tbody tr');
    tr.forEach(dt=>{
      if(!dt.classList.contains('hidden')) {
        DOM2.class_toggle(dt, ['hidden']);
      }
    })
    apps.dtshow['table_main'] = await apps.dtbase['vjs_hd'].filter(obj=>obj.sn_id === split[0]);
    if(apps.dtshow['table_main'].length === 0) {
      const data= await api_access('fetch','vjs_hd', {sn_id: split[0]});
      data.forEach(dt=>{
        apps.dtbase['vjs_hd'].push(dt);
      })
      apps.dtshow['table_main'] = await apps.dtbase['vjs_hd'].filter(obj=>obj.sn_id === split[0]);
    }
    apps.parse_input('#table_index', apps.dtshow['table_main']);
    DOM2.class_toggle(e.target, ['hidden']);
    DOM2.class_toggle('#load', ['hidden']);
    return;
  }
)

/* ===================================================================
  input search function
=================================================================== */