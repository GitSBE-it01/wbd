import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';

const main = new DOM2();
const list_item_dev = await api_access('fetch', 'id_mstr', {status:'open'});
main.view_init({type:'datalist',main_id:'tracker', data:list_item_dev, dtlist_key: ['id','item_number', 'desc1', 'desc2']});
main.load_toggle();

main.func(
    'click',
    '#main_track_search_btn',
    async()=>{
        main.load_toggle();
        main.table_clear('tracker');
        const add_btn = document.querySelector('#tracker_add_btn');
        const dl_btn = document.querySelector('#tracker_dl_btn');
        const inp_val = document.querySelector('#main_track_search');
        if(inp_val.value !=='') {
          if(add_btn.disabled === true) {
            add_btn.disabled = false;
            add_btn.classList.add('hover:font-semibold')
            add_btn.classList.remove('text-white')
          }
          if(dl_btn.disabled === true) {
            dl_btn.disabled = false;
            dl_btn.classList.add('hover:font-semibold')
            dl_btn.classList.remove('text-white')
          }
          const splt = inp_val.value.split('//');
          const dt_db = await api_access('fetch', 'id_tracker', {id_parent:splt[0]});
          dt_db.sort((a, b) => {
              if (a.added !== b.added) {
                return b.added - a.added;
              }
            });
          main.view_init({type:'table',main_id:'tracker', data:dt_db, filter:splt[0]});
        } else {
          if(add_btn.disabled === false) {
            add_btn.disabled = true;
            add_btn.classList.remove('hover:font-semibold')
            add_btn.classList.add('text-white')
          }
          if(dl_btn.disabled === false) {
            dl_btn.disabled = true;
            dl_btn.classList.remove('hover:font-semibold')
            dl_btn.classList.add('text-white')
          }
        }
        main.load_toggle();
    }
)
