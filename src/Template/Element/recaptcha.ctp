<?php
/**
 * @var \Cake\View\View $this
 */

$url = 'https://www.google.com/recaptcha/api.js';
if ($hl !== null):
    $url = $url . '?hl = ' . $hl;
endif;
?>
<div id="_g-recaptcha"></div>
<div
    class="g-recaptcha"
    data-size="invisible"
    data-callback="_submitForm"
    data-sitekey="<?= $sitekey ?>"
    data-badge="<?= $badge ?>"
    data-type="<?= $type ?>"
></div>

<script src="<?= $url ?>" async defer></script>
<script>
    var _submitForm;
    window.onload = function () {
        var _captchaForm = document.querySelector('#_g-recaptcha').closest('form');
        _submitForm = function () {
            _captchaForm.submit();
        };
        _captchaForm.addEventListener('submit',
            function (e) {
                e.preventDefault();
                grecaptcha.execute();
            });
    }
</script>
