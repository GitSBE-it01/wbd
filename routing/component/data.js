import { routing_base, routing_alter } from '../middleware/js/class.js';

export const dataTable = async() => {
    try {
        const data = await routing_base.getData();
        const data2 = await routing_alter.getData();
        const mainDat = data.map((obj1) => {
            const matObj = data2.find((obj2) => obj2.parent_id === obj1.id);
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











