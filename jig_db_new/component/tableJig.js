import  { jig_master_query, jig_location_query } from '../class.js';
import { loading } from './load.js';
import { tableHeader, tblGenJig} from './table.js';


/*
===============================================================================
data utk table jig
===============================================================================
*/

let databaseJig = [];
export const dataJig = async () => {
    try {
        const main = document.getElementById('main');
        main.appendChild(loading('load','loading2'));
        const arrHead1 = ['item number jig' , 'desc jig', 'jig type', 'status jig', 'material', 'qty on hand', 'detail'];
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
        const data = src1.map((obj1) => {
            const matchedObj = summedData.find((obj2) => obj2.item_jig === obj1.item_jig);
            const qtyOH = role.value === "admin" || role.value === "superuser" ?
            (matchedObj ? matchedObj.qty : 0) :
            (matchedObj ? Math.floor(matchedObj.qty * (100 - matchedObj.toleransi) / 100) : 0);
            return {
                item_jig: obj1.item_jig,
                desc_jig: obj1.desc_jig,
                type_jig: obj1.type !== undefined ? obj1.type: "",
                status_jig: obj1.status_jig,
                tolerance: parseInt(matchedObj ? matchedObj.toleransi : 0),
                material: obj1.material !== undefined ? obj1.material: "",
                qtyOnHand: qtyOH,
                filter: `${obj1.item_jig} -- ${obj1.desc_jig} -- ${obj1.type !== undefined ? obj1.type: ""} -- ${obj1.status_jig} -- ${matchedObj ? matchedObj.toleransi : 0} -- ${obj1.material !== undefined ? obj1.material: ""} -- ${qtyOH}`
        }}) 
        databaseJig = data;
        const btn = document.getElementById('btnJig');
        const filter = document.getElementById('searchJig');
        tableHeader('main', 'tableJig', arrHead1);
        const table = document.getElementById('tableJig');
        table.appendChild(await tblGenJig('tbodyJig', data));
        btn.addEventListener("click", async() => {
            const tbody = document.getElementById('tbodyJig');
            if (table && tbody) {
                table.removeChild(tbody);
            }
            const filterValue = filter.value;
            const filterData = data.filter(item=> item.filter.toLowerCase().includes(filterValue.toLowerCase()));
            databaseJig = filterData;
            table.appendChild(await tblGenJig('tbodyJig', filterData));
        })

        /*const btnXl = document.getElementById('btnJigXls');
        btnXl.addEventListener("click", async function() {
            btnXl.textContent = "";
            btnXl.classList.add('load_txt');
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.json_to_sheet(databaseJig);
            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Sheet1');
            // Generate an Excel file
            XLSX.writeFile(workbook, 'db_jig_download.xlsx');
            btnXl.classList.remove('load_txt');
            btnXl.textContent = "dl excel";
        }) */
        
        main.appendChild(table);
        main.removeChild(document.getElementById('load'));
    }catch (error){
        console.log('Error:', error);
    }
};

export { databaseJig };