export const dtlist = (ID, dataArr, keyPick) => {
    const target = document.querySelector('body');
    const dtlist = document.createElement('datalist');
    dtlist.id = ID;
    dataArr.forEach(dt=>{
        const key = Object.keys(dt);
        let defaultVal = '';
        if(key.length>0) {
            key.forEach(dt2=>{
                defaultVal += '-' + dt[dt2] + '-';
            })
        } else {
            defaultVal = dt;
        }
        const option = document.createElement('option');
        if(!keyPick || keyPick === '') {
            option.value = defaultVal;
            option.textContent = defaultVal;
        } else {
            option.value = dt[keyPick];
            option.textContent = dt[keyPick];
        }
        dtlist.appendChild(option);
    })
    target.appendChild(dtlist);
    return;
}
