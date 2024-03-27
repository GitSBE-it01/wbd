export const createForm = async() => {
    const cont = document.createElement('div');
    arr.data.forEach(dt=> {
        const div = document.createElement('div');
        const inp = document.createElement('input');
        const classes = arr.style.tdtStyle;
        if(classes) {
            classes.forEach(clas=>{
                div.classList.add(clas);
            });
        }
        const classes2 = arr.style.inpStyle;
        if(classes2) {
            classes2.forEach(clas=>{
                inp.classList.add(clas);
            });
        }
        inp.setAttribute('data-cell', dt.mark.text);
        inp.id = dt.mark.text;
        inp.setAttribute('type', 'text');
        inp.setAttribute('autocomplete', 'off');
        inp.setAttribute('list', dt.param.list);
        inp.disabled = dt.param.disable;
        if (dt.js.attr !=='') {
            inp.setAttribute(dt.js.attr, dt.js.value);
        }
        div.appendChild(inp);
        cont.appendChild(div)
    })
    return cont;
}
