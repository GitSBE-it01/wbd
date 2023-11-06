import { populateOption } from './process.js';
import { relation } from './class.js';
import { loading } from './load.js';

const search = async (target) => {
    // loading utk menunggu proses berjalan
    const container = document.getElementById(target);
    container.appendChild(loading('loading1'));
    
    const div = document.createElement('div');
    div.id = 'searchID';
    div.classList.add('fc-ctr');

    // search component
    const searchBar = document.createElement('input');
    searchBar.id = 'assetPick';
    searchBar.classList.add('hideOn');
    searchBar.setAttribute('type', 'text');
    searchBar.setAttribute('list', 'assets');
    searchBar.setAttribute('placeholder', 'pilih asset mesin');
    searchBar.setAttribute('autocomplete', 'off');
    
    const btn = document.createElement('button');
    btn.id = 'show';
    btn.textContent = 'submit';
    btn.setAttribute('type', 'button');
    btn.classList.add('hideOn');
    

    try {
        const data = await relation.fetchDataFilter({fromdiv: 'PRODUCTION SPEAKER ASSEMBLY',asset_vjs_kategori: 'IS NOT NULL'});
        populateOption(target,'assets',' -- ', data,'asset_no_combin','assetname', 'asset_vjs_kategori');
    } catch (error) {
        console.log('error : ', error);
    }
    searchBar.classList.remove('hideOn');
    btn.classList.remove('hideOn');

    div.appendChild(searchBar);
    div.appendChild(btn);
    container.appendChild(div);
    container.removeChild(document.getElementById('loading1'));
}

export { search }