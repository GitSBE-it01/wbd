/*==============================================================================
import function dari process.js dan class dari class.js
==============================================================================*/
import { populateOption, html, currentDate, splitCustomString, cekDMCdaily, isFormValid } from './process.js';
import { relation, woid, trans_log, dmc_vjs_data, dataInspect } from './class.js';
import { createNavbar } from './component/navbar.js';
import { loading } from './component/load.js';

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
        createNavbar('root');
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
const buttonSearch = document.getElementById('show');
buttonSearch.addEventListener("click", async function() {
    const inputChange = document.getElementById('assetPick');
    const valueInput = splitCustomString(' -- ', inputChange.value);
    const noAssetInput = valueInput[0];
    const catInput = valueInput[valueInput.length - 1];
    const todayDate = currentDate();
    const container = document.getElementById('DMCresult');
    const load = document.getElementById('loading3');
    const container2 = document.getElementById('VJSresult')
    load.classList.remove('hideOn');
    while (container.firstChild) {
        container.removeChild(container.firstChild);
    }
    while (container2.firstChild) {
        container2.removeChild(container2.firstChild);
    }
    try {
        // DMC output
        // header atau data awalan dengan tampilan
        const todayDMC = await cekDMCdaily(trans_log,{noAsset: noAssetInput,input_date: todayDate});
        html('DMCresult',`
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
        

        // VJS output

        html('VJSresult', `
        <button type="button" class="switch" id="vjsSwitch">Verification Job Setup</button>
        <div id="formVJS">
            <form class="container4">
                <div class="columnView" id="vjsData">
                    <div class="formgroup">
                        <div class="card3"><label>id</label></div>
                        <div class="card2">
                            <input type="text" class="tableData card2">
                        </div>
                    </div>
                </div>
                <div class="formgroup">
                    <button type="button" class="button_plus" id="addBtn_formVJS"></button>
                    <button type="button" class="button_minus" id="minBtn_formVJS"></button>
                </div>
                <button type="button" class="submitBtn" id="submitBtn_formVJS">submit</button>
            </form>
        </div>
        `)
        
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
                return;
            } 
            const readonlyOFF = targetContain.querySelectorAll('.readonlyOFF');
            readonlyOFF.forEach(element => {
                element.classList.replace('readonlyOFF', 'readonly');
                element.setAttribute('readonly', 'readonly');
            })
            return;
        }

        if (event.target.getAttribute('id') != null && event.target.getAttribute('id') === 'dmcSwitch') {
            const target = document.getElementById('formDMC');
            if (!target.classList.contains('hideOn') && !target.classList.contains('hideOff')) {
                target.classList.add('hideOn');
                return;
            } 
            if (target.classList.contains('hideOn')) {
                target.classList.replace('hideOn', 'hideOff');
                return;
            } 
            target.classList.replace('hideOff', 'hideOn');
            return;
        } 

        if (event.target.getAttribute('id') != null && event.target.getAttribute('id') === 'vjsSwitch') {
            const target = document.getElementById('formVJS');
            if (!target.classList.contains('hideOn') && !target.classList.contains('hideOff')) {
                target.classList.add('hideOn');
                return;
            } 
            if (target.classList.contains('hideOn')) {
                target.classList.replace('hideOn', 'hideOff');
                return;
            } 
            target.classList.replace('hideOff', 'hideOn');
            return;
        }

        if (event.target.getAttribute('id') != null && event.target.getAttribute('id').includes('submitBtn')) {
            const container = document.getElementById('formDMC');
            // Check if the div element exists
            const paragraphs = container.querySelectorAll('p');
            if (paragraphs.length>0) {
            paragraphs.forEach(paragraph => {
                paragraph.remove();
            })}
            // cek apakah field value input sudah terisi atau belum
            if (!isFormValid('formDMC')) { 
                event.preventDefault();
                const p = document.createElement('p');
                p.innerText = 'form is not valid';
                container.appendChild(p);
                return;
            }
            
            // cek apakah descisionnya OK atau use as is
            if (document.getElementById('descOption').value !== 'OK' && document.getElementById('descOption').value !== 'USE AS IS') {
                event.preventDefault();
                const p = document.createElement('p');
                p.innerText = 'form is not valid';
                container.appendChild(p);
                return;
            }

            const inputChange = document.getElementById('assetPick');
            const valueInput = splitCustomString(' -- ', inputChange.value);
            const noAssetInput = valueInput[0];
            const todayDate = currentDate();
            const dataCek = await trans_log.fetchDataFilter({noAsset: noAssetInput, input_date: todayDate}); //pengambilan data dari database, menggunakan metode dari class
            if (dataCek.length >0) {
                console.log("akeh");
            }
            
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
            //data.forEach()
            const descValue = document.getElementById('descOption');
            console.log(descValue.value);
            // data['decision'].push(descValue.value);
            const result = await trans_log.insertData(data);
        }

        if (event.target.getAttribute('id') != null && event.target.getAttribute('id') === 'addBtn_formVJS') {
            const target = document.getElementById('vjsData');
            const vjsDataForm = document.createElement('div');
            vjsDataForm.classList.add('formgroup');
            const datavjs1 = await dataInspect.fetchDataFilter({dmc_vjs: 'vjs'});
            console.log(datavjs1);
            const divInput1 = document.createElement('div')
            divInput1.classList.add('selectData');
            const input1 = document.createElement('select');
            input1.classList.add('selectData');
            for (let i=0; i<datavjs1.length; i++) {
                const option = document.createElement('option');
                option.value = datavjs1[i].inspection;
                option.textContent = datavjs1[i].inspection;
                input1.appendChild(option);
            }    
            divInput1.appendChild(input1);

            const divInput2 = document.createElement('div')
            divInput2.classList.add('card2');
            const input2 = document.createElement('input');
            input2.setAttribute('type', 'text');
            input2.classList.add('tableData', 'card2');
            divInput2.appendChild(input2);

            const divInput3 = document.createElement('div')
            divInput3.classList.add('card4');
            const input3 = document.createElement('div');
            input3.classList.add('card4');
            divInput3.appendChild(input3);
            vjsDataForm.appendChild(divInput1);
            vjsDataForm.appendChild(divInput2);
            vjsDataForm.appendChild(divInput3);
            target.appendChild(vjsDataForm);
            return;
        }

        if (event.target.getAttribute('id') != null && event.target.getAttribute('id') === 'minBtn_formVJS') {
            const target = document.getElementById('vjsData');
            if (target.hasChildNodes()) {
                // Get the last child node
                const lastChild = target.lastChild;
              
                // Remove the last child node from its parent
                target.removeChild(lastChild);
              }
        }
        }})

/*===========================================================================
onChange proses
===========================================================================*/
/*
digunakan mengeluarkan decision dari hasil pengisian DMC
*/
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
        return;
    }
})

