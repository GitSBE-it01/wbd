import { createOpt,
    createDtlist } from "../index.js";

export const datalist =(src, idList, arrValue, arrText) =>{
    createDtlist ({
        selector: `body`,
        id: idList,
    })   
    src.forEach(dt=>{
        let allValue = '';
        let allText = '';
        arrValue.forEach(dt2=>{
            allValue += dt[dt2] + '--';
        })
        allValue = allValue.replace("--", '').trim();
        arrText.forEach(dt2=>{
            allText += dt[dt2] + '--';
        })
        allText = allText.replace("--", '').trim();
        createOpt ({
            selector: `#${idList}`,
            value: allValue,
            textCont: allText
        })  
    })
}