jQuery(document).ready(function ($) {
    $('.timer').counterUp({
        delay: 10,
        time: 1000,
        formatter: function (n) {
            return n.replace(/,/g, '.');
        }
    });
});