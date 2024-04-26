/*-------------------------
layout kolom 
-------------------------*/
export const columnSprt = (arr) => {
    const container = document.getElementById(arr.target);
    const create = document.createElement('div');
    create.classList.add('flex-r');
    create.id = arr.id;
    arr.col.forEach(cl => {
        const div = document.createElement('div');
        div.id = cl.id;
        cl.style.forEach(st => {
            div.classList.add(st);
        })
        create.appendChild(div);
    })
    container.appendChild(create);
    return;
}