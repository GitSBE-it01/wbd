export const form = (target, ID, text) => {
    const trgt = document.querySelector(target);
    const div = document.createElement('div');
    div.setAttribute('class','px-2 py-3 gap-10 flex flex-row w-full');
    div.setAttribute('data-form',`form__${ID}`);
    const card1 = document.createElement('div');
    card1.setAttribute('class','w-[25%]');
    const label = document.createElement('label');
    label.textContent = text;
    label.setAttribute('for', 'input__' + ID);
    label.setAttribute('class', 'font-semibold');
    card1.appendChild(label);

    const card2 = document.createElement('div');
    card2.setAttribute('class','w-[50%] pr-4');
    const input = document.createElement('input');
    input.type = 'text';
    input.id = 'input__' + ID;
    input.placeholder = 'input value';
    input.setAttribute('class', 'rounded px-4 w-full');
    card2.appendChild(input)
    div.appendChild(card1);
    div.appendChild(card2);
    trgt.appendChild(div);
    return;
}