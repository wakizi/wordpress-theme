(function($, window) {
    $(function() {
        // hide broser bar on mobile
        if ('ontouchstart' in document.documentElement) {
            //http://davidwalsh.name/detect-android
            var isAndroid = navigator.userAgent.toLowerCase().indexOf("android") > -1;
            window.scrollTo(0, isAndroid ? 1 : 0); // android needs to scroll at least 1px
        }

        $(".menu").tinyNav({
            'active' : 'current-menu-item'
        });

        $(".widget").each(function() {
            var widget = $(this),
                a = widget.find('a');

            // If a widget contains a single link, make whole box clickable
            if (1 === a.size()) {
                widget
                    .css('cursor', 'pointer')
                    .click(function() {
                        window.location.href = a.attr('href');
                        return false;
                    });
            }
        });
    });
})(jQuery, window);
