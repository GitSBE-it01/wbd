/*===================================================
jig table generate
===================================================*/
export const tHeader = async(target,tableID, arrHead, color) => {
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
            th.classList.add('flexCh', 'th', 'bd-black', 'upper', color);
            th.textContent = arrHead[i];
            tr.appendChild(th);
        }
        table.appendChild(tr);
        container.appendChild(table);
    } catch(error){
        console.log(error);
    }
}

export const tData = async (tbodyID, data, arr, color) => {
    try {
        const tableBody = document.createElement('div');
        tableBody.classList.add('tr');
        tableBody.id = tbodyID;
        for (let i=0; i<data.length; i++) {
            const tr2 = document.createElement('div');
            tr2.setAttribute('data-tr', '');
            tr2.classList.add('fr', 'pr1');
            for (let ii=0; ii<arr.length; ii++) {
                const tData = document.createElement('div');
                tData.classList.add('flexCh', 'td', 'bd-black', `${color}`, 'cap');
                tData.textContent = `${data[i].arr[i]}`;
                tr2.appendChild(tData);
            }
            tableBody.appendChild(tr2);
        }
        return tableBody;
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

export const insertHidInp = async (target, data, arr) => {
    try {
        const dataTr = document.querySelectorAll(target);
        for (let i=0; i<dataTr.length; i++) {
            for (let ii=0; ii<arr.length; ii++) {
                const input = document.createElement('input');
                input.value = `${data[i].arr[ii]}`;
                input.setAttribute('type','hidden');
                input.setAttribute('data-input', arr[ii]);
                input.id = `${arr[ii]}+${data[i]}`;
                dataTr.appendChild(input);
            }
        }
    } catch(error) {
        console.log(error);
    }
}

export const insertHidDiv = async (target, data, arr) => {
    try {
        const dataTr = document.querySelectorAll(target);
        for (let i=0; i<dataTr.length; i++) {
            for (let ii=0; ii<arr.length; ii++) {
                const div = document.createElement('div');
                div.classList.add('hide');
                div.setAttribute('data-div', arr[ii]);
                div.id = `${arr[ii]}+${data[i]}`;
                dataTr.appendChild(div);
            }
        }
    } catch(error) {
        console.log(error);
    }
}




for (let i=0; i<data.length; i++) {
    input();
    hidden();
    btnUpdJig();


}