import { create } from "../block.js";

export const pickNowHeader = (text) => {
    const array = [
        'komponen',
        'description',
        'departement',
        'keterangan',
        'date',
        'rel date',
        'due date',
        'lokasi',
        'id / Lot',
        'qty id/lot',
        'nasehat',
        'pick now',
        'qty OH WH',
        'remarks',
        'all lot',
        'PIC WH'
    ];
    create ({
        element: 'div',
        selector: '#main2',
        id: 'pickNowHeader',
    })  
    create ({
        element: 'h2',
        selector: '#pickNowHeader',
        id: 'pickNowTitle',
        textCont: `Pick Now Untuk ${text}`,
        class: 'my2 textCenter fc-b'
    })    
    create ({
        element: 'div',
        id: 'pickNowHd',
        selector: '#pickNowHeader',
        class: 'flex-r mx2 fc-w textCenter by2-solid bx1-solid mt2 tl2'
    })
    array.forEach(dt=>{
        create({
            element: 'div',
            hdCell: 'cellHD',
            selector: '#pickNowHd',
            class: 'f-child fw-blk bx1-solid p2',
            textCont: dt
        })
    })
}


export const pickNowTbl= async(src, idNew) =>{
    await create ({
        element: 'div',
        selector: '#main2',
        table: `pickNowTbl${idNew}`,
        class: 'h100 w100 overY'
    })  
    let itemCek = '';
    src.forEach(dt=> {
        let classSty = 'flex-r mx2 fc-b textCenter bx1-solid tl8';
        if(dt.komponen !== itemCek) {
            classSty = 'flex-r mx2 fc-b textCenter bx1-solid tl4 bt2-solid';
            itemCek = dt.komponen
        } 
        const div1 = document.createElement('div');
        const target = document.querySelector(`[data-table = "pickNowTbl${idNew}"]`);
        div1.setAttribute('class', classSty);
        div1.setAttribute('data-row',dt['id']);
        div1.setAttribute('data-deptVal',dt['depmnt']);
        div1.setAttribute('data-filter',dt['filter']);
        target.appendChild(div1);

        const target2 = document.querySelector(`[data-row = "${dt['id']}"]`);

        //1
        const div0 = document.createElement('div');
        div0.classList.add('f-child', 'p2', 'bx1-solid');
        div0.setAttribute('data-hdCell','cellHD');
        div0.setAttribute('data-cell','komponen');
        div0.textContent = dt['komponen'];
        target2.appendChild(div0);
        //1
        const div2 = document.createElement('div');
        div2.classList.add('f-child', 'p2', 'bx1-solid');
        div2.setAttribute('data-hdCell','cellHD');
        div2.setAttribute('data-cell','_desc');
        div2.textContent = dt['_desc'];
        target2.appendChild(div2);
        //2
        const div3 = document.createElement('div');
        div3.classList.add('f-child', 'p2', 'bx1-solid');
        div3.setAttribute('data-hdCell','cellHD');
        div3.setAttribute('data-cell','depmnt');
        div3.textContent = dt['depmnt'];
        target2.appendChild(div3);
        //3
        const div4 = document.createElement('div');
        div4.classList.add('f-child', 'p2', 'bx1-solid');
        div4.setAttribute('data-hdCell','cellHD');
        div4.setAttribute('data-cell','keterangan');
        div4.textContent = dt['keterangan'];
        target2.appendChild(div4);
        //4
        const div5 = document.createElement('div');
        div5.classList.add('f-child', 'p2', 'bx1-solid');
        div5.setAttribute('data-hdCell','cellHD');
        div5.setAttribute('data-cell','dt_need');
        div5.textContent = dt['dt_need'];
        target2.appendChild(div5);
        //5
        const div6 = document.createElement('div');
        div6.classList.add('f-child', 'p2', 'bx1-solid');
        div6.setAttribute('data-hdCell','cellHD');
        div6.setAttribute('data-cell','release_date');
        div6.textContent = dt['release_date'];
        target2.appendChild(div6);
        //6
        const div7 = document.createElement('div');
        div7.classList.add('f-child', 'p2', 'bx1-solid');
        div7.setAttribute('data-hdCell','cellHD');
        div7.setAttribute('data-cell','due_date');
        div7.textContent = dt['due_date'];
        target2.appendChild(div7);
        //7
        const div8 = document.createElement('div');
        div8.classList.add('f-child', 'p2', 'bx1-solid');
        div8.setAttribute('data-hdCell','cellHD');
        div8.setAttribute('data-cell','lokasi');
        div8.textContent = dt['lokasi'];
        target2.appendChild(div8);
        //8
        const div9 = document.createElement('div');
        div9.classList.add('f-child', 'p2', 'bx1-solid');
        div9.setAttribute('data-hdCell','cellHD');
        div9.setAttribute('data-cell','lot__id');
        div9.textContent = dt['lot__id'];
        target2.appendChild(div9);
        //1
        const div10 = document.createElement('div');
        div10.classList.add('f-child', 'p2', 'bx1-solid');
        div10.setAttribute('data-hdCell','cellHD');
        div10.setAttribute('data-cell','qty');
        div10.textContent = dt['qty'];
        target2.appendChild(div10);
        //2
        const div11 = document.createElement('div');
        div11.classList.add('f-child', 'p2', 'bx1-solid');
        div11.setAttribute('data-hdCell','cellHD');
        div11.setAttribute('data-cell','nasehat');
        div11.textContent = dt['nasehat'];
        target2.appendChild(div11);
        //3
        const div12 = document.createElement('div');
        div12.classList.add('f-child', 'p2', 'bx1-solid');
        div12.setAttribute('data-hdCell','cellHD');
        div12.setAttribute('data-cell','pick_now');
        div12.textContent = dt['pick_now'];
        target2.appendChild(div12);
        //4
        const div13 = document.createElement('div');
        div13.classList.add('f-child', 'p2', 'bx1-solid');
        div13.setAttribute('data-hdCell','cellHD');
        div13.setAttribute('data-cell','qty_OH_all');
        div13.textContent = dt['qty_OH_all'];
        target2.appendChild(div13);
        //5
        const div14 = document.createElement('div');
        div14.classList.add('f-child', 'p2', 'bx1-solid');
        div14.setAttribute('data-hdCell','cellHD');
        div14.setAttribute('data-cell','remarks');
        div14.textContent = dt['remarks'];
        target2.appendChild(div14);
        //6
        const div15 = document.createElement('div');
        div15.classList.add('f-child', 'p2', 'bx1-solid');
        div15.setAttribute('data-hdCell','cellHD');
        div15.setAttribute('data-cell','all_lot');
        div15.textContent = dt['all_lot'];
        target2.appendChild(div15);
        //7
        const div16 = document.createElement('div');
        div16.classList.add('f-child', 'p2', 'bx1-solid');
        div16.setAttribute('data-hdCell','cellHD');
        div16.setAttribute('data-cell','pic');
        div16.textContent = dt['pic'];
        target2.appendChild(div16);
    })
}
