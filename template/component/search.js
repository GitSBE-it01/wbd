export const search = async (target, inputId, btnId, divId, titleText, datalist, hdCl, dtCl) => {
    try {
        // loading utk menunggu proses berjalan
        const container = document.getElementById(target);
        //container.appendChild(loading('loading1', 'loading'));
        
        const div = document.createElement('div');
        div.classList.add('hide', 'navCard3', hdCl);
        div.id = divId;

        const title2 = document.createElement('div');
        title2.textContent = titleText;
        title2.classList.add('fc-w', 'cap', 'fs-l', 'pl3', 'pv3', dtCl);

        // search component
        const div2 = document.createElement('div');
        div2.classList.add('fr');
        const searchBar = document.createElement('input');
        searchBar.id = inputId;
        searchBar.classList.add('inpText1');
        searchBar.setAttribute('type', 'text');
        searchBar.setAttribute('list', datalist);
        searchBar.setAttribute('placeholder', 'search');
        searchBar.setAttribute('autocomplete', 'off');
        
        const btn = document.createElement('button');
        btn.id = btnId;
        btn.textContent = 'submit';
        btn.setAttribute('type', 'button');
        btn.classList.add('button-27', 'btnS', 'mh4')

        div.appendChild(title2);
        div2.appendChild(searchBar);
        div2.appendChild(btn);
        div.appendChild(div2);
        container.appendChild(div);
        // container.removeChild(document.getElementById('loading1'));
    } catch(error) {
        console.log(error)
    }
}

