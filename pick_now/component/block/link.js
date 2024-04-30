/*
=================================================================
Link
*/
const defaultLink = () => ({
    trgt:'',
    id:'',
    text: '', //if btn then empty
    link: '#',
    data_attr:{
        attr: '',
        value: ''
    },
    style: [],
    js: {
        attr:'',
        value:``
    }
})

export const createLink = async(arr) => {
    const dflt = defaultLink();
    const aLink = document.createElement('a');
    const trgt = arr.trgt ? arr.trgt : dflt.trgt;
    aLink.id = arr.id ? arr.id : dflt.id;
    const textCont = arr.text ? arr.text : dflt.text;
    aLink.textContent = textCont;
    const link = arr.link ? arr.link : dflt.link;
    aLink.setAttribute('href', link);
    const data_attr = arr.data_attr.attr ? arr.data_attr.attr : dflt.data_attr.attr;
    const data_val = arr.data_attr.value ? arr.data_attr.value : dflt.data_attr.value;
    const style = arr.style ? arr.style : dflt.style;
    const js_attr = arr.js.attr ? arr.js.attr : dflt.js.attr;
    const js_val = arr.js.value ? arr.js.value : dflt.js.value;

    style.forEach(sty => {
        aLink.classList.add(sty)
    })
    
    if (data_attr !=='') {
        aLink.setAttribute(data_attr, data_val);
    }
    if (js_attr !=='') {
        aLink.setAttribute(js_attr, js_val);
    }

    if(trgt !=='') {
        const target = document.getElementById(trgt);
        target.appendChild(aLink);
        return;
    }
    return aLink;
}

