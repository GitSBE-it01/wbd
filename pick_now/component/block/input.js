/*
=================================================================
input
*/
const defaultInp = () => ({
    target:'',
    id:'',
    text:'input here',
    data_attr:{
        attr: '',
        value: ''
    },
    type: 'text',
    list: [],
    style: [],
    js: {
        attr:'',
        value:``
    }
})

export const createInp = async(arr) => {
    const dflt = defaultInp();
    const inp = document.createElement('input');
    const trgt = arr.trgt ? arr.trgt : dflt.trgt;
    inp.id = arr.id ? arr.id : dflt.id;
    const textContent = arr.text ? arr.text : dflt.text;
    const data_attr = arr.data_attr.attr ? arr.data_attr.attr : dflt.data_attr.attr;
    const data_val = arr.data_attr.value ? arr.data_attr.value : dflt.data_attr.value;
    const type = arr.type ? arr.type : dflt.type;
    const list = arr.list ? arr.list : dflt.list;
    const style = arr.style ? arr.style : dflt.style;
    const js_attr = arr.js.attr ? arr.js.attr : dflt.js.attr;
    const js_val = arr.js.value ? arr.js.value : dflt.js.value;

    style.forEach(sty => {
        inp.classList.add(sty)
    })
    if (data_attr !=='') {
        inp.setAttribute(data_attr, data_val);
    }
    if (js_attr !=='') {
        inp.setAttribute(js_attr, js_val);
    }
    inp.setAttribute('type',type);
    if (type === 'text'){
        inp.setAttribute('placeholder', textContent)
        inp.setAttribute('list', list);
        inp.setAttribute('autocomplete', "off");
    }

    if(trgt !=='') {
        const target = document.getElementById(trgt);
        target.appendChild(inp);
        return;
    }
    return inp;
}

