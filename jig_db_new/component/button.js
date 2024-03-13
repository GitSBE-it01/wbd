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
        // location
        if (event.target.getAttribute('id').includes('loc_')) {
            const buttonId = event.target.getAttribute('id');
            const cekFilter = buttonId.split("_");
            const valueId = cekFilter[1];
            const hidDiv = document.getElementById(`hid_${valueId}`);
            const hidDiv2 = document.getElementById(`hid2_${valueId}`);
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
                const arr = ['Code', 'Location', ' qty per unit', 'unit'];
                tblLocJig(`hid_${valueId}`,arr, respons );
                hidDiv.removeChild(document.getElementById('load'));
                return;
            }
            hidDiv.classList.add('hide');
            return;
        } 
        // type
        if (event.target.getAttribute('id').includes('type_')) {
            const buttonId = event.target.getAttribute('id');
            const cekFilter = buttonId.split("_");
            const valueId = cekFilter[1];
            const hidDiv = document.getElementById(`hid_${valueId}`);
            const hidDiv2 = document.getElementById(`hid2_${valueId}`);
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
import  { jig_location_query, jig_function_query, item_detail_query } from '../class.js';
import { databaseJig } from './tableJig.js';

const btnJig2 = document.getElementById('btnJigXls');
btnJig2.addEventListener("click", async function() {
    try {
        btnJig2.textContent = "";
        btnJig2.classList.add('load_txt');
        btnJig2.disabled =true;
        const inputFilter = document.getElementById('searchJig');
        const workbook = XLSX.utils.book_new();
        const src = await jig_location_query.getData();
        const src1 = await jig_function_query.getData()
        const src2 = await item_detail_query.getData();
        const addData = src1.map((obj1) => {
            const matObj3 = src2.find((obj2) => obj2.pt_part === obj1.item_type);
            return {
                item_jig: obj1.item_jig,
                item_type: obj1.item_type,
                description: matObj3 ? matObj3.pt_desc1:  "-",
                status_type: matObj3 ? matObj3.pt_status: "-",
                opt_on: obj1.opt_on,
                opt_off: obj1.opt_off
            }
        })

        // Create a worksheet
        const filter1 = inputFilter.value;
        if (filter1 !== "") {
            const filterData1 = databaseJig.filter(item =>
                item.filter.toLowerCase().includes(filter1.toLowerCase())
            );
            const filterData2= addData.filter((obj1) => {
                const dataComp = filterData1.find((obj2) => obj2.item_jig === obj1.item_jig);
                if (dataComp) {
                    return {
                        ...obj1
                    }
                }
            })
            const filterData3= src.filter((obj1) => {
                const dataComp = filterData1.find((obj2) => obj2.item_jig === obj1.item_jig);
                if (dataComp) {
                    return {
                        ...obj1
                    };
                }
            })
            const worksheet = XLSX.utils.json_to_sheet(filterData1);
            const worksheet2 = XLSX.utils.json_to_sheet(filterData2);
            const worksheet3 = XLSX.utils.json_to_sheet(filterData3);
            
            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'master');
            XLSX.utils.book_append_sheet(workbook, worksheet2, 'usage');
            XLSX.utils.book_append_sheet(workbook, worksheet3, 'location');
            
            // Generate an Excel file
            XLSX.writeFile(workbook, 'db_jig_download.xlsx');
        } else {

            const worksheet = XLSX.utils.json_to_sheet(databaseJig);
            const worksheet2 = XLSX.utils.json_to_sheet(addData);
            const worksheet3 = XLSX.utils.json_to_sheet(src);
            
            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'master');
            XLSX.utils.book_append_sheet(workbook, worksheet2, 'usage');
            XLSX.utils.book_append_sheet(workbook, worksheet3, 'location');
            
            // Generate an Excel file
            XLSX.writeFile(workbook, 'db_jig_download.xlsx'); 
        }
        btnJig2.classList.remove('load_txt');
        btnJig2.textContent = "dl excel";
        btnJig2.disabled =false;
        } catch(error) {
            console.log(error);
        }
})
