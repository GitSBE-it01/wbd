import { 
    currentDate,
    curDate,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
    removeSpaces
} from "./processing/process.js";

export {
    currentDate,
    curDate,
    jsonToCsv,
    jsonToExcel,
    convertDateFormat,
    getCustomDate,
    activeLink,
    activeLink2,
    removeSpaces
};

import {mainDataProcess} from './data/main.js';
export {mainDataProcess}

import {delete_cache,cache,get_cache} from './processing/cache.js';
export {delete_cache,cache,get_cache}

import {showDelBtn, del_process, del_form_process} from './processing/del_process.js';
export {showDelBtn, del_process, del_form_process}

import {dl_process} from './processing/dl_excel.js';
export {dl_process}

import {insertUpdateProcess} from './processing/insert_update.js';
export {insertUpdateProcess}

import {searchProcess} from './processing/search_process.js';
export {searchProcess}

import {Data} from './class.js';
export const wobb = new Data('wobb');
export const wo = new Data('wo');
export const ld = new Data('ld');
export const loc = new Data('loc');  
export const db_pic = new Data('pic');  
export const dept = new Data('dept');  
export const pickNow = new Data('pickNow');  
export const pt_mstr = new Data('pt_mstr');  
export const pic_part = new Data('pic_part');  