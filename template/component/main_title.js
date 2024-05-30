import {removeSpaces} from '../utility/index.js';
export const main_title = async(target, text) =>{
    const trgt = document.querySelector(target);
    const div= document.createElement('div');
    div.setAttribute('class', 'w-screen pb-0 pt-2 pl-8 pr-1 border-t-2 border-b-4 border-teal-500 bg-slate-700');
    div.id = 'main_title__' + removeSpaces(text.toLowerCase(), '_');

    const h1 = document.createElement('h1');
    h1.textContent = text;
    h1.setAttribute('class', 'text-4xl capitalize font-bold italic text-slate-200 float left-0 top-4 border-b-2 mr-[2vw]');
    div.appendChild(h1)
    trgt.appendChild(div);
}


export const searchbar = async(target, text) => {
    const trgt = document.querySelector(target);
    const div= document.createElement('div');
    div.setAttribute('class', 'fixed right-10');
    div.id = 'main_search__' + removeSpaces(text.toLowerCase(), '_');

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'search';
    input.setAttribute('class', 'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    input.id = 'search_input__' + removeSpaces(text, '_');

    const sbmtBtn = document.createElement('button');
    sbmtBtn.textContent = 'search';
    sbmtBtn.type = 'button';
    sbmtBtn.setAttribute('class', 'rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 hover:border-teal-200 hover:text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    sbmtBtn.id = 'search_btn__' + removeSpaces(text, '_');

    const dlBtn = document.createElement('button');
    dlBtn.type = 'button';
    dlBtn.textContent = 'download';
    dlBtn.setAttribute('class', 'rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 hover:border-teal-200 hover:text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    dlBtn.id = 'dl_btn__' + removeSpaces(text, '_');

    div.appendChild(input);
    div.appendChild(sbmtBtn);
    div.appendChild(dlBtn);
    trgt.appendChild(div);    
}

export const filter = async(target, text, arr) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class', 'flex flex-row w-screen py-2 bg-slate-700');
    div.id = 'main_filter__' + removeSpaces(text.toLowerCase(), '_');

    const h1 = document.createElement('h1');
    h1.textContent = text;
    h1.setAttribute('class', 'text-lg mr-4 text-slate-200 float left-0 top-4 ');
    div.appendChild(h1);

    const sel = document.createElement('select');
    sel.id = 'main_filter__'+ removeSpaces(text, '_');
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


