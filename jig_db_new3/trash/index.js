/*===================================================================================
initial load
===================================================================================*/
document.addEventListener('DOMContentLoaded', async function() {
    const currentUrl = window.location.href;
    const specificUrls = 'http://192.168.2.103:8080/wbd/jig_db_new/';
    const extractedPortion = currentUrl.substring(0,specificUrls.length);
    if (extractedPortion == specificUrls){
        const inputFilter = document.getElementById('filter');
        const switchJig = document.getElementById('searchJig');
        document.getElementById("loading").style.display="block";
        const role = document.getElementById('role');
        try {
            let result10 = await fetchData('jig_master_query');
            let result9 = await fetchData('jig_location_query');          
            const typeMap = new Map();
            result9.forEach(item => {     
                if (typeMap.has(item.item_jig)) {
                    const existingItem = typeMap.get(item.item_jig);
                    existingItem.qty += parseInt(item.qty_per_unit);
                    existingItem.toleransi = item.toleransi;
                } else {
                    const newItem = {
                    item_jig: item.item_jig,
                    qty: parseInt(item.qty_per_unit),
                    toleransi: parseInt(item.toleransi),
                    };
                    typeMap.set(item.item_jig, newItem);
                }
            });
            const summedData = Array.from(typeMap.values());
            let data = result10.map((obj1) => {
                    const matchedObj = summedData.find((obj2) => obj2.item_jig === obj1.item_jig);
                    const qtyOH = role.value === "admin" || role.value === "superuser" ?
                    (matchedObj ? matchedObj.qty : 0) :
                    (matchedObj ? Math.floor(matchedObj.qty * (100 - matchedObj.toleransi) / 100) : 0);
                    return {
                        item_jig: obj1.item_jig,
                        desc_jig: obj1.desc_jig,
                        type_jig: obj1.type !== undefined ? obj1.type: "",
                        status_jig: obj1.status_jig,
                        tolerance: parseInt(matchedObj ? matchedObj.tolerance : 0),
                        material: obj1.material !== undefined ? obj1.material: "",
                        qtyOnHand: qtyOH,
                        filter: `${obj1.item_jig}`+"  --  " +`${obj1.desc_jig}`+"  --  " +`${obj1.type !== undefined ? obj1.type : ""}`+"  --  " +`-${obj1.status_jig}${obj1.material !== undefined ? obj1.material : ""}`+"  --  " +`-${matchedObj ? matchedObj.qty_per_unit : 0}`,
                }});
            let target = document.getElementById('tableResult');
            populateTableWithData(data, target);
            switchJig.addEventListener("click", async () => {
                    while (tableResult.firstChild) {
                        tableResult.removeChild(tableResult.firstChild);
                    }
                    const filter1 = inputFilter.value;
                    const filterData1 = data.filter(item =>
                        item.filter.toLowerCase().includes(filter1.toLowerCase())
                    );
                    const resultData1 = filterData1.map((obj1) => {
                        return {
                            item_jig: obj1.item_jig,
                            desc_jig: obj1.desc_jig,
                            type_jig: obj1.type_jig !== undefined ? obj1.type_jig: "",
                            tolerance: obj1.toleransi,
                            status_jig: obj1.status_jig,
                            material: obj1.material !== undefined ? obj1.material: "",
                            qtyOnHand: obj1 ? obj1.qtyOnHand : 0,
                    }});
                    populateTableWithData(resultData1, target);
            })
        } catch (error){
            console.error('Error:', error);
            let target = document.getElementById('tableResult');
            target.textContent = 'Error please refresh';
            document.body.appendChild(target);
        }
        document.getElementById("loading").style.display="none";

    }
}
)

