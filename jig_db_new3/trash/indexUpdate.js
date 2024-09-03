/*===================================================================================
initial load
===================================================================================*/
document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/jig_db_new/update/';
    const extractedPortion = currentUrl.substring(0,specificUrls.length);
    if (extractedPortion == specificUrls){
        /*-------------------
        location 
        -------------------*/
        const result1 = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-list_location', 'list_location');
        const data2 = result1.map((obj1) => {
            return {
                lokasi: obj1.name,
            }
            });
        const datalist1 = document.getElementById('dataLokasi');
        for (let i=0; i<data2.length; i++) {
            const option = document.createElement('option');
            option.value = data2[i].lokasi;
            datalist1.appendChild(option);
        }

        /*-------------------
        speaker dan desc
        -------------------*/
        const result7 = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-jig_function', 'jig_function');
        const result8 = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-new_item_detail', 'new_item_detail');
        const data = result7.map((obj1) => {
            const matObj = result8.find((obj2) => obj2.pt_part === obj1.item_type);
            return {
                item_type: obj1.item_type,
                description: matObj ? matObj.pt_desc1 + matObj.pt_desc2: ""
            }
        })
        const uniqueItemTypes = new Set();
        const uniqueData = [];

        data.forEach((item) => {
            // Check if the item_type is not in the Set
            if (!uniqueItemTypes.has(item.item_type)) {
                // Add it to the Set and push the item to the uniqueData array
                uniqueItemTypes.add(item.item_type);
                uniqueData.push(item);
            }
        });

        const datalist2 = document.getElementById('suggestion');
        for (let i=0; i<uniqueData.length; i++) {
            const option2 = document.createElement('option');
            option2.value = uniqueData[i].item_type + "  --  " + uniqueData[i].description;
            datalist2.appendChild(option2);
        }

        /*-------------------
        item jig
        -------------------*/
        const result10 = await fetchedDataIndexDB('jig_database', 'dataStore_db', 'preload-jig_master', 'jig_master');
        const data3 = result10.map((obj1) => {
            return {
                item_jig: obj1.item_jig,
                desc: obj1.desc_jig
            }
        })
        const datalist3 = document.getElementById('jig_suggest');
        for (let i=0; i<data3.length; i++) {
            const option2 = document.createElement('option');
            option2.value = data3[i].item_jig;
            option2.innerText = data3[i].item_jig + "  --  " + data3[i].desc;
            datalist3.appendChild(option2);
        }
    }
})



/*===================================================================================
click event
===================================================================================*/
document.addEventListener("click", function(event) {
    if(event.target.getAttribute('id') == "openEdit") {
        const readonly = document.querySelectorAll(".card2.readonly");
        readonly.forEach(element => {
            element.removeAttribute('readonly');
            element.classList.remove('readonly');
        });
    }
})

