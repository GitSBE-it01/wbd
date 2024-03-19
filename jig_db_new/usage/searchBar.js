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
        const label = document.createElement('label');
        label.textContent = 'From Date';
        label.classList.add('mr2', 'pr1');
        const label2 = document.createElement('label');
        label2.textContent = ' To Date ';
        label2.classList.add('mr2', 'px2');
        div.appendChild(label);
        div.appendChild(await createInp(arr.arrInp[0]));
        div.appendChild(label2);
        div.appendChild(await createInp(arr.arrInp[1]));
        div.appendChild(await createBtn(arr.arrBtn));
        container.appendChild(div);
    } catch(error){
        console.log(error);
    }}


export const searchBarMain = {// detail search
    target:'main',
    id:'searchDiv',
    divStyle:['tl4', 'p2'],
    arrInp: [
        {
            id:'from',
            type:'date', // text or hidden
            placeholder:'-from date-',
            list:'',
            classSty:['mx2', 'px2']
        },
        {
            id:'too',
            type:'date', // text or hidden
            placeholder:'-to date-',
            list:'',
            classSty:['mx2', 'my1', 'px2']
        },
    ],
    arrBtn: 
    {
        id:'searchBtn',
        marK:'',
        type:'button', // submit or button
        text: 'submit',
        classSty:['mx2', 'px2'],
        js: {
            attr:'',
            value:''
        }
    },
}


