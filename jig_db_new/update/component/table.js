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
        tr.classList.add('fr', 'fc-ctr', 'fc-w', 'pt', 'thCont');
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
        const card  = document.createElement('div');
        card.classList.add('fr', 'mh2');
        const label = document.createElement('label');
        label.textContent = 'toleransi';
        const input = document.createElement('input');
        input.textContent = 'Tolerance';
        input.id ='tol';
        input.setAttribute('autocomplete', 'off');
        input.setAttribute('type', 'text');
        card.appendChild(label)
        card.appendChild(input);
        table.appendChild(card);

        for (let i=0; i<dataLoc.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'tdCont2');
            
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
            input2.id = `qty_per_unit+${dataLoc[i].code}`
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
        
            tr.appendChild(div1);
            tr.appendChild(div2);
            tr.appendChild(div3);
            tr.appendChild(div4);
            tr.appendChild(div5);
            tr.appendChild(div6);

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
