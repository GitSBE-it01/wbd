import { create } from "../blocks/block.js";
export const baseH1 = (target, idDiv,text) =>{
    create({
        element: 'div',
        selector: `#${target}`,
        id: `${idDiv}`,
        style: `margin-left: 1rem;`
    })
    create({
        element: 'h1',
        selector: `#${idDiv}`,
        style: `width: 100%;`,
        textCont: text
    })
}

export const baseH2 = (target, idDiv,text) =>{
    create({
        element: 'div',
        selector: `#${target}`,
        id: `${idDiv}`,
        style: `margin-left: 1rem;`
    })
    create({
        element: 'h2',
        selector: `#${idDiv}`,
        style: `width: 100%;`,
        textCont: text
    })
}

export const baseH3 = (target, idDiv,text) =>{
    create({
        element: 'div',
        selector: `#${target}`,
        id: `${idDiv}`,
        style: `margin-left: 1rem;`
    })
    create({
        element: 'h3',
        selector: `#${idDiv}`,
        style: `width: 100%;`,
        textCont: text
    })
}