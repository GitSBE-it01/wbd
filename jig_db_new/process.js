/*==============================================================================
FUNCTION LIST
Berikut adalah list FUNCTION  yang akan di pakai di prog VJS
==============================================================================*/
/*
function utk populate data 
-------------------------
option 
Note : digunakan dengan catatan value dan text contentnya hasilnya sama
-------------------------
*/
export async function populateOption(target, idOpt, delimiter, data, ...textProperties) {
    try {
        const container = document.getElementById(target);
        const option_id = document.createElement('datalist');
        option_id.id = idOpt;
        for (let i = 0; i < data.length; i++) {
            const option = document.createElement('option');
            if (textProperties.length > 0) {
                const textContent = textProperties
                    .map(property => data[i][property])
                    .join(delimiter);
                option.value = textContent;
                option.textContent = textContent;
            } else {
                option.textContent = data[i][textProperties];
                option.value = data[i][textProperties];
            }
            option_id.appendChild(option);
        }
        container.appendChild(option_id);
    } catch (error) {
        console.log('error : ', error);
    }
}

/*-------------------------
table 
-------------------------*/
/*
header:
di isi lgsg dengan HTML code
*/


export async function html(target, dataHTML) {
    const container = document.getElementById(target);
    container.insertAdjacentHTML('beforeend', dataHTML);
}

/*-------------------------
Get today date
-------------------------*/
export function currentDate () {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;
    const day = today.getDate();
    return `${year}-${month}-${day}`;
}

export function yesterdayDate () {
    const today = new Date();
    const year = today.getFullYear();
    const month = today.getMonth() + 1;
    const day = today.getDate() - 1;
    let result = '';
    if(month<10 && day<10) {return result = `${year}-0${month}-0${day}`;} 
    if (month<10 && day>9) {return result = `${year}-0${month}-${day}`;}
    if (month>9 && day>9) {return result = `${year}-${month}-${day}`;}
    if (month>9 && day<10) {return result = `${year}-${month}-0${day}`;}
    console.log(result);
    return result;
}

/*-------------------------
split string data
-------------------------*/
export function splitCustomString (delimiter, value) {
    const result = value.split(delimiter);
    return result
}


/*-------------------------
decision 
-------------------------*/
export async function cekDMCdaily (database, filter) {
    const data = await database.fetchDataFilter(filter);
    if (data.length === 0) {
        return false;
    }
    return true;
}

export function isFormValid(formID) {
    const form = document.getElementById(formID);
    const inputElements = form.querySelectorAll('input[required]');
    for (const input of inputElements) {
        if (input.value === null || input.value === "") {
            return false; 
        }
    }
    return true; 
}
