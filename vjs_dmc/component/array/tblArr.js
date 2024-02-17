export const tableDMC = (data) => ({ // data table
    target:'dmcDivAll', 
    tblID: 'mainDMC', 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['m4'],
            thdStyle:['flex-r', 'fs-l', 'fw-blk', 'mb3', 'tl3', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2'],
            tdtStyle:['f-child', 'mb1'],
            selStyle:['f-child', 'mb1'],
            btnStyle:[],
        }, 
    tblData: 
        [
            {
                header:'deskripsi',
                db_field:'inspection',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'inspection'
                },
                param:'',
            },
            {
                header:'standard',
                db_field:'std',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'std'
                },
                param:''
            },
            {
                header:'unit',
                db_field:'unit',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'unit'
                },
                param:''
            },
            {
                header:'OK / NG',
                db_field:'input_value',
                dt_type:'select',
                mark:{
                    dbfield:'category',
                    text:'input_value'
                },
                param:['OK','NG'], //isi dari option
                js:{
                    attr:'onchange',
                    value:'addDtTag(this)'
                }
            },
            {
                header:'',
                db_field:'id',
                dt_type:'hidden',
                mark:{
                    dbfield:'id',
                    text:'id'
                },
                param:''
            }
        ]
})

export const tableVJS = (data) => ({ // data table
    target:'dmcDivAll', 
    tblID: 'mainVJS', 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['m4'],
            thdStyle:['flex-c', 'fs-l', 'fw-blk', 'mb3', 'tl3', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-c', 'px2'],
            tdtStyle:['f-child', 'mb1'],
            selStyle:['f-child', 'mb1'],
            btnStyle:[],
        }, 
    tblData: 
        [
            {
                header:'deskripsi',
                db_field:'inspection',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'inspection'
                },
                param:'',
            },
            {
                header:'standard',
                db_field:'std',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'std'
                },
                param:''
            },
            {
                header:'unit',
                db_field:'unit',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'unit'
                },
                param:''
            },
            {
                header:'OK / NG',
                db_field:'input_value',
                dt_type:'select',
                mark:{
                    dbfield:'category',
                    text:'input_value'
                },
                param:['OK','NG'], //isi dari option
                js:{
                    attr:'onchange',
                    value:'addDtTag(this)'
                }
            },
            {
                header:'',
                db_field:'id',
                dt_type:'hidden',
                mark:{
                    dbfield:'id',
                    text:'id'
                },
                param:''
            }
        ]
})

/*
contoh lengkap ============================================

const arr = {
    target:'', 
    tblID: '', 
    dbsrc: '', 
    tblStyle: 
        {
            contStyle: [],
            thdStyle:[],
            thrStyle:[],
            trowStyle:[],
            tdtStyle:[],
            selStyle:[],
            btnStyle:[],
        }, 
    tblData: 
    [
        {
            header:'no asset',
            db_field:'assetno',
            dt_type:'text',
            mark:{
                dbfield:'category',
                text:'unit'
            },
            param:''
        },
        {
            header:'OK / NG',
            db_field:'',
            dt_type:'select',
            mark:{
                dbfield:'category',
                text:'input_value'
            },
            param:['OK','NG'], //isi dari option
            js:{
                attr:'',
                value:''
            }
        },
        {
            header:'test2',
            db_field:'test', // sebagai ID
            dt_type:'button',
            mark:'assetno',
            param:'submit'
        },
        {
            header:'test3',
            db_field:'byusername',
            dt_type:'hidden',
            mark:'assetno',
            param:''
        },
        {
            header:'test4',
            db_field:'hidDiv', // sebagai keterangan
            dt_type:'hidDiv',
            mark:'assetno',
            param:''
        },
        {
            header:'test4',
            db_field:'location', 
            dt_type:'input',
            mark:'assetno',
            param:{
                list: 'list_test',
                disable: false
            },
            js:{
                attr:'',
                value:''
            }
        }
    ]}
*/