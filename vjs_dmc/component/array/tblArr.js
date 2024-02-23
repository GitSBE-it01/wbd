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
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'standard',
                db_field:'std',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'std'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'unit',
                db_field:'unit',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'unit'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
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
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            }
        ]
})

export const headerForm = () => ({ // data table
    target:'mainVJS', 
    tblID: 'hdVJS', 
    dbsrc: [], 
    tblStyle: 
        {
            contStyle: ['m4', 'flex-r'],
            thdStyle:['flex-c', 'fs-m', 'fw-blk', 'mb3', 'tl5', 'f-wht', 'p2'],
            thrStyle:['f-child', 'mb1'],
            trowStyle:['flex-c', 'px2'],
            tdtStyle:['f-child', 'mb1'],
            selStyle:['f-child', 'mb1'],
            btnStyle:[],
            divStyle:[]
        }, 
    tblData: 
        [
            {
                header: `ID`,
                db_field:'',
                dt_type:'input',
                mark:{
                    dbfield:'wo_id',
                    text:'wo_id'
                },
                param:{
                    list: 'woList',
                    disable: false
                },
                js:{
                    attr:'onchange',
                    value:`getSplitValue(this, "part_", "desc_")`
                }
            },
            {
                header:'Item Number',
                db_field:'',
                dt_type:'text',
                mark:{
                    dbfield:'wo_part',
                    text:'part'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Description',
                db_field:'',
                dt_type:'text',
                mark:{
                    dbfield:'wo_part',
                    text:'desc'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
        ]
})


export const tableVJS = (data) => ({ // data table
    target:'mainVJS', 
    tblID: 'isiVJS', 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['m4'],
            thdStyle:['flex-r', 'fs-m', 'fw-blk', 'mb3', 'tl5', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2'],
            tdtStyle:['f-child', 'mb1'],
            selStyle:['f-child', 'mb1'],
            btnStyle:[],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'Check',
                db_field:'inspection',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'inspection'
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'standard',
                db_field:'std',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'std'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'unit',
                db_field:'unit',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'unit'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header: `aktual`,
                db_field:'input_value',
                dt_type:'input',
                mark:{
                    dbfield:'id',
                    text:'input_value'
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
                header: `keterangan`,
                db_field:'remark',
                dt_type:'input',
                mark:{
                    dbfield:'id',
                    text:'remark'
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
                header:'',
                db_field:'id',
                dt_type:'hidden',
                mark:{
                    dbfield:'id',
                    text:'id'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
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
            divStyle:[]
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
            mark:{
                dbfield:'category',
                text:'input_value'
            },
            param:'submit'
        },
        {
            header:'test3',
            db_field:'byusername',
            dt_type:'hidden',
                        mark:{
                dbfield:'category',
                text:'input_value'
            },
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