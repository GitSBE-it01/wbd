export const textInput = (target, ID, text, data, style) =>{
    const trgt = document.querySelector(target);
    const input = document.createElement('input');
    input.type = 'text';
    if(text && text !== '') {
        input.placeholder = text;
    } else {
        input.placeholder = 'input';
    }
    if(style && style !=='') {
        input.setAttribute('class', style);
    } else {
        input.setAttribute('class', 'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    }
    if(data && data !== '') {
        input.value = data;
    } 
    input.id = 'input__' + ID;
    trgt.appendChild(input);
    return
}

export const hiddenInput = (target, ID, data) =>{
    const trgt = document.querySelector(target);
    const input = document.createElement('input');
    input.type = 'hidden';
    input.id = 'input__' + ID;
    input.value = data;
    trgt.appendChild(input);
    return;
}