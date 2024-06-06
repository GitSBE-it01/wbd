export const text = (array) =>{
    const trgt = document.querySelector(array.target);
    const text = document.createElement('div');
    if(array.style && array.style !=='') {
        text.setAttribute('class', array.style);
    } else {
        text.setAttribute('class', 'p-2')
    }
    if(array.text && array.text !== '') {
        text.textContent = array.text;
    } else {
        text.textContent = 'text here';
    }
    text.setAttribute('data-text', `text__${array.ID}`);
    trgt.appendChild(text);
    return;
}