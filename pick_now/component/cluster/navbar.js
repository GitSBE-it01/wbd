/*-------------------------
buat nav bar
-------------------------*/
// main navigation 
import { create } from "../block.js";

export const mainNav = async() => {
    await create({
        element: 'div',
        selector: '#root',
        id: 'navID',
        class: 'sl2 pb2 flex-r'
    })
    await create({
        element: 'div',
        selector: '#root',
        id: 'main',
        class: 'sl8 h100 w100 flex-r'
    })
    await mainLinkDiv();
    await mainSearch();
}

const mainLinkDiv = async() => {
    await create({
        element: 'div',
        cell: 'linkHome',
        selector: '#navID',
        class: 'mx5 mt2 pr1',
    })
    await create({
        element: 'a',
        id: 'homeBtn',
        selector: '[data-cell = "linkHome"]',
        href:'../../sbe/index.php'
    })
    await create({
        element: 'button',
        type: 'button',
        selector: '#homeBtn',
        class: 'home',
    })
    const textContArr = [
        {text:'home', ref: 'index.php'}, 
        {text:'tallysheet', ref: 'tallysheet.php'}, 
        {text:'PIC', ref: 'update_pic.php'}, 
    ]
    for (let i = 0; i<textContArr.length; i++) {
        await create({
            element: 'div',
            cell: `mainLink--${i}`,
            selector: '#navID', 
            class: 'mx4 mt2 pt1',
        })
        await create({
            element: 'a',
            selector: `[data-cell = "mainLink--${i}"]`,
            textCont: `${textContArr[i]['text']}`,
            class: 'f-sl7 fs-m fw-blk cap',
            href:`${textContArr[i]['ref']}`
        })
    }
}

const mainSearch = async() => {
    await create({
        element: 'div',
        cell: 'mainSearch',
        selector: '#navID',
        style: 'right: 0; position:fixed;',
        class: 'm2'
    })
    await create({
        element: 'input',
        id: 'mainSearchInput',
        selector: '[data-cell = "mainSearch"]',
        placeholder: 'search ...'
    })
    await create({
        element: 'button',
        id: 'mainSearchBtn',
        type: 'button',
        selector: '[data-cell = "mainSearch"]',
        class: 'mt1 ml2',
        textCont: 'search'
    })
    await create({
        element: 'button',
        id: 'dlExcel',
        type: 'button',
        selector: '[data-cell = "mainSearch"]',
        class: 'mt1 ml2',
        textCont: 'dl to excel'
    })
}



