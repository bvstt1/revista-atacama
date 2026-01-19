import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#description');

    if (editorElement) {
        ClassicEditor.create(editorElement)
            .catch(error => {
                console.error(error);
            });
    }
});
