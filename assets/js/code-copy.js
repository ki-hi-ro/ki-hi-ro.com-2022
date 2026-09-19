(function () {
    'use strict';

    function fallbackCopy(text) {
        var activeElement = document.activeElement;
        var textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.setAttribute('readonly', '');
        textarea.style.cssText = 'position:fixed;top:0;left:-9999px;font-size:16px;';
        document.body.appendChild(textarea);
        try {
            textarea.select();
            if (!document.execCommand('copy')) {
                throw new Error('Copy failed');
            }
        } finally {
            textarea.remove();
            if (activeElement && activeElement.focus) {
                activeElement.focus({ preventScroll: true });
            }
        }
    }

    async function copyText(text) {
        if (navigator.clipboard && window.isSecureContext) {
            try {
                await navigator.clipboard.writeText(text);
                return;
            } catch (error) {
                // Older browsers and denied clipboard access may need a fallback.
            }
        }
        fallbackCopy(text);
    }

    document.querySelectorAll('.db-single__content pre').forEach(function (pre) {
        if (!pre.matches('.wp-block-code') && !pre.querySelector('code')) return;
        if (pre.parentElement.classList.contains('code-copy')) return;

        var wrapper = document.createElement('div');
        wrapper.className = 'code-copy';
        var toolbar = document.createElement('div');
        toolbar.className = 'code-copy__toolbar';
        var status = document.createElement('span');
        status.className = 'code-copy__status';
        status.setAttribute('role', 'status');
        var button = document.createElement('button');
        button.type = 'button';
        button.className = 'code-copy__button';
        button.textContent = 'コピー';
        button.setAttribute('aria-label', 'コードブロックの内容をコピー');
        toolbar.append(status, button);
        pre.before(wrapper);
        wrapper.append(toolbar, pre);

        var resetTimer;
        button.addEventListener('click', async function () {
            clearTimeout(resetTimer);
            button.disabled = true;
            status.textContent = '';
            try {
                var code = pre.querySelector('code') || pre;
                // Preserve line breaks, including those saved as <br> by WordPress.
                var content = code.cloneNode(true);
                content.querySelectorAll('br').forEach(function (br) {
                    br.replaceWith('\n');
                });
                await copyText(content.textContent);
                status.textContent = 'コピーしました';
            } catch (error) {
                status.textContent = 'コピーできませんでした。本文を選択してコピーしてください。';
            } finally {
                button.disabled = false;
                resetTimer = setTimeout(function () {
                    status.textContent = '';
                }, 5000);
            }
        });
    });
}());
