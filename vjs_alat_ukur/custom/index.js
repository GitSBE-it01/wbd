export const customTableRow = async(data_group, remark) =>{
    const tr = document.createElement('tr');
    tr.setAttribute('data-tr', 'new__last');
    if(remark[0].id!== '') {
        tr.setAttribute('data-tr', remark[0].id);
    }
    const td1 = document.createElement('td');
    td1.textContent = 'remark';
    td1.setAttribute('data-field', 'check_point');
    td1.setAttribute('class',"bg-slate-300 border-2 text-sm border-black p-2 capitalize")
    const td2 = document.createElement('td');
    td2.setAttribute('class',"bg-slate-300 border-2 text-sm border-black p-2")
    td2.setAttribute('colspan',4);
    const input = document.createElement('textarea');
    input.placeholder = 'masukkan komentar / keterangan di sini';
    input.setAttribute('maxlength', 200);
    if(remark[0].result !== '' || remark[0].result !== null) {
        input.value = remark[0].result;
    }
    input.setAttribute('data-field', 'result');
    input.setAttribute('class', 'w-full h-[10vh] rounded focus:ring focus:ring-blue-600 p-2 focus:ring-width-1 focus:outline focus:bg-slate-200 focus:outline-blue-600 bg-slate-100');
    const targetTable = document.querySelector(`[data-table = "${data_group[1]}"]`);
    td2.appendChild(input);
    tr.appendChild(td1);
    tr.appendChild(td2);
    targetTable.appendChild(tr);
}
