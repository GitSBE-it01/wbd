/*
=================================================================
datalist
*/
export const defaultDtls = () => ({
    id:'',
    data: '',
    delimiter:'--',
    optValue:[],
    optText:[]
})
// valueshown di isi dengan db field yg mau di tampilkan di value dan text contentnya 

export const createDatalist = async(arr) => {
    const dflt = defaultDtls();
    const target = document.getElementsByTagName('body');
    const datalist = document.createElement('datalist');
    datalist.id = arr.id ? arr.id : dflt.id;
    const data = arr.data ? arr.data : dflt.data;
    if (Array.isArray(data)) {
        data.forEach(dt => {
            const option = document.createElement('option');
            if (arr.optValue.length > 0) {
                const textContent = arr.optValue
                    .map(property => dt[property])
                    .join(arr.delimiter);
                option.value = textContent;
            } else {
                option.value = dt.arr.optValue;
            }
            if (arr.optText.length > 0) {
                const textContent = arr.optText
                    .map(property => dt[property])
                    .join(arr.delimiter);
                option.textContent = textContent;
            } else {
                option.textContent = dt.arr.optText;
            }
    
            datalist.appendChild(option);
        })
    }
    target.appendChild(datalist);
    
}
