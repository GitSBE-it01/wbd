export const table = async(target, tableID, arr, data) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'w-full h-[85vh] bg-teal-100 scrollable');
    div.setAttribute('data-table',tableID);
    const table = document.createElement('table');
    table.setAttribute('class', 'w-full h-full bg-teal-400 ');
    
    const header_tr = document.createElement('tr');
    for (let i=0; i<arr.length; i++) {
        const th = document.createElement('th');
        th.textContent = arr[i].header;
        if (i===0) {
            th.setAttribute('class','bg-blue-700 border-2 text-white uppercase border-black p-2 sticky left-0 top-0 z-20');
        } else {
            th.setAttribute('class','bg-blue-600 border-2 text-white uppercase border-black p-2 sticky top-0 z-10');
        }
        header_tr.appendChild(th);
    }
    table.appendChild(header_tr);

    data.forEach(dt=>{
        const data_tr = document.createElement('tr');
        let filter ='';
        for (let i=0; i<arr.length; i++) {
            const td = document.createElement('td');
            td.textContent = dt[`${arr[i].data}`];
            filter += dt[`${arr[i].data}`] + "--";
            if(i === 0) {
                td.setAttribute('class','bg-slate-400 border-2 text-center text-sm font-semibold border-black p-2 sticky left-0 z-10')
            } else {
                td.setAttribute('class','bg-slate-300 border-2 text-sm border-black p-2')
            }
            data_tr.appendChild(td);
        }
        data_tr.setAttribute(`data-filter`, filter);
        table.appendChild(data_tr)
    })
    div.appendChild(table);
    trgt.appendChild(div);
}