document.addEventListener("click", async function(event) {
    const switchDetail = document.getElementById('switchDetail');
    const switchStock = document.getElementById('switchStock');
    const switchType = document.getElementById('switchType');
    const mainJig = document.getElementById('dataJig');
    const mainLoc = document.getElementById('location');
    const mainType = document.getElementById('type');
    const role = document.getElementById('role');
    if (event.target.getAttribute('id') === 'switchDetail') {
        switchDetail.classList.add('btn_active');
        switchStock.classList.remove('btn_active');
        switchType.classList.remove('btn_active');
        mainJig.style.display = 'block';
        mainLoc.style.display = 'none';
        mainType.style.display = 'none';
    } else if (event.target.getAttribute('id') === 'switchStock') {
        switchDetail.classList.remove('btn_active');
        switchStock.classList.add('btn_active');
        switchType.classList.remove('btn_active');
        mainJig.style.display = 'none';
        mainLoc.style.display = 'block';
        mainType.style.display = 'none';
    } else if (event.target.getAttribute('id') === 'switchType') {
        switchDetail.classList.remove('btn_active');
        switchStock.classList.remove('btn_active');
        switchType.classList.add('btn_active');
        mainJig.style.display = 'none';
        mainLoc.style.display = 'none';
        mainType.style.display = 'block';
    }
/*======================================================= 
jig_master
=======================================================*/
    if (event.target.getAttribute('id') === 'btnJig') {
        document.getElementById("loading").style.display="block";
        const container = document.getElementById('jigContain');
        try {
            /*------------ 
            data jig
            ------------*/
            const result10 = await fetchData('jig_master_query');
            const input1 = document.getElementById('jig');
            const userInput = input1.value.toLowerCase(); 
            const listJig = document.getElementById('jig_suggest');
            const validation = Array.from(listJig.options).map(options => options.value.toLowerCase());
            if (validation.includes(userInput)) {
                const filterData1 = result10.filter(item =>
                    item.item_jig.toLowerCase().includes(input1.value.toLowerCase())
                );
                const data = filterData1.map((obj1) => {
                    return {
                        item_jig: obj1.item_jig,
                        desc_jig: obj1.desc_jig,
                        type_jig: obj1.type !== undefined ? obj1.type: "",
                        status_jig: obj1.status_jig,
                        material: obj1.material !== undefined ? obj1.material: "",
                        drawing: obj1.drawing !== undefined ? obj1.drawing: "",
                        remark: obj1.remark !== undefined ? obj1.remark: ""
                }});
            /*------------ 
            data history jig
            ------------*/
                const history1 = await fetchDataWild('log_master_query',input1.value);
                const filterData2 = history1.filter(item =>
                    item.item_jig.toLowerCase().includes(input1.value.toLowerCase())
                );
                const data2 = filterData2.map((obj1) => {
                    return {
                        item_jig: obj1.item_jig,
                        desc_jig: obj1.desc_jig,
                        type_jig: obj1.type,
                        status_jig: obj1.status_jig,
                        material: obj1.material,
                        drawing: obj1.drawing,
                        remark: obj1.remark,
                        trans_date: new Date(obj1.trans_date)
                }});
                data2.sort((a, b) => b.trans_date - a.trans_date);
                /*------------ 
                view jig
                ------------*/
                arr_dat = ['item_jig','desc_jig','type_jig','status_jig','material','drawing', 'remark'];
                let insertDataDiv = "";
                for (let i = 0; i < data.length; i++) {
                    insertDataDiv += `
                        <div class="side">                        
                            <div class="card1"><label>Description jig </label></div>
                            <input class="card2 readonlyOFF" name="desc_jig" type="text" value="${data[i].desc_jig}" readonly>
                        </div>
                        <div class="side">                        
                            <div class="card1"><label>status jig </label></div>
                            <input class="card2 readonly" name="status_jig" type="text" value="${data[i].status_jig}" readonly>
                        </div>
                        <div class="side">                        
                            <div class="card1"><label>material jig </label></div>
                            <input class="card2 readonly" name="material" type="text" value="${data[i].material}" readonly>
                        </div>
                        <div class="side">                        
                            <div class="card1"><label>tipe jig </label></div>
                            <input class="card2 readonly" name="type" type="text" value="${data[i].type_jig}" readonly>
                        </div>
                        <div class="side">                        
                            <div class="card1"><label>drawing</label></div>
                            <input class="card2 readonly" name="drawing" type="text" value="${data[i].drawing}" readonly>
                        </div>
                        <div class="side">                        
                            <div class="card1"><label>remark</label></div>
                            <input class="card2 readonly" name="remark" type="text" value="" readonly>
                        </div>
                    `;            
                }
                const buttonEdit =`<button type="button" class="button-30" id="openEdit">edit</button>`;
                const buttonSubmit =`<button type="submit" class="button-30" name="update_data">update</button>`;

                const finalHTML1 =  insertDataDiv + buttonEdit + buttonSubmit;
                container.innerHTML = finalHTML1;

                const h1 = document.createElement('h1');
                h1.innerText = 'History Log';
                container.appendChild(h1);
                const div =document.createElement('div');
                const header = `
                <div class='tableFlex'> 
                    <div class='tableData tableHeader'>item number jig</div>
                    <div class='tableData tableHeader'>desc jig</div>
                    <div class='tableData tableHeader'>type of jig</div>
                    <div class='tableData tableHeader'>status jig</div>
                    <div class='tableData tableHeader'>material</div>
                    <div class='tableData tableHeader'>drawing</div>
                    <div class='tableData tableHeader'>remark</div>
                    <div class='tableData tableHeader'>Transaction Date (d-m-y)</div>
                </div>`;
                let tableData = "";
                for (let i=0; i<data2.length; i++) {
                    tableData += `
                    <div class='tableFlex'> 
                        <div class='tableData'>
                            ${data2[i].item_jig}
                        </div>
                        <div class='tableData'>
                            ${data2[i].desc_jig}
                        </div>
                        <div class='tableData'>
                            ${data2[i].type_jig}
                        </div>
                        <div class='tableData'>
                            ${data2[i].status_jig}
                        </div>
                        <div class='tableData'>
                            ${data2[i].material}
                        </div>
                        <div class='tableData'>
                            ${data2[i].drawing}
                        </div>
                        <div class='tableData'>
                            ${data2[i].remark}
                        </div>
                        <div class='tableData'>
                            ${data2[i].trans_date.toLocaleDateString(`id-ID`)}
                        </div>
                    </div>`;
                }
                const finalHTML = header + tableData;
                div.innerHTML = finalHTML;
                container.appendChild(div);
            } else {
                console.log("Input does not match any datalist option.");
            }
        } catch (error) {
            console.log('error: ',error);
        } 
        document.getElementById("loading").style.display="none";
/*======================================================= 
jig_Location
=======================================================*/
    } else if (event.target.getAttribute('id') === 'btnLoc') {
        document.getElementById("loading2").style.display="block";
        const container = document.getElementById('locContain');
        try{
            /*------------ 
            data loc
            ------------*/
            const result9 =  await fetchData('jig_location_query');
            const input = document.getElementById('loc');
            const userInput = input.value.toLowerCase(); 
            const listJig = document.getElementById('jig_suggest');
            const validation = Array.from(listJig.options).map(options => options.value.toLowerCase());
            if (validation.includes(userInput)) {
                const filterData = result9.filter(item =>
                    item.item_jig.toLowerCase().includes(input.value.toLowerCase())
                );
                const data = filterData.map((obj1) => {
                    return {
                        item_jig: obj1.item_jig,
                        code: obj1.code,
                        qty: obj1.qty_per_unit,
                        unit: obj1.unit,
                        lokasi: obj1.lokasi,
                        status: obj1.status,
                        id: obj1.id,
                        toleransi: obj1.toleransi,
                }});
                /*------------ 
                data history loc
                ------------*/
                const history = await fetchDataWild('log_location_query',input.value);
                const filterData2 = history.filter(item =>
                    item.item_jig.toLowerCase().includes(input.value.toLowerCase())
                );
                const data2 = filterData2.map((obj1) => {
                    return {
                        item_jig: obj1.item_jig,
                        code: obj1.code,
                        qty: obj1.qty_per_unit,
                        unit: obj1.unit,
                        lokasi: obj1.lokasi,
                        status: obj1.status,
                        id: obj1.id,
                        toleransi: obj1.toleransi,
                        trans_date: new Date(obj1.trans_date),
                        id_log: obj1.id_log,
                        remark: obj1.remark,
                        addSub: obj1.addSub,
                        qtyChange: obj1.qty_change
                }});
                data2.sort((a, b) => b.trans_date - a.trans_date);
            /*------------ 
            view loc
            ------------*/
            const tableHTML = `
                <div class='fr thCont'>           
                    <div class='tableData tableHeader'>Location</div>
                    <div class='tableData tableHeader'>Qty per Unit</div>
                    <div class='tableData tableHeader'>add / substract</div>
                    <div class='tableData tableHeader'>Qty</div>
                    <div class='tableData tableHeader'>Unit</div>
                    <div class='tableData tableHeader'>Remark</div>
                </div>`;


            const tolHTML =`
            <div class="side">                      
                    <div class="card1"><label>Tolerance</label></div>
                    <input type="text" class="card2" name="tol" id="tol" value='${data[0].toleransi}' autocomplete="off">
            </div>`;

            let tableData = "";
            tableData += `
            <form method="POST">
            <div id='inputContainer4'>`;
            for (let i=0; i<data.length; i++) {
                tableData +=`                  
                    <div class='fr tdCont'> 
                        <div class='tableData'>
                            <input type="text" value="${data[i].lokasi}" name='loc_name[]' list="dataLokasi">
                        </div>
                        <div class='tableData'>
                            <input class="readonlyOFF" type="text" value="${data[i].qty}" name='qty_per_unit[]' readonly>
                        </div>
                        <div class='tableData'>
                            <select name='addSub[]' id='addSub'>
                                <option value='tambah'>tambah</option>
                                <option value='kurang'>kurang</option>
                            </select>
                        </div>
                        <div class='tableData'>
                            <input type="text" value="" name='qtyChange[]'>
                        </div>
                        <div class='tableData'>
                            <input type="text" value="${data[i].unit}" name='unit[]'> 
                        </div>
                        <div class='tableData'>
                            <input type="text" value="" name='remark[]'> 
                        </div>
                        <input type="hidden" value="${data[i].code}" name='code[]'> 
                        <input type="hidden" value="${data[i].status}" name='status[]'> 
                        <input type="hidden"  value="${data[i].id}" name='id[]'> 
                        <input type="hidden" value="${data[i].item_jig}" name='item_jig[]'> 
                    </div>`;
                }   
            const footer = `
            </div>
            </form>`;
            const buttonAdd2 = `<button type="submit" class="button-30" name="update_loc">update</button>`;
            const buttonAdd = `
                <button type="button" class="" id='addLoc'> 
                    add new
                </button>`;

            const finalHTML1 = tolHTML+tableHTML + tableData + buttonAdd + buttonAdd2 + footer;
            container.innerHTML = finalHTML1;

            /*------------ 
            view history loc
            ------------*/
            const h1 = document.createElement('h1');
            h1.innerText = 'History Log';
            container.appendChild(h1);
            const div =document.createElement('div');
            const header = `
            <div class='fr thCont'>           
                <div class='tableData tableHeader'>Location</div>
                <div class='tableData tableHeader'>Qty per Unit</div>
                <div class='tableData tableHeader'>Add / Substract</div>
                <div class='tableData tableHeader'>Qty</div>
                <div class='tableData tableHeader'>Unit</div>
                <div class='tableData tableHeader'>Tolerance</div>
                <div class='tableData tableHeader'>Remark</div>
                <div class='tableData tableHeader'>Transaction Date (d-m-y)</div>
            </div>`;
            let tableData2 = "";
            for (let i=0; i<data2.length; i++) {
                tableData2 += `
                <div class='fr tdCont'> 
                    <div class='tableData'>
                        ${data2[i].lokasi}
                    </div>
                    <div class='tableData'>
                        ${data2[i].qty}
                    </div>
                    <div class='tableData'>
                        ${data2[i].addSub}
                    </div>
                    <div class='tableData'>
                        ${data2[i].qtyChange}
                    </div>
                    <div class='tableData'>
                        ${data2[i].unit}
                    </div>
                    <div class='tableData'>
                        ${data2[i].toleransi}
                    </div>
                    <div class='tableData'>
                        ${data2[i].remark}
                    </div>
                    <div class='tableData'>
                        ${data2[i].trans_date.toLocaleDateString(`id-ID`)}
                    </div>
                </div>`;
            }
            const finalHTML = header + tableData2;
            div.innerHTML = finalHTML;
            container.appendChild(div);
        }else {
            console.log("Input does not match any datalist option.");
        }
        } catch (error){
            console.error('Error:', error);
        }
        document.getElementById("loading2").style.display="none";

/*======================================================= 
jig_Function
=======================================================*/
    } else if (event.target.getAttribute('id') == 'btnType') {
        document.getElementById("loading3").style.display="block";
        const container = document.getElementById('typeContain');
        const input = document.getElementById('typeSearch');
        const separator = " ";
        const filter2Sept = input.value.split(separator);
        const filterFix = filter2Sept[0];
        try {
            const result7 = await fetchData('jig_function_query');
            const result8 = await fetchData('item_detail_query');
            const userInput = input.value.toLowerCase(); 
            const listJig = document.getElementById('suggestion');
            const validation = Array.from(listJig.options).map(options => options.value.toLowerCase());
            if (validation.includes(userInput)) {

                /*------------ 
                data function
                ------------*/
                const data3 = result7.filter(item => item.item_type === filterFix && item.status === 'active');
                const dataGab = data3.map((obj1) => {
                    const matObj2 = result8.find((obj2) => obj2.pt_part === obj1.item_type);
                    return {
                        id: obj1.id,
                        item_type: obj1.item_type,
                        item_jig: obj1.item_jig,
                        status: obj1.status,
                        description: matObj2 ? matObj2.pt_desc1 + matObj2.pt_desc2:"",
                        status_type: matObj2 ? matObj2.pt_status: " ",
                        opt_on: obj1.opt_on,
                        opt_off: obj1.opt_off
                    }
                })

                /*------------ 
                data history function
                ------------*/
                const history = await fetchDataWild('log_function_query',filterFix);
                const filterData2 = history.filter(item =>
                    item.item_type.toLowerCase().includes(filterFix.toLowerCase())
                );
                const data2 = filterData2.map((obj1) => {
                    const matObj2 = result8.find((obj2) => obj2.pt_part === obj1.item_type);
                    return {
                        id: obj1.id,
                        item_type: obj1.item_type,
                        item_jig: obj1.item_jig,
                        status: obj1.status,
                        description: matObj2 ? matObj2.pt_desc1 + matObj2.pt_desc2:" ",
                        status_type: matObj2 ? matObj2.pt_status: " ",
                        opt_on: obj1.opt_on,
                        opt_off: obj1.opt_off,
                        remark: obj1.remark,
                        trans_date: new Date(obj1.trans_date)
                }});
                data2.sort((a, b) => b.trans_date - a.trans_date);

                /*------------ 
                view function
                ------------*/
                const statusSpeakerHTML =`
                <div class="side">                      
                        <div class="card1"><label>Status Speaker</label></div>
                        <input type="text" class="card2 readonlyOFF" name="tol" id="tol" value='${dataGab[0].status_type}' autocomplete="off" readonly>
                </div>`;

                const tableHTML = `
                <div class='tableFlex'>           
                    <div class='tableData tableHeader'>Item Jig</div>
                    <div class='tableData tableHeader'>Put On Ops</div>
                    <div class='tableData tableHeader'>Pull Out Ops</div>
                    <div class='tableData tableHeader'>Status</div>
                    <div class='tableData tableHeader'>Remark</div>
                    <div class='tableData tableHeader'>Delete</div>
                </div>`;

                let tableData = "";
                tableData += `<form method="POST">
                <div id='inputContainer2'>`;
                for (let i=0; i<dataGab.length; i++) {
                    tableData +=`
                        <div class='tableFlex'> 
                            <div class="tableData">
                                <input type="text" value="${dataGab[i].item_jig}" id='jigList0' name='item_jig[]' list='jig_suggest'> 
                            </div>
                            <div class="tableData">
                                <input type="text" value="${dataGab[i].opt_on}" name='opt_on[]'> 
                            </div>
                            <div class="tableData">
                                <input type="text" value="${dataGab[i].opt_off}" name='opt_off[]'> 
                            </div>
                            <div class="tableData" id='statView_${dataGab[i].id}'>
                                ${dataGab[i].status}
                            </div>
                            <div class="tableData">
                                <input type="text" value="" id="remark"name='remark2[]'> 
                            </div>
                            <input type="hidden" value="active" id='stat_${dataGab[i].id}' name='status[]'>  
                            <input type="hidden" value="${dataGab[i].id}" id='id_func' name='id_func[]'> 
                            <div class="tableData">
                                <button type="button" id="del_${dataGab[i].id}">delete
                            </button>
                            </div>
                        </div>`;
                    }
                const footer =`</div>`;

                const buttonAdd2 = `
                <button type="submit" class="button-30" name="update_type">
                    update
                </button>`;

                const buttonAdd = `
                <button type="button" class='' id='addType'>
                    add new
                </button>`;

                const finalHTML = statusSpeakerHTML + tableHTML + tableData + footer + buttonAdd + buttonAdd2;
                container.innerHTML = finalHTML;

                /*------------ 
                view history function
                ------------*/
                const h1 = document.createElement('h1');
                h1.innerText = 'History Log';
                container.appendChild(h1);
                const div = document.createElement('div');
                const header = `
                <div class='tableFlex'>           
                    <div class='tableData tableHeader'>Item Jig</div>
                    <div class='tableData tableHeader'>Put On Ops</div>
                    <div class='tableData tableHeader'>Pull Out Ops</div>
                    <div class='tableData tableHeader'>Status</div>
                    <div class='tableData tableHeader'>Remark</div>
                    <div class='tableData tableHeader'>Transaction Date (d-m-y)</div>
                </div>`;
                let tableData2 = "";
                for (let i=0; i<data2.length; i++) {
                    tableData2 += `
                    <div class='tableFlex'> 
                        <div class='tableData'>
                            ${data2[i].item_jig}
                        </div>
                        <div class='tableData'>
                            ${data2[i].opt_on}
                        </div>
                        <div class='tableData'>
                            ${data2[i].opt_off}
                        </div>
                        <div class='tableData'>
                            ${data2[i].status}
                        </div>
                        <div class='tableData'>
                            ${data2[i].remark}
                        </div>
                        <div class='tableData'>
                            ${data2[i].trans_date.toLocaleDateString(`id-ID`)}
                        </div>
                    </div>`;
                }
                const finalHTML1 = header + tableData2;
                div.innerHTML = finalHTML1;
                container.appendChild(div);

            } else {
                console.log("Input does not match any datalist option.");
            }
        } catch (error){
            console.error('Error:', error);
        }
        document.getElementById("loading3").style.display="none";
    }
})


