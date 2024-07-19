<?php
require_once "2.backend/api/vjs_alat_ukur.php";
require_once "2.backend/model/index.php";
require_once "1.asset/index.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='1.asset/main.css' rel='stylesheet' />
        <script src="https://cdn.tailwindcss.com"></script>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>
        <link rel='icon' href='1.asset/symbol/new_logo_sbe.png' type='image/ico' />
        <title>test</title>
    </head>
</head>
<body class="bg-slate-700">
    <label for='test'></label>
    <input type="text" id="test" required>
</body>
<script>
    const test = document.querySelector('[for="test"]');
    const input = document.querySelector('input');
    input.addEventListener('input', function() {
        console.log(input.value);
        if(input.value === 'test') {
            input.setCustomValidity('cannot contain test');
        } else {
            input.setCustomValidity('');
        }
        input.reportValidity();
    })

</script>
</html>