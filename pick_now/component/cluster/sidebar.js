/*-------------------------
buat nav bar
-------------------------*/
// main navigation 
import { create } from "../block.js";

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
        class: 'sl8 cl11 h100 flex-c'
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
        {dept: 'WOODWORK',text:'WWA', ref: '#WWA'}, 
    ]
    for (let i = 0; i<textContArr.length; i++) {
        await create({
            element: 'div',
            cell: `sideLink--${i}`,
            selector: '#sideID', 
            class: 'py4 bl7 fc-b pl2 mouseHover',
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


