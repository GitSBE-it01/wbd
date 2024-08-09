<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include CKEditor from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <!-- External CKEditor library -->
    <script src="../1.asset/external_library/ckeditor/ckeditor.js"></script>
</head>
<body>
    <textarea id="editor"></textarea>
    <button id='btnTest'>Submit</button>

    <!-- Import map -->
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "../1.asset/external_library/ckeditor/ckeditor.js",
                "ckeditor5/": "../1.asset/external_library/ckeditor/"
            }
        }
    </script>

    <!-- Module script -->
    <script type="module">
        import ClassicEditor from '../1.asset/external_library/ckeditor/ckeditor.js';
        import { text, MyUploadAdapter } from './utility/index.js';

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {
                extraPlugins: [MyCustomUploadAdapterPlugin],
                plugins: [Essentials, Paragraph], 
                toolbar: ['bold', 'italic', 'link'] 
            })
            .then(editor => {
                const btn = document.getElementById('btnTest');
                btn.addEventListener('click', async function() {
                    const editorContent = editor.getData();
                    const data = { content: editorContent };
                    try {
                        const insert = await text.insertData(data);
                        console.log(insert);
                    } catch (error) {
                        console.error('Error inserting data:', error);
                    }
                });
            })
            .catch(error => {
                console.error('Error initializing editor:', error);
            });
            
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                const btn = document.getElementById('btnTest');
                btn.addEventListener('click', function() {
                    const editorContent = editor.getData();
                    console.log('Editor content:', editorContent);
                    // You can add code here to handle the submitted content, e.g., sending it to a server
                });
            })
            .catch(error => {
                console.error('There was a problem initializing the editor:', error);
            });
    </script>
</body>
</html>