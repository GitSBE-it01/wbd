import {DOM2} from '../../3.utility/new_DOM/index.js';
import {api_access, DOM, GeneralDOM, DtlistDOM, NavDOM} from '../../3.utility/index.js';

const apps = new DOM2();
const [user_list,
   loc_list, master] = await Promise.all([
  api_access('get','user',''),
  api_access('get','vjs_loc',''),
  api_access('get','vjs_alat', ''),
])
apps.dtbase['user_list'] = user_list;
apps.dtbase['loc_list'] = loc_list;
apps.dtbase['master'] = master;
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
    DOM2.class_toggle('#load', ['hidden']);
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
    DOM2.class_toggle('#load', ['hidden'], true);
    return;
  }
)

/* ===================================================================
  input search function
=================================================================== */