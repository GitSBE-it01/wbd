export const createSel = (arr) =>{
    const element = document.createElement('select');
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.disabled && arr.disabled !== '') {element.setAttribute('disabled', arr.disabled);}
    if(arr.size && arr.size !== '') {element.setAttribute('size', arr.size);}
    if(arr.multiple && arr.multiple !== '') {element.setAttribute('multiple', arr.multiple);}
    if(arr.name && arr.name !== '') {element.setAttribute('name', arr.name);}
    if(arr.required && arr.required !== '') {element.setAttribute('required', arr.required);}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }
    let target  = '';
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr.selector);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}

export const createOpt = (arr) =>{
    const element = document.createElement('option');
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.value && arr.value !== '') {element.setAttribute('value', arr.value);}
    if(arr.textCont && arr.textCont !== '') {
        element.textContent = arr.textCont;
    } else {element.textContent = arr.value ? arr.value : "";}
    let target  = '';
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr.selector);}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}

export const createDtlist = (arr) =>{
    const element = document.createElement('datalist');
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }
    let target  = '';
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr.selector);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}