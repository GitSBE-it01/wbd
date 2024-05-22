export const createBtn = (arr) => {
    const element = document.createElement('button');
    let target  = '';
    if(arr.type && arr.type !== '') {element.setAttribute('type', arr.type)}
    if(arr.disabled && arr.disabled !== '') {element.setAttribute('disabled', arr.disabled)}

    //js
    if(arr.onclick && arr.onclick !== '') {element.setAttribute('onclick', arr.onclick)}
    if(arr.onmouseover && arr.onmouseover !== '') {element.setAttribute('onmouseover', arr.onmouseover)}
    if(arr.onmouseout && arr.onmouseout !== '') {element.setAttribute('onmouseout', arr.onmouseout)}
    if(arr.onmouseenter && arr.onmouseenter !== '') {element.setAttribute('onmouseenter', arr.onmouseenter)}
    if(arr.onmouseleave && arr.onmouseleave !== '') {element.setAttribute('onmouseleave', arr.onmouseleave)}
    if(arr.onkeydown && arr.onkeydown !== '') {element.setAttribute('onkeydown', arr.onkeydown)}
    if(arr.onkeyup && arr.onkeyup !== '') {element.setAttribute('onkeyup', arr.onkeyup)}
    if(arr.onsubmit && arr.onsubmit !== '') {element.setAttribute('onsubmit', arr.onsubmit)}
    if(arr.onfocus && arr.onfocus !== '') {element.setAttribute('onfocus', arr.onfocus)}
    if(arr.onblur && arr.onblur !== '') {element.setAttribute('onblur', arr.onblur)}

    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.class && arr.class !== '') {element.setAttribute('class', arr.class)}
    if(arr.style && arr.style !=='') {element.setAttribute('style', arr.style)}
    if(arr.textCont && arr.textCont !=='') {element.textContent = arr.textCont;}
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

export const submitBtn = (arr) => {
    const element = document.createElement('button');

    element.setAttribute('type', 'button')
    element.textContent = 'submit';
    if(arr.disabled && arr.disabled !== '') {element.setAttribute('disabled', arr.disabled)}

    if(arr.onclick && arr.onclick !== '') {element.setAttribute('onclick', arr.onclick)}
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}
    if(arr.class && arr.class !== '') {
        element.setAttribute('class', arr.class)
    } else {element.setAttribute('class', 'defaultBtn')}
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

export const symbolBtn = (arr) => {
    const element = document.createElement('button');
    element.setAttribute('type', 'button')
    if(arr.onclick && arr.onclick !== '') {element.setAttribute('onclick', arr.onclick)}
    if(arr.id && arr.id !== '') {element.setAttribute('id', arr.id);}

    if(arr.class && arr.class !== '') {
        element.setAttribute('class', arr.class)
    } else {element.setAttribute('class', 'defaultSymbol')}

    if(arr.textCont && arr.textCont !== '') {
        element.textContent = arr.textCont;
    } else {element.textContent = 'text'}
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

