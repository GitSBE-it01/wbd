import { create } from "../block.js";

export const dtlist =(src, idList, value, text) =>{
    create ({
        element: 'datalist',
        selector: '#root',
        id: idList,
    })   
    src.forEach(dt=>{
        create ({
            element: 'option',
            selector: `#${idList}`,
            value: dt[value],
            textCont: dt[text]
        })  
    })
}