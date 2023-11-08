import { currentDate, splitCustomString, cekDMCdaily } from './process.js';
import { trans_log } from './class.js';

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
       

const dmcTable = async() => {
    
}
/*detail.innerHTML = `
    <div class="tableFlex">
    <div class="columnView">
        <div class="formgroup">
            <div class="card1"><label>No Asset</label></div>
            <div class="card1"><label>: ${valueInput[0]}</div>
        </div>
        <div class="formgroup">
            <div class="card1"><label>Nama Asset</label></div>
            <div class="card1"><label>: ${valueInput[1]}</div>
        </div>
        <div class="formgroup">
            <div class="card1"><label>Date</label></div>
            <div class="card1"><label>: ${todayDate}</div>
        </div>
    </div>
    <div class="columnView">
        <div class="formgroup">
            <div class="card1"><label>Decision</label></div>
            <div class="card1">
                <select class="tableForm " id='descOption' name='descOption'>
                    <option value=""></option>
                    <option value="OK">OK</option>
                    <option value="HOLD">HOLD</option>
                    <option value="USE AS IS">USE AS IS</option>
                    <option value="REPAIR">REPAIR</option>
                </select>
            </div>
        </div>
    </div>
    <button type="button" class="switch" id="dmcSwitch">Daily Maintenance</button>
`
export const dmcData = async (btn, target) =>{
    const buttonSearch = document.getElementById(btn);
    buttonSearch.addEventListener("click", async function() {
        // cek no asset yang di masukkan
        const inputChange = document.getElementById('assetPick');
        const valueInput = splitCustomString(' -- ', inputChange.value);
        const noAssetInput = valueInput[0];
        const catInput = valueInput[valueInput.length - 1];        
        const todayDate = currentDate();
        const mainContainer = document.getElementById(target);
        const container = document.createElement('div');
        container.id = 'dmcTable';

        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }

    try {
        // DMC output
        // header atau data awalan dengan tampilan
        const todayDMC = await cekDMCdaily(trans_log,{noAsset: noAssetInput,input_date: todayDate});
        const div1 = document.createElement('div');
        div1.innerHTML = `
            <h1 class="cardTitle">Daily Maintenance & Verification Job Setup</h1>
            <div class="tableFlex">
            <div class="columnView">
                <div class="formgroup">
                    <div class="card1"><label>No Asset</label></div>
                    <div class="card1"><label>: ${valueInput[0]}</div>
                </div>
                <div class="formgroup">
                    <div class="card1"><label>Nama Asset</label></div>
                    <div class="card1"><label>: ${valueInput[1]}</div>
                </div>
                <div class="formgroup">
                    <div class="card1"><label>Date</label></div>
                    <div class="card1"><label>: ${todayDate}</div>
                </div>
            </div>
            <div class="columnView">
                <div class="formgroup">
                    <div class="card1"><label>Decision</label></div>
                    <div class="card1">
                        <select class="tableForm " id='descOption' name='descOption'>
                            <option value=""></option>
                            <option value="OK">OK</option>
                            <option value="HOLD">HOLD</option>
                            <option value="USE AS IS">USE AS IS</option>
                            <option value="REPAIR">REPAIR</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="switch" id="dmcSwitch">Daily Maintenance</button>
        `
        container.appendChild(div1);

        const dmcTable = document.createElement('form');
        dmcTable.id = 'formDMC';

        const dmcHeader = document.createElement('div');
        dmcHeader.classList.add('fr');
        dmcHeader.innerHTML = `
            <div class="tableFlex">
                <div class="tableData tableHeader">inspection</div>
                <div class="tableData tableHeader">standard</div>
                <div class="tableData tableHeader">unit</div>
                <div class="tableData tableHeader">checklist</div>
            </div>
        `}catch (error) {
        console.log('error: ', error);
    }
    mainContainer.appendChild(container);
})}
        /*
        let value_S = [];
        let data2 = [];
        const descisionValue = document.getElementById('descOption');

        //data DMC ambil dari trans log atau dari data kosong nya
        if (todayDMC) {
            data2 = await trans_log.fetchDataFilter({noAsset: noAssetInput, input_date: todayDate}); //pengambilan data dari database, menggunakan metode dari class
            data2.forEach(e => {
                value_S.push(e.input_value);
            })
            for (let i=0; i<data2.length; i++) {
                html('formDMC',`
                <div class='tableFlex'>
                    <input type="hidden" id="noAsset" name="noAsset" value="${data2[i].noAsset}">
                    <input type="hidden" id="namaAsset" name="namaAsset" value="${data2[i].namaAsset}">
                    <input type="hidden" id="input_date" name="input_date" value="${data2[i].input_date}">
                    <input type="hidden" id="decision" name="decision" value="${data2[i].decision}">
                    <input type="hidden" id="wo_id" name="wo_id" value="${data2[i].wo_id}">
                    <input type="hidden" id="dmc_vjs" name="dmc_vjs" value="${data2[i].dmc_vjs_data}">
                    <input type="hidden" id="id" name="id" value="${data2[i].id}">
                    <input type="text" class="tableData readonly" id="inspection" name="inspection" value="${data2[i].inspection}" readonly>
                    <input type="text" class="tableData readonly" id="std" name="std" value="${data2[i].std}" readonly>
                    <input type="text" class="tableData readonly" id="unit" name="unit" value="${data2[i].unit}">
                    <input type="text" class="tableForm readonly" id="input_value" name="input_value" data-inputDMC="dataTag" placeholder="-choose-" value="${data2[i].input_value}" list="dmcOption" readonly>
                </div>
                `);
            }
        } else {
            data2 = await dmc_vjs_data.fetchDataFilter({category: catInput}); //pengambilan data dari database, menggunakan metode dari class.
            for (let i=0; i<data2.length; i++) {
                html('formDMC',`
                <div class='tableFlex'>
                <input type="hidden" id="noAsset" name="noAsset" value="${valueInput[0]}">
                <input type="hidden" id="namaAsset" name="namaAsset" value="${valueInput[1]}">
                <input type="hidden" id="input_date" name="input_date" value="${todayDate}">
                <input type="hidden" id="decision" name="decision" value="${descisionValue.value}">
                <input type="hidden" id="wo_id" name="wo_id" value="maintenance">
                <input type="hidden" id="dmc_vjs" name="dmc_vjs" value="DMC">
                <input type="text" class="tableData readonly" id="inspection" name="inspection" value="${data2[i].inspection}" readonly>
                <input type="text" class="tableData readonly" id="std" name="std" value="${data2[i].std}" readonly>
                <input type="text" class="tableData readonly" id="unit" name="unit" value="${data2[i].unit}">
                <input type="text" class="tableForm readonly" id="input_value" name="input_value" data-inputDMC="dataTag" placeholder="-choose-" value="${value_S}" list="dmcOption" required>
                </div>
                `);
            }
        }

        html('formDMC' , `
        <button type="button" class="submitBtn" id="editBtn_formDMC">edit</button>
        <button type="button" class="submitBtn" id="submitBtn_formDMC">submit</button>`
        );

        
        const datavjs1 = await dmc_vjs_data.fetchDataFilter({category: catInput, dmc_vjs: 'vjs'});
        for (let i=0; i<datavjs1.length; i++) {
            const targetVjsContainer = document.getElementById('vjsData');
            const vjsDataForm = document.createElement('div');
            const htmlData = `
            <div class="formgroup">
                <div class="card3"><label>${datavjs1[i].inspection}</label></div>
                <div class="card2">
                    <input type="text" class="tableData card2">
                </div>
                <div class="card4"><label>${datavjs1[i].unit}</label></div>
            </div>`
            vjsDataForm.innerHTML = htmlData;
            targetVjsContainer.appendChild(vjsDataForm);
        }
        
        
        container.classList.remove('hideOn');
        container2.classList.remove('hideOn');
        load.classList.add('hideOn');
    }catch (error) {
        console.log('error: ', error);
    }
})
}*/

