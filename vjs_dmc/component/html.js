/*
=================================================================
input
*/
const inpArrExp = {
    id:'',
    type:'', // text or hidden
    list:'',
    classSty:[],
}
export const createInp = async(arr) => {
    const input = document.createElement('input');
    input.id = arr.id;
    arr.classSty.forEach(sty => {
        input.classList.add(sty)
    })
    input.setAttribute('type',arr.type);
    if (arr.type === 'text'){
        input.setAttribute('list', arr.list);
        input.setAttribute('autocomplete',off);
    }
}


/*
=================================================================
button
*/
const btnArrExp = {
    id:'',
    type:'', // submit or button
    classSty:[],
}

export const createBtn = async(arr) => {
    const btn = document.createElement('button');
    btn.id = arr.id;
    arr.classSty.forEach(sty => {
        btn.classList.add(sty)
    })
    btn.setAttribute('type',arr.type);
}

/*
=================================================================
datalist
*/
const datalistArr = {
    id:'',
    data:'',
    delimiter:'',
    optValue:[],
    optText:[]
}
// valueshown di isi dengan db field yg mau di tampilkan di value dan text contentnya 

export const createDatalist = async(arr) => {
    const datalist = document.createElement('datalist');
    datalist.id = arr.id;
    arr.data.forEach(dt => {
        const option = document.createElement('option');
        if (valueShown.length > 0) {
            const textContent = valueShown
                .map(property => data[i][property])
                .join(arr.delimiter);
            option.value = textContent;
            option.textContent = textContent;
        } else {
            option.textContent = data[i][valueShown];
            option.value = data[i][valueShown];
        }
        datalist.appendChild(option);
    })
}


