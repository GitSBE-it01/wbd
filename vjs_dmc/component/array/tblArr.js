export const tableDMC = (data) => ({ // data table
    target:'main', 
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
                param:['OK','NG'] //isi dari option
            }
        ]
})
