import {DOM, api_access} from'../index.js';

export class ButtonDOM {
    static insert_row(button, template_tbl, tbl, counter) {
        let btn = '';
        if(button.nodeType) {
            btn = button;
        } else {
            btn = document.querySelector(button);
        }
        if(btn) {
            btn.addEventListener('click', function() {
                const target = document.querySelector(tbl);
                const tbody = target.querySelector('tbody')
                const table = document.querySelector(template_tbl);
                const tbodyRow = table.querySelector('tbody');
                const row_dt = tbodyRow.querySelector('tr');
                const new_row = row_dt.cloneNode(true);
                new_row.setAttribute('data-id', `new__${tbl}${counter}`);
                new_row.setAttribute('data-change', `new`);
                const td = new_row.querySelectorAll('td');
                td.forEach(dt=>{
                    if(dt.hasAttribute('data-field')) {
                        if(dt.querySelectorAll('INPUT').length>0) {
                            const input = dt.querySelectorAll("INPUT");
                            for(let i=0; i<input.length; i++) {
                                input[i].id = input[i].id+"__new";
                            }
                        }
                        if(dt.querySelectorAll('LABEL').length>0) {
                            const label = dt.querySelectorAll("LABEL");
                            for(let i=0; i<label.length; i++) {
                                let old = label[i].getAttribute('for');
                                label[i].setAttribute('for',old+"__new");
                            }
                        }
                        if(dt.querySelectorAll('BUTTON').length>0) {
                            const button = dt.querySelectorAll("BUTTON");
                            for(let i=0; i<button.length; i++) {
                                button[i].id = button[i].getAttribute('data-method')+"__"+counter+"__new";
                            }
                        }
                    }
                })
                tbody.insertBefore(new_row,tbody.rows[0]);
                return;
            })
        }
        return;
    }

    static show_hidden(button, target) {
        let btn = '';
        if(button.nodeType) {
            btn = button;
        } else {
            btn = document.querySelector(button);
        }
        if(btn) {
            btn.addEventListener('click', function() {
                const trgt = document.querySelectorAll(target);
                trgt.forEach(dt=>{
                    dt.classList.toggle('hidden');
                })        
            })
        }
    }

    static async delete_data_table(button, model, primary) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute('data-method') === 'delete') {
                let btn = '';
                if(button.nodeType) {
                    btn = button;
                } else {
                    btn = document.querySelector(button);
                }
                if(btn) {
                    DOM.rmv_class('#load',"hidden");
                    const td = event.target.closest('td');
                    console.log(td);
                    const tr = td.closest('tr');
                    console.log({tr, td});
                    if(tr.getAttribute('data-change') === 'change') {
                        const result = await DOM.delete_data(tr, model, primary);
                        if(!result.includes('fail')) {
                        alert ('data deleted');
                        location.reload();
                        }
                        DOM.add_class('#load',"hidden");
                        return;
                    };
                    if(tr.getAttribute('data-change') === 'new') {
                        tr.remove();
                        DOM.add_class('#load',"hidden");
                        return;
                    };
                }
            }
        })
    }

    static async submit_dataset_table(button,table, model) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute('data-method') === 'submit') {
                let btn = '';
                if(button.nodeType) {
                    btn = button;
                } else {
                    btn = document.querySelector(button);
                }
                let tbl = '';
                if(table.nodeType) {
                    tbl = table;
                } else {
                    tbl = document.querySelector(table);
                }
                if(btn && tbl) {
                    DOM.rmv_class('#load',"hidden");
                    let update =[];
                    let insert =[];
                    const tr = tbl.querySelectorAll('tr');
                    tr.forEach(dt=>{
                        if(dt.getAttribute('data-change') === 'change') {
                            let data = {};
                            const name = dt.querySelectorAll('[name]');
                            name.forEach(d2=>{
                                data[d2.getAttribute('name')] = d2.value;
                            })
                            update.push(data);
                        };
                        if(dt.getAttribute('data-change') === 'new') {
                            let data = {};
                            const name = dt.querySelectorAll('[name]');
                            name.forEach(d2=>{
                                data[d2.getAttribute('name')] = d2.value;
                            })
                            insert.push(data);
                        };
                    }) 

                    console.log({update, insert});
                    let msg ='';
                    if(update.length>0) {
                        let result1 = await api_access('update',model, update);
                        if(result1.includes('fail')) {
                            msg += 'update data gagal';
                        } else {
                            msg += update.length + 'data di update';
                        }
                    }

                    if(insert.length>0) {
                        let result2 = await api_access('insert',model, insert);
                        if(result2.includes('fail')) {
                            msg += ' insert data gagal';
                        } else {
                            msg += insert.length + ' data di insert';
                        }
                    }
                    alert (msg);
                    DOM.add_class('#load',"hidden");
                    location.reload();
                    return;
                }
            }
        })
    }
}

    