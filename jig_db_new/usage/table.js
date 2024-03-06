//===========================================================================
// create div container
const createTblCont = async(tblID, tblStyle) => {
    const table = document.createElement('div');
    table.id = tblID;
    const classes = tblStyle;
    classes.forEach(clas=>{
        table.classList.add(clas);
    })
    return table;
}

//===========================================================================
// header column
const theader = async(tblData, tblStyle) =>{
    const divHeader = document.createElement('div');
    const classes = tblStyle.thdStyle;
    classes.forEach(clas=>{
        divHeader.classList.add(clas);
    });
    tblData.forEach(hd=>{
        if (hd.dt_type !== 'hidden' && hd.dt_type !== 'hidDiv') {
            const th = document.createElement('div');
            th.textContent = hd.header;
            const classes2 = tblStyle.thrStyle;
            classes2.forEach(clas=>{
                th.classList.add(clas);
            });
            divHeader.appendChild(th);
        }
    })
    return divHeader;
}

//===========================================================================
// data cell text 
const cellTxt = (src,data, tblStyle) => {
    const div = document.createElement('div');
    const classes = tblStyle.tdtStyle;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    div.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    if(src[data.db_field] !== undefined) {div.textContent = src[data.db_field];}
    if(data.js.attr !=='') {div.setAttribute(data.js.attr, data.js.value);}
    return div;
}

//===========================================================================
// data cell selection 
const cellSel = (src,data, tblStyle) => {
    const div = document.createElement('div');
    const sel = document.createElement('select');
    const classes = tblStyle.tdtStyle;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    const classes2 = tblStyle.selStyle;
    if(classes2) {
        classes2.forEach(clas=>{
            sel.classList.add(clas);
        });
    }

    sel.setAttribute('data-cell',  data.mark.text + "___" + src[data.mark.dbfield]);
    data.param.forEach(op=> {
        const opt = document.createElement('option');
        opt.value = op;
        opt.textContent = op;
        sel.appendChild(opt);
    })
    sel.value = src[data.db_field];
    if (data.js.attr !=='') {
        sel.setAttribute(data.js.attr, data.js.value);
    }
    div.appendChild(sel);
    return div;
}

//===========================================================================
// data cell button 
const cellBtn = (src,data, tblStyle) => {
    const div = document.createElement('div');
    const btn = document.createElement('button');
    const classes = tblStyle.tdtStyle;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    const classes2 = tblStyle.btnStyle;
    if(classes2) {
        classes2.forEach(clas=>{
            btn.classList.add(clas);
        });
    }
    btn.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    btn.id = data.db_field + data.mark.text + "___" +src[data.mark.dbfield];
    btn.textContent = data.param;
    btn.setAttribute('type','button');
    div.appendChild(btn);
    return div;
}

//===========================================================================
// data cell hidden field 
const cellHid = (src,data) => {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    input.id = data.db_field + "//" + data.mark.text + "___" +src[data.mark.dbfield];
    input.value = src[data.db_field];
    if (data.js.attr !=='') {
        input.setAttribute(data.js.attr, data.js.value);
    }
    return input;
}

//===========================================================================
// data cell input field 
const cellInp = (src,tblData, tblStyle) => {
    const div = document.createElement('div');
    const inp = document.createElement('input');
    const classes = tblStyle.tdtStyle;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    const classes2 = tblStyle.inpStyle;
    if(classes2) {
        classes2.forEach(clas=>{
            inp.classList.add(clas);
        });
    }
    inp.setAttribute('data-cell', tblData.mark.text + "___" +src[tblData.mark.dbfield]);
    inp.id = tblData.db_field +"//" + tblData.mark.text + "___" +src[tblData.mark.dbfield];
    if (src[tblData.db_field] !== undefined) {inp.value = src[tblData.db_field];}
    inp.setAttribute('type', 'text');
    inp.setAttribute('autocomplete', 'off');
    inp.setAttribute('list', tblData.param.list);
    inp.setAttribute('disable', tblData.param.disable);
    if (tblData.js.attr !=='') {
        inp.setAttribute(tblData.js.attr, tblData.js.value);
    }
    div.appendChild(inp);
    return div;
}

