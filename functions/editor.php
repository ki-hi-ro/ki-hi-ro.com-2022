<?php
/**
 * Block editor adjustments.
 */

function kihiro_enable_editor_text_selection() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        function enableTextSelection() {
            const iframe = document.querySelector('.editor-canvas iframe, .edit-post-visual-editor iframe, .block-editor__iframe');

            if (!iframe) {
                window.setTimeout(enableTextSelection, 500);
                return;
            }

            const doc = iframe.contentDocument || iframe.contentWindow.document;

            if (!doc || !doc.head || doc.getElementById('kihiro-editor-text-selection')) {
                return;
            }

            const style = doc.createElement('style');
            style.id = 'kihiro-editor-text-selection';
            style.textContent = '* { user-select: text !important; -webkit-user-select: text !important; }';
            doc.head.appendChild(style);
        }

        enableTextSelection();
    });
    </script>
    <?php
}
add_action('admin_footer', 'kihiro_enable_editor_text_selection');
