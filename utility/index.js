import { inpDMCProcess } from "./data/dmc.js";
import { initVJS } from "./data/vjs.js";
import { 
    delChild, 
    strToNumber, 
    currentDate ,
    rmvNode
} from "./process.js";

export {
    inpDMCProcess, 
    delChild, 
    strToNumber, 
    currentDate,
    initVJS,
    rmvNode,
};

import {loading, createNav, activeLink, columnSprt} from './component/mod_comp/';
import {createTable} from './component/mod_comp/table.js';
import {createSearch} from './component/mod_comp/searchBar.js';
import {createForm} from './component/mod_comp/form.js';

// html component folder
import {createInp} from './component/basic_comp/input.js';
import {createBtn} from './component/basic_comp/button.js';
import {createDatalist} from './component/basic_comp/datalist.js';
import {createHeader, createHeader2} from './component/basic_comp/header.js';

export {
    loading, 
    createNav, 
    activeLink, 
    columnSprt,
    createTable,
    createSearch,
    createForm,
    createInp,
    createBtn,
    createDatalist,
    createHeader,
    createHeader2
}
    

