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
                new_row.setAttribute('data-id', `new__${tbl}__${counter}`);
                new_row.setAttribute('data-change', `new`);
                const name = new_row.querySelectorAll('[name]');
                name.forEach(dt=>{
                    if(dt.tagName === 'INPUT' || dt.tagName === 'SELECT') {
                        const name = dt.getAttribute('name');
                        let td = '';
                        if(dt.disabled) {dt.disabled = false;}
                        if(dt.closest('td') !== null) {
                            td = dt.closest('td');
                            const label = td.querySelector('label');
                            if(dt.hasAttribute('id')) {
                                dt.id = `${name}__${target.id}__new__${counter}`;
                                label.setAttribute('for', `${name}__${target.id}__new__${counter}`)
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
                    const tr = td.closest('tr');
                    if(tr.getAttribute('data-change') === 'new') {
                        tr.remove();
                        DOM.add_class('#load',"hidden");
                        return;
                    };
                    if(tr.querySelector(`[name ="${primary}"]`) !== null) {
                        const result = await DOM.delete_data(tr, model, primary);
                        if(!result.includes('fail')) {
                            alert ('data deleted');
                            location.reload();
                        }
                    }
                    DOM.add_class('#load',"hidden");
                    return false;
                }
            }
        })
    }

    static async delete_dataset_table(button,table, model) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute('data-method') === 'delete') {
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
                    let del =[];
                    const tr = tbl.querySelectorAll('tr');
                    tr.forEach(dt=>{
                           if(dt.getAttribute('data-change') === 'del') {
                            let data = {};
                            const name = dt.querySelectorAll('[name]');
                            name.forEach(d2=>{
                                data[d2.getAttribute('name')] = d2.value;
                            })
                            insert.push(data);
                        };
                    }) 
                    console.log({del});
                    let msg ='';
                    if(del.length>0) {
                        let result2 = await api_access('delete',model, insert);
                        if(result2.includes('fail')) {
                            msg += ' Hapus data gagal';
                        } else {
                            msg += insert.length + ' data di hapus';
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

    static async submit_dataset_and_log_table(button,table, model) {
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
                        let result1 = await api_access('update',model[0], update);
                        if(result1.includes('fail')) {
                            msg += 'update data gagal';
                        } else {
                            let result3 = await api_access('insert',model[1], update);
                            msg += update.length + 'data di update';
                        }
                    }

                    if(insert.length>0) {
                        let result2 = await api_access('insert',model[0], insert);
                        if(result2.includes('fail')) {
                            msg += ' insert data gagal';
                        } else {
                            let result4 = await api_access('insert',model[1], insert);
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

    static check_valid_input(source) {
        let src = '';
        if(source.nodeType) {
            src = source;
        } else {
            src = document.querySelector(source);
        }
        if(src) {
            src.addEventListener('click', function(event){
                event.preventDefault();
                let valid = src.checkValidity();
                if(!valid) {
                    src.reportValidity();
                } else {
                    event.target.click();
                }
                return;
            })
        }
    }

    static enter_keydown(button, source) {
        let btn = '';
        if(button.nodeType) {
            btn = button;
        } else {
            btn = document.querySelector(button);
        }
        let src = '';
        if(source.nodeType) {
            src = source;
        } else {
            src = document.querySelector(source);
        }
        if(btn && src) {
            src.addEventListener('keydown', function(event){
                if(event.key === 'Enter') {
                    btn.click();
                    return;
                }
            })
        }
    }

    static dl_excel_dt(button, filename, ...data) {
        let btn = '';
        if(button.nodeType) {
            btn = button;
        } else {
            btn = document.querySelector(button);
        }
        if(btn) {
            btn.addEventListener('click', function(){
                DOM.rmv_class('#load',"hidden");
                const workbook = XLSX.utils.book_new();
                for( let i=0; i<data.length; i++) {
                    const worksheet = XLSX.utils.json_to_sheet(data[i]);
                    XLSX.utils.book_append_sheet(workbook, worksheet, 'data'+i);
                }
                XLSX.writeFile(workbook, filename+'.xlsx')
                DOM.add_class('#load',"hidden");
                return;
            })
        }
    }

    static dl_excel_dt2(button, filename, table) {
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
            btn.addEventListener('click', function(){
                DOM.rmv_class('#load',"hidden");
                let data =[];
                let tr = tbl.querySelectorAll('tr');
                tr.forEach(dt=>{
                    const td = dt.querySelectorAll('[name]');
                    let row = {};
                    td.forEach(d2=>{
                        const field = d2.getAttribute('name');
                        if(d2.tagName === 'INPUT' || d2.tagName === 'SELECT') {
                            row[`${field}`] = d2.value;
                        } else {
                            row[`${field}`] = d2.textContent;
                        }
                    })
                    data.push(row);
                })
                const workbook = XLSX.utils.book_new();
                const worksheet = XLSX.utils.json_to_sheet(data);
                XLSX.utils.book_append_sheet(workbook, worksheet, 'data');
                XLSX.writeFile(workbook, filename+'.xlsx')
                DOM.add_class('#load',"hidden");
                return;
            })
        }
    }

    static edit_form_button(edit_key, sbmt_key, form_key, btn_class, inp_class) {
        let btn = '';
        if(sbmt_key.nodeType) {
            btn = sbmt_key;
        } else {
            btn = document.querySelector(sbmt_key);
        }
        let btn2 = '';
        if(edit_key.nodeType) {
            btn2 = edit_key;
        } else {
            btn2 = document.querySelector(edit_key);
        }
        let frm = '';
        if(form_key.nodeType) {
            frm = form_key;
        } else {
            frm = document.querySelector(form_key);
        }
        if(btn && frm && btn2) {
            btn2.addEventListener('click', function() {
                const input = frm.querySelectorAll('[name]');
                input.forEach(dt=>{
                    inp_class.forEach(d2=>{
                        dt.classList.toggle(d2)
                    })
                    if(dt.disabled === true) {
                        dt.disabled = false;
                    } else {
                        dt.disabled = true;
                    }
                })
                btn_class.forEach(dt=>{
                    btn.classList.toggle(dt);
                })
                btn.setAttribute('data-method','submit');
                if(btn.disabled === true) {
                    btn.disabled = false;
                } else {
                    btn.disabled = true;
                }
                return;
            })
        }
    }

    static async submit_dataset_form(button,form, model) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute('data-method') === 'submit') {
                let btn = '';
                if(button.nodeType) {
                    btn = button;
                } else {
                    btn = document.querySelector(button);
                }
                let frm = '';
                if(form.nodeType) {
                    frm = form;
                } else {
                    frm = document.querySelector(form);
                }
                if(btn && frm) {
                    DOM.rmv_class('#load',"hidden");
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
            }
        })
    }

    static async submit_dataset_and_log_form(button,form, model) {
        document.addEventListener('click', async function(event) {
            if(event.target.getAttribute('data-method') === 'submit') {
                let btn = '';
                if(button.nodeType) {
                    btn = button;
                } else {
                    btn = document.querySelector(button);
                }
                let frm = '';
                if(form.nodeType) {
                    frm = form;
                } else {
                    frm = document.querySelector(form);
                }
                if(btn && frm) {
                    DOM.rmv_class('#load',"hidden");
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
                        let result1 = await api_access('update',model[0], update);
                        if(result1.includes('fail')) {
                            msg += 'update data gagal';
                        } else {
                            let result2 = await api_access('insert',model[1], update);
                            msg += update.length + 'data di update';
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

    