function populateTableWithData(data, target) {
    keyArray = ['Item Number Jig','Desc Jig','Jig Type','Status Jig','Material','Qty On Hand', 'Detail'];
    keyArray2 = ['item_jig','desc_jig','type_jig','status_jig','material','qtyOnHand'];
    const table = document.createElement('table');
    table.classList.add('table');
    const tableBody = document.createElement('tbody');
    tableBody.setAttribute('id','mainTBody');
    target.appendChild(table);
    let tr = document.createElement('tr');
    // outside table
    //table header 
    for (let i = 0; i < keyArray.length; i++) {
        let th = document.createElement('th');
        th.className = 'tbl-header';
        th.innerText = keyArray[i];
        tr.appendChild(th);
        }
    tableBody.appendChild(tr);
    // insert data ke table header
    for (let i = 0; i < data.length; i++) {
        const clonedTr = tr.cloneNode(false);
        // masukkan data sesuai keyArray2 diatas
        for (let ii = 0; ii < keyArray2.length; ii++) {
            let value = data[i][keyArray2[ii]] !== undefined ? data[i][keyArray2[ii]] : '';
            const td = document.createElement('td');
            td.className = 'tbl-value';
            td.innerText = value;
            clonedTr.appendChild(td);
            }

        // penambahan button utk hidden table type
        const btn = document.createElement('button');
        btn.setAttribute('id','type_'+`${data[i].item_jig}`);
        btn.setAttribute('type', 'button');
        btn.textContent = 'Detail Type';
        document.body.appendChild(btn);
        clonedTr.appendChild(btn);

        // penambahan button utk hidden table lokasi
        const cloneBtn = btn.cloneNode(false);
        cloneBtn.setAttribute('id','loc_'+`${data[i].item_jig}`);
        cloneBtn.setAttribute('type', 'button');
        cloneBtn.textContent = 'Detail Lokasi';
        document.body.appendChild(cloneBtn);
        clonedTr.appendChild(cloneBtn);
        
        // penambahan hidden div 
        const clonedTr2 = tr.cloneNode(false);
        //create td dengan attribute colspan=8
        const td = document.createElement('td');
        td.setAttribute('colspan',keyArray.length);
        //create hidden div
        const div = document.createElement('div');
        div.classList.add('hiddenDiv');
        div.setAttribute('id','hiddenDiv_'+`${data[i].item_jig}`);
        const div2 = document.createElement('div');
        div2.classList.add('hiddenDiv2');
        div2.setAttribute('id','hiddenDiv2_'+`${data[i].item_jig}`);
        const div3 = document.createElement('div');
        div3.textContent = "Loading...";
        div3.style.display = "none";
        div3.setAttribute('id','loading_'+`${data[i].item_jig}`);
        td.appendChild(div3);
        td.appendChild(div);
        td.appendChild(div2);
        clonedTr2.appendChild(td);
        tableBody.appendChild(clonedTr);
        tableBody.appendChild(clonedTr2);
    }
    table.appendChild(tableBody);
}


