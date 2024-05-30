import {removeSpaces} from '../../utility/index.js';

export const selectionRow = async(target, text, arr) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'flex flex-row px-3 pt-2');

    const h1 = document.createElement('h1');
    h1.textContent = text;
    h1.setAttribute('class', 'text-lg font-semibold mr-4 text-slate-200 float left-0 top-4 ');
    div.appendChild(h1);

    const sel = document.createElement('select');
    sel.id = 'filter__'+ removeSpaces(text.toLowerCase(), '_');
    sel.setAttribute('class', 'rounded px-2 w-40 text-sm h-[1.6rem] focus:ring ml-4 focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    arr.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt.val;
        option.textContent= dt.text;
        sel.appendChild(option);
    })
    div.appendChild(sel);
    trgt.appendChild(div);

}

export const selectionCol = async(target, text, arr) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'flex flex-col px-3 mr-4');

    const h1 = document.createElement('h1');
    h1.textContent = text;
    h1.setAttribute('class', 'text-lg font-semibold mr-4 text-slate-200 pl-4');
    div.appendChild(h1);

    const sel = document.createElement('select');
    sel.id = 'filter__'+ removeSpaces(text.toLowerCase(), '_');
    sel.setAttribute('class', 'rounded item-left w-60 text-sm h-[1.6rem] focus:ring ml-4 focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    arr.forEach(dt=>{
        const option = document.createElement('option');
        option.value = dt.val;
        option.textContent= dt.text;
        sel.appendChild(option);
    })
    div.appendChild(sel);
    trgt.appendChild(div);

}


