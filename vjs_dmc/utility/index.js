import { inpDMCProcess } from "./data/input.js";

document.addEventListener ('click', function(event) {
    if(event.target.getAttribute('id') === 'dmcInput'){
        const form = document.getElementById('mainDMC');
        const element = form.querySelectorAll('[data-cell^="input_value"]');
        let isValid = true;
        let decision = 'OK';
        element.forEach( el=> {
            if (el.value !== 'OK' && el.value !== 'NG') {
                isValid = false;
            };
            if (el.value === 'NG') {
                decision = 'NG';
            } 
        })
        
        if (!isValid) {
            alert('data harap di lengkapi');
        } else{
            const btn = document.getElementById('dmcInput');
            btn.disabled = true;
            const element2 = form.querySelectorAll('[data-cell]');
            const valueSearch = document.getElementById('test1');
            let data = [];
            data['decs'] = [decision];
            data['srch'] = [];
            data['srch'].push(valueSearch.value);
            element2.forEach( el2=> {
                const dataField = el2.getAttribute('data-cell');
                const field = dataField.split('__');
                if (!data[field[0]]) {
                    data[field[0]] = [];
                }

                if(el2.tagName === 'SELECT') {
                    data[field[0]].push(el2.value);
                } else {
                    data[field[0]].push(el2.textContent);
                }
            })
            inpDMCProcess(data);
        }
        return;
    }

    if(event.target.getAttribute('id') === 'dmcEdit'){
        const btnCek = document.getElementById('dmcInput');
        if(btnCek.disabled) {
            btnCek.disabled = false;
        }
        return;
    }

    if(event.target.getAttribute('id') === 'dmcDiv'){
        const btnOpen = document.getElementById('mainDMC');
        if(btnOpen.classList.contains('displayHide')) {
            return btnOpen.classList.remove('displayHide');
        }
        return btnOpen.classList.add('displayHide');;
    }
})
