import { currentDate, splitCustomString } from './process.js';

/*===================================================
jig table generate
===================================================*/
export const tableHeader = async(target,tableID, arrHead) => {
    try {    
        const container = document.getElementById(target);
        const table = document.createElement('div');
        table.classList.add('tmFull');
        table.id = tableID;
        const tr = document.createElement('div');
        tr.classList.add('fr', 'fc-ctr', 'fc-w', 'thContFull');
        tr.id = 'tableHeader';

        for (let i=0; i<arrHead.length; i++) {
            const th = document.createElement('div');
            th.classList.add('tl4', 'flexCh', 'th', 'bd-black', 'upper');
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        container.appendChild(table);
    } catch(error){
        console.log(error);
    }
}

export const dmcHeader = async(target) => {
    try {
        const container = document.getElementById(target);
        const inputChange = document.getElementById('assetPick');
        const valueInput = splitCustomString(' -- ', inputChange.value);
        const noAssetInput = valueInput[0];
        const namaAssetInput = valueInput[1];
        const catInput = valueInput[valueInput.length - 1];
        const todayDate = currentDate();
        const detail = document.createElement('div');
        detail.id = 'detailDiv';
        detail.classList.add('main2', 'tl9');
        
        const main1 = document.createElement('div');
        main1.classList.add('columnView');
        
        const h1 = document.createElement('h1');
        h1.classList.add('cardTitle');
        h1.textContent = "Daily Maintenance & Verification Job Setup";
        main1.appendChild(h1);

        const arrayHead = [{key: "No Asset:",value:`${noAssetInput}`}, {key: "Nama_Asset:", value:`${namaAssetInput}`},{key: "Date:", value:`${todayDate}`}]

        for (let i=0; i<arrayHead.length; i++) {
            const cardContain = document.createElement('div');
            cardContain.classList.add('fr','fc-ctr','card_contain');
            
            const card1 = document.createElement('div');
            card1.classList.add('mh4', 'fs-l');
            const label1 = document. createElement('label');
            label1.textContent= `${arrayHead[i]['key']}`;   

            const card2 = document.createElement('div');
            card2.classList.add('mh4','fs-l');
            const label2 = document. createElement('label');
            label2.textContent= `${arrayHead[i]['value']}`;

            card1.appendChild(label1);
            cardContain.appendChild(card1);
            card2.appendChild(label2);
            cardContain.appendChild(card2);
            main1.appendChild(cardContain);
        }
        detail.appendChild(main1)

        container.appendChild(detail);
    } catch (error){
        console.log(error);
    }
}

export const dmcData = async (tbodyID,data) => {
    try {

        const tableBody = document.createElement('div');
        tableBody.classList.add('tr');
        tableBody.id = tbodyID;
        for (let i=0; i<data.length; i++) {
            const form = document.createElement('div');
            form.classList.add('fr');
            form.id = 'inputDMC';
            form.innerHTML = `
                <input type="hidden" id="noAsset" name="noAsset" value="${data[i].noAsset}">
                <input type="hidden" id="namaAsset" name="namaAsset" value="${data[i].namaAsset}">
                <input type="hidden" id="input_date" name="input_date" value="${data[i].input_date}">
                <input type="hidden" id="decision" name="decision" value="${data[i].decision}">
                <input type="hidden" id="wo_id" name="wo_id" value="${data[i].wo_id}">
                <input type="hidden" id="dmc_vjs" name="dmc_vjs" value="${data[i].dmc_vjs_data}">
                <input type="hidden" id="id" name="id" value="${data[i].id}">
                
                <input type="text" class="tableData readonly" id="inspection" name="inspection" value="${data[i].inspection}" readonly>
                <input type="text" class="tableData readonly" id="std" name="std" value="${data[i].std}" readonly>
                <input type="text" class="tableData readonly" id="unit" name="unit" value="${data[i].unit}">
                <input type="text" class="tableForm readonly" id="input_value" name="input_value" data-inputDMC="dataTag" placeholder="-choose-" value="${data[i].input_value}" list="dmcOption" readonly>
            `;
            tableBody.appendChild(form);
        }
        return tableBody;
    } catch(error) {
        console.log(error);
    }
}
