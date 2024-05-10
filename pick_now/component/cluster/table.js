import { create } from "../block.js";

export const tablePickNow = (text, data) => {
    pickNowHeader(text);
    //pickData(data);
}

const pickNowHeader = (text) => {
    const array = [
        'komponen',
        'release date',
        'due date',
        'lokasi + id',
        'PM',
        'sum of QtyOH',
        'nasehat',
        'id par desc',
        'remarks',
        'pick now',
        'qty OH all',
        'all lot'];
    create ({
        element: 'h2',
        selector: '#main2',
        textCont: `Pick Now Untuk ${text}`,
        class: 'my2 textCenter fc-b'
    })    
    create ({
        element: 'div',
        id: 'pickNowHd',
        selector: '#main2',
        class: 'flex-r mx2 fc-b textCenter mt2 b2-solid'
    })
    array.forEach(dt=>{
        create({
            element: 'div',
            hdCell: 'cellHD',
            selector: '#pickNowHd',
            class: 'f-child fw-blk b1-solid p2',
            textCont: dt
        })
    })
}


const pickNowTbl= (src) =>{

}

const pickData = (src) => {
    komponen
    release_date
    due_date
    lokasi_id
    PM
    sum_of_QtyOH
    nasehat
    id_par_desc
    remarks
    pick_now
    qty_OH_all
    all_lot
}