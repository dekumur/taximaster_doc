let currentMode = 'wysiwyg';

tinymce.init({
    selector: '#wysiwyg-editor',
    language: 'ru',
    height: 550,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
        'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
        'fullscreen', 'insertdatetime', 'media', 'table', 'wordcount'
    ],
    toolbar:
        'undo redo | blocks | bold italic underline | ' +
        'alignleft aligncenter alignright | ' +
        'bullist numlist outdent indent | link image table | ' +
        'code fullscreen | removeformat',
    content_style: `
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; 
            font-size: 14px; line-height: 1.7; color: #333; padding: 16px; 
        }
        img { max-width: 100%; border-radius: 6px; border: 1px solid #eee; }
        table { border-collapse: collapse; width: 100%; }
        td, th { border: 1px solid #ddd; padding: 8px 12px; }
        th { background: #f8f9fb; }
        blockquote { border-left: 3px solid #e0001a; padding-left: 16px; color: #666; }
    `
});

function switchMode(mode) {
    document.querySelectorAll('.tab-switcher button').forEach((btn, i) => {
        btn.classList.toggle('active',
            (mode === 'wysiwyg' && i === 0) ||
            (mode === 'code'    && i === 1) ||
            (mode === 'preview' && i === 2)
        );
    });
    const editor = tinymce.get('wysiwyg-editor');
    const codeEl = document.getElementById('code-editor');
    const previewEl = document.getElementById('preview-box');

    if (currentMode === 'wysiwyg') {
        codeEl.value = editor.getContent();
    } else if (currentMode === 'code') {
        editor.setContent(codeEl.value);
    }

    previewEl.innerHTML = editor.getContent();

    // Скрываем всё
    editor.hide();
    codeEl.style.display = 'none';
    previewEl.style.display = 'none';

    // Показываем нужное
    if (mode === 'wysiwyg') {
        editor.show();
    } else if (mode === 'code') {
        codeEl.style.display = 'block';
    } else {
        previewEl.style.display = 'block';
    }

    currentMode = mode;
}

document.getElementById('editor-form').addEventListener('submit', function() {
    const editor = tinymce.get('wysiwyg-editor');
    if (currentMode === 'code') {
        editor.setContent(document.getElementById('code-editor').value);
    }
    tinymce.triggerSave();
});