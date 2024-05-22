export const createInp = (arr) => {
    const element = document.createElement('input');
    let target  = '';
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.class && arr.class !== '') {element.setAttribute('class', arr.class)}
    if(arr.type && arr.type !== '') {element.setAttribute('type', arr.type)}
    if(arr.placeholder && arr.placeholder !== '') {element.setAttribute('placeholder', arr.placeholder)}
    if(arr.value && arr.value !== '') {element.setAttribute('value', arr.value)}
    if(arr.disabled && arr.disabled !== '') {element.setAttribute('disabled', arr.disabled)}
    if(arr.list && arr.list !== '') {element.setAttribute('list', arr.list)}
    if(arr.required && arr.required !== '') {element.setAttribute('required', arr.required);}

    //js
    if(arr.onclick && arr.onclick !== '') {element.setAttribute('onclick', arr.onclick)}
    if(arr.onchange && arr.onchange !== '') {element.setAttribute('onchange', arr.onchange)}
    if(arr.onmouseover && arr.onmouseover !== '') {element.setAttribute('onmouseover', arr.onmouseover)}
    if(arr.onmouseout && arr.onmouseout !== '') {element.setAttribute('onmouseout', arr.onmouseout)}
    if(arr.onmouseenter && arr.onmouseenter !== '') {element.setAttribute('onmouseenter', arr.onmouseenter)}
    if(arr.onmouseleave && arr.onmouseleave !== '') {element.setAttribute('onmouseleave', arr.onmouseleave)}
    if(arr.onkeydown && arr.onkeydown !== '') {element.setAttribute('onkeydown', arr.onkeydown)}
    if(arr.onkeyup && arr.onkeyup !== '') {element.setAttribute('onkeyup', arr.onkeyup)}
    if(arr.onsubmit && arr.onsubmit !== '') {element.setAttribute('onsubmit', arr.onsubmit)}
    if(arr.onfocus && arr.onfocus !== '') {element.setAttribute('onfocus', arr.onfocus)}
    if(arr.onblur && arr.onblur !== '') {element.setAttribute('onblur', arr.onblur)}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }

    if(arr.style && arr.style !=='') {element.setAttribute('style', arr.style)}
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr[dt]);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}

export const hiddenInp = (arr) => {
    const element = document.createElement('input');
    let target  = '';
    element.setAttribute('type', 'hidden');
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.value && arr.value !== '') {element.setAttribute('value', arr.value)}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }

    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr[dt]);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}

export const textInp = (arr) => {
    const element = document.createElement('input');
    let target  = '';
    element.setAttribute('type', 'text');
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.class && arr.class !== '') {element.setAttribute('class', arr.class)}
    if(arr.placeholder && arr.placeholder !== '') {element.setAttribute('placeholder', arr.placeholder)}
    if(arr.value && arr.value !== '') {element.setAttribute('value', arr.value)}
    if(arr.disabled && arr.disabled !== '') {element.setAttribute('disabled', arr.disabled)}
    if(arr.list && arr.list !== '') {element.setAttribute('list', arr.list)}
    if(arr.required && arr.required !== '') {element.setAttribute('required', arr.required);}
    if(arr.custom && arr.custom !== '') {
        const attr = Object.keys(arr.custom);
        attr.forEach(dt=>{
            element.setAttribute('data-'+dt, arr.custom.dt);
        })
    }
    
    //js
    if(arr.onclick && arr.onclick !== '') {element.setAttribute('onclick', arr.onclick)}
    if(arr.onchange && arr.onchange !== '') {element.setAttribute('onchange', arr.onchange)}
    if(arr.onkeydown && arr.onkeydown !== '') {element.setAttribute('onkeydown', arr.onkeydown)}
    if(arr.onkeyup && arr.onkeyup !== '') {element.setAttribute('onkeyup', arr.onkeyup)}
    if(arr.onfocus && arr.onfocus !== '') {element.setAttribute('onfocus', arr.onfocus)}
    if(arr.onblur && arr.onblur !== '') {element.setAttribute('onblur', arr.onblur)}

    if(arr.style && arr.style !=='') {element.setAttribute('style', arr.style)}
    if(arr.selector && arr.selector !== '') {target = document.querySelector(arr[dt]);}
    if(target !== '') {
        return target.appendChild(element);
    }
    return element;
}