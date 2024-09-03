/*
=================================================================
button
*/
export const createBtn = async(arr) => {
    const btn = document.createElement('button');
    if(arr.id !== "") {btn.id = arr.id;}
    if(arr.mark !== "") {btn.setAttribute('data-btn', arr.mark);}
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