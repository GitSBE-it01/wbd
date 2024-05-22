import {createDiv,
        createLink,
        searchMagnifier
} from "../../index.js";

export const navbar = async(target, navID, arr) => {
    await createDiv({
        selector: `#${target}`,
        id: navID,
        class: 'navbar'
    })                                                                                   
    await createDiv({
        selector: `#${navID}`,
        custom: {navID: 'long_nav',},
        class: 'long_nav'
    })
    await createDiv({
        selector: `#${navID}`,
        custom: {navID: 'short_nav',},
        class: 'short_nav'
    })
    arr.forEach(dt=>{
        createDiv({
            selector: `[data-navID = "long_nav"]`,
            custom: {link: dt.text,},
            class: 'divLink',
        })
        createLink({
            selector: `[data-link ="${dt.text}"]`,
            href: dt.link,
            class: 'link',
            textCont: dt.text
        })
    })
    await searchMagnifier('[data-navID ="short_nav"]', 'mainNav');
}