/*===================================================================================
click eventListener
===================================================================================*/
/*--------------------------------
hidden table part from database jig
--------------------------------*/
document.addEventListener("click", async function(event) {
    // Check if the clicked element is a button with type attribute 'button'

    if (event.target.getAttribute('type') === 'button') {
        if (event.target.getAttribute('id').includes('type_')) {
            // Get the id attribute using 'this'
            const buttonId = event.target.getAttribute('id');
            let cekFilter = buttonId.split("_");
            let valueId = cekFilter[1];
            const load = document.getElementById('loading_' + valueId);
            const hiddenDiv = document.getElementById('hiddenDiv_' + valueId);
            const hiddenDiv2 = document.getElementById('hiddenDiv2_' + valueId);
            if (hiddenDiv.firstChild === null) {
                load.style.display = "block";
                hiddenDiv2.style.display='none';
                try {
                        /*
                        for type speaker
                        */
                        let result7 = await fetchDataWild('jig_function_query2', valueId);
                        let result8 = await fetchData('item_detail_query');
                        const filterData = result7.filter(item => item.item_jig === valueId);
                        const data = filterData.map((obj1) => {
                                const matObj = result8.find((obj2) => obj2.pt_part === obj1.item_type);
                                return {
                                    item_jig: obj1.item_jig,
                                    item_type:obj1 ? obj1.item_type : "-",
                                    description:  matObj ? matObj.pt_desc1 : "-",
                                    status_type: matObj ? matObj.pt_status : "-",
                                    opt_on: obj1 !==undefined ? obj1.opt_on: 0,
                                    opt_off: obj1 !==undefined ? obj1.opt_off: 0
                            }
                        });
                        keyArray1 = ['Item Number Speaker', 'Desc Speaker','Status Speaker','Put On Ops','Pull Out Ops'];
                        keyArray2 = ['item_type','description','status_type','opt_on','opt_off'];
                        // create new table hidden
                        const tableHidden = document.createElement('table');
                        tableHidden.classList.add('inside');
                        const tableBody = document.createElement('tbody');
                        const tr = document.createElement('tr');
                        // input table header
                        for (let i = 0; i < keyArray1.length; i++) {
                            const th = document.createElement('th');
                            th.className = 'tbl-header';
                            th.innerText = keyArray1[i];
                            tr.appendChild(th);
                            tableBody.appendChild(tr);
                        }
                        //showing data utk setiap data
                        for (let i = 0; i < data.length; i++) {
                            const clonedTr = tr.cloneNode(false);
                            for (let ii = 0; ii < keyArray2.length; ii++) {
                                let value = data[i][keyArray2[ii]] !== undefined ? data[i][keyArray2[ii]] : '';
                                const td = document.createElement('td');
                                td.className = 'tbl-value';
                                td.innerText = value;
                                clonedTr.appendChild(td);
                                }
                            tableBody.appendChild(clonedTr);
                        }
                        tableHidden.appendChild(tableBody);
                        hiddenDiv.appendChild(tableHidden);
                        hiddenDiv.style.display = "block";
                        load.style.display = "none";
                    } catch (error) {
                        console.log('error: ', error);
                    }
                } else if (hiddenDiv.firstChild !== null) {
                    if(hiddenDiv.style.display === "none" && hiddenDiv2.style.display==='block') {
                        hiddenDiv2.style.display = "none";
                        hiddenDiv.style.display = "block";
                    } else if (hiddenDiv.style.display === "none" && hiddenDiv2.style.display==='none'){
                        hiddenDiv.style.display = "block";
                    } else if (hiddenDiv.style.display === "block") {
                        hiddenDiv.style.display = 'none';
                    }
                }           
        } else if (event.target.getAttribute('id').includes('loc_')) {   
            // Get the id attribute using 'this'
            const buttonId = event.target.getAttribute('id');
            let cekFilter = buttonId.split("_");
            let valueId = cekFilter[1];
            const load = document.getElementById('loading_' + valueId);
            const hiddenDiv = document.getElementById('hiddenDiv_' + valueId);
            const hiddenDiv2 = document.getElementById('hiddenDiv2_' + valueId);
            if (hiddenDiv2.firstChild === null) {
                load.style.display = "block";
                hiddenDiv.style.display='none';
                try {
                    /*
                    for location
                    */
                    let data2 = [];
                    let result9 = await fetchDataWild('jig_location_query2', valueId);
                    const filterData2 = result9.filter(item => item.item_jig === valueId);
                    if (role.value === "admin" || role.value === "superuser") {
                        data2 = filterData2.map((obj1) => {
                            return {
                                lokasi: obj1.lokasi,
                                qty_per_unit: parseInt(obj1 ? obj1.qty_per_unit :0),
                                unit: obj1 ? obj1.unit:""
                            }});
                        } else {
                        data2 = filterData2.map((obj1) => {
                            return {
                                lokasi: obj1.lokasi,
                                qty_per_unit: obj1 ? Math.floor(parseInt(obj1.qty_per_unit) * (100-parseInt(obj1.toleransi)) / 100) :0,
                                unit: obj1 ? obj1.unit:""
                            }});
                        }
                    keyArray3 = ['Location', 'qty per unit','unit'];
                    keyArray4 = ['lokasi','qty_per_unit','unit'];
                    const tableHidden2 = document.createElement('table');
                    tableHidden2.classList.add('inside');
                    const tableBody2 = document.createElement('tbody');
                    const tr2 = document.createElement('tr');
                    // input table header
                    for (let i = 0; i < keyArray3.length; i++) {
                        const th = document.createElement('th');
                        th.className = 'tbl-header';
                        th.innerText = keyArray3[i];
                        tr2.appendChild(th);
                        tableBody2.appendChild(tr2);
                        }
                    //showing data utk setiap data
                    for (let i = 0; i < data2.length; i++) {
                        const clonedTr = document.createElement('tr');
                        for (let ii = 0; ii < keyArray4.length; ii++) {
                            let value = data2[i][keyArray4[ii]] !== undefined ? data2[i][keyArray4[ii]] : '';
                            const td = document.createElement('td');
                            td.className = 'tbl-value';
                            td.innerText = value;
                            clonedTr.appendChild(td);
                            }
                        tableBody2.appendChild(clonedTr);
                    }
                    tableHidden2.appendChild(tableBody2);
                    hiddenDiv2.appendChild(tableHidden2);
                    hiddenDiv2.style.display = 'block';
                    load.style.display = 'none';
                } catch (error) {
                    console.log('error:', error);
                }
            } else if (hiddenDiv2.firstChild !== null) {
                if(hiddenDiv2.style.display === "none" && hiddenDiv.style.display==='block') {
                    hiddenDiv.style.display = "none";
                    hiddenDiv2.style.display = "block";
                } else if (hiddenDiv2.style.display === "none" && hiddenDiv.style.display==='none'){
                    hiddenDiv2.style.display = "block";
                } else if (hiddenDiv2.style.display === "block") {
                    hiddenDiv2.style.display = "none";
                }
            }  
        } else if (event.target.getAttribute('id') === 'switchType') {
            /*--------------------------------
            hidden table base on type
            --------------------------------*/
            const switchType = document.getElementById('switchType');
            const switchJig = document.getElementById('switchJig');
            switchType.classList.add('actOn');
            switchJig.classList.remove('actOn');
            const filter2 = document.getElementById('filter2');
            const searchType = document.getElementById('searchType');
            const container1 = document.getElementById('tableResult');
            const container2 = document.getElementById('typeResult');
            const jigHeader = document.getElementById('jigHeader');
            const typeHeader = document.getElementById('typeHeader');
            document.getElementById("loading").style.display="block";
            jigHeader.classList.add('hideOn');
            jigHeader.classList.remove('hideOff', 'active');
            typeHeader.classList.add('hideOff', 'active');
            typeHeader.classList.remove('hideOn');
            container1.classList.remove('active');
            container2.classList.add('active');
            if (container2.firstChild == " "){
                document.getElementById("loading").style.display="none";
            } else {
                try {
                    let result10 = await fetchData('jig_master_query');
                    let result9 = await fetchData('jig_location_query');          
                    const typeMap = new Map();
                    result9.forEach(item => {     
                        if (typeMap.has(item.item_jig)) {
                            const existingItem = typeMap.get(item.item_jig);
                            existingItem.qty += parseInt(item.qty_per_unit);
                            existingItem.toleransi = item.toleransi;
                        } else {
                            const newItem = {
                            item_jig: item.item_jig,
                            qty: parseInt(item.qty_per_unit),
                            toleransi: parseInt(item.toleransi),
                            };
                            typeMap.set(item.item_jig, newItem);
                        }
                    });
                    const summedData = Array.from(typeMap.values());

                    let result7 = await fetchData('jig_function_query');
                    let result8 = await fetchData('item_detail_query');
                    const data = result7.map((obj1) => {
                        const matchedObj = result8.find((obj2) => obj2.pt_part === obj1.item_type);
                        
                        return {
                            item_type: obj1.item_type,
                            description: `${matchedObj ? matchedObj.pt_desc1 : ""}-${matchedObj ? matchedObj.pt_desc2 : ""}`,
                            status_speaker: matchedObj ? matchedObj.pt_status :"",
                            item_jig: obj1.item_jig,
                            opt_on: obj1.opt_on,
                            opt_off: obj1.opt_off,
                            filter: `${obj1.item_type}`+"  --  "+`${matchedObj ? matchedObj.pt_desc1 : ""}-${matchedObj ? matchedObj.pt_desc2 : ""}`+"  --  "+`${matchedObj ? matchedObj.pt_status :""}`+"  --  "+`${obj1.item_jig}`+"  --  "+`${obj1.opt_on}`+"  --  "+`${obj1.opt_off}`
                    }});
                    data.sort((a, b) => {
                        if (a.item_type < b.item_type) return -1;
                        if (a.item_type > b.item_type) return 1;
                        return 0;
                    });
                    populateTableWithData2(data, container2);
                    searchType.addEventListener("click", async () => {
                        while (container2.firstChild) {
                            container2.removeChild(container2.firstChild);
                        }
                        const filterValue = filter2.value;
                        const filterData1 = data.filter(item =>
                            item.filter.toLowerCase().includes(filterValue.toLowerCase())
                        );
                        const resultData1 = filterData1.map((obj1) => {
                            return {
                                item_type: obj1.item_type,
                                description: obj1.description,
                                status_speaker: obj1.status_speaker,
                                item_jig: obj1.item_jig,
                                opt_on: obj1.opt_on,
                                opt_off: obj1.opt_off
                        }});
                        resultData1.sort((a, b) => {
                            if (a.item_type < b.item_type) return 1;
                            if (a.item_type > b.item_type) return -1;
                            return 0;
                        });
                        populateTableWithData2(resultData1, container2);
                    })

                } catch (error){
                    console.error('Error:', error);
                    container2.textContent = 'Error please refresh';
                    document.body.appendChild(container2);
                }
                document.getElementById("loading").style.display="none";
            }
        } else if (event.target.getAttribute('id') === 'switchJig') {
            const switchType = document.getElementById('switchType');
            const switchJig = document.getElementById('switchJig');
            switchType.classList.remove('actOn');
            switchJig.classList.add('actOn');
            document.getElementById("loading").style.display="block";
            const container1 = document.getElementById('tableResult');
            const container2 = document.getElementById('typeResult');
            const jigHeader = document.getElementById('jigHeader');
            const typeHeader = document.getElementById('typeHeader');
            jigHeader.classList.remove('hideOn');
            jigHeader.classList.add('hideOff', 'active');
            typeHeader.classList.remove('hideOff', 'active');
            typeHeader.classList.add('hideOn');
            container1.classList.add('active');
            container2.classList.remove('active');
            document.getElementById("loading").style.display="none";
        } else if (event.target.getAttribute('id') === 'addFilterJig') {
            const data = ["item_jig","desc_jig","type_jig","status_jig","tolerance","material","qtyOnHand"];
            const container = document.getElementById('jigHeader');
            const select = document.createElement('select');
            select.id = 'selectJigFilter';
            for (let i=0; i<data.length; i++){
              const option = document.createElement('option');
              option.value = data[i];
              option.textContent = data[i];
              select.appendChild(option);
            }
            container.appendChild(select);
            const input = document.createElement('input');
            input.class = 'selectJigValue';
            container.appendChild(input);
        } else if (event.target.getAttribute('id') === 'addFilterType') {
            const data = ["item_type","description","status_speaker","item_jig","opt_on","opt_off"];
            const container = document.getElementById('typeHeader');
            const select = document.createElement('select');
            select.id = 'selectTypeFilter';
            for (let i=0; i<data.length; i++){
              const option = document.createElement('option');
              option.value = data[i];
              option.textContent = data[i];
              select.appendChild(option);
            }
            container.appendChild(select);
            const input = document.createElement('input');
            input.class = 'selectTypeValue';
            container.appendChild(input);
        } else if( event.target.getAttribute('id') === 'download_xls1') {
            // Create a new workbook
            const inputFilter = document.getElementById('filter');
            const workbook = XLSX.utils.book_new();
            let result10 = await fetchData('jig_master_query');
            let result9 = await fetchData('jig_location_query');  
            let data = result10.map((obj1) => {
                const matchedObj = result9.find((obj2) => obj2.item_jig === obj1.item_jig);
                // Use Object.values() to get all property values, filter out undefined values, and join them with a separator
                const filterValue = Object.values({
                    ...obj1, // Spread properties from obj1
                    qty: matchedObj ? matchedObj.qty_per_unit : 0,
                    unit: matchedObj ? matchedObj.unit : "pcs",
                    loc: matchedObj ? matchedObj.lokasi : "belum ditentukan" // Spread properties from obj2
                })
                .filter(value => value !== undefined)
                .join(' --  '); // You can change the separator as needed
                return {
                    ...obj1,
                    qty: matchedObj ? matchedObj.qty_per_unit : 0,
                    unit: matchedObj ? matchedObj.unit : "pcs",
                    loc: matchedObj ? matchedObj.lokasi : "belum ditentukan",
                    filter: filterValue // Add the 'filter' property with the concatenated value
                };
            });
            // Create a worksheet
            const filter1 = inputFilter.value;
            const filterData1 = data.filter(item =>
                item.filter.toLowerCase().includes(filter1.toLowerCase())
            );
            const worksheet = XLSX.utils.json_to_sheet(filterData1);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

            // Generate an Excel file
            XLSX.writeFile(workbook, 'db jig per jig.xlsx');
        } else if( event.target.getAttribute('id') === 'download_xls2') {
            // Create a new workbook
            const inputFilter2 = document.getElementById('filter2');
            const workbook = XLSX.utils.book_new();
            let result10 = await fetchData('jig_master_query');
            let result9 = await fetchData('jig_function_query');
            let result8 = await fetchData('item_detail_query');
            let data = result10.map((obj1) => {
                const matchedObj = result9.find((obj2) => obj2.item_jig === obj1.item_jig) || {};
                const matchedObj2 = result8.find((obj3) => obj3.pt_part === (matchedObj.item_type || "")) || {};
            
                // Calculate the values you need
                const item_type = matchedObj.item_type || "";
                const desc_type = (matchedObj2.pt_desc1 || "") + " " + (matchedObj2.pt_desc2 || "");
                const stat_speaker = matchedObj2.pt_status || "";
                const opt_on = matchedObj.unit || "pcs";
                const opt_off = matchedObj.lokasi || "belum ditentukan";
            
                // Create the object
                const filterValue = [obj1.item_type, desc_type, stat_speaker, opt_on, opt_off]
                    .filter(value => value !== undefined && value !== "")
                    .join(' -- ');
            
                return {
                    item_type,
                    desc_type,
                    stat_speaker,
                    opt_on,
                    opt_off,
                    ...obj1,
                    filter: filterValue
                };
            });
            const filter2 = inputFilter2.value;
            const filterData2 = data.filter(item =>
                item.filter.toLowerCase().includes(filter2.toLowerCase())
            );
            console.log(filterData2);
            // Create a worksheet
            const worksheet = XLSX.utils.json_to_sheet(filterData2);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');

            // Generate an Excel file
            XLSX.writeFile(workbook, 'db jig per jig.xlsx');
    }}
}
)
            
function populateTableWithData2(data, target) {
    keyArray = ['Item Number Speaker','Description','Status Speaker','item number jig','Put On Ops','Pull Out Ops'];
    keyArray2 = ['item_type','description','status_speaker','item_jig','opt_on','opt_off'];
    const table = document.createElement('table');
    table.classList.add('table');
    const tableBody = document.createElement('tbody');
    tableBody.setAttribute('id','mainTBody');
    target.appendChild(table);
    let tr = document.createElement('tr');
    // outside table
    //table header 
    for (let i = 0; i < keyArray.length; i++) {
        let th = document.createElement('th');
        th.className = 'tbl-header';
        th.innerText = keyArray[i];
        tr.appendChild(th);
        }
    tableBody.appendChild(tr);
    // insert data ke table header
    for (let i = 0; i < data.length; i++) {
        const clonedTr = tr.cloneNode(false);
        // masukkan data sesuai keyArray2 diatas
        for (let ii = 0; ii < keyArray2.length; ii++) {
            let value = data[i][keyArray2[ii]] !== undefined ? data[i][keyArray2[ii]] : '';
            const td = document.createElement('td');
            td.className = 'tbl-value';
            td.innerText = value;
            clonedTr.appendChild(td);
            }
        tableBody.appendChild(clonedTr);
    }
    target.appendChild(tableBody);
}


