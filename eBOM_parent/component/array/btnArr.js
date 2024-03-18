export const sbmtSel = (text) => ({
    id:'',
    mark:text,
    type:'button', // submit or button
    text:'',
    classSty:['button_minus_m'],
    js: {
        attr:'',
        value:``
    }
})

export const basicBtn = (text, ...cls) => ({
    id:'',
    mark:text,
    type:'button', // submit or button
    text:'',
    classSty:cls,
    js: {
        attr:'',
        value:``
    }
})

