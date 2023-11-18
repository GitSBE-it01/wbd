import  { jig_master_query, jig_location_query, jig_function_query, item_detail_query } from '../class.js';
import { loading } from './load.js';
import { tableHeader, tblGenSpk} from './table.js';


/*
===============================================================================
data utk table jig
===============================================================================
*/
let databaseSpk = [];
export const dataSpk = async () => {
    try {
        const main = document.getElementById('main');
        main.appendChild(loading('load','loading2'));
        const arrHead1 = ['item number speaker' , 'desc speaker', 'status speaker','item number jig', 'desc jig', 'put on jig', 'pull out jig', 'material','qty on hand'];
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
        const data = src3.map((item1) => {
            const matchedObj = summedData.find((item2) => item2.item_jig === item1.item_jig);
            const matchedObj2 = src1.find((item3) => item3.item_jig === item1.item_jig);
            const matchedObj3 = src4.find((item4) => item4.pt_part === item1.item_type);
            const qtyOH =
                role.value === "admin" || role.value === "superuser"
                ? matchedObj?.qty || 0
                : Math.floor((matchedObj?.qty || 0) * (100 - (matchedObj?.toleransi || 0)) / 100);
        
            return {
                item_jig: item1.item_jig,
                item_type: item1?.item_type || "",
                description: `${matchedObj3?.pt_desc1 || ""}-${matchedObj3?.pt_desc2 || ""}`,
                status_speaker: matchedObj3?.pt_status || "",
                status_jig: matchedObj2?.status_jig || "",
                material: matchedObj2?.material || "",
                opt_on: item1?.opt_on || "",
                opt_off: item1?.opt_off || "",
                desc_jig: matchedObj2?.desc_jig || "",
                qtyOnHand: qtyOH,
                filter: `${item1.item_jig} -- ${item1?.item_type || ""} -- ${matchedObj3?.pt_desc1 || ""} -- ${matchedObj3?.pt_status || ""} -- ${matchedObj2?.status_jig || ""} -- ${matchedObj2?.material} -- ${item1?.opt_on || ""} -- ${item1?.opt_off || ""} -- ${matchedObj2?.desc_jig || ""} -- ${qtyOH}`
                }});
        databaseSpk= data;
        const btn = document.getElementById('btnSpk');
        const filter = document.getElementById('searchSpk');
        tableHeader('main', 'tableSpk', arrHead1);
        const table = document.getElementById('tableSpk');
        table.appendChild(await tblGenSpk('tbodySpk', databaseSpk));
        const tbody = document.getElementById('tbodySpk');
        btn.addEventListener("click", async() => {
        const tbody = document.getElementById('tbodySpk');
        if (table && tbody) {
            table.removeChild(tbody);
        }
            const filterValue = filter.value;
            const filterData = data.filter(item=> item.filter.toLowerCase().includes(filterValue.toLowerCase()));
            databaseSpk=filterData;
            table.appendChild(await tblGenSpk('tbodySpk', databaseSpk));
        })
        const btnXl2 = document.getElementById('btnSpkXls');
        btnXl2.addEventListener("click", async function() {
            btnXl2.textContent = "";
            btnXl2.classList.add('load_txt');
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(databaseSpk);
            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
            // Generate an Excel file
            XLSX.writeFile(workbook, 'db_spk_download.xlsx');
            btnXl2.classList.remove('load_txt');
            btnXl2.textContent = "dl excel";
            
        }) 
        main.appendChild(table);
        main.removeChild(document.getElementById('load'))
    }catch (error){
        console.error('Error:', error);
    }
};

