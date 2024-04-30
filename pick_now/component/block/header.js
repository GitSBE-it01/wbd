/*
=================================================================
header text
*/
const defaultTxt = () => ({
    trgt:'',
    id:'',
    text:'text',
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

export const createTxt = async(arr)=> {
    const dflt = defaultTxt();
    const txt = document.createElement('div');
    const trgt = arr.trgt ? arr.trgt : dflt.trgt;
    txt.id = arr.id ? arr.id : dflt.id;
    const data_attr = arr.data_attr.attr ? arr.data_attr.attr : dflt.data_attr.attr;
    const data_val = arr.data_attr.value ? arr.data_attr.value : dflt.data_attr.value;
    const style = arr.style ? arr.style : dflt.style;
    txt.textContent = arr.text ? arr.text : dflt.text;
    const js_attr = arr.js.attr ? arr.js.attr : dflt.js.attr;
    const js_val = arr.js.value ? arr.js.value : dflt.js.value;
    
    style.forEach(cls => {
        txt.classList.add(cls);
    })
    
    if (data_attr !=='') {
        txt.setAttribute(data_attr, data_val);
    }
    if (js_attr !=='') {
        txt.setAttribute(js_attr, js_val);
    }
    if(trgt !=='') {
        const target = document.getElementById(trgt);
        target.appendChild(txt);
        return;
    }
    return txt;
}

