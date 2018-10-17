<script src="Functions::maps.googleapis.com/maps/api/js?key=AIzaSyCsQdSlW4vj5RvXp2_pLnv1s1ErfxjM5_o"></script>
<script src="plugins/jquery/jquery-migrate-3.0.0.min.js"></script>
<script src="plugins/bootstrap/js/tether.min.js"></script>
<script src="plugins/bootstrap/js/popper.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/selectbox/jquery.selectbox-0.1.3.min.js"></script>
<script src="plugins/slick/slick.min.js"></script>
<script src="plugins/circle-progress/jquery.appear.js"></script>
<script src="plugins/isotope/isotope.min.js"></script>
<script src="plugins/fancybox/jquery.fancybox.min.js"></script>
<script src="plugins/counterUp/waypoint.js"></script>
<script src="plugins/counterUp/jquery.counterup.js"></script>
<script src="plugins/smoothscroll/SmoothScroll.js"></script>
<script src="plugins/syotimer/jquery.syotimer.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="js/custom.js"></script>
<script>
    /////////////////////////////////////////////////////////////////////
    // Animation on scroll
    /////////////////////////////////////////////////////////////////////
    var $animation_elements = $('.animated');
    var $window = $(window);

    function check_if_in_view() {
        'use strict';
        var window_height = $window.height();
        var window_top_position = $window.scrollTop();
        var window_bottom_position = (window_top_position + window_height);

        $.each($animation_elements, function() {
            var $element = $(this);
            var element_height = $element.outerHeight();
            var element_top_position = $element.offset().top;
            var element_bottom_position = (element_top_position + element_height);
            var animationType = $(this).attr("data-animation");

            //check to see if this current container is within viewport
            if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
                $element.addClass(animationType);
            } else {
                $element.removeClass(animationType);
            }
        });
    }

    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');

</script>

    <script>
        $(document).ready(function() {
            $("#phoneNumber").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl/cmd+A
                    (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: Ctrl/cmd+C
                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: Ctrl/cmd+X
                    (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
