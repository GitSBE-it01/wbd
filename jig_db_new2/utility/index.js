import { 
    delChild, 
    numberToStr, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
} from "./process.js";

export {
    delChild, 
    numberToStr, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
};


import {
    mainDataProcess
} from './data/main.js';
export {mainDataProcess}



import {
    Data
} from './class.js';

export const jig_master = new Data('jig_master');
export const log_master = new Data('log_master');
export const jig_function = new Data('jig_function');
export const log_function = new Data('log_function');
export const list_location = new Data('list_location');