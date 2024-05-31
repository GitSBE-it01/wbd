export const button = (target, ID, text, style) =>{
    const tgrt = document.querySelector(target);
    const defBtn = document.createElement('button');
    if(text && text !== '') {
        defBtn.textContent = text;
    }
    defBtn.type = 'button';
    if(style && style !=='') {
        defBtn.setAttribute('class', style);
    } else {
        defBtn.setAttribute('class', 'rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 border-teal-200 text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    }
    defBtn.id = 'btn__' + ID;
    tgrt.appendChild(defBtn);
    return;
}

export const addButton = (ID, style) =>{
    const addBtn = document.createElement('button');
    addBtn.type = 'button';
    addBtn.setAttribute('class', 'plus');
    if(style || style !=='') {
        addBtn.setAttribute('class', `plus ${style}`);
    }
    addBtn.id = 'add_btn__' + ID;
    return addBtn;
}

export const minusButton = (ID, style) =>{
    const minBtn = document.createElement('button');
    minBtn.type = 'button';
    minBtn.setAttribute('class', 'minus');
    if(style || style !=='') {
        minBtn.setAttribute('class', `minus ${style}`);
    }
    minBtn.setAttribute = 'del_btn__' + ID;
    return minBtn;
}