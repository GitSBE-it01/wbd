import { 
    numberToStr, 
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
    numberToStr, 
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

import {showDelBtn, del_process} from './processing/del_process.js';
export {showDelBtn, del_process}

import {dl_process} from './processing/dl_excel.js';
export {dl_process}

import {insertUpdateProcess} from './processing/insert_update.js';
export {insertUpdateProcess}

import {searchProcess} from './processing/search_process.js';
export {searchProcess}

import {Data} from './class.js';
export const master = new Data('master');
export const point = new Data('point');
export const vjs_detail = new Data('vjs_detail');
export const vjs_month = new Data('vjs_month');