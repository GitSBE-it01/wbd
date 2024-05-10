export const data = async(data) => {
    const inven = new Map();
    inventory.forEach(dt=>{
        if(inven.has(dt.item)) {
            const exst = inven.get(dt.item);
            exst.qty_OH += parseFloat(dt.qty_OH);
            exst.detail += dt.lot + "--" + dt.loc + ", \n";
        } else {
            const newItem = {
                dept: dt.dept,
                item: dt.item,
                loc: dt.loc,
                lot: dt.lot,
                qty_OH: parseFloat(dt.qty_OH),
                reff:dt.reff,
                detail: dt.lot + "--" + dt.loc + ", \n"
            }
            inven.set(dt.item, newItem);
        }
    })
    const resultInven = Array.from(inven.values());
    const pickNowDataFix = [];
    mainData.forEach(dt=>{
        const OH = resultInven.filter(item=>item.item === dt.item);
        const wo = woR.filter(item => item.wo_lot === dt.lot__id);
        const it = item.filter( item => item.pt_part === dt.item);
        const data = {
            ...dt,
            rel_date: wo[0]['wo_rel_datex'],
            due_date: wo[0]['wo_due_datex'],
            rmks: wo[0]['wo_rmks'],
            desc: it[0]['pt_desc1'] +it[0]['pt_desc2'],
            qtyOnHand: OH && OH[0] && OH[0]['qty_OH'] ? OH[0]['qty_OH'] : 0,
            all_lot: OH && OH[0] && OH[0]['lot'] ? OH[0]['lot'] : "-",
        }
        pickNowDataFix.push(data);
    })
    console.log(pickNowDataFix);
}