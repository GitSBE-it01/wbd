import {DOM, api_access} from'../index.js';

export class InputDOM {
    static input_validity(inputKey) {
        let inp = '';
        if(inputKey.nodeType) {
            inp = inputKey;
        } else {
            inp = document.querySelector(inputKey);
        }
        if(inp && inp.hasAttribute('list')) {
            inp.addEventListener('keydown', function(event){
                if(event.key !== 'Enter') {
                    let valid = false;
                    let dtlist = document.querySelector(`#${inp.getAttribute('list')}`);
                    let opt = dtlist.querySelectorAll('option');
                    for( let i=0; i<opt.length; i++) {
                        if(opt[i].value.includes(event.target.value)) {
                            valid = true;
                            break;
                        }
                    }
                    if(!valid) {
                        inp.setCustomValidity("Data tidak termasuk dalam list");
                        inp.reportValidity();
                    } else {
                        inp.setCustomValidity("");
                        inp.reportValidity();
                    }
                    return;
                }
            })
            inp.addEventListener('change', function(event){
                let valid = false;
                let dtlist = document.querySelector(`#${inp.getAttribute('list')}`);
                let opt = dtlist.querySelectorAll('option');
                for( let i=0; i<opt.length; i++) {
                    if(opt[i].value.includes(event.target.value)) {
                        valid = true;
                        break;
                    }
                }
                if(!valid) {
                    inp.setCustomValidity("Data tidak termasuk dalam list");
                    inp.reportValidity();
                } else {
                    inp.setCustomValidity("");
                    inp.reportValidity();
                }
                return;
            })

        }
    }

    static async form_parse_data(form_key, data) {
        let form = '';
        if(form_key.nodeType) {
            form = form_key;
        } else {
            form = document.querySelector(form_key);
        }
        const field = form.querySelectorAll('[name]')
        field.forEach(dt=>{
            const fld_name = dt.getAttribute('name');
            dt.value = data[0][`${fld_name}`];
            if(data[0][`${fld_name}`] === undefined){
                dt.value = '';
            }
        })
        return;
    }
    
    static submit_change_style_table(table_key, button_key) {
        let tbl = '';
        if(table_key.nodeType) {
            tbl = table_key;
        } else {
            tbl = document.querySelector(table_key);
        }
        let btn = '';
        if(button_key.nodeType) {
            btn = button_key;
        } else {
            btn = document.querySelector(button_key);
        }
        if(tbl && btn) {
          tbl.addEventListener('change', function(event) {
            if(event.target.hasAttribute('name')) {
                const td = event.target.closest('td');
                const tr = td.closest('tr');
                if(!tr.hasAttribute('data-change') && tr.getAttribute('data-change') !== 'new' && event.target.getAttribute('data-current') !== event.target.value) {
                    tr.setAttribute('data-change', 'change');
                    DOM.add_class(btn, 'font-bold', 'bg-red-400');
                    DOM.rmv_class(btn, 'bg-gray-300', 'text-slate-200');
                    DOM.rmv_attr(btn, 'disabled');
                    DOM.set_attr(btn, 'data-method', 'submit');
                    return;
              }
              const table = tr.closest('table');
              const tr_all = table.querySelectorAll('tr');
              let valid = false;
              tr_all.forEach(dt=>{
                  if(dt.hasAttribute('data-change')) {
                      valid = true;
                  }
              })
              if(!valid) {
                  DOM.rmv_class(btn, 'font-bold', 'bg-red-400');
                  DOM.add_class(btn, 'bg-gray-300', 'text-slate-200');
                  DOM.set_attr(btn, 'disabled', 'true');
                  DOM.rmv_attr(btn, 'data-method');
              }
            }
        })
        }
        return;
      }

      
    static async dbprocess_dataset_form(form, model) {
        DOM.rmv_class('#load',"hidden");
        const frm = form.nodeType === true ? form : document.querySelector(form);
        let update =[];
        const name = frm.querySelectorAll('[name]');
        let data ={};
        name.forEach(dt=>{
            data[dt.getAttribute('name')] = dt.value;
        })
        update.push(data);

        console.log({update});
        let msg ='';
        if(update.length>0) {
            let result1 = await api_access('update',model, update);
            if(result1.includes('fail')) {
                msg += 'update data gagal';
            } else {
                msg += update.length + 'data di update';
            }
        }
        alert (msg);
        DOM.add_class('#load',"hidden");
        location.reload();
        return;
    }

    static async update_data_table(button, model) {
        DOM.rmv_class('#load',"hidden");
        console.log(button.nodeType);
        const btn = button.nodeType ? button : document.querySelector(button);
        let update =[];
        const td = btn.closest('td');
        const tr = td.closest('tr');
        const name = tr.querySelectorAll('[name]');
        let data ={};
        name.forEach(d2=>{
            data[d2.getAttribute('name')] = d2.value;
        })
        update.push(data);

        let msg ='';
        if(update.length>0) {
            let result1 = await api_access('update',model, update);
            if(result1.includes('fail')) {
                msg += 'update data gagal';
            } else {
                msg += update.length + 'data di update';
            }
        }

        alert (msg);
        DOM.add_class('#load',"hidden");
        //location.reload();
        return;
    }

}