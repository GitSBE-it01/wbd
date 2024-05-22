import { create } from "../block.js";

const headerTable = (headerArr, target, mainID, hdColor) => {
    create({
        element: 'div',
        selector: `#${target}`,
        id: `${mainID}`,
        style: `margin: 1rem 1rem 1rem 0;
            padding-right: 1rem;
            width: 100%;
            height: 100%;
            overflow: auto;
        `
    })
    create({
        element: 'div',
        selector: `#${mainID}`,
        head: `header_${mainID}`,
        style: `
            width: 100%; 
            display: flex; 
            flex-direction: row;
            `
    })

    const columnWidth = 100/(headerArr.length);
    headerArr.forEach(dt=>{
        create({
            element: 'div',
            hdCell: 'cellHD',
            selector: `[data-head = "header_${mainID}"]`,
            style: `
                width: ${columnWidth}%;
                background-color: ${hdColor};
                font-weight: 700;
                font-size: 1.2em;
                padding: .2rem 0 .2rem 1rem;
                color: azure;
                border: 2px solid black;
            `,
            textCont: dt
        })
    })
}

const dataTable = (array, mainID, dataColor, counter) => {
    create({
        element: 'div',
        selector: `#${mainID}`,
        row: `${counter}`,
        style: `
            width: 100%; 
            display: flex; 
            flex-direction: row;
            `
    })
    const columnWidth = 100/(array.length);
    array.forEach(dt=>{
        create({
            element: 'div',
            selector: `[data-row = "${counter}"]`,
            cell: `${dt.mark}__${counter}`,
            style: `
                width: ${columnWidth}%;
                background-color: ${dataColor};
                font-weight: 700;
                font-size: 1.2em;
                padding: .2rem 0 .2rem 1rem;
                border: 2px solid black;
            `,
        })
        const test = document.querySelector(`[data-row = "${dt.mark}"]`)
        create({
            element: 'input',
            selector: `[data-cell = "${dt.mark}__${counter}"]`,
            cellVal: `${dt.mark}__${counter}`,
            style: `
                padding: .2rem;
            `,
        })
    })
}

export const tableInit = (headerArr, dataArr, target, mainID,counter, hdColor, dataColor) =>{
    headerTable(headerArr, target, mainID, hdColor);
    dataTable(dataArr,mainID,dataColor, counter);
}

