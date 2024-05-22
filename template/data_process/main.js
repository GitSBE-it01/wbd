import {numberToStr} from '../utility/index.js';

export const mainDataProcess = (src)=> {
    const tableData =[];
    src.forEach(dt=> {
        let qtyNasehat = 0;
        if(dt.valAcc < 0 ) {
            qtyNasehat = dt.valAcc;
        }
        const fltr = dt.id + '--' +
        dt.item + '--' +
        dt.dept + '--' +
        dt.remark + '--' +
        dt._date + '--' +
        dt.rel_dt + '--' +
        dt.due_dt + '--' +
        dt.loc__line + '--' +
        dt.lot__id + '--' +
        dt.qt + '--' +
        qtyNasehat + '--' +
        dt.pick + '--' +
        dt.qty_OH + '--' +
        dt.wo_rmks + '--' +
        dt.lotOH + '--' +
        dt.pic;
        const data = {
            id: dt.id,
            komponen: dt.item, 
            depmnt: dt.dept,
            keterangan: dt.remark,
            dt_need: dt._date,
            release_date: dt.rel_dt, 
            due_date: dt.due_dt, 
            lokasi: dt.loc__line, 
            lot__id: dt.lot__id, 
            qty: numberToStr(dt.qty,0,2),
            nasehat: numberToStr(qtyNasehat,0,2), 
            pick_now: dt.pick, 
            qty_OH_all: numberToStr(dt.qty_OH,0,2), 
            remarks: dt.wo_rmks, 
            all_lot: dt.lotOH, 
            pic: dt.pic,
            filter: fltr
        }
        tableData.push(data);
    })
    tableData.sort((a,b) => {
        if (a.komponen !== b.komponen) return a.komponen.localeCompare(b.komponen);
        if (a.depmnt === 'WH') return -1;
        if (b.depmnt === 'WH') return 1;
        if (a.depmnt !== b.depmnt) return a.depmnt.localeCompare(b.depmnt);
        if (a.dt_need !== b.dt_need) return a.dt_need.localeCompare(b.dt_need);
        if (a.keterangan !== b.keterangan) return a.keterangan.localeCompare(b.keterangan);
        return 0; // objects are equal
    })
    return tableData;
}