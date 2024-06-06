/*==============================================================================
FUNCTION LIST
Berikut adalah list FUNCTION  yang akan di pakai di prog VJS
==============================================================================*/
/*-------------------------
Get date
-------------------------*/
export function currentDate() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2,'0');
    const day = String(today.getDate()).padStart(2,'0');
    return `${year}-${month}-${day}`;
}

export function curDate(separ) {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2,'0');
    const day = String(today.getDate()).padStart(2,'0');
    const result = `${year}${separ}${month}${separ}${day}`
    return result;
}

export function getCustomDate(number) {
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

/*-------------------------
check active link
-------------------------*/
export const activeLink = (target, arrCls) => {
    const container = document.getElementById(target);
    const aLink = container.querySelectorAll('a');
    aLink.forEach(link=> {
        const currentUrl = window.location.href.split('/');
        const compare = currentUrl[currentUrl.length-1];
        const hrefValue = link.getAttribute('href');
        if (hrefValue === compare) {
            arrCls.forEach(cls=> {
                link.classList.add(cls);
            })
        }
    })
}

export const activeLink2 = (target, styles) => {
    const container = document.querySelector(target);
    const aLink = container.querySelectorAll('a');
    aLink.forEach(link=> {
        const currentUrl = window.location.href.split('/');
        const compare = currentUrl[currentUrl.length-1];
        const hrefValue = link.getAttribute('href');
        if (hrefValue === compare) {
            link.setAttribute('style', styles);
        }
    })
}


export const removeSpaces = (str, replaceChar) => {
    const regex = /\s/g;
    return str.replace(regex, replaceChar);
  }