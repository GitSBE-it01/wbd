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

/*-------------------------
remove container 
-------------------------*/
export function rmvNode(...target) {
    target.forEach(tgt=> {
        if (document.getElementById(tgt)) {
            document.getElementById(tgt).remove();
        }
    })
    return;
}

/*-------------------------
export to csv 
-------------------------*/
export const jsonToCsv= async(jsonData, name) => {
    try {
        const json = JSON.stringify(jsonData)
        // Convert JSON data to array of objects
        const data = JSON.parse(json);
        // Extract column headers from the first object
        const headers = Object.keys(data[0]);
        
        // Create CSV content
        let csvContent = headers.join(',') + '\n'; // Header row
        
        // Append data rows
        data.forEach(item => {
            const row = headers.map(header => item[header]);
            csvContent += row.join(',') + '\n';
        });
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = name;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        return;
    } catch(error) {
        console.log(error);
    }
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
                        (date.getMonth() + 1) + '-' + 
                        (date.getDate());
    
    return formattedDate;
}

export const jsonToExcel = async (jsonData, name) => {
    try {
        const json = JSON.stringify(jsonData);
        // Convert JSON data to array of objects
        const data = JSON.parse(json);
        // Extract column headers from the first object
        const headers = Object.keys(data[0]);

        // Create an XML document
        let xml = '<?xml version="1.0"?>\n';
        xml += '<ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">\n';
        xml += ' <ss:Worksheet ss:Name="Sheet1">\n';
        xml += '  <ss:Table>\n';

        // Header row
        xml += '   <ss:Row>\n';
        headers.forEach(header => {
            xml += `    <ss:Cell><ss:Data ss:Type="String">${header}</ss:Data></ss:Cell>\n`;
        });
        xml += '   </ss:Row>\n';

        // Data rows
        data.forEach(item => {
            xml += '   <ss:Row>\n';
            headers.forEach(header => {
                xml += `    <ss:Cell><ss:Data ss:Type="String">${item[header]}</ss:Data></ss:Cell>\n`;
            });
            xml += '   </ss:Row>\n';
        });

        xml += '  </ss:Table>\n';
        xml += ' </ss:Worksheet>\n';
        xml += '</ss:Workbook>';

        const blob = new Blob([xml], { type: 'application/vnd.ms-excel' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = name.endsWith('.xls') ? name : name + '.xls'; // Ensure file extension is .xls
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        return;
    } catch (error) {
        console.log(error);
    }
};