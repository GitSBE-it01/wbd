export const textInput = (array) =>{
    const trgt = document.querySelector(array.target);
    const input = document.createElement('input');
    input.type = 'text';
    input.autocomplete = 'off';
    //placeholder
    if(array.text && array.text !== '') {
        input.placeholder = array.text;
    } else {
        input.placeholder = 'input';
    }
    //style
    if(array.style && array.style !=='') {
        input.setAttribute('class', array.style);
    } else {
        input.setAttribute('class', 'rounded px-2 text-sm h-[1.6rem] focus:ring focus:ring-teal-300 focus:ring-width-4 focus:outline focus:outline-teal-300')
    }
    //value
    if(array.data && array.data !== '') {
        input.value = array.data;
    } 
    //list
    if(array.dtlist && array.dtlist !== '') {
        input.setAttribute('list',array.dtlist);
    } 
    //disable
    if(array.disable !==undefined) {input.disabled = true}
    input.setAttribute('data-input',`input__${array.ID}`);
    trgt.appendChild(input);
    return;
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

