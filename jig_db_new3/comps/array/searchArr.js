export const transSearchBar = () =>({// detail search
    target:'top',
    id:'',
    mark:'',
    divStyle:[],
    arrInp:
    {
        id:'filterTrans',
        type:'text', // text or hidden
        placeholder:'input jig number',
        list:'jig_name',
        classSty:['inputinfo'],
        js: {
            attr:'onkeydown',
            value:'enterProcess(event,"sbmtCat")'
        }
    },
    arrBtn: 
    {
        id:'sbmtCat',
        marK:'',
        type:'button', // submit or button
        text: 'search',
        classSty:['button-30'],
        js: {
            attr:'',
            value:''
        }
    }
})
