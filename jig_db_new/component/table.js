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

export const tblGenJig = async (tbodyID,data) => {
    try {
        const tableBody = document.createElement('div');
        tableBody.classList.add('tr');
        tableBody.id = tbodyID;
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.classList.add('fr', 'pr1');
            tr2.innerHTML = `
                <div class="flexCh td bd-black sl9 cap">${data[i].item_jig}</div>
                <div class="flexCh td bd-black sl9 cap">${data[i].desc_jig}</div>
                <div class="flexCh td bd-black sl9 cap">${data[i].type_jig}</div>
                <div class="flexCh td bd-black sl9 cap">${data[i].status_jig}</div>
                <div class="flexCh td bd-black sl9 cap">${data[i].material}</div>
                <div class="flexCh td bd-black sl9 cap">${data[i].qtyOnHand}</div>
                <input type="hidden" value=${data[i].filter}>
                <div class="flexCh td bd-black sl9 cap">
                    <button id='type_${data[i].item_jig}'>detail tipe</button>
                    <button id='loc_${data[i].item_jig}'>detail lokasi</button>
                </div>
            `;
            const tr3 = document.createElement('div');
            tr3.classList.add('fr');
            tr3.innerHTML=   `<div class="hide" id="hid_${data[i].item_jig}"></div>`;
            const tr4 = document.createElement('div');
            tr4.classList.add('fr');
            tr4.innerHTML=   `<div class="hide" id="hid2_${data[i].item_jig}"></div>`;
            tableBody.appendChild(tr2);
            tableBody.appendChild(tr3);
            tableBody.appendChild(tr4);
        }
        return tableBody;
    } catch(error) {
        console.log(error);
    }
}


/*===================================================
speaker table generate
===================================================*/
export const tblGenSpk = async (tbodyID,data) => {
    try {    
        const tableBody = document.createElement('div');
        tableBody.classList.add('tr');
        tableBody.id = tbodyID;
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.classList.add('fr', 'pr1');
            tr2.innerHTML = `
                <div class="flexCh td2 bd-black sl9 cap">${data[i].item_type}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].description}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].status_speaker}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].item_jig}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].desc_jig}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].opt_on}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].opt_off}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].material}</div>
                <div class="flexCh td2 bd-black sl9 cap">${data[i].qtyOnHand}</div>
                <input type="hidden" value=${data[i].filter}>
            `
            tableBody.appendChild(tr2);
        }
        return tableBody;
    } catch(error) {
        console.log(error);
    }
}


/*===================================================
location table 
===================================================*/
export const tblLocJig = async (target, arrHead, data) => {
    try {    
        const container = document.getElementById(target);
        const table = document.createElement('div');
        table.classList.add('tHid');
        const tableBody = document.createElement('div');
        tableBody.classList.add('thSmall');
        const tr = document.createElement('div');
        tr.classList.add('fr', 'fc-ctr', 'fc-w', 'pr4', 'thCont2');
        tr.id = 'tableHeader';
        for (let i=0; i<arrHead.length; i++) {
            const th = document.createElement('div');
            th.classList.add('or3', 'flexCh', 'th', 'bd-black', 'upper');
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.classList.add('fr', 'tdCont', 'pr1');
            tr2.innerHTML = `
                <div class="flexCh td bd-black or8 cap">${data[i].lokasi}</div>
                <div class="flexCh td bd-black or8 cap">${data[i].qty_per_unit}</div>
                <div class="flexCh td bd-black or8 cap">${data[i].unit}</div>
            `
            table.appendChild(tr2);
        }
        container.appendChild(table);
    } catch(error) {
        console.log(error);
    }
}



/*===================================================
type speaker table utk jig table
===================================================*/
export const tblTypeJig = async (target, arrHead, data) => {
    try {    
        const container = document.getElementById(target);
        const table = document.createElement('div');
        table.classList.add('tHid');
        const tableBody = document.createElement('div');
        tableBody.classList.add('thSmall');
        const tr = document.createElement('div');
        tr.classList.add('fr', 'fc-ctr', 'fc-w', 'pr4', 'thCont2');
        tr.id = 'tableHeader';
        for (let i=0; i<arrHead.length; i++) {
            const th = document.createElement('div');
            th.classList.add('or3', 'flexCh', 'th', 'bd-black', 'upper', 'pr4');
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.classList.add('fr', 'tdCont', 'pr1');
            tr2.innerHTML = `
                <div class="flexCh td bd-black or9 cap">${data[i].item_type}</div>
                <div class="flexCh td bd-black or9 cap">${data[i].description}</div>
                <div class="flexCh td bd-black or9 cap">${data[i].status_type}</div>
                <div class="flexCh td bd-black or9 cap">${data[i].opt_on}</div>
                <div class="flexCh td bd-black or9 cap">${data[i].opt_off}</div>
            `
            table.appendChild(tr2);
        }
        container.appendChild(table);
    } catch(error) {
        console.log(error);
    }
}

