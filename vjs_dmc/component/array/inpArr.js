export const inpArrCat = (text) => ({
    id:'',
    mark:text,
    type:'text', // text or hidden
    placeholder: '-input new category-',
    list:'',
    classSty:[],
})


export const inpArrForm = {
    tblStyle: {
        tdtStyle: [],
        inpStyle:[]
    },
    tblData: [
            {
                header:'Inspection',
                mark:'',
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'DMC / VJS',
                mark:'',
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Document',
                mark:'',
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Standard',
                mark:'',
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Unit',
                mark:'',
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                dt_type:'button',
                mark:'',
                param:'',
                js:{
                    attr:'onclick',
                    value:'delNode(this,"[data-row]")'
                }
            },
        ]
    }