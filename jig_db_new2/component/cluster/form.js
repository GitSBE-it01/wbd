import { create } from "../block.js";

const formJigMstr = ()=> {
    create({
        element: 'div',
        selector: '#main',
        id: 'jigMstr',
        style: `margin-left: 1rem;`
    })
    create({
        element: 'h2',
        selector: '#jigMstr',
        style: `width: 100%;`,
        textCont: 'add new jig'
    })

    const form1 = [
        {text: 'Item Number Jig', mark: 'item_jig'},
        {text: 'Description Jig', mark: 'desc_jig'},
        {text: 'Jig Type', mark: 'jig_type'},
        {text: 'Material', mark: 'mat'},
    ]
    form1.forEach(dt=>{
        create({
            element: 'div',
            selector: '#jigMstr',
            divInpt: dt.mark,
            style: `display: flex; flex-direction: row; margin-top: 1em; margin-bottom: .5em; padding-left= 1rem`
        })
        create({
            element: 'label',
            selector: `[data-divInpt ="${dt.mark}"]`,
            textCont: dt.text,
            style: `flex-child: 1; margin-right: .5em; width: 15%;`
        })
        create({
            element: 'input',
            type: 'text',
            selector: `[data-divInpt ="${dt.mark}"]`,
            jigInp: dt.mark,
            style: `flex-child: 1; margin-left: 1em`
        })
        
    })
}


export const formJigLoc = ()=> {
    create({
        element: 'div',
        selector: '#main',
        id: 'jigMstr',
        style: `margin-left: 1rem;`
    })
    create({
        element: 'h2',
        selector: '#jigMstr',
        style: `width: 100%;`,
        textCont: 'add new jig'
    })

    const form1 = [
        {text: 'Item Number Jig', mark: 'item_jig'},
        {text: 'Description Jig', mark: 'desc_jig'},
        {text: 'Jig Type', mark: 'jig_type'},
        {text: 'Material', mark: 'mat'},
    ]
    form1.forEach(dt=>{
        create({
            element: 'div',
            selector: '#jigMstr',
            divInpt: dt.mark,
            style: `display: flex; flex-direction: row; margin-top: 1em; margin-bottom: .5em; padding-left= 1rem`
        })
        create({
            element: 'label',
            selector: `[data-divInpt ="${dt.mark}"]`,
            textCont: dt.text,
            style: `flex-child: 1; margin-right: .5em; width: 15%;`
        })
        create({
            element: 'input',
            type: 'text',
            selector: `[data-divInpt ="${dt.mark}"]`,
            jigInp: dt.mark,
            style: `flex-child: 1; margin-left: 1em`
        })
        
    })
}