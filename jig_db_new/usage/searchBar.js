import { createBtn, createInp } from '../../vjs_dmc/component/index.js';
/*
=======================================================================================
create search bar 
*/

export const createSearch = async(arr) => {
    try{
        const container = document.getElementById(arr.target);
        const div = document.createElement('div');
        div.id = arr.id;
        arr.divStyle.forEach(sty => {
            div.classList.add(sty)
        });
        div.appendChild(await createInp(arr.arrInp));
        div.appendChild(await createBtn(arr.arrBtn));
        container.appendChild(div);
    } catch(error){
        console.log(error);
    }}


export const searchBarMain = {// detail search
    target:'main',
    id:'searchDiv',
    divStyle:['tl4', 'p2'],
    arrInp:
    {
        id:'search',
        type:'text', // text or hidden
        placeholder:'-choose-',
        list:'asset_list',
        classSty:['mx2']
    },
    arrBtn: 
    {
        id:'searchBtn',
        marK:'',
        type:'button', // submit or button
        text: 'submit',
        classSty:['mx1'],
        js: {
            attr:'',
            value:''
        }
    },
}


