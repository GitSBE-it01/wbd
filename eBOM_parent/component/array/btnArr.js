export const dlExcel = () => ({
    id:'dlexcl',
    mark:'',
    type:'button', // submit or button
    text:'download excel',
    classSty:['mx1'],
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

