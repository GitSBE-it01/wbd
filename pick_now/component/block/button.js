/*
=================================================================
button
*/
const defaultBtn = () => ({
    trgt: '',
    id:'',
    text:'submit',
    data_attr:{
        attr: '',
        value: ''
    },
    type:'button', // submit or button
    style:[],
    js: {
        attr:'',
        value:``
    }
})

export const createBtn = async(arr) => {
    const dflt = defaultBtn();
    const btn = document.createElement('button');
    const trgt = arr.trgt ? arr.trgt : dflt.trgt;
    btn.id = arr.id ? arr.id : dflt.id;
    btn.textContent = arr.text ? arr.text : dflt.text;
    const data_attr = arr.data_attr.attr ? arr.data_attr.attr : dflt.data_attr.attr;
    const data_val = arr.data_attr.value ? arr.data_attr.value : dflt.data_attr.value;
    const type = arr.type ? arr.type : dflt.type;
    const style = arr.style ? arr.style : dflt.style;
    const js_attr = arr.js.attr ? arr.js.attr : dflt.js.attr;
    const js_val = arr.js.value ? arr.js.value : dflt.js.value;

    btn.setAttribute('type',type);
    style.forEach(sty => {
        btn.classList.add(sty)
    })
    if (data_attr !=='') {
        btn.setAttribute(data_attr, data_val);
    }
    if (js_attr !=='') {
        btn.setAttribute(js_attr, js_val);
    }
    if(trgt !=='') {
        const target = document.getElementById(arr.target);
        target.appendChild(btn);
        return;
    }
    return btn;
}