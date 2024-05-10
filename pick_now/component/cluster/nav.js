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
}

const mainLinkDiv = async() => {
    await create({
        element: 'div',
        cell: 'linkHome',
        selector: '#navID',
        class: 'mx5 mt2 pr1',
    })
    await create({
        element: 'button',
        selector: '[data-cell = "linkHome"]',
        class: 'home',
        href:'../../sbe/index.php'
    })
    const textContArr = [
        {text:'home', ref: 'index.php'}, 
        {text:'tallysheet', ref: 'tallysheet.php'}, 
        {text:'test2', ref: '#section2'}, 
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
            onmouseover: '',
            href:`${textContArr[i]['ref']}`
        })
    }
}

// sidebar home
export const sideNav = async() => {
    await create({
        element: 'div',
        selector: '#main',
        id: 'sideID',
        class: 'sl4 cl1 pb2 flex-c h100'
    })
    await create({
        element: 'div',
        selector: '#main',
        id: 'main2',
        class: 'sl8 cl11 h100 w100 flex-c'
    })
    await sideLinkDiv();
}

const sideLinkDiv = async() => {

    const textContArr = [
        {dept: 'P1.ASSY',text:'Prod1', ref: '#Prod1'}, 
        {dept: 'PROD1.VC',text:'VC', ref: '#VC'}, 
        {dept: 'WH ASSY',text:'WHPR', ref: '#WHPR'}, 
        {dept: 'SBE3',text:'SBE3', ref: '#SBE3'}, 
        {dept: 'PROD2',text:'Prod2', ref: '#Prod2'}, 
        {dept: 'PROD3',text:'Prod3', ref: '#Prod3'}, 
        {dept: 'QA',text:'Servis', ref: '#Servis'}, 
        {dept: 'SBE4',text:'Subcont', ref: '#Subcont'}, 
        {dept: 'KAYU',text:'WWA', ref: '#WWA'}, 
    ]
    for (let i = 0; i<textContArr.length; i++) {
        await create({
            element: 'div',
            cell: `sideLink--${i}`,
            selector: '#sideID', 
            class: 'py4 tl8 fc-b pl2 mouseHover',
            deptPick: `${textContArr[i]['dept']}`,
            tanda: '',
            textCont: `${textContArr[i]['text']}`
        })
    }
}

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


