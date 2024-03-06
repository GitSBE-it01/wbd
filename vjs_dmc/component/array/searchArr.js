export const searchBarMain = {// detail search
    target:'main',
    divStyle:['tl4', 'p2'],
    arrInp:
    {
        id:'test1',
        type:'text', // text or hidden
        placeholder:'-choose-',
        list:'asset_list',
        classSty:['mx2']
    },
    arrBtn: 
    {
        id:'test2',
        marK:'',
        type:'button', // submit or button
        text: 'submit',
        classSty:['mx1'],
        js: {
            attr:'',
            value:''
        }
    }
}

export const searchBarKat = {// detail search
    target:'main',
    divStyle:['bl7', 'p2'],
    arrInp:
    {
        id:'assetInput',
        type:'text', // text or hidden
        placeholder:'-choose-',
        list:'all_asset',
        classSty:['mx2']
    },
    arrBtn: 
    {
        id:'sbmtAsset',
        marK:'',
        type:'button', // submit or button
        text: 'submit',
        classSty:['mx1'],
        js: {
            attr:'',
            value:''
        }
    }
}

export const inpNew = (data) =>({// detail search
    target:'smallSide',
    divStyle:['flex-c','bl8', 'p2'],
    arrInp:
    {
        id:'newCat',
        type:'text', // text or hidden
        placeholder:'new category',
        list:data,
        classSty:['mx2']
    },
    arrBtn: 
    {
        id:'sbmtCat',
        marK:'',
        type:'button', // submit or button
        text: 'add',
        classSty:['mx2'],
        js: {
            attr:'',
            value:''
        }
    }
})