document.addEventListener("click", async function(event) {
    if (event.target.getAttribute('id') !== null && event.target.getAttribute('id').includes('del')) {
        const idTarget = event.target.getAttribute('id');
        const del = document.getElementById(idTarget);
        const delimiter = "_";
        const idStat = idTarget.split(delimiter);
        const statTarget = document.getElementById(`stat_${idStat[idStat.length -1]}`);
        const statViewTarget = document.getElementById(`statView_${idStat[idStat.length -1]}`);
        if (del.innerText == 'delete' ) {
            del.innerText = 'undo';
            statTarget.value = 'SPSD';
            statViewTarget.innerText = 'SPSD';
        } else {
            del.innerText = 'delete';
            statTarget.value = 'active';
            statViewTarget.innerText = 'ACTIVE';
        }
    } else if (event.target.getAttribute('id') === 'addLoc') {
        const target = document.getElementById('inputContainer4');
        const div = document.createElement('div');
        div.classList.add('tableFlex');
        const addloc2 = `
            <div class='tableData'>
                <input type="text" value="" name='loc_name[]' list="dataLokasi">
            </div>
            <div class='tableData'>
                <input class="readonlyOFF" type="text" value="0" name='qty_per_unit[]' readonly>
            </div>
            <div class='tableData'>
            <select name='addSub[]' id='addSub' placeholder='-choose-'>
                <option value='tambah'>tambah</option>
                <option value='kurang'>kurang</option>
            </select>
            </div>
            <div class='tableData'>
                <input type="text" value="" name='qtyChange[]' placeholder='qty'>
            </div>
            <div class='tableData'>
                <input type="text" value="pcs" name='unit[]'> 
            </div>
            <div class='tableData'>
                <input type="text" value="" name='remark[]' placeholder='remark'> 
            </div>
            <input type="hidden" value="" name='code[]'> 
            <input type="hidden" value="" name='status[]'> 
            <input type="hidden"  value="" name='id[]'> 
            <input type="hidden" value="" name='item_jig[]'>`;
        div.innerHTML = addloc2;
        target.appendChild(div);
    } else if (event.target.getAttribute('id') === 'addType') {
        const target = document.getElementById('inputContainer2');
        const div = document.createElement('div');
        div.classList.add('tableFlex');
        const addloc2 = `
            <div class="tableData">
                <input type="text" value="" id='jigList0' name='item_jig[]' placeholder='-choose-' list='jig_suggest'> 
            </div>
            <div class="tableData">
                <input type="text" value="" name='opt_on[]' placeholder='operation pasang'> 
            </div>
            <div class="tableData">
                <input type="text" value="" name='opt_off[]' placeholder='operation lepas'> 
            </div>
            <div class="tableData">
                <input type="text" value="" id="remark" name='remark2[]' placeholder='remark'> 
            </div>
            <div class="tableData">
                <button type="button" id="del" >delete</button>
            </div>
            <input type="hidden" value="active" id='stat' name='status[]'>  
            <input type="hidden" value=" id='id_func' name='id_func[]'> `;
        div.innerHTML = addloc2;
        target.appendChild(div);
}})

