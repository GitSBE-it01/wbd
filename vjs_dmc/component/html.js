/*
=================================================================
input
*/
const inpArrExp = {
    id:'',
    type:'', // text or hidden
    placeholder: '',
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
        input.setAttribute('placeholder', arr.placeholder)
        input.setAttribute('list', arr.list);
        input.setAttribute('autocomplete', false);
    }
    return input;
}


/*
=================================================================
button
*/
const btnArrExp = {
    id:'',
    type:'', // submit or button
    text:'',
    classSty:[],
}

export const createBtn = async(arr) => {
    const btn = document.createElement('button');
    btn.id = arr.id;
    arr.classSty.forEach(sty => {
        btn.classList.add(sty)
    })
    btn.textContent = arr.text;
    btn.setAttribute('type',arr.type);
    return btn;
}

/*
=================================================================
datalist
*/
const datalistArr = {
    target:'',
    id:'',
    data:'',
    delimiter:'',
    optValue:[],
    optText:[]
}
// valueshown di isi dengan db field yg mau di tampilkan di value dan text contentnya 

export const createDatalist = async(arr) => {
    const target = document.getElementById(arr.target);
    const datalist = document.createElement('datalist');
    datalist.id = arr.id;
    arr.data.forEach(dt => {
        const option = document.createElement('option');
        if (arr.optValue.length > 0) {
            const textContent = arr.optValue
                .map(property => dt[property])
                .join(arr.delimiter);
            option.value = textContent;
        } else {
            option.value = dt.arr.optValue;
        }
        if (arr.optText.length > 0) {
            const textContent = arr.optText
                .map(property => dt[property])
                .join(arr.delimiter);
            option.textContent = textContent;
        } else {
            option.textContent = dt.arr.optText;
        }

        datalist.appendChild(option);
        return target.appendChild(datalist);
    })
}

const arr = {
    target:'',
    id:'',
    style: [],
    text:''
}
export const createHeader = async(arr)=> {
    const target = document.getElementById(arr.target);
    const hd = document.createElement('div');
    hd.textContent = arr.text;
    hd.id = arr.id;
    arr.style.forEach(cls => {
        hd.classList.add(cls);
    })
    return target.appendChild(hd);
}
