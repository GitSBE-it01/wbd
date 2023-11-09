import { search } from './search.js';

export const updateStock = () => {
    const divStock = document.createElement('div');
    divStock.id = 'divStock';
    const title2 = document.createElement('div');
    title2.textContent = 'item jig';
    divStock.appendChild(title2);
    search('divStock', 'searchJig', 'btnJig', 'stockSearch');
    

}

