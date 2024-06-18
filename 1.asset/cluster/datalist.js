export const customDtlist = async(array) =>{
    /* array 
        {
            target: '',
            src: '',
            style: {
                dtlist: '',
                separator: '',

            },
            pk: '',
            field: [],
        }
    */
    const dtlist = document.createElement('div');
    let keys = array.field;
    dtlist.setAttribute('class', 'w-[80%] h-[30vh] mx-2 rounded scrollable absolute bg-slate-200 z-40 hidden');
    if(array.style !== undefined && array.style.dtlist !== undefined) {
        dtlist.setAttribute('class', array.style.dtlist);
    }
    dtlist.setAttribute('data-datalist',array.ID);
    let counter = 0;
    array.src.forEach(dt=>{
        const separator = document.createElement('div');
        separator.setAttribute('class', 'w-[50%] h-[.2vh] bg-gray-400 flex items-center my-2');
        separator.setAttribute('data-sepID', counter);
        if(array.style !== undefined && array.style.separator !== undefined) {
            separator.setAttribute('class', array.style.separator);
        }
        const option = document.createElement('div');
        option.setAttribute('class', 'cursor-pointer')
        option.setAttribute('data-optionID', counter);
        counter++;
        let filter = '';
        option.setAttribute('class', 'whitespace-pre-line hover:bg-blue-300 cursor-pointer hover:text-semibold');
        if(array.style !== undefined && array.style.option !== undefined) {
            option.setAttribute('class', array.style.option);
        }
        if(array.pk !== undefined && array.pk !== '') {
            option.textContent = dt[array.pk];
            option.setAttribute('data-optFltr', dt[array.pk]);
        } else {
            keys.forEach(dtl=>{
                const detail = dtl.split("=");
                const desc = detail[0].trim();
                const value = detail[1].trim();
                option.textContent += `${desc}= ${dt[value]}, \n`;
                filter += dt[value] + '--';
            })
            option.setAttribute('data-optFltr', filter);
        }
        dtlist.appendChild(option);
        dtlist.appendChild(separator);
    })
   
    if(array.target !== undefined && array.target !== '') {
        console.log(array.target);
        const trgt = document.querySelector(array.target);
        console.log(trgt);
        return trgt.appendChild(dtlist);
    }
    return dtlist;
}