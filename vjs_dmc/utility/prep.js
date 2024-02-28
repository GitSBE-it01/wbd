/*-------------------------
add tag
-------------------------*/
const addDtTag= (dt, tag, srcTag) =>{
    const current = dt.getAttribute(srcTag);
    const rowDt = dt.closest(tag)
    if (!current.includes('berubah')){
        const add = current + '++berubah';
        rowDt.setAttribute('data-row', 'change');
        dt.setAttribute('data-cell', add);
    }
    return;
}


const getSplitValue = (data, tag, srcTag, ...val) => {
    const split = data.value.split(" -- ");
    for (let i=0; i<val.length; i++) {
        const target = document.querySelector(`[data-cell*="${val[i]}"]`);
        target.textContent = split[i+1];
    }
    addDtTag(data, tag, srcTag);
    return;
}
