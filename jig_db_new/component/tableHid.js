import  { jig_location_query, jig_function_query, item_detail_query } from '../class.js';

/*
===============================================================================
data utk hidden table location
===============================================================================
*/
export const dataTableLoc = async (valueId) => {
    try {
        let data = [];
        const src = await jig_location_query.fetchDataFilter({item_jig: valueId});
        if (role.value === "admin" || role.value === "superuser") {
            data = src.map((obj1) => {
                return {
                    code: obj1.code,
                    lokasi: obj1.lokasi,
                    qty_per_unit: parseInt(obj1 ? obj1.qty_per_unit :0),
                    unit: obj1 ? obj1.unit:""
                }});
            } else {
            data = src.map((obj1) => {
                return {
                    code: obj1.code,
                    lokasi: obj1.lokasi,
                    qty_per_unit: obj1 ? Math.floor(parseInt(obj1.qty_per_unit) * (100-parseInt(obj1.toleransi)) / 100) :0,
                    unit: obj1 ? obj1.unit:""
                }});
            }
        return data;
    }catch (error){
        console.error('Error:', error);
    }
};


/*
===============================================================================
data utk hidden table type speaker
===============================================================================
*/
export const dataTableType = async (valueId) => {
    try {
        const src1 = await jig_function_query.fetchDataFilter({item_jig: valueId});
        const src2 = await item_detail_query.getData();
        const data = src1.map((obj1) => {
            const matObj = src2.find((obj2) => obj2.pt_part === obj1.item_type);
            return {
                item_jig: obj1.item_jig,
                item_type: obj1.item_type || "-",
                description: matObj ? matObj.pt_desc1 : "-",
                status_type: matObj ? matObj.pt_status : "-",
                opt_on: obj1.opt_on || 0,
                opt_off: obj1.opt_off || 0
            };
        });
        return data;
    }catch (error){
        console.error('Error:', error);
    }
};


