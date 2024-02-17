/*-------------------------
add tag
-------------------------*/
const addDtTag= (tag) =>{
    const current = tag.getAttribute('data-cell');
    const add = current + '++berubah';
    tag.setAttribute('data-cell', add);
    return;
}
