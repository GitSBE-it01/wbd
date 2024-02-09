//===========================================================================
// example of array to use : 

const tblStyle = {
    contStyle: [],
    thdStyle:[],
    trowStyle:[],
    tdtStyle:[],
    selStyle:[],
    btnStyle:[],
}

const tblData = [
    {
        header:'no asset',
        db_field:'assetno',
        dt_type:'text',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:''
    },
    {
        header:'asset description',
        db_field:'assetname',
        dt_type:'text',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:''
    },
    {
        header:'test',
        db_field:'',
        dt_type:'select',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:["-choose-",'yes','no'] //isi dari option
    },
    {
        header:'test2',
        db_field:'test', // sebagai ID
        dt_type:'button',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:'submit'
    },
    {
        header:'test3',
        db_field:'byusername',
        dt_type:'hidden',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:''
    },
    {
        header:'test4',
        db_field:'hidDiv', // sebagai keterangan
        dt_type:'hidDiv',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:''
    },
    {
        header:'test4',
        db_field:'location', 
        dt_type:'input',
        mark:{
            dbfield:'noAsset',
            text:'test'
        },
        param:'list_test'
    }
]

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
        if (hd.dt_type !== 'hidden' || hd.dt_type !== 'hidDiv') {
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
    div.textContent = src[data.db_field];
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
    return input;
}

//===========================================================================
// data cell hidden field 
const cellInp = (src,data) => {
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
    inp.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    inp.id = data.db_field +"//" + data.mark.text + "___" +src[data.mark.dbfield];
    inp.setAttribute('type', 'text');
    inp.setAttribute('autocomplete', 'off');
    inp.setAttribute('list', data.param.list);
    inp.setAttribute('disable', data.param.disable);
    div.appendChild(inp);
    return div;
}

//===========================================================================
// data cell hidden field 
const cellDiv = (src,data) => {
    const div = document.createElement('div');
    div.classList.add('hide');
    div.setAttribute('data-cell', data.mark.text + "___" +src[data.mark.dbfield]);
    div.id = data.db_field + "//" + data.mark.text + "___" +src[data.mark.dbfield];
    div.value = data.db_field;
    div.textContent ="test";
    return div;
}

//===========================================================================
// data cell text 
const tData = async(src, tblData, tblStyle) => {
    try{
        const trow = document.createElement('div');
        const classes = tblStyle.trowStyle;
        classes.forEach(clas=>{
            trow.classList.add(clas);
        });
        tblData.forEach(data=> {
            if (data.dt_type === 'text'     ) {return trow.appendChild(cellTxt(src,data, tblStyle));}
            if (data.dt_type === 'select'   ) {return trow.appendChild(cellSel(src,data, tblStyle));}
            if (data.dt_type === 'button'   ) {return trow.appendChild(cellBtn(src,data, tblStyle));}
            if (data.dt_type === 'hidden'   ) {return trow.appendChild(cellHid(src,data));}
            if (data.dt_type === 'hidDiv'   ) {return trow.appendChild(cellDiv(src,data));}
            if (data.dt_type === 'input'    ) {return trow.appendChild(cellInp(src,data));}
        })
        return trow;
    } catch(error) {
        console.log(error);
    }
}

//===========================================================================
// main function di export
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
            mark:'assetno',
            param:''
        },
        {
            header:'asset description',
            db_field:'assetname',
            dt_type:'text',
            mark:'assetno',
            param:''
        },
        {
            header:'test',
            db_field:'',
            dt_type:'select',
            mark:'assetno',
            param:["-choose-",'yes','no'] //isi dari option
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
            param:
            {
                list: 'list_test',
                disable: false
            }
        }
    ]}
    
export const createTable = async(arr) => {
    try{
        const container = document.getElementById(arr.target);
        // table container
        container.appendChild(await createTblCont(arr.tblID, arr.tblStyle.contStyle));
        
        // header
        const tblBody = document.getElementById(arr.tblID);
        tblBody.appendChild(await theader(arr.tblData, arr.tblStyle));

        // table data
        for (let i=0; i<arr.dbsrc.length; i++) {
            const result = await tData(arr.dbsrc[i], arr.tblData, arr.tblStyle);
            tblBody.appendChild(result);
        }
    } catch (error) {
        console.log(error);
    }
}
