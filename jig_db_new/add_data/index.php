<?php 
include_once "../config.php";
include_once "add_data.php";
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
                        <div class="card2"><input type="text" class="addformtxt" name="item_jig" placeholder="item Number Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Description Jig</label></div>
                        <div class="card2"><input type="text" class="addformtxt" name="desc_jig" placeholder="Deskripsi Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Jig Type</label></div>
                        <div class="card2"><input type="text" class="addformtxt" name="type_jig" placeholder="Type Jig"></div>
                    </div>

                    <div class="formgroup">
                        <div class="card1"><label>Material</label></div>
                        <div class="card2"><input type="text" class="addformtxt" name="material" placeholder="Material"></div>
                    </div>



                    <h2>New Jig Location</h2>
                    <div class="formgroup">
                        <div class="card1"><label>Qty Total</label></div>
                        <div class="card2"><input type="text" class="addformtxt readonly" name="qty_tolerance" placeholder="qty" id="qty_total" readonly></div>
                    </div><br/>
                    <div class="formgroup">
                        <div class="card1"><label>Tolerance</label></div>
                        <div class="card2"><input type="text" class="addformtxt" name="qty_tolerance" placeholder="Toleransi"></div>
                    </div><br/>
                    <table>
                        <tbody id="inputContainer">
                        <tr>
                            <th class="tbl-header">Location</th>
                            <th class="tbl-header">Quantity Per Unit</th>
                            <th class="tbl-header">Unit of Measurement</th>
                        </tr>
                        <tr>
                            <td class="tbl-value"><input type="text" class="addformtxt" name="loc[]" placeholder="location" list="suggest3">
                            </td>
                            <td class="tbl-value"><input type="text" id="qty0" class="addformtxt" name="qty_per_unit[]" placeholder="Qty Per Unit"></td>
                            <td class="tbl-value"><input type="text" class="addformtxt" name="unit[]" placeholder="Unit"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer', 'tbl-value',[{style:'addformtxt', inputName:'loc[]', inputID:'', typeInput: 'text', textHolder: 'Location', listName:'suggest3'},{style:'addformtxt', inputName:'qty_per_unit[]', inputID:'qty0', typeInput: 'text', textHolder: 'Qty Per Unit', listName:''},{style:'addformtxt', inputName:'unit[]', inputID:'', typeInput: 'text', textHolder: 'Unit', listName:''}])">add input</button>
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
                        <td class="tbl-value"><input type="text" class="addformtxt" name="item_type[]" placeholder="input speaker type" list="suggestion2"></td>

                        <td class="tbl-value"><input type="text" class="addformtxt" name="opt_on[]" placeholder="Put On Ops"></td>

                        <td class="tbl-value"><input type="text" class="addformtxt" name="opt_off[]" placeholder="Pull Out Ops"></td>
                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer2', 'tbl-value',[{style:'addformtxt', inputName:'item_type[]', inputID:'', typeInput: 'text', textHolder: 'input speaker type', listName:'suggestion2'},{style:'addformtxt', inputName:'opt_on[]', inputID:'', typeInput: 'text', textHolder: 'Put On Ops', listName:''},{style:'addformtxt', inputName:'opt_off[]', inputID:'', typeInput: 'text', textHolder: 'Pull Out Ops', listName:''}])">add input</button>
                    <datalist id="suggestion2">
                        <option value="- Choose -" selected></option>
                    </datalist>
                    
                    <button type="submit" name="input_jig" class="mainbtn">submit</button>
                </form>
            </div>
        </div>

        <div class="wrap_add ml4">
            <div id="section2" class="addform hidden_add">
                <h2 >Add New Speaker Data</h2>
                <form method="POST" class="addform">
                    <div class="formgroup">
                        <label>Speaker Item Number</label>
                        <input type="text" class="addformtxt" name="item_type2" placeholder="Input item number speaker">
                    </div>
                    <table>
                        <tbody id="inputContainer3">
                        <tr>
                            <th class="tbl-header">Put On Ops</th>
                            <th class="tbl-header">Pull Out Ops</th>
                            <th class="tbl-header">Item Number Jig</th>
                        </tr>
                        <tr>
                            <td class="tbl-value"><input type="text" class="addformtxt" name="opt_on2[]" placeholder="Put On Ops"></td>
                            <td class="tbl-value"><input type="text" class="addformtxt" name="opt_off2[]" placeholder="Pull Out Ops"></td>
                            <td class="tbl-value"><input type="text" class="addformtxt" name="item_jig2[]" placeholder="item Number Jig" list="suggest"></td>

                        </tr>
                        </tbody>
                    </table>
                    <button type="button" onclick="addTableInput('inputContainer3', 'tbl-value',[{style:'addformtxt', inputName:'opt_on2[]', inputID:'', typeInput: 'text', textHolder: 'Put On Ops', listName:''},{style:'addformtxt', inputName:'opt_off2[]', inputID:'', typeInput: 'text', textHolder: 'Pull Out Ops', listName:''},{style:'addformtxt', inputName:'item_jig2[]', inputID:'', typeInput: 'text', textHolder: 'item Number Jig', listName:'suggest'}])">add input</button>
                    <datalist id="suggest">
                        <option value="- Choose -" selected></option>
                    </datalist>

                    <button class="mainbtn" type="submit" name="input_type">submit</button>
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
                                        <div class="card2"><input class="addformtxt" type="text" name="location" placeholder="Location Name" list = "suggest3"></div>
                                    </div>
                                    <button class="mainbtn" type="submit" name="locate">submit</button>
                                </form>
                        </div>
                    </div>
                    <div class='side'>
                        <div>
                            <h2 >Add New Jig Type</h2>
                                <form method="POST" class="addform">
                                    <div class="formgroup">
                                        <div class="card1"><label>Jig Type</label></div>
                                        <div class="card2"><input class="addformtxt" type="text" name="type_jig2" placeholder="Input New Jig Type" list="type_jig" autocomplete="off"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>Standard Lifetime</label></div>
                                        <div class="card2"><input class="addformtxt" type="text" name="std_life" placeholder="Standard Lifetime"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>Unit of Measurement</label></div>
                                        <div class="card2"><input class="addformtxt" type="text" name="unit_lftm" placeholder="Unit of Measurement"></div>
                                    </div>
                                    <div class="formgroup">
                                        <div class="card1"><label>PIC Maintenance</label></div>
                                        <div class="card2"><input class="addformtxt" type="text" name="mtnc_by" placeholder="Maintenance PIC"></div>
                                    </div>
                                    <button class="mainbtn" type="submit" name="mtnc">submit</button>
                                </form>
                        </div>
                    </div>
            </div>
        </div>
</div>
<datalist id="type_jig">

<datalist>
<?php } else {
    header("Location: http://192.168.2.103:8080/wbd/jig_db_new/index.php");
    exit;
}
    ?>
<script src="../assets/JS/main.js"></script>
<script src="index.js"></script>
<script type='module'>
    import { createSidebar, activeLink } from '../component/sidebar.js';
    createSidebar('side', 'sl1');
    document.addEventListener("DOMContentLoaded", function() {
        activeLink('a.link');
    });
</script>
</body>
</html>
