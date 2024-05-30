export const button = (ID, text, style) =>{
    const sbmtBtn = document.createElement('button');
    if(text && text !== '') {
        sbmtBtn.textContent = text;
    }
    sbmtBtn.type = 'button';
    if(style && style !=='') {
        sbmtBtn.setAttribute('class', style);
    } else {
        sbmtBtn.setAttribute('class', 'rounded bg-slate-100 px-4 py-1 text-sm ml-2 hover:border-b-4 hover:border-r-4 hover:border-teal-200 hover:text-slate-800  hover:font-bold hover:pt-[.2rem] hover:pb-0 duration-200');
    }
    sbmtBtn.id = 'btn__' + ID;
}

export const addButton = (ID, style) =>{
    const addBtn = document.createElement('button');
    addBtn.type = 'button';
    addBtn.setAttribute('class', 'plus');
    if(style && style !=='') {
        addBtn.classList.add(style);
    }
    addBtn.id = 'add_btn__' + ID;
}