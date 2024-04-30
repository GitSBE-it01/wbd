/*
====================================================================================
array
====================================================================================
*/
import {dlExcel} from './array/btnArr.js';
import {} from './array/dataArr.js';
import {} from './array/dtListArr.js';
import { } from './array/header.js';
import {} from './array/inpArr.js';
import {arrKat} from './array/layout.js';
import {navigation,sidebarHome} from './array/navArr.js';
import {searchBarMain} from './array/searchArr.js';
import {sec1Tbl} from './array/tblArr.js';

export {
    dlExcel,
    navigation,
    sidebarHome,
    searchBarMain,
    sec1Tbl,
    arrKat
}
   

/*
====================================================================================
block
====================================================================================
*/
import {createBtn} from './block/button.js';
import {createDatalist} from './block/datalist.js';
import {createTxt} from './block/header.js';
import {createInp} from './block/input.js';
import {createDiv} from './block/div.js';
import {create} from './block.js';

export {
    createInp,
    createBtn,
    createDatalist,
    createTxt,
    createDiv,
    create
}

/*
====================================================================================
cluster 
====================================================================================
*/

import {createNav, activeLink, mainNav} from './cluster/nav.js';
import {createSearch} from './cluster/searchBar.js';
import {createTable} from './cluster/table.js';
import {loading} from './cluster/load.js';


export {
    loading, 
    createNav, 
    activeLink, 
    createTable,
    createSearch,
    mainNav
}



/*
====================================================================================
page
====================================================================================
*/
import {section1} from './page/section1.js';

export {section1};
