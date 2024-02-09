<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout_fix.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Document</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'></div>

<script type='module'>
    import {createNav, createSearch, createDatalist, loading, createTable, activeLink, createHeader, createBtn} from './component/index.js';
    import {vjs_asset, dataInput, bom} from './middleware/js/class.js';
    import {splitCustomString, currentDate} from './middleware/js/process.js';

    await createNav(
            { //nav list
                target:'root',
                tgtStyle:'flex-c',
                navStyle:['tl2', 'navCard2','flex-r'],
                mainStyle:['tl8', 'navCard1'],
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
                            text: 'home',
                            divStyle:['ml5','mt3', 'scale-120'],
                            linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
                        },
                        {
                            link: '#',
                            type: 'txt', // if btn then create a button, if txt then create span
                            text: 'kategori',
                            divStyle:['ml5','mt3', 'scale-120'],
                            linkStyle: ['f-tl7', 'fs-m', 'fw-blk']
                        }
                    ]
            }
        );
    activeLink('navID', ['f-or7']);
    const main = document.getElementById('main');
    main.appendChild(loading('load','loading2'));
    const assetDt = await vjs_asset.getData();
    await createDatalist(
            {
                target:'root',
                id:'asset_list',
                data:assetDt,
                delimiter:'/',
                optValue:['assetno', 'assetkategori','vjs_kategory'],
                optText:['assetno', 'assetkategori', 'assetname', 'location']
            }
        );
    
    await createSearch(
            { // detail search
                target:'main',
                divStyle:['tl4', 'p2'],
                arrInp:
                {
                    id:'test1',
                    type:'text', // text or hidden
                    placeholder:'-choose-',
                    list:'asset_list',
                    classSty:['mx2'],
                },
                arrBtn: 
                {
                    id:'test2',
                    type:'button', // submit or button
                    text: 'submit',
                    classSty:['mx1']
                }
            }
        );
    main.removeChild(document.getElementById('load'));
    
    // proses saat klik submit button
    const sbmtBtn = document.getElementById('test2');
    sbmtBtn.addEventListener('click', async function(event) {
        try{
            main.appendChild(loading('load','loading2'));
            const sbmtBtn = document.getElementById('test2');
            sbmtBtn.disabled = true;
            // check apakah ada DMC yg terbentuk di hari ini utk asset yg dipilih
            const valueInp = await splitCustomString('/',document.getElementById('test1').value);
            const dataDMC = await dataInput.fetchDataFilter({assetno: valueInp[0], assetkat:valueInp[1], input_date:currentDate()});
            // buat title heading utk daily maintenance
            await createHeader(
                    {
                        target:'main',
                        id:'hd',
                        style: ['textCenter', 'fs-xl','fw-bld', 'm3'],
                        text:'Daily Maintenance'               
                    }
                );
            // check apakah sudah ada data yg di munculkan. jika ada maka di hapus terlebih dahulu
            if (document.getElementById('mainDMC')) {
                    document.getElementById('mainDMC').remove();
                }

            // jika data DMC blum terbuat maka buat table utk input data
            if (dataDMC.length === 0) { // setelah proses ini lgsg break
                    const dmc = await bom.fetchDataFilter({category: valueInp[2]});
                    await createTable(
                        { // data table
                            target:'main', 
                            tblID: 'mainDMC', 
                            dbsrc: dmc, 
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
                                        db_field:'',
                                        dt_type:'select',
                                        mark:{
                                            dbfield:'category',
                                            text:'input_value'
                                        },
                                        param:['-choose-','OK','NG'] //isi dari option
                                    }
                                ]
                        });
                    main.appendChild(await createBtn({
                            id:'dmcEdit',
                            type:'button', // submit or button
                            text:'edit',
                            classSty:['mx4']
                        }));
                    main.appendChild(await createBtn({
                            id:'dmcInput',
                            type:'button', // submit or button
                            text:'submit',
                            classSty:['mx4']
                        }));
                    return main.removeChild(document.getElementById('load'));          
                } 
            
            // jika data DMC ada maka buat table utk show data 
            await createTable(
                    { // data table
                        target:'main', 
                        tblID: 'mainDMC', 
                        dbsrc: dataDMC, 
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
                                    param:['-choose-','OK','NG'] //isi dari option
                                }
                            ]
                    }
                );

            main.appendChild(await createBtn({
                    id:'dmcEdit',
                    type:'button', // submit or button
                    text:'edit',
                    classSty:['mx4']
                }));
            main.appendChild(await createBtn({
                    id:'dmcInput',
                    type:'button', // submit or button
                    text:'submit',
                    classSty:['mx4']
                }));
            const btnDMCInp = document.getElementById('dmcInput');
            btnDMCInp.disabled = true;
            const maindDMC = document.getElementById('mainDMC');
            maindDMC.classList.add('displayHide');
            if (dataDMC[0].decision === 'OK') {
                        main.appendChild(await createBtn({
                            id:'dmcDiv',
                            type:'button', // submit or button
                            text:'',
                            classSty:['check'],
                        }))
                    } else {
                        main.appendChild(await createBtn({
                            id:'dmcDiv',
                            type:'button', // submit or button
                            text:'',
                            classSty:['cross'],
                        })
                    )
                }
            sbmtBtn.disabled = false;
            return main.removeChild(document.getElementById('load'));    
        } catch(error) {
            console.log(error);
        }
    })
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
</body>
</html>