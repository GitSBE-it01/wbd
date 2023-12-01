/*===================================================
jig table generate
===================================================*/
export const tableHeader = async(target,tableID, arrHead) => {
    try {    
        const container = document.getElementById(target);
        const table = document.createElement('div');
        table.classList.add('tm');
        table.id = tableID;
        const tr = document.createElement('div');
        tr.classList.add('fr', 'fc-ctr', 'fc-w', 'pr4', 'thCont');
        tr.id = 'tableHeader';

        for (let i=0; i<arrHead.length; i++) {
            const th = document.createElement('div');
            th.classList.add('sl4', 'flexCh', 'th', 'bd-black', 'upper');
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        container.appendChild(table);
    } catch(error){
        console.log(error);
    }
}

export const tblUpdLoc = async (target, dataLoc) => {
    try {
        const table = document.getElementById(target);

        // toleransi input
        const card  = document.createElement('div');
        card.classList.add('fr', 'mh2' );
        const label = document.createElement('label');
        label.textContent = 'toleransi';
        const input = document.createElement('input');
        input.classList.add('mh4');
        input.textContent = 'Tolerance';
        input.id ='tol';
        input.value = dataLoc[0]?.toleransi || 0;
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('type', 'text');
        card.appendChild(label)
        card.appendChild(input);
        table.appendChild(card);

        for (let i=0; i<dataLoc.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2', 'pr4');
            tr.setAttribute('data-fromDB', "");
            
            // location
            const div1 =document.createElement('div');
            div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input1 = document.createElement('input');
            input1.value = dataLoc[i].lokasi;
            input1.setAttribute('type','text');
            input1.setAttribute('data-input','');
            input1.setAttribute('list','dataLokasi');
            input1.setAttribute('autocomplete','off');
            input1.id = `lokasi+${dataLoc[i].code}`
            div1.appendChild(input1);
            
            // qty per unit
            const div2 =document.createElement('div');
            div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            const input2 = document.createElement('input');
            input2.classList.add('sl5', 'fc-w')
            input2.value = dataLoc[i].qty_per_unit;
            input2.setAttribute('type','text');
            input2.setAttribute('data-input','');
            input2.id = `cur_qty_per_unit+${dataLoc[i].code}`
            input2.setAttribute('readonly', 'readonly');
            div2.appendChild(input2);
             
            // add/substract
            const div3 =document.createElement('div');
            div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input3 = document.createElement('select');
            const arr = ['tambah', 'kurang'];
            for (let i=0; i<arr.length; i++) {
                const option = document.createElement('option');
                option.value = arr[i];
                option.textContent = arr[i];
                input3.appendChild(option);
            }
            input3.id = `addSub+${dataLoc[i].code}`;
            input3.setAttribute('data-input','');
            div3.appendChild(input3);
             
            // qty
            const div4 =document.createElement('div');
            div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input4 = document.createElement('input');
            input4.value = 0;
            input4.setAttribute('type','text');
            input4.id = `qty+${dataLoc[i].code}`;
            input4.setAttribute('data-input','');
            div4.appendChild(input4);
                
            // unit
            const div5 =document.createElement('div');
            div5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input5 = document.createElement('input');
            input5.value = dataLoc[i].unit;
            input5.setAttribute('type','text');
            input5.id = `unit+${dataLoc[i].code}`;
            input5.setAttribute('data-input','');
            div5.appendChild(input5);
        
            // remark
            const div6 =document.createElement('div');
            div6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input6 = document.createElement('input');
            input6.value = "-";
            input6.setAttribute('type','text');
            input6.id = `remark+${dataLoc[i].code}`;
            input6.setAttribute('data-input','');
            div6.appendChild(input6);

            // del button
            const div7 =document.createElement('div');
            div7.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const btn7 = document.createElement('button');
            btn7.setAttribute('type','button');
            btn7.textContent = 'delete';
            btn7.id = `del+${dataLoc[i].code}`;
            btn7.setAttribute('data-input','');
            div7.appendChild(btn7);

            tr.appendChild(div1);
            tr.appendChild(div2);
            tr.appendChild(div3);
            tr.appendChild(div4);
            tr.appendChild(div5);
            tr.appendChild(div6);
            tr.appendChild(div7);

            table.appendChild(tr);
        }
        return table;
    } catch(error) {
        console.log(error);
    }
}


export const tblHistLoc = async(data) => {
    try{
        const arrayHeader = ['Location', 'Qty per unit', 'add/substract', 'Qty', 'Unit', 'Tolerance', 'Remark', 'Transaction Date (y-m-d)'];
        await tableHeader('divStock', 'tableStockHist', arrayHeader);
        const arrData = ['lokasi', 'qty_per_unit', 'addSub', 'qty_change', 'unit', 'toleransi', 'remark', 'trans_date'];
        const table = document.getElementById('tableStockHist');
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2');
            for (let ii=0; ii<arrData.length; ii++) {
                const div =document.createElement('div');
                div.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
                div.textContent = data[i][`${arrData[ii]}`];
                div.id = `${arrData[ii]}_${data[i]}`;
                tr.appendChild(div);
            }
            table.appendChild(tr);
        }
        return table;
    }catch(error) {
        console.log(error);
    }
}


