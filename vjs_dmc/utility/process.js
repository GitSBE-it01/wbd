/*==============================================================================
FUNCTION LIST
Berikut adalah list FUNCTION  yang akan di pakai di prog VJS
==============================================================================*/
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

/*-------------------------
split string data
-------------------------*/
export function splitCustomString (delimiter, value) {
    const result = value.split(delimiter);
    return result
}


/*-------------------------
str to number with number of char and decimal
-------------------------*/
export function strToNumber(number, minNumber, decimalMinimum) {
    const noStr = number.toString();
    const splitStr = noStr.split(".");
    const intNo = splitStr[0];
    const decNo = splitStr[1];
    let resultInt = "";
    let resultDec = "";
    if (intNo.length < minNumber) {
        const diff = minNumber - intNo.length;
        for (let i =0 ; i < diff; i++) {
            resultInt += "0";
        }
        resultInt += intNo;
    } else {
        resultInt = intNo;
    }

    if (decimalMinimum === 0) {
        return resultInt;
    }

    if (decNo.length < decimalMinimum) {
        const diff = decimalMinimum - intNo.length;
        resultDec = "." + decNo;
        for (let i =0 ; i < diff; i++) {
            resultDec += "0";
            }
        return resultInt + resultDec;
    } 

    const cek1 = decNo.substring(0, decimalMinimum);
    const cek2 = decNo.substring(decimalMinimum, decimalMinimum+1);
    const cek3 = decNo.substring(decimalMinimum, decimalMinimum+2);
    let resultCek ="";

    if (decimalMinimum === 1) {
        if (parseInt(cek2) > 4) {
            resultCek = (parseInt(cek1) + 1);
            return resultInt + resultCek.toString();  
        } 
        return resultInt + "." + cek1;
    } 
    if (parseInt(cek3) > 4) {
            resultCek = (parseInt(cek2) + 1);
            return resultInt + resultCek.toString();  
        }
    return resultDec = "." + cek1 + cek2;
}

/*-------------------------
delete children node
-------------------------*/
export function delChild(target) {
    const container = document.getElementById(target);
    if (container.childNodes.length > 0) {
        container.removeChild(container.lastChild);
        return;
    }
    alert('there is nothing to delete');
}


