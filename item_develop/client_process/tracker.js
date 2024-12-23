import {api_access, DOM, GeneralDOM, TableDOM, DtlistDOM, NavDOM, ButtonDOM, InputDOM, currentDate} from '../../3.utility/index.js';
import {DOM2} from '../../3.utility/new_DOM/index.js';

const main = new DOM2();
const list_item_dev = await api_access('fetch', 'id_mstr', {status:'open'});
const user_list = await api_access('get','user','');
main.view_init({type:'datalist', main_id:'users', data:user_list, dtlist_key:['Absensi','Name','Departement']});
main.view_init({type:'datalist',main_id:'tracker', data:list_item_dev, dtlist_key: ['id','item_number', 'desc1', 'desc2']});
const user_detail = JSON.parse(sessionStorage.getItem('userData'));
const user = user_detail['name'] + "--" + user_detail['jabatan']+'--'+ user_detail['grade'];
main.load_toggle();

main.func(
    'click',
    '#main_track_search_btn',
    async()=>{
        main.load_toggle();
        main.table_clear('tracker');
        const inp_val = document.querySelector('#main_track_search');
        inp_val.disabled = true;
        const add_btn = document.querySelector('#tracker_add_btn');
        const dl_btn = document.querySelector('#tracker_dl_btn');
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
          const data_search = list_item_dev.find(obj=>obj.item_number === splt[1])
          main.new_row_default_value({
            id_parent: splt[0],
            item_number: splt[1],
            desc_: splt[2]+" "+splt[3],
            site: data_search['item_site'],
            by_: user,
            added: currentDate('-'),
            last_mod: currentDate('-'),
          }, 
          main.dtbase[`detail__tracker_${splt[0]}`]);
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
        inp_val.disabled = false;
        main.load_toggle();
    }
)

main.func(
    'keyup',
    '#main_track_search',
    async(e)=>{
      if(e.key ==='Enter') {
        const btn = document.querySelector('#main_track_search_btn');
        btn.click();
      }
    }
)

main.func(
    'click',
    '#tracker_submit_btn',
    async(e)=>{
      main.load_toggle();
      const table = document.querySelector('#tracker_table');
      const tr = table.querySelectorAll('tbody tr');
      let insert = [];
      let update = []
      tr.forEach(dt=>{
        if(dt.hasAttribute('data-change')){
          const data = {};
          if(dt.getAttribute('data-change') === 'new') {
            const td = dt.querySelectorAll('[name]');
            td.forEach(dd=>{
              const name = dd.getAttribute('name');
              data[`${name}`] = dd.value;
            })
            insert.push(data);
          }
          if(dt.getAttribute('data-change') === 'change') {
            const td = dt.querySelectorAll('[name]');
            td.forEach(dd=>{
              const name = dd.getAttribute('name');
              data[`${name}`] = dd.value;
            })
            update.push(data);
          }
        }
      })
      console.log({insert, update});
      let msg = '';
      if(insert.length>0) {
        const result = await api_access('insert', 'id_tracker', insert);
        if(result.includes('fail')) {
          msg += 'data gagal di masukkan ';
        } else {
          msg += 'data berhasil insert sebanyak '+insert.length;
        }
      }
      if(update.length>0) {
        const result = await api_access('update', 'id_tracker', update);
        if(result.includes('fail')) {
          msg += 'data gagal di update ';
        } else {
          msg += 'data berhasil update sebanyak '+update.length;
        }
      }
      main.load_toggle();
      return
    }
)