export const tblUpdJig = async (target, data) => {
    try {
        const table = document.getElementById(target);
        const arrayHeader = ['description jig', 'status jig', 'material jig', 'tipe jig', 'drawing', 'remark']
        const arrayDat = ['desc_jig', 'status_jig', 'material', 'type', 'drawing', 'remark']
        for (let i=0; i<arrayHeader.length; i++) {
            const card  = document.createElement('div');
            card.classList.add('fc', 'sl2', 'pv3');
            const label = document.createElement('label');
            label.textContent = arrayHeader[i];
            label.classList.add('fc-w', 'cap', 'mh2', 'fs-m');
            const input = document.createElement('input');
            input.classList.add('mh4', 'inpText1', 'sl4', 'fc-w');
            input.id =arrayDat[i];
            input.value = data[0][arrayDat[i]] ? data[0][arrayDat[i]]: "";
            input.setAttribute('autocomplete', 'off');
            input.setAttribute('data-updJig', '');
            input.disabled = true;
            input.setAttribute('type', 'text');
            card.appendChild(label)
            card.appendChild(input);
            table.appendChild(card);
        }
        return table;
    } catch(error) {
        console.log(error);
    }
}



export const tblHistJig = async(data) => {
    try{
        const arrayHeader = ['item jig', 'description', 'type of jig', 'status jig', 'material', 'drawing', 'Remark', 'Transaction Date (y-m-d)'];
        await tableHeader('dataContain', 'tableJigHist', arrayHeader);
        const arrData = ['item_jig', 'desc_jig', 'type', 'status_jig', 'material', 'drawing', 'remark', 'trans_date'];
        const table = document.getElementById('tableJigHist');
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2');
            for (let ii=0; ii<arrData.length; ii++) {
                const div =document.createElement('div');
                div.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
                div.textContent = data[i][`${arrData[ii]}`];
                div.id = `${arrData[ii]}_${data[i]}`;
                tr.appendChild(div);
            }
            table.appendChild(tr);
        }
        return table;
    }catch(error) {
        console.log(error);
    }
}


export const tblUpdType = async (target, data, data2) => {
    try {
        const table = document.getElementById(target);

        // toleransi input
        const card  = document.createElement('div');
        card.classList.add('fr', 'mh2' );
        const label = document.createElement('label');
        label.textContent = 'Status Speaker';
        const input = document.createElement('input');
        input.classList.add('mh4', 'bl2','fc-w');
        input.disabled = true;
        input.id ='stat';
        input.value = data2[0].pt_status;
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('type', 'text');
        card.appendChild(label)
        card.appendChild(input);
        table.appendChild(card);

        const arrDat = ['opt_on', 'opt_off'];
        
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2', 'pr4');
            tr.setAttribute('data-fromDB', "");
            
            // item number jig
            const div1 =document.createElement('div');
            div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input1 = document.createElement('input');
            input1.value = data[i].item_jig;
            input1.setAttribute('type','text');
            input1.setAttribute('data-updType','');
            input1.setAttribute('list','jig_suggest');
            input1.setAttribute('autocomplete','off');
            input1.id = `item_jig+${data[i].id}`
            div1.appendChild(input1);
            tr.appendChild(div1);

            for (let iii=0; iii<arrDat.length; iii++) {
                const div2 =document.createElement('div');
                    div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
                const input2 = document.createElement('input');
                input2.classList.add('cap');
                input2.value = data[i][arrDat[iii]];
                input2.setAttribute('type','text');
                input2.setAttribute('data-updType','');
                input2.id = `${arrDat[iii]}+${data[i].id}`
                div2.appendChild(input2);
                tr.appendChild(div2);
            }

            const div6 =document.createElement('div');
            div6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input6 = document.createElement('input');
            input6.classList.add('cap', 'sl3', 'fc-w');
            input6.value = data[i]['status'];
            input6.setAttribute('type','text');
            input6.disabled = true;
            input6.setAttribute('data-updType','');
            input6.id = `status+${data[i].id}`
            div6.appendChild(input6);
            tr.appendChild(div6);

             
            const div3 =document.createElement('div');
            div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input3 = document.createElement('input');
            input3.classList.add('cap');
            input3.setAttribute('type','text');
            input3.id = `remark+${data[i].id}`;
            input3.setAttribute('data-updType','');
            div3.appendChild(input3);

            const div4 =document.createElement('div');
            div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
            const input4 = document.createElement('button');
            input4.classList.add('cap');
            input4.setAttribute('type','button');
            input4.id = `del+${data[i].id}`;
            input4.setAttribute('data-updType','');
            input4.textContent = "delete";
            div4.appendChild(input4);

            const input5 = document.createElement('input');
            input5.setAttribute('type', 'hidden');
            input5.id = `mark+${data[i].id}`;
            input5.value = `${data[i].item_jig}+${data[i].item_type}+${data[i].opt_on}+${data[i].opt_off}+${data[i].status}`;
            input5.setAttribute('data-updType','');
             
            tr.appendChild(div3);
            tr.appendChild(div4);
            tr.appendChild(input5);
            table.appendChild(tr);
        }
        return table;
    } catch(error) {
        console.log(error);
    }
}



export const tblHistType = async(data) => {
    try{
        const arrayHeader = ['item jig', 'put on ops', 'pull out ops', 'status', 'Remark', 'Transaction Date (y-m-d)'];
        await tableHeader('typeContain', 'tableTypeHist', arrayHeader);
        const arrData = ['item_jig', 'opt_on', 'opt_off', 'status', 'remark', 'trans_date'];
        const table = document.getElementById('tableTypeHist');
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2');
            for (let ii=0; ii<arrData.length; ii++) {
                const div =document.createElement('div');
                div.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl8');
                div.textContent = data[i][`${arrData[ii]}`];
                div.id = `${arrData[ii]}_${data[i]}`;
                tr.appendChild(div);
            }
            table.appendChild(tr);
        }
        return table;
    }catch(error) {
        console.log(error);
    }
}

