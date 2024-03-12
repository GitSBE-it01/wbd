<?php 
include_once "../config.php";
// include_once "add_data.php";
$status = isset($_GET['status']) ? $_GET['status'] : '';
if ($status === 'success') {
    $message = 'Data successfully updated';
    echo $message;
} else {
    $message = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add New Data</title>
    <link rel="stylesheet" href="../assets/CSS/main.css">
    <link rel="stylesheet" href="../assets/CSS/add_data.css">
    <link rel="stylesheet" href="../assets/CSS/update.css">
    <link rel="stylesheet" href="../../assets/css/layout.css">
    <link rel="stylesheet" href="../../assets/css/animation.css">
    <link rel="stylesheet" href="../../assets/css/font.css">
    <link rel="stylesheet" href="../../assets/css/color.css">
    <link rel="stylesheet" href="../../assets/css/table.css">
    <link rel="stylesheet" href="../../assets/css/search_btn.css">
</head>
<body>
<input type=hidden id='role' value="<?php if (isset($role)) {echo $role;} else {echo 'guest';}?>">
<?php if ($role === 'admin' || $role === 'superuser')  {?>
    <div class="fr">
	<div class="sideCard" id='side'>
	</div>

    <div class="main">
        <div class="topadd">
            <nav class="indexlink">
                <ul>
                    <li><a href="#section1" class="nav-link active" onclick="addActive('section1')">Add Jig</a></li>
                    <li><a href="#section2" class="nav-link" onclick="addActive('section2')">Add Speaker</a></li>
                    <li><a href="#section3" class="nav-link" onclick="addActive('section3')">loc and Maintenance</a></li>
                
                </ul>
            </nav>
        </div>
        <div class="wrap_add ml4">
            <div id="section1" class="addform hidden_add aktif">
                <h1 >Add New Jig</h1>
                <form method="POST" class="addform">
                    <div class="formgroup">
                        <div class="card1"><label>Item Number Jig</label></div>
                        <div class="card2"><input autocomplete='off' data-cell='jig_mstr' type="text" class="addformtxt" name="item_jig" placeholder="item Number Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Description Jig</label></div>
                        <div class="card2"><input autocomplete='off' data-cell='jig_mstr' type="text" class="addformtxt" name="desc_jig" placeholder="Deskripsi Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Jig Type</label></div>
                        <div class="card2"><input autocomplete='off' data-cell='jig_mstr' type="text" class="addformtxt" name="type" placeholder="Type Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Material</label></div>
                        <div class="card2"><input autocomplete='off' data-cell='jig_mstr' type="text" class="addformtxt" name="material" placeholder="Material"></div>
                    </div>



                    <h2>New Jig Location</h2>
                    <div class="formgroup">
                        <div class="card1"><label>Qty Total</label></div>
                        <div class="card2"><input autocomplete='off' data-cell type="text" class="addformtxt readonly" name="qty" placeholder="qty" id="qty_total" readonly></div>
                    </div><br/>
                    <div class="formgroup">
                        <div class="card1"><label>Tolerance</label></div>
                        <div class="card2"><input autocomplete='off' data-cell='jig_loc' type="text" class="addformtxt" name="tolerance" placeholder="Toleransi"></div>
                    </div><br/>
                    <table>
                        <tbody id="inputContainer">
                        <tr>
                            <th class="tbl-header">Location</th>
                            <th class="tbl-header">Quantity Per Unit</th>
                            <th class="tbl-header">Unit of Measurement</th>
                        </tr>
                        <tr>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_loc' type="text" class="addformtxt" name="lokasi" placeholder="location" list="suggest3">
                            </td>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_loc' type="text" id="qty0" class="addformtxt" name="qty_per_unit" placeholder="Qty Per Unit"></td>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_loc' type="text" class="addformtxt" name="unit" placeholder="Unit"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer', 'tbl-value',[{style:'addformtxt', inputName:'lokasi', inputID:'', typeInput: 'text', textHolder: 'Location', listName:'suggest3', dcell:'jig_loc'},{style:'addformtxt', inputName:'qty_per_unit', inputID:'qty0', typeInput: 'text', textHolder: 'Qty Per Unit', listName:'', dcell:'jig_loc'},{style:'addformtxt', inputName:'unit', inputID:'', typeInput: 'text', textHolder: 'unit', listName:'',dcell:'jig_loc'}])">add input</button>
                    <datalist id="suggest3">
                        <option value="- Choose -" selected></option>
                    </datalist>
                    <br/>
                    <h2>Speaker Usage</h2>
                    <table>
                        <tbody id="inputContainer2">
                        <tr>
                            <th class="tbl-header">Type Speaker</th>
                            <th class="tbl-header">Put On Ops</th>
                            <th class="tbl-header">Pull Out ops</th>
                        </tr>
                        <tr>
                        <td class="tbl-value"><input autocomplete='off' data-cell='jig_func' type="text" class="addformtxt" name="item_type" placeholder="input speaker type" list="suggestion2"></td>

                        <td class="tbl-value"><input autocomplete='off' data-cell='jig_func' type="text" class="addformtxt" name="opt_on" placeholder="Put On Ops"></td>

                        <td class="tbl-value"><input autocomplete='off' data-cell='jig_func' type="text" class="addformtxt" name="opt_off" placeholder="Pull Out Ops"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer2', 'tbl-value',[{style:'addformtxt', inputName:'item_type', inputID:'', typeInput: 'text', textHolder: 'input speaker type', listName:'suggestion2', dcell:'jig_func'},{style:'addformtxt', inputName:'opt_on', inputID:'', typeInput: 'text', textHolder: 'Put On Ops', listName:'', dcell:'jig_func'},{style:'addformtxt', inputName:'opt_off', inputID:'', typeInput: 'text', textHolder: 'Pull Out Ops', listName:'', dcell:'jig_func'}])">add input</button>
                    <datalist id="suggestion2">
                        <option value="- Choose -" selected></option>
                    </datalist>
                    <!--name="input_jig" -->
                    <button type="button"class="mainbtn" id="jigMstrSbmt">submit</button>
                </form>
            </div>
        </div>

        <div class="wrap_add ml4">
            <div id="section2" class="addform hidden_add">
                <h2 >Add New Speaker Data</h2>
                <form method="POST" class="addform">
                    <div class="formgroup">
                        <label>Speaker Item Number</label>
                        <input autocomplete='off' data-cell='jig_func2' type="text" class="addformtxt" name="item_type" placeholder="Input item number speaker" list="suggestion2">
                    </div>
                    <table>
                        <tbody id="inputContainer3">
                        <tr>
                            <th class="tbl-header">Put On Ops</th>
                            <th class="tbl-header">Pull Out Ops</th>
                            <th class="tbl-header">Item Number Jig</th>
                        </tr>
                        <tr>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_func2' type="text" class="addformtxt" name="opt_on" placeholder="Put On Ops"></td>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_func2' type="text" class="addformtxt" name="opt_off" placeholder="Pull Out Ops"></td>
                            <td class="tbl-value"><input autocomplete='off' data-cell='jig_func2' type="text" class="addformtxt" name="item_jig" placeholder="item Number Jig" list="suggest"></td>

                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer3', 'tbl-value',[{style:'addformtxt', inputName:'opt_on', inputID:'', typeInput: 'text', textHolder: 'Put On Ops', listName:'', dcell:'jig_func2'},{style:'addformtxt', inputName:'opt_off', inputID:'', typeInput: 'text', textHolder: 'Pull Out Ops', listName:'',dcell:'jig_func2'},{style:'addformtxt', inputName:'item_jig', inputID:'', typeInput: 'text', textHolder: 'item Number Jig', listName:'suggest',dcell:'jig_func2'}])">add input</button>
                    <datalist id="suggest">
                        <option value="- Choose -" selected></option>
                    </datalist>

                    <button class="mainbtn" type="button" name="input_type" id="jigFuncSbmt">submit</button>
                </form>
                
            </div>
        </div>

        <div class="wrap_add ml4">
            <div id="section3" class="addform hidden_add">
                    <div class='side'>
                        <div>
                            <h2 >Add New Location Data</h2>
                                <form method="POST" class="addform">
                                    <div class="formgroup">
                                        <div class="card1"><label>Add New Location</label></div>
                                        <div class="card2"><input autocomplete='off' data-cell='list_loc' class="addformtxt" type="text" name="location" placeholder="Location Name" list = "suggest3"></div>
                                    </div>
                                    <button class="mainbtn" type="button" name="locate" id="listLocSbmt">submit</button>
                                </form>
                        </div>
                    </div>
                    <div class='side'>
                        <div>
                            <h2 >Add New Jig Type</h2>
                                <form method="POST" class="addform">
                                    <div class="formgroup">
                                        <div class="card1"><label>Jig Type</label></div>
                                        <div class="card2"><input autocomplete='off' data-cell='list_mtnc' class="addformtxt" type="text" name="type_jig" placeholder="Input New Jig Type" list="type_jig" autocomplete="off"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>Standard Lifetime</label></div>
                                        <div class="card2"><input autocomplete='off' data-cell='list_mtnc' class="addformtxt" type="text" name="mtnc_std_lifetime" placeholder="Standard Lifetime"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>Unit of Measurement</label></div>
                                        <div class="card2"><input autocomplete='off' data-cell='list_mtnc' class="addformtxt" type="text" name="lftm_unit" placeholder="Unit of Measurement"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>PIC Maintenance</label></div>
                                        <div class="card2"><input autocomplete='off' data-cell='list_mtnc' class="addformtxt" type="text" name="mtnc_by" placeholder="Maintenance PIC"></div>
                                    </div>
                                    <button class="mainbtn" type="button" name="mtnc" id="listMtncSbmt">submit</button>
                                </form>
                        </div>
                    </div>
            </div>
        </div>
</div>
<datalist id="type_jig"></datalist>
<datalist id="suggestion2"></datalist>
<datalist id="suggest3"></datalist>
<datalist id="suggest"></datalist>
<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;
}
    ?>
<script src="../assets/JS/main.js"></script>
<script src="index.js"></script>
<script type='module'>
    import { createSidebar, activeLink } from '../component/sidebar.js';
    import { loading } from '../component/load.js';
    import {
        jig_master_query,
        jig_location_query,
        jig_function_query,
        log_master_query,
        log_location_query,
        log_function_query,
        list_location, 
        list_mtnc, 
        asset
    } from '../class.js';
    createSidebar('side', 'sl1');
    activeLink('[data-nav]');

    const result1 = await jig_master_query.getData();
    const result3 = await list_location.getData();
    const result8 = await asset.getData();
    const result4 = await list_mtnc.getData();
    

    const populate1 = document.getElementById('suggestion2');//type speaker
    const populate2 = document.getElementById('suggest3'); //lokasi
    const populate3 = document.getElementById('suggest'); // item jig
    const populate4 = document.getElementById('type_jig'); // item jig
    const data = result8.map((obj1) => {
        return {
            item_speaker: obj1.pt_part,
            description: obj1.pt_desc1 + " "+ obj1.pt_desc2 
        }
    });
    const data2 = result3.map((obj1) => {
        return {
            lokasi: obj1.name
        }
    });
    const data3 = result1.map((obj1) => {
        return {
            item_jig: obj1.item_jig,
            desc_jig: obj1.desc_jig,
        }
    });
    const data4 = result4.map((obj1) => {
        return {
            type: obj1.type_jig,
            mtnc_std_lifetime: obj1.mtnc_std_lifetime,
            mtnc_by: obj1.mtnc_by,
            lftm_unit: obj1.lftm_unit
        }
    });

    for (let i =0; i<data.length; i++){
        const option = document.createElement('option');
        option.value = data[i].item_speaker + "  //  " + data[i].description;
        populate1.appendChild(option);
    }

    for (let i =0; i<data2.length; i++){
        const option = document.createElement('option');
        option.value = data2[i].lokasi
        populate2.appendChild(option);
    }

    for (let i =0; i<data3.length; i++){
        const option = document.createElement('option');
        option.value = data3[i].item_jig + "  //  " + data3[i].desc_jig;
        populate3.appendChild(option);
    }

    for (let i =0; i<data4.length; i++){
        const option = document.createElement('option');
        option.value = data4[i].type;
        populate4.appendChild(option);
    }


    document.addEventListener('click', async function(event) {
        if(event.target.getAttribute('id') === 'jigMstrSbmt'){ 
            const btn =  document.getElementById('listMtncSbmt');
            btn.disabled=true;
            const target = document.getElementById('section1');
            target.appendChild(await loading('load','loading2'));
            const data1 = document.querySelectorAll('[data-cell=jig_mstr]');
            const data2 = document.querySelectorAll('[data-cell=jig_loc]');

            let item_jig = '';
            const arr_jig_mstr = {
                    item_jig:[],
                    desc_jig:[],
                    status_jig: [],
                    material: [],
                    type: [],
                    drawing: [],
                }
            data1.forEach(dt=>{
                const key = dt.getAttribute('name');
                console.log(arr_jig_mstr[key]);
                if(arr_jig_mstr[key]) {
                    arr_jig_mstr[key].push(dt.value);
                    if(key === 'item_jig') {
                        item_jig = dt.value;
                        arr_jig_mstr['drawing'].push('');
                    }
                }
            })
            arr_jig_mstr['status_jig'].push('ACTIVE');

            const arr_jig_loc = {
                    item_jig:[],
                    qty_per_unit:[],
                    unit: [],
                    lokasi: [],
                    status: [],
                    toleransi:[],
                    code: [],
                }
                
            let tol = '';
            data2.forEach(dt=>{
                const key = dt.getAttribute('name');
                if(arr_jig_loc[key]) {
                    arr_jig_loc[key].push(dt.value);
                }
                if(key === 'tolerance') {tol = dt.value};
                if(key === 'qty_per_unit') {
                    //counter = counter + 1;
                    arr_jig_loc['toleransi'].push(tol);
                    arr_jig_loc['item_jig'].push(item_jig);
                    const counter = arr_jig_loc['code'].length +1 ;
                    const codeNew = item_jig + "--00" + counter;
                    arr_jig_loc['code'].push(codeNew);
                    arr_jig_loc['status'].push('active');
                    
                }
            })
            
            const data3 = document.querySelectorAll('[data-cell=jig_func]');
            const arr_jig_function = {
                        item_jig:[],
                        item_type:[],
                        opt_on: [],
                        opt_off : [],
                        status: [],
                    }
                    console.log(data3.length);
            data3.forEach(dt=>{
                const key = dt.getAttribute('name');                
                if(key === 'item_type') {
                    const type = dt.value.split(' // ');
                    arr_jig_function['item_type'].push(type[0]);
                    arr_jig_function['item_jig'].push(item_jig);
                    arr_jig_function['status'].push('active')
                } else {
                    arr_jig_function[key].push(dt.value);
                }
            })
            const result1 = await jig_master_query.insertData(arr_jig_mstr);
            if(!result1.includes('fail')) {
                const log1 = await log_master_query.insertData(arr_jig_mstr);
                const result2 = await jig_location_query.insertData(arr_jig_loc);
                if(!result2.includes('fail')) {
                    const log2 = await log_location_query.insertData(arr_jig_loc);
                    const result3 = await jig_function_query.insertData(arr_jig_function);
                    if(!result3.includes('fail')) {
                        const log3 = await log_function_query.insertData(arr_jig_function);
                        alert('all data inserted');
                        location.reload();
                    } else {
                        alert('data master dan lokasi inserted, penggunaan gagal')
                        location.reload();
                    }
                } else {
                    alert('data master inserted, lokasi dan penggunaan gagal');
                    location.reload();
                } 
            } else {
                alert('semua data gagal insert');
            }
            target.removeChild(document.getElementById('load'));
            return;
        } 


        if(event.target.getAttribute('id') === 'jigFuncSbmt') {
            const target = document.getElementById('section2');
            target.appendChild(await loading('load','loading2'));
            const btn =  document.getElementById('jigFuncSbmt');
            btn.disabled=true;
            const dataFunc = document.querySelectorAll('[data-cell=jig_func2]');
            const arr_jig_function = {
                    item_jig:[],
                    item_type:[],
                    opt_on: [],
                    opt_off : [],
                    status: [],
                }
            let item_type ='';
            dataFunc.forEach(dt=>{
                const key = dt.getAttribute('name');
                if (key === 'item_type') {
                    item_type = dt.value.split(" // ");
                }
                if(key === 'item_jig') {
                    const val = dt.value.split(" // ");
                    const item_jig = val[0].trim();
                    arr_jig_function['item_type'].push(item_type[0]);
                    arr_jig_function['item_jig'].push(item_jig);
                    arr_jig_function['status'].push('active')
                    } else if(key !== 'item_type' && arr_jig_function[key]) {
                        arr_jig_function[key].push(dt.value);
                    }
                })
                console.log(arr_jig_function);
            const result1 = await jig_function_query.insertData(arr_jig_function);
            if(!result1.includes('fail')) {
                const log1 = await log_function_query.insertData(arr_jig_function);
                alert('data inserted');
                location.reload();
            } else {
                alert('error data tidak berhasil di insert ke database')
            }
            target.removeChild(document.getElementById('load'));
            btn.disabled = false;
            return;
        }


        if(event.target.getAttribute('id') === 'listLocSbmt') {
            const btn =  document.getElementById('listLocSbmt');
            btn.disabled=true;
            const target = document.getElementById('section3');
            target.appendChild(await loading('load','loading2'));
            const data = document.querySelector('[data-cell=list_loc]');
            const arr_list_loc = {name:[]};
            arr_list_loc['name'].push(data.value);
            const result1 = await list_location.insertData(arr_list_loc);
            if(!result1.includes('fail')) {
                alert('all data inserted');
                location.reload();
            } else {
                alert('error data tidak berhasil di insert ke database')
            }
            btn.disabled=false;
            target.remove(document.getElementById('load'));
            return;
        }
        
        if(event.target.getAttribute('id') === 'listMtncSbmt') {
            const btn =  document.getElementById('listMtncSbmt');
            btn.disabled=true;
            const target = document.getElementById('section');
            target.appendChild(await loading('load','loading2'));
            const data = document.querySelectorAll('[data-cell=list_loc]');
            const arr_list_mtnc = {
                    type_jig:[],
                    mtnc_std_lifetime:[],
                    mtnc_by: [],
                    lftm_unit : [],
                }
                
            data.forEach(dt=>{
                const key = dt.getAttribute('name');
                if(list_mtnc[key]) {
                    list_mtnc[key].push(dt.value);
                }
            })
            const result1 = await list_mtnc.insertData(arr_list_mtnc);
            if(!result1.includes('fail')) {
                    alert('data inserted');
                    location.reload();
            } else {
                    alert('error data tidak berhasil di insert ke database')
            }
            btn.disabled=false;
            target.remove(document.getElementById('load'));
            return;
        }
    })
</script>
</body>
</html>
