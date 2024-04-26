import { createBtn, createInp } from '../index.js';
/*
=======================================================================================
create search bar 
*/

export const createSearch = async(arr) => {
    try{
        const container = document.getElementById(arr.target);
        const div = document.createElement('div');
        arr.divStyle.forEach(sty => {
            div.classList.add(sty)
        });
        div.appendChild(await createInp(arr.arrInp));
        for (let i=0; i<arr.arrBtn.length; i++) {
            div.appendChild(await createBtn(arr.arrBtn[i]));
        }
        container.appendChild(div);
    } catch(error){
        console.log(error);
    }}



