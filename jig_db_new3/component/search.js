
import { loading } from './load.js';

export const search = async (target, inputId, btnId, btnId2, divId) => {
    // loading utk menunggu proses berjalan
    const container = document.getElementById(target);
    container.appendChild(loading('loading1'));
    
    const div = document.createElement('div');
    div.classList.add('fr', 'navCard2', 'sl6');
    div.id = divId;

    // search component
    const searchBar = document.createElement('input');
    searchBar.id = inputId;
    searchBar.classList.add('inpText1');
    searchBar.setAttribute('type', 'text');

    //searchBar.setAttribute('list', 'assets');
    searchBar.setAttribute('placeholder', 'search');
    searchBar.setAttribute('autocomplete', 'off');
    
    const btn = document.createElement('button');
    btn.id = btnId;
    btn.textContent = 'submit';
    btn.setAttribute('type', 'button');
    btn.classList.add('button-27', 'btnS', 'mh4')

    const btn2 = document.createElement('button');
    btn2.id = btnId2;
    btn2.textContent = 'dl excel';
    btn2.setAttribute('type', 'button');
    btn2.classList.add('button-27', 'btnS', 'mh4')

    div.appendChild(searchBar);
    div.appendChild(btn);
    div.appendChild(btn2);
    container.appendChild(div);
    container.removeChild(document.getElementById('loading1'));
}

