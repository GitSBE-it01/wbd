import { tableHeader } from '../../component/table.js';
import { jig_location_query } from '../../class.js';
import { loading } from './load.js';

document.addEventListener('click', async function(event) {
    if (event.target.getAttribute('id') === 'btnStock'){
        try {
            const filterId = document.getElementById('searchStock');
            const filter = filterId.value;
            if (filter === "") {
                filterId.placeholder = 'please choose item';
                return;                
            }
            const divStock = document.getElementById('divStock');
            divStock.appendChild(loading('loading1', 'loading'));
            const dataLoc = await jig_location_query.fetchDataFilter({item_jig: filter});
            console.log(dataLoc);

            // form utk input data dan show data saat ini
            const input = document.createElement('input');
            input.textContent = 'Tolerance';
            input.id ='tol';
            input.setAttribute('autocomplete', 'off');
            input.setAttribute('type', 'text');

            const arrayHeader = ['Location', 'Qty per unit', 'add/substract', 'Qty', 'Unit', 'Remark']
            await tableHeader('divStock', 'tableStock', arrayHeader);
            const table = document.getElementById('tableStock');

            for (let i=0; i<dataLoc.lenght; i++){
                const tr = document.createElement('div');
                tr.classList.add('fr', 'thCont');
                
                // location
                const input1 = document.createElement('input');
                input1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl9');
                input1.value = dataLoc[i].lokasi;
                input1.setAttribute('type','text');
                input1.id = 'input1'
                
                // qty per unit
                const input2 = document.createElement('input');
                input2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
                input2.value = dataLoc[i].qty_per_unit;
                input2.setAttribute('type','text');
                input2.id = 'input2'
                input2.setAttribute('readonly', 'readonly');
                
                // add/substract
                const input3 = document.createElement('select');
                input3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl9');
                const arr = ['tambah', 'kurang'];
                for (let i=0; i<arr.length; i++) {
                    const option = document.createElement('option');
                    option.value = arr[i];
                    option.textContent = arr[i];
                }
                input3.id = 'input3'
            
                // qty
                const input4 = document.createElement('input');
                input4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl9');
                input4.value = 0;
                input4.setAttribute('type','text');
                input4.id = 'input4'
            
                // unit
                const input5 = document.createElement('input');
                input5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl9');
                input5.value = dataLoc[i].unit;
                input5.setAttribute('type','text');
                input5.id = 'input5'
            
                // remark
                const input6 = document.createElement('input');
                input6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl9');
                input6.value = "-";
                input6.setAttribute('type','text');
                input6.id = 'input6'
            
                tr.appendChild(input1);
                tr.appendChild(input2);
                tr.appendChild(input3);
                tr.appendChild(input4);
                tr.appendChild(input5);
                tr.appendChild(input6);
                table.appendChild(tr);
                console.log(tr);
            }
            divStock.appendChild(table);
            divStock.removeChild(document.getElementById('loading1'));
        } catch (error) {
            console.log(error);
        }
    }
})