//===========================================================================
// data cell div but not displayed
const cellDiv = (src,data, tblStyle) => {
    const div = document.createElement('div');
    div.classList.add('displayHide');
    const classes = tblStyle.divStyle;
    if(classes) {
        classes.forEach(clas=>{
            div.classList.add(clas);
        });
    }
    div.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    div.id = data.db_field + "//" + data.mark.text + "___" +src[data.mark.dbfield];
    return div;
}

//===========================================================================
// data cell text 
const tData = async(target, src, tblData, tblStyle) => {
    try{
        const cont = document.getElementById(target);
        const trow = document.createElement('div');
        trow.setAttribute('data-row','');
        const classes = tblStyle.trowStyle;
        classes.forEach(clas=>{
            trow.classList.add(clas);
        });
        tblData.forEach(data=> {
            if (data.dt_type === 'text'     ) {return trow.appendChild(cellTxt(src,data, tblStyle));}
            if (data.dt_type === 'select'   ) {return trow.appendChild(cellSel(src,data, tblStyle));}
            if (data.dt_type === 'button'   ) {return trow.appendChild(cellBtn(src,data, tblStyle));}
            if (data.dt_type === 'hidden'   ) {return trow.appendChild(cellHid(src,data));}
            // hidden div should be at first line or last line only
            if (data.dt_type === 'hidDiv'   ) {
                return cont.appendChild(cellDiv(src, data,tblStyle));
            }
            if (data.dt_type === 'input'    ) {return trow.appendChild(cellInp(src,data, tblStyle));}
        })
        cont.appendChild(trow)
        return;
    } catch(error) {
        console.log(error);
    }
}

//===========================================================================
// main function di export
export const createTable = async(arr) => {
    try{
        const container = document.getElementById(arr.target);
        // table container
        container.appendChild(await createTblCont(arr.tblID, arr.tblStyle.contStyle));
        
        // header
        const tblBody = document.getElementById(arr.tblID);
        tblBody.appendChild(await theader(arr.tblData, arr.tblStyle));

        // table data
        if (arr.dbsrc.length === 0 ) {
            await tData(arr.tblID, [1], arr.tblData, arr.tblStyle);
        } else {
            for (let i=0; i<arr.dbsrc.length; i++) {
                await tData(arr.tblID, arr.dbsrc[i], arr.tblData, arr.tblStyle);
            }
        }
    } catch (error) {
        console.log(error);
    }
}


export const tableUsage = (data) => ({ // data table
    target:'main', 
    tblID: 'mainTable', 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['m4'],
            thdStyle:['fr', 'fs-l', 'fw-blk', 'mb3', 'sl3', 'f-wht', 'p2'],
            thrStyle:['flexCh'],
            trowStyle:['fr', 'px2'],
            tdtStyle:['flexCh', 'mb1'],
            selStyle:['flexCh', 'mb1'],
            btnStyle:[],
        }, 
    tblData: 
        [
            {
                header:'item number jig',
                db_field:'item_jig',
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'transaction date',
                db_field:'tr_date',
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'quantity',
                db_field:'qty',
                dt_type:'text',
                mark:{
                    dbfield:'',
                    text:''
                },
                param:'',
                js:{
                    attr:'',
                    value:''
                }
            },
            {
                header:'keterangan',
                db_field:'remark',
                dt_type:'text',
                mark:{
                    dbfield:'',
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
                db_field:'filter',
                dt_type:'hidden',
                mark:{
                    dbfield:'',
                    text:'filter'
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
export const headerForm = (data,counter) => ({ // data table
    target:`mainVJS${counter}`, 
    tblID: `dtVJS${counter}`, 
    dbsrc: data, 
    tblStyle: 
        {
            contStyle: ['mx4', 'flex-r', 'floatLeft'],
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
            contStyle: ['mx4', 'mb2'],
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