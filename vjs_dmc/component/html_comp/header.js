
/*
=================================================================
header text
*/
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
