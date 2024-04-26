/*
1. make it all as function 
2. yg harus ada : 
id
textContent
data_attr {
    attr: '',
    value: ''
}
style


3. harus buat default array, kalau tidak di pakai ambil default

*/

// button array


// datalist


// header
export const header4 = (idTgt, counter) => ({
    target: idTgt,
    id:`hdVJS${counter}`,
    style: ['fs-l', 'm3'],
    text: `Verifikasi ${counter}`
});

export const inspection = {
    target:'',
    id:'hdList',
    style: ['fs-l', 'fw-bld', 'mx4'],
    text:'Add New Inspection'               
};

//input 
export const inpArrCat = (text) => ({
    id:'',
    mark:text,
    type:'text', // text or hidden
    placeholder: '-input new category-',
    list:'',
    classSty:[],
})

// layout
export const arrKat = {
    target:'main',
    id:'main2',
    col:[
        {
            id:'smallSide',
            style:['flex-c','cl2', 'sl6', 'h100']
        },
        {
            id:'bigSide',
            style:['cl10', 'sl9', 'flex-c', 'h100']
        }
    ]
}

// navigaition
export const navigation = { //nav list
    target:'root',
    tgtStyle:'flex-c',
    id: 'navID',
    navStyle:['sl2', 'navCard2','flex-r'],
    mainStyle:['sl8', 'navCard1'],
    navi:[
            {
                link: '../../sbe/index.php',
                type: 'btn', // if btn then create a button, if txt then create span
                text: '', //if btn then empty
                divStyle:['mx5', 'mt2', 'scale-120'],
                linkStyle: ['home']
            },
            {
                link: 'index.php',
                type: 'txt', // if btn then create a button, if txt then create span
                text: 'Home',
                divStyle:['ml5','mt3', 'scale-120'],
                linkStyle: ['f-sl7', 'fs-m', 'fw-blk']
            }
        ]
}

//table 
export const sec1Tbl = (data) => ({ // data table
    target:`main`, 
    tblID: `tblMain`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['m4'],
            thdStyle:['flex-r', 'fs-l', 'fw-blk', 'mb3', 'tl3', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2'],
            tdtStyle:['f-child', 'mb2', 'pt1', 'newLine', 'bt-White1'],
            selStyle:[],
            btnStyle:[],
        }, 
    tblData: 
        [
            {
                header:'Component',
                db_field:'part', 
                dt_type:'text',
                mark:{
                    dbfield:'part',
                    text:'part'
                },
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
                header:'Parent',
                db_field:'parent', 
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
        ]
})