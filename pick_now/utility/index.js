import { 
    delChild, 
    strToNumber, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat
} from "./process.js";

export {
    delChild, 
    strToNumber, 
    currentDate ,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat
};


import {dataSection1} from './data/section1.js';
export {dataSection1};


import {
    Data
} from './class.js';

export const wobb = new Data('wobb');
export const wo = new Data('wo');
export const ld = new Data('ld');
export const loc = new Data('loc');  
export const dept = new Data('dept');  
export const pickNow = new Data('pickNow');  