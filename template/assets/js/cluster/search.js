import {createDiv,
    symbolBtn,
        textInp
} from "../index.js";

export const searchMagni = (target, idInput, idBtn) => {
    createDiv({
        selector: target,
        id: 'search' + idInput,
        class: 'flex-r'
    })
    textInp({                    
        selector: '#search' + idInput,
        id: idInput,
        placeholder: 'search',
        class: 'searchForm'
    })
    symbolBtn({
        selector: '#search' + idInput,
        id: idBtn,
        type: 'button',
        class: 'magnifier',
    })
}