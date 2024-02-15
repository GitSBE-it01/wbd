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

