export const createLabel = (arr) =>{
    const element = document.createElement('datalist');
    if(arr.for && arr.for !== '') {element.setAttribute('for', arr.for);}
    if(arr.accesskey && arr.accesskey !== '') {element.setAttribute('accesskey', arr.accesskey);}
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.title && arr.title !== '') {element.setAttribute('title', arr.title);}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }
    let target  = '';
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr[dt]);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}