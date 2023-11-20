import { tableHeader, tblUpdLoc, tblHistLoc } from './table.js';
import { btnUpdLoc, addNewStock } from './button.js';
import { jig_location_query, log_location_query } from '../../class.js';
import { loading } from './load.js';
import { updateInsertData } from './updateInsert.js';
import { delChild } from '../../component/process.js';


export const stockUpdate = async() => {
    try {
        if (document.getElementById('newContain')) {
            document.getElementById('newContain').remove(document.getElementById('newContain').firstChild)
        }
        const filterId = document.getElementById('searchStock');
        const filter = filterId.value;
        if (filter === "") {
            filterId.placeholder = 'please choose item';
            return;                
        }
        const dataDiv = document.getElementById('divStock');
        const newContain = document.createElement('div');
        newContain.id= 'newContain';
        dataDiv.appendChild(newContain);
        newContain.appendChild(loading('loading1', 'loading'));

        const dataLoc = await jig_location_query.fetchDataFilter({item_jig: filter});

        // form utk input data dan show data saat ini
        const arrayHeader = ['Location', 'Qty per unit', 'add/substract', 'Qty', 'Unit', 'Remark']
        await tableHeader('newContain', 'tableStock', arrayHeader);
        newContain.appendChild(await tblUpdLoc('tableStock',dataLoc));
        const table = document.getElementById('tableStock');

        const historyTitle = document.createElement('div');
        historyTitle.classList.add('fs-l', 'fc-w', 'cap', 'mt4', 'pl4', 'pv2','sl3');
        historyTitle.textContent = 'History Log';
        const dataHist = await log_location_query.fetchDataFilter({item_jig: filter});

        newContain.removeChild(document.getElementById('loading1'));
        newContain.appendChild(table);
        newContain.appendChild(await btnUpdLoc());
        const btnAddLoc = document.getElementById('addLoc');
        let counter = 0;
        btnAddLoc.addEventListener('click', async function() {
            table.appendChild(await addNewStock(counter));
            counter++;
        })
        const btnDelLoc = document.getElementById('delLoc');
        btnDelLoc.addEventListener('click', function () {
            const cek = document.getElementById('tableStock');
            const cek2 = cek.lastChild;
            if (!cek2.hasAttribute('data-fromdb')){
                delChild('tableStock');
                return;
            }
            alert('row tidak bisa di hapus');
        })
        const btnData = document.getElementById('updLoc');
        btnData.addEventListener('click', async function() {
            try {
                btnData.textContent="";
                btnData.classList.add('proses');
                btnData.disabled = true;
                await updateInsertData();
                btnData.classList.remove('proses');
                btnData.textContent="update";
                btnData.disabled = false;
            }catch(error){
                console.log(error);
            }
        })
        newContain.appendChild(historyTitle);
        newContain.appendChild(await tblHistLoc(dataHist));
    } catch (error) {
        console.log(error);
    }
}




