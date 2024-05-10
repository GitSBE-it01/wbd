/*
Standard HTML Attributes:
id
class
title
href (for anchor tags)
src (for image tags)
alt (for image tags)
disabled (for form elements)
checked (for checkboxes and radio buttons)
value (for form elements)
type (for input elements)

Event Attributes:
onclick
onchange
onmouseover
onmouseout
onkeydown
onkeyup
onsubmit
onfocus
onblur

Custom Data Attributes (data-*):
data-attributeName (e.g., data-id, data-value)

Form Attributes:
action
method
enctype

Style Attributes:
style (allows you to set inline CSS styles)

Others:
aria-* attributes for accessibility (e.g., aria-label, aria-describedby)
title (tooltip text)
contenteditable (for making elements editable)
draggable (for making elements draggable)
*/

const defaultAll ={
    element: '',
    selector: '',
    selectorAll: '',
    id: '', //
    class: '', //
    title: '', //
    href: '', // (for anchor tags)
    src: '', // (for image tags)
    alt: '', // (for image tags)
    disabled: '', // (for form elements)
    checked: '', // (for checkboxes and radio buttons)
    value: '', // (for form elements)
    type: '', // (for input elements)
    onclick: '',
    onchange: '',
    onmouseover: '',
    onmouseenter: '',
    onmouseleave: '',
    onmouseout: '',
    onkeydown: '',
    onkeyup: '',
    onsubmit: '',
    onfocus: '',
    onblur: '',
    action: '',  // form
    method: '',  // form
    enctype: '',  // form
    textCont:'', // main attribute 
}


export const create = (arr) => {
    const key = Object.keys(defaultAll);
    const attr = Object.keys(arr);
    const el = document.createElement(arr.element);
    let target  = '';

    attr.forEach(dt=> {
        if (dt === 'selector') {
            target = document.querySelector(arr[dt]);
        }
        if (dt === 'selectorAll') {
            target = document.querySelectorAll(arr[dt]);
        }
        if (dt === 'textCont') {
            el.textContent = arr[dt];
        }
        if(key.includes(dt) && dt !== 'element' && dt !== 'selector' && dt !== 'selectorAll' && dt !== 'textCont') {
                el.setAttribute(dt, arr[dt]);
        } 
        if(!key.includes(dt)) {
            el.setAttribute('data-'+dt, arr[dt]);
        }
    })

    if(target !== '') {
        return target.appendChild(el);
    }
    return el;
}