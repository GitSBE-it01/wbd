/*
=================================================================
datalist
*/
export const createDatalist = async(arr) => {
    const target = document.getElementById(arr.target);
    const datalist = document.createElement('datalist');
    datalist.id = arr.id;
    arr.data.forEach(dt => {
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
        return target.appendChild(datalist);
    })
}
