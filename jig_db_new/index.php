<?php
require_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/layout.css">
    <link rel="stylesheet" href="../assets/css/animation.css">
    <link rel="stylesheet" href="../assets/css/font.css">
    <link rel="stylesheet" href="../assets/css/color.css">
    <link rel="stylesheet" href="../assets/css/table.css">
    <link rel="stylesheet" href="../assets/css/search_btn.css">
    <title>Jig Database</title>
</head>
<body>
    <input type='hidden' value="<?php echo $role; ?>" id='role'>
    <div id='root'></div>
<!-- ==================================================================================
Javascript 
==================================================================================
-->
    <script type='module'>
        /*
        ============================================================================
        display layout
        ============================================================================*/
        // flex display div di root
        const root = document.getElementById('root');
        root.classList.add('fr')

        // create sidebar container div
        const side = document.createElement('div');
        side.classList.add('sideCard');
        side.id ="side";
        root.appendChild(side);
        // create main container div
        const main = document.createElement('div');
        main.classList.add('main');
        main.id ="main";
        root.appendChild(main);

        // role
        const role = document.getElementById('role');

        /*
        ============================================================================
        sidebar
        ============================================================================*/
        // sidebar menu dan penanda link active di sidebar
        import { createSidebar, activeLink } from './component/sidebar.js';
        createSidebar('side', 'sl1');
        document.addEventListener("DOMContentLoaded", function() {
            activeLink('a.link');
        });

        /*
        ============================================================================
        navbar
        ============================================================================*/
        // navbar di main container utk unhide div dari jig database dan speaker database
        import { createNavbar } from './component/navbar.js';
        main.appendChild(createNavbar(`
        <div class='navCard navbar sl4'>
            <div class='navli'>
                <button type="button" id="btnSec1">
                    Detail Jig Search
                </button>
            </div>
            <div class='navli'>
                <button type="button" id="btnSec2">
                    Detail Speaker Search
                </button>
            </div>
        </div>
        `));

        /*
        ============================================================================
        searh bar
        ============================================================================*/
        // loading data table generate dan search
        import { search } from './component/search.js';
        search('main', 'searchJig', 'btnJig', 'btnJigXls', 'divJigSearch');
        search('main', 'searchSpk', 'btnSpk', 'btnSpkXls', 'divSpkSearch');
        const divSpk = document.querySelector('#divSpkSearch.fr');
        divSpk.style.display = 'none';

        /*
        ============================================================================
        table data dan generate
        ============================================================================*/
        // table jig generate
        import { dataJig } from './component/tableJig.js';
        dataJig();

    </script>
    <script type='module' src="./component/button.js"></script>
    <script src="../assets/template/library/sheetjs/xlsx.full.min.js"></script>
</body>
</html>