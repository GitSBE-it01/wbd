export const input = async(data, src, mark) => {
    const div = document.createElement('div');
    const classes = data.dataClass;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    const input = document.createElement('input');
    const classes2 = data.secondClass;
    if(classes2) {
        classes2.forEach(clas=>{
            input.classList.add(clas);
        });
    }
    input.id = data.value + "+" + mark;
    input.setAttribute('autocomplete', 'off');
    if (data.list) {
        input.setAttribute('list', data.list);
    }
    input.value = src[data.value];
    div.appendChild(input);
    return div;
}    

export const button = async(data, mark) => {
    const div = document.createElement('div');
    const classes = data.dataClass;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    const btn = document.createElement('button');
    const classes2 = data.secondClass;
    if(classes2) {
        classes2.forEach(clas=>{
            btn.classList.add(clas);
        });
    }
    btn.id = data.value + "+" + mark;
    btn.setAttribute('type', 'button');
    btn.textContent = data.value;
    div.appendChild(btn);
    return div;
}


export const text = async(data, src, mark) => {
    const div = document.createElement('div');
    const classes = data.dataClass;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    div.id = data.value + "+" + mark;
    div.textContent = src[data.value];
    return div;
}

export const hidden = async(data, src, mark) => {
    const div = document.createElement('input');
    div.setAttribute('type', 'hidden');
    div.id = data.value + "+" + mark;
    div.value = src[data.value];
    return div;
}

export const hidDiv = async(data, mark) => {
    const div = document.createElement('input');
    div.setAttribute('type', 'text');
    div.classList.add('hide');
    div.id = data.value + "+" + mark;
    return div;
}

export const createTable = async(array, data, mark, target, idTable) => {
    const container = document.getElementById(target);
    container.appendChild(await header(idTable, array));
    const table = document.getElementById(idTable);
    for (let i=0; i<data.length; i++) {
        const idMarker = data[i][mark];
        table.appendChild(await createTr(idMarker));
        const getTr = document.getElementById(idMarker);
        for (let ii=0; ii<array.length; ii++) {
            console.log(array[ii].typeData);
            if (array[ii].typeData === 'input'){
                const result = await input(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else if (array[ii].typeData === 'text'){
                const result = await text(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else if (array[ii].typeData === 'hidden'){
                const result = await hidden(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else if (array[ii].typeData === 'button'){
                const result = await button(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else if (array[ii].typeData === 'div'){
                const result = await div(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else if (array[ii].typeData === 'hidDiv'){
                const result = await hidDiv(array[ii], data[i],idMarker)
                getTr.appendChild(result);
            } else {
                alert('data input wrong');
            }
        }

    }
}

export const header = async(idTable, data) =>{
    const tableDiv = document.createElement('div');
    tableDiv.id = idTable;
    const headerTr = document.createElement('div');
    headerTr.classList.add('fr');
    for (let i=0; i<data.length; i++) {
        if (data[i].header) {
            const div = document.createElement('div');
            div.textContent = data[i].header;
            const classes = data[i].headerClass;
            classes.forEach(clas=>{
                div.classList.add(clas);
            });
            headerTr.appendChild(div);
        }
    }
    tableDiv.appendChild(headerTr);
    return tableDiv;
}

export const createTr = async(trId) => {
    const tr = document.createElement('div');
    tr.classList.add('fr');
    tr.id = trId;
    return tr;
}
