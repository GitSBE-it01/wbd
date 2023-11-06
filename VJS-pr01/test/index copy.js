/*==============================================================================
import function dari process.js dan class dari class.js
==============================================================================*/
import { populateOption, html, addButton, populateHeader, populateData, currentDate, splitCustomString, cekDMCdaily, isFormValid } from '../process.js';
import { relation, woid, trans_log, dmc_vjs_data } from '../class.js';


/*===========================================================================
initial load
===========================================================================*/
/*
proses after HTML loaded : 
get data utk list asset yang akan di pilih 
populate datalist asset 
hidden 
*/
document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/VJS-pr01/';
    const extractedPortion = currentUrl.substring(currentUrl,specificUrls.length);
    if (extractedPortion == specificUrls){
        try {
            const load1 = document.getElementById('loading1');
            const input1 = document.getElementById('assetPick');
            const button = document.getElementById('show');
            // option utk list VJS
            const data = await relation.fetchDataFilter({fromdiv: 'PRODUCTION SPEAKER ASSEMBLY',asset_vjs_kategori: 'IS NOT NULL'});
            populateOption('assets',' -- ', data,'asset_no_combin','assetname', 'asset_vjs_kategori');
            input1.classList.remove('hideOn');
            button.classList.remove('hideOn');
            load1.classList.add('hideOn');
        } catch(error){
            console.log('error:', error);
        }
    }
})

/*===========================================================================
klik button proses
===========================================================================*/
/*
jika ada klik button: 
ambil data asset utk filter data
cek dulu apakah DMC sudah di lakukan belum pada hari tersebut. dengan function cekDMCdaily di dalam file ini
jika sudah ada maka ambil data dari class trans_log. 
*/

// utk menjalankan proses search di awal
const buttonSearch = document.getElementById('show')
buttonSearch.addEventListener("click", async function() {
    const inputChange = document.getElementById('assetPick');
    const valueInput = splitCustomString(' -- ', inputChange.value);
    const noAssetInput = valueInput[0];
    const catInput = valueInput[valueInput.length - 1];
    const todayDate = currentDate();
    const container = document.getElementById('DMCresult');
    const load = document.getElementById('loading3');
    load.classList.remove('hideOn');
    if (container.firstChild != "") {
        container.removeChild(container.firstChild);
    }
    try {
        const todayDMC = await cekDMCdaily(trans_log,{noAsset: noAssetInput,input_date: todayDate});
       
        html('DMCresult',`
        <h1>Daily Maintenance & Verifikasi Job Setup</h1>
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
                        <select class="tableForm" id='descOption' name='descOption'>
                            <option value=""></option>
                            <option value="OK">OK</option>
                            <option value="HOLD">HOLD</option>
                            <option value="USE AS IS">USE AS IS</option>
                            <option value="REPAIR">REPAIR</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="switch" id="dmcSwitch">Daily Maintenance</button>
        <form id='formDMC' class= 'hideoff'>
        <div class="tableFlex">
            <div class="tableData tableHeader">inspection</div>
            <div class="tableData tableHeader">standard</div>
            <div class="tableData tableHeader">unit</div>
            <div class="tableData tableHeader">checklist</div>
        </div>
        </form>
        `);

        let value_S = [];
        let data2 = [];
        const descisionValue = document.getElementById('descOption');
        console.log(descisionValue.value);
        if (todayDMC) {
            data2 = await trans_log.fetchDataFilter({noAsset: noAssetInput, input_date: todayDate}); //pengambilan data dari database, menggunakan metode dari class
            data2.forEach(e => {
                value_S.push(e.input_value);
            })
            for (let i=0; i<data2.length; i++) {
                html('formDMC',`
                <input type="hidden" id="noAsset" name="noAsset" value="${valueInput[0]}">
                <input type="hidden" id="namaAsset" name="namaAsset" value="${valueInput[1]}">
                <input type="hidden" id="input_date" name="input_date" value="${todayDate}">
                <input type="hidden" id="decision" name="decision" value="${descisionValue.value}">
                <input type="hidden" id="wo_id" name="wo_id" value="maintenance">
                <input type="hidden" id="dmc_vjs" name="dmc_vjs" value="DMC">
                <input type="text" class="tableData readonly" id="inspection" name="inspection" value="${data2[i].inspection}" readonly>
                <input type="text" class="tableData readonly" id="std" name="std" value="${data2[i].std}" readonly>
                <input type="text" class="tableData readonly" id="unit" name="unit" value="${data2[i].unit}">
                <input type="text" class="tableForm readonly" id="input_value" name="input_value" data-inputDMC="dataTag" placeholder="-choose-" value="${value_S[i]}" list="dmcOption" readonly>
                `);
            }
        } else {
            data2 = await dmc_vjs_data.fetchDataFilter({category: catInput}); //pengambilan data dari database, menggunakan metode dari class.
            console.log(data2);
            for (let i=0; i<data2.length; i++) {
                html('formDMC',`
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
                `);
            }
        }

        html('formDMC' , `
        <button type="button" class="submitBtn1" id="editBtn_formDMC">edit</button>
        <button type="button" class="submitBtn2" id="submitBtn_formDMC">submit</button>`
        );
        
        container.classList.remove('hideOn');
        load.classList.add('hideOn');
    }catch (error) {
        console.log('error: ', error);
    }
})

