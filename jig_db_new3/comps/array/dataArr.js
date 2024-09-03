export const mainDt = (dtMstr, dtTrans, dtLoc) => {
    let final = {item_jig:[], qty_bor:[], qty_total:[]};
    dtTrans.forEach(tr=>{
        const codeSplt = tr.code.split("--");
        const item_jig = codeSplt[0];
        if(final['item_jig'].includes(item_jig)){
            if(tr.status === 'open') {
                const idx = final['item_jig'].indexOf(item_jig);
                final['qty_bor'][idx] += parseInt(tr.qty);
            }
        } else if(tr.status === 'open') {
            final['item_jig'].push(item_jig);
            final['qty_bor'].push(parseInt(tr.qty));
            final['qty_total'].push(0);
        }
    })

    dtLoc.forEach(Loc=>{
        const codeSplt = Loc.code.split("--");
        const item_jig = codeSplt[0];
        if(final['item_jig'].includes(item_jig)){
            const idx = final['item_jig'].indexOf(item_jig);
            final['qty_total'][idx] += parseInt(Loc.qty_per_unit);
        } else {
            final['item_jig'].push(item_jig);
            final['qty_total'].push(parseInt(Loc.qty_per_unit));
            final['qty_bor'].push(0);
        }
    })

    let result=[];
    dtMstr.forEach(dm =>{
        let qty_bor1 = 0;
        let qty_total1 = 0;
        let qty_avail = 0;
        if(final['item_jig'].includes(dm.item_jig)) {
            const idx = final['item_jig'].indexOf(dm.item_jig);
            qty_bor1 = final['qty_bor'][idx] ;
            qty_total1 = final['qty_total'][idx] ;
            qty_avail = qty_total1 - qty_bor1;
        }
        const data = {item_jig:dm.item_jig.trim(), qty_bor:qty_bor1, qty_total:qty_total1, qty_avl: qty_avail};
        result.push(data);
    })
    return result;
}

export const hidDtTrans = (dtTrans, dtLoc) => {
    let final = {
        code:[],
        item_jig:[],
        lokasi:[],
        qty_per_unit:[],
        unit:[],
        start_date:[],
        loc:[],
        qty_bor:[],
        qty_avail:[],
        id_trans:[]
    };
    dtLoc.forEach(Loc=>{
        if(final['code'].includes(Loc.code)){
            const idx = final['code'].indexOf(Loc.code);
            final['lokasi'][idx] = Loc.lokasi;
            final['qty_per_unit'][idx] = parseInt(Loc.qty_per_unit);
            final['unit'][idx] = Loc.unit;
            final['item_jig'][idx] = Loc.item_jig;
            final['qty_avail'][idx] = parseInt(Loc.qty_per_unit) - final['qty_bor'][idx];
        } else {
            final['code'].push(Loc.code);
            final['item_jig'].push(Loc.item_jig);
            final['lokasi'].push(Loc.lokasi);
            final['qty_per_unit'].push(parseInt(Loc.qty_per_unit));
            final['qty_bor'].push(0);
            final['qty_avail'].push(parseInt(Loc.qty_per_unit));
            final['unit'].push(Loc.unit);
            final['start_date'].push('');
            final['loc'].push('');
            final['id_trans'].push(0);
        }
    })
    dtTrans.forEach(tr=>{
        if(final['code'].includes(tr.code)){
            if(tr.status === 'open') {
                const idx = final['code'].indexOf(tr.code);
                final['qty_bor'][idx] += parseInt(tr.qty);
                final['start_date'][idx] = tr.start_date;
                final['loc'][idx] = tr.loc;
                final['qty_avail'][idx] -= parseInt(tr.qty);
                final['id_trans'][idx] += parseInt(tr.id);
            }
        } else if(tr.status === 'open') {
            final['code'].push(tr.code);
            final['qty_bor'].push(parseInt(tr.qty));
            final['start_date'].push(tr.start_date);
            final['loc'].push(tr.loc);
            final['qty_per_unit'].push(0);
            final['qty_avail'].push(0);
            final['id_trans'].push(parseInt(tr.id));
        }
    })

    let result = [];
    for (let i=0; i<final.code.length; i++) {
        const keys = Object.keys(final);
        let data ={};
        keys.forEach(key => {
            data[key] = final[key][i]
        })
        result.push(data);
    }
    return result;
}