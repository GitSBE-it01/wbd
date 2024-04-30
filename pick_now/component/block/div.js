/*
=================================================================
input
*/
const defaultDiv = () => ({
    trgt:'',
    id:'',
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

export const createDiv = async(arr) => {
    const dflt = defaultDiv();
    const div = document.createElement('div');
    const trgt = arr.trgt ? arr.trgt : dflt.trgt;
    div.id = arr.id ? arr.id : dflt.id;
    const data_attr = arr.data_attr.attr ? arr.data_attr.attr : dflt.data_attr.attr;
    const data_val = arr.data_attr.value ? arr.data_attr.value : dflt.data_attr.value;
    const style = arr.style ? arr.style : dflt.style;
    const js_attr = arr.js.attr ? arr.js.attr : dflt.js.attr;
    const js_val = arr.js.value ? arr.js.value : dflt.js.value;

    style.forEach(sty => {
        div.classList.add(sty)
    })
    if (data_attr !=='') {
        div.setAttribute(data_attr, data_val);
    }
    if (js_attr !=='') {
        div.setAttribute(js_attr, js_val);
    }

    if(trgt !=='') {
        const target = document.getElementById(trgt);
        target.appendChild(div);
        return;
    }
    return div;
}

