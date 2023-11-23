import { item_number, new_routing, old_routing } from '../middleware/js/class.js';

export const dataTable = async() => {
    try {
        const src = await item_number.getData();
        const src2 = await new_routing.getData();
        const src3 = await old_routing.getData();
        const mainDat = src.map((obj1) => {
            const matObj = src2.find((obj2) => obj2.No_Part_Cust === obj1.No_Part_Cust);
            const matObj2 = src3.find((obj3) => obj3.No_Part_Cust === obj1.No_Part_Cust)
            return {
                code_old: obj1.code,
                code_new: matObj?.code ||"",
                desc_sbe4: obj1.code_desc,
                wip_old: obj1.child_category,
                wc_old: obj1.wc_new,
                ops_old: obj1.ops,
                ops_old_desc: obj1.ops_desc,
                wip_new: matObj?.category ||"",
                wc_new: matObj?.wc,
                ops_new: matObj?.ops,
                ops_new_desc: matObj?.ops_desc,
            }
        })
        /*mainDat.sort((a, b) => {
            if (a.code_old < b.code_old) return -1;
            if (a.code_old > b.code_old) return 1;
            return 0;
        });*/
        const sortedData = mainDat.sort((a, b) => {
            const codeComparison = a.code_old.localeCompare(b.code_old);
            if (codeComparison !== 0) return codeComparison;
          
            const wipComparison = a.ops_old.localeCompare(b.ops_old);
            if (wipComparison !== 0) return wipComparison;
          
            const descComparison = a.desc_sbe4.localeCompare(b.desc_sbe4);
            return descComparison;
          });
        return sortedData;
    } catch(error) {
        console.log(error);
    }
}











