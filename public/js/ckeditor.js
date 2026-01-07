document.addEventListener('DOMContentLoaded', () => {
    const textarea = document.querySelector('#description');
    if (!textarea) return;

    const {
        ClassicEditor,
        Essentials,
        Bold,
        Italic,
        Paragraph,
        List
    } = window.CKEDITOR;

    ClassicEditor
        .create(textarea, {
            licenseKey: 'eyJhbGciOiJFUzI1NiJ9.eyJleHAiOjE3Nzk0MDc5OTksImp0aSI6IjNkODE1MzE5LWRlODAtNGFjYy1iNGM2LTQ2NjE5MmZhMDQ1MiIsInVzYWdlRW5kcG9pbnQiOiJodHRwczovL3Byb3h5LWV2ZW50LmNrZWRpdG9yLmNvbSIsImRpc3RyaWJ1dGlvbkNoYW5uZWwiOlsiY2xvdWQiLCJkcnVwYWwiXSwiZmVhdHVyZXMiOlsiRFJVUCIsIkUyUCIsIkUyVyJdLCJ2YyI6ImJjYzg4ZWY2In0.qqGfqIFEnWZYlMJePvpRwXPyxPhteWM8tbr3YQTH4zQ__-YY7R_1OZ4QqwQv7X1ATihMQ0Fsp0xBXFGL0Cspdw',
            plugins: [
                Essentials,
                Bold,
                Italic,
                Paragraph,
                List
            ],
            toolbar: [
                'bold',
                'italic',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'undo',
                'redo'
            ]
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
});
