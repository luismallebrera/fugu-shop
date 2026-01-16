<?php fugu_add_page_include( 'login-popup' ); ?>
<div id="fugu-login-popup-wrap" class="fugu-login-popup-wrap mfp-hide">
    <?php wc_get_template( 'myaccount/form-login.php', array( 'is_popup' => true ) ); ?>
</div>