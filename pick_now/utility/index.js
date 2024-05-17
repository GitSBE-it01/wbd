import { 
    delChild, 
    numberToStr, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink
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
    activeLink
};


import {
    mainDataProcess
} from './data/main.js';
export {mainDataProcess}



import {
    Data
} from './class.js';
export const wobb = new Data('wobb');
export const wo = new Data('wo');
export const ld = new Data('ld');
export const loc = new Data('loc');  
export const dept = new Data('dept');  
export const pickNow = new Data('pickNow');  
export const pt_mstr = new Data('pt_mstr');  
export const pic_part = new Data('pic_part');  