(function () {
    'use strict';
    document.querySelectorAll('.monthly-archives select[name="m"]').forEach(function (select) {
        select.addEventListener('change', function () {
            if (select.value && select.form) select.form.requestSubmit();
        });
    });
}());
