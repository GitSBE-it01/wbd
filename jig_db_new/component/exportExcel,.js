const dlExcel1 = async() => {
    const btnXl = document.getElementById('btnJigXls');
    btnXl.addEventListener("click", async function() {
    const filter = document.getElementById('searchJig');
    try {
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
    } catch(error) {
        console.log(error);
    }
})};