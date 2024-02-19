/*-------------------------
add tag
-------------------------*/
const addDtTag= (tag) =>{
    const current = tag.getAttribute('data-cell');
    const rowDt = tag.closest('[data-row]')
    if (!current.includes('berubah')){
        const add = current + '++berubah';
        rowDt.setAttribute('data-row', 'change');
        tag.setAttribute('data-cell', add);
    }
    return;
}
