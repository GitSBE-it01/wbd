<?php
require_once "D:/xampp/htdocs/CONNECTION/config.php";
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
    <title>VJS & DMC kategori</title>
</head>
<body>
<input type='hidden' value="<?php echo $role; ?>" id='role'>
<div id='root' class='container'>
    <div class='loading'></div>
</div>
<script src="./utility/prep.js"></script>
<script type='module'>
    import {
        createNav,
        createSearch,
        createDatalist,
        loading,
        createTable,
        activeLink,
        createHeader,
        createBtn,
        createInp,
        navigation,
        assetList,
        searchBarMain,
        tableDMC,
        tableVJS,
        btnDmcEdit, 
        btnDmcSbmt,
        dmcOk, 
        dmcNg,
        header1,
        header2,
        header3,
        woList,
        allAsset,
        searchBarKat,
        columnSprt,
        arrKat,
        selectCat,
        tablecatList,
        slcAddBtn,
        slcDelBtn,
        inpNew,
        catData,
        insData,
        inpArrCat,
        tblAddList,
        basicBtn,
        selection,
        createHeader2,
        headerListInsp
    } from './component/index.js';
    import {
        inpDMCProcess, 
        dmc_input, 
        bom, 
        currentDate,
        initVJS,
        vjs_input,
        wo_list,
        vjs_asset,
        asset,
        list_category,
        list_inspect
    } from './utility/index.js';
    
    // start up web page
    const root = document.getElementById('root');
    await createNav(navigation);
    activeLink('navID', ['f-or7']);
    const allAssetDt = await asset.getData();
    const dmc_vjs = await bom.getData();
    const list_insp = await list_inspect.getData();
    const list_cat = await list_category.getData();
    const listedAst = await vjs_asset.getData();
    const combine = dmc_vjs.map((obj1)=>{
        const matObj = list_insp.find((obj2) => obj2.inspection === obj1.inspection);
        return {
            ...obj1,
            ...matObj}
    })
    await createDatalist(allAsset(allAssetDt));
    await createDatalist(catData(list_cat));
    await createDatalist(insData(list_insp));
    await createSearch(searchBarKat);
    await columnSprt(arrKat);
    const main2 = document.getElementById('main2');
    main2.setAttribute('style', 'height:96%;');
    const side1 = document.getElementById('smallSide');
    const big = document.getElementById('bigSide');
    big.appendChild(await createHeader2(headerListInsp(`Mesin`)));
    const addDelCat = document.createElement('div');
    addDelCat.classList.add('bl4', 'p2');
    const btnDiv = document.createElement('div');
    btnDiv.classList.add('flex-r', 'pt3', 'pl2', 'bl4');
    addDelCat.appendChild(await createHeader2(selection));
    addDelCat.appendChild(await createInp(inpArrCat('inpCatNew')));
    btnDiv.appendChild(await createBtn(slcAddBtn('addBtn')));
    btnDiv.appendChild(await createBtn(slcDelBtn('delBtn')));
    addDelCat.appendChild(btnDiv);
    side1.appendChild(addDelCat);

    
    for (let i=0; i<list_cat.length; i++) {
        const div = document.createElement('div');
        div.setAttribute('data-select',list_cat[i].mesin_cat);
        div.textContent = list_cat[i].mesin_cat;
        div.classList.add('f-child','pb4', 'pt2', 'pl3', 'fs-m', 'hv-fs-l', 'sl4', 'hv-sl9', 'fc-w', 'hv-fc-b', 'hv-fw-blk');
        const btn = document.createElement('button');
        btn.classList.add('button_minus_sml', 'ml2', 'displayHide');
        btn.setAttribute('data-selBtn',list_cat[i].mesin_cat);
        div.appendChild(btn);
        side1.appendChild(div);
    }
    root.removeChild(document.querySelector('.loading'));


    let valueTest ='';
    let cek = 0;
    document.addEventListener('mouseover', async function(event){
        if(event.target.getAttribute('data-select')) {
                valueTest = event.target.getAttribute('data-select')
                const all = document.querySelectorAll('[data-select]');
                all.forEach(al => {
                    al.classList.remove('fs-l','fc-b', 'sl9', 'fw-blk');
                })
                const target = document.querySelector(`[data-select="${valueTest}"]`);
                target.classList.add('fs-l','fc-b', 'sl9', 'fw-blk');
                const raw = combine.filter(item => item.category === valueTest);
                const result = raw.sort((a, b) => {
                    const { nameA, nameB } = a && b ? { nameA: a.dmc_vjs, nameB: b.dmc_vjs } : {};
                    return nameA.localeCompare(nameB); // Sort names case-insensitively
                    });

                const big = document.getElementById('bigSide');
                const allDiv = big.querySelectorAll(`[data-div]`);
                allDiv.forEach(al => {
                    al.classList.add('displayHide');
                })
                if(!document.getElementById(`catList${valueTest}`)) {
                    await createTable(tablecatList(result, valueTest));
                    const get = document.getElementById(`catList${valueTest}`);
                    get.setAttribute('data-div', valueTest);
                    const btnDelIns = get.querySelectorAll(`[data-cell*="del___${valueTest}`)
                    btnDelIns.forEach(del =>{
                        del.classList.add('displayHide');
                    })
                    get.appendChild(await createBtn(slcAddBtn(`addBtnList__${valueTest}`)));
                    get.appendChild(await createBtn(slcDelBtn(`delBtnList__${valueTest}`)));
                    get.appendChild(await createBtn(basicBtn(`sbmtPick__${valueTest}`,'enter')));
                    return;
                }
                const target2 = document.getElementById(`catList${valueTest}`);
                target2.classList.remove('displayHide');
                return;
            }
    })

    document.addEventListener( 'click', async function(event) {
        //pick asset
        if(event.target.getAttribute('id') === 'sbmtAsset') {
                const main = document.getElementById('bigSide');
                const getSearchVal = document.getElementById('assetInput').value;
                const splitSearchVal = getSearchVal.split('/');
                const getIdTxt = document.getElementById('hdList2');
                getIdTxt.textContent = `
                Mesin: ${splitSearchVal[0]} --  
                Deskripsi: ${splitSearchVal[3]} -- 
                Lokasi: ${splitSearchVal[4]}`;

                listedAst.forEach(ls=> {
                    if(ls.assetno === splitSearchVal[0]) {
                        valueTest = ls.vjs_kategory;
                        cek = ls.id;
                        return;
                    }
                })


                const all = document.querySelectorAll('[data-select]');
                all.forEach(al => {
                    al.classList.remove('fs-l','fc-b', 'sl9', 'fw-blk');
                    if(al.getAttribute('data-select')=== valueTest) {
                        al.classList.add('fs-l','fc-b', 'sl9', 'fw-blk');
                    }
                })
                const raw = combine.filter(item => item.category === valueTest);
                const result = raw.sort((a, b) => {
                    const { nameA, nameB } = a && b ? { nameA: a.dmc_vjs, nameB: b.dmc_vjs } : {};
                    return nameA.localeCompare(nameB); // Sort names case-insensitively
                    });

                const big = document.getElementById('bigSide');
                const allDiv = big.querySelectorAll(`[data-div]`);
                allDiv.forEach(al => {
                    al.classList.add('displayHide');
                })
                if(!document.getElementById(`catList${valueTest}`)) {
                    await createTable(tablecatList(result, valueTest));
                    const get = document.getElementById(`catList${valueTest}`);
                    get.setAttribute('data-div', valueTest);
                    const btnDelIns = get.querySelectorAll(`[data-cell*="del___${valueTest}`)
                    btnDelIns.forEach(del =>{
                        del.classList.add('displayHide');
                    })
                    get.appendChild(await createBtn(slcAddBtn(`addBtnList__${valueTest}`)));
                    get.appendChild(await createBtn(slcDelBtn(`delBtnList__${valueTest}`)));
                    get.appendChild(await createBtn(basicBtn(`sbmtPick__${valueTest}`,'enter')));
                    return;
                }
                const target2 = document.getElementById(`catList${valueTest}`);
                target2.classList.remove('displayHide');
                return;
            }

        // show / hide delete button in selection Category
        if(event.target.getAttribute('data-btn') === ('delBtn')) {
                const showDel = document.querySelectorAll('[data-selBtn]');
                showDel.forEach(sd => {
                    if(sd.classList.contains('displayHide')) {
                        sd.classList.remove('displayHide')
                    } else {
                        sd.classList.add('displayHide')
                    }
                })
                return;
            }

        // show / hide delete button in list inspection in selected category
        if(event.target.getAttribute('data-btn') === (`delBtnList__${valueTest}`)) {
                const showDel2 = document.querySelectorAll(`[data-cell*="del___${valueTest}"]`);
                showDel2.forEach(sd=> {
                    if(sd.classList.contains('displayHide')) {
                        sd.classList.remove('displayHide');
                    } else {
                        sd.classList.add('displayHide');
                    }
                })
                return;
            }
            
        // insert new Category
        if(event.target.getAttribute('data-btn') === ('addBtn')) {
                const valueCat = document.querySelector('[data-input*="inpCatNew"]');
                const dataArr ={mesin_cat: [valueCat.value]};
                const result = await list_category.insertData(dataArr);
                console.log(result);
                if (!result.includes('fail')) {
                    alert('data successfully inserted');
                    location.reload();
                } else {
                    alert('data is not inserted');
                }
                return;
            }

        // delete category
        if(event.target.getAttribute('data-selbtn') === (`${valueTest}`)) {
                const result = await list_category.deleteData('mesin_cat',valueTest);
                if (!result.includes('fail')) {
                    alert('data successfully deleted');
                    location.reload();
                } else {
                    alert('data fail to delete');
                }
                return;
            }

        // delete list inspection from selected category
        if(event.target.getAttribute('data-cell')) {
                if(event.target.getAttribute('data-cell').includes(`del___`)) {
                    const target = event.target.getAttribute('data-cell');
                    const split = target.split('___');
                    const getId = document.querySelector(`[data-cell="id___${split[1]}"]`);
                    const result = await dmc_vjs.deleteData('id_std', getId.value);
                    if (!result.includes('fail')) {
                        alert('data successfully deleted');
                        location.reload();
                    } else {
                        alert('data fail to delete');
                    }
                    return;
                }
                return;
            }

        //add inspection to selected category
        if(event.target.getAttribute('data-btn') === `addBtnList__${valueTest}` ) {
                const div = document.createElement('div');
                div.id = `addedList__${valueTest}`;
                div.setAttribute('data-divList', valueTest);
                const container = document.getElementById(`catList${valueTest}`)
                container.appendChild(div);
                if (!document.querySelector(`[data-btn="editInsp__${valueTest}`)) {
                    container.appendChild(await createBtn(basicBtn(`editInsp__${valueTest}`,'editBtn_m')));
                }
                if (document.querySelectorAll('#cc').length>1) {
                    createTable(await tblAddList(valueTest));
                    const getDiv = document.getElementById(`addedList__${valueTest}`);
                    getDiv.removeChild(getDiv.lastChild);
                } else {
                    createTable(await tblAddList(valueTest));
                }
                return;
            }

        //pick category mesin
        if(event.target.getAttribute('data-btn') === `sbmtPick__${valueTest}` ) {
                const idTarget = document.getElementById('assetInput');
                const value = idTarget.value.split('/');
                let result = '';
                if(cek === 0) {
                    const dataArr ={asset_id: [value[2]], vjs_kategory:[valueTest]};
                    result = await vjs_asset.insertData(dataArr);
                    if (!result.includes('fail')) {
                            alert('data successfully inserted');
                            location.reload();
                        } else {
                            alert('data fail to insert');
                        }
                } else {
                    const dataArr ={update:{vjs_kategory:[valueTest]},filter:{asset_id: [cek]}};
                    result = await vjs_asset.updateData(dataArr);
                    if (!result.includes('fail')) {
                            alert('data successfully updated');
                            location.reload();
                        } else {
                            alert('data fail to update');
                        }
                }
                return;
            }
            
        //add inspection to selected category
        if(event.target.getAttribute('data-btn') === `editInsp__${valueTest}` ) {
                const value1 = document.querySelectorAll(`[data-cell*="inspection__${valueTest}__`);
                const dataArr = {category:[], inspection:[]};
                value1.forEach(vl=>{
                    if(vl.value !== ''){
                        dataArr['category'].push(valueTest);
                        const value = vl.value.split("--")
                        dataArr['inspection'].push(value[1]);
                    }
                })
                console.log(dataArr);
                const result = await bom.insertData(dataArr);
                console.log(result)
                if (!result.includes('fail')) {
                        alert('data successfully inserted');
                        location.reload();
                    } else {
                        alert('data fail to insert');
                    }
                return;
            }
    })

    document.addEventListener('change', function(event) {
        if(event.target.getAttribute('data-cell')) {
            if(event.target.getAttribute('data-cell').includes(`inspection__${valueTest}`)) {
                const target = event.target;
                const value = target.value.split("--");
                const data = list_insp.filter(item => item.inspection === value[1]);
                const row = target.closest('[data-row]');
                const all = row.querySelectorAll('input');
                all.forEach(al=> {
                    const mark = al.getAttribute('data-cell');
                    const markSplit = mark.split('___');
                    const key = Object.keys(data[0]);
                    if(key.includes(markSplit[0])) {
                        al.value = data[0][markSplit[0]];
                    }
                })
            }
        }
    })
</script>
<script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
<script type='module' src="./utility/index.js"></script>
<script src="./utility/post.js"></script>
</body>
</html>