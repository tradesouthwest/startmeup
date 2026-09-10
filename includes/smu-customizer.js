/**
 * Customizer Live Preview Scripts (Vanilla JS)
 * Theme: Startmeup
 */
(function () {
    'use strict';

    if (typeof wp === 'undefined' || !wp.customize) {
        return;
    }

    wp.customize('startmeup_blog_layout', function (value) {
        value.bind(function (newVal) {
            const body = document.body;

            // Remove existing body layout classes
            body.classList.remove('blog-layout-single-column', 'blog-layout-three-columns');

            // Apply the new layout class to <body>
            if (newVal) {
                body.classList.add('blog-layout-' + newVal);
            }
        });
    });
})();