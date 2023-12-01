import { tableHeader, tblUpdLoc, tblHistLoc, tblUpdJig, tblHistJig, tblUpdType, tblHistType } from './table.js';
import { btnUpdLoc, addNewStock, btnUpdJig, addNewType, btnUpdType } from './button.js';
import { jig_location_query, log_location_query, jig_master_query, log_master_query, jig_function_query, log_function_query, item_detail_query  } from '../../class.js';
import { loading } from '../../component/load.js';
import { updateInsertData, updateInsertJig, updateInsertType } from './updateInsert.js';
import { delChild, splitCustomString } from '../../component/process.js';


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
        const arrayHeader = ['Location', 'Qty per unit', 'add/substract', 'Qty', 'Unit', 'Remark', 'delete']
        await tableHeader('newContain', 'tableStock', arrayHeader);
        newContain.appendChild(await tblUpdLoc('tableStock',dataLoc));
        const table = document.getElementById('tableStock');

        const historyTitle = document.createElement('div');
        historyTitle.classList.add('fs-l', 'fc-w', 'cap', 'mt4', 'pl4', 'pv2','sl3');
        historyTitle.textContent = 'History Log';
        const dataHist = await log_location_query.fetchDataFilter({item_jig: filter});

        newContain.removeChild(document.getElementById('loading1'));
        newContain.appendChild(table);
        newContain.appendChild(await btnUpdLoc('updLoc', 'delLoc', 'addLoc'));
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

export const dataUpdate = async() => {
    try {
        if (document.getElementById('dataContain')) {
            document.getElementById('dataContain').remove(document.getElementById('dataContain').firstChild)
        }
        const filterId = document.getElementById('searchJig');
        const filter = filterId.value;
        if (filter === "") {
            filterId.placeholder = 'please choose item';
            return;                
        }
        const dataDiv = document.getElementById('divJig');
        const dataContain = document.createElement('div');
        dataContain.id= 'dataContain';
        dataDiv.appendChild(dataContain);
        dataContain.appendChild(loading('loading1', 'loading'));

        const data = await jig_master_query.fetchDataFilter({item_jig: filter});

        // form utk input data dan show data saat ini
        await tblUpdJig('dataContain', data);
        //const table = document.getElementById('tableJig');

        const historyTitle = document.createElement('div');
        historyTitle.classList.add('fs-l', 'fc-w', 'cap', 'mt4', 'pl4', 'pv2','sl3');
        historyTitle.textContent = 'History Log';
        const dataHist = await log_master_query.fetchDataFilter({item_jig: filter});

        dataContain.removeChild(document.getElementById('loading1'));
        //dataContain.appendChild(table);
        dataContain.appendChild(await btnUpdJig());
        const btnEdtJig = document.getElementById('editJig');
        btnEdtJig.addEventListener('click', function () {
            const cek = document.querySelectorAll('[data-updJig]');
            cek.forEach((obj) => {
                obj.disabled =false;
                obj.classList.remove('sl4', 'fc-w');
            }) 
        })
        const btnData = document.getElementById('updJig');
        btnData.addEventListener('click', async function() {
            try {
                btnData.textContent="";
                btnData.classList.add('proses');
                btnData.disabled = true;
                await updateInsertJig();
                btnData.classList.remove('proses');
                btnData.textContent="update";
                btnData.disabled = false;
            }catch(error){
                console.log(error);
            }
        })
        dataContain.appendChild(historyTitle);
        dataContain.appendChild(await tblHistJig(dataHist));
    } catch (error) {
        console.log(error);
    }
}


export const typeUpdate = async() => {
    try {
        if (document.getElementById('typeContain')) {
            document.getElementById('typeContain').remove(document.getElementById('typeContain').firstChild)
        }
        const filterId = document.getElementById('searchType');
        const filter = filterId.value;
        if (filter === "") {
            filterId.placeholder = 'please choose item';
            return;                
        }
        const dataDiv = document.getElementById('divType');
        const typeContain = document.createElement('div');
        typeContain.id= 'typeContain';
        dataDiv.appendChild(typeContain);
        typeContain.appendChild(loading('loading1', 'loading'));

        const data = await jig_function_query.fetchDataFilter({item_type: filter});
        const data2 = await item_detail_query.fetchDataFilter({pt_part: filter});

        // form utk input data dan show data saat ini
        const arrayHeader = ['item number jig', 'ops put on', 'ops pull out', 'status jig', 'Remark', 'delete']
        await tableHeader('typeContain', 'tableType', arrayHeader);
        typeContain.appendChild(await tblUpdType('tableType',data, data2));
        const table = document.getElementById('tableType');

        const historyTitle = document.createElement('div');
        historyTitle.classList.add('fs-l', 'fc-w', 'cap', 'mt4', 'pl4', 'pv2','sl3');
        historyTitle.textContent = 'History Log';
        const dataHist = await log_function_query.fetchDataFilter({item_jig: filter});

        typeContain.removeChild(document.getElementById('loading1'));
        typeContain.appendChild(table);
        typeContain.appendChild(await btnUpdType('updType', 'delType', 'addType'));
        const btnAddLoc = document.getElementById('addType');
        let counter = 0;
        btnAddLoc.addEventListener('click', async function() {
            table.appendChild(await addNewType(counter));
            counter++;
        })
        
        const btnDelType = document.getElementById('delType');
        btnDelType.addEventListener('click', function () {
            const cek = document.getElementById('tableType');
            const cek2 = cek.lastChild;
            if (!cek2.hasAttribute('data-fromdb')){
                delChild('tableType');
                return;
            }
            alert('row tidak bisa di hapus');
        })
        const btnData = document.getElementById('updType');
        btnData.addEventListener('click', async function() {
            try {
                btnData.textContent="";
                btnData.classList.add('proses');
                btnData.disabled = true;
                await updateInsertType();
                btnData.classList.remove('proses');
                btnData.textContent="update";
                btnData.disabled = false;
            }catch(error){
                console.log(error);
            }
        })
        typeContain.appendChild(historyTitle);
        typeContain.appendChild(await tblHistType(dataHist));
    } catch (error) {
        console.log(error);
    }
}

document.addEventListener('change', async function(event) {
    if (event.target.getAttribute('data-addtype') !== null && event.target.getAttribute('id').includes('item_jig')) {
        try {
            const targetId = document.getElementById(event.target.getAttribute('id'));
            const value = targetId.value;
            const result = await jig_master_query.fetchDataFilter({item_jig: value});
            const targetResult = splitCustomString("+", targetId.id);
            const statusNew = document.getElementById(`status+${targetResult[1]}`);
            statusNew.value = result[0].status_jig
        } catch(error) {
            console.log(error);
        }
    }
})