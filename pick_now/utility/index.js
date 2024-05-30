import { 
    delChild, 
    numberToStr, 
    currentDate,
    curDate,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
    removeSpaces
} from "./processing/process.js";

export {
    delChild, 
    numberToStr, 
    currentDate,
    curDate,
    rmvNode,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
    removeSpaces
};

import {
    mainDataProcess
} from './data/main.js';
export {mainDataProcess}


import {
    delete_cache,
    cache,
    get_cache
} from './processing/cache.js';
export {    
    delete_cache,
    cache,
    get_cache
}


import {
    Data
} from './class.js';

export const wobb = new Data('wobb');
export const wo = new Data('wo');
export const ld = new Data('ld');
export const loc = new Data('loc');  
export const db_pic = new Data('pic');  
export const dept = new Data('dept');  
export const pickNow = new Data('pickNow');  
export const pt_mstr = new Data('pt_mstr');  
export const pic_part = new Data('pic_part');  