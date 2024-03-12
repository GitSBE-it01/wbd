export const mainTblTrans = (data) => ({ // data table
    target:'bot', 
    tblID: 'mainTbl', 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['card_contain'],
            thdStyle:['tableFlex'],
            thrStyle:['tableData', 'tableHeader'],
            trowStyle:['tableFlex'],
            tdtStyle:['tableData'],
            selStyle:[],
            btnStyle:[],
            divStyle:['tableFlex']
        }, 
    tblData: 
        [
            {
                header:'',
                db_field:'', // sebagai ID
                dt_type:'hidDiv',
                mark:{
                    dbfield:'item_jig',
                    text:'hid'
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Item Number Jig',
                db_field:'item_jig',
                dt_type:'text',
                mark:{
                    dbfield:'item_jig',
                    text:'item'
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Qty total',
                db_field:'qty_total',
                dt_type:'text',
                mark:{
                    dbfield:'item_jig',
                    text:'qtyTotal'
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Qty tersedia',
                db_field:'qty_avl',
                dt_type:'text',
                mark:{
                    dbfield:'item_jig',
                    text:'qtyAvl'
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Qty di pinjam',
                db_field:'qty_bor',
                dt_type:'text',
                mark:{
                    dbfield:'item_jig',
                    text:'qtyBor'
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'detail',
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:'item_jig',
                    text:'open'
                },
                param:{
                    list: '',
                    disable: '',
                    text: 'open',
                },
                js:{
                    attr:'onclick',
                    value:'openHide2(event, "hid", "displayHide")'
                }
            },
            {
                header:'',
                db_field:'filter', // sebagai ID
                dt_type:'hidden',
                mark:{
                    dbfield:'',
                    text:'filter'
                },
                param:{
                    list: '',
                    disable: '',
                    text: 'open',
                },
                js:{
                    attr:'onclick',
                    value:'openHide2(event, "hid", "displayHide")'
                }
            },

        ]
})

export const hidTblTrans = (data,trgt,id) => ({ // data table
    target: trgt, 
    tblID:`${id}`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['card_contain'],
            thdStyle:['tableFlex'],
            thrStyle:['tableData', 'tableHeader'],
            trowStyle:['tableFlex'],
            tdtStyle:['tableData'],
            selStyle:[],
            btnStyle:['arrow_green'],
            divStyle:[]
        }, 
    tblData: 
        [
            {
                header:'Code',
                db_field:'code', // sebagai ID
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },            {
                header:'Lokasi',
                db_field:'lokasi', // sebagai ID
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Qty',
                db_field:'qty_per_unit', // sebagai ID
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'UM',
                db_field:'unit', // sebagai ID
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Tgl Pinjam',
                db_field:'start_date', // sebagai ID
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'Peminjam',
                db_field:'loc', // sebagai ID
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: 'locS',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'action',
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:{
                    list: '',
                    disable: '',
                    text: '',
                },
                js:{
                    attr:'',
                    value:''
                }
            },
        ]
})
