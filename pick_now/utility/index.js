import { 
    delChild, 
    strToNumber, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate
} from "./process.js";

export {
    delChild, 
    strToNumber, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate
};


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