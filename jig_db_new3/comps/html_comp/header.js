
/*
=================================================================
header text
*/
export const createHeader = async(arr)=> {
    const hd = document.createElement('div');
    hd.textContent = arr.text;
    if(arr.id !== '') {hd.id = arr.id;}
    if(arr.mark !== '') {hd.setAttribute('data-header', arr.mark);}
    arr.style.forEach(cls => {
        hd.classList.add(cls);
    })
    return hd;
}
