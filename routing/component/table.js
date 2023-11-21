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

export const tblData = async (target, data, arrDat, trClass, tdClass, inpClass) => {
    try {
        const table = document.getElementById(target)
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            for (let iii=0; iii<trClass.length; iii++) {
                tr.classList.add(trClass[iii]);;
            }
            tr.setAttribute('data-fromDB', "");
            
            for(let ii=0; ii<arrDat.length; ii++){
                const div = document.createElement('div');
                for (let iii=0; iii<tdClass.length; iii++) {
                    div.classList.add(tdClass[iii]);;
                }
                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.value = data[i][arrDat[ii]];
                input.id = `${arrDat[ii]}+${data[i][arrDat[ii]]}`;
                for (let iii=0; iii<inpClass.length; iii++) {
                    input.classList.add(inpClass[iii]);;
                }
                div.appendChild(input);
                tr.appendChild(div)
            }
            table.appendChild(tr);
        }
        return table;
    } catch(error) {
        console.log(error);
    }
}

export const tblData2 = async (target, data, arrDat) => {
    try {
        const table = document.getElementById(target)
        for (let i=0; i<data.length; i++){
            const tr = document.createElement('div');
            tr.classList.add('fr', 'td', 'pr4');
            tr.setAttribute('data-fromDB', "");
            
            // 'code_old'
            const div1 = document.createElement('div');
            const input1 = document.createElement('input');
            input1.setAttribute('type', 'text');
            input1.value = data[i].code_old;
            input1.id = `code_old+${data[i].code_old}`;
            div1.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl7');
            input1.classList.add('sl9', 'fc-w');
            div1.appendChild(input1);

            // 'code_new'
            const div2 = document.createElement('div');
            const input2 = document.createElement('input');
            input2.setAttribute('type', 'text');
            input2.value = data[i].code_new;
            input2.id = `code_new+${data[i].code_new}`;
            div2.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input2.classList.add('sl5', 'fc-w');
            div2.appendChild(input2)

            // 'desc_sbe4'
            const div3 = document.createElement('div');
            const input3 = document.createElement('input');
            input3.setAttribute('type', 'text');
            input3.value = data[i].desc_sbe4;
            input3.id = `desc_sbe4+${data[i].desc_sbe4}`;
            div3.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input3.classList.add('sl5', 'fc-w');
            div3.appendChild(input3)

            // 'wip_old'
            const div4 = document.createElement('div');
            const input4 = document.createElement('input');
            input4.setAttribute('type', 'text');
            input4.value = data[i].wip_old;
            input4.id = `wip_old+${data[i].wip_old}`;
            div4.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input4.classList.add('sl5', 'fc-w');
            div4.appendChild(input4)

            // 'wc_old'
            const div5 = document.createElement('div');
            const input5 = document.createElement('input');
            input5.setAttribute('type', 'text');
            input5.value = data[i].wc_old;
            input5.id = `wc_old+${data[i].wc_old}`;
            div5.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input5.classList.add('sl5', 'fc-w');
            div5.appendChild(input5)

            // 'ops_old'
            const div6 = document.createElement('div');
            const input6 = document.createElement('input');
            input6.setAttribute('type', 'text');
            input6.value = data[i].ops_old;
            input6.id = `ops_old+${data[i].ops_old}`;
            div6.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input6.classList.add('sl5', 'fc-w');
            div6.appendChild(input6)

            // 'ops_old_desc'
            const div7 = document.createElement('div');
            const input7 = document.createElement('input');
            input7.setAttribute('type', 'text');
            input7.value = data[i].ops_old_desc;
            input7.id = `ops_old_desc+${data[i].ops_old_desc}`;
            div7.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input7.classList.add('sl5', 'fc-w');
            div7.appendChild(input7)

            // 'wip_new'
            const div8 = document.createElement('div');
            const input8 = document.createElement('input');
            input8.setAttribute('type', 'text');
            input8.value = data[i].wip_new;
            input8.id = `wip_new+${data[i].wip_new}`;
            div8.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input8.classList.add('sl5', 'fc-w');
            div8.appendChild(input8)

            // 'wc_new'
            const div9 = document.createElement('div');
            const input9 = document.createElement('input');
            input9.setAttribute('type', 'text');
            input9.value = data[i].wc_new;
            input9.id = `wc_new+${data[i].wc_new}`;
            div9.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input9.classList.add('sl5', 'fc-w');
            div9.appendChild(input9)

            // 'ops_new'
            const div10 = document.createElement('div');
            const input10 = document.createElement('input');
            input10.setAttribute('type', 'text');
            input10.value = data[i].ops_new;
            input10.id = `ops_new+${data[i].ops_new}`;
            div10.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input10.classList.add('sl5', 'fc-w');
            div10.appendChild(input10)

            // 'ops_new_desc'
            const div11 = document.createElement('div');
            const input11 = document.createElement('input');
            input11.setAttribute('type', 'text');
            input11.value = data[i].ops_new_desc;
            input11.id = `ops_new_desc+${data[i].ops_new_desc}`;
            div11.classList.add('flexCh', 'td', 'cap', 'bd-black', 'sl4');
            input11.classList.add('sl5', 'fc-w');
            div11.appendChild(input11)

            tr.appendChild(div1);
            tr.appendChild(div2);
            tr.appendChild(div3);
            tr.appendChild(div4);
            tr.appendChild(div5);
            tr.appendChild(div6);
            tr.appendChild(div7);
            tr.appendChild(div8);
            tr.appendChild(div9);
            tr.appendChild(div10);
            tr.appendChild(div11);

            table.appendChild(tr);
        }
        return table;
    } catch(error) {
        console.log(error);
    }
}


export const tDataInput = async (tbodyID, data, arr, color, noteData) => {
    try {
        const tableBody = document.createElement('div');
        tableBody.classList.add('tr');
        tableBody.id = tbodyID;
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.setAttribute('data-tr', '')
            tr2.classList.add('fr', 'pr1');
            for (let ii=0; ii<arr.length; ii++) {
                const tData = document.createElement('div');
                tData.classList.add('flexCh', 'td', 'bd-black', `${color}`, 'cap');
                const tInput = document.createElement('input');
                tInput.classList.add(`${color}`)
                tInput.value = data[i][arr[ii]];
                tInput.setAttribute('type','text');
                tInput.setAttribute('data-input', noteData);
                tInput.id = arr[ii]+ data[i][arr[ii]];;
                tData.appendChild(tInput);
                tr2.appendChild(tData);
            }
            tableBody.appendChild(tr2);
        }
        return tableBody;
    } catch(error) {
        console.log(error);
    }
}