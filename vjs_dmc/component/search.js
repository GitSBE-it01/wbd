import { loading, createBtn, createInp } from './index.js';

/*
=======================================================================================
create search bar 
*/
const arrSearch = {
    target:'target',
    divStyle:'',
    inpId:'',
    inpType:'',
    inpClass:[],
    btnId:'',
    btnType:'',
    btnClass:[]
}

export const createSearch = async(arr) => {
    const container = document.getElementyById(arr.target);
    const div = document.createElement('div');
    arr.divStyle.forEach(sty => {
        div.classList.add(sty)
    });
    const input = document.createElement('input');
    inpStyle.forEach(sty => {
        input.classList.add(sty)
    });
    const btn = document.createElement('button');
    btnStyle.forEach(sty => {
        btn.classList.add(sty)
    });
    div.appendChild(input)
}






export const search = async (target) => {
    // loading utk menunggu proses berjalan
    const container = document.getElementById(target);
    container.appendChild(loading('loading1'));

    // search component
    const div = document.createElement('div');
    div.classList.add('fr', 'navCard2', 'tl7', 'fc-ctr');
    div.id = 'searchID';

    // search component
    const searchBar = document.createElement('input');
    searchBar.id = 'assetPick';
    searchBar.classList.add('inpText2');
    searchBar.setAttribute('type', 'text');
    searchBar.setAttribute('list', 'assets');
    searchBar.setAttribute('placeholder', 'search');
    searchBar.setAttribute('autocomplete', 'off');
    
    const btn = document.createElement('button');
    btn.id = 'show';
    btn.setAttribute('type', 'button');
    btn.classList.add('search_icon');
    
    try {
        const data = await relation.fetchDataFilter({fromdiv: 'PRODUCTION SPEAKER ASSEMBLY',asset_vjs_kategori: 'IS NOT NULL'});
        populateOption("root",'assets',' -- ', data,'asset_no_combin','assetname', 'asset_vjs_kategori');
    } catch (error) {
        console.log('error : ', error);
    }
    searchBar.classList.remove('hideOn');
    btn.classList.remove('hideOn');

    div.appendChild(btn);
    div.appendChild(searchBar);
    container.appendChild(div);
    container.removeChild(document.getElementById('loading1'));
    enterProses('assetPick', 'show');
}

const enterProses = (target,btnID) => {
    const inputTarget = document.getElementById(target);
    inputTarget.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            const searchBtnSpk = document.getElementById(btnID);
            searchBtnSpk.click()
        }
    })
}
