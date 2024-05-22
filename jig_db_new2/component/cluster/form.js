import { create } from "../block.js";


export const formBase = (target, markInp, text) => {
    create({
        element: 'div',
        selector: `#${target}`,
        divInpt: markInp,
        style: `display: flex; flex-direction: row; margin-top: 1em; margin-bottom: .5em; padding-left= 1rem`
    })
    create({
        element: 'label',
        selector: `[data-divInpt ="${markInp}"]`,
        textCont: text,
        style: `flex-child: 1; margin-right: .5em; width: 15%;`
    })
    create({
        element: 'input',
        type: 'text',
        selector: `[data-divInpt ="${markInp}"]`,
        jigInp: markInp,
        autocomplete: 'off',
        style: `flex-child: 1; margin-left: 1em; margin-right: 1em;width: 75%;`,
    })
}

