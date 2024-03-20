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
                param:['OK','NG'], 
                js:{
                    attr:'onchange',
                    value:'addDtTag(this, "[data-row]", "data-cell")' 
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

export const headerForm = (data,counter) => ({ // data table
    target:`mainVJS${counter}`, 
    tblID: `dtVJS${counter}`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['mx4', 'flex-r', 'cl3'],
            thdStyle:['flex-c', 'fs-m', 'fw-blk', 'mb3', 'tl5', 'p2'],
            thrStyle:['f-child', 'mb2'],
            trowStyle:['flex-c', 'mb3', 'py2'],
            tdtStyle:['mb2', 'pl1', 'fs-m'],
            selStyle:[],
            btnStyle:[],
            divStyle:[]
        }, 
    tblData: 
        [
            {
                header: `ID`,
                db_field:'wo_id',
                dt_type:'input',
                mark:{
                    dbfield:'wo_id',
                    text:'VJSwo_id'
                },
                param:{
                    list: 'woList',
                    disable: false
                },
                js:{
                    attr:'onchange',
                    value:`getSplitValue(this, "[data-row]", "data-cell", "mainVJS${counter}", "part_", "desc_")`
                }
            },
            {
                header:'Item Number',
                db_field:'',
                dt_type:'text',
                mark:{
                    dbfield:'assetno',
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
                    dbfield:'assetno',
                    text:'desc'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'dmc_vjs',
                dt_type:'hidden',
                mark:{
                    dbfield:'dmc_vjs',
                    text:'count'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            }
        ]
})

export const tableVJS = (data, counter) => ({ // data table
    target:`mainVJS${counter}`, 
    tblID: `isiVJS${counter}`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['mx4', 'mb2', 'cl9', 'flex-c'],
            thdStyle:['flex-r', 'fs-m', 'fw-blk', 'mb3', 'tl2', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2', 'mb2'],
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
                    attr:'onchange',
                    value:'addDtTag(this, "[data-row]", "data-cell")'
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
                    attr:'onchange',
                    value:'addDtTag(this, "[data-row]", "data-cell")'
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

export const tablecatList = (data, cat) => ({ // data table
    target:`bigSide`, 
    tblID: `catList${cat}`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['mx2', 'mb2', 'f-child'],
            thdStyle:['flex-r', 'fs-m', 'fw-blk', 'mb3', 'tl2', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2', 'mb2'],
            tdtStyle:['f-child', 'mb1', 'flex-c'],
            selStyle:['f-child', 'mb1'],
            btnStyle:['button_minus_sml'],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'DMC / VJS',
                db_field:'dmc_vjs',
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
                header:'Inspeksi',
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
                header: `standard`,
                db_field:'std',
                dt_type:'text',
                mark:{
                    dbfield:'category',
                    text:'std'
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
                header:'',
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:'category',
                    text:'del'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'id_std',
                dt_type:'hidden',
                mark:{
                    dbfield:'category',
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

export const tblAddList = (cat) => ({ // data table
    target:`addedList__${cat}`, 
    tblID: `cc`, 
    dbsrc: [], 
    tblStyle: 
        {
            contStyle: ['mx2', 'mb2', 'f-child'],
            thdStyle:['flex-r', 'displayHide'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2', 'mb2'],
            tdtStyle:['f-child', 'mb1', 'flex-c', 'mt2'],
            selStyle:['f-child', 'mb1', 'mt2'],
            btnStyle:['button_minus_sml'],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'dmc_vjs'
                },
                param:{
                    list: '',
                    disable: true
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:`inspection__${cat}`
                },
                param:{
                    list: 'listInsp',
                    disable: false
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'std'
                },
                param:{
                    list: '',
                    disable: true
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'unit'
                },
                param:{
                    list: '',
                    disable: true
                },
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:`${cat}`,
                    text:'delList'
                },
                param:'',
                js:{
                    attr:'onclick',
                    value:'delNode(this,"[data-divList]")'
                }
            },
        ]
})


export const listInspTable = (src) => ({ // data table
    target:`main`, 
    tblID: `listAll`, 
    dbsrc: src, 
    tblStyle: 
        {
            contStyle: ['mx2', 'mb2', 'f-child', 'overY'],
            thdStyle:['flex-r', 'displayHide'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2', 'mb2'],
            tdtStyle:['f-child', 'mb1', 'flex-c', 'mt2'],
            selStyle:['f-child', 'mb1', 'mt2'],
            btnStyle:['button_minus_sml'],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'Inspection',
                db_field:'inspection',
                dt_type:'text',
                mark:{
                    dbfield:'inspection',
                    text:'insp'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'DMC / VJS',
                db_field:'dmc_vjs',
                dt_type:'text',
                mark:{
                    dbfield:'inspection',
                    text:''
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'document',
                db_field:'doc',
                dt_type:'text',
                mark:{
                    dbfield:'inspection',
                    text:''
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
                    dbfield:'inspection',
                    text:''
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
                    dbfield:'inspection',
                    text:''
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'',
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:`inspection`,
                    text:'delLs'
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
        ]
})

export const addInspTable = () => ({ // data table
    target:`inputInsp`, 
    tblID: `formInp`, 
    dbsrc: [], 
    tblStyle: 
        {
            contStyle: ['mx2', 'mb2', 'f-child'],
            thdStyle:['flex-r', 'fs-m', 'fw-blk', 'mb3', 'tl2', 'f-wht', 'p2'],
            thrStyle:['f-child'],
            trowStyle:['flex-r', 'px2', 'mb2'],
            tdtStyle:['f-child', 'mb1', 'flex-c', 'mt2'],
            selStyle:['f-child', 'mb1', 'mt2'],
            btnStyle:['button_minus_sml'],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'Inspection',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'inspection'
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
                header:'DMC / VJS',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'dmc_vjs'
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
                header:'Document',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'doc'
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
                header:'Standard',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'std'
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
                header:'Unit',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'unit'
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
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:`inspection`,
                    text:'delList'
                },
                param:'',
                js:{
                    attr:'onclick',
                    value:'delNode(this,"[data-row]")'
                }
            },
        ]
})


export const addInspTable2 = (counter) => ({ // data table
    target:`inputInsp`, 
    tblID: `formInp${counter}`, 
    dbsrc: [], 
    tblStyle: 
        {
            contStyle: ['mx2', 'mb2', 'f-child'],
            thdStyle:['displayHide'],
            thrStyle:[],
            trowStyle:['flex-r', 'px2', 'mb2'],
            tdtStyle:['f-child', 'mb1', 'flex-c', 'mt2'],
            selStyle:['f-child', 'mb1', 'mt2'],
            btnStyle:['button_minus_sml'],
            divStyle:['fullwidth','or9']
        }, 
    tblData: 
        [
            {
                header:'Inspection',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'inspection'
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
                header:'DMC / VJS',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'dmc_vjs'
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
                header:'Document',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'doc'
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
                header:'Standard',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'std'
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
                header:'Unit',
                db_field:'', 
                dt_type:'input',
                mark:{
                    dbfield:'',
                    text:'unit'
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
                db_field:'', // sebagai ID
                dt_type:'button',
                mark:{
                    dbfield:`inspection`,
                    text:'delList'
                },
                param:'',
                js:{
                    attr:'onclick',
                    value:'delNode(this,"[data-row]")'
                }
            },
        ]
})