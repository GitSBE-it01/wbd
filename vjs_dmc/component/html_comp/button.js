/*
=================================================================
button
*/
const btnArrExp = {
    id:'',
    type:'', // submit or button
    text:'',
    classSty:[],
    js: {
        attr:'',
        value:''
    }
}

export const createBtn = async(arr) => {
    const btn = document.createElement('button');
    btn.id = arr.id;
    arr.classSty.forEach(sty => {
        btn.classList.add(sty)
    })
    btn.textContent = arr.text;
    btn.setAttribute('type',arr.type);
    if (arr.js.attr !=='') {
        btn.setAttribute(arr.js.attr, arr.js.value);
    }
    return btn;
}