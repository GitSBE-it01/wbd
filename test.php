<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<script type="module">
    console.log('testing');
    import {api_access} from './3.utility/index.js';
    const rout = await api_access('fetch_rout_active_subcon', 'qad_rout', '');
    console.log({rout});
</script>
</body>
</html>