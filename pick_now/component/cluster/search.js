import {create} from '../index.js';

export const smallSearchBar = (target, idInput, idBtn) => {
    create({
        element: 'div',
        selector: target,
        id: 'search' + idInput,
        class: 'flex-r'
    })
    create({                    
        element: 'input',
        selector: '#search' + idInput,
        id: idInput,
        placeholder: 'search',
        style: `
            padding: 0 0 0 1em;
            margin: 1em 0 0 1em;
            border-radius: 10%;
            height: 40px;
            width: 150px
        `,
        class: 'inputMagni'
    })
    create({
        element: 'button',
        selector: '#search' + idInput,
        id: idBtn,
        type: 'button',
        style: `
            background-image: url('../../../assets/svg_file/magni/magnifier-svgrepo-com.svg');
            background-size: cover;
            background-color: black;
            z-index: 1;
            border: none;
            cursor: pointer;
            border-radius: 50%;
            margin-top: 1em;
        `,
        textCont: 'testing'
    })
}