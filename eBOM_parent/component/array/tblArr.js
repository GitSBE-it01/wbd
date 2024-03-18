export const mainTbl = (data) => ({ // data table
    target:`main`, 
    tblID: `tblMain`, 
    dbsrc: data, 
    tblStyle: {
        contStyle: ['mx2', 'mb2', 'flex-r'],
        thrStyle:['flex-r'],
        trowStyle:['flex-r', 'px2', 'mb2'],
    },
    tblData: 
        [
            {
                header:'Component',
                db_field:'part', 
                dt_type:'text',
                style: {
                    thdStyle:['fs-m', 'fw-blk', 'mb3', 'tl2', 'f-wht', 'p2', 'cl2'],
                    tdtStyle:['mb1', 'px3', 'mt2', 'cl10'],
                    insideStyle:[]
                },
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
            {
                header:'Parent',
                db_field:'parent', 
                dt_type:'text',
                style: {
                    thdStyle:['fs-m', 'fw-blk', 'mb3', 'tl2', 'f-wht', 'p2', 'cl10'],
                    tdtStyle:['mb1', 'px3', 'mt2', 'cl10'],
                    insideStyle:[]
                },
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
                mark:{
                    dbfield:'category',
                    text:'id'
                },
            param:''
        },
        {
            header:'test4',
            db_field:'location', 
            dt_type:'input',
            mark:{
                dbfield:'category',
                text:'id'
            },
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