<?php

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>-->
    <link rel="stylesheet" href="../1.asset/external_library/ckeditor5/ckeditor5/ckeditor5.css">
    <script src="../1.asset/external_library/ckeditor5/ckeditor5/ckeditor5.js"></script>
</head>
<body>
<textarea id="editor"></textarea>
<button id='btnTest'>submit</button>
<script type="importmap">
			{
				"imports": {
					"ckeditor5": "../1.asset/external_library/ckeditor5/ckeditor5/ckeditor5.js",
					"ckeditor5/": "../1.asset/external_library/ckeditor5/ckeditor5/"
				}
			}
		</script>
<script type = 'module'>
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from '../1.asset/external_library/ckeditor5/ckeditor5/ckeditor5.js';
    import {text, MyUploadAdapter} from './utility/index.js';
        function MyCustomUploadAdapterPlugin( editor ) {
            editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                return new MyUploadAdapter( loader );
            };
        }

    ClassicEditor
        .create(document.querySelector('#editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin, Image],
        })
        .then(editor => {
            const btn = document.getElementById('btnTest');
            btn.addEventListener('click', async function () {
                const editorContent = editor.getData();
                const data = {
                    content: editorContent
                };
                const insert = await text.insertData(data);
                console.log(insert);
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script type="module">


</script>
</body>
</html>