        var jssor_1_slider;
        var containerWidth;
        var isFullscreenMode = false;
        jQuery(document).ready(function ($) {
            if ($('#jssor_1').length < 1){
                return;
            }

            var jssor_1_SlideshowTransitions = [{
                    $Duration: 300,
                    x: 0.3,
                    $During: {
                        $Left: [0.3, 0.7]
                    },
                    $Easing: {
                        $Left: $Jease$.$InCubic,
                        $Opacity: $Jease$.$Linear
                    },
                    $Opacity: 2
                }
            ];

            var jssor_1_options = {
                $AutoPlay: 1,
                $FillMode: 5,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $SpacingX: 5,
                    $SpacingY: 5
                },
                $SlideDuration: 200,
                $Idle: 5000
            };

            jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            jssor_1_slider.$HWA = false;
            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }


            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*#endregion responsive code end*/

            var jssor_1_slider_element = document.getElementById("jssor_1");
            var jssor_1_slider_parent_element = jssor_1_slider_element.parentNode;
            var fullscreenElement;
            var fullscreen_toggle_button_element = document.getElementById("galleryFullscreenButton");

            function ToggleFullscreen() {
                console.log('test');
                
                isFullscreenMode = !isFullscreenMode;
                if (isFullscreenMode) {
                    //create fullscreen div, move jssor slider into the div
                    fullscreenElement = document.createElement("div");
                    fullscreenElement.style.position = "fixed";
                    fullscreenElement.style.top = 0;
                    fullscreenElement.style.left = 0;
                    fullscreenElement.style.width = "100%";
                    fullscreenElement.style.height = "100%";
                    fullscreenElement.style.zIndex = 1000000;

                    document.body.appendChild(fullscreenElement);
                    var fullscreenRect = fullscreenElement.getBoundingClientRect();
                    var width = fullscreenRect.right - fullscreenRect.left;
                    var height = fullscreenRect.bottom - fullscreenRect.top;

                    fullscreenElement.appendChild(jssor_1_slider_element);
                    jssor_1_slider.$ScaleSize(width, height);
                } else if (fullscreenElement) {
                    //move jssor slider into its original container, remove the fullscreen div
                    jssor_1_slider_parent_element.appendChild(jssor_1_slider_element);
                    var width = containerWidth;
                    jssor_1_slider.$ScaleWidth(width);

                    document.body.removeChild(fullscreenElement);
                    fullscreenElement = null;
                }
            }
            fullscreen_toggle_button_element.addEventListener("click", ToggleFullscreen);
            $(document).keyup(function (e) {
                if (e.keyCode === 27 && isFullscreenMode) ToggleFullscreen(); // esc
            });
        });