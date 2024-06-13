import { removeSpaces } from "./process.js";

export const dl_process = async(trgt, sheetName, data_mark) =>{
    try {
        const target = document.querySelector(trgt);
        const allRow = target.querySelectorAll('[data-filter]');
        let file = [];
        allRow.forEach(dt=>{
            if (!dt.classList.contains('hidden')) {
                const field = dt.querySelectorAll('[data-field]');
                const data = {};
                for (let i=0; i<field.length; i++) {
                    if(!field[i].textContent || field[i].textContent === '') {
                        data[`${data_mark[i].header}`] = field[i].value;
                    } else {
                        data[`${data_mark[i].header}`] = field[i].textContent;
                    }
                }
                file.push(data);
            }
        })
        const fileName = removeSpaces(sheetName, '_');
        const workbook = XLSX.utils.book_new();
        const worksheet = XLSX.utils.json_to_sheet(file);
        XLSX.utils.book_append_sheet(workbook, worksheet, sheetName);
        XLSX.writeFile(workbook, `${fileName}.xlsx`);
    } catch(error) {
        console.error('Error:', error);
        return alert('data error silahkan hubungi tim IT');
    }
}