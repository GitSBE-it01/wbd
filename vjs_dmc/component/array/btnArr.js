export const btnDmcEdit = {
    id:'dmcEdit',
    type:'button', // submit or button
    text:'edit',
    classSty:['mx4'],
    js: {
        attr:'onclick',
        value:'disabledBtn()'
    }
}

export const btnDmcSbmt ={
    id:'dmcInput',
    type:'button', // submit or button
    text:'submit',
    classSty:['mx4'],
    js: {
        attr:'',
        value:''
    }
}

export const dmcOk = {
    id:'dmcDiv',
    type:'button', // submit or button
    text:'',
    classSty:['check'],
    js: {
        attr:'onclick',
        value:'opClHide()'
    }
}

export const dmcNg = 
    {
        id:'dmcDiv',
        type:'button', // submit or button
        text:'',
        classSty:['cross'],
        js: {
            attr:'onclick',
            value:'opClHide()'
        }
    }
