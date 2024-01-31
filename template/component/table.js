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
    divHeader.classList.add('fr');
    const classes = tblStyle.thdStyle;
    classes.forEach(clas=>{
        divHeader.classList.add(clas);
    });
    tblData.forEach(hd=>{
        if (hd.dt_type !== 'hidden' || hd.dt_type !== 'hidDiv') {
            const th = document.createElement('div');
            th.textContent = hd.header;
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
    div.setAttribute('data-cell', src[data.mark]);
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
    sel.setAttribute('data-cell', src[data.mark]);
    data.param.forEach(op=> {
        const opt = document.createElement('option');
        opt.value = op;
        opt.textContent = op;
        sel.appendChild(opt);
    })
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
    btn.setAttribute('data-cell', src[data.mark]);
    btn.id = data.db_field + src[data.mark];
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
    input.setAttribute('data-cell', src[data.mark]);
    input.id = data.db_field + "//" + src[data.mark];
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
    inp.setAttribute('data-cell', src[data.mark]);
    inp.id = data.db_field +"//" + src[data.mark];
    inp.setAttribute('type', 'text');
    inp.setAttribute('autocomplete', 'off');
    inp.setAttribute('list', data.param);
    div.appendChild(inp);
    return div;
}

//===========================================================================
// data cell hidden field 
const cellDiv = (src,data) => {
    const div = document.createElement('div');
    div.classList.add('hide');
    div.setAttribute('data-cell', src[data.mark]);
    div.id = data.db_field + "//" + src[data.mark];
    div.value = data.db_field;
    div.textContent ="test";
    return div;
}

//===========================================================================
// data cell text 
const tData = async(src, tblData, tblStyle) => {
    try{
        const trow = document.createElement('div');
        trow.classList.add('fr');
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
export const createTable = async(target, tblID, dbsrc, tblStyle, tblData) => {
    try{
        const container = document.getElementById(target);
        // table container
        container.appendChild(await createTblCont(tblID, tblStyle.contStyle));
        
        // header
        const tblBody = document.getElementById(tblID);
        tblBody.appendChild(await theader(tblData, tblStyle));

        // table data
        for (let i=0; i<dbsrc.length; i++) {
            const result = await tData(dbsrc[i], tblData, tblStyle);
            tblBody.appendChild(result);
        }
    } catch (error) {
        console.log(error);
    }
}