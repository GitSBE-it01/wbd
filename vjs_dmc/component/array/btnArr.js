export const btnDmcEdit = {
    id:'',
    mark:'dmcEdit',
    type:'button', // submit or button
    text:'edit',
    classSty:['mx4'],
    js: {
        attr:'onclick',
        value:`disabledBtn('[data-btn*= "dmcEdit"]', '[data-btn*="dmcInput"]')`
    }
}

export const btnDmcSbmt ={
    id:'dmcInput',
    mark:'dmcInput',
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
    mark:'',
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
        mark:'',
        type:'button', // submit or button
        text:'',
        classSty:['cross'],
        js: {
            attr:'onclick',
            value:'opClHide()'
        }
    }

export const btnVjsEdit = (counter) => ({
    id:``,
    mark:`vjsEdit--${counter}`,
    type:'button', // submit or button
    text:'edit',
    classSty:['mx4'],
    js: {
        attr:'onclick',
        value:`disabledBtn('[data-btn="vjsEdit--${counter}"]', '[data-btn="vjsInput--${counter}"]')`
    }
})

export const btnVjsSbmt =(counter) => ({
    id:'',
    mark:`vjsInput--${counter}`,
    type:'button', // submit or button
    text:'submit',
    classSty:['mx4'],
    js: {
        attr:'',
        value:``
    }
})
    
export const minVJS = (counter) => ({
    id:'',
    mark:`minVJS--${counter}`,
    type:'button', // submit or button
    text:'',
    classSty:['button_minus'],
    js: {
        attr:'onclick',
        value:`deleteChild("mainVJS${counter}", "hdVJS${counter}")`
    }
})
    
export const addVJS =() => ({
    id:'',
    mark:`addVJS`,
    type:'button', // submit or button
    text:'',
    classSty:['button_plus'],
    js: {
        attr:'',
        value:''
    }
})

export const openVJS = (counter) => ({
    id:'',
    mark:`openVJS--${counter}`,
    type:'button', // submit or button
    text:'',
    classSty:['editBtn'],
    js: {
        attr:'onclick',
        value:`opnHide("mainVJS${counter}")`
    }
})
    

export const selectCat = (text) => ({
    id:'',
    mark:text,
    type:'button', // submit or button
    text:text,
    classSty:['btnText'],
    js: {
        attr:'',
        value:``
    }
})