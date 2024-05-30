export const dtlist = (ID, dataArr) => {
    const target = document.querySelector('body');
    const dtlist = document.createElement('datalist');
    dtlist.id = ID;
    dataArr.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt;
        option.textContent = dt;
        dtlist.appendChild(option);
    })
    target.appendChild(dtlist);
    return;
}
