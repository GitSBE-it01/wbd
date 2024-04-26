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
import {mainTbl} from './array/tblArr.js';

export {
    dlExcel,
    navigation,
    sidebarHome,
    searchBarMain,
    mainTbl,
    arrKat
}
   

/*
====================================================================================
block
====================================================================================
*/
import {createBtn} from './block/button.js';
import {createDatalist} from './block/datalist.js';
import {createHeader, createHeader2} from './block/header.js';
import {createInp} from './block/input.js';
import {columnSprt} from './block/layout.js';
import {loading} from './block/load.js';

export {
    createInp,
    createBtn,
    createDatalist,
    createHeader,
    createHeader2,
    columnSprt,
    loading
}

/*
====================================================================================
cluster 
====================================================================================
*/

import {createNav, activeLink} from './cluster/nav.js';
import {createSearch} from './cluster/searchBar.js';
import {createTable} from './cluster/table.js';

export {
    loading, 
    createNav, 
    activeLink, 
    columnSprt,
    createTable,
    createSearch
}



/*
====================================================================================
page
====================================================================================
*/
import {section1} from './page/section1.js';

export {section1};
