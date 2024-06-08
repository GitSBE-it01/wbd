export const header = (style) =>{
    const target = document.querySelector('body');
    const hd = document.createElement('header');
    hd.setAttribute('class',style)
    target.appendChild(hd);
    return;
}

export const main = (style) =>{
    const target = document.querySelector('body');
    const main = document.createElement('main');
    main.setAttribute('class',style)
    target.appendChild(main);
    return;
}

export const section = (secID, style) =>{
    const target = document.querySelector('body');
    const sect = document.createElement('section');
    sect.id = secID;
    sect.setAttribute('class',style)
    target.appendChild(sect);
    return;
}

export const aside = (style) =>{
    const target = document.querySelector('body');
    const side = document.createElement('aside');
    side.setAttribute('class',style)
    target.appendChild(side);
    return;
}

export const div = (secID, target, style) =>{
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.id = secID;
    div.setAttribute('class',style)
    trgt.appendChild(div);
    return;
}