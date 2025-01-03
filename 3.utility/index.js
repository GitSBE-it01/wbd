import {ButtonDOM} from './DOM/button.js';
import {dtlist,
        DtlistDOM} from './DOM/datalist.js';
import {InputDOM} from './DOM/form.js';
import {DOM} from './DOM/full.js';
import {GeneralDOM} from './DOM/general.js';
import {activeLink,
        NavDOM} from './DOM/nav.js';
import {inputEmptyRow,
        TableDOM,
        TableDOM2} from './DOM/table.js';
import {pdf} from './utils/pdf.js';
import {send_email} from './utils/mail.js';
import {sort_array} from './utils/array.js';
import {calculateMean,
        calculateStdDev,
        calculateCP,
        calculateCPK,
        checkRange} from './utils/calculation.js';
import {api_access,
        api_access2
} from './utils/data_access.js';
import {currentDate,
        getCustomDate,
        customPeriod} from './utils/date.js';
import {removeSpaces} from'./utils/string.js';

export {
        ButtonDOM,
        dtlist,
        DtlistDOM,
        InputDOM,
        DOM,
        GeneralDOM,
        activeLink,
        NavDOM,
        inputEmptyRow,
        TableDOM,
        TableDOM2,
        sort_array,
        pdf,
        send_email,
        calculateMean,
        calculateStdDev,
        calculateCP,
        calculateCPK,
        checkRange,
        api_access,
        api_access2,
        currentDate,
        getCustomDate,
        customPeriod,
        removeSpaces,
};

export const globalEvent = (type, selector, callback, parent=document) =>{
        parent.addEventListener(type, e =>{
                if(e.target.matches(selector)) {
                callback(e);
                }
        })
}
    