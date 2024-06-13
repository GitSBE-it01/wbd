import {removeSpaces} from '../../3.utility/index.js';

export const searchbar = async(target, ID, pos, dtlist) => {
    const trgt = document.querySelector(target);
    const div= document.createElement('div');
    div.setAttribute('class', 'flex flex-row mx-2 mt-3 fixed items-center');
    div.classList.add(pos);

    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'search';
    input.setAttribute('list', dtlist)
    input.setAttribute('class', 'rounded px-4 w-[15vw] text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    input.id = 'search_input__' + removeSpaces(ID, '_');

    const sbmtBtn = document.createElement('button');
    sbmtBtn.textContent = 'search';
    sbmtBtn.type = 'button';
    sbmtBtn.setAttribute('class', 'rounded bg-slate-100 px-4 h-[1.6rem] py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 hover:border-teal-200 hover:text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    sbmtBtn.id = 'search_btn__' + removeSpaces(ID, '_');

    const dlBtn = document.createElement('button');
    dlBtn.type = 'button';
    dlBtn.textContent = 'download';
    dlBtn.setAttribute('class', 'rounded bg-slate-100 px-4 py-1  h-[1.6rem] text-sm ml-2 hover:border-b-4 hover:border-r-4 hover:border-teal-200 hover:text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    dlBtn.id = 'dl_btn__' + removeSpaces(ID, '_');

    div.appendChild(input);
    div.appendChild(sbmtBtn);
    div.appendChild(dlBtn);
    trgt.appendChild(div);    
}