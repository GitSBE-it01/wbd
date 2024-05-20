const hover = (slf, styles) => {
    let val = slf.getAttribute('style');
    if(!val.includes(styles)) {
       val = val + styles;
       slf.setAttribute('style',val);
    }
}

const hoverOut = (slf, styles) => {
    let val = slf.getAttribute('style');
    if(val.includes(styles)) {
       val = val.replace(new RegExp(styles, 'g'), '')
       slf.setAttribute('style',val);
    }
}