/*==============================================================================
FUNCTION LIST
Berikut adalah list FUNCTION  yang akan di pakai di prog VJS
==============================================================================*/
/*-------------------------
Get date
-------------------------*/
export const currentDate = (separ) => {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2,'0');
    const day = String(today.getDate()).padStart(2,'0');
    const result = `${year}${separ}${month}${separ}${day}`
    return result;
}

export const getCustomDate = (number) => {
    let dayDate = new Date();
    dayDate.setDate(dayDate.getDate() + (number));
    const year = dayDate.getFullYear();
    const month = String(dayDate.getMonth() + 1).padStart(2,'0');
    const day = String(dayDate.getDate()).padStart(2,'0');
    return `${year}-${month}-${day}`;
}



/*-------------------------
date format
-------------------------*/
export const convertDateFormat = (inputDate) => {
    // Split the input date string by '/'
    let parts = inputDate.split('/');
    
    // Extract day, month, and year from the split parts
    let day = parts[0];
    let month = parts[1];
    let year = '20' + parts[2];
    
    // Construct a new Date object using the extracted values
    let date = new Date(year, month - 1, day); // Note: Month in Date object is 0-indexed
    
    // Format the date as 'yyyy-mm-dd'
    let formattedDate = date.getFullYear() + '-' + 
        (String(date.getMonth() + 1).padStart(2, '0')) + '-' + 
        (String(date.getDate()).padStart(2, '0'));
        
    return formattedDate;
}

/*-------------------------
str to number with number of char and decimal
-------------------------*/
export const numberToStr = (number, minNumber, decimalMinimum) => {
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

    if (!decNo || decimalMinimum === 0) {
        return resultInt;
    }

    if (decNo) {
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
        return resultDec = resultInt + "." + cek1 + cek2;
    }
}

/*-------------------------
check active link
-------------------------*/
export const activeLink = (target, cls) => {
    const container = document.getElementById(target);
    const aLink = container.querySelectorAll('a');
    aLink.forEach(link=> {
        const currentUrl = window.location.href.split('/');
        const compare = currentUrl[currentUrl.length-1];
        const hrefValue = link.getAttribute('href');
        if (hrefValue === compare) {
            link.setAttribute('class', cls);
        }
    })
}

export const removeSpaces = (str, replaceChar) => {
    const regex = /\s/g;
    return str.replace(regex, replaceChar);
  }