document.addEventListener ("click", async function(event) {
    if (event.target.getAttribute('type') === 'button'){
        // open readonly utk edit bagian yang di lock readonly
        if (event.target.getAttribute('id') != null && event.target.getAttribute('id').includes('editBtn')) {
            const targetId = event.target.getAttribute('id');
            const detail = splitCustomString("_", targetId);
            const id = detail[detail.length - 1];
            const targetContain = document.getElementById(id);
            const readonly = targetContain.querySelectorAll('.readonly');
            if (readonly.length>0) {
                readonly.forEach(element => {
                    element.classList.replace('readonly', 'readonlyOFF');
                    element.removeAttribute('readonly');
                })
            } else {
                const readonlyOFF = targetContain.querySelectorAll('.readonlyOFF');
                readonlyOFF.forEach(element => {
                    element.classList.replace('readonlyOFF', 'readonly');
                    element.setAttribute('readonly', 'readonly');
                })
            }
            // utk submit data DMC ke database
        } else if (event.target.getAttribute('id') != null && event.target.getAttribute('id') === 'dmcSwitch') {
            const target = document.getElementById('formDMC');
            if (target.classList.contains('hideOn')) {
                target.classList.replace('hideOn', 'hideOff');
            } else {
                target.classList.replace('hideOff', 'hideOn');
            }

        } else if (event.target.getAttribute('id') != null && event.target.getAttribute('id').includes('submitBtn')) {
            const form = document.getElementById('formDMC');
                if (!isFormValid('formDMC')) {
                    event.preventDefault(); // Prevent the form from submitting
                    return;
                } else {
                    const btnId = event.target.getAttribute('id');
                    const btn = document.getElementById(btnId);
                btn.disabled = true;
                const targetId = event.target.getAttribute('id');
                const detail = splitCustomString("_", targetId);
                const id = detail[detail.length - 1];
                const targetContain = document.getElementById(id);
                const inputElements = targetContain.querySelectorAll('input');
                let data = [];
                inputElements.forEach(input =>{
                    const key = input.getAttribute('id');
                    const value = input.value;
                    if (!data[key]) {
                        data[key] = [{ value }];
                    } else {
                        data[key].push({ value });
                    }
                })
                const result = await trans_log.insertData(data);
                console.log('success');
                /*populateHeader('VJSresult',`
                    <div class="tableFlex" id="vjsContain">
                    <div class="columnView">
                        <div class="tableData tableHeader">inspection</div>
                        <div class="tableData tableHeader">standard</div>
                        <div class="tableData tableHeader">unit</div>
                        <div class="tableData tableHeader">checklist</div>
                    </div>
                    </div>
                `) 
    
                populateHeader('vjsContain',`
                    <form id='formVJS'>
                        <div class='columnView'>
                            <input type="hidden" id="noAsset" name="noAsset" value="${valueInput[0]}">
                            <input type="hidden" id="namaAsset" name="namaAsset" value="${valueInput[1]}">
                            <input type="hidden" id="input_date" name="input_date" value="${todayDate}">
                            <input type="hidden" id="wo_id" name="wo_id" value="maintenance">
                            <input type="hidden" id="dmc_vjs" name="dmc_vjs" value="DMC">
                            <input type="text" class="tableData readonly" id="inspection" name="inspection" value="${data2[i].inspection}" readonly>
                            <input type="text" class="tableData readonly" id="std" name="std" value="${data2[i].std}" readonl>
                            <input type="text" class="tableData" id="unit" name="unit" value="${data2[i].unit}">
                            <input type="text" class="tableForm" id="input_value" name="input_value" data-inputDMC="dataTag" placeholder="-choose-" list="dmcOption" >
                        </div>
                    </form>
                    `);
    
                addButton('vjsContain' , `
                <button type="button" class="submitBtn1" id="editBtn_formDMC">edit</div>
                <button type="button" class="submitBtn2" id="submitBtn_formDMC">submit</div>`);
            });



            /*const elements = document.querySelectorAll('[data-inputDMC="dataTag"]');
            elements.forEach( e => {
                const dataValue = e.getAttribute('value');
                if (dataValue === "") {
                    return;
                }
            })

        */}
        }}})

/*===========================================================================
onChange proses
===========================================================================*/
/*
digunakan mengeluarkan decision dari hasil pengisian DMC

document.addEventListener ("change", async function(event) {
    if (event.target.getAttribute('id') === 'input_value') {
        const value = event.target.value;
        const container = document.getElementById('descOption');
        if(container.value !== "HOLD") {
            if (value === "NG") {
                container.value = "HOLD";
            } else {
                container.value = "OK"
            }
        }
    }
})*/

