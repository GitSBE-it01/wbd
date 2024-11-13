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
        const inp_val = document.querySelector('#main_track_search');
        const splt = inp_val.value.split('//');
        const dt_db = await api_access('fetch', 'id_tracker', {id_parent:splt[0]});
        dt_db.sort((a, b) => {
            if (a.added !== b.added) {
              return b.added - a.added;
            }
          });
        main.view_init({type:'table',main_id:'tracker', data:dt_db, filter:splt[0]});
        main.load_toggle();
    }
)
//tracker.view_init({type:'table',main_id:'tracker', data:master});
