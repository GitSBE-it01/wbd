import {createDiv,
        createLabel,
        textInp
} from "../index.js";

export const labelForm = (target, fieldName, text) => {
    createDiv({
        selector: `#${target}`,
        custom: {row: fieldName,},
    })
    createLabel({
        selector: `[data-row ="${fieldName}"]`,
        textCont: text,
        class: 'card_label'
    })
    textInp({
        selector: `[data-row ="${fieldName}"]`,
        custom: {field: fieldName,},
        autocomplete: 'off',
        class: 'card_inp'
    })
}

