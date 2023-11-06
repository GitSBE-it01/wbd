import { dataSpk } from './tableSpk.js';
import { loading } from './load.js';
import { tblLocJig, tblTypeJig } from './table.js';
import { dataTableLoc, dataTableType } from './tableHid.js';

/*
===============================================================================
fungsi enter untuk menjalankan fungsi search
===============================================================================
*/
const searchBarSpk = document.getElementById('searchSpk');
searchBarSpk.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        const searchBtnSpk = document.getElementById('btnSpk');
        searchBtnSpk.click()
    }
})


const searchBarJig = document.getElementById('searchJig');
searchBarJig.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        const searchBtnJig = document.getElementById('btnJig');
        searchBtnJig.click()
    }
})

/*
===============================================================================
klik switch utk ganti search jig atau search speaker
===============================================================================
*/
const jigSwitch = document.getElementById('btnSec1');
jigSwitch.addEventListener("click", function() {  
    const jigTbl = document.getElementById('tableJig');
    const spkTable = document.getElementById('tableSpk');
    const spkSearch = document.getElementById('divSpkSearch');
    const jigSearch = document.getElementById('divJigSearch');
    if(jigTbl.classList.contains('hide')) {
        spkTable.classList.add('hide');
        jigTbl.classList.remove('hide');
        spkSearch.style.display = 'none';
        jigSearch.style.display = 'block';
    }
    return;
})

//switch for speaker table unhide speaker table dan hide jig table
const spkSwitch = document.getElementById('btnSec2');
spkSwitch.addEventListener("click", function() {  
    const spkTable = document.getElementById('tableSpk');
    const jigTbl = document.getElementById('tableJig');
    const spkSearch = document.getElementById('divSpkSearch');
    const jigSearch = document.getElementById('divJigSearch');
    spkSearch.style.display = 'block';
    jigSearch.style.display = 'none';
    if (spkTable == null) {
        jigTbl.classList.add('hide');
        dataSpk();
        return;
    }
    if (spkTable.classList.contains('hide')) {
        spkTable.classList.remove('hide');
        jigTbl.classList.add('hide');
    }
    return;
})

/*
============================================================================
hidden table utk jig table
============================================================================
*/
// location 
document.addEventListener("click", async function(event) {    
    try{
        const buttonId = event.target.getAttribute('id');
        const cekFilter = buttonId.split("_");
        const valueId = cekFilter[1];
        const hidDiv = document.getElementById(`hid_${valueId}`);
        const hidDiv2 = document.getElementById(`hid2_${valueId}`);
        // location
        if (event.target.getAttribute('id').includes('loc_')) {
            if (hidDiv.classList.contains('hide')) {
                hidDiv.classList.remove('hide');
                if (!hidDiv2.classList.contains('hide')) {
                    hidDiv2.classList.add('hide');
                }
                if (hidDiv.firstChild) {
                    return;
                }
                hidDiv.appendChild(loading('load','loading2'));
                const respons = await dataTableLoc(valueId);
                const arr = ['Location', ' qty per unit', 'unit'];
                tblLocJig(`hid_${valueId}`,arr, respons );
                hidDiv.removeChild(document.getElementById('load'));
                return;
            }
            hidDiv.classList.add('hide');
            return;
        } 
        // type
        if (event.target.getAttribute('id').includes('type_')) {
            if (hidDiv2.classList.contains('hide')) {
                hidDiv2.classList.remove('hide');
                if (!hidDiv.classList.contains('hide')) {
                    hidDiv.classList.add('hide');
                }
                if (hidDiv2.firstChild) {
                    return;
                }
                hidDiv2.appendChild(loading('load','loading2'));
                const respons = await dataTableType(valueId);
                const arr =['Item Number Speaker', 'Desc Speaker','Status Speaker','Put On Ops','Pull Out Ops'];
                tblTypeJig(`hid2_${valueId}`,arr, respons );
                hidDiv2.removeChild(document.getElementById('load'));
                return;
            }
            hidDiv2.classList.add('hide');
            return;
        }
    } catch(error){
        console.log(error);
    }
})

/*
============================================================================
download excel
============================================================================
*/
import  { jig_master_query, jig_location_query, jig_function_query, item_detail_query } from '../class.js';

const btnJig2 = document.getElementById('btnJigXls');
btnJig2.addEventListener("click", async function() {
    try {
        btnJig2.textContent = "";
        btnJig2.classList.add('load_txt');
        const inputFilter = document.getElementById('searchJig');
        const workbook = XLSX.utils.book_new();
        const src1 = await jig_master_query.getData();
        const src2 = await jig_location_query.getData();
        let data = src1.map((obj1) => {
            const matchedObj = src2.find((obj2) => obj2.item_jig === obj1.item_jig);
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
        XLSX.writeFile(workbook, 'db_jig_download.xlsx');
        btnJig2.classList.remove('load_txt');
        btnJig2.textContent = "dl excel";
        } catch(error) {
            console.log(error);
        }
})


const btnSpk2 = document.getElementById('btnSpkXls');
btnSpk2.addEventListener("click", async function() {
    try {
        btnSpk2.textContent = "";
        btnSpk2.classList.add('load_txt');
        const inputFilter = document.getElementById('searchSpk');
        const workbook = XLSX.utils.book_new();
        const src1 = await jig_master_query.getData();
        const src2 = await jig_location_query.getData();
        const typeMap = new Map();
            src2.forEach(item => {     
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
        const src3 = await jig_function_query.getData();
        const src4 = await item_detail_query.getData();
        const data = src1.map((item1) => {
            const matchedObj = summedData.find((item2) => item2.item_jig === item1.item_jig);
            const matchedObj2 = src3.find((item3) => item3.item_jig === item1.item_jig);
            const matchedObj3 = src4.find((item4) => item4.pt_part === matchedObj2?.item_type);
        
            const qtyOH =
                role.value === "admin" || role.value === "superuser"
                ? matchedObj?.qty || 0
                : Math.floor((matchedObj?.qty || 0) * (100 - (matchedObj?.toleransi || 0)) / 100);
        
            return {
            item_type: matchedObj2?.item_type || "",
            description: `${matchedObj3?.pt_desc1 || ""}-${matchedObj3?.pt_desc2 || ""}`,
            status_speaker: matchedObj3?.pt_status || "",
            item_jig: item1.item_jig,
            status_jig: item1.status_jig,
            material: item1.material,
            opt_on: matchedObj2?.opt_on || "",
            opt_off: matchedObj2?.opt_off || "",
            desc_jig: item1.desc_jig || "",
            qtyOnHand: qtyOH,
            filter: `${item1.item_jig} -- ${matchedObj2?.item_type || ""} -- ${matchedObj3?.pt_desc1 || ""} -- ${matchedObj3?.pt_status || ""} -- ${item1.status_jig} -- ${item1.material} -- ${matchedObj2?.opt_on || ""} -- ${matchedObj2?.opt_off || ""} -- ${item1.desc_jig || ""} -- ${qtyOH}`
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
        XLSX.writeFile(workbook, 'db_jig_download.xlsx');      
        btnSpk2.classList.remove('load_txt');
        btnSpk2.textContent = "dl excel";
        } catch(error) {
            console.log(error);
        }
})
