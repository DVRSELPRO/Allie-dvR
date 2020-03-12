<!-- REVOSLIDER SCRIPTS  -->
<script src="revo-slider/js/jquery.themepunch.tools.min.js" >
</script>
<script src="revo-slider/js/jquery.themepunch.revolution.min.js" >
</script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
  (Load Extensions only on Local File Systems ! 
  The following part can be removed on Server for On Demand Loading) -->
<script src="revo-slider/js/extensions/revolution.extension.actions.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.carousel.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.kenburn.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.layeranimation.min.js" >
</script>
<script src="revo-slider/js/extensions/revolution.extension.migration.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.navigation.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.parallax.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.slideanims.min.js" ></script>
<script src="revo-slider/js/extensions/revolution.extension.video.min.js" ></script>

<!-- SLIDER REVOLUTION INITIALIZATION  -->
<script>
    jQuery(document).ready(function () {

        jQuery("#rev_slider_280_1").show().revolution({
            sliderType: "standard",
            jsFileLocation: "revo-slider/js/",
            sliderLayout: "fullscreen",
            dottedOverlay: "none",
            delay: 9000,
            navigation: {
                keyboardNavigation: "on",
                keyboard_direction: "horizontal",
                mouseScrollNavigation: "off",
                onHoverStop: "off",
                touch: {
                    touchenabled: "on",
                    swipe_threshold: 75,
                    swipe_min_touches: 50,
                    swipe_direction: "horizontal",
                    drag_block_vertical: false
                },
                arrows: {
                    style: "hermes",
                    enable: true,
                    hide_onmobile: true,
                    hide_onleave: true,

                    left: {
                        h_align: "left",
                        v_align: "center",
                        h_offset: 0,
                        v_offset: 0
                    },
                    right: {
                        h_align: "right",
                        v_align: "center",
                        h_offset: 0,
                        v_offset: 0
                    }
                },
            },
            responsiveLevels: [1240, 1024, 778, 480],
            visibilityLevels: [1240, 1024, 778, 480],
            gridwidth: [1240, 1024, 778, 480],
            gridheight: [868, 768, 960, 720],
            lazyType: "none",
            parallax: {
                type: "off",
                origo: "slidercenter",
                speed: 1000,
                levels: [0],
                type: "scroll",
                disable_onmobile: "on"
            },
            shadow: 0,
            spinner: "spinner2",
            autoHeight: "off",
            fullScreenAutoWidth: "off",
            fullScreenAlignForce: "off",
            fullScreenOffsetContainer: "",
            fullScreenOffset: "",
            disableProgressBar: "on",
            hideThumbsOnMobile: "off",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            debugMode: false,
            fallbacks: {
                simplifyAll: "off",
                nextSlideOnWindowFocus: "off",

            }
        });

        if (s == undefined) {
            var s = "";
            s = $("ul li div.tp-bgimg").attr("style");
        }
        var style = "";
        var setStyle = false;
        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();
        if (viewportWidth < viewportHeight) {
            setStyle = true;
        }
        //with and heigh
        $(window).resize(function () {
            var viewportWidth = $(window).width();
            var viewportHeight = $(window).height();
            if (viewportWidth < viewportHeight) {
                setStyle = true;
            }
        });
        if (setStyle) {
            style = $("ul li div.tp-bgimg").attr("style");
            style += "; -webkit-mask-image: linear-gradient(to right, transparent 30%, black 80%); mask-image: linear-gradient(to right, transparent 30%, black 80%);";
            $("ul li div.tp-bgimg").attr("style", style);
        } else {
            $("ul li div.tp-bgimg").attr("style", s);
        }


    }); /*ready*/
</script>