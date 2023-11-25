/*===================================================
jig table generate
===================================================*/

export const tHeader = async(target,tableID, arrHead, trClass, thClass) => {
    try {    
        const container = document.getElementById(target);
        const table = document.createElement('div');
        table.classList.add('fc');
        table.id = tableID;
        const tr = document.createElement('div');
        for (let iii=0; iii<trClass.length; iii++) {
            tr.classList.add(trClass[iii]);;
        }
        tr.id = 'tableHeader';

        for (let i=0; i<arrHead.length; i++) {
            const th = document.createElement('div');
            for (let iii=0; iii<thClass.length; iii++) {
                th.classList.add(thClass[iii]);;
            }
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        container.appendChild(table);
    } catch(error){
        console.log(error);
    }
}


import { item_number, item_wip, new_routing, old_routing } from '../middleware/js/class.js';

export const tHeader2 = async() => {
    try {    
        const container = document.getElementById('main');
        const table = document.createElement('div');
        table.classList.add('fc');
        table.id = 'mainTable';
        
        const tr = document.createElement('div');
        tr.id = 'tableHeader';
        tr.classList.add('fr');

        const th = document.createElement('div');
        th.textContent = 'item code';
        th.classList.add('cl1', 'tl3', 'fc-w');
        tr.appendChild(th);
        
        const th2 = document.createElement('div');
        th2.textContent = 'item code';
        th2.classList.add('cl1', 'tl3', 'fc-w');
        tr.appendChild(th2);

        const array1 = ['urutan', 'SBE3/SBE4', 'code_wc', 'proses']
        
        const tx = document.createElement('div');
        tx.classList.add('fc');
        const txh = document.createElement('div');
        txh.textContent = 'old data';
        txh.classList.add('bl2','fc-w');
        tx.appendChild(txh);
        const txh2 = document.createElement('div');
        txh2.classList.add('bl2', 'fr');
        for (let i=0; i<array1.length; i++) {
            const txh3 = document.createElement('div');
            txh3.textContent = array1[i];
            txh3.classList.add('cl1', 'bl4');
            txh2.appendChild(txh3);
        }
        tx.appendChild(txh2);
        tr.appendChild(tx);

                
        const tx2 = document.createElement('div');
        tx2.classList.add('fc');
        const tx2h = document.createElement('div');
        tx2h.textContent = 'new data';
        tx2h.classList.add('or2', 'fc-w');
        tx2.appendChild(tx2h);
        const tx2h2 = document.createElement('div');
        tx2h2.classList.add('or2', 'fr');
        for (let i=0; i<array1.length; i++) {
            const tx2h3 = document.createElement('div');
            tx2h3.textContent = array1[i];
            tx2h3.classList.add('cl1', 'or4');
            tx2h2.appendChild(tx2h3);
        }
        tx2.appendChild(tx2h2);
        tr.appendChild(tx2);
        
        table.appendChild(tr);
        container.appendChild(table);
    } catch(error){
        console.log(error);
    }
}

export const tblAll = async() => {
    const container = document.getElementById('mainTable');
    const src1 = await item_number.getData();
    const src2 = await new_routing.getData();
    const src3 = await old_routing.getData();
    const src4 = await item_wip.getData();
    const src5 = src4.map((obj1) => {
        return {
            code: obj1.code,
            code_wip: obj1.code_wip,
            code_gab: obj1.code +"_" + obj1.code_wip
        };
    })
    const array1 = ['urutan', 'SBE3/SBE4', 'code_wc', 'proses']

    for (let i=0; i<src1.length; i++) {
        const tr = document.createElement('div');
        tr.id = src1[i].code;
        tr.classList.add('fr');
        const td = document.createElement('div');
        td.textContent = src1[i].code;
        td.classList.add('cl1', 'tl8');
        tr.appendChild(td);

        const dataGab = src5.filter((obj1) => obj1.code === src1[i].code);
        const tdx = document.createElement('div');
        tdx.classList.add('cl1', 'tl8', 'fc');
        for (let ii=0; ii<dataGab.length; ii++) {
            const tdxx = document.createElement('div');
            tdxx.id = src5[ii].code_gab;
            tdxx.textContent = src5[ii].code_wip;
            tdx.appendChild(tdxx);            
        }
        tr.appendChild(tdx);

        const oldDiv = document.createElement('div');
        oldDiv.id = `oldDiv_${src1[i]['code']}`
        const dataGab1 = src2.filter((obj1) => obj1.code === src1[i].code);
        for (let i2=0; i2<dataGab1.length; i2++) {
            const tx = document.createElement('div');
            tx.classList.add('fr');
            for (let ii=0; ii<array1.length; ii++) {
                const td2 = document.createElement('div');
                td2.classList.add('cl1', 'bl8');
                td2.textContent = dataGab1[i2][array1[ii]];
                tx.appendChild(td2);
            }
            oldDiv.appendChild(tx);
        }
        tr.appendChild(oldDiv);
        
        const newDiv = document.createElement('div');
        newDiv.id = `newDiv_${src1[i]['code']}`
        newDiv.classList.add('cl5', 'fc');
        tr.appendChild(newDiv);

        container.appendChild(tr);
    }

}