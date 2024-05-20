/*-------------------------
buat nav bar
-------------------------*/
// main navigation 
import { create } from "../block.js";

export const addDataNav = async() => {
    await create({
        element: 'div',
        selector: '#main',
        id: 'navID',
        style: `
            width: 100%;
            height: 4%;
            padding-top: .3rem;
            background-color: lightgray;
        `
    })                                                                                   
    
    const textContArr = [
        {text:'add jig', ref: '#section1'}, 
        {text:'add speaker', ref: '#section2'}, 
        {text:'loc & maintenance', ref: '#section3'}, 
    ]
    textContArr.forEach(dt=>{
        create({
            element: 'a',
            selector: '#navID',
            href: dt.ref,
            textCont: dt.text,
            onmouseover: "hover(this,'font-size: 1.2rem; font-weight: 800;')",
            onmouseout: "hoverOut(this,'font-size: 1.2rem; font-weight: 800;')",
            onclick: 'display()',
            style: `
                margin-left: 2rem;
                text-decoration: none;
                font-weight: 500;
                color: black;
            `
        })
    })
}


