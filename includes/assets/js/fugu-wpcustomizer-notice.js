(function($) {

    'use strict';

    wp.customize.bind('ready', function() {
        wp.customize.notifications.add(
            'fugu-wpcustomizer-notice',
            new wp.customize.Notification(
                'fugu-wpcustomizer-notice', {
                    dismissible: true,
                    message: fugu_wpcustomizer_notice.notice,
                    type: 'warning'
                }
            )
        );
    });
})(jQuery);