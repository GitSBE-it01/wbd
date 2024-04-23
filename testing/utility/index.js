/*
====================================================================================
utk export dari process. js
====================================================================================
*/
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


/*
====================================================================================
utk export dari folder data
====================================================================================
*/
import {
    MyUploadAdapter
} from './data/imageHandling.js';

export {
    MyUploadAdapter
}

/*
====================================================================================
utk export class
====================================================================================
*/
import {
    Data
} from './class.js';

export const text = new Data('